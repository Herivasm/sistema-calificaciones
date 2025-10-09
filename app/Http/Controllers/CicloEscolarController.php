<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CicloEscolar;

class CicloEscolarController extends Controller
{
    /**
     * Muestra la lista de todos los ciclos escolares.
     */
    public function index()
    {
        $ciclos = CicloEscolar::all();
        return view('ciclos.index', compact('ciclos'));
    }

    /**
     * Muestra el formulario para crear un nuevo ciclo escolar.
     */
    public function create()
    {
        return view('ciclos.create');
    }

    /**
     * Guarda un nuevo ciclo escolar en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|unique:ciclo_escolars|max:255',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after:fecha_inicio',
            'esta_activo' => 'boolean',
        ]);

        $ciclo = CicloEscolar::create($request->all());

        // Lógica de activación: Si se marca activo, desactiva a todos los demás.
        if ($request->has('esta_activo') && $request->esta_activo) {
            CicloEscolar::where('id', '!=', $ciclo->id)
                        ->update(['esta_activo' => false]);
        }

        return redirect()->route('ciclos.index')
                         ->with('success', 'Ciclo Escolar registrado con éxito.');
    }

    /**
     * Muestra el formulario para editar un ciclo escolar específico.
     * CORRECCIÓN: Usa $ciclo para Route Model Binding.
     */
    public function edit(CicloEscolar $ciclo)
    {
        // Pasa la instancia $ciclo a la vista
        return view('ciclos.edit', compact('ciclo'));
    }

    /**
     * Actualiza el registro de ciclo escolar en la base de datos.
     * CORRECCIÓN: Recibe $ciclo.
     */
    public function update(Request $request, CicloEscolar $ciclo)
    {
        // 1. Validación (Usando $ciclo->id para ignorar el registro actual)
        $request->validate([
            'nombre' => 'required|max:255|unique:ciclo_escolars,nombre,' . $ciclo->id,
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after:fecha_inicio',
            'esta_activo' => 'boolean',
        ]);

        // 2. Actualización del registro
        $ciclo->update($request->all());

        // 3. Lógica de activación (Si lo marcan como activo, desactiva a los demás)
        if ($request->has('esta_activo') && $request->esta_activo) {
            CicloEscolar::where('id', '!=', $ciclo->id)
                        ->update(['esta_activo' => false]);
        }

        return redirect()->route('ciclos.index')
                         ->with('success', 'Ciclo Escolar actualizado con éxito.');
    }

    /**
     * Elimina el registro de ciclo escolar.
     * CORRECCIÓN: Recibe $ciclo.
     */
    public function destroy(CicloEscolar $ciclo)
    {
        $ciclo->delete();

        return redirect()->route('ciclos.index')
                         ->with('success', 'Ciclo Escolar eliminado con éxito.');
    }
}
