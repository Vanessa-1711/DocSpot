<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    public function showLoginForm()
    {
        return view('auth.login');
    }


    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function store(Request $request){
        $this->validate($request,[
            //Reglas de validacion 
            'username' => 'required',
            'password' => 'required',
        ]);
        // Verificar que las credenciales sean correctas
        if(!auth()->attempt($request->only('username','password'), $request ->remember)){
            // Usar la directiva "with" para llenar los valores de la sesión
            // Si las credenciales ingresadas no coinciden con las de la base de datos, retornara el mensaje
            return back()->with('mensaje','Credenciales incorrectas');
        }
        // Credenciales correctas
        return redirect()->route('welcome', auth()->user()->username);
        
    }
}
