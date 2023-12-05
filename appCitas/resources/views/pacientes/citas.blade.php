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
                            <button type="button" class="btn btn-hover" 
                                data-bs-toggle="modal" 
                                data-bs-target="#editarCitaModal"
                                data-cita-id="{{ $cita->id }}"
                                data-cita-fecha="{{ $cita->fecha }}"
                                data-cita-hora="{{ $cita->hora }}">
                                <i class="fas fa-edit" style="color: #9FC9D7;"></i>
                            </button>
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

<!-- Modal de edición de cita -->
@if($paciente->citas->isNotEmpty())
    <div class="modal fade" id="editarCitaModal" tabindex="-1" aria-labelledby="editarCitaModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editarCitaModalLabel">Editar Cita</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('citas.actualizar', $cita->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="fecha" class="form-label">Fecha de la cita</label>
                            <input type="date" class="form-control" id="fecha" name="fecha" value="{{ $cita->fecha }}">
                        </div>
                        <div class="mb-3">
                            <label for="hora" class="form-label">Hora de la cita</label>
                            <input type="time" class="form-control" id="hora" name="hora"  value="{{ \Carbon\Carbon::parse($cita->hora)->format('H:i') }}">
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
@endif
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var editarCitaModal = document.getElementById('editarCitaModal');
    
        editarCitaModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
    
            var citaId = button.getAttribute('data-cita-id');
            var citaFecha = button.getAttribute('data-cita-fecha');
            var citaHora = button.getAttribute('data-cita-hora');
    
            var form = editarCitaModal.querySelector('form');
            var inputFecha = editarCitaModal.querySelector('#fecha');
            var inputHora = editarCitaModal.querySelector('#hora');
    
            form.action = `/citas/${citaId}`; // Corregido: ruta de actualización
    
            inputFecha.value = citaFecha;
            inputHora.value = citaHora;
        });
    });
</script>
@endpush