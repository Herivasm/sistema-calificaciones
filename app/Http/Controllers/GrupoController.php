<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grupo;
use App\Models\Materia;
use App\Models\Cuatrimestre;
use App\Models\Alumno; // ¡Necesario para la Matriculación!

class GrupoController extends Controller
{
    /**
     * Muestra la lista de todos los grupos.
     */
    public function index()
    {
        $grupos = Grupo::with(['materia', 'cuatrimestre'])->get();

        return view('grupos.index', compact('grupos'));
    }

    /**
     * Muestra el formulario para crear un nuevo grupo.
     */
    public function create()
    {
        // Obtenemos los datos para los menús desplegables
        $materias = Materia::all();
        $cuatrimestres = Cuatrimestre::all();

        return view('grupos.create', compact('materias', 'cuatrimestres'));
    }

    /**
     * Guarda un nuevo grupo en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:255',
            'materia_id' => 'required|exists:materias,id',
            'cuatrimestre_id' => 'required|exists:cuatrimestres,id',
        ]);

        Grupo::create($request->all());

        return redirect()->route('grupos.index')
                         ->with('success', 'Grupo registrado con éxito. Ahora matricule alumnos.');
    }

    /**
     * Muestra la información de un grupo específico y la lista para matricular alumnos.
     * Esto se usa para el formulario de Matricular.
     */
    public function show(string $id)
    {
        // Precarga alumnos, materia y cuatrimestre
        $grupo = Grupo::with(['materia', 'cuatrimestre', 'alumnos'])->findOrFail($id);

        // Obtener todos los alumnos disponibles para la lista de checkboxes
        $alumnos_disponibles = Alumno::with('carrera')->get();

        // IDs de los alumnos actualmente matriculados
        $alumnos_matriculados_ids = $grupo->alumnos->pluck('id')->toArray();

        return view('grupos.show', compact('grupo', 'alumnos_disponibles', 'alumnos_matriculados_ids'));
    }

    /**
     * Procesa la solicitud para asignar alumnos a un grupo (Guardar Matrícula).
     */
    public function assignStudents(Request $request, string $id)
    {
        $grupo = Grupo::findOrFail($id);

        // 1. Validar la lista de alumnos a asignar
        $request->validate([
            'alumnos_ids' => 'nullable|array',
            'alumnos_ids.*' => 'exists:alumnos,id', // Asegura que los IDs existen
        ]);

        // 2. Sincronizar la Matrícula (Actualizar la tabla pivote 'alumno_grupo')
        // sync() borra la lista anterior y guarda la nueva
        $grupo->alumnos()->sync($request->input('alumnos_ids', []));

        return redirect()->route('grupos.show', $grupo->id)
                         ->with('success', 'Alumnos matriculados en el grupo correctamente.');
    }

    /**
     * El resto de métodos (edit, update, destroy) se implementarán más tarde.
     */
     public function edit(string $id) { /* ... */ }
     public function update(Request $request, string $id) { /* ... */ }
     public function destroy(string $id) { /* ... */ }
}
