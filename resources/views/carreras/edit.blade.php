<h1>Editar Carrera: {{ $carrera->nombre }}</h1>

@if ($errors->any())
    <div style="color: red;">
        <strong>¡Atención!</strong> Hubo problemas al actualizar la carrera.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('carreras.update', $carrera->id) }}" method="POST">
    @csrf
    @method('PUT') {{-- NECESARIO para que Laravel reconozca esta petición como 'UPDATE' --}}

    < <div>
        <strong>Nombre de la Carrera:</strong>
        <input type="text" name="nombre" value="{{ old('nombre', $carrera->nombre) }}" required>
    </div>

    <div>
        <strong>Descripción de la Carrera:</strong> <input type="text" name="descripcion" value="{{ old('descripcion', $carrera->descripcion) }}">
    </div>

    <button type="submit">Actualizar Carrera</button>
</form>

<a href="{{ route('carreras.index') }}">Volver al listado</a>



