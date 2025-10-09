<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carrera;

class CarreraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
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
            // La validación 'clave' ha sido eliminada aquí.
            'descripcion' => 'nullable',
        ]);

        // 2. Creación del registro
        Carrera::create($request->all());

        // 3. Redirección con mensaje de éxito
        return redirect()->route('carreras.index')
                         ->with('success', 'Carrera registrada con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
         return redirect()->route('carreras.index')->with('success', 'Carrera registrada con éxito.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Carrera $carrera)
{

        return view('carreras.edit', compact('carrera'));
}
    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, Carrera $carrera)
    {
        $request->validate([
            // CORREGIDO: Usando descripcion en la validación
            'nombre' => 'required|max:255|unique:carreras,nombre,' . $carrera->id,
            'descripcion' => 'nullable|max:255',
        ]);

        $carrera->update($request->all());

        return redirect()->route('carreras.index')
                         ->with('success', 'Carrera actualizada con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Carrera $carrera)
{
    // Esto funciona porque ya configuramos la tabla de alumnos para 'onDelete('cascade')'
    // en la migración, lo cual ayuda a evitar errores de claves foráneas.
    $carrera->delete();

    return redirect()->route('carreras.index')
                     ->with('success', 'Carrera eliminada con éxito.');
}
}
