<?php

namespace App\Http\Controllers;

use App\Models\Citas;
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

    public function hospitales()
    {
        $cantidadHospitales = Hospital::count();
        $nombresHospitales = Hospital::pluck('nombre')->toArray();
        $pacientes = Paciente::all();
        return view('pacientes.pacientesHos', ['pacientes' => $pacientes, 
        'cantidadHospitales' => $cantidadHospitales,
        'nombresHospitales' => $nombresHospitales,] );
    }

    public function citasPaciente($pacienteId)
    {
        $paciente = Paciente::with(['citas.medico'])->findOrFail($pacienteId);
        return view('pacientes.citas', ['paciente' => $paciente]);
    }

    // En PacienteController.php

    // Método para confirmar la cita
    public function confirmarCita($citaId)
    {
        $cita = Citas::findOrFail($citaId);
        $cita->estado = 1; // Cambiar a confirmado
        $cita->save();

        return redirect()->back()->with('success', 'Cita confirmada.');
    }

    // Método para eliminar la cita
    public function eliminarCita($citaId)
    {
        $cita = Citas::findOrFail($citaId);
        $cita->delete();

        return redirect()->back()->with('success', 'Cita eliminada.');
    }


}
