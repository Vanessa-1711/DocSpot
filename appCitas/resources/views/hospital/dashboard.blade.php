@extends('layouts.app')

@section('title', 'Dashboard')

@section('aside')
    @include('layouts.aside_hospitales')
@endsection

@section('content')
    <!-- Estilos personalizados -->
    <style>
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

        #citasTable thead th, #pacientesTable thead th, #medicosTable thead th {
            font-size: larger; 
            color: #52A0AE;
            font-weight: bold;
            text-align: center;
        }

        #citasTable, #pacientesTable, #medicosTable {
            border-radius: 15px;
            overflow: hidden;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            color: white !important;
            background: #52a0ae !important;
            border: 1px #52a0ae solid !important;
            border-radius: 5px !important;
        }
    </style>
<div class="container">
    <!-- Estilos personalizados... -->

    <!-- Tarjetas de Resumen -->
    <div class="row mb-4">
        <!-- Tarjeta para cantidad de pacientes asociados -->
        <div class="col-md-6">
            <div class="card text-center hover-float">
                <div class="card-body">
                    <h5 class="card-title" style="color: #42A8A1;">Pacientes Asociados</h5>
                    <p class="card-text">{{ $cantidadPacientesAsociados }} pacientes</p>
                </div>
            </div>
        </div>

        <!-- Tarjeta para cantidad de médicos del hospital -->
        <div class="col-md-6">
            <div class="card text-center hover-float">
                <div class="card-body">
                    <h5 class="card-title" style="color: #42A8A1;">Médicos del Hospital</h5>
                    <p class="card-text">{{ $cantidadMedicosHospital }} médicos</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Tablas de Pacientes y Médicos -->
    <div class="row">
        <!-- Tabla de Pacientes Asociados -->
        <div class="col-md-6">
            <table id="pacientesTable" class="table table-striped table-bordered" style="width:100%;">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>NSS</th>
                        <th>CURP</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pacientes as $paciente)
                        <tr>
                            <td>{{ $paciente->nombre }}</td>
                            <td>{{ $paciente->apellido }}</td>
                            <td>{{ $paciente->num_seguro }}</td>
                            <td>{{ $paciente->curp }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center">No hay pacientes asociados</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Tabla de Médicos del Hospital -->
        <div class="col-md-6">
            <table id="medicosTable" class="table table-striped table-bordered" style="width:100%;">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($medicos as $medico)
                        <tr>
                            <td>{{ $medico->nombre }}</td>
                            <td>{{ $medico->apellido }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center">No hay médicos registrados</td>
                        </tr>
                    @endforelse
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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
  
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Inicialización de DataTables para las nuevas tablas -->
    
    <script>
        $(document).ready(function() {
            // Inicialización de DataTables para la tabla de Pacientes
            $('#pacientesTable').DataTable({
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

            // Inicialización de DataTables para la tabla de Médicos
            $('#medicosTable').DataTable({
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
