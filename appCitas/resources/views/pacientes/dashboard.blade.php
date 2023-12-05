@extends('layouts.app')

@section('title', 'Dashboard')

@section('aside')
    @include('layouts.aside_pacientes')
@endsection

@section('content')
<div class="container">
    <!-- Estilos personalizados -->
    <style>
        .hover-float {
            transition: box-shadow 0.3s, transform 0.3s;
            box-shadow: 0 8px 12px 0 rgba(0,0,0,0.2);
        }

        .hover-float:hover {
            transform: translateY(-5px); /* Eleva ligeramente la tarjeta */
            box-shadow: 0 15px 20px 0 rgba(0,0,0,0.3);
        }

        .card-text {
            font-size: larger; /* Aumenta el tamaño del texto */
        }

        #citasTable thead th {
            font-size: larger; 
            color: #52A0AE;
            font-weight: bold;
            text-align: center;
        }

        /* Añade aquí el estilo para redondear las esquinas */
        #citasTable {
            border-radius: 15px; /* Ajusta este valor según tu preferencia */
            overflow: hidden; /* Esto asegura que el contenido interno también se ajuste a las esquinas redondeadas */
        }
        
    </style>

    <!-- Tarjetas de resumen de citas -->
    <div class="row mb-4">
        <!-- Tarjeta de Citas Confirmadas -->
        <div class="col-md-4">
            <div class="card text-center hover-float">
                <div class="card-body">
                    <h5 class="card-title" style="color: #42A8A1;">Citas Confirmadas</h5>
                    <p class="card-text">{{ $confirmadasPorRealizar }} citas</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center hover-float">
                <div class="card-body">
                    <h5 class="card-title" style="color: #42A8A1;">Citas No Confirmadas</h5>
                    <p class="card-text">{{ $noConfirmadas }} citas</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center hover-float">
                <div class="card-body">
                    <h5 class="card-title" style="color: #42A8A1;">Citas Atrasadas</h5>
                    <p class="card-text">{{ $citasAtrasadas }} citas</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-6 d-flex justify-content-center align-items-center">
            <!-- Canvas para la gráfica -->
            <canvas id="citasChart" style="max-width: 400px; max-height: 400px;"></canvas>
        </div>
        
        <div class="col-md-6">
            <style>
                #citasTable thead th {
                    font-size: larger; 
                    color: #52A0AE;
                    font-weight: bold;
                    text-align: center;
                }

            </style>
            <table id="citasTable" class="table table-striped table-bordered" style="width:100%;">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Médico</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($citas as $cita)
                        <tr>
                            <td class="text-center">{{ \Carbon\Carbon::parse($cita->fecha)->format('d/m/Y') }}</td>
                            <td class="text-center">{{ \Carbon\Carbon::parse($cita->hora)->format('g:i A') }}</td>
                            <td class="text-center">{{ $cita->medico->nombre }} {{ $cita->medico->apellido }}</td>
                            <td class="text-center {{ $cita->estado == 1 ? 'text-success' : 'text-warning' }}">
                                {{ $cita->estado == 1 ? 'Confirmada' : 'Pendiente' }}
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

     <!-- DataTables -->
     <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
     <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        $(document).ready(function() {
            $('#citasTable').DataTable({
                "pageLength": 10,
                "pagingType": "simple", // Cambiar a 'simple' para solo mostrar 'Anterior' y 'Siguiente'
                "language": {
                    "paginate": {
                        "previous": "Anterior",
                        "next": "Siguiente"
                    },
                    "info": "Mostrando _PAGE_ de _PAGES_ páginas",
                    "lengthChange": false,
                    "searching": false
                },
                "dom": 
                    "<'row'<'col-sm-12'tr>>" + // Estructura de la tabla
                    "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>", // Estructura del infomation y pagination
            });

            var ctx = document.getElementById('citasChart').getContext('2d');
            var citasChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['Citas Confirmadas', 'Citas Pendientes'],
                    datasets: [{
                        label: 'Resumen de Citas',
                        data: [{{ $confirmadasPorRealizar }}, {{ $noConfirmadas }}],
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
                    maintainAspectRatio: false,
                    tooltips: {
                        callbacks: {
                            label: function(tooltipItem, data) {
                                var dataset = data.datasets[tooltipItem.datasetIndex];
                                var total = dataset.data.reduce(function(previousValue, currentValue) {
                                    return previousValue + currentValue;
                                });
                                var currentValue = dataset.data[tooltipItem.index];
                                var percentage = Math.floor(((currentValue/total) * 100)+0.5);         
                                return data.labels[tooltipItem.index] + ': ' + percentage + '%';
                            }
                        }
                    }
                }
            });
        });
    </script>
@endpush
