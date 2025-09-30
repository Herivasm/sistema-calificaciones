<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarreraController;
use App\Http\Controllers\CicloEscolarController;

Route::get('/', function () {
    return view('welcome');
});








Route::resource('carreras', CarreraController::class);
Route::resource('ciclos_escolares', CicloEscolarController::class);
