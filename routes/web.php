<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarreraController;
use App\Http\Controllers\CicloEscolarController;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\MateriaController;
use App\Http\Controllers\CuatrimestreController;
use App\Http\Controllers\GrupoController;

Route::get('/', function () {
    return view('welcome');
});








Route::resource('carreras', CarreraController::class);
Route::resource('ciclos_escolares', CicloEscolarController::class);
Route::resource('alumnos', AlumnoController::class);
Route::resource('materias', MateriaController::class);
Route::resource('cuatrimestres', CuatrimestreController::class);
Route::resource('grupos', GrupoController::class);
