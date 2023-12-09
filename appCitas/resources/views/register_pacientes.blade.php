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

    .image-input-container {
  display: inline-block;
  position: relative;
  margin-left: 30%;
}

.image-input-container label {
  display: flex;
  justify-content: center;
  align-items: center;
  width: 150px;
  height: 150px;
  border-radius: 50%;
  border: 2px solid #ccc;
  cursor: pointer;
  background: #FFFFFF;
}

.image-input-container label i {
  font-size: 50px;

}

.image-input-container label .selected-image {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  border-radius: 50%;
  background-size: cover;
  background-position: center;
}

.image-input-container input[type="file"] {
  display: none;
}
.navbar-fija {
      position: fixed;
      top: 0;
      width: 100%;
      z-index: 2000;
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
        <a class="navbar-brand m-0" href="/" >
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
    <div class="cont-2 p-5" style="overflow-y: auto;">
      <div class="container" style="height: 90vh">
        <div class=" d-flex align-items-center justify-content-center h-custom-2 w-100 h-100" style="height:auto !important">
          <div class="card p-3 w-100 h-100 justify-content-start align-items-center" style="background-color: #bedde7 !important">
            <div class="mb-2 justify-center">
              <h5 class=" text-center titulo" >REGISTRARSE</h5>
            </div>
            <div class="card-body p-0 w-100 mb-4 " >
              <div class="w-100 imga justify-content-center align-items-start py-0 px-0" >
                <!--aqui formulario-->
                <form action="{{route('hospital.agregarDoc')}}" class="px-4" style="width: 100%;" method="post" novalidate>
                  @csrf
                    <div class="row mb-3">

                      <div class="col-md-6">
                        <div class="mb-3">
                          <label for="nombre" class="form-label subtitulo mx-3 my-0">Nombre(s)</label>
                          <input type="text" class="form-control  @error ('nombre') is-invalid @enderror"  value="{{old('nombre')}}" name="nombre" id="nombre" style="border-radius: 43px; height:50px; font-size:20px;">
                          @error ('nombre')
                            <p class="invalid-feedback" >
                                {{$message}}
                            </p>
                          @enderror
                        </div>

                        <div class="mb-5">
                          <label for="fecha_nacimiento" class="form-label subtitulo mx-3 my-0">Fecha de Nacimiento</label>
                          <input type="date" class="form-control @error ('fecha_nacimiento') is-invalid @enderror"  value="{{old('fecha_nacimiento')}}" name="fecha_nacimiento" id="fecha_nacimiento" style="border-radius: 43px; height:50px; font-size:20px;">
                          @error ('fecha_nacimiento')
                            <p class="invalid-feedback" >
                                {{$message}}
                            </p>
                          @enderror
                        </div>
                        <div class="mb-5">
                          <label for="telefono" class="form-label subtitulo mx-3 my-0">Telefono</label>
                          <input type="text" class="form-control @error ('telefono') is-invalid @enderror"  value="{{old('telefono')}}" name="telefono" id="telefono" style="border-radius: 43px; height:50px; font-size:20px;">
                          @error ('telefono')
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
                        
                      </div>
                      <div class="col-md-6">
                        <div class="mb-5">
                          <label for="apellido" class="form-label subtitulo mx-3 my-0">Apellido(s)</label>
                          <input type="text" class="form-control @error ('apellido') is-invalid @enderror"  value="{{old('apellido')}}" name="apellido" id="apellido" style="border-radius: 43px; height:50px; font-size:20px;">
                          @error ('apellido')
                            <p class="invalid-feedback" >
                                {{$message}}
                            </p>
                          @enderror
                        </div>
                        <div class="mb-3">
                          <label for="username" class="form-label subtitulo mx-3 my-0">Username</label>
                          <input type="text" class="form-control @error ('username') is-invalid @enderror"  value="{{old('username')}}"  name="username"  id="username" style="border-radius: 43px; height:50px; font-size:20px;">
                          @error ('username')
                            <p class="invalid-feedback" >
                                {{$message}}
                            </p>
                          @enderror
                        </div>
                        <!-- ... -->
                        <div class="mb-3">
                          <label for="email" class="form-label subtitulo mx-3 my-0">Correo electrónico</label>
                          <input type="email" class="form-control @error ('email') is-invalid @enderror"  value="{{old('email')}}" name="email" id="email" style="border-radius: 43px; height:50px; font-size:20px;">
                          @error ('email')
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
                      </div>

                      <div class="col-md-12">
                        <!-- Segundo grupo de campos -->
                        <div class="mb-3">
                          <label for="curp" class="form-label subtitulo mx-3 my-0">CURP</label>
                          <input type="text" class="form-control @error ('curp') is-invalid @enderror"  value="{{old('curp')}}" name="curp" id="curp" style="border-radius: 43px; height:50px; font-size:20px;">
                          @error ('curp')
                            <p class="invalid-feedback" >
                                {{$message}}
                            </p>
                          @enderror
                        </div>
                        <!--<div class="image-input-container mb-3">
                          <label for="fotografia">
                            <svg xmlns="http://www.w3.org/2000/svg" height="3em" viewBox="0 0 512 512"><style>svg{fill:#d3d3d3}</style><path d="M149.1 64.8L138.7 96H64C28.7 96 0 124.7 0 160V416c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V160c0-35.3-28.7-64-64-64H373.3L362.9 64.8C356.4 45.2 338.1 32 317.4 32H194.6c-20.7 0-39 13.2-45.5 32.8zM256 192a96 96 0 1 1 0 192 96 96 0 1 1 0-192z"/></svg>
                        
                            <span class="selected-image" style="background-image: url('{{ Session::get('imagen_cargada') }}')"></span>
                            <input type="file" class="@error ('fotografia') is-invalid @enderror" id="fotografia" name="fotografia" value="{{old('fotografia')}}" accept="image/*" onchange="handleImageUpload(event)" />
                            @error ('fotografia')
                            <p class="invalid-feedback" >
                                {{$message}}
                            </p>
                          @enderror
                        </label>
                        </div>-->
                      </div>
                      
                    </div>
                    <div class="d-flex justify-content-center align-items-center">
                      <button type="submit" class="btn btn-primary boton">Enviar</button>
                    </div>
                  </form>
              </div>
            </div>
          </div>
        </div>
       
      </div>
  
    </div>
  </div>
  
  <!-- Botón Iniciar Sesión -->
  <script>
		
		function handleImageUpload(event) {
		  const input = event.target;
		  const imageContainer = input.parentElement;
		  const selectedImage = imageContainer.querySelector('.selected-image');

		  const file = input.files[0];
		  const reader = new FileReader();

		  reader.onload = function (e) {
			console.log(e.target.result);
		    selectedImage.style.backgroundImage = `url(${e.target.result})`;
		  };

		  reader.readAsDataURL(file);
		}
	</script>
 
  
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