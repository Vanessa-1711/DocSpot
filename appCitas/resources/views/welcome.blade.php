<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href={{asset('img/apple-icon.png')}}>
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
      width: 300px; /* Ancho de la tarjeta */
      height: 300px; /* Largo de la tarjeta */
      margin: auto;
      box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
      border-radius: 15px; /* Bordes redondeados */
      overflow: hidden; /* Asegura que el contenido interno también se ajuste a los bordes redondeados */
    }

    .flip-card-front, .flip-card-back {
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
      transform: translateY(-5px);
      box-shadow: 0 15px 20px 0 rgba(0,0,0,0.3);
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
      background-color: #52a0ae;
      color: white;
      z-index: 2;
      display: flex; /* Usa flexbox para alinear los elementos */
      flex-direction: column; /* Los elementos se apilan verticalmente */
      align-items: center; /* Centra los elementos horizontalmente */
      justify-content: center; /* Centra los elementos verticalmente */
      text-align: center; /* Asegura que el texto esté centrado */
    }
  
    .flip-card-back {
      background-color: rgba(113, 185, 191, 0.9);
      color: white;
      transform: rotateY(180deg);
      z-index: 1;
    }
  
    .card-title, .card-text {
      margin: 0;
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
      color: white;
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
        <a class="navbar-brand m-0" href="{{ route('hospital.pacientes') }}" target="_blank">
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
    <br/>
    <div class="carrusel-container">
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
          <!-- Agrega más indicadores si tienes más imágenes -->
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img class="d-block w-100" src="{{ asset('img/logos/hos1.jpg') }}"" alt="Hospital 1">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="{{ asset('img/logos/hos1.jpg') }}"" alt="Hospital 2">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="{{ asset('img/logos/hos1.jpg') }}"" alt="Hospital 3">
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
    
    <div class="contenido-principal">
      <!-- Sección con el nuevo color de fondo y ancho ajustado -->
      <div class="row">
        <div class="col-md-4"> <!-- Ajusta esta clase según tu sistema de grillas -->
          <div class="fondo-aqua">
            <!-- Carrusel de imágenes -->
            <div class="carrusel">
              <!-- Aquí va el código HTML de tu carrusel -->
            </div>
          </div>
        </div>
      </div>

    <div class="container">
      <!-- Tarjetas para Misión, Visión y Valores -->
      <div class="row mb-4">
        <!-- Ejemplo de una Tarjeta de Misión -->
        <div class="col-md-4">
          <div class="custom-card-size">
            <div class="flip-card">
              <div class="flip-card-inner">
                <div class="flip-card-front">
                  <h5 class="card-title subtitulo">Misión</h5>
                  <div class="icon-container">
                    <svg xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512"><path d="M48 56c0-13.3-10.7-24-24-24S0 42.7 0 56V456c0 13.3 10.7 24 24 24s24-10.7 24-24V124.2l12.5-2.4c16.7-3.2 31.5-8.5 44.2-13.1l0 0 0 0c3.7-1.3 7.1-2.6 10.4-3.7c15.2-5.2 30.4-9.1 51.2-9.1c25.6 0 43 6 63.5 13.3l.5 .2c20.9 7.4 44.8 15.9 79.1 15.9c32.4 0 53.7-6.8 90.5-19.6V342.9l-9.5 3.3c-41.5 14.4-55.2 19.2-81 19.2c-25.7 0-43.1-6-63.6-13.3l-.6-.2c-20.8-7.4-44.8-15.8-79-15.8c-16.8 0-31 2-43.9 5c-12.9 3-20.9 16-17.9 28.9s16 20.9 28.9 17.9c9.6-2.2 20.1-3.7 32.9-3.7c25.6 0 43 6 63.5 13.3l.5 .2c20.9 7.4 44.8 15.9 79.1 15.9c34.4 0 56.4-7.7 97.8-22.2c7.5-2.6 15.5-5.4 24.4-8.5l16.2-5.5V360 72 38.4L416.2 49.3c-9.7 3.3-18.2 6.3-25.7 8.9c-41.5 14.4-55.2 19.2-81 19.2c-25.7 0-43.1-6-63.6-13.3l-.6-.2c-20.8-7.4-44.8-15.8-79-15.8c-27.8 0-48.5 5.5-66.6 11.6c-4.9 1.7-9.3 3.3-13.6 4.8c-11.9 4.3-22 7.9-34.7 10.3L48 75.4V56z"/></svg>  
                  </div>
                </div>
              <div class="flip-card-back">
                <p class="card-text">Breve descripción de la misión de DocSpot.</p>
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
                    <svg xmlns="http://www.w3.org/2000/svg" height="16" width="18" viewBox="0 0 576 512"><path d="M288 80c-65.2 0-118.8 29.6-159.9 67.7C89.6 183.5 63 226 49.4 256c13.6 30 40.2 72.5 78.6 108.3C169.2 402.4 222.8 432 288 432s118.8-29.6 159.9-67.7C486.4 328.5 513 286 526.6 256c-13.6-30-40.2-72.5-78.6-108.3C406.8 109.6 353.2 80 288 80zM95.4 112.6C142.5 68.8 207.2 32 288 32s145.5 36.8 192.6 80.6c46.8 43.5 78.1 95.4 93 131.1c3.3 7.9 3.3 16.7 0 24.6c-14.9 35.7-46.2 87.7-93 131.1C433.5 443.2 368.8 480 288 480s-145.5-36.8-192.6-80.6C48.6 356 17.3 304 2.5 268.3c-3.3-7.9-3.3-16.7 0-24.6C17.3 208 48.6 156 95.4 112.6zM288 336c44.2 0 80-35.8 80-80s-35.8-80-80-80c-.7 0-1.3 0-2 0c1.3 5.1 2 10.5 2 16c0 35.3-28.7 64-64 64c-5.5 0-10.9-.7-16-2c0 .7 0 1.3 0 2c0 44.2 35.8 80 80 80zm0-208a128 128 0 1 1 0 256 128 128 0 1 1 0-256z"/></svg>
                  </div>
                </div>
                <div class="flip-card-back">
                  <p class="card-text">Breve descripción de la misión de DocSpot.</p>
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
                    <svg xmlns="http://www.w3.org/2000/svg" height="16" width="20" viewBox="0 0 640 512"><path d="M272.2 64.6l-51.1 51.1c-15.3 4.2-29.5 11.9-41.5 22.5L153 161.9C142.8 171 129.5 176 115.8 176H96V304c20.4 .6 39.8 8.9 54.3 23.4l35.6 35.6 7 7 0 0L219.9 397c6.2 6.2 16.4 6.2 22.6 0c1.7-1.7 3-3.7 3.7-5.8c2.8-7.7 9.3-13.5 17.3-15.3s16.4 .6 22.2 6.5L296.5 393c11.6 11.6 30.4 11.6 41.9 0c5.4-5.4 8.3-12.3 8.6-19.4c.4-8.8 5.6-16.6 13.6-20.4s17.3-3 24.4 2.1c9.4 6.7 22.5 5.8 30.9-2.6c9.4-9.4 9.4-24.6 0-33.9L340.1 243l-35.8 33c-27.3 25.2-69.2 25.6-97 .9c-31.7-28.2-32.4-77.4-1.6-106.5l70.1-66.2C303.2 78.4 339.4 64 377.1 64c36.1 0 71 13.3 97.9 37.2L505.1 128H544h40 40c8.8 0 16 7.2 16 16V352c0 17.7-14.3 32-32 32H576c-11.8 0-22.2-6.4-27.7-16H463.4c-3.4 6.7-7.9 13.1-13.5 18.7c-17.1 17.1-40.8 23.8-63 20.1c-3.6 7.3-8.5 14.1-14.6 20.2c-27.3 27.3-70 30-100.4 8.1c-25.1 20.8-62.5 19.5-86-4.1L159 404l-7-7-35.6-35.6c-5.5-5.5-12.7-8.7-20.4-9.3C96 369.7 81.6 384 64 384H32c-17.7 0-32-14.3-32-32V144c0-8.8 7.2-16 16-16H56 96h19.8c2 0 3.9-.7 5.3-2l26.5-23.6C175.5 77.7 211.4 64 248.7 64H259c4.4 0 8.9 .2 13.2 .6zM544 320V176H496c-5.9 0-11.6-2.2-15.9-6.1l-36.9-32.8c-18.2-16.2-41.7-25.1-66.1-25.1c-25.4 0-49.8 9.7-68.3 27.1l-70.1 66.2c-10.3 9.8-10.1 26.3 .5 35.7c9.3 8.3 23.4 8.1 32.5-.3l71.9-66.4c9.7-9 24.9-8.4 33.9 1.4s8.4 24.9-1.4 33.9l-.8 .8 74.4 74.4c10 10 16.5 22.3 19.4 35.1H544zM64 336a16 16 0 1 0 -32 0 16 16 0 1 0 32 0zm528 16a16 16 0 1 0 0-32 16 16 0 1 0 0 32z"/></svg>
                  </div>
                </div>
                <div class="flip-card-back">
                  <p class="card-text">Breve descripción de la misión de DocSpot.</p>
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