<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grupo;
use App\Models\Materia;
use App\Models\Cuatrimestre;
use App\Models\Alumno;
use App\Models\Carrera; // ¡Nueva importación necesaria para la lógica de Carrera!

class GrupoController extends Controller
{
    /**
     * Muestra la lista de todos los grupos.
     */
    public function index()
    {
        // Precarga todas las relaciones, incluyendo la nueva relación 'carrera'
        $grupos = Grupo::with(['materia', 'cuatrimestre', 'carrera'])->get();

        return view('grupos.index', compact('grupos'));
    }

    /**
     * Muestra el formulario para crear un nuevo grupo.
     */
    public function create()
    {
        // Obtenemos los datos para los menús desplegables, incluyendo Carreras
        $materias = Materia::all();
        $cuatrimestres = Cuatrimestre::all();
        $carreras = Carrera::all(); // Nueva variable para el menú de carrera

        return view('grupos.create', compact('materias', 'cuatrimestres', 'carreras'));
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
            'carrera_id' => 'required|exists:carreras,id', // Nueva validación de carrera
        ]);

        Grupo::create($request->all());

        return redirect()->route('grupos.index')
                         ->with('success', 'Grupo registrado con éxito. Ahora matricule alumnos.');
    }

    /**
     * Muestra la información de un grupo específico y la lista para matricular alumnos.
     * Esto se usa para el formulario de Matricular, donde se aplica el filtro por carrera.
     */
    public function show(string $id)
    {
        // Precarga todas las relaciones
        $grupo = Grupo::with(['materia', 'cuatrimestre', 'carrera', 'alumnos'])->findOrFail($id);

        // FILTRO CLAVE: Obtiene solo los alumnos que pertenecen a la Carrera de este Grupo
        $alumnos_disponibles = Alumno::where('carrera_id', $grupo->carrera_id)
                                    ->get();

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
            'alumnos_ids.*' => 'exists:alumnos,id',
        ]);

        // 2. Sincronizar la Matrícula (Actualizar la tabla pivote 'alumno_grupo')
        $grupo->alumnos()->sync($request->input('alumnos_ids', []));

        return redirect()->route('grupos.show', $grupo->id)
                         ->with('success', 'Alumnos matriculados en el grupo correctamente.');
    }

    /**
     * El resto de métodos (edit, update, destroy) se implementarán más tarde.
     */
      public function edit(Grupo $grupo)
    {
        // Necesitas todas las Carreras, Materias y Cuatrimestres para los menús desplegables
        $carreras = Carrera::all();
        $materias = Materia::all();
        $cuatrimestres = Cuatrimestre::all();

        return view('grupos.edit', compact('grupo', 'carreras', 'materias', 'cuatrimestres'));
    }
    public function update(Request $request, Grupo $grupo)
    {
        // Validación: El nombre debe ser único, excluyendo el grupo actual
        $request->validate([
            'nombre' => 'required|max:255|unique:grupos,nombre,' . $grupo->id,
            'materia_id' => 'required|exists:materias,id',
            'cuatrimestre_id' => 'required|exists:cuatrimestres,id',
            'carrera_id' => 'required|exists:carreras,id',
        ]);

        $grupo->update($request->all());

        return redirect()->route('grupos.index')
                         ->with('success', 'Grupo actualizado con éxito.');
    }
      public function destroy(Grupo $grupo)
    {
        // Esto elimina el grupo y, gracias a la configuración de la tabla pivote,
        // también elimina todas las matrículas asociadas en alumno_grupo.
        $grupo->delete();

        return redirect()->route('grupos.index')
                         ->with('success', 'Grupo eliminado con éxito.');
    }
}
