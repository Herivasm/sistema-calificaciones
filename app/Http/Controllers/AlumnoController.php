<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Carrera;
use App\Models\CicloEscolar;
use Illuminate\Http\Request;

class AlumnoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $alumnos = Alumno::with(['carrera', 'cicloEscolar'])->get();

        return view('alumnos.index', compact('alumnos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $carreras = Carrera::all();
        $ciclos = CicloEscolar::where('esta_activo', true)->get();

        return view('alumnos.create', compact('carreras', 'ciclos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido_paterno' => 'required|string|max:255',
            'apellido_materno' => 'nullable|string|max:255',
            'matricula' => 'required|unique:alumnos|max:20',
            // 'fecha_nacimiento' ELIMINADO de la validación
            'carrera_id' => 'required|exists:carreras,id',
            'ciclo_escolar_id' => 'required|exists:ciclo_escolars,id',
        ]);

        Alumno::create($request->all());

        return redirect()->route('alumnos.index')
                         ->with('success', 'Alumno registrado con éxito.');
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
