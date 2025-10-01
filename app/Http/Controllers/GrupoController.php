<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grupo;
use App\Models\Materia;
use App\Models\Cuatrimestre;

class GrupoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $grupos = Grupo::with(['materia', 'cuatrimestre'])->get();

        return view('grupos.index', compact('grupos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Obtenemos los datos para los menús desplegables
        $materias = Materia::all();
        $cuatrimestres = Cuatrimestre::all(); // Esta variable es correcta

        // ¡La corrección clave! Retornamos la vista y le pasamos las variables.
        return view('grupos.create', compact('materias', 'cuatrimestres'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
            'nombre' => 'required|max:255',
            // Verifica que los IDs existan
            'materia_id' => 'required|exists:materias,id',
            'cuatrimestre_id' => 'required|exists:cuatrimestres,id',
        ]);

        // 2. Creación del registro
        Grupo::create($request->all());

        // 3. Redirección con mensaje de éxito
        return redirect()->route('grupos.index')
                         ->with('success', 'Grupo registrado con éxito.');
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
