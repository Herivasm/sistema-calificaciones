<h1>Registrar Nueva Materia</h1>

{{-- Muestra mensajes de error de validación --}}
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

<form action="{{ route('materias.store') }}" method="POST">
    @csrf

    <div>
        <strong>Nombre de la Materia:</strong>
        <input type="text" name="nombre" placeholder="Ej: Inglés Técnico" value="{{ old('nombre') }}" required>
    </div>

    {{-- MENÚ DE SELECCIÓN MÚLTIPLE DE CARRERAS (Relación Muchos a Muchos) --}}
    <div>
        <strong>Carreras Asociadas:</strong>
        <select name="carreras[]" multiple required>
            <option value="">Seleccione una o más Carreras</option>
            @foreach ($carreras as $carrera)
                {{-- Verifica si esta carrera fue seleccionada antes (si hay error de validación) --}}
                <option value="{{ $carrera->id }}"
                    {{ (is_array(old('carreras')) && in_array($carrera->id, old('carreras'))) ? 'selected' : '' }}>
                    {{ $carrera->nombre }}
                </option>
            @endforeach
        </select>
        <small>Mantén presionado Ctrl (Windows) / Cmd (Mac) para seleccionar varias carreras.</small>
        @if($carreras->isEmpty())
            <p style="color: red;">¡Error! No hay carreras registradas. Registre una primero.</p>
        @endif
    </div>

    <button type="submit">Guardar Materia</button>
</form>

<a href="{{ route('materias.index') }}">Volver al listado</a>
