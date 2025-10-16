<h1>Editar Cuatrimestre: {{ $cuatrimestre->nombre }}</h1>

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

<form action="{{ route('cuatrimestres.update', $cuatrimestre) }}" method="POST">
    @csrf
    @method('PUT')

    <div>
        <strong>Nombre del Cuatrimestre:</strong>
        <input type="text" name="nombre" value="{{ old('nombre', $cuatrimestre->nombre) }}" required>
    </div>

    <div>
        <strong>Fecha de Inicio:</strong>
        <input type="date" name="fecha_inicio" value="{{ old('fecha_inicio', $cuatrimestre->fecha_inicio) }}" required>
    </div>

    <div>
        <strong>Fecha de Fin:</strong>
        <input type="date" name="fecha_fin" value="{{ old('fecha_fin', $cuatrimestre->fecha_fin) }}" required>
    </div>

    {{-- CAMPO OCULTO (CLAVE): Asegura que se envíe '0' si el checkbox no está marcado --}}
    <input type="hidden" name="esta_activo" value="0">

    <div>
        <strong>Activo:</strong>
        <input type="checkbox" name="esta_activo" value="1" @checked(old('esta_activo', $cuatrimestre->esta_activo))>
    </div>

    <button type="submit">Actualizar Cuatrimestre</button>
</form>

<a href="{{ route('cuatrimestres.index') }}">Volver al listado</a>
