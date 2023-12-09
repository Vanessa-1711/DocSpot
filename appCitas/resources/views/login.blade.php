<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href={{asset('img/apple-icon.png')}}>
  <link rel="icon" type="image/png" href={{asset('img/favicon.png')}}>
  <link rel="icon" type="image/png" href={{asset('img/logos/hos.png')}}>
  
  <title>
    Iniciar Sesión
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link rel="stylesheet" href="{{asset('css/nucleo-icons.css')}}">
  <link rel="stylesheet" href="{{asset('css/nucleo-svg.css')}}">
  <link rel="stylesheet" href="{{asset('css/argon-dashboard-tailwind.css')}}">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- CSS Files -->
  <link id="pagestyle" href="{{asset('css/argon-dashboard.css?v=2.0.4')}}" rel="stylesheet" />
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Allerta&family=Calistoga&display=swap');
    .btn-outline-primary:hover {
      background-color: #42A8A1;
      color: #298780 !important;
      border-color: #42A8A1;
    }
    .btn-outline-primary {
      background-color: #42A8A1;
      border-color: #52A0AE;
      color: white !important;
    }
    .titulo{
      font-family: 'Calistoga', serif;
      color:black;
      font-size:50px;
      letter-spacing: 3px;
    }
    .subtitulo{
      font-family: 'Allerta', sans-serif;
      color:black;
      font-size:20px;
      letter-spacing: 3px;
    }
    .cont {
      display: flex;
      top: 0;
      bottom: 0;
      width: 100%;
      overflow-y: auto;
      padding: 0;
      box-shadow: none;
      background-color:#fff;
    }
    .boton{
      margin-top:20px;
      background-color:white; 
      color:black;
      font-family: 'Allerta', sans-serif;
      font-size:20px;
      border: border: 1px #b3b3b3 solid !important;
      border-radius: 20px;
      width:300px;
    }
    .cont-2 {
      flex: 1; /* Ocupa todo el espacio posible */
      display: flex;
      align-items: center; /* Centra verticalmente el contenido */
      justify-content: center; /* Centra horizontalmente el contenido */
     
    }

    @media (max-width: 767px) {
      .cont-2:first-child {
        display: none; /* Oculta el primer .cont-2 en dispositivos móviles */
      }
    }
    .navbar-fija {
      position: fixed;
      top: 0;
      width: 100%;
      z-index: 1030;
    }


  </style>
</head>

<body class="bg-white">
  <div class="navbar-fija">
    <nav class="navbar navbar-expand-lg navbar-light bg-light align-items-center">
      <div class="container-fluid">
        <!-- Logo a la izquierda -->
        <a class="navbar-brand m-0" href="/" >
          <img src="{{ asset('img/logos/hos.png') }}" class="navbar-brand-img h-100" alt="main_logo" style="width: 50px;">
          <span class="ms-1 text-white font-weight-bold" style="font-size: 22px;">DocSpot</span>
        </a>
        <!-- Botones "Sign In" y "Sign Up" a la derecha -->
        <div class="navbar-nav ml-auto">
          <a href="{{route('register')}}" class="btn btn-outline-primary m-2" style="color:white">Registrarse</a>
        </div>
      </div>
    </nav>
  </div>
  <div class="cont mt-5" style="height:100vh">
    <div class="cont-2" style="background-image:url('{{asset('img/doc2.png')}}') ">
    </div>
    <div class="cont-2 p-5">
      <div class="d-flex align-items-center justify-content-center h-custom-2 w-100 h-100" style="height:auto !important">
        <div class="card p-5 w-100 h-100 justify-content-start align-items-center bg-primary" >
          <div class="card-body p-0 w-100 " >
            <div class="w-100 justify-content-center align-items-start py-4 px-0" style=" background-color: rgba(252,252,252,0.7); border-radius:1rem; height:80%;">
            <form class="px-4" style="width: 100%;" action="{{route('login')}}" method="POST" novalidate>
              @csrf
              <div class="mb-4 justify-center">
                <h5 class=" text-center titulo" >INICIAR SESIÓN</h5>
              </div>
              
              @error('mensaje')
              <script>
                  Swal.fire({
                      title: 'Error al acceder',
                      text: '{{ $message }}',
                      icon: 'error',
                      timer: 1000, 
                      timerProgressBar: true,
                      showConfirmButton: false,
                  });
              </script>
              @enderror

              <div class="mb-3">
                <label for="username" class="form-label subtitulo mx-3 my-0">NOMBRE DE USUARIO </label>
                <input type="text" style="border-radius: 43px; height:50px; font-size:20px" class="form-control @error ('username') is-invalid @enderror"  value="{{old('username')}}" name="username" id="username">
                @error ('username')
                  <p class="invalid-feedback" >
                      {{$message}}
                  </p>
                @enderror
              </div>
                
              <div class="mb-3">
                <label for="password" class="form-label  subtitulo mx-3 my-0">CONTRASEÑA</label>
                <input type="password" style="border-radius: 43px; height:50px; font-size:20px" id="password" name="password" class="form-control @error ('password') is-invalid @enderror"  value="{{old('password')}}" aria-describedby="passwordHelpBlock">
                @error ('password')
                  <p class="invalid-feedback" >
                      {{$message}}
                  </p>
                @enderror
              </div>
              <div class=" d-flex justify-content-center align-items-center">
                <button type="submit" class="btn btn-primary boton" >INICIAR SESIÓN</button>
              </div>
            </form>
            </div>
            
          </div>
        </div>
      </div>
    </div>
  </div>
  
 
  
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
</body>

</html>