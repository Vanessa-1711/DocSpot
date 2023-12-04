@extends('layouts.app')

@section('title', 'Citas')

@section('aside')
    @include('layouts.aside_pacientes')
@endsection


@section('content')
<style>
    .btn-hover:hover {
        background-color: #52A0AE;
    }
    .btn {
        margin-left: 5px;
        border-radius: 5px;
    }
    .card-header-custom {
        border-bottom: 2px solid #9FC9D7;
    }
    .card-content {
        min-height: 140px; /* Ajusta este valor según tus necesidades */
    }
    .card-body {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
</style>

<div class="container-fluid py-5">
    <h3>Citas Programadas</h3>
    <div class="row">
        @forelse ($paciente->citas as $cita)
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center card-header-custom">
                        <i class="fas fa-calendar-alt fa-2x"></i>
                        <h5 class="card-title mb-0 text-end">{{ \Carbon\Carbon::parse($cita->fecha)->isoFormat('D [de] MMMM [del] YYYY') }} a las {{ \Carbon\Carbon::parse($cita->hora)->format('g:i A') }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="card-content">
                            <p class="card-text"><strong style="font-size: larger;">Doctor:</strong> {{ $cita->medico->nombre }} {{ $cita->medico->apellido }}</p>
                            <p class="card-text"><strong style="font-size: larger;">Estado:</strong> {{ $cita->estado == 0 ? 'Pendiente' : 'Confirmada' }}</p>
                            @if($cita->estado == 0)
                                @php
                                    $fechaCita = \Carbon\Carbon::parse($cita->fecha)->startOfDay();
                                    $hoy = \Carbon\Carbon::now()->startOfDay();
                                    $diasRestantes = $hoy->diffInDays($fechaCita, false);
                                @endphp
                                <p class="card-text"><strong style="font-size: larger;">Limite de confirmación:</strong> en {{ $diasRestantes }} días</p>
                            @endif
                        </div>
                        <div class="d-flex justify-content-end">
                            <form action="{{ route('citas.eliminar', $cita->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-hover" style="background-color: white;"><i class="fas fa-edit" style="color: #9FC9D7;"></i></button>
                            </form>
                            <!-- Formulario para confirmar la cita -->
                            @if($cita->estado == 0)
                                <form action="{{ route('citas.confirmar', $cita->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-hover" style="background-color: white;"><i class="fas fa-check" style="color: #9FC9D7;"></i></button>
                                </form>
                            @endif
                            <!-- Formulario para eliminar la cita -->
                            <form action="{{ route('citas.eliminar', $cita->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-hover" style="background-color: white;"><i class="fas fa-trash-alt" style="color: #9FC9D7;"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <p>No hay citas programadas.</p>
        @endforelse
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