<h1>Registrar Nuevo Cuatrimestre</h1>

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

<form action="{{ route('cuatrimestres.store') }}" method="POST">
    @csrf

    <div>
        <strong>Nombre:</strong>
        <input type="text" name="nombre" placeholder="Ej: Enero-Abril 2026" value="{{ old('nombre') }}" required>
    </div>

    <div>
        <strong>Fecha de Inicio:</strong>
        <input type="date" name="fecha_inicio" value="{{ old('fecha_inicio') }}" required>
    </div>

    <div>
        <strong>Fecha de Fin:</strong>
        <input type="date" name="fecha_fin" value="{{ old('fecha_fin') }}" required>
    </div>

    <div>
        <strong>Activo (Cuatrimestre Actual):</strong>
        <input type="checkbox" name="esta_activo" value="1" {{ old('esta_activo') ? 'checked' : '' }}>
        <small>(Si marcas esta opción, los demás cuatrimestres se desactivarán.)</small>
    </div>

    <button type="submit">Guardar Cuatrimestre</button>
</form>

<a href="{{ route('cuatrimestres.index') }}">Volver al listado</a>
