<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carrera;

class CarreraController extends Controller
{
    /**
     * Muestra la lista de TODAS las carreras, activas e inactivas.
     */
    public function index()
    {
        // Traemos todos los registros para mostrar el estado Activo/Inactivo
        $carreras = Carrera::all();
        return view('carreras.index', compact('carreras'));
    }

    public function create()
    {
        return view('carreras.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|unique:carreras|max:255',
            'descripcion' => 'nullable|max:255',
        ]);

        // El campo 'esta_activo' tendrá el valor por defecto TRUE (si se configuró en la migración)
        Carrera::create($request->all());

        return redirect()->route('carreras.index')
                         ->with('success', 'Carrera registrada con éxito.');
    }

    public function edit(Carrera $carrera)
    {
        return view('carreras.edit', compact('carrera'));
    }

    /**
     * Actualiza la carrera en la base de datos (Usado para Edición y Reactivación).
     */
    public function update(Request $request, Carrera $carrera)
{
    $request->validate([
        'nombre' => 'required|max:255|unique:carreras,nombre,' . $carrera->id,
        'descripcion' => 'nullable|max:255',
        'esta_activo' => 'boolean',
    ]);

    // Con la corrección en la vista (campo hidden),
    // $request->all() siempre contiene 'esta_activo' con 0 o 1.
    $carrera->update($request->all());

    return redirect()->route('carreras.index')
                     ->with('success', 'Carrera actualizada con éxito.');
}

    /**
     * Desactiva (Elimina Suavemente) el registro.
     * Este método solo se usa para forzar la desactivación.
     */
    public function destroy(Carrera $carrera)
    {
        // Desactivamos la carrera cambiando 'esta_activo' a FALSE
        $carrera->update(['esta_activo' => false]);

        return redirect()->route('carreras.index')
                         ->with('success', 'Carrera desactivada con éxito.');
    }
}
