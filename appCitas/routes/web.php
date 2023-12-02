<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\HospitalController;
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
    return view('welcome');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/login', [App\Http\Controllers\HomeController::class, 'login'])->name('login');

//Rutas para el login
Route::post('/login', [LoginController::class, 'store']);

Route::get('/paciente/dashboard', [PacienteController::class, 'index'])->name('paciente.dashboard');

Route::get('/medico/dashboard', [MedicoController::class, 'index'])->name('medico.dashboard');

Route::get('/hospital/dashboard', [HospitalController::class, 'index'])->name('hospital.dashboard');


Route::get('/hospital/pacientes', [PacienteController::class, 'mostrarCarpetaPacientes'])->name('hospital.pacientes');
