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
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($alumnos as $alumno)
                <tr>
                    <td>{{ $alumno->matricula }}</td>
                    {{-- Muestra los tres campos de nombre --}}
                    <td>{{ $alumno->nombre }} {{ $alumno->apellido_paterno }} {{ $alumno->apellido_materno }}</td>
                    <td>{{ $alumno->carrera->nombre }}</td>
                    <td>{{ $alumno->cicloEscolar->nombre }}</td>

                    {{-- Muestra el estado --}}
                    <td>
                        @if ($alumno->esta_activo)
                            <span style="color: green;">✅ Activo</span>
                        @else
                            <span style="color: red;">❌ Desactivado</span>
                        @endif
                    </td>

                    <td>
                        <a href="{{ route('alumnos.edit', $alumno->id) }}">Editar</a>
                        |

                        @if ($alumno->esta_activo)
                            {{-- Opción para DESACTIVAR --}}
                            <form action="{{ route('alumnos.destroy', $alumno->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('¿Quieres DESACTIVAR a este alumno?')" style="background:none; border:none; color:red; cursor:pointer;">Desactivar</button>
                            </form>
                        @else
                            {{-- Opción para REACTIVAR --}}
                            <form action="{{ route('alumnos.update', $alumno->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PUT')
                                {{-- Campos ocultos para pasar la validación y reactivar --}}
                                <input type="hidden" name="esta_activo" value="1">
                                <input type="hidden" name="nombre" value="{{ $alumno->nombre }}">
                                <input type="hidden" name="apellido_paterno" value="{{ $alumno->apellido_paterno }}">
                                <input type="hidden" name="apellido_materno" value="{{ $alumno->apellido_materno }}">
                                <input type="hidden" name="matricula" value="{{ $alumno->matricula }}">
                                <input type="hidden" name="carrera_id" value="{{ $alumno->carrera_id }}">
                                <input type="hidden" name="ciclo_escolar_id" value="{{ $alumno->ciclo_escolar_id }}">

                                <button type="submit" onclick="return confirm('¿Quieres REACTIVAR a este alumno?')" style="background:none; border:none; color:blue; cursor:pointer;">Reactivar</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
