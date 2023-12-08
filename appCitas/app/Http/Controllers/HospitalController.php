<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use App\Models\Paciente;
use App\Models\Horario;
use App\Models\PacienteHospital;
use App\Models\User;
use App\Models\Medico;
use Illuminate\Support\Facades\Hash;
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

    public function asociarDocVista()
    {
        // Obtén directamente el hospital del usuario autenticado
        $hospital = Auth::user()->hospital;

        // Obtén los médicos que pertenecen al hospital actual
        $medicos = Medico::where('hospital_id', $hospital->id)->get();

        return view('hospital.docAsociados', ['medicos' => $medicos]);
    }

    public function agregarDoctorVista (){
        return view('hospital.agregarDoctor');
    }
    

    public function agregarDoctor (Request $request){
        $hospital = Auth::user()->hospital;

        $this->validate($request, [
            'nombre' => 'required|regex:/^[a-zA-ZáéíóúÁÉÍÓÚÑñ\s]+$/',
            'apellido' => 'required|regex:/^[a-zA-ZáéíóúÁÉÍÓÚÑñ\s]+$/',
            'telefono' => 'nullable|regex:/^[0-9]+$/|max:10',
            'fecha_nacimiento' => 'required|date|before_or_equal:today',
            'username' => 'required|unique:users|min:3|max:20|regex:/^\S*$/u', // No se permiten espacios en el username
            'email' => 'nullable|unique:users|email|max:80',
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required',
            'checkboxDias' => 'required|array|min:1', // Al menos un día debe ser seleccionado
            'checkboxDias.*' => 'in:Lunes,Martes,Miércoles,Jueves,Viernes,Sábado,Domingo', // Solo permitir días específicos
            'horaInicio' => 'required|array|min:1',
            'horaFinal' => 'required|array|min:1',
        ]);
        
        $user = User::create([
            'telefono' => $request->telefono,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'rol_id' => 3,
            'status'=>1,

        ]);

        $user_id = $user->id;

        // Crear médico
        $medico = Medico::create([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'user_id' => $user_id,
            'latitud' => $hospital->latitud,
            'longitud' => $hospital->longitud,
            'hospital_id' => $hospital->id,
        ]);

        
        $checkboxDias = $request->checkboxDias;

        foreach ($checkboxDias as $dia) {
            $horaInicio = $request->horaInicio[$dia];
            $horaFin = $request->horaFinal[$dia];
            Horario::create([
                'hora_inicio' => $horaInicio,
                'hora_fin' => $horaFin,
                'dia' => $dia,
                'medico_id' => $medico->id,
            ]);
        }

        // Crear horarios
        
        


        return redirect()->route('hospital.docAsociados')->with('mensaje', 'Médico agregado exitosamente.');

    }


    

}
