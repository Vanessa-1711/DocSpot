<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href={{asset('img/apple-icon.png')}}>
  <link rel="icon" type="image/png" href={{asset('img/favicon.png')}}>
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
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBDnW7dhpeqNoNOHeoQw6oLYHIXqk9W5YA&libraries=places&callback=initMap" async defer></script>

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

    #map {
        position: relative;
        height: 400px;
        border: 1px solid;
        border-radius: 20px;
        margin-top: 20px;
    }
    #direccion-container {
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        z-index: 2000 !important;
    }

    #direccion {
        top: 10px;    
        left: 10px;  
        z-index: 1000; 
        color: black;
        padding: 8px;
        border-radius: 10px;
        background-color: #fff;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        width: 400px;
    }
    #busqueda {
        position: fixed !important;
        top: 0 !important;
        left: 0 !important; /* Ajusta según tus necesidades */
        right: 0 !important; /* Esto asegurará que el div de búsqueda tenga el ancho completo */
        z-index: 999 !important;
    }





  </style>
</head>

<body class="bg-white">
<div class="cont">
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
                <form action="{{route('store_hospitales')}}" class="px-4" style="width: 100%;" method="post" novalidate>
                  @csrf
                    <div class="row mb-3">

                      <div class="col-md-6">
                        <div class="mb-5">
                          <label for="nombre" class="form-label subtitulo mx-3 my-0">Nombre(s)</label>
                          <input type="text" class="form-control  @error ('nombre') is-invalid @enderror"  value="{{old('nombre')}}" name="nombre" id="nombre" style="border-radius: 43px; height:50px; font-size:20px;">
                          @error ('nombre')
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
                        <label for="ubicacion" class="form-label subtitulo mx-3 my-0">Ubicación</label>}
                        <div style="position: relative;">
                            <div id="direccion-container">
                                <input style="box-shadow: 0 4px 8px rgba(165, 164, 163 );" type="text" id="direccion" placeholder="Buscar dirección" class="form-control mt-3">
                            </div>
                            <div id="map" style="height: 400px;"></div>
                        </div>
                        <input type="hidden" id="latitud" name="latitud">
                        <input type="hidden" id="longitud" name="longitud">
                        @error ('latitud')
                        <p class="invalid-feedback" >
                            {{$message}}
                        </p>
                        @enderror
                        @error ('longitud')
                        <p class="invalid-feedback" >
                            {{$message}}
                        </p>
                        @enderror
            
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
        <div class="mb-0  d-flex justify-content-center align-items-center">
          <a href="{{route('login')}}" class="btn btn-primary boton" style="margin-top:10px; background-color:rgb(65, 140, 167);color:white" >INICIAR SESIÓN</a>
        </div>
      </div>
  
    </div>
  </div>
  
  <!-- Botón Iniciar Sesión -->
  <script>
    let map;
    let marker;

    function initMap() {
        // Opciones del mapa
        const mapOptions = {
            center: { lat: 0, lng: 0 },
            zoom: 14,
            mapId: "c984a1c2512b6347",
        };
        // Crear el mapa con las opciones dadas
        map = new google.maps.Map(document.getElementById('map'), mapOptions);

        // Crear un marcador inicial con posición en latitud 0 y longitud 0
        marker = new google.maps.Marker({
            position: { lat: 0, lng: 0 },
            map: map,
            draggable: true
        });

        // Escuchar el evento 'dragend' para el marcador
        marker.addListener('dragend', function(event) {
            // Cuando el marcador cambie de posición, actualizar las coordenadas en el formulario
            document.getElementById('latitud').value = event.latLng.lat();
            document.getElementById('longitud').value = event.latLng.lng();
        });

        // Obtener el elemento de entrada para la dirección
        const input = document.getElementById('direccion');
        // Crear una caja de búsqueda de lugares de Google Maps
        const searchBox = new google.maps.places.SearchBox(input);

        // Escuchar el evento 'places_changed' cuando se seleccionen lugares en la caja de búsqueda
        searchBox.addListener('places_changed', function() {
            // Obtener los lugares seleccionados
            const places = searchBox.getPlaces();

            // Si no se seleccionó ningún lugar, salir de la función
            if (places.length === 0) {
                return;
            }

            // Obtener la ubicación del primer lugar seleccionado
            const ubicacion = places[0].geometry.location;
            // Centrar el mapa en la ubicación del lugar seleccionado
            map.setCenter(ubicacion);
            // Mover el marcador a la ubicación del lugar seleccionado
            marker.setPosition(ubicacion);

            // Actualizar los campos de latitud y longitud en el formulario con las coordenadas del lugar seleccionado
            document.getElementById('latitud').value = ubicacion.lat();
            document.getElementById('longitud').value = ubicacion.lng();
        });

        // Obtener la ubicación del usuario y centrar el mapa en ella al cargar la página
        obtenerUbicacionUsuario();
    }

    function obtenerUbicacionUsuario() {
        // Verificar si el navegador del usuario admite geolocalización
        if ("geolocation" in navigator) {
            // Obtener la posición del usuario
            navigator.geolocation.getCurrentPosition(function (position) {
                // Obtener las coordenadas de latitud y longitud
                const latitud = position.coords.latitude;
                const longitud = position.coords.longitude;
                // Crear una nueva ubicación con las coordenadas del usuario
                const ubicacionUsuario = new google.maps.LatLng(latitud, longitud);

                // Centrar el mapa en la ubicación del usuario
                map.setCenter(ubicacionUsuario);
                // Mover el marcador a la ubicación del usuario
                marker.setPosition(ubicacionUsuario);

                // Actualizar los campos de latitud y longitud en el formulario con las coordenadas del usuario
                document.getElementById('latitud').value = latitud;
                document.getElementById('longitud').value = longitud;
            });
        } else {
            // Mostrar un mensaje de alerta si el navegador no admite la geolocalización
            alert("Tu navegador no admite la geolocalización.");
        }
    }

    // Cuando se cargue el contenido del DOM, inicializar el mapa
    document.addEventListener('DOMContentLoaded', function() {
        initMap();
    });
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