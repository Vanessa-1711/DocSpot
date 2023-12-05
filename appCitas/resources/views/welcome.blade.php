<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href={{asset('img/apple-icon.png')}}>
  <link rel="icon" type="image/png" href={{asset('img/favicon.png')}}>
  <title>
    DocSpot
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link rel="stylesheet" href="{{asset('css/nucleo-icons.css')}}">
  <link rel="stylesheet" href="{{asset('css/nucleo-svg.css')}}">
  <link rel="stylesheet" href="{{asset('css/argon-dashboard-tailwind.css')}}">
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- CSS Files -->
  <link id="pagestyle" href="{{asset('css/argon-dashboard.css?v=2.0.4')}}" rel="stylesheet" />
  <style>
    .bt-sign-up:hover {
    background-color: #4156d1 !important;
  }
  </style>
</head>
<body>
<div class="container w-full top-0 p-0" style="max-width: 100%; position: fixed; z-index: 9999;">
    <div class="row">
      <nav class="navbar navbar-expand-lg navbar-light bg-light align-items-center">
        <div class="container-fluid">
          <!-- Logo a la izquierda -->
          <a class="navbar-brand" href="#">Logo</a>
          
          <!-- Botones "Sign In" y "Sign Up" a la derecha -->
          <div class="navbar-nav ml-auto">
            <a href="{{route('register')}}" class="btn btn-outline-primary m-2">Registrarse</a>
            <a href="{{route('login')}}" class="btn btn-primary m-2 bt-sign-up" style="color:white">Iniciar Sesión</a>
          </div>
        </div>
      </nav>
    </div>
  </div>
  
</body>

</html>