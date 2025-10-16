<h1>Gestión de Cuatrimestres</h1>

<a href="{{ route('cuatrimestres.create') }}">Crear Nuevo Cuatrimestre</a>
<br><br>

@if ($message = Session::get('success'))
    <div style="color: green;">
        <p>{{ $message }}</p>
    </div>
@endif

@if($cuatrimestres->isEmpty())
    <p>No hay Cuatrimestres registrados.</p>
@else
    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Inicio</th>
                <th>Fin</th>
                <th>Estado</th> {{-- Nueva columna para el estado --}}
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
                   
                    {{-- Muestra el estado --}}
                    <td>
                        @if ($cuatrimestre->esta_activo)
                            <span style="color: green;">✅ Activo</span>
                        @else
                            <span style="color: red;">❌ Desactivado</span>
                        @endif
                    </td>

                    <td>
                        <a href="{{ route('cuatrimestres.edit', $cuatrimestre->id) }}">Editar</a>
                        |

                        @if ($cuatrimestre->esta_activo)
                            {{-- Opción para DESACTIVAR (usa el método DELETE/destroy) --}}
                            <form action="{{ route('cuatrimestres.destroy', $cuatrimestre->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('¿Estás seguro de que quieres DESACTIVAR este cuatrimestre?')" style="background:none; border:none; color:red; cursor:pointer;">Desactivar</button>
                            </form>
                        @else
                            {{-- Opción para REACTIVAR (usa el método PUT/update para cambiar el estado) --}}
                            <form action="{{ route('cuatrimestres.update', $cuatrimestre->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PUT')
                                {{-- Campos ocultos para pasar la validación --}}
                                <input type="hidden" name="esta_activo" value="1">
                                <input type="hidden" name="nombre" value="{{ $cuatrimestre->nombre }}">
                                <input type="hidden" name="fecha_inicio" value="{{ $cuatrimestre->fecha_inicio }}">
                                <input type="hidden" name="fecha_fin" value="{{ $cuatrimestre->fecha_fin }}">

                                <button type="submit" onclick="return confirm('¿Estás seguro de que quieres REACTIVAR este cuatrimestre?')" style="background:none; border:none; color:blue; cursor:pointer;">Reactivar</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
