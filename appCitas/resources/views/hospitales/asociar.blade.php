@extends('layouts.app')

@section('title', 'Dashboard')

@section('aside')
    @include('layouts.aside_hospitales')
@endsection


@section('content')
<div class="container-fluid mt--6">
    <div class="row">
      <div class="col">
        <div class="card bg-white">
          <!-- Card header -->
          <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="mb-0">Nuevos Pacientes</h3>
            <button class="btn btn-primary" type="button"><a href="{{ route('hospital.agregar')}}">Agregar Paciente</a></button>
          </div>          
          <!-- Light table -->
          <div class="table-responsive">
            <table class="table align-items-center table-flush">
              <thead class="thead-light">
                <tr>
                  <th>CURP</th>
                  <th>Número de Seguro</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody class="list">
                @foreach ($hospitalPaciente as $hospitalPacientes)
                <tr>
                  <td>{{ $hospitalPacientes->curp }}</td>
                  <td>{{ $hospitalPacientes->nss }}</td>
                  <td>
                    <form action="{{ route('hospital.nss.destroy', $hospitalPacientes->id) }}" method="POST">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="text-red-600">
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

