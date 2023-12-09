<?php

namespace App\Http\Controllers;

use App\Models\Medico;
use App\Models\Hospital;
use App\Models\Paciente;
use Illuminate\Http\Request;
use App\Models\PacienteHospital;
use Illuminate\Support\Facades\Auth;

class HospitalController extends Controller
{
    public function __construct(){
        //Middleware para proteger las rutas con autenticación
        $this->middleware('auth');
    }
    
    public function index()
    {
        $usuario = auth()->user();
        
        // Obtener el hospital asociado al usuario autenticado
        $hospital = Hospital::where('user_id', $usuario->id)->first();
    
        $pacientes = Paciente::all();
        // Verificar si se encontró un hospital
        // if (!$hospital) {
        //     // Redirigir o mostrar un mensaje si el hospital no se encuentra
        //     return redirect()->route('nombre.de.la.ruta.alguna')->with('error', 'Hospital no encontrado.');
        // }
    
        // Calcular la cantidad de pacientes asociados al hospital
        $cantidadPacientesAsociados = PacienteHospital::where('hospital_id', $hospital->id)
                                                       ->count();
    
        // Obtener los médicos asociados al hospital
        $medicos = Medico::where('hospital_id', $hospital->id)->get();
        $cantidadMedicosHospital = $medicos->count();
    
        // Pasar los datos a la vista
        return view('hospital.dashboard', [
            'cantidadPacientesAsociados' => $cantidadPacientesAsociados,
            'cantidadMedicosHospital' => $cantidadMedicosHospital,
            'medicos' => $medicos,
            'pacientes' => $pacientes,
            // Puedes añadir más datos aquí según sea necesario
        ]);
    }

    public function asociarVista()
    {
        $hospitalPaciente = PacienteHospital::whereNull('paciente_id')->get();
        return view('hospital.asociar', ['hospitalPaciente' => $hospitalPaciente]);
    }
    public function index_pacientes(){
        $usuario = auth()->user();
        $hospital = Hospital::where('user_id', $usuario->id)->first();

        if ($hospital) {
            $pacientesIds = PacienteHospital::where('hospital_id', $hospital->id)
                ->pluck('paciente_id')
                ->toArray();

            $pacientes = Paciente::whereIn('id', $pacientesIds)->get();

            return view('hospital.pacientes', [
                'cantidadHospitales' => $pacientes->count(),
                'nombresPacientes' => $pacientes,
            ]);
        }

    }
    public function verMasPaciente($id)
    {

        $paciente = Paciente::find($id);
        return view('hospital.vermasPaciente', [
            'paciente' => $paciente,
        ]);
    }

    
    public function agregar(){

        return view('hospital.agregar');
    }

    public function registroNss(Request $request){

        
        $this->validate($request, [
            'curp' => 'required|unique:pacientes_hospitales|regex:/^[a-zA-Z0-9]{18}$/',
            'nss' => 'required|unique:pacientes_hospitales|regex:/^[a-zA-Z0-9]{10}$/',
        ], [
            'curp.required' => 'El campo CURP es obligatorio.',
            'curp.unique' => 'El valor ingresado para CURP ya está registrado.',
            'curp.regex' => 'El campo CURP debe tener 18 caracteres alfanuméricos.',
        
            'nss.required' => 'El campo Número de Seguro es obligatorio.',
            'nss.unique' => 'El valor ingresado para Número de Seguro ya está registrado.',
            'nss.regex' => 'El campo Número de Seguro debe tener 10 caracteres alfanuméricos.',
        ]);
        
        // Encuentra el hospital asociado con el usuario
        $hospital = Hospital::where('user_id', Auth::id())->first();

        // Verifica si se encontró un hospital asociado
        if (!$hospital) {
            // Manejar la situación, por ejemplo, devolviendo un error
            return redirect()->back()->withErrors('No se encontró un hospital asociado a su cuenta.');
        }

        PacienteHospital::create([
            'curp' => $request->curp,
            'nss' => $request->nss,
            'hospital_id' => $hospital->id,
        ]);

        return redirect()->route('hospital.asociar')->with('success', 'Paciente agregado exitosamente.');
    }

    public function deleteNss(Request $request, PacienteHospital $pacienteHospital){
        $pacienteHospital->delete();

        return redirect()->route('hospital.asociar')->with('success', 'Paciente eliminado correctamente.');
    }
    public function deletePaciente(Request $request, $pacienteHospitalId){
        
        $pacienteHospital = PacienteHospital::where('paciente_id', $pacienteHospitalId)->first();

     
        if ($pacienteHospital) {
            // Continúa con el proceso de eliminación
            $pacienteHospital->delete();
            return redirect()->route('hospital.pacientes')->with('success', 'Paciente eliminado correctamente.');
        } else {
            return redirect()->route('hospital.pacientes')->with('error', 'No se pudo encontrar el registro del paciente.');
        }
    }
    

    public function asociarDocVista()
    {
       
        return view('hospital.docAsociados');
    }

    

}
