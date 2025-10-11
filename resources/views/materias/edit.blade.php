<h1>Editar Materia: {{ $materia->nombre }}</h1>

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

<form action="{{ route('materias.update', $materia) }}" method="POST">
    @csrf
    @method('PUT')

    <div>
        <strong>Nombre de la Materia:</strong>
        <input type="text" name="nombre" value="{{ old('nombre', $materia->nombre) }}" required>
    </div>

    {{-- MENÚ DE SELECCIÓN MÚLTIPLE DE CARRERAS --}}
    <div>
        <strong>Carreras Asociadas:</strong>
        <select name="carreras[]" multiple required>
            @foreach ($carreras as $carrera)
                <option value="{{ $carrera->id }}"
                    {{-- CLAVE: Comprueba si la materia ya tiene esta carrera asignada --}}
                    @if (old('carreras') ? in_array($carrera->id, old('carreras')) : $materia->carreras->contains($carrera->id))
                        selected
                    @endif
                >
                    {{ $carrera->nombre }}
                </option>
            @endforeach
        </select>
        <small>Mantén presionado Ctrl (Windows) / Cmd (Mac) para seleccionar varias carreras.</small>
    </div>

    <button type="submit">Actualizar Materia</button>
</form>

<a href="{{ route('materias.index') }}">Volver al listado</a>
