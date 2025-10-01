<h1>Gestión de Grupos</h1>

<a href="{{ route('grupos.create') }}">Crear Nuevo Grupo</a>
<br><br>

@if ($message = Session::get('success'))
    <div style="color: green;">
        <p>{{ $message }}</p>
    </div>
@endif

@if($grupos->isEmpty())
    <p>No hay grupos registrados.</p>
@else
    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre del Grupo</th>
                <th>Materia</th>
                <th>Cuatrimestre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($grupos as $grupo)
                <tr>
                    <td>{{ $grupo->id }}</td>
                    <td>{{ $grupo->nombre }}</td>
                    {{-- Usamos las relaciones belongsTo --}}
                    <td>{{ $grupo->materia->nombre }}</td>
                    <td>{{ $grupo->cuatrimestre->nombre }}</td>
                    <td>
                        {{-- La acción clave: Matricular Alumnos --}}
                        <a href="{{ route('grupos.show', $grupo->id) }}">Matricular</a> | <a href="#">Editar</a> | <a href="#">Eliminar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
