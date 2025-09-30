<h1>Registrar Nueva Carrera</h1>

{{-- Muestra mensajes de error de validación --}}
@if ($errors->any())
    <div>
        <strong>¡Atención!</strong> Hubo problemas con tu registro.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('carreras.store') }}" method="POST">
    @csrf {{-- Token de seguridad de Laravel --}}

    <div>
        <strong>Nombre:</strong>
        <input type="text" name="nombre" placeholder="Ej: Ingeniería en Software" value="{{ old('nombre') }}" required>
    </div>

    {{-- El campo 'Clave' fue eliminado de aquí --}}

    <div>
        <strong>Descripción:</strong>
        <textarea name="descripcion" placeholder="Descripción de la carrera">{{ old('descripcion') }}</textarea>
    </div>

    <button type="submit">Guardar Carrera</button>
</form>

<a href="{{ route('carreras.index') }}">Volver al listado</a>
