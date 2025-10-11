<h1>Editar Grupo: {{ $grupo->nombre }}</h1>

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

<form action="{{ route('grupos.update', $grupo) }}" method="POST">
    @csrf
    @method('PUT')

    <div>
        <strong>Nombre del Grupo:</strong>
        <input type="text" name="nombre" value="{{ old('nombre', $grupo->nombre) }}" required>
    </div>

    {{-- MENÚ DE CARRERAS --}}
    <div>
        <strong>Carrera del Grupo:</strong>
        <select name="carrera_id" required>
            <option value="">Seleccione la Carrera</option>
            @foreach ($carreras as $carrera)
                <option value="{{ $carrera->id }}" @selected(old('carrera_id', $grupo->carrera_id) == $carrera->id)>
                    {{ $carrera->nombre }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- MENÚ MATERIAS --}}
    <div>
        <strong>Materia:</strong>
        <select name="materia_id" required>
            <option value="">Seleccione una Materia</option>
            @foreach ($materias as $materia)
                <option value="{{ $materia->id }}" @selected(old('materia_id', $grupo->materia_id) == $materia->id)>
                    {{ $materia->nombre }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- MENÚ CUATRIMESTRES --}}
    <div>
        <strong>Cuatrimestre:</strong>
        <select name="cuatrimestre_id" required>
            <option value="">Seleccione un Cuatrimestre</option>
            @foreach ($cuatrimestres as $cuatrimestre)
                <option value="{{ $cuatrimestre->id }}" @selected(old('cuatrimestre_id', $grupo->cuatrimestre_id) == $cuatrimestre->id)>
                    {{ $cuatrimestre->nombre }}
                </option>
            @endforeach
        </select>
    </div>

    <button type="submit">Actualizar Grupo</button>
</form>

<a href="{{ route('grupos.index') }}">Volver al listado</a>
