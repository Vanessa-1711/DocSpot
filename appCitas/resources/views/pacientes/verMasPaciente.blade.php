@extends('layouts.app')

@section('title', 'Hospitales')

@section('aside')
    @include('layouts.aside_pacientes')
@endsection

@section('content')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBDnW7dhpeqNoNOHeoQw6oLYHIXqk9W5YA&libraries=places&callback=initMap" async defer></script>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Allerta&family=Calistoga&display=swap');
    .nombreHospital{
      font-family: 'Allerta', sans-serif;
      color:black;
      font-size:36px;
      letter-spacing: 3px;
      text-align: center;
    }
    .contenedorPortada{
        display: flex;
        justify-content: center;
    }
    .img-container {
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 75vw; 
        height: 40vh;
    }
    .circle-container {
        position: absolute;
        width: 290px;
        height: 290px;
        margin-left: -70%;
        z-index:10;
        margin-top:20%;
        border-radius: 50%;
        
        padding: 1.5em;
        display: flex;
    }

    .circle-container img {
        max-width: 100%;
        max-height: 100%;
        border-radius: 50%;
        
    }
    .nombreDoc{
        width: 55%; 
        height: 10%;
        background-color:#9FC9D7; 
        padding: 10px; 
        font-size: 20px; 
        margin-left: 45%; 
        border-radius: 10px
    }
    .otroDiv{
        width: 55%; 
        min-height: 50%;
        background-color: #9FC9D7; 
        padding: 10px; 
        font-size: 20px; 
        margin-left: 45%; 
        border-radius: 10px;
        overflow: auto; 
    }
    .mapa {
        margin-top: 65%;
        margin-left: 0%;
        margin-right: 55%;
        width: 40%; /* Ajusta el valor según sea necesario para hacer el mapa más grande */
    }


</style>

<div class="container-fluid p-0 mt-6 d-flex justify-content-center align-items-center">
    <div class="img-container rounded">
        <img src="{{ asset('img/home-decor-2.jpg') }}" class="img-fluid w-100 h-100" style="object-fit: cover; border-radius: 15px;" alt="Tu Imagen">
    </div>
    <div class="circle-container">
        <img class="mx-0 my-0" src="{{ asset('img/marie.jpg') }}" alt="Foto de perfil">
    </div>
    <div class="mapa circle-container">
        <div id="map" style="width: 100%; height: 100%; border-radius: 10px;"></div>
    </div>
</div>

<div class="flex w-full justify-center items-center px-6 mt-4">
    <!-- Div derecho para la información del médico -->
    <div class="flex flex-col">
        <!-- Información del médico -->
        <div class="nombreDoc rounded-xl text-white mb-2 ml-2 mt-3 text-center">
            <div id="datos" class="flex py-0 px-5 mb-4">
                <h2 class="nombreHospital m-0 d-inline-block p-2">{{ $paciente->nombre }} {{ $paciente->apellido }}</h2>
            </div>
        </div>
        <!-- Div vacío -->
        <div class="otroDiv rounded-xl text-white mb-2 ml-2 text-center" style="flex: 1;">
            <!-- Inicio del formulario -->
            <form action="{{ route('update_paciente') }}" method="post" novalidate>
                @csrf
                
                <div class="mb-3">
                  <label for="nombre" class="form-label subtitulo mx-3 my-0">Nombre(s)</label>
                  <input type="text" class="form-control  @error ('nombre') is-invalid @enderror"  value="{{old('nombre', $paciente->nombre)}}" name="nombre" id="nombre" style="border-radius: 43px; height:50px; font-size:20px;">
                  @error ('nombre')
                    <p class="invalid-feedback" >
                        {{$message}}
                    </p>
                  @enderror
                </div>
                <div class="mb-5">
                    <label for="apellido" class="form-label subtitulo mx-3 my-0">Apellido(s)</label>
                    <input type="text" class="form-control @error ('apellido') is-invalid @enderror"  value="{{old('apellido', $paciente->apellido)}}" name="apellido" id="apellido" style="border-radius: 43px; height:50px; font-size:20px;">
                    @error ('apellido')
                      <p class="invalid-feedback" >
                          {{$message}}
                      </p>
                    @enderror
                </div>
                <div class="mb-5">
                  <label for="fecha_nacimiento" class="form-label subtitulo mx-3 my-0">Fecha de Nacimiento</label>
                  <input type="date" class="form-control @error ('fecha_nacimiento') is-invalid @enderror"  value="{{old('fecha_nacimiento', $paciente->fecha_nacimiento)}}" name="fecha_nacimiento" id="fecha_nacimiento" style="border-radius: 43px; height:50px; font-size:20px;">
                  @error ('fecha_nacimiento')
                    <p class="invalid-feedback" >
                        {{$message}}
                    </p>
                  @enderror
                </div>
                <div class="mb-5">
                  <label for="telefono" class="form-label subtitulo mx-3 my-0">Telefono</label>
                  <input type="text" class="form-control @error ('telefono') is-invalid @enderror"  value="{{old('telefono', $usuario->telefono)}}" name="telefono" id="telefono" style="border-radius: 43px; height:50px; font-size:20px;">
                  @error ('telefono')
                    <p class="invalid-feedback" >
                        {{$message}}
                    </p>
                  @enderror
                </div>
                <div class="mb-3">
                    <label for="curp" class="form-label subtitulo mx-3 my-0">CURP</label>
                    <input type="text" class="form-control @error ('curp') is-invalid @enderror"  value="{{old('curp', $paciente->curp)}}" name="curp" id="curp" style="border-radius: 43px; height:50px; font-size:20px;">
                    @error ('curp')
                      <p class="invalid-feedback" >
                          {{$message}}
                      </p>
                    @enderror
                  </div>
                <div class="mb-3">
                    <label for="username" class="form-label subtitulo mx-3 my-0">Username</label>
                    <input type="text" class="form-control @error ('username') is-invalid @enderror"  value="{{old('username', $usuario->username)}}"  name="username"  id="username" style="border-radius: 43px; height:50px; font-size:20px;">
                    @error ('username')
                      <p class="invalid-feedback" >
                          {{$message}}
                      </p>
                    @enderror
                  </div>
                <div class="mb-3">
                    <label for="email" class="form-label subtitulo mx-3 my-0">Correo electrónico</label>
                    <input type="email" class="form-control @error ('email') is-invalid @enderror"  value="{{old('email', $usuario->email)}}" name="email" id="email" style="border-radius: 43px; height:50px; font-size:20px;">
                    @error ('email')
                      <p class="invalid-feedback" >
                          {{$message}}
                      </p>
                    @enderror
                </div>
                <div class="mb-3">
                  <label for="password" class="form-label subtitulo mx-3 my-0">Contraseña</label>
                  <input type="password" class="form-control @error ('password') is-invalid @enderror"  value="{{old('password')}}"  name="password"  id="password" style="border-radius: 43px; height:50px; font-size:20px;">
                  @error ('password')
                    <p class="invalid-feedback" >
                        {{$message}}
                    </p>
                  @enderror
                </div>
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label subtitulo mx-3 my-0">Confirmar contraseña</label>
                    <input type="password" class="form-control @error ('password_confirmation') is-invalid @enderror"  value="{{old('password_confirmation')}}" name="password_confirmation" id="password_confirmation" style="border-radius: 43px; height:50px; font-size:20px;">
                    @error ('password_confirmation')
                      <p class="invalid-feedback" >
                          {{$message}}
                      </p>
                    @enderror
                </div>
                <!-- Botón de envío -->
                <div class="d-flex justify-content-center align-items-center">
                  <button type="submit" class="btn btn-primary boton">Guardar Cambios</button>
                </div>
              </form>
              <!-- Fin del formulario -->
        </div>
    </div>
</div>


@endsection

<!--   Core JS Files   -->
<script src="{{asset('js/core/popper.min.js')}}"></script>
<script src="{{asset('js/core/bootstrap.min.js')}}"></script>
<script src="{{asset('js/plugins/perfect-scrollbar.min.js')}}"></script>
<script src="{{asset('js/plugins/smooth-scrollbar.min.js')}}"></script>
<script src="{{asset('js/plugins/chartjs.min.js')}}"></script>
<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
<script src="{{asset('js/argon-dashboard.min.js?v=2.0.4')}}"></script>