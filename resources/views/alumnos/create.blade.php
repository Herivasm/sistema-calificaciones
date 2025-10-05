<h1>Registrar Nuevo Alumno</h1>

@if ($errors->any())
    <div style="color: red;">
        <strong>¡Atención!</strong> Hubo problemas con tu registro.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('alumnos.store') }}" method="POST">
    @csrf

    <div>
        <strong>Nombre(s):</strong>
        <input type="text" name="nombre" value="{{ old('nombre') }}" required>
    </div>

    <div>
        <strong>Apellido Paterno:</strong>
        <input type="text" name="apellido_paterno" value="{{ old('apellido_paterno') }}" required>
    </div>

    <div>
        <strong>Apellido Materno:</strong>
        <input type="text" name="apellido_materno" value="{{ old('apellido_materno') }}">
    </div>

    <div>
        <strong>Matrícula:</strong>
        <input type="text" name="matricula" value="{{ old('matricula') }}" required>
    </div>

    {{-- CAMPO FECHA DE NACIMIENTO ELIMINADO --}}

    {{-- MENÚ DESPLEGABLE DE CARRERAS --}}
    <div>
        <strong>Carrera:</strong>
        <select name="carrera_id" required>
            <option value="">Seleccione una Carrera</option>
            @foreach ($carreras as $carrera)
                <option value="{{ $carrera->id }}" {{ old('carrera_id') == $carrera->id ? 'selected' : '' }}>
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
                <option value="{{ $ciclo->id }}" {{ old('ciclo_escolar_id') == $ciclo->id ? 'selected' : '' }}>
                    {{ $ciclo->nombre }}
                </option>
            @endforeach
        </select>
    </div>

    <button type="submit">Guardar Alumno</button>
</form>

<a href="{{ route('alumnos.index') }}">Volver al listado</a>
```eof

Con estos cambios, el formulario de registro de alumnos está limpio y cumple con los requisitos de la maestra.

Ahora sí, podemos pasar a implementar las funciones de **Editar y Eliminar (CRUD completo)** para el módulo de **Carreras**.
