<h1>Editar Ciclo Escolar: {{ $ciclo->nombre }}</h1>

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

<form action="{{ route('ciclos.update', $ciclo) }}" method="POST">
    @csrf
    @method('PUT')

    <div>
        <strong>Nombre del Ciclo:</strong>
        <input type="text" name="nombre" value="{{ old('nombre', $ciclo->nombre) }}" required>
    </div>

    <div>
        <strong>Fecha de Inicio:</strong>
        <input type="date" name="fecha_inicio" value="{{ old('fecha_inicio', $ciclo->fecha_inicio) }}" required>
    </div>

    <div>
        <strong>Fecha de Fin:</strong>
        <input type="date" name="fecha_fin" value="{{ old('fecha_fin', $ciclo->fecha_fin) }}" required>
    </div>

    <div>
        <strong>Activo:</strong>
        <input type="checkbox" name="esta_activo" value="1" @checked(old('esta_activo', $ciclo->esta_activo))>
        <small>(Marcar esta opción desactivará todos los demás ciclos.)</small>
    </div>

    <button type="submit">Actualizar Ciclo</button>
</form>

<a href="{{ route('ciclos.index') }}">Volver al listado</a>

