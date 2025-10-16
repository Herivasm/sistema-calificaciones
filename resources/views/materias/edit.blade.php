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

    {{-- CAMPO OCULTO (CLAVE): Asegura que se envíe '0' si el checkbox no está marcado --}}
    <input type="hidden" name="esta_activo" value="0">

    <div>
        <strong>Activo:</strong>
        <input type="checkbox" name="esta_activo" value="1" @checked(old('esta_activo', $materia->esta_activo))>
    </div>

    <hr>

    {{-- MENÚ DE SELECCIÓN MÚLTIPLE DE CARRERAS --}}
    <div>
        <strong>Carreras Asociadas:</strong>
        <select name="carreras[]" multiple required>
            {{-- Obtener los IDs de las carreras asociadas a esta materia --}}
            @php
                $currentCarreraIds = old('carreras') ?: $materia->carreras->pluck('id')->toArray();
            @endphp

            @foreach ($carreras as $carrera)
                <option value="{{ $carrera->id }}"
                    {{-- Marcar la opción si el ID está en el array de carreras asociadas --}}
                    @if (in_array($carrera->id, $currentCarreraIds))
                        selected
                    @endif
                >
                    {{ $carrera->nombre }}
                </option>
            @endforeach
        </select>
        <small>Ctrl (Windows) / Cmd (Mac) para seleccionar varias.</small>
    </div>

    <button type="submit">Actualizar Materia</button>
</form>

<a href="{{ route('materias.index') }}">Volver al listado</a>
