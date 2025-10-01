<h1>Matriculación de Alumnos en Grupo: {{ $grupo->nombre }}</h1>
<p>Materia: {{ $grupo->materia->nombre }} | Cuatrimestre: {{ $grupo->cuatrimestre->nombre }}</p>

<a href="{{ route('grupos.index') }}">Volver al listado de Grupos</a>
<hr>

@if ($message = Session::get('success'))
    <div style="color: green;">
        <p>{{ $message }}</p>
    </div>
@endif

<h2>Alumnos Matriculados</h2>
<form action="{{ route('grupos.assign_students', $grupo->id) }}" method="POST">
    @csrf

    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>Matricular</th>
                <th>Matrícula</th>
                <th>Nombre Completo</th>
                <th>Carrera</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($alumnos_disponibles as $alumno)
                <tr>
                    <td>
                        {{-- El checkbox usa el array 'alumnos_ids[]' para enviar múltiples IDs --}}
                        <input type="checkbox" name="alumnos_ids[]" value="{{ $alumno->id }}"
                            {{-- Si el ID del alumno está en la lista de IDs matriculados, lo marcamos --}}
                            {{ in_array($alumno->id, $alumnos_matriculados_ids) ? 'checked' : '' }}>
                    </td>
                    <td>{{ $alumno->matricula }}</td>
                    <td>{{ $alumno->nombre }} {{ $alumno->apellido }}</td>
                    <td>{{ $alumno->carrera->nombre }}</td>
                </tr>
            @empty
                <tr><td colspan="4">No hay alumnos registrados para matricular.</td></tr>
            @endforelse
        </tbody>
    </table>

    <br>
    <button type="submit">Guardar Matrícula del Grupo</button>
</form>
