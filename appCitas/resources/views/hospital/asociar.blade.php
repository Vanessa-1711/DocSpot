@extends('layouts.app')

@section('title', 'Dashboard')

@section('aside')
    @include('layouts.aside_hospitales')
@endsection


@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
  .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
      color: white !important;
      background: #52a0ae  !important;
      border: 1px #52a0ae solid !important;
      border-radius:5px  !important;
  }
  .btn-outline-primary {
      background-color: #42A8A1;
      border-color: #52A0AE;
      color: white !important;
    }
  .btn-outline-primary:hover {
      background-color: #42A8A1;
      color: #298780 !important;
      border-color: #42A8A1;
    }
    .a:hover{
      color: #298780 !important;
    }
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
     /* Estilos del botón */
     .delete-button {
        width: 40px; /* Ajusta el ancho según sea necesario */
        height: 40px; /* Ajusta la altura según sea necesario */
        border: none;
        outline: none;
        cursor: pointer;
        transition: background-color 0.3s ease;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #42A8A1;
        border-radius: 50%;
        color:white;
    }

    /* Estilo para cuando se hace hover en el botón */
    .delete-button:hover {
        background-color: #6ca6f5; /* Color más claro al hacer hover */
    }

    /* Estilo para el ícono SVG */
    .delete-button svg {
        width: 100%;
        height: 100%;
    }

  </style>
<div class="container-fluid mt--6">
    <div class="row">
      <div class="col">
        <div class="card bg-white">
          <!-- Card header -->
          <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="mb-0">Nuevos Pacientes</h3>
            <button class="btn btn-outline-primary " type="button"><a style="color:white" class="a" href="{{ route('hospital.agregar')}}">Agregar Paciente</a></button>
          </div> 
          <!-- Light table -->
          @if(Session::has('success'))
    <script>
        Swal.fire({
            title: 'Éxito',
            text: '{{ Session::get('success') }}',
            icon: 'success',
            confirmButtonColor: '#42A8A1'
        });
    </script>
@endif

          <div class="table-responsive p-3">
            <table id="myTable" class="table table-striped table-bordered table align-items-center table-flush" style=" text-align: center;">
              <thead class="thead-light">
                <tr>
                  <th  style=" text-align: center;">CURP</th>
                  <th  style=" text-align: center;">Número de Seguro</th>
                  <th  style=" text-align: center;">Acciones</th>
                </tr>
              </thead>
              <tbody class="list">
                @foreach ($hospitalPaciente as $hospitalPacientes)
                <tr>
                  <td  style=" text-align: center;">{{ $hospitalPacientes->curp }}</td>
                  <td  style=" text-align: center;">{{ $hospitalPacientes->nss }}</td>
                  <td  style=" text-align: center;justify-content: center;align-items: center;display: flex;">
                    <form action="{{ route('hospital.nss.destroy', $hospitalPacientes->id) }}" method="POST">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="delete-button text-red-600 delete-button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 256 256">
                            <path d="M216,48H176V40a24,24,0,0,0-24-24H104A24,24,0,0,0,80,40v8H40a8,8,0,0,0,0,16h8V208a16,16,0,0,0,16,16H192a16,16,0,0,0,16-16V64h8a8,8,0,0,0,0-16ZM96,40a8,8,0,0,1,8-8h48a8,8,0,0,1,8,8v8H96Zm96,168H64V64H192ZM112,104v64a8,8,0,0,1-16,0V104a8,8,0,0,1,16,0Zm48,0v64a8,8,0,0,1-16,0V104a8,8,0,0,1,16,0Z">
                            </path>
                        </svg>
                    </button>
                  </form>
                  </td>
                </tr>
                @endforeach
                <!-- Más filas aquí -->
              </tbody>
            </table>
          </div>
        </div>
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


<script>
    $(document).ready( function () {
        $('#myTable').DataTable({
            language: {
                emptyTable: "Aún no hay pacientes sin asociar que mostrar."
            }
        });

        $('.delete-button').on('click', function(event) {
            event.preventDefault(); // Evita la acción predeterminada (en este caso, el envío del formulario)

            Swal.fire({
                title: '¿Estás seguro?',
                text: 'Esta acción eliminará el registro del paciente.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#42A8A1',
                cancelButtonColor: '#677495',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Si se confirma, proceder con la eliminación
                    // Envía el formulario para eliminar el registro
                    $(this).closest('form').submit();
                }
            });
        });
    });
</script>
@endpush
