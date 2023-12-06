<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\HospitalController;
use App\Http\Controllers\HomeController;
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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/login', [App\Http\Controllers\HomeController::class, 'login']);

//Rutas para el login
Route::post('/login', [LoginController::class, 'store'])->name('login');
Route::get('/logout',[LoginController::class,'logout'])->name('logout');

Route::get('/register', [App\Http\Controllers\HomeController::class, 'register']);

//Rutas para el register
Route::post('/register', [RegisterController::class, 'store'])->name('register');

Route::get('/register_pacientes', [RegisterController::class, 'index_pacientes'])->name('register_pacientes');
Route::get('/register_hospitales', [RegisterController::class, 'index_hospitales'])->name('register_hospitales');

Route::post('/register_pacientes', [RegisterController::class, 'store_pacientes'])->name('store_pacientes');
Route::post('/register_hospitales', [RegisterController::class, 'store_hospitales'])->name('store_hospitales');


Route::get('/paciente/dashboard', [PacienteController::class, 'index'])->name('paciente.dashboard');

Route::get('/medico/dashboard', [MedicoController::class, 'index'])->name('medico.dashboard');

Route::get('/hospital/dashboard', [HospitalController::class, 'index'])->name('hospital.dashboard');


Route::get('/hospital/pacientes', [PacienteController::class, 'hospitales'])->name('hospital.pacientes');
Route::get('/pacientes/{paciente}/citas', [PacienteController::class, 'citasPaciente'])->name('pacientes.citas');

Route::get('/pacientes/hospital/vermas', [PacienteController::class, 'verMasHospital'])->name('pacientes.vermas');



// En web.php
Route::post('/citas/{cita}/confirmar', [PacienteController::class, 'confirmarCita'])->name('citas.confirmar');
Route::delete('/citas/{cita}/eliminar', [PacienteController::class, 'eliminarCita'])->name('citas.eliminar');


Route::get('/citas/{cita}/editar', [PacienteController::class, 'editarCita'])->name('citas.editar');
Route::put('/citas/{cita}', [PacienteController::class, 'actualizarCita'])->name('citas.actualizar');