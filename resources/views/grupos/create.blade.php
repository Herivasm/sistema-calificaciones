<h1>Crear Nuevo Grupo</h1>

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

<form action="{{ route('grupos.store') }}" method="POST">
    @csrf

    <div>
        <strong>Nombre del Grupo:</strong>
        <input type="text" name="nombre" placeholder="Ej: G-ISC-2A" value="{{ old('nombre') }}" required>
    </div>

    {{-- MENÚ MATERIAS --}}
    <div>
        <strong>Materia:</strong>
        <select name="materia_id" required>
            <option value="">Seleccione una Materia</option>
            @foreach ($materias as $materia)
                <option value="{{ $materia->id }}" {{ old('materia_id') == $materia->id ? 'selected' : '' }}>
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
                <option value="{{ $cuatrimestre->id }}" {{ old('cuatrimestre_id') == $cuatrimestre->id ? 'selected' : '' }}>
                    {{ $cuatrimestre->nombre }}
                </option>
            @endforeach
        </select>
    </div>

    <button type="submit">Guardar Grupo</button>
</form>

<a href="{{ route('grupos.index') }}">Volver al listado</a>
