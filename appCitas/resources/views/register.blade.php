<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href={{asset('img/apple-icon.png')}}>
  <link rel="icon" type="image/png" href={{asset('img/favicon.png')}}>
  <link rel="icon" type="image/png" href={{asset('img/logos/hos.png')}}>
  
  <title>
    Registrarse
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
      max-width: 100%;
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

    .imga {
      position: relative;
      display: flex;
      flex-direction: column; /* Muestra las imágenes una encima de la otra */
      justify-content: center !important;
      align-items: center !important;
    }

    .circular-image {
      position: relative;
      width: 180px; /* Ajusta el tamaño de la imagen según sea necesario */
      height: 180px;
      border-radius: 50%; /* Hace que la imagen sea circular */
      background-size: cover;
      background-position: center;
      margin: 10px 0; /* Agrega margen arriba y abajo para separar las imágenes */
      display: flex;
      justify-content: center;
      align-items: center;
      position: relative;
      overflow: hidden; /* Oculta el contenido que se sale del círculo */
    }

    .circular-image::after {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      border-radius: 50%; /* Hace que el div sea circular igual que la imagen */
      background-color: rgba(0, 0, 0, 0.5); /* Fondo gris */
      opacity: 0;
      transition: opacity 0.3s ease; /* Transición suave */
    }

    .circular-image:hover::after {
      opacity: 1; /* Hace que el div gris sea visible al pasar el cursor por encima */
    }

    .circular-image span.overlay-text {
      font-family: 'Allerta', sans-serif;
      font-style: normal;
      font-weight: 400;
      font-size: 30px;
      line-height: 48px;
      text-align: center;
      text-transform: uppercase;
      color: #FFFFFF;
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      opacity: 0; /* Inicialmente oculto */
      transition: opacity 0.3s ease; /* Transición suave */
      z-index: 1; /* Establece una capa superior para el texto */
    }

    .circular-image:hover span.overlay-text {
      opacity: 1; /* Hace que el texto sea visible al pasar el cursor por encima */
    }

    .navbar-fija {
      position: fixed;
      top: 0;
      width: 100%;
      z-index: 1030;
    }
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





  </style>
</head>

<body class="bg-white">
<div class="navbar-fija">
  <nav class="navbar navbar-expand-lg navbar-light bg-light align-items-center">
    <div class="container-fluid">
      <!-- Logo a la izquierda -->
      <a class="navbar-brand m-0"  href="/">
        <img src="{{ asset('img/logos/hos.png') }}" class="navbar-brand-img h-100" alt="main_logo" style="width: 50px;">
        <span class="ms-1 text-white font-weight-bold" style="font-size: 22px;">DocSpot</span>
      </a>
      <!-- Botones "Sign In" y "Sign Up" a la derecha -->
      <div class="navbar-nav ml-auto">
        <a href="{{route('login')}}" class="btn btn-outline-primary m-2" style="color:white">Iniciar Sesión</a>
      </div>
    </div>
  </nav>
</div>
<div class="cont mt-5" style="height:100vh">
    <div class="cont-2" style="background-image:url('{{asset('img/doc2.png')}}') "></div>
    <div class="cont-2 p-5">
      <div class="container">
      <div class="d-flex align-items-center justify-content-center h-custom-2 w-100 h-100" style="height:auto !important">
        <div class="card p-3 w-100 h-100 justify-content-start align-items-center" style="background-color: #bedde7 !important">
          <div class="mb-2 justify-center">
            <h5 class=" text-center titulo" >REGISTRARSE</h5>
          </div>
          <div class="card-body p-0 w-100 mb-4 " >
            <div class="w-100 imga justify-content-center align-items-start py-0 px-0" >
              <!-- Primera imagen circular con enlace -->
              <a href="{{route('register_pacientes')}}">
                <div class="circular-image" style="background-image:url('{{asset('img/paciente.jpg')}}')">
                  <span class="overlay-text">Paciente</span>
                </div>
              </a>
              <!-- Segunda imagen circular con enlace -->
              <a href="{{route('register_hospitales')}}">
                <div class="circular-image" style="background-image:url('{{asset('img/hospital.jpg')}}')">
                  <span class="overlay-text">Hospital</span>
                </div>
              </a>
            </div>
          </div>
        </div>
      </div>
    
      </div>
  
    </div>
  </div>
  
  <!-- Botón Iniciar Sesión -->
  
 
  
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