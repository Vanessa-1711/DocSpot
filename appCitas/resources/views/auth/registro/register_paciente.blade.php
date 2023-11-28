<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse</title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link rel="stylesheet" href="{{asset('css/argon-dashboard.css?v=2.0.4')}}">
    <link rel="stylesheet" href="{{asset('css/argon-dashboard-tailwind.css')}}">
    <link rel="stylesheet" href="{{asset('css/nucleo-icons.css')}}">
    <link rel="stylesheet" href="{{asset('css/nucleo-svg.css')}}">
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    {{-- <link href="../assets/css/nucleo-svg.css" rel="stylesheet" /> --}}
    <!-- CSS Files -->
    {{-- <link id="pagestyle" href="{{asset('css/argon-dashboard.css?v=2.0.4')}}" rel="stylesheet" /> --}}
    @yield('titulo')
    <link rel="stylesheet" href="{{asset('css/app.css')}}" />
  </head>
<body>
<div class="split-screen">
    <!-- Lado izquierdo con la imagen -->
    <div class="left-half" style="background-image: url('{{asset('img/register/registro_persona.png')}}');">
        <img src="{{asset('img/register/fondo.png')}}" alt="Doctora atendiendo a un paciente" class="min-h-screen object-cover" />
    </div>
    <div class="right-half">
        <div class="form-container">
            <h2 class="text-4xl font-bold mb-8 text-center">REGISTRARSE</h2>
            <form action="{{ route('register.store') }}" method="POST" class=" p-6 rounded-lg ">
                {{-- Directiva de seguridad --}}
                @csrf

                {{-- Nombre --}}
                <div class="mb-4">
                    <label for="nombre" class="mb-2 block uppercase text-cyan-700 font-bold">Nombre</label>
                    <input type="text" name="nombre" id="nombre" placeholder="Nombre"
                    class="border p-3 w-full  rounded-3 @error('nombre') border-red-500 @enderror" value="{{old('nombre')}}" 
                    {{-- old funciona para no eliminar la casilla roja hasta que se quite el error --}}
                    />
                {{-- Directiva para mostrar mensaje de error--}}
                @error('nombre')
                    <p class="bg-red-500 text-black my-2 rounded-3 text-sm p-2 text-center"> {{$message}}</p>
                @enderror
    
                </div>

                {{-- Apellido Paterno --}}
                <div class="mb-4">
                    <label for="apellido_paterno" class="mb-2 block uppercase text-cyan-700 font-bold">Apellido Paterno:</label>
                    <input type="text" name="apellido_paterno" id="apellido_paterno" placeholder="Apellido Paterno"
                    class="border p-3 w-full  rounded-3 @error('apellido_paterno') border-red-500 @enderror" value="{{old('apellido_paterno')}}" 
                    {{-- old funciona para no eliminar la casilla roja hasta que se quite el error --}}
                    />
                    {{-- Directiva para mostrar mensaje de error--}}
                    @error('apellido_paterno')
                        <p class="bg-red-500 text-black my-2 rounded-3 text-sm p-2 text-center"> {{$message}}</p>
                    @enderror

                </div>

                {{-- Apellido Materno --}}
                <div class="mb-4">
                    <label for="apellido_materno" class="mb-2 block uppercase text-cyan-700 font-bold">Apellido Materno:</label>
                    <input type="text" name="apellido_materno" id="apellido_materno" placeholder="Apellido Materno"
                    class="border p-3 w-full  rounded-3 @error('apellido_materno') border-red-500 @enderror" value="{{old('apellido_materno')}}" 
                    {{-- old funciona para no eliminar la casilla roja hasta que se quite el error --}}
                    />
                    {{-- Directiva para mostrar mensaje de error--}}
                    @error('apellido_materno')
                        <p class="bg-red-500 text-black my-2 rounded-3 text-sm p-2 text-center"> {{$message}}</p>
                    @enderror

                </div>

                {{-- Username --}}
                <div class="mb-4">
                    <label for="username" class="mb-2 block uppercase text-cyan-700 font-bold">Username</label>
                    <input type="text" name="username" id="username" placeholder="Username"
                    class="border p-3 w-full rounded-3 @error('name') border-red-500 @enderror" value="{{old('username')}}" 
                    {{-- old funciona para no eliminar la casilla roja hasta que se quite el error --}}
                    />
                    {{-- Directiva para mostrar mensaje de error--}}
                    @error('username')
                        <p class="bg-red-500 text-black my-2 rounded-3 text-sm p-2 text-center"> {{$message}}</p>
                    @enderror

                </div>

                {{-- Telefono --}}
                <div class="mb-4">
                    <label for="telefono" class="mb-2 block uppercase text-cyan-700 font-bold">Telefono</label>
                    <input type="number" name="telefono" id="telefono" placeholder="Telefono"
                    class="border p-3 w-full rounded-3 @error('telefono') border-red-500 @enderror" value="{{old('telefono')}}" 
                    {{-- old funciona para no eliminar la casilla roja hasta que se quite el error --}}
                    />
                    {{-- Directiva para mostrar mensaje de error--}}
                    @error('telefono')
                        <p class="bg-red-500 text-black my-2 rounded-3 text-sm p-2 text-center"> {{$message}}</p>
                    @enderror

                </div>

                                {{-- Num_seguro --}}
                <div class="mb-4">
                    <label for="num_seguro" class="mb-2 block uppercase text-cyan-700 font-bold">Numero Seguro</label>
                    <input type="text" name="num_seguro" id="num_seguro" placeholder="Numero Seguro"
                    class="border p-3 w-full rounded-3 @error('num_seguro') border-red-500 @enderror" value="{{old('num_seguro')}}" 
                    {{-- old funciona para no eliminar la casilla roja hasta que se quite el error --}}
                    />
                    {{-- Directiva para mostrar mensaje de error--}}
                    @error('num_seguro')
                        <p class="bg-red-500 text-black my-2 rounded-3 text-sm p-2 text-center"> {{$message}}</p>
                    @enderror

                </div>

                {{-- Preferente --}}
                <div class="mb-4">
                    <label for="preferente" class="mb-2 block uppercase text-cyan-700 font-bold">Preferente</label>
                    <input type="text" name="preferente" id="preferente" placeholder="Preferente"
                    class="border p-3 w-full rounded-3 @error('preferente') border-red-500 @enderror" value="{{old('preferente')}}" 
                    {{-- old funciona para no eliminar la casilla roja hasta que se quite el error --}}
                    />
                    {{-- Directiva para mostrar mensaje de error--}}
                    @error('preferente')
                        <p class="bg-red-500 text-black my-2 rounded-3 text-sm p-2 text-center"> {{$message}}</p>
                    @enderror

                </div>

                {{-- Fecha Nacimiento --}}
                <div class="mb-4">
                    <label for="fecha_nacimiento" class="mb-2 block uppercase text-cyan-700 font-bold">Fecha Nacimiento</label>
                    <input type="date" name="fecha_nacimiento" id="fecha_nacimiento"
                        class="border p-3 w-full rounded-3 @error('fecha_nacimiento') border-red-500 @enderror" value="{{ old('fecha_nacimiento') }}"
                        {{-- old funciona para no eliminar la casilla roja hasta que se quite el error --}}
                    />
                    {{-- Directiva para mostrar mensaje de error --}}
                    @error('fecha_nacimiento')
                        <p class="bg-red-500 text-black my-2 rounded-3 text-sm p-2 text-center"> {{$message}}</p>
                    @enderror
                </div>


                {{-- Email --}}
                <div class="mb-4">
                    <label for="email" class="mb-2 block uppercase text-cyan-700 font-bold">Email</label>
                    <input type="email" name="email" id="email" placeholder="Email"
                        class="border p-3 w-full rounded-3 @error('email') border-red-500 @enderror" value="{{old('email')}}">
                    {{-- Directiva para mostrar mensaje de error --}}
                    @error('email')
                        <span class="text-xs text-red-500 border-red-600 rounded">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="mb-4">
                    <label for="password" class="mb-2 block uppercase text-cyan-700 font-bold">Password</label>
                    <input type="password" name="password" id="password" placeholder="Password"
                        class="border p-3 w-full rounded-3 @error('password') border-red-500 @enderror" value="{{old('password')}}">
                    {{-- Directiva para mostrar mensaje de error --}}
                    @error('password')
                        <span class="text-xs text-red-500 border-red-600 rounded">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Confirm Password --}}
                <div class="mb-4">
                    <label for="password_confirmation" class="mb-2 block uppercase text-cyan-700 font-bold">Confirmar Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        placeholder="Confirmar Password"
                        class="border p-3 w-full rounded-3 @error('password_confirmation') border-red-500 @enderror" value="{{old('password_confirmation')}}">
                    {{-- Directiva para mostrar mensaje de error --}}
                    @error('password_confirmation')
                        <span class="text-xs text-red-500 border-red-600 rounded">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Submit --}}
                <div class="mb-4 flex justify-center">
                    <button type="submit" class="border w-full bg-blue-500 text-black p-3 rounded-3 font-bold mt-6 hover:bg-blue-600 transition-colors ">
                        Sign Up
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>