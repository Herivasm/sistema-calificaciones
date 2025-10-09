<h1>Gestión de Carreras</h1>

<a href="{{ route('carreras.create') }}">Crear Nueva Carrera</a>
<br><br>

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
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($carreras as $carrera)
                <tr>
                    <td>{{ $carrera->id }}</td>
                    <td>{{ $carrera->nombre }}</td>
                    <td>{{ $carrera->descripcion }}</td>
                    <td>
                        {{-- Enlace EDITAR (Usa la ruta 'edit' con el ID de la carrera) --}}
                        <a href="{{ route('carreras.edit', $carrera->id) }}">Editar</a>

                        |

                        {{-- Formulario ELIMINAR (Usa la ruta 'destroy' con el método DELETE) --}}
                        <form action="{{ route('carreras.destroy', $carrera->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('¿Estás seguro de que quieres eliminar esta carrera? Esta acción podría eliminar alumnos y materias relacionadas.')" style="background:none; border:none; color:blue; cursor:pointer;">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif

