<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use App\Models\Paciente;
use Illuminate\Http\Request;

class PacienteController extends Controller
{
    public function __construct(){
        //Middleware para proteger las rutas con autenticación
        $this->middleware('auth');
    }
    
    public function index()
    {
        return view('pacientes.dashboard');
    }

    public function mostrarCarpetaPacientes()
    {
        $cantidadHospitales = Hospital::count();
        $nombresHospitales = Hospital::pluck('nombre')->toArray();
        $pacientes = Paciente::all(); // Esto obtiene todos los pacientes, ajusta según tu lógica
        return view('pacientes.pacientesHos', ['pacientes' => $pacientes, 
        'cantidadHospitales' => $cantidadHospitales,
        'nombresHospitales' => $nombresHospitales,] );
    }
}
