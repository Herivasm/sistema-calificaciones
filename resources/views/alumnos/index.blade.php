<h1>Gestión de Alumnos</h1>

<a href="{{ route('alumnos.create') }}">Registrar Nuevo Alumno</a>
<br><br>

@if ($message = Session::get('success'))
    <div style="color: green;">
        <p>{{ $message }}</p>
    </div>
@endif

@if($alumnos->isEmpty())
    <p>No hay alumnos registrados. <a href="{{ route('alumnos.create') }}">¡Registra el primero!</a></p>
@else
    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>Matrícula</th>
                <th>Nombre Completo</th>
                <th>Carrera</th>
                <th>Ciclo Escolar</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($alumnos as $alumno)
                <tr>
                    <td>{{ $alumno->matricula }}</td>
                    <td>{{ $alumno->nombre }} {{ $alumno->apellido }}</td>
                    <td>{{ $alumno->carrera->nombre }}</td>
                    <td>{{ $alumno->cicloEscolar->nombre }}</td>
                    <td>
                        <a href="#">Editar</a> | <a href="#">Eliminar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
