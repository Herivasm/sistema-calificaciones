<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cuatrimestre;

class CuatrimestreController extends Controller
{
    /**
     * Muestra la lista de TODOS los cuatrimestres, activos e inactivos.
     */
    public function index()
    {
        // Traemos todos los registros para mostrar el estado Activo/Inactivo
        $cuatrimestres = Cuatrimestre::all();
        return view('cuatrimestres.index', compact('cuatrimestres'));
    }

    public function create()
    {
        return view('cuatrimestres.create');
    }

    /**
     * Guarda un nuevo cuatrimestre sin modificar el estado de otros.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|unique:cuatrimestres|max:255',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after:fecha_inicio',
            // 'esta_activo' puede ser opcional si se maneja en el modelo/migración
        ]);

        // NO se agrega lógica para desactivar otros cuatrimestres.
        Cuatrimestre::create($request->all());

        return redirect()->route('cuatrimestres.index')
                         ->with('success', 'Cuatrimestre registrado con éxito.');
    }

    public function edit(Cuatrimestre $cuatrimestre)
    {
        return view('cuatrimestres.edit', compact('cuatrimestre'));
    }

    public function update(Request $request, Cuatrimestre $cuatrimestre)
    {
        $request->validate([
            'nombre' => 'required|max:255|unique:cuatrimestres,nombre,' . $cuatrimestre->id,
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after:fecha_inicio',
            'esta_activo' => 'boolean',
        ]);

        // Con el campo hidden en la vista edit, esto funciona correctamente.
        $cuatrimestre->update($request->all());

        return redirect()->route('cuatrimestres.index')
                         ->with('success', 'Cuatrimestre actualizado con éxito.');
    }

    /**
     * Desactiva lógicamente el registro.
     */
    public function destroy(Cuatrimestre $cuatrimestre)
    {
        // Desactivamos el cuatrimestre cambiando 'esta_activo' a FALSE
        $cuatrimestre->update(['esta_activo' => false]);

        return redirect()->route('cuatrimestres.index')
                         ->with('success', 'Cuatrimestre desactivado con éxito.');
    }
}
