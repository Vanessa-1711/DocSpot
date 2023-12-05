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
        
        $user = auth()->user();
    
        // Verificar el rol del usuario
        if ($user->rol_id === 1) {
            // Si el usuario tiene el rol_id 1, redireccionar a una vista específica
            return redirect()->route('admin.dashboard');
        } elseif ($user->paciente()->exists()) {
            // Si el usuario está relacionado como paciente, redireccionar a una vista de pacientes
            return redirect()->route('paciente.dashboard');
        // } elseif ($user->medico()->exists()) {
        //     // Si el usuario está relacionado como médico, redireccionar a una vista de médicos
        //     return redirect()->route('medico.dashboard');
        } elseif ($user->hospital()->exists()) {
            // Si el usuario está relacionado con un hospital, redireccionar a una vista de hospitales
            return redirect()->route('hospital.dashboard');
        } else {
            // Si no se cumplen las condiciones anteriores, redireccionar a una vista por defecto
            return back()->withErrors(['mensaje' => 'No puede acceder'])->withInput();
        }
    }
    
}
