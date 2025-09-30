<h1>Gestión de Carreras</h1>

{{-- Botón para ir al formulario de creación --}}
<a href="{{ route('carreras.create') }}">Crear Nueva Carrera</a>
<br><br>

{{-- Muestra el mensaje de éxito (si viene de la función store) --}}
@if ($message = Session::get('success'))
    <div style="color: green;">
        <p>{{ $message }}</p>
    </div>
@endif

@if($carreras->isEmpty())
    <p>No hay carreras registradas.</p>
@else
    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                {{-- La columna 'Clave' fue eliminada de aquí --}}
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($carreras as $carrera)
                <tr>
                    <td>{{ $carrera->id }}</td>
                    <td>{{ $carrera->nombre }}</td>
                    <td>
                        {{-- Aquí irán los botones de Editar y Eliminar --}}
                        <a href="#">Editar</a> | <a href="#">Eliminar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
