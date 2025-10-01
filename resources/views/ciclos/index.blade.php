<h1>Gestión de Ciclos Escolares</h1>

<a href="{{ route('ciclos_escolares.create') }}">Crear Nuevo Ciclo</a>
<br><br>

@if ($message = Session::get('success'))
    <div style="color: green;">
        <p>{{ $message }}</p>
    </div>
@endif

@if($ciclos->isEmpty())
    <p>No hay Ciclos Escolares registrados.</p>
@else
    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Inicio</th>
                <th>Fin</th>
                <th>Activo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ciclos as $ciclo)
                <tr>
                    <td>{{ $ciclo->id }}</td>
                    <td>{{ $ciclo->nombre }}</td>
                    <td>{{ $ciclo->fecha_inicio }}</td>
                    <td>{{ $ciclo->fecha_fin }}</td>
                    {{-- Muestra un ícono o texto simple para el booleano --}}
                    <td>{{ $ciclo->esta_activo ? '✅ Sí' : '❌ No' }}</td>
                    <td>
                        <a href="#">Editar</a> | <a href="#">Eliminar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
