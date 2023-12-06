@extends('layouts.app')

@section('title', 'Hospitales')

@section('aside')
    @include('layouts.aside_pacientes')
@endsection

@section('content')
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
        border-radius: 10px
    }
    .otroDiv{
        width: 55%; 
        height: 50%;
        background-color:#9FC9D7; 
        padding: 10px; 
        font-size: 20px; 
        margin-left: 45%; 
        border-radius: 10px
    }
    .mapa {
        margin-top: 65%;
        margin-left: 0%;
        margin-right: 55%;
        width: 40%; /* Ajusta el valor según sea necesario para hacer el mapa más grande */
    }


</style>

<div class="container-fluid p-0 mt-6 d-flex justify-content-center align-items-center">
    <div class="img-container rounded">
        <img src="{{ asset('img/perfilDoc.png') }}" class="img-fluid w-100 h-100" style="object-fit: cover; border-radius: 15px;" alt="Tu Imagen">
    </div>
    <div class="circle-container">
        <img class="mx-0 my-0" src="{{ asset('img/marie.jpg') }}" alt="Foto de perfil">
    </div>
    <div class="mapa circle-container">
        <div id="map" style="width: 100%; height: 100%; border-radius: 10px;"></div>
    </div>
</div>

<div class="flex w-full justify-center items-center px-6 mt-4">
    <!-- Div derecho para la información del médico -->
    <div class="flex flex-col">
        <!-- Información del médico -->
        <div class="nombreDoc rounded-xl text-white mb-2 ml-2 mt-3 text-center">
            <div id="datos" class="flex py-0 px-5 mb-4">
                <h2 class="nombreHospital m-0 d-inline-block p-2">{{ $medico->nombre }} {{ $medico->apellido }}</h2>
            </div>
        </div>

        <!-- Div vacío -->
        <div class="otroDiv rounded-xl text-white mb-2 ml-2 text-center" style="flex: 1;">
            <!-- Contenido del segundo div -->
        </div>
    </div>
</div>








<script>
    var map;
    var userMarker;
    var gymMarkers = [];

    function initMap() {
        // Opciones del mapa
        var mapOptions = {
            zoom: 15,
            mapId: "c984a1c2512b6347",
        };

        // Crear el mapa en el elemento con id "map"
        map = new google.maps.Map(document.getElementById('map'), mapOptions);

        // Obtener las coordenadas del medico desde la base de datos
        var latitud = {{$medico->latitud}};
        var longitud = {{$medico->longitud}};

        // Crear un marcador para el gimnasio
        var gymMarker = new google.maps.Marker({
            position: { lat: latitud, lng: longitud },
            map: map,
            title: "Ubicación del medico",
        });

        // Agregar el marcador del gimnasio a la lista de marcadores
        gymMarkers.push(gymMarker);

        // Centrar el mapa en la ubicación del gimnasio
        map.setCenter({ lat: latitud, lng: longitud });

        // Mostrar las coordenadas en el título del marcador
        gymMarker.setTitle("Ubicación del medico - Latitud: " + latitud + ", Longitud: " + longitud);
    }

    // Inicializar el mapa cuando se cargue la página
    initMap();
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