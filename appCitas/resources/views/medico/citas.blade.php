@extends('layouts.app')

@section('title', 'Citas')

@section('aside')
    @include('layouts.aside_medicos')
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
        @forelse ($medico->citas as $cita)
            <div class="col-md-6 mb-4 medicoo" data-medico="{{ $cita->paciente->nombre }} {{ $cita->paciente->apellido }}" data-estado="{{ $cita->estado == 0 ? 'Pendiente' : 'Confirmada' }}" data-fecha="{{ \Carbon\Carbon::parse($cita->fecha)->isoFormat('D [de] MMMM [del] YYYY') }} a las {{ \Carbon\Carbon::parse($cita->hora)->format('g:i A') }}">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center card-header-custom">
                        <i class="fas fa-calendar-alt fa-2x"></i>
                        <h5 class="card-title mb-0 text-end">{{ \Carbon\Carbon::parse($cita->fecha)->isoFormat('D [de] MMMM [del] YYYY') }} a las {{ \Carbon\Carbon::parse($cita->hora)->format('g:i A') }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="card-content">
                            <p class="card-text"><strong style="font-size: larger;">Paciente:</strong> {{ $cita->paciente->nombre }} {{ $cita->paciente->apellido }}</p>
                            <p class="card-text"><strong style="font-size: larger;">CURP:</strong> {{ $cita->paciente->curp }}</p>
                            <p class="card-text"><strong style="font-size: larger;">NSS:</strong> {{ $cita->paciente->pacienteHospital->nss }}</p>
                            <p class="card-text"><strong style="font-size: larger;">Estado:</strong> {{ $cita->estado == 0 ? 'Pendiente' : 'Confirmada' }}</p>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-hover" id="boton-modal" 
                                data-bs-toggle="modal" 
                                data-bs-target="#editarCitaModal{{ $cita->id }}"
                                data-cita-id="{{ $cita->id }}"
                                data-cita-fecha="{{ $cita->fecha }}"
                                data-cita-hora="{{ $cita->hora }}"
                                data-cita-medico-id="{{ $paciente_id }}"
                                data-cita-paciente-id="{{ $cita->paciente->id }}">
                                <i class="fas fa-edit" style="color: #9FC9D7;"></i>
                            </button>
                            <!-- Formulario para eliminar la cita -->
                            <form action="{{ route('citas.eliminarM', $cita->id) }}" method="POST" class="form-eliminar-cita">
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
@foreach ($medico->citas as $cita)
    <div class="modal fade" id="editarCitaModal{{ $cita->id }}" tabindex="-1" aria-labelledby="editarCitaModalLabel{{ $cita->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editarCitaModalLabel{{ $cita->id }}">Editar Cita</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" id="form{{ $cita->id }}" action="{{ route('citas.actualizarM', $cita->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="fecha{{ $cita->id }}" class="form-label">Fecha actual de la cita</label>
                            <input type="date" class="form-control" id="fecha{{ $cita->id }}" value="{{ $cita->fecha }}" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="hora{{ $cita->id }}" class="form-label">Hora actual de la cita</label>
                            <input type="time" class="form-control" id="hora{{ $cita->id }}"  value="{{ \Carbon\Carbon::parse($cita->hora)->format('H:i') }}" readonly>
                        </div>
                        <input name="paciente_id"  id="paciente_id" value="{{$paciente_id}}" style="display:none">


                        <div class="form-group" style="margin-top:2.5rem; margin-bottom:3.5rem">
                            <label for="fecha" class="subtitulo">Seleccionar nueva fecha</label>
                            <input type="text" id="fecha_flat{{ $cita->id }}" name="fecha_flat" class="form-control  @error ('fecha') is-invalid @enderror"  value="{{old('fecha')}}"  placeholder="Seleccionar fecha">
                            @error ('fecha')
                                <p class="invalid-feedback" >
                                    {{$message}}
                                </p>
                            @enderror
                        </div>
                        <div class="form-group" style="margin-top:2.5rem; margin-bottom:3.5rem">
                            <label for="hora" class="subtitulo">Seleccionar nueva hora</label>
                            <select id="hora_flat{{ $cita->id }}" name="hora_flat" class="form-control @error ('hora') is-invalid @enderror">
                          
                            </select>
                            @error ('hora')
                                <p class="invalid-feedback" >
                                    {{$message}}
                                </p>
                            @enderror
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
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
function cargarHorasDisponibles(fechaSeleccionada, medicoId, id,pacienteId) {
// Realiza la solicitud AJAX para obtener las horas disponibles
    $.ajax({
        type: "GET",
        url: "{{ route('paciente.obtenerHorasDisponibles', ['fecha' => ':fecha', 'medico_id' => ':medico_id', 'paciente_id' => ':paciente_id']) }}"
            .replace(':fecha', fechaSeleccionada)
            .replace(':medico_id', medicoId)
            .replace(':paciente_id', pacienteId),
        success: function(response) {
            console.log(response);
            // Limpiar el select de horas
            $('#hora_flat' + id).empty();
            // Agregar las opciones de horas disponibles al select
            response.forEach(function(hora) {
                $('#hora_flat' + id).append('<option value="' + hora + '">' + hora + '</option>');
            });
        },
        error: function(error) {
            console.log(error);
        }
    });
}

function cargarFechasDisponibles(medico_id, id, paciente_id) {
    console.log('#fecha_flat:fecha_flat'.replace(':fecha_flat', id));
    // Mostrar mensaje de carga
    $('#fecha_flat:fecha_flat'.replace(':fecha_flat', id)).val('Cargando fechas disponibles...');
        Swal.fire({
        title: 'Cargando fechas disponibles...',
        allowOutsideClick: false,
        allowEscapeKey: false,
        showConfirmButton: false,
        onBeforeOpen: () => {
            Swal.showLoading();
            $('.swal2-container').css('pointer-events', 'none'); // Desactivar clics fuera del modal
        }
    });

    // Obtener la fecha actual y la fecha dentro de 15 días
    var fechaActual = new Date();
    var fechaFinal = new Date();
    fechaFinal.setDate(fechaFinal.getDate() + 7); // Sumar 7 días

    // Array para almacenar las fechas sin horas disponibles
    var fechasSinHorasDisponibles = [];

    // Función para realizar la verificación de horas disponibles
    function verificarHorasDisponibles(fecha) {
        // Realizar la solicitud AJAX para obtener las horas disponibles
        $.ajax({
            type: "GET",
            url: "{{ route('paciente.obtenerHorasDisponibles', ['fecha' => ':fecha', 'medico_id' => ':medico_id', 'paciente_id' => ':paciente_id']) }}"
                .replace(':fecha', fecha)
                .replace(':medico_id', medico_id)
                .replace(':paciente_id', paciente_id),
            success: function(response) {
                console.log(response);
                if (!response || response.length === 0) {
                    // Si no hay horas disponibles, agregar la fecha al array
                    fechasSinHorasDisponibles.push(fecha);
                    console.log("{{ route('paciente.obtenerHorasDisponibles', ['fecha' => ':fecha', 'medico_id' => ':medico_id', 'paciente_id' => ':paciente_id']) }}".replace(':fecha', fecha).replace(':medico_id',medico_id).replace(':paciente_id',paciente_id));
                }
            },
            error: function(error) {
                console.log(error);
            },
            complete: function() {
                // Cuando se complete la verificación de las fechas, configurar Flatpickr
                if (fechaActual.getTime() > fechaFinal.getTime()) {
                    // Quitar el mensaje de carga
                    $('#fecha_flat:fecha_flat'.replace(':fecha_flat', id)).val('');
                    
                    // Configurar Flatpickr con las fechas sin horas disponibles
                    configurarFlatpickr(fechasSinHorasDisponibles,id,medico_id,paciente_id);
                   

                    Swal.close();

                    
                } else {
                    fechaActual.setDate(fechaActual.getDate() + 1);
                    verificarHorasDisponibles(fechaActual.toISOString().split('T')[0]);
                }
            }
        });
    }

    // Iniciar la verificación de las fechas disponibles
    verificarHorasDisponibles(fechaActual.toISOString().split('T')[0]);
}

// Función para configurar Flatpickr con las fechas sin horas disponibles
function configurarFlatpickr(fechasSinHorasDisponibles,id, medico_id, paciente_id) {
    $('#fecha_flat:fecha_flat'.replace(':fecha_flat', id)).flatpickr({
        enableTime: false,
        dateFormat: "Y-m-d",
        minDate: "today",
        altInput: true,
        altFormat: "F j, Y",
        disable: fechasSinHorasDisponibles, // Desactivar las fechas sin horas disponibles
        onChange: function(selectedDates, dateStr, instance) {
            // Al cambiar la fecha, obtén las horas disponibles
            cargarHorasDisponibles(dateStr, medico_id, id,paciente_id);
        }
    });
}

document.addEventListener('DOMContentLoaded', function () {
    // Obtener todos los botones de clase "btn-hover"
    const buttons = document.querySelectorAll('.btn-hover');
    var medicoId="";
    var paciente_id="";
    // Iterar sobre cada botón y agregar un listener para capturar el clic
    buttons.forEach(button => {
        button.addEventListener('click', function (event) {
            // Obtener el ID del médico del botón clickeado
            medicoId = this.getAttribute('data-cita-medico-id');
            paciente_id = this.getAttribute('data-cita-paciente-id');
            id= this.getAttribute('data-cita-id');
            
            // Realizar acciones con el ID del médico obtenido
            console.log('Se hizo clic en un botón de cita. ID del médico:', medicoId);
            cargarFechasDisponibles(medicoId,id,paciente_id);
            // Otras acciones...
        });
    });


    // Hacer la llamada AJAX al cambiar la fecha seleccionada
    $('#fecha_flat').change(function() {
        console.log("aqui");
        var fechaSeleccionada = $(this).val();
        console.log("{{ route('paciente.obtenerHorasDisponibles', ['fecha' => ':fecha', 'medico_id' => ':medico_id', 'paciente_id' => ':paciente_id']) }}"
                .replace(':fecha', fechaSeleccionada)
                .replace(':medico_id', medicoId)
                .replace(':paciente_id', paciente_id));
        // Realizar la solicitud AJAX para obtener las horas disponibles
        $.ajax({
            type: "GET",
            url: "{{ route('paciente.obtenerHorasDisponibles', ['fecha' => ':fecha', 'medico_id' => ':medico_id', 'paciente_id' => ':paciente_id'])  }}"
                .replace(':fecha', fechaSeleccionada)
                .replace(':medico_id', medicoId)
                .replace(':paciente_id', paciente_id),
            success: function(response) {
                console.log("s");
                // Limpiar el select de horas
                $('#hora_flat').empty();
                console.log(response);
                // Agregar las opciones de horas disponibles al select
                response.forEach(function(hora) {
                    
                    $('#hora_flat').append('<option value="' + hora + '">' + hora + '</option>');
                });
            },
            error: function(error) {
                console.log(error);
            }
        });
    });
    
});

document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.btn-editar-cita').forEach(button => {
        button.addEventListener('click', function () {
            const citaId = this.dataset.citaId;
            
            const modal = document.querySelector(`#editarCitaModal${citaId}`);
            const form = modal.querySelector(`#form${citaId}`); // Seleccionar el formulario por su ID único
            const inputFecha = form.querySelector(`#fecha_flat`);
            const inputHora = form.querySelector(`#hora_flat`);

            // Capturar los valores de fecha y hora desde los campos del modal
            const nuevaFecha = inputFecha.value;
            const nuevaHora = inputHora.value;

            // Hacer algo con los valores capturados, como enviarlos a través de AJAX
            console.log('Nueva fecha:', nuevaFecha);
            console.log('Nueva hora:', nuevaHora);

        form.action = `/citas/${citaId}`;
        inputFecha.value = nuevaFecha;
        inputHora.value = nuevaHora;
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