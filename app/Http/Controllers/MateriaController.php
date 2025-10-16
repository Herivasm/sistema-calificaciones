<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materia;
use App\Models\Carrera; // Necesaria para el menú desplegable

class MateriaController extends Controller
{
    /**
     * Muestra la lista de todas las materias, precargando las carreras asociadas.
     */
    public function index()
    {
        $materias = Materia::with('carreras')->get();
        return view('materias.index', compact('materias'));
    }

    /**
     * Muestra el formulario para crear una nueva materia.
     */
    public function create()
    {
        $carreras = Carrera::all();
        return view('materias.create', compact('carreras'));
    }

    /**
     * Guarda una nueva materia en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|unique:materias|max:255',
            'carreras' => 'required|array',
            'carreras.*' => 'exists:carreras,id',
        ]);

        $materia = Materia::create(['nombre' => $request->input('nombre')]);
        $materia->carreras()->attach($request->input('carreras'));

        return redirect()->route('materias.index')
                         ->with('success', 'Materia registrada y asignada a carreras con éxito.');
    }

    public function show(string $id) { /* ... */ }

    public function edit(Materia $materia)
    {
        $carreras = Carrera::all();
        return view('materias.edit', compact('materia', 'carreras'));
    }

    /**
     * Actualiza la materia y sus carreras asociadas.
     */
    public function update(Request $request, Materia $materia)
    {
        // 1. Validación
        $request->validate([
            'nombre' => 'required|max:255|unique:materias,nombre,' . $materia->id,
            'carreras' => 'required|array',
            'carreras.*' => 'exists:carreras,id',
            'esta_activo' => 'boolean',
        ]);

        // 2. Preparar datos de actualización
        // Usamos la función boolean() para obtener TRUE o FALSE de forma robusta.
        $data = $request->only('nombre');
        $data['esta_activo'] = $request->boolean('esta_activo');

        // 3. Actualizar la Materia. Ahora funciona porque 'esta_activo' está en $fillable.
        $materia->update($data);

        // 4. Sincronizar la relación Muchos a Muchos
        $materia->carreras()->sync($request->input('carreras'));

        return redirect()->route('materias.index')
                         ->with('success', 'Materia y asociaciones actualizadas con éxito.');
    }

    /**
     * Desactiva (Elimina Suavemente) una materia (usado por el botón 'Desactivar' del index).
     */
    public function destroy(Materia $materia)
    {
        // CLAVE: Esto ahora funciona porque 'esta_activo' está en $fillable.
        $materia->update(['esta_activo' => false]);

        return redirect()->route('materias.index')
                         ->with('success', 'Materia desactivada con éxito.');
    }
}
