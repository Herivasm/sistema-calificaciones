<h1>Editar Cuatrimestre: {{ $cuatrimestre->nombre }}</h1>

@if ($errors->any())
    <div style="color: red;">
        <strong>¡Atención!</strong> Hubo problemas al actualizar.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('cuatrimestres.update', $cuatrimestre->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div>
        <strong>Nombre del Cuatrimestre:</strong>
        <input type="text" name="nombre" value="{{ old('nombre', $cuatrimestre->nombre) }}" required>
    </div>

    <div>
        <strong>Activo:</strong>
        <input type="checkbox" name="esta_activo" value="1" @checked(old('esta_activo', $cuatrimestre->esta_activo))>
    </div>

    <button type="submit">Actualizar Cuatrimestre</button>
</form>

<a href="{{ route('cuatrimestres.index') }}">Volver al listado</a>
```eof

### C. Vista: `cuatrimestres/index.blade.php` (Acciones)

Actualiza la columna `Acciones` para que use los enlaces de **Editar** y **Eliminar**:

```blade
{{-- En resources/views/cuatrimestres/index.blade.php --}}

<td>
    {{-- Enlace EDITAR --}}
    <a href="{{ route('cuatrimestres.edit', $cuatrimestre->id) }}">Editar</a>

    |

    {{-- Formulario ELIMINAR --}}
    <form action="{{ route('cuatrimestres.destroy', $cuatrimestre->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" onclick="return confirm('¿Estás seguro de que quieres eliminar este cuatrimestre?')" style="background:none; border:none; color:blue; cursor:pointer;">Eliminar</button>
    </form>
</td>
