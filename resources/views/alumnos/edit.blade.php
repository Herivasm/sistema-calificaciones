<h1>Editar Alumno: {{ $alumno->nombre }} {{ $alumno->apellido_paterno }}</h1>

@if ($errors->any())
    <div style="color: red;">
        <strong>¡Atención!</strong> Hubo problemas al actualizar.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('alumnos.update', $alumno) }}" method="POST">
    @csrf
    @method('PUT') {{-- NECESARIO para que Laravel reconozca esta petición como 'UPDATE' --}}

    <div>
        <strong>Nombre(s):</strong>
        <input type="text" name="nombre" value="{{ old('nombre', $alumno->nombre) }}" required>
    </div>

    <div>
        <strong>Apellido Paterno:</strong>
        <input type="text" name="apellido_paterno" value="{{ old('apellido_paterno', $alumno->apellido_paterno) }}" required>
    </div>

    <div>
        <strong>Apellido Materno:</strong>
        <input type="text" name="apellido_materno" value="{{ old('apellido_materno', $alumno->apellido_materno) }}">
    </div>

    <div>
        <strong>Matrícula:</strong>
        <input type="text" name="matricula" value="{{ old('matricula', $alumno->matricula) }}" required>
    </div>

    {{-- MENÚ DESPLEGABLE DE CARRERAS --}}
    <div>
        <strong>Carrera:</strong>
        <select name="carrera_id" required>
            <option value="">Seleccione una Carrera</option>
            @foreach ($carreras as $carrera)
                <option value="{{ $carrera->id }}"
                    {{-- @selected se asegura de que la opción del alumno esté seleccionada --}}
                    @selected(old('carrera_id', $alumno->carrera_id) == $carrera->id)>
                    {{ $carrera->nombre }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- MENÚ DESPLEGABLE DE CICLOS --}}
    <div>
        <strong>Ciclo Escolar:</strong>
        <select name="ciclo_escolar_id" required>
            <option value="">Seleccione un Ciclo</option>
            @foreach ($ciclos as $ciclo)
                <option value="{{ $ciclo->id }}"
                    @selected(old('ciclo_escolar_id', $alumno->ciclo_escolar_id) == $ciclo->id)>
                    {{ $ciclo->nombre }}
                </option>
            @endforeach
        </select>
    </div>

    <button type="submit">Actualizar Alumno</button>
</form>

<a href="{{ route('alumnos.index') }}">Volver al listado</a>
