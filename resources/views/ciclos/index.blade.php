<h1>Gestión de Ciclos Escolares</h1>

<a href="{{ route('ciclos.create') }}">Crear Nuevo Ciclo</a>
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
                        {{-- CORRECCIÓN CLAVE: Usamos la variable $ciclo.id --}}
                        <a href="{{ route('ciclos.edit', $ciclo->id) }}">Editar</a>

                        |

                        {{-- Formulario ELIMINAR --}}
                        <form action="{{ route('ciclos.destroy', $ciclo->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('¿Estás seguro de eliminar este ciclo?')" style="background:none; border:none; color:blue; cursor:pointer;">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
```eof

**Pasos Finales para el Módulo:**

1.  **Guarda** el `index.blade.php` con la corrección del enlace.
2.  **Limpia el caché** (`php artisan route:clear` y `php artisan cache:clear`).
3.  **Reinicia el servidor** (`php artisan serve`).

Esto debería resolver el error de enrutamiento que venía del listado. Una vez que funcione, ¡podemos pasar al módulo de **Cuatrimestres**!
