<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    //public function __construct()
    //{
    //    $this->middleware('auth');
    //}

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (auth()->check()) {
            $user = auth()->user();
            // Verificar el rol del usuario
            if ($user->rol_id === 1) {
                // Si el usuario tiene el rol_id 1, redireccionar a una vista específica
                return view('admin.dashboard');
            } elseif ($user->rol_id === 2) {
                
                // Si el usuario está relacionado como paciente, redireccionar a una vista de pacientes
                return view('pacientes.dashboard');
            } elseif ($user->rol_id === 3) {
                // Si el usuario está relacionado como médico, redireccionar a una vista de médicos
                return view('medico.dashboard');
            } elseif ($user->rol_id === 4) {
                // Si el usuario está relacionado con un hospital, redireccionar a una vista de hospitales
                return view('hospital.dashboard');
            }
        }
        return view('welcome');
        

        
    }

    public function login()
    {
        return view('login');
    }
}
