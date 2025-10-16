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
                <th>Estado</th> {{-- NUEVO: Columna para el estado --}}
                <th>Asignada a Carreras</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($materias as $materia)
                <tr>
                    <td>{{ $materia->id }}</td>
                    <td>{{ $materia->nombre }}</td>

                    {{-- Muestra el estado --}}
                    <td>
                        @if ($materia->esta_activo)
                            <span style="color: green;">✅ Activa</span>
                        @else
                            <span style="color: red;">❌ Desactivada</span>
                        @endif
                    </td>

                    <td>
                        {{-- Itera sobre la colección de carreras relacionadas (Muchos a Muchos) --}}
                        @forelse($materia->carreras as $carrera)
                            <span style="border: 1px solid #ccc; padding: 2px; margin-right: 5px; display: inline-block;">
                                {{ $carrera->nombre }}
                            </span>
                        @empty
                            <span style="color: gray;">Sin asignación.</span>
                        @endforelse
                    </td>

                    <td>
                        {{-- Enlace EDITAR --}}
                        <a href="{{ route('materias.edit', $materia->id) }}">Editar</a>
                        |

                        @if ($materia->esta_activo)
                            {{-- Opción para DESACTIVAR (usa el método DELETE/destroy) --}}
                            <form action="{{ route('materias.destroy', $materia->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('¿Quieres DESACTIVAR esta materia?')" style="background:none; border:none; color:red; cursor:pointer;">Desactivar</button>
                            </form>
                        @else
                            {{-- Opción para REACTIVAR (usa el método PUT/update) --}}
                            <form action="{{ route('materias.update', $materia->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PUT')
                                {{-- Campos ocultos para pasar la validación y reactivar el estado --}}
                                <input type="hidden" name="esta_activo" value="1">
                                <input type="hidden" name="nombre" value="{{ $materia->nombre }}">
                                {{-- Es crucial pasar la lista de carreras para que sync NO las borre --}}
                                @foreach($materia->carreras as $carrera)
                                    <input type="hidden" name="carreras[]" value="{{ $carrera->id }}">
                                @endforeach

                                <button type="submit" onclick="return confirm('¿Quieres REACTIVAR esta materia?')" style="background:none; border:none; color:blue; cursor:pointer;">Reactivar</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
