<?php

namespace App\Http\Controllers;
use App\Models\Medico;
use App\Models\Hospital;
use App\Models\PacienteHospital;
use App\Models\Paciente;
use Illuminate\Http\Request;

class MedicoController extends Controller
{
    public function index()
    {
        return view('medico.dashboard');
    }

    public function index_pacientes(){
        $usuario = auth()->user();
        $medico = Medico::where('user_id', $usuario->id)->first();
        
        if ($medico) { // Verificamos si se encontró al médico
            $hospital = Hospital::find($medico->hospital_id); // Obtener el hospital del médico
            
            if ($hospital) {
                $pacientesIds = PacienteHospital::where('hospital_id', $hospital->id)
                    ->pluck('paciente_id')
                    ->toArray();

                $pacientes = Paciente::whereIn('id', $pacientesIds)->get();

                return view('medico.pacientes', [
                    'cantidadHospitales' => $pacientes->count(),
                    'nombresPacientes' => $pacientes,
                ]);

            }
        }
    }

    public function verMasPaciente($id)
    {

        $paciente = Paciente::find($id);
        return view('medico.vermasPaciente', [
            'paciente' => $paciente,
           
        ]);
    }

    public function crearCita($pacienteId)
    
    {
        
        $usuario = auth()->user();
        $medico_id = Medico::where('user_id', $usuario->id)->first();
    
        // Encuentra al médico por su ID
        $medico = Medico::findOrFail($medico_id->id);
        
        $paciente = Paciente::findOrFail($pacienteId);
        

        // Obtiene el ID del hospital del médico
        $hospitalId = $medico->hospital_id;

        $pacientesIds = PacienteHospital::where('hospital_id', $hospitalId)
                    ->pluck('paciente_id')
                    ->toArray();

        $pacientes = Paciente::whereIn('id', $pacientesIds)->get();


        return view('medico.crear_cita', [
            'medico' => $paciente,
            'medicosDelMismoHospital' => $pacientes
        ]);
    }
}
