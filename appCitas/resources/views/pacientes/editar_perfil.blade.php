<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href=>
  <link rel="icon" type="image/png" href=>
    
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link rel="stylesheet" href="{{asset('views/css/nucleo-icons.css')}}">
  <link rel="stylesheet" href="{{asset('views/css/nucleo-svg.css')}}">
  <link rel="stylesheet" href="{{asset('views/css/argon-dashboard-tailwind.css')}}">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- CSS Files -->
  <link id="pagestyle" href="{{asset('views/css/argon-dashboard.css?v=2.0.4')}}" rel="stylesheet" />
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
      position: fixed;
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
      border: 1px #b3b3b3 solid !important;
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

  </style>
</head>

<body class="bg-white">
  <div class="container d-flex align-items-center justify-content-center" style="height: 90vh;">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-8 col-lg-6">
        <div class="card p-3" style="background-color: #bedde7 !important">
          <div class="card-body">
            <h5 class="text-center titulo">Editar Perfil</h5>
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
                <input type="text" class="form-control @error ('apellido') is-invalid @enderror"  value="{{old('apellido', $paciente->apellido)}}" name="apellido" id="apellido" style="border-radius: 43px; height:50px; font-size:20px;">
                @error ('apellido')
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
              <!-- ... -->
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
                <input type="text" class="form-control @error ('curp') is-invalid @enderror"  value="{{old('curp', $paciente->curp)}}" name="curp" id="curp" style="border-radius: 43px; height:50px; font-size:20px;">
                @error ('curp')
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
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="{{asset('views/js/core/popper.min.js')}}"></script>
  <script src="{{asset('views/js/core/bootstrap.min.js')}}"></script>
  <script src="{{asset('views/js/plugins/perfect-scrollbar.min.js')}}"></script>
  <script src="{{asset('views/js/plugins/smooth-scrollbar.min.js')}}"></script>
  <script src="{{asset('views/js/plugins/chartjs.min.js')}}"></script>

  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{asset('views/js/argon-dashboard.min.js?v=2.0.4')}}"></script>
</body>

</html>