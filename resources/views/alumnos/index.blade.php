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
                    {{-- CORRECCIÓN CLAVE: Usamos los tres campos de nombre --}}
                    <td>{{ $alumno->nombre }} {{ $alumno->apellido_paterno }} {{ $alumno->apellido_materno }}</td>
                    <td>{{ $alumno->carrera->nombre }}</td>
                    <td>{{ $alumno->cicloEscolar->nombre }}</td>
                    <td>
                        {{-- Enlace EDITAR (usaremos la ruta 'edit' cuando la implementemos) --}}
                        <a href="{{ route('alumnos.edit', $alumno->id) }}">Editar</a>

                        |

                        {{-- Botón ELIMINAR (usaremos un formulario POST para la seguridad) --}}
                        <form action="#" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE') {{-- Método HTTP necesario para Laravel --}}
                            <button type="submit" onclick="return confirm('¿Estás seguro de que quieres eliminar a este alumno?')" style="background:none; border:none; color:blue; cursor:pointer;">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
```eof

Ahora que el listado de **Alumnos** es robusto y hemos corregido el esquema de nombres, podemos pasar a implementar las funciones de **Editar y Eliminar** (CRUD completo) para todos tus módulos, comenzando por **Carreras**. ¿Empezamos con la edición y eliminación?
