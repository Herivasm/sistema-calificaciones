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
                <th>Nombre del Grupo</th>
                <th>Carrera</th>  {{-- NUEVO --}}
                <th>Materia</th>
                <th>Cuatrimestre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($grupos as $grupo)
                <tr>
                    <td>{{ $grupo->nombre }}</td>
                    <td>{{ $grupo->carrera->nombre }}</td>  {{-- Muestra la carrera --}}
                    <td>{{ $grupo->materia->nombre }}</td>
                    <td>{{ $grupo->cuatrimestre->nombre }}</td>
                    <td>
                        <a href="{{ route('grupos.show', $grupo->id) }}">Matricular</a> |
                        <a href="{{ route('grupos.edit', $grupo->id) }}">Editar</a>| <a href="#">Eliminar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
