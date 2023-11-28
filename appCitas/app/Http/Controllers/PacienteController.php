<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PacienteController extends Controller
{
    public function __construct(){
        //Middleware para proteger las rutas con autenticación
        $this->middleware('auth');
    }
    
    public function index()
    {
        return view('pacientes.dashboard');
    }
}
