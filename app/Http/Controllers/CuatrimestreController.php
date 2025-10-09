<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cuatrimestre;
class CuatrimestreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $cuatrimestres = Cuatrimestre::all();
        return view('cuatrimestres.index', compact('cuatrimestres'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cuatrimestres.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       // Validación CORREGIDA: Incluye las fechas
        $request->validate([
            'nombre' => 'required|unique:cuatrimestres|max:255',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after:fecha_inicio', // Asegura que la fecha final sea posterior
            'esta_activo' => 'boolean',
        ]);

        $cuatrimestre = Cuatrimestre::create($request->all());

        // Lógica de activación (Solo uno activo)
        if ($request->has('esta_activo') && $request->esta_activo) {
            Cuatrimestre::where('id', '!=', $cuatrimestre->id)
                        ->update(['esta_activo' => false]);
        }

        return redirect()->route('cuatrimestres.index')
                         ->with('success', 'Cuatrimestre registrado con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
     public function edit(Cuatrimestre $cuatrimestre)
    {
        return view('cuatrimestres.edit', compact('cuatrimestre'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cuatrimestre $cuatrimestre)
    {
        // Validación
        $request->validate([
            'nombre' => 'required|max:255|unique:cuatrimestres,nombre,' . $cuatrimestre->id,
            'esta_activo' => 'boolean', // Solo validamos que sea booleano
        ]);

        $cuatrimestre->update($request->all());

        // LÓGICA CLAVE: NO DESACTIVAMOS A OTROS. Se permite que varios estén activos.

        return redirect()->route('cuatrimestres.index')
                         ->with('success', 'Cuatrimestre actualizado con éxito.');
    }


    /**
     * Remove the specified resource from storage.
     */
   public function destroy(Cuatrimestre $cuatrimestre)
    {
        $cuatrimestre->delete();

        return redirect()->route('cuatrimestres.index')
                         ->with('success', 'Cuatrimestre eliminado con éxito.');
    }
}
