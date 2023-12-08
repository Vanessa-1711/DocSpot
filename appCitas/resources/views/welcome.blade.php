<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href={{asset('img/apple-icon.png')}}>
  <link rel="icon" type="image/png" href={{asset('img/logos/hos.png')}}>
  <link rel="icon" type="image/png" href={{asset('img/logos/hos.png')}}>
  
  <title>
    DocSpot
  </title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

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
     @import url('https://fonts.googleapis.com/css2?family=Allerta&family=Calistoga&display=swap');

    .titulo-flotante:hover {
      /* Estilo para el efecto flotante */
      animation: flotar 2s ease-in-out infinite;
    }
  
    @keyframes flotar {
      0% { transform: translateY(0); }
      50% { transform: translateY(-10px); }
      100% { transform: translateY(0); }
    }
  
    .navbar-fija {
      position: fixed;
      top: 0;
      width: 100%;
      z-index: 1030;
    }
  
    .contenido-principal {
      padding-top: 80px; /* Ajusta este valor según la altura de tu barra de navegación */
    }
  
    .custom-card-size {
      width: 350px; /* Ancho de la tarjeta */
      height: 330px; /* Largo de la tarjeta */
      margin: auto;
      box-shadow: none;
      border-radius: 15px; /* Bordes redondeados */
      overflow: hidden; /* Asegura que el contenido interno también se ajuste a los bordes redondeados */
    }

    .flip-card-front, .flip-card-back {
      font-family: 'Allerta', sans-serif;
      position: absolute;
      width: 100%;
      height: 100%;
      backface-visibility: hidden;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 20px; /* Espaciado interno */
      border-radius: 15px; /* Bordes redondeados */
    }

    .custom-card-size:hover {
      box-shadow: none;
    }
  
    .flip-card {
      perspective: 1000px;
      height: 100%;
    }
  
    .flip-card-inner {
      position: relative;
      width: 100%;
      height: 100%;
      text-align: center;
      transition: transform 0.6s;
      transform-style: preserve-3d;
    }
  
    .flip-card:hover .flip-card-inner {
      transform: rotateY(180deg);
    }

    .flip-card-front {
      background-color: #85c0c3;
      color: white;
      z-index: 2;
      display: flex; /* Usa flexbox para alinear los elementos */
      flex-direction: column; /* Los elementos se apilan verticalmente */
      align-items: center; /* Centra los elementos horizontalmente */
      justify-content: center; /* Centra los elementos verticalmente */
      text-align: center; /* Asegura que el texto esté centrado */
    }
  
    .flip-card-back {
      background-color: #a2d1ce;
      color: black;
      transform: rotateY(180deg);
      z-index: 1;
      
    }
  
    .card-title, .card-text {
      margin: 0;
    }
    .card-text{
      font-size:20px;
    }
  
    .btn-outline-primary {
      background-color: #42A8A1;
      border-color: #52A0AE;
      color: #42A8A1;
    }

    .icon-container {
      /* Centra el ícono debajo del subtítulo */
      display: block; /* Cambia de 'flex' a 'block' para asegurar el salto de línea */
      text-align: center;
     }

    .icon-container svg {
      fill: white; /* Color del ícono */
      width: 60px; /* Tamaño del ícono */
      height: auto; /* Mantiene la proporción del ícono */
    }

    .btn-outline-primary:hover {
      background-color: #42A8A1;
      color: #298780 !important;
      border-color: #42A8A1;
    }
  
    .subtitulo {
      font-family: 'Allerta', sans-serif;
      color: #022e3d;
      font-size: 30px;
      letter-spacing: 3px;
    }

    .carrusel-container {
      width: 90vw; /* Make the carousel cover almost the entire window width */
      margin: 0 auto; /* Center the carousel */
      overflow: hidden; /* Hide overflow */
    }

    .carrusel-container .carousel-inner {
      height: 100%; /* Maintain the full height of the carousel */
    }

    .carrusel-container .carousel-inner img {
      width: 80%; /* Stretch images to fill the container */
      height: auto; /* Maintain aspect ratio */
      object-fit: cover; /* Cover the area without stretching the image */
    }
  </style>
  
</head>
<body>
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
          <a href="{{route('register')}}" class="btn btn-outline-primary m-2" style="color:white">Registrarse</a>
          <a href="{{route('login')}}" class="btn btn-outline-primary m-2" style="color:white">Iniciar Sesión</a>
        </div>
      </div>
    </nav>
  </div>

  
  <div class="contenido-principal">
    <div class="carrusel-container m-0 w-100">
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
          <!-- Agrega más indicadores si tienes más imágenes -->
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img class="d-block w-100" src="{{ asset('img/carousel1.png') }}"" alt="Hospital 1">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="{{ asset('img/carousel2.png') }}"" alt="Hospital 2">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="{{ asset('img/carousel3.png') }}"" alt="Hospital 3">
          </div>
          <!-- Agrega más elementos de carrusel para más imágenes -->
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Anterior</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Siguiente</span>
        </a>
      </div>
    </div>
    
    <div class="container-fluid  m-0 px-3  mt-5 w-100" >
      <!-- Tarjetas para Misión, Visión y Valores -->
      <div class="row mb-4 w-100 px-7" >
        <!-- Ejemplo de una Tarjeta de Misión -->
        <div class="col-md-4" >
          <div class="custom-card-size" >
            <div class="flip-card" >
              <div class="flip-card-inner">
                <div class="flip-card-front" >
                  <h5 class="card-title subtitulo">Misión</h5>
                  <div class="icon-container">
                    <img src="{{asset('img/mision.png')}}" height="230" width="230"></img>  
                  </div>
                </div>
              <div class="flip-card-back">
                <p class="card-text">Simplificar el acceso a la atención médica de calidad, ofreciendo una plataforma intuitiva para encontrar y reservar citas con profesionales confiables en minutos.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
        
        <!-- Tarjeta de Visión -->
        <div class="col-md-4">
          <div class="custom-card-size">
            <div class="flip-card">
              <div class="flip-card-inner">
                <div class="flip-card-front">
                  <h5 class="card-title subtitulo">Visión</h5>
                  <div class="icon-container">
                  <img src="{{asset('img/vision.png')}}" height="230" width="230"></img>  
                  </div>
                </div>
                <div class="flip-card-back">
                  <p class="card-text">Conectar a pacientes con los mejores médicos del mundo para una atención médica accesible y personalizada.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <!-- Tarjeta de Valores -->
        <div class="col-md-4">
          <div class="custom-card-size">
            <div class="flip-card">
              <div class="flip-card-inner">
                <div class="flip-card-front">
                  <h5 class="card-title subtitulo">Valores</h5>
                  <div class="icon-container">
                  <img src="{{asset('img/valores.png')}}" height="230" width="230"></img>  
                  </div>
                </div>
                <div class="flip-card-back">
                  <p class="card-text"><ul>
                    <li style="font-family: 'Allerta', sans-serif; font-size:20px">Excelencia en la atención</li>
                    <li style="font-family: 'Allerta', sans-serif; font-size:20px">Accesibilidad y comodidad</li>
                    <li style="font-family: 'Allerta', sans-serif; font-size:20px">Transparencia y confianza</li>
                    <li style="font-family: 'Allerta', sans-serif; font-size:20px">Ética y responsabilidad</li>
                    <li style="font-family: 'Allerta', sans-serif; font-size:20px">Innovación continua</li>
                  </ul></p>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</body>

</html>


<script>
  $('.carousel').carousel({
    interval: 5000 // Tiempo en milisegundos (5000 ms = 5 segundos)
  });

</script>