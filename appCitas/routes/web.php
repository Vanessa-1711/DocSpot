<?php

use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterPacienteController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('layouts.app');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/login', [App\Http\Controllers\HomeController::class, 'login'])->name('login');

Route::get('/register',[RegisterController::class,'index'])->name('register');
Route::get('/register/paciente',[RegisterPacienteController::class,'index'])->name('register_paciente');
Route::post('/register/paciente/store',[RegisterPacienteController::class,'store'])->name('register.store');

//Rutas para el login
Route::post('/login', [LoginController::class, 'store']);
