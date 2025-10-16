<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Carrera;
use App\Models\CicloEscolar;
use Illuminate\Http\Request;

class AlumnoController extends Controller
{
    /**
     * Muestra la lista de todos los alumnos (activos e inactivos).
     */
    public function index()
    {
        $alumnos = Alumno::with(['carrera', 'cicloEscolar'])->get();
        return view('alumnos.index', compact('alumnos'));
    }

    /**
     * Muestra el formulario para crear un nuevo alumno.
     */
    public function create()
    {
        $carreras = Carrera::all();
        // Solo mostramos ciclos activos para la matriculación
        $ciclos = CicloEscolar::where('esta_activo', true)->get();

        return view('alumnos.create', compact('carreras', 'ciclos'));
    }

    /**
     * Guarda un nuevo alumno en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido_paterno' => 'required|string|max:255',
            'apellido_materno' => 'nullable|string|max:255',
            'matricula' => 'required|unique:alumnos|max:20',
            'carrera_id' => 'required|exists:carreras,id',
            'ciclo_escolar_id' => 'required|exists:ciclo_escolars,id',
        ]);

        // Se crea con esta_activo = TRUE por defecto (según la migración)
        Alumno::create($request->all());

        return redirect()->route('alumnos.index')
                         ->with('success', 'Alumno registrado con éxito.');
    }

    public function show(string $id)
    {
        // No es necesario para el CRUD de gestión simple
    }

    /**
     * Muestra el formulario para editar un alumno específico.
     */
    public function edit(Alumno $alumno)
    {
        // Se necesitan todas las carreras y ciclos para los menús desplegables
        $carreras = Carrera::all();
        $ciclos = CicloEscolar::all();

        return view('alumnos.edit', compact('alumno', 'carreras', 'ciclos'));
    }

    /**
     * Actualiza el alumno en la base de datos (Usado para Edición y Reactivación).
     */
    public function update(Request $request, Alumno $alumno)
    {
        // Validación: Matricula debe ser única, excluyendo el alumno actual.
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido_paterno' => 'required|string|max:255',
            'apellido_materno' => 'nullable|string|max:255',
            'matricula' => 'required|max:20|unique:alumnos,matricula,' . $alumno->id,
            'carrera_id' => 'required|exists:carreras,id',
            'ciclo_escolar_id' => 'required|exists:ciclo_escolars,id',
            'esta_activo' => 'boolean', // Permite que el estado sea enviado
        ]);

        // 1. Preparar datos de actualización
        $data = $request->except(['_token', '_method']);
        // CLAVE: Obtenemos el valor booleano del estado del checkbox/hidden
        $data['esta_activo'] = $request->boolean('esta_activo');

        // 2. Actualización
        $alumno->update($data);

        return redirect()->route('alumnos.index')
                         ->with('success', 'Alumno actualizado con éxito.');
    }

    /**
     * Desactiva (Elimina Suavemente) un alumno (usado por el botón 'Desactivar').
     */
    public function destroy(Alumno $alumno)
    {
        // Desactivamos el alumno cambiando 'esta_activo' a FALSE
        $alumno->update(['esta_activo' => false]);

        return redirect()->route('alumnos.index')
                         ->with('success', 'Alumno desactivado con éxito.');
    }
}
