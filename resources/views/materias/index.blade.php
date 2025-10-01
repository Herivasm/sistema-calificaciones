<h1>Gestión de Materias</h1>

<a href="{{ route('materias.create') }}">Registrar Nueva Materia</a>
<br><br>

{{-- Muestra el mensaje de éxito --}}
@if ($message = Session::get('success'))
    <div style="color: green;">
        <p>{{ $message }}</p>
    </div>
@endif

@if($materias->isEmpty())
    <p>No hay materias registradas. <a href="{{ route('materias.create') }}">¡Registra la primera!</a></p>
@else
    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Asignada a Carreras</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($materias as $materia)
                <tr>
                    <td>{{ $materia->id }}</td>
                    <td>{{ $materia->nombre }}</td>
                    <td>
                        {{-- Itera sobre la colección de carreras relacionadas (Relación Muchos a Muchos) --}}
                        @forelse($materia->carreras as $carrera)
                            <span style="border: 1px solid #ccc; padding: 2px; margin-right: 5px; display: inline-block;">
                                {{ $carrera->nombre }}
                            </span>
                        @empty
                            <span style="color: gray;">Sin asignación.</span>
                        @endforelse
                    </td>
                    <td>
                        <a href="#">Editar</a> |
                        <a href="#">Eliminar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
