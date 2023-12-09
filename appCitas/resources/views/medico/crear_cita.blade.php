@extends('layouts.app')

@section('title', 'Crear citas')

@section('aside')
    @include('layouts.aside_medicos')
@endsection

@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
     @import url('https://fonts.googleapis.com/css2?family=Allerta&family=Calistoga&display=swap');

    .titulo{
      font-family: 'Allerta', serif;
      color:black;
      font-size:30px;
      letter-spacing: 3px;
    }

    .select2-container {
        
        border: 1px #c1c1c1 solid !important;
        border-radius: 10px !important;
        height: 35px !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: #8d8d8d !important;
        line-height: 28px;
        font-family: 'Allerta', sans-serif !important;
    }

    .select2-container--default .select2-selection--single {
        background-color: #fff !important;
        border: 0px solid #aaa !important;
        border-radius: 10px !important;
    }
    .subtitulo{
      font-family: 'Allerta', sans-serif;
      color:black;
      font-size:18px;
      letter-spacing: 3px;
    }
    .select2-container--default .select2-search--dropdown .select2-search__field {
        outline: none !important;
    }
    .btn-outline-primary {
      background-color: #42A8A1;
      border-color: #52A0AE;
      color: white !important;
    }
  .btn-outline-primary:hover {
      background-color: white !important;
      color: #298780 !important;
      border-color: #42A8A1;
    }
</style>
<div class="container-fluid mt-5">
    <div class="row">
        <div class="col-md-6">
            <!-- Contenido de la columna izquierda (card, formulario, etc.) -->
            <div class="card p-4" style="height: 100%">
                <div class="mb-5 justify-center mt-2">
                    <h5 class=" text-center titulo" >Agendar Cita</h5>
                </div>
                <form action="{{ route('citaspaciente.guardar') }}" method="POST" novalidate>
                    @csrf
                    <!-- Select de médicos con Select2 -->
                    <div class="form-group">
                        <label for="medicos" class="subtitulo">Seleccionar médico</label>
                        <select class="form-control @error ('medicos') is-invalid @enderror" id="medicos" name="medicos">
                            <!-- Opción predeterminada - Médico seleccionado -->
                            @if(old('medicos'))
                                @php
                                    $selectedMedico = old('medicos');
                                @endphp
                                @foreach($medicosDelMismoHospital as $med)
                                    <option value="{{ $med->id }}" {{ $med->id == $selectedMedico ? 'selected' : '' }}>{{ $med->nombre }}</option>
                                @endforeach
                            @else
                                <option value="{{ $medico->id }}" selected>{{ $medico->nombre }}</option>
                                @foreach($medicosDelMismoHospital as $med)
                                    <!-- Verifica si no es el médico seleccionado -->
                                    @if($med->id !== $medico->id)
                                        <option value="{{ $med->id }}">{{ $med->nombre }}</option>
                                    @endif
                                @endforeach
                            @endif
                        </select>
                        @error ('medicos')
                            <p class="invalid-feedback">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>


                    <!--calendario y hora-->
                                    <!-- HTML para la selección de fecha y hora por separado -->
                    <div class="form-group" style="margin-top:2.5rem; margin-bottom:3.5rem">
                        <label for="fecha" class="subtitulo">Seleccionar fecha</label>
                        <input type="text" id="fecha" name="fecha" class="form-control  @error ('fecha') is-invalid @enderror"  value="{{old('fecha')}}"  placeholder="Seleccionar fecha">
                        @error ('fecha')
                            <p class="invalid-feedback" >
                                {{$message}}
                            </p>
                        @enderror
                    </div>

                    <div class="form-group" style="margin-top:2.5rem; margin-bottom:3.5rem">
                        <label for="hora" class="subtitulo">Seleccionar hora</label>
                        <select id="hora" name="hora" class="form-control @error ('hora') is-invalid @enderror">
                            <!-- Opciones de hora cerradas -->
                            <!-- Agrega las horas necesarias -->
                        </select>
                        @error ('hora')
                            <p class="invalid-feedback" >
                                {{$message}}
                            </p>
                        @enderror
                    </div>

                    <div class=" mt-2 d-flex justify-content-center align-items-center">
                        <button type="submit" class="btn btn-outline-primary boton" >Guardar</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-6">
            <!-- Contenido de la columna derecha (imagen, etc.) -->
            <img style="border-radius:15px" src="{{ asset('img/doc3.png') }}" alt="Imagen" class="img-fluid">
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    // Función para cargar las fechas disponibles y configurar Flatpickr
    function cargarFechasDisponibles() {
        // Mostrar mensaje de carga
        $('#fecha').val('Cargando fechas disponibles...');
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
                url: "{{ route('ruta.obtenerHorasDisponibles', ['fecha' => ':fecha', 'medico_id' => ':medico_id']) }}"
                    .replace(':fecha', fecha)
                    .replace(':medico_id', $('#medicos').val()),
                success: function(response) {
                    console.log(response);
                    if (!response || response.length === 0) {
                        // Si no hay horas disponibles, agregar la fecha al array
                        fechasSinHorasDisponibles.push(fecha);
                        console.log(fechasSinHorasDisponibles);
                    }
                },
                error: function(error) {
                    console.log(error);
                },
                complete: function() {
                    // Cuando se complete la verificación de las fechas, configurar Flatpickr
                    if (fechaActual.getTime() > fechaFinal.getTime()) {
                        // Quitar el mensaje de carga
                        $('#fecha').val('');

                        // Configurar Flatpickr con las fechas sin horas disponibles
                        configurarFlatpickr(fechasSinHorasDisponibles);
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
    function configurarFlatpickr(fechasSinHorasDisponibles) {
        $('#fecha').flatpickr({
            enableTime: false,
            dateFormat: "Y-m-d",
            minDate: "today",
            altInput: true,
            altFormat: "F j, Y",
            disable: fechasSinHorasDisponibles // Desactivar las fechas sin horas disponibles
        });
    }

$(document).ready(function() {
    
        $('#medicos').select2();
        cargarFechasDisponibles();
        $('#medicos').change(function() {
            // Reiniciar Flatpickr para dejar la fecha sin seleccionar
            $('#fecha').val('');
            cargarFechasDisponibles();
        });
        
        // Hacer la llamada AJAX al cambiar la fecha seleccionada
        $('#fecha').change(function() {
            console.log("aqui");
            var fechaSeleccionada = $(this).val();
            var medicoId = $('#medicos').val();
            console.log("{{ route('ruta.obtenerHorasDisponibles', ['fecha' => ':fecha', 'medico_id' => ':medico_id']) }}"
                    .replace(':fecha', fechaSeleccionada)
                    .replace(':medico_id', medicoId));
            // Realizar la solicitud AJAX para obtener las horas disponibles
            $.ajax({
                type: "GET",
                url: "{{ route('ruta.obtenerHorasDisponibles', ['fecha' => ':fecha', 'medico_id' => ':medico_id']) }}"
                    .replace(':fecha', fechaSeleccionada)
                    .replace(':medico_id', medicoId),
                success: function(response) {
                    console.log("s");
                    // Limpiar el select de horas
                    $('#hora').empty();
                    console.log(response);
                    // Agregar las opciones de horas disponibles al select
                    response.forEach(function(hora) {
                        
                        $('#hora').append('<option value="' + hora + '">' + hora + '</option>');
                    });
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });
        
    });

</script>
@endsection
