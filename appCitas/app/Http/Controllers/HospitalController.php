<?php

namespace App\Http\Controllers;

use App\Models\Medico;
use App\Models\Hospital;
use App\Models\Paciente;
<<<<<<< HEAD
use App\Models\Horario;
use App\Models\PacienteHospital;
use App\Models\User;
use App\Models\Medico;
use Illuminate\Support\Facades\Hash;
=======
>>>>>>> 4f6a088c99cae6d385db203ade05bec352d864f2
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

    public function verMasDoc($id)
    {

        $medico = Medico::with('hospital')->find($id);
        $horarios = Horario::where('medico_id', $medico->id)->get();
        return view('hospital.perfilDoctor', [
            'medico' => $medico,
            'horarios' => $horarios,
        ]);
    }

    public function editarDoctor($id)
    {
        // Obtener el doctor por su ID
        $doctor = Medico::findOrFail($id);
        $horarios = Horario::where('medico_id', $doctor->id)->get();

        // Puedes pasar el doctor a la vista para que lo muestre en el formulario de edición
        return view('hospital.editarDoctor', ['doctor' => $doctor, 'horarios' => $horarios]);
    }

    public function actualizarDoctor(Request $request, $id)
    {
        $hospital = Auth::user()->hospital;
        $medico = Medico::findOrFail($request->id);
        $user = $medico->user;

        $rules = [
            'nombre' => 'required|regex:/^[a-zA-ZáéíóúÁÉÍÓÚÑñ\s]+$/',
            'apellido' => 'required|regex:/^[a-zA-ZáéíóúÁÉÍÓÚÑñ\s]+$/',
            'telefono' => 'nullable|regex:/^[0-9]+$/|max:10',
            'fecha_nacimiento' => 'required|date|before_or_equal:today',
            'checkboxDias' => 'required|array|min:1',
            'checkboxDias.*' => 'in:Lunes,Martes,Miércoles,Jueves,Viernes,Sábado,Domingo',
            'horaInicio' => 'required|array|min:1',
            'horaFinal' => 'required|array|min:1',
            'password' => 'nullable|min:8',
        ];

        // Agregar reglas de validación para el username y el email solo si se proporcionan
        if ($request->filled('username')) {
            $rules['username'] = 'required|min:3|max:20|regex:/^\S*$/u|unique:users,username,' . $user->id;
        }

        if ($request->filled('email')) {
            $rules['email'] = 'nullable|email|max:80|unique:users,email,' . $user->id;
        }

        $this->validate($request, $rules);

        // Verificar si se proporcionó una nueva contraseña
        if ($request->filled('password')) {
            $this->validate($request, [
                'password' => 'required|min:8', // Puedes ajustar las reglas según tus necesidades
            ]);

            // Actualizar la contraseña solo si se proporcionó una nueva
            $user->update([
                'password' => Hash::make($request->password),
            ]);
        }

        // Actualizar el usuario solo si se proporcionó un nuevo username
        if ($request->filled('username') && $user->username !== $request->username) {
            $user->update([
                'username' => $request->username,
            ]);
        }

        // Actualizar el usuario solo si se proporcionó un nuevo email
        if ($request->filled('email') && $user->email !== $request->email) {
            $user->update([
                'email' => $request->email,
            ]);
        }

        // Crear o actualizar médico
        $medico = Medico::updateOrCreate(
            ['user_id' => $user->id],
            [
                'nombre' => $request->nombre,
                'apellido' => $request->apellido,
                'fecha_nacimiento' => $request->fecha_nacimiento,
                'latitud' => $hospital->latitud,
                'longitud' => $hospital->longitud,
                'hospital_id' => $hospital->id,
            ]
        );

        $checkboxDias = $request->checkboxDias;

        foreach ($checkboxDias as $dia) {
            $horaInicio = $request->horaInicio[$dia];
            $horaFin = $request->horaFinal[$dia];
            Horario::updateOrCreate(
                [
                    'dia' => $dia,
                    'medico_id' => $medico->id,
                ],
                [
                    'hora_inicio' => $horaInicio,
                    'hora_fin' => $horaFin,
                ]
            );
        }

        $medico = Medico::with('hospital')->find($id);
        $horarios = Horario::where('medico_id', $medico->id)->get();

        return redirect()->route('hospital.vermasDoc', [
            'id' => $medico->id,
            'horarios' => $horarios,
        ])->with('mensaje', 'Médico editado exitosamente.');
    }

    public function eliminarMedico($id)
    {
        // Encuentra el médico por su ID
        $medico = Medico::findOrFail($id);

        // Elimina los horarios asociados al médico
        Horario::where('medico_id', $id)->delete();

        // Obtén el usuario asociado al médico
        $usuario = $medico->user;

        // Elimina el médico y el usuario
        $medico->delete();
        $usuario->delete();


        // Puedes redirigir a donde desees después de la eliminación
        return redirect()->route('hospital.docAsociados')->with('mensaje', 'Médico y usuario eliminados exitosamente.');
    }
    
}
