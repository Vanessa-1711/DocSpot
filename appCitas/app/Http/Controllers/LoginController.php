<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    //
    public function store(Request $request){
        $this->validate($request,[
            // Reglas de validacion 
            'username' => 'required',
            'password' => 'required',
        ]);
        
        // Verificar que las credenciales sean correctas
        if(!auth()->attempt($request->only('username','password'), $request->remember)){
            // Si las credenciales ingresadas no coinciden con las de la base de datos, retornar a la vista anterior con un mensaje de error y los valores anteriores
            return back()->withErrors(['mensaje' => 'Las credenciales son incorrectas'])->withInput();
        }
        
        // Credenciales correctas
        return view('dashboard');
    }
    
}
