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
  <div class="left-half" style="background-image: url('{{ asset('img/register/registro_persona.png') }}');">
    <!-- La imagen de fondo se maneja con CSS -->
  </div>

  <!-- Lado derecho con opciones -->
  <div class="right-half">
    <div class="form-container">
      <h2 class="text-4xl font-bold">REGISTRARSE</h2>
      <div class="flex flex-col gap-4">
        <div class="flex flex-row">
          <!-- Opción de registro para Paciente -->
          <div class="flex items-center justify-center">
              <a href="{{route('register_paciente')}}">
              <div class="contenedorImagen text-center p-4">
                  <img src="{{ asset('img/register/paciente.png') }}" alt="Paciente" class="mb-2 h-20 mx-auto oscurecer-img"/>
                  <span class="centradoImagen ">Paciente</span>
              </div>
              </a>
          </div>
          <!-- Opción de registro para Hospitales -->
          <div class="flex items-center justify-center">
              <div class="contenedorImagen text-center p-4">
                  <img src="{{ asset('img/register/hospitales.png') }}" alt="Hospitales" class="mb-2 h-20 mx-auto oscurecer-img"/>
                  <span class="centradoImagen text-black-100">Hospitales</span>
              </div>
          </div>
        </div>

        <!-- Opción de registro para Doctores Particulares -->
        <div class="flex items-center justify-center">
            <div class="contenedorImagen text-center p-4">
                <img src="{{ asset('img/register/medicos.png') }}" alt="Doctores particulares" class="mb-2 h-20 mx-auto oscurecer-img"/>
                <span class="centradoImagen text-black-100">Doctores Particulares</span>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>

