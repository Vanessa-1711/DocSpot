@extends('layouts.app')

@section('title', 'Dashboard')

@section('aside')
    @include('layouts.aside_medicos')
@endsection

@section('content')
<div class="container">
        <!-- Estilos personalizados -->
    <style>
        .dataTables_wrapper .dataTables_filter input {
        color: gray !important;
        border-radius: 20px !important;
        margin-left: 10px !important;
        outline-offset: 0px !important;
    }
    .dataTables_wrapper .dataTables_filter input:focus{
        border-radius: 20px !important;
        margin-left: 10px !important;
        outline-offset: 0px !important;
        border: 1px solid gray !important;
        outline: none !important;
        padding: 5px 15px !important;
    }
    .dataTables_wrapper .dataTables_length select {

        outline-offset: 0px !important;
        outline: none !important;
    }

    input[type="search"]::-webkit-search-cancel-button {
        display: none !important;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button {
        border-radius: 50px !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        color: white !important;
        background: #52a0ae  !important;
        border: 1px #52a0ae solid !important;
        border-radius:50px  !important;

    }

    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        border: 1px solid transparent  !important;
        background: #a2e7c8 !important;
        color:white !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled, .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover, .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:active {
        cursor: default !important;
        color: #666 !important;
        border: 1px solid transparent !important;
        background: transparent !important;
        box-shadow: none !important;
    }
        .hover-float {
            transition: box-shadow 0.3s, transform 0.3s;
            box-shadow: 0 8px 12px 0 rgba(0,0,0,0.2);
        }

        .hover-float:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 20px 0 rgba(0,0,0,0.3);
        }

        .card-text {
            font-size: larger;
        }

        #citasMedicoTable thead th {
            font-size: larger;
            color: #52A0AE;
            font-weight: bold;
            text-align: center;
        }

        #citasMedicoTable {
            border-radius: 15px;
            overflow: hidden;
        }

      

        </style>
    <!-- Tarjetas de Resumen -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card text-center hover-float">
                <div class="card-body">
                    <h5 class="card-title" style="color: #42A8A1;">Citas por realizar</h5>
                    <p class="card-text">{{ $citasPendientes }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card text-center hover-float">
                <div class="card-body">
                    <h5 class="card-title" style="color: #42A8A1;">Citas confirmadas</h5>
                    <p class="card-text">{{ $citasConfirmadas }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Gráfica de Citas -->
    <div class="row">
        <div class="col-md-6">
            <canvas id="citasChart"></canvas>
        </div>
        <div class="col-md-6">
            <table id="citasMedicoTable" class="table table-striped table-bordered" style="width:100%;">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Paciente</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($citas as $cita)
                    <tr>
                        <td>{{ $cita->fecha }}</td>
                        <td>{{ $cita->hora }}</td>
                        <td>
                            @if ($cita->paciente)
                                {{ $cita->paciente->nombre }} {{ $cita->paciente->apellido }}
                            @else
                                Paciente no asignado
                            @endif
                        </td>
                        <td>
                            @if ($cita->estado == 1)
                                <span style="color: green;">Confirmado</span>
                            @else
                                <span style="color: red;">Pendiente</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    </div>
@endsection

@push('scripts')
    <!-- jQuery -->
      <!-- jQuery -->
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />

<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        $(document).ready(function() {
            // Datos para la gráfica
            var ctx = document.getElementById('citasChart').getContext('2d');
            var citasChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['Citas Pendientes', 'Citas Confirmadas'],
                    datasets: [{
                        label: 'Estado de Citas',
                        data: [{{ $citasPendientes }}, {{ $citasConfirmadas }}],
                        backgroundColor: [
                            'rgba(54, 162, 235, 0.2)', // Azul
                            '#52A0AE' // Color personalizado
                        ],
                        borderColor: [
                            'rgba(54, 162, 235, 1)',
                            '#52A0AE'
                            ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            });
        $('#citasMedicoTable').DataTable({
            "pageLength": 10,
            "pagingType": "simple_numbers",
            "language": {
                "lengthMenu": "Mostrar _MENU_ registros por página",
                "zeroRecords": "No se encontraron registros - lo sentimos",
                "info": "Mostrando la página _PAGE_ de _PAGES_",
                "infoEmpty": "No hay registros disponibles",
                "infoFiltered": "(filtrado de _MAX_ registros totales)",
                "search": "Buscar:",
                "paginate": {
                    "first": "Primero",
                    "last": "Último",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            }
        });
    });
    </script>
@endpush
