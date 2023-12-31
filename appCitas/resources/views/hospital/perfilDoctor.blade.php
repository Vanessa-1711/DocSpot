@extends('layouts.app')

@section('title', 'Hospitales')

@section('aside')
    @include('layouts.aside_hospitales')
@endsection

@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
        border-radius: 10px;
        height:auto;
    }
    .otroDiv {
        width: 55%; 
        height: auto; /* Cambiado de min-height a height */
        background-color: #9FC9D7; 
        padding: 20px; 
        font-size: 20px; 
        margin-left: 45%; 
        border-radius: 10px;
        text-align: left !important;
    }

    .circle-container-mapa {
        position: absolute;
        width: 290px;
        height: 290px;
        margin-left: -70%;
        z-index:10;
        margin-top:40%;
        border-radius: 50%;
        padding: 1.5em;
        display: flex;
    }
    .mapa {
        margin-top: 83%;
        margin-left: 0%;
        margin-right: 52%;
        width: 43%; /* Ajusta el valor según sea necesario para hacer el mapa más grande */
        height: 43%;
    }
    #map {
            width: 100%;
            height: 100%;
            border-radius: 10px;
            border: 1px solid;
    }
    .btn-white {
        color: #000000; /* Color del texto */
        background-color: #ffffff; /* Color de fondo blanco */
        border: 2px solid #42A8A1; /* Color del borde inicial */
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .btn-white:hover {
        color: #000000 !important ; /* Cambia el color del texto al pasar el ratón */
        border-color: #000000 !important; /* Cambia el color del borde al pasar el ratón */
    }


    


</style>
<div class="container-fluid p-0 mt-5 d-flex justify-content-center align-items-center">
    <a href="{{ route('hospital.docAsociados') }}" class="w-100 btn btn-link text-decoration-none m-0" style="text-align: left; color: #42A8A1">
        <i class="fas fa-arrow-left"></i> Volver
    </a>
</div>
<div class="container-fluid p-0 mt-2 d-flex justify-content-center align-items-center">
    @if(session('mensaje'))
    <script>
        Swal.fire({
        title: 'Éxito',
        text: '{{ session('mensaje') }}',
        icon: 'success',
        timer: 4000, 
        timerProgressBar: true,
        showConfirmButton: false,
        });
    </script>
@endif
    <div class="img-container rounded">
        <img src="{{ asset('img/perfilDoc.png') }}" class="img-fluid w-100 h-100" style="object-fit: cover; border-radius: 15px;" alt="Tu Imagen">
    </div>
    <div class="circle-container">
        <img class="mx-0 my-0" src="{{ asset('img/doc.png') }}" alt="Foto de perfil">
    </div>
    <div class="mapa circle-container-mapa">
    @if($medico->hospital_id)
        <div id="map" data-lat="{{$medico->hospital->latitud}}" data-lng="{{$medico->hospital->longitud}}"></div>
    @else
        <div id="map" data-lat="{{$medico->latitud}}" data-lng="{{$medico->longitud}}"></div>
    @endif
    </div>
</div>

<div class="flex w-full justify-center items-center px-6 mt-4">
    <!-- Div derecho para la información del médico -->
    <div class="flex flex-col">
        <!-- Información del médico -->
        <div class="nombreDoc rounded-xl text-white mb-2 ml-2 mt-3 text-center">
            <div id="datos" class="flex py-0 px-5 ">
                <h2 class="nombreHospital m-0 d-inline-block p-2">{{ $medico->nombre }} {{ $medico->apellido }}</h2>
            </div>
        </div>

        <!-- Div vacío -->
        <div class="otroDiv rounded-xl text-white mb-2 ml-2 text-center custom-height" style="flex: 1; padding: 20px; background-color: #9FC9D7; text-align: left!important;">
            <!-- Información adicional del médico con iconos -->
            <div style="margin-bottom: 10px;">
                <i class="fas fa-envelope fa-lg"></i> <strong>Correo:</strong>
                <br>
                <span style="font-weight: normal;">{{ $medico->user->email }}</span>
            </div>
            <div style="margin-bottom: 10px;">
                <i class="fas fa-phone fa-lg"></i> <strong>Teléfono:</strong>
                <br>
                <span style="font-weight: normal;">{{ $medico->user->telefono }}</span>
            </div>
            <div>
                <i class="far fa-clock fa-lg"></i> <strong>Horarios:</strong>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <!-- Primeras 4 horas -->
                        @foreach($horarios->take(4) as $horario)
                            <span>{{ $horario->dia }}: {{ $horario->hora_inicio }} - {{ $horario->hora_fin }}</span><br>
                        @endforeach
                    </div>
                    <div class="col-md-6">
                        <!-- Últimas 3 horas -->
                        @foreach($horarios->slice(4) as $horario)
                            <span>{{ $horario->dia }}: {{ $horario->hora_inicio }} - {{ $horario->hora_fin }}</span><br>
                        @endforeach
                    </div>
                </div>
                <br>
                <!-- Información adicional agregada -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-2">
                            <i class="fas fa-birthday-cake fa-lg"></i> <strong>Fecha de Nacimiento:</strong>
                            <span style="font-weight: normal;">{{ $medico->fecha_nacimiento }}</span>
                        </div>
                        <div class="mb-2">
                            <i class="fas fa-user fa-lg"></i> <strong>Username:</strong>
                            <span style="font-weight: normal;">{{ $medico->user->username }}</span>
                        </div>
                        <div class="mb-2">
                            <i class="fas fa-hospital fa-lg"></i> <strong>Hospital:</strong>
                            <span style="font-weight: normal;">{{ $medico->hospital->nombre }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Botón "Editar Perfil" con icono -->
            <a href="{{ route('hospital.editarDoc', ['id' => $medico->id]) }}" class="btn btn-sm btn-primary btn-white">
                <i class="fas fa-edit"></i> Editar Perfil
            </a>
        </div>
        
        
    </div>
</div>








<script>
    let map;

    function initMap() {
        // Opciones del mapa
        const map = new google.maps.Map(document.getElementById('map'), {
            center: { lat: 0, lng: 0 },
            zoom: 14,
            mapId: "c984a1c2512b6347",
            styles: [
                {
                    "featureType": "poi",
                    "elementType": "labels",
                    "stylers": [
                        { "visibility": "off" }
                    ]
                }
            ]
        });

        const latitud = parseFloat(document.getElementById('map').dataset.lat);
        const longitud = parseFloat(document.getElementById('map').dataset.lng);

        const medicoMarker = new google.maps.Marker({
            position: { lat: latitud, lng: longitud },
            map: map,
            title: "Ubicación del médico",
        });

        map.setCenter({ lat: latitud, lng: longitud });


        // Mostrar las coordenadas en el título del marcador
        medicoMarker.setTitle("Ubicación del medico - Latitud: " + latitud + ", Longitud: " + longitud);
    }

    document.addEventListener('DOMContentLoaded', function() {
        initMap();
    });
</script>


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