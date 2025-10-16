<h1>Listado de Carreras</h1>

<a href="{{ route('carreras.create') }}">Crear Nueva Carrera</a>

@if ($message = Session::get('success'))
    <div style="color: green;">
        <p>{{ $message }}</p>
    </div>
@endif

<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($carreras as $carrera)
            <tr>
                <td>{{ $carrera->id }}</td>
                <td>{{ $carrera->nombre }}</td>
                <td>{{ $carrera->descripcion }}</td>

                {{-- Muestra el estado --}}
                <td>
                    @if ($carrera->esta_activo)
                        <span style="color: green;">✅ Activa</span>
                    @else
                        <span style="color: red;">❌ Desactivada</span>
                    @endif
                </td>

                <td>
                    <a href="{{ route('carreras.edit', $carrera->id) }}">Editar</a>
                    |

                    @if ($carrera->esta_activo)
                        {{-- Opción para DESACTIVAR (usa el método DELETE/destroy) --}}
                        <form action="{{ route('carreras.destroy', $carrera->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('¿Estás seguro de que quieres DESACTIVAR esta carrera?')" style="background:none; border:none; color:red; cursor:pointer;">Desactivar</button>
                        </form>
                    @else
                        {{-- Opción para REACTIVAR (usa el método PUT/update para cambiar el estado) --}}
                        <form action="{{ route('carreras.update', $carrera->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PUT')
                            {{-- CORRECCIÓN CLAVE: Campos ocultos para pasar la validación --}}
                            <input type="hidden" name="esta_activo" value="1">
                            <input type="hidden" name="nombre" value="{{ $carrera->nombre }}">
                            <input type="hidden" name="descripcion" value="{{ $carrera->descripcion }}">

                            <button type="submit" onclick="return confirm('¿Estás seguro de que quieres REACTIVAR esta carrera?')" style="background:none; border:none; color:blue; cursor:pointer;">Reactivar</button>
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
