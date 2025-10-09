<h1>Gestión de Cuatrimestres</h1>

<a href="{{ route('cuatrimestres.create') }}">Crear Nuevo Cuatrimestre</a>
<br><br>

@if ($message = Session::get('success'))
    <div style="color: green;">
        <p>{{ $message }}</p>
    </div>
@endif

@if(empty($cuatrimestres))
    <p>No hay cuatrimestres registrados.</p>
@else
    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Inicio</th>
                <th>Fin</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cuatrimestres as $cuatrimestre)
                <tr>
                    <td>{{ $cuatrimestre->id }}</td>
                    <td>{{ $cuatrimestre->nombre }}</td>
                    <td>{{ $cuatrimestre->fecha_inicio }}</td>
                    <td>{{ $cuatrimestre->fecha_fin }}</td>
                    <td>{{ $cuatrimestre->esta_activo ? '✅ Activo' : '❌ Inactivo' }}</td>
                    <td>
                        <a href="{{ route('cuatrimestres.edit', $cuatrimestre->id) }}">Editar</a> | <a href="#">Eliminar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
