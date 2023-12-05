<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use App\Models\Paciente;
use App\Models\PacienteHospital;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HospitalController extends Controller
{
    //
    public function __construct(){
        //Middleware para proteger las rutas con autenticación
        $this->middleware('auth');
    }
    
    public function index()
    {
        return view('hospitales.dashboard');
    }

    public function asociarVista()
    {
        $hospitalPaciente = PacienteHospital::all();
        return view('hospitales.asociar', ['hospitalPaciente' => $hospitalPaciente]);
    }
    
    public function agregar(){
        $paciente = Paciente::all();
        $hospital = Hospital::all();

        return view('hospitales.agregar', ['paciente'=>$paciente,'hospital'=>$hospital]);
    }

    public function registroNss(Request $request){

        $request->validate([
            'curp' => 'required|max:18',
            'nss' => 'required|max:10',            
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

        return redirect()->route('hospital.asociar')->with('success', 'Cliente eliminado correctamente.');
    }


}