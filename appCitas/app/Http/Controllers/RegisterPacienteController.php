<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Paciente;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterPacienteController extends Controller
{
    //crear nuestro primer metodo del controlador
    public function index() {
        return view('auth.registro.register_paciente');
    }

    public function store(Request $request) {
        // dd($request->all());
        // Validaciones del formulario de registros
        $this->validate($request, [
            'nombre' => 'required|min:5', 
            'apellido_paterno' => 'required',
            'apellido_materno' => 'required',
            'username' => 'required|unique:users|min:3|max:20', 
            'telefono' => 'required',
            'email' => 'required|unique:users|email|max:60', 
            'password' => 'required|confirmed|min:6', 
            'password_confirmation'=>''
        ]);

        // Crea el usuario
        User::create([
            'nombre' => $request->nombre,
            'apellido_paterno' => $request->apellido_paterno,
            'apellido_materno' => $request->apellido_materno,
            'username' => $request->username,
            'telefono' => $request->telefono,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => 1,
            'rol_id' => 'paciente', // Asignamos el rol 'paciente'  
        ]);

        // Crea el paciente asociado
        Paciente::create([
            'nombre' => $request->nombre,
            'apellido_paterno' => $request->apellido_paterno,
            'apellido_materno' => $request->apellido_materno,
            'num_seguro' => $request->num_seguro,
            'preferente' => $request->preferente,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'user_id' => $request->user()->id, // Asignamos el ID del usuario recién creado  
        ]);

       
        //autenticar un usuario con el moetodo attemp
        auth()->attempt($request->only('email','password'));

        // Redireccionamiento
        return redirect()->route('home'); // Asegúrate de que esta ruta exista y sea la correcta
    }
}
