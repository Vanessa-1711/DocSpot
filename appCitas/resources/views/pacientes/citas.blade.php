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
    .btn-custom-color {
        background-color: #52A0AE;
        color: white; /* Adjust text color if needed */
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
    .btn-hover-white:hover {
        background-color: white;
        color: #000000; /* Cambia el color del texto al pasar el mouse, si es necesario */
    }
    .medico{
        font-family: 'Allerta', sans-serif;
        color:black;
        background-color: #52A0AE;
        font-size:30px;
    }
    
  .search-container {
        display: flex;
        border-radius: 20px; /* Ajusta según tus preferencias */
        overflow: hidden;
        width: 35%; /* Ajusta el ancho del buscador según tus preferencias */
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
<div class="row mt-5 justify-content-center">
      <div class="col-md-11 p-0">
          <div class="medico p-3 text-white rounded" style="border-radius: 5%; display: flex; align-items: center; justify-content: space-between;">
              <h2 class="medico m-0" style="margin-left: 2%; letter-spacing: 5px; color:white">CITAS PROGRAMADAS</h2>
              <div class="search-container">
                  <input id="searchInput" type="text" class="px-3 py-2" style="font-size:17px" placeholder="Buscar cita...">
              </div>
          </div>
      </div>
  </div>
<div class="container-fluid py-5">

    <div class="row" id="hospitalList">
        @forelse ($paciente->citas as $cita)
            <div class="col-md-6 mb-4 medicoo" data-medico="{{ $cita->medico->nombre }} {{ $cita->medico->apellido }}" data-estado="{{ $cita->estado == 0 ? 'Pendiente' : 'Confirmada' }}" data-fecha="{{ \Carbon\Carbon::parse($cita->fecha)->isoFormat('D [de] MMMM [del] YYYY') }} a las {{ \Carbon\Carbon::parse($cita->hora)->format('g:i A') }}">
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
                            <button type="button" class="btn btn-hover" 
                                data-bs-toggle="modal" 
                                data-bs-target="#editarCitaModal{{ $cita->id }}"
                                data-cita-id="{{ $cita->id }}"
                                data-cita-fecha="{{ $cita->fecha }}"
                                data-cita-hora="{{ $cita->hora }}">
                                <i class="fas fa-edit" style="color: #9FC9D7;"></i>
                            </button>
                            <!-- Formulario para confirmar la cita -->
                            @if($cita->estado == 0)
                                <form action="{{ route('citas.confirmar', $cita->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-hover" ><i class="fas fa-check" style="color: #9FC9D7;"></i></button>
                                </form>
                            @endif
                            <!-- Formulario para eliminar la cita -->
                            <form action="{{ route('citas.eliminar', $cita->id) }}" method="POST" class="form-eliminar-cita">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-hover eliminar-cita-btn" >
                                    <i class="fas fa-trash-alt" style="color: #9FC9D7;"></i>
                                </button>
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

<!-- Modal de edición de cita -->
<!-- Modales de edición de cita para cada cita en la lista -->
@foreach ($paciente->citas as $cita)
    <div class="modal fade" id="editarCitaModal{{ $cita->id }}" tabindex="-1" aria-labelledby="editarCitaModalLabel{{ $cita->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editarCitaModalLabel{{ $cita->id }}">Editar Cita</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('citas.actualizar', $cita->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="fecha{{ $cita->id }}" class="form-label">Fecha de la cita</label>
                            <input type="date" class="form-control" id="fecha{{ $cita->id }}" name="fecha" value="{{ $cita->fecha }}">
                        </div>
                        <div class="mb-3">
                            <label for="hora{{ $cita->id }}" class="form-label">Hora de la cita</label>
                            <input type="time" class="form-control" id="hora{{ $cita->id }}" name="hora" value="{{ \Carbon\Carbon::parse($cita->hora)->format('H:i') }}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-custom-color btn-hover-white" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary btn-custom-color">Actualizar Cita</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach

@endsection

@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.btn-editar-cita').forEach(button => {
        button.addEventListener('click', function () {
            const citaId = this.dataset.citaId;
            
            const modal = document.querySelector(`#editarCitaModal${citaId}`);
            const form = modal.querySelector('form');
            const inputFecha = form.querySelector(`#fecha${citaId}`);
            const inputHora = form.querySelector(`#hora${citaId}`);

        form.action = `/citas/${citaId}`;
        inputFecha.value = citaFecha;
            inputHora.value = citaHora;
        });
    });
});

document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.eliminar-cita-btn').forEach(button => {
        button.addEventListener('click', function () {
            const form = this.closest('.form-eliminar-cita');
            Swal.fire({
                title: '¿Estás seguro?',
                text: 'Esta acción no se puede deshacer.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#42A8A1',
                cancelButtonColor: '#677495',
                confirmButtonText: 'Sí, eliminar'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });

    const searchInput = document.getElementById('searchInput');
    const hospitalList = document.getElementById('hospitalList');
    const originalCards = hospitalList.innerHTML;

    searchInput.addEventListener('input', function (e) {
        const searchString = e.target.value.trim().toLowerCase();
        hospitalList.innerHTML = originalCards;

        if (searchString === '') {
            return;
        }

        const appointments = hospitalList.getElementsByClassName('medicoo');
        const filteredAppointments = Array.from(appointments).filter(function (appointment) {
            const cardContent = appointment.querySelector('.card-content');
            const appointmentDetails = cardContent.textContent.toLowerCase();

            return (
                appointmentDetails.includes(searchString) ||
                appointment.dataset.medico.toLowerCase().includes(searchString) ||
                appointment.dataset.estado.toLowerCase().includes(searchString) ||
                appointment.dataset.fecha.toLowerCase().includes(searchString)
            );
        });

        hospitalList.innerHTML = '';
        filteredAppointments.forEach(function (appointment) {
            hospitalList.appendChild(appointment.cloneNode(true));
        });
    });
});


</script>
@endpush