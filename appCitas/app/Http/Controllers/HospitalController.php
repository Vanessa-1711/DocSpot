<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use App\Models\Paciente;
use App\Models\PacienteHospital;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HospitalController extends Controller
{
    public function __construct(){
        //Middleware para proteger las rutas con autenticación
        $this->middleware('auth');
    }
    
    public function index()
    {
        return view('hospital.dashboard');
    }

    public function asociarVista()
    {
        $hospitalPaciente = PacienteHospital::all();
        return view('hospital.asociar', ['hospitalPaciente' => $hospitalPaciente]);
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

}
