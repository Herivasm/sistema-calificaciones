<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grupo;
use App\Models\Materia;
use App\Models\Cuatrimestre;
use App\Models\Alumno;
use App\Models\Carrera;

class GrupoController extends Controller
{
    /**
     * Muestra la lista de todos los grupos.
     */
    public function index()
    {
        // Traemos todos los grupos (el índice debe mostrar el estado)
        $grupos = Grupo::with(['materia', 'cuatrimestre', 'carrera'])->get();
        return view('grupos.index', compact('grupos'));
    }

    /**
     * Muestra el formulario para crear un nuevo grupo.
     */
    public function create()
    {
        $materias = Materia::all();
        $cuatrimestres = Cuatrimestre::all();
        $carreras = Carrera::all();

        return view('grupos.create', compact('materias', 'cuatrimestres', 'carreras'));
    }

    /**
     * Guarda un nuevo grupo en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:255|unique:grupos',
            'materia_id' => 'required|exists:materias,id',
            'cuatrimestre_id' => 'required|exists:cuatrimestres,id',
            'carrera_id' => 'required|exists:carreras,id',
        ]);
        // CLAVE: El campo 'esta_activo' se establecerá a TRUE por defecto en el modelo/migración
        Grupo::create($request->all());

        return redirect()->route('grupos.index')
                         ->with('success', 'Grupo registrado con éxito. Ahora matricule alumnos.');
    }

    /**
     * Muestra la lista para matricular alumnos (Filtra por carrera).
     */
    public function show(string $id)
    {
        $grupo = Grupo::with(['materia', 'cuatrimestre', 'carrera', 'alumnos'])->findOrFail($id);

        // FILTRO CLAVE: Obtiene solo los alumnos que pertenecen a la Carrera de este Grupo
        $alumnos_disponibles = Alumno::where('carrera_id', $grupo->carrera_id)
                                     ->get();

        $alumnos_matriculados_ids = $grupo->alumnos->pluck('id')->toArray();

        return view('grupos.show', compact('grupo', 'alumnos_disponibles', 'alumnos_matriculados_ids'));
    }

    /**
     * Procesa la solicitud para asignar alumnos a un grupo.
     */
    public function assignStudents(Request $request, string $id)
    {
        $grupo = Grupo::findOrFail($id);

        $request->validate([
            'alumnos_ids' => 'nullable|array',
            'alumnos_ids.*' => 'exists:alumnos,id',
        ]);

        $grupo->alumnos()->sync($request->input('alumnos_ids', []));

        return redirect()->route('grupos.show', $grupo->id)
                         ->with('success', 'Alumnos matriculados en el grupo correctamente.');
    }

    /**
     * Muestra el formulario para editar un grupo específico.
     */
    public function edit(Grupo $grupo)
    {
        $carreras = Carrera::all();
        $materias = Materia::all();
        $cuatrimestres = Cuatrimestre::all();

        return view('grupos.edit', compact('grupo', 'carreras', 'materias', 'cuatrimestres'));
    }

    /**
     * Actualiza el grupo en la base de datos (Usado para Edición y Reactivación).
     */
    public function update(Request $request, Grupo $grupo)
    {
        $request->validate([
            'nombre' => 'required|max:255|unique:grupos,nombre,' . $grupo->id,
            'materia_id' => 'required|exists:materias,id',
            'cuatrimestre_id' => 'required|exists:cuatrimestres,id',
            'carrera_id' => 'required|exists:carreras,id',
            'esta_activo' => 'boolean', // Permite que el estado sea enviado
        ]);

        // 1. Preparar datos de actualización
        $data = $request->except(['_token', '_method']);
        $data['esta_activo'] = $request->boolean('esta_activo'); // CLAVE: Obtiene el estado del checkbox/hidden

        // 2. Actualización
        $grupo->update($data);

        return redirect()->route('grupos.index')
                         ->with('success', 'Grupo actualizado con éxito.');
    }

    /**
     * Desactiva (Elimina Suavemente) un grupo (usado por el botón 'Desactivar').
     */
    public function destroy(Grupo $grupo)
    {
        // Desactivamos el grupo cambiando 'esta_activo' a FALSE
        $grupo->update(['esta_activo' => false]);

        return redirect()->route('grupos.index')
                         ->with('success', 'Grupo desactivado con éxito.');
    }
}
