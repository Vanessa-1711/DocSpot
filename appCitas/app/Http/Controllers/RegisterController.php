<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    //crear nuestro primer metodo del controlador
    public function index() {
        return view('auth.registro.register');
    }

}
