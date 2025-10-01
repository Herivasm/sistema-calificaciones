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
        // Precarga la relación 'carreras' (Muchos a Muchos) para evitar consultas lentas
        $materias = Materia::with('carreras')->get();

        return view('materias.index', compact('materias'));
    }

    //--------------------------------------------------------------------------

    /**
     * Muestra el formulario para crear una nueva materia.
     */
    public function create()
    {
        // Obtiene todas las Carreras para el menú de selección múltiple
        $carreras = Carrera::all();

        return view('materias.create', compact('carreras'));
    }

    //--------------------------------------------------------------------------

    /**
     * Guarda una nueva materia en la base de datos y la relaciona con las carreras seleccionadas.
     */
    public function store(Request $request)
    {
        // 1. Validación de datos
        $request->validate([
            'nombre' => 'required|unique:materias|max:255',
            // VALIDACIÓN CORREGIDA: Espera un array de IDs de carreras
            'carreras' => 'required|array',
            // Asegura que cada ID dentro del array exista en la tabla 'carreras'
            'carreras.*' => 'exists:carreras,id',
        ]);

        // 2. Creación de la Materia (Solo guardamos el nombre)
        $materia = Materia::create(['nombre' => $request->input('nombre')]);

        // 3. Adjuntar las Carreras (Relación Muchos a Muchos)
        // Usamos attach() para poblar la tabla pivote 'carrera_materia'
        $materia->carreras()->attach($request->input('carreras'));

        // 4. Redirección con mensaje de éxito
        return redirect()->route('materias.index')
                         ->with('success', 'Materia registrada y asignada a carreras con éxito.');
    }

    //--------------------------------------------------------------------------

    /**
     * El resto de métodos (show, edit, update, destroy) se implementarán más tarde.
     */
     public function show(string $id) { /* ... */ }
     public function edit(string $id) { /* ... */ }
     public function update(Request $request, string $id) { /* ... */ }
     public function destroy(string $id) { /* ... */ }
}
