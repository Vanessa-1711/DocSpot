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

Route::get('/pacientes/hospital/vermas/{id}', [PacienteController::class, 'verMasHospital'])->name('pacientes.vermas');
Route::get('/asociar/{hospital}/{nss}', [PacienteController::class, 'asociarHospital'])->name('pacientes.asociar');

Route::get('/pacientes/hospital/vermasDoc/{id}', [PacienteController::class, 'verMasDoc'])->name('pacientes.vermasDoc');
// En web.php
Route::post('/citas/{cita}/confirmar', [PacienteController::class, 'confirmarCita'])->name('citas.confirmar');
Route::delete('/citas/{cita}/eliminar', [PacienteController::class, 'eliminarCita'])->name('citas.eliminar');


Route::get('/citas/{cita}/editar', [PacienteController::class, 'editarCita'])->name('citas.editar');
Route::put('/citas/{cita}', [PacienteController::class, 'actualizarCita'])->name('citas.actualizar');
//Editar perfil de pacientes
Route::get('/pacientes/editar_perfil', [PacienteController::class, 'editarPerfil'])->name('perfil.editar');
Route::post('/pacientes/actualizar_perfil', [PacienteController::class, 'actualizarPerfil'])->name('update_paciente');
Route::get('/pacientes/ver_perfil', [PacienteController::class, 'verPerfil'])->name('ver_perfil');
Route::post('/pacientes/imagen_perfil', [PacienteController::class, 'actualizarImagenPerfil'])->name('actualizarImagenPerfil');


// Hospital
Route::get('hospitales/asociar', [HospitalController::class, 'asociarVista'])->name('hospital.asociar');
Route::get('hospitales/agregar', [HospitalController::class, 'agregar'])->name('hospital.agregar');
Route::post('hospitales/agregar', [HospitalController::class, 'registroNss'])->name('hospital.nss.agregar');
Route::delete('hospitales/borrar/{pacienteHospital}', [HospitalController::class, 'deleteNss'])->name('hospital.nss.destroy');

Route::get('/crear_cita/{doctor}', [PacienteController::class, 'crearCita'])->name('citas.crear');
Route::get('/obtenerHorasDisponibles/{fecha}/{medico_id}', [PacienteController::class, 'obtenerHorasDisponibles'])->name('ruta.obtenerHorasDisponibles');
Route::post('crear_cita/guardar', [PacienteController::class, 'guardarCita'])->name('citas.guardar');


//Hospital-Doctores
Route::get('hospitales/doctores/asociados', [HospitalController::class, 'asociarDocVista'])->name('hospital.docAsociados');
Route::get('hospitales/doctores/agregar', [HospitalController::class, 'agregarDoctorVista'])->name('hospital.agregarDocVista');
Route::post('hospitales/doctores/agregar', [HospitalController::class, 'agregarDoctor'])->name('hospital.agregarDoc');



//Admin-Doctores 
Route::get('hospitales/doctores/vermasDoc/{id}', [HospitalController::class, 'verMasDoc'])->name('hospital.vermasDoc');
Route::get('hospitales/doctores/{id}/editar', [HospitalController::class, 'editarDoctor'])->name('hospital.editarDoc');
Route::post('hospitales/doctores/{id}/actualizar', [HospitalController::class, 'actualizarDoctor'])->name('hospital.actualizarDoc');
Route::get('/hospital/doctores/{doctor}/eliminar', [HospitalController::class, 'eliminarMedico'])->name('hospital.eliminarDoctor');