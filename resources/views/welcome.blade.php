<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistema de Calificaciones - Panel Principal</title>
    <style>
        body { font-family: sans-serif; margin: 0; padding: 0; background-color: #f4f7f9; color: #333; }
        .container { max-width: 800px; margin: 50px auto; padding: 30px; background: #fff; border-radius: 12px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); }
        h1 { color: #1e88e5; text-align: center; margin-bottom: 25px; }
        .module-list { list-style: none; padding: 0; display: flex; flex-wrap: wrap; gap: 20px; justify-content: center; }
        .module-list li { width: 100%; max-width: 350px; }
        .module-list a {
            display: block;
            padding: 15px 20px;
            background-color: #f0f4f7;
            border-radius: 8px;
            text-decoration: none;
            color: #333;
            font-size: 1.1em;
            font-weight: bold;
            transition: all 0.3s ease;
            border-left: 5px solid #1e88e5;
        }
        .module-list a:hover {
            background-color: #e3f2fd;
            color: #1565c0;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .subtitle { text-align: center; color: #555; margin-bottom: 30px; font-size: 1.2em; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Sistema de Gestión de Calificaciones</h1>
        <p class="subtitle">Selecciona el módulo de administración al que deseas ingresar:</p>

        <ul class="module-list">

            {{-- MÓDULOS BASE (Tablas de Catálogo) --}}
            <li><a href="{{ route('carreras.index') }}">📚 Gestión de Carreras</a></li>
            <li><a href="{{ route('ciclos.index') }}">📅 Gestión de Ciclos Escolares</a></li>
            <li><a href="{{ route('cuatrimestres.index') }}">🗓️ Gestión de Cuatrimestres</a></li>
            <li><a href="{{ route('materias.index') }}">📘 Gestión de Materias</a></li>

            <hr style="width: 100%; border: none; margin: 15px 0;">

            {{-- MÓDULOS DE REGISTRO CLAVE --}}
            <li><a href="{{ route('alumnos.index') }}">👤 Registro de Alumnos</a></li>

            {{-- MÓDULOS DE ESTRUCTURA Y CALIFICACIÓN --}}
            <li><a href="{{ route('grupos.index') }}">👥 Gestión de Grupos / Matriculación</a></li>

            {{-- Una vez que este listo el CRUD de Calificaciones, agregaremos el enlace --}}
            {{-- <li><a href="#">💯 Registro de Calificaciones</a></li> --}}
        </ul>

        <p style="margin-top: 40px; text-align: center; font-size: 0.9em; color: #999;">
            *Recuerda que para que el sistema funcione, debes registrar los módulos base (Carreras, Ciclos, Cuatrimestres) primero.
        </p>
    </div>
</body>
</html>
