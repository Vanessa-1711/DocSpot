<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Paciente;
use App\Models\Hospital;
use Auth;
class RegisterController extends Controller
{
    
    public function index_pacientes()
    {
        return view('register_pacientes');
    }
    public function index_hospitales()
    {
        return view('register_hospitales');
    }

    public function store_pacientes(Request $request) {
        
        //validaciones del formulario de registros
        $this->validate($request, [
            'nombre' => 'required|regex:/^[a-zA-ZáéíóúÁÉÍÓÚÑñ\s]+$/',
            'apellido' => 'required|regex:/^[a-zA-ZáéíóúÁÉÍÓÚÑñ\s]+$/',
            'telefono' => 'nullable|regex:/^[0-9]+$/|max:10',
            'fecha_nacimiento' => 'required|date|before_or_equal:today',
            'username' => 'required|unique:users|min:3|max:20|regex:/^\S*$/u', // No se permiten espacios en el username
            'email' => 'nullable|unique:users|email|max:80',
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required',
            'curp' => 'required|unique:pacientes|regex:/^[a-zA-Z0-9]{18}$/'
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.regex' => 'El nombre solo puede contener letras y espacios.',
        
            'apellido.required' => 'El apellido es obligatorio.',
            'apellido.regex' => 'El apellido solo puede contener letras y espacios.',
        
            'telefono.regex' => 'El teléfono solo puede contener números.',
            'telefono.max' => 'El teléfono no puede tener más de 10 dígitos.',
        
            'fecha_nacimiento.required' => 'La fecha de nacimiento es obligatoria.',
            'fecha_nacimiento.date' => 'La fecha de nacimiento debe ser una fecha válida.',
            'fecha_nacimiento.before_or_equal' => 'La fecha de nacimiento debe ser anterior o igual a la fecha actual.',
        
            'username.required' => 'El nombre de usuario es obligatorio.',
            'username.unique' => 'Este nombre de usuario ya está en uso.',
            'username.min' => 'El nombre de usuario debe tener al menos :min caracteres.',
            'username.max' => 'El nombre de usuario no puede tener más de :max caracteres.',
            'username.regex' => 'El nombre de usuario no puede contener espacios.',
        
            'email.email' => 'El formato del correo electrónico no es válido.',
            'email.max' => 'El correo electrónico no puede tener más de :max caracteres.',
            'email.unique' => 'Este correo electrónico ya está en uso en nuestro sistema.',
        
            'password.required' => 'La contraseña es obligatoria.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'password.min' => 'La contraseña debe tener al menos :min caracteres.',
        
            'password_confirmation.required' => 'La confirmación de la contraseña es obligatoria.',
        
            'curp.required' => 'La CURP es obligatoria.',
            'curp.unique' => 'Esta CURP ya está registrada.',
            'curp.regex' => 'La CURP debe tener 18 caracteres alfanuméricos.'
        ]);
        

        //Invocar el modelo User para crear el registro

        $user = User::create([
            'telefono' => $request->telefono,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'rol_id' => 2,
            'status'=>1,
        ]);

        $user_id = $user->id;

        Paciente::create([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'curp'=>$request->curp,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'user_id'=> $user_id,
        ]);

        //autenticar un usuario con el moetodo attemp
        auth()->attempt($request->only('username','password'));

        //redireccionamiento
        return redirect()->route('paciente.dashboard');

        
    }

    public function store_hospitales(Request $request) {
        
        //validaciones del formulario de registros
        $this->validate($request, [
            'nombre' => 'required|regex:/^[a-zA-ZáéíóúÁÉÍÓÚÑñ\s]+$/',
            'telefono' => 'nullable|regex:/^[0-9]+$/|max:10',
            'username' => 'required|unique:users|min:3|max:20|regex:/^\S*$/u', // No se permiten espacios en el username
            'email' => 'nullable|unique:users|email|max:80',
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required',
            'longitud' => 'required',
            'latitud' => 'required',
        ]);

        //Invocar el modelo User para crear el registro
        

        $user = User::create([
            'telefono' => $request->telefono,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'rol_id' => 4,
            'status'=>1,
        ]);

        $user_id = $user->id;

        Hospital::create([
            'nombre' => $request->nombre,
            'latitud' => $request->latitud,
            'longitud' => $request->longitud,
            'user_id'=> $user_id,
            'tipo'=>'publico'
        ]);

        //autenticar un usuario con el moetodo attemp
        auth()->attempt($request->only('username','password'));

        //redireccionamiento
        return redirect()->route('hospital.dashboard');

        
    }
}
