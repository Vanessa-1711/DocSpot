@extends('layouts.app')

@section('title', 'Hospitales')

@section('aside')
    @include('layouts.aside_pacientes')
@endsection


@section('content')
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
        color: #000000 !important;
        border-color: #42A8A1 !important;
    }
    .search-container {
        margin-bottom: 1%; /* Ajusta según tus preferencias */
        display: flex;
        border-radius: 20px; /* Ajusta según tus preferencias */
        overflow: hidden;
        width: 35%; /* Ajusta el ancho del buscador según tus preferencias */
        margin-right: 5% !important;
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

<div class="container-fluid p-0 position-relative">
    <div class="hospital-name-container position-absolute bottom-10 start-50 translate-middle-x bg-white text-center rounded">
        <h2 class="nombreHospital m-0 d-inline-block p-2">Nombre del Hospital</h2>
    </div>
    <img src="{{ asset('img/hospital.jpeg') }}" class="img-fluid w-100" style="object-fit: cover; height: 40vh;" alt="Tu Imagen">
</div>

<div class="container mt-3">
    <div class="row">
        <div class="col-md-8 offset-md-1 p-3 rounded">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3083.481198349951!2d-122.41941568431693!3d37.774929979757465!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80859a6d00690021%3A0x4a501367f076adff!2sGolden%20Gate%20Bridge!5e0!3m2!1sen!2sus!4v1642636703604!5m2!1sen!2sus" width="100%" height="300" style="border:0; border-radius: 10px;" allowfullscreen="" loading="lazy"></iframe>
        </div>
        
        <div class="col-md-2 p-3 rounded mt-3">
          <h4 class="text-center mb-3" style="color: #3b7e96;">Información del Hospital</h4>
          <div class="text-center">
              <i class="fas fa-hospital fa-2x mb-2" style="color: #71b9bf;"></i>
              <h5>Nombre del Hospital</h5>
              <!-- Coloca el nombre del hospital aquí -->
          </div>
          <hr class="linea my-3">
          <div class="text-center">
              <i class="fas fa-phone fa-2x mb-2" style="color: #71b9bf;"></i>
              <h5>Teléfono</h5>
              <!-- Coloca el número de teléfono aquí -->
          </div>
          <!-- Puedes agregar más información aquí con el mismo formato de ícono y texto -->
      </div>
      
    </div>

    <div class="row mt-3 justify-content-center">
      <div class="col-md-10">
          <div class="medico p-3 text-white rounded" style="border-radius: 5%; display: flex; align-items: center; justify-content: space-between;">
              <h2 class="medico m-0" style="margin-left: 2%; letter-spacing: 5px;">MEDICOS</h2>
              <div class="search-container">
                <input type="text" placeholder="Buscar médico...">
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
      <div class="row justify-content-center">
          <div class="col-xl-3 col-md-4 col-sm-4 mb-4">
              <div class="card custom-card">
                  <div class="card-body text-center">
                      <h4 class="card-title mb-3" style="color: #52A0AE;">Nombre del doctor</h4>
                      <img src="https://img.freepik.com/vector-premium/edificio-hospital-ilustracion-vector-fondo-dibujos-animados-atencion-medica-ambulancia-medico-paciente-enfermeras-exterior-clinica-medica_2175-1510.jpg?w=2000" class="card-img-top rounded" style="border-radius: 15px;" alt="Hospital Image">
                      <div class="card-btn mt-2 d-flex justify-content-between">
                        <a href="#" class="btn btn-sm" style="background-color: #42A8A1; color: #ffffff;"><i class="fas fa-eye"></i> Ver más</a>
                        <a href="#" class="btn btn-sm btn-citas" style="background-color: #42A8A1; color: #ffffff; border-color: #42A8A1;"><i class="far fa-calendar-alt"></i> Cita</a>
                      </div>
                  </div>
              </div>
          </div>
          <div class="col-xl-3 col-md-4 col-sm-4 mb-4">
              <div class="card custom-card">
                  <div class="card-body text-center">
                      <h4 class="card-title mb-3" style="color: #52A0AE;">Doctor</h4>
                      <img src="https://img.freepik.com/vector-premium/edificio-hospital-ilustracion-vector-fondo-dibujos-animados-atencion-medica-ambulancia-medico-paciente-enfermeras-exterior-clinica-medica_2175-1510.jpg?w=2000" class="card-img-top rounded" style="border-radius: 15px;" alt="Hospital Image">
                      <div class="card-btn mt-2 d-flex justify-content-between">
                        <a href="#" class="btn btn-sm" style="background-color: #42A8A1; color: #ffffff;"><i class="fas fa-eye"></i> Ver más</a>
                        <a href="#" class="btn btn-sm btn-citas" style="background-color: #42A8A1; color: #ffffff; border-color: #42A8A1;"><i class="far fa-calendar-alt"></i> Cita</a>
                      </div>
                  </div>
              </div>
          </div>
          <div class="col-xl-3 col-md-4 col-sm-4 mb-4">
            <div class="card custom-card">
                <div class="card-body text-center">
                    <h4 class="card-title mb-3" style="color: #52A0AE;">Doctor</h4>
                    <img src="https://img.freepik.com/vector-premium/edificio-hospital-ilustracion-vector-fondo-dibujos-animados-atencion-medica-ambulancia-medico-paciente-enfermeras-exterior-clinica-medica_2175-1510.jpg?w=2000" class="card-img-top rounded" style="border-radius: 15px;" alt="Hospital Image">
                    <div class="card-btn mt-2 d-flex justify-content-between">
                      <a href="#" class="btn btn-sm" style="background-color: #42A8A1; color: #ffffff;"><i class="fas fa-eye"></i> Ver más</a>
                      <a href="#" class="btn btn-sm btn-citas" style="background-color: #42A8A1; color: #ffffff; border-color: #42A8A1;"><i class="far fa-calendar-alt"></i> Cita</a>
                    </div>
                </div>
            </div>
        </div>
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
var ctx1 = document.getElementById("chart-line").getContext("2d");

var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

gradientStroke1.addColorStop(1, 'rgba(94, 114, 228, 0.2)');
gradientStroke1.addColorStop(0.2, 'rgba(94, 114, 228, 0.0)');
gradientStroke1.addColorStop(0, 'rgba(94, 114, 228, 0)');
new Chart(ctx1, {
  type: "line",
  data: {
    labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
    datasets: [{
      label: "Mobile apps",
      tension: 0.4,
      borderWidth: 0,
      pointRadius: 0,
      borderColor: "#5e72e4",
      backgroundColor: gradientStroke1,
      borderWidth: 3,
      fill: true,
      data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
      maxBarThickness: 6

    }],
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
      legend: {
        display: false,
      }
    },
    interaction: {
      intersect: false,
      mode: 'index',
    },
    scales: {
      y: {
        grid: {
          drawBorder: false,
          display: true,
          drawOnChartArea: true,
          drawTicks: false,
          borderDash: [5, 5]
        },
        ticks: {
          display: true,
          padding: 10,
          color: '#fbfbfb',
          font: {
            size: 11,
            family: "Open Sans",
            style: 'normal',
            lineHeight: 2
          },
        }
      },
      x: {
        grid: {
          drawBorder: false,
          display: false,
          drawOnChartArea: false,
          drawTicks: false,
          borderDash: [5, 5]
        },
        ticks: {
          display: true,
          color: '#ccc',
          padding: 20,
          font: {
            size: 11,
            family: "Open Sans",
            style: 'normal',
            lineHeight: 2
          },
        }
      },
    },
  },
});
</script>
<script>
var win = navigator.platform.indexOf('Win') > -1;
if (win && document.querySelector('#sidenav-scrollbar')) {
  var options = {
    damping: '0.5'
  }
  Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
}
</script>
<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
<script src="{{asset('js/argon-dashboard.min.js?v=2.0.4')}}"></script>