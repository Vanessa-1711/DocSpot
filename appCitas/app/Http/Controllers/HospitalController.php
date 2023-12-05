<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
