<h1>Registrar Nuevo Ciclo Escolar</h1>

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

<form action="{{ route('ciclos_escolares.store') }}" method="POST">
    @csrf

    <div>
        <strong>Nombre del Ciclo:</strong>
        <input type="text" name="nombre" placeholder="Ej: 2024-2025" value="{{ old('nombre') }}" required>
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
        <strong>Activo:</strong>
        {{-- Laravel interpreta el checkbox si está presente (on) o no (off/null) --}}
        <input type="checkbox" name="esta_activo" value="1" {{ old('esta_activo') ? 'checked' : '' }}>
    </div>

    <button type="submit">Guardar Ciclo</button>
</form>

<a href="{{ route('ciclos_escolares.index') }}">Volver al listado</a>
