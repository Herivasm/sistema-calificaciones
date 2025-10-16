<h1>Editar Carrera: {{ $carrera->nombre }}</h1>

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

<form action="{{ route('carreras.update', $carrera) }}" method="POST">
    @csrf
    @method('PUT')

    <div>
        <strong>Nombre:</strong>
        <input type="text" name="nombre" value="{{ old('nombre', $carrera->nombre) }}" required>
    </div>

    <div>
        <strong>Descripción:</strong>
        <textarea name="descripcion">{{ old('descripcion', $carrera->descripcion) }}</textarea>
    </div>

    {{-- CORRECCIÓN CLAVE: CAMPO OCULTO para manejar el booleano --}}
    {{-- Si el checkbox no se marca, este campo hidden asegura que se envíe '0' (false) --}}
    <input type="hidden" name="esta_activo" value="0">

    <div>
        <strong>Estado Activo:</strong>
        <input type="checkbox" name="esta_activo" value="1" @checked(old('esta_activo', $carrera->esta_activo))>
    </div>

    <button type="submit">Actualizar Carrera</button>
</form>

<a href="{{ route('carreras.index') }}">Volver al listado</a>
