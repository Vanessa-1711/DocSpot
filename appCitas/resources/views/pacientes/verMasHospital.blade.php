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
    }
    .medico{
        font-family: 'Allerta', sans-serif;
        color:black;
        background-color: #52A0AE;
        font-size:30px;
    }
    .linea{
        width: 80%;
        border-top: 2px solid #000000 !important;
        margin-bottom: 2%;
        margin-left: auto;
        margin-right: auto;

    }
    .custom-card {
        margin-bottom: 0; /* Puedes ajustar este valor según tus preferencias */
    }

    .card-btn a.btn-citas {
        background-color: #42A8A1;
        color: #ffffff;
        border: 2px solid #42A8A1;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .card-btn a.btn-citas:hover {
        background-color: #ffffff !important;
        color: #42A8A1 !important;
        border-color: #42A8A1 !important;
    }
    .search-container {
        display: flex;
        border-radius: 20px; /* Ajusta según tus preferencias */
        overflow: hidden;
        width: 45%; /* Ajusta el ancho del buscador según tus preferencias */
        margin-right: 4% !important;
    }

    .search-container input {
        flex: 1;
        padding: 1%; /* Ajusta el padding para hacer el input más pequeño */
        box-sizing: border-box;
        border: none;
        border-radius: 20px;
        height: 40px; /* Ajusta la altura del input según tus preferencias */
        font-size: 14px; /* Ajusta el tamaño de la letra en el input */
        color: #000; /* Color del texto al escribir */
        background-color: #fff; /* Fondo del input al escribir */
        border: 1px solid #52A0AE; /* Borde del input */
    }

    .search-container input:focus {
        outline: none;
        border-color: #42A8A1; /* Color del borde al enfocar el input */
    }
    .search-container input::clear {
        display: none; /* Oculta el icono de limpieza por defecto */
    }

    .search-container input:not(:placeholder-shown)::clear {
        display: inline; /* Muestra el icono de limpieza cuando hay texto */
        cursor: pointer;
    }
</style>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if(!$registro)
    <script>
    Swal.fire({
        title: '¡Aún no estás asociado a este hospital!',
        html: 'Ingresa tu número de seguro: <input type="text" id="inputField" class="swal2-input">',
        showCancelButton: true,
        confirmButtonText: 'Asociarse',
        cancelButtonText: 'Cancelar',
        confirmButtonColor: '#42A8A1',
        allowOutsideClick: false,
        allowEscapeKey: false,
        allowEnterKey: false,
        focusConfirm: false,
        preConfirm: () => {
            const inputValue = document.getElementById('inputField').value;
            if (!inputValue) {
                Swal.showValidationMessage('Debes ingresar tu número de seguro');
            }
            return { inputValue: inputValue };
        }
    }).then((result) => {
        if (result.isConfirmed) {
            const inputValue = result.value.inputValue;
            const hospitalId = {{ $hospital->id }};

            // Realizar una petición AJAX al controlador
            fetch(`/asociar/${hospitalId}/${inputValue}`, {
                method: 'GET'
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Redireccionar a la página deseada si la respuesta es exitosa
                    Swal.fire({
                        title: 'Éxito',
                        text: 'La asociación al hospital se completó',
                        icon: 'success',
                        showConfirmButton: false, // No muestra el botón de confirmación
                        timer: 3000, // Tiempo en milisegundos (5 segundos)
                        timerProgressBar: true, // Muestra una barra de progreso del temporizador
                        allowOutsideClick: false, // Evita que se cierre haciendo clic fuera del mensaje
                        allowEscapeKey: false, // Evita que se cierre al presionar la tecla de escape
                        allowEnterKey: false // Evita que se cierre al presionar la tecla Enter
                    }).then(() => {
                        // Después de 5 segundos, recarga la página
                        location.reload();
                    });
                } else {
                    // Mostrar un mensaje de error si el registro no existe
                    Swal.fire({
                        title: 'Error',
                        text: data.message,
                        icon: 'error',
                        showConfirmButton: false, // No muestra el botón de confirmación
                        timer: 3000, // Tiempo en milisegundos (5 segundos)
                        timerProgressBar: true, // Muestra una barra de progreso del temporizador
                        allowOutsideClick: false, // Evita que se cierre haciendo clic fuera del mensaje
                        allowEscapeKey: false, // Evita que se cierre al presionar la tecla de escape
                        allowEnterKey: false // Evita que se cierre al presionar la tecla Enter
                    }).then(() => {
                        // Después de 5 segundos, recarga la página
                        location.reload();
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            // Redireccionar a alguna vista al cancelar
            window.location.href = '/hospital/pacientes';
        }
    });
</script>

    @endif

<div class="container-fluid p-0 position-relative">
    <div class="hospital-name-container position-absolute bottom-10 start-50 translate-middle-x bg-white text-center rounded">
        <h2 class="nombreHospital m-0 d-inline-block p-2">{{ $hospital->nombre }}</h2>
    </div>
    <img src="{{ asset('img/hospital.jpeg') }}" class="img-fluid w-100" style="object-fit: cover; height: 40vh;" alt="Tu Imagen">
</div>

<div class="container mt-3">
    <div class="row">
        <div class="col-md-7 offset-md-1 p-3 rounded">
            <!-- Contenedor para el mapa -->
            <div id="map" style="height: 380px; border-radius: 10px;"></div>
        </div>
        
        <div class="col-md-3 p-3 rounded mt-3">
          <h4 class="text-center mb-3" style="color: #3b7e96;">Información del Hospital</h4>
          <div class="text-center">
              <i class="fas fa-hospital fa-2x mb-2" style="color: #71b9bf;"></i>
              <h5>{{ $hospital->nombre }}</h5>
              <!-- Coloca el nombre del hospital aquí -->
          </div>
          <hr class="linea my-3">
          <div class="text-center">
              <i class="fas fa-phone fa-2x mb-2" style="color: #71b9bf;"></i>
              <h5>{{ $hospital->user->telefono }}</h5>
              <!-- Coloca el número de teléfono aquí -->
          </div>
          <hr class="linea my-3">
          <div class="text-center">
              <i class="fas fa-envelope fa-2x mb-2" style="color: #71b9bf;"></i>
              <h5>{{ $hospital->user->email }}</h5>
              <!-- Coloca el número de teléfono aquí -->
          </div>
      </div>
      
    </div>

    <div class="row mt-3 justify-content-center">
      <div class="col-md-10">
          <div class="medico p-3 text-white rounded" style="border-radius: 5%; display: flex; align-items: center; justify-content: space-between;">
              <h2 class="medico m-0" style="margin-left: 2%; letter-spacing: 5px;">MEDICOS</h2>
              <div class="search-container">
                  <input id="searchInput" type="text" class="px-3 py-2" style="font-size:17px" placeholder="Buscar médico...">
              </div>
          </div>
      </div>
  </div>
</div>

<div class="row mt-3 justify-content-center">
    <div class="col-md-10 text-center">
        <p class="nombreHospital">Especialistas</p>
        <hr class="linea">
    </div>
    <div class="container-fluid py-5">
      <div class="row justify-content-center" id="hospitalList">
        @foreach($medicos as $medico)
          <div class="col-xl-3 col-md-4 col-sm-4 mb-4 medicoo" data-id="{{ $medico->nombre }}">
              <div class="card custom-card" >
                  <div class="card-body text-center">
                      <h4 class="card-title mb-3" style="color: #52A0AE;">{{ $medico->nombre }}</h4>
                      <img src="https://img.freepik.com/vector-premium/edificio-hospital-ilustracion-vector-fondo-dibujos-animados-atencion-medica-ambulancia-medico-paciente-enfermeras-exterior-clinica-medica_2175-1510.jpg?w=2000" class="card-img-top rounded" style="border-radius: 15px;" alt="Hospital Image">
                      <!-- Agrega aquí otros detalles del médico si los tienes, como especialidad, etc. -->
                      <div class="card-btn mt-2 d-flex justify-content-between">
                          <a href="{{ route('pacientes.vermasDoc', ['id' => $medico->id]) }}" class="btn btn-sm" style="background-color: #42A8A1; color: #ffffff;"><i class="fas fa-eye"></i> Ver más</a>
                          <a href="{{ route('citas.crear', ['doctor' => $medico->id]) }}" class="btn btn-sm btn-citas" style="background-color: #42A8A1; color: #ffffff; border-color: #42A8A1;"><i class="far fa-calendar-alt"></i> Cita</a>
                      </div>
                  </div>
              </div>
          </div>
      @endforeach
      </div>
  </div>
  

  </div>
</div>



@endsection



<!--   Core JS Files   -->
<script src="{{asset('js/core/popper.min.js')}}"></script>
<script src="{{asset('js/core/bootstrap.min.js')}}"></script>
<script src="{{asset('js/plugins/perfect-scrollbar.min.js')}}"></script>
<script src="{{asset('js/plugins/smooth-scrollbar.min.js')}}"></script>
<script src="{{asset('js/plugins/chartjs.min.js')}}"></script>


<script>
   function initMap() {
        // Obtener la latitud y longitud del hospital (reemplaza esto con los valores reales)
        var latitud = {{ $hospital->latitud }};
        var longitud = {{ $hospital->longitud }};
        
        // Crear un nuevo mapa en el contenedor con ID 'map'
        var map = new google.maps.Map(document.getElementById('map'), {
            center: { lat: latitud, lng: longitud },
            zoom: 15 // Puedes ajustar el nivel de zoom aquí
        });
        
        // Crear un marcador en la ubicación del hospital
        var marker = new google.maps.Marker({
            position: { lat: latitud, lng: longitud },
            map: map,
            title: '{{ $hospital->nombre }}' // Título del marcador
        });
    }

    document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('searchInput');
    const hospitalList = document.getElementById('hospitalList');
    const originalCards = hospitalList.innerHTML;

    searchInput.addEventListener('input', function (e) {
        const searchString = e.target.value.trim().toLowerCase();
        if (searchString === '') {
            hospitalList.innerHTML = originalCards;
            return;
        }

        const hospitals = hospitalList.getElementsByClassName('medicoo');
        const filteredHospitals = Array.from(hospitals).filter(function (hospital) {
            const hospitalName = hospital.getAttribute('data-id').toLowerCase();
            return hospitalName.includes(searchString);
        });

        hospitalList.innerHTML = '';
        filteredHospitals.forEach(function (hospital) {
            hospitalList.appendChild(hospital.cloneNode(true));
        });
    });
});

</script>
<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></>
<!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
<script src="{{asset('js/argon-dashboard.min.js?v=2.0.4')}}"></script>