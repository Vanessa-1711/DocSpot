@extends('layouts.app')

@section('title', 'Dashboard')

@section('aside')
    @include('layouts.aside_hospitales')
@endsection


@section('content')
<div class="cont">
    <div class="cont-2" style="background-image:url('{{asset('img/doc2.png')}}') ">
    </div>
    <div class="cont-2 p-5">
      <div class="d-flex align-items-center justify-content-center h-custom-2 w-100 h-100" style="height:auto !important">
        <div class="card p-5 w-100 h-100 justify-content-start align-items-center bg-primary" >
          <div class="card-body p-0 w-100 " >
            <div class="w-100 justify-content-center align-items-start py-4 px-0" style=" background-color: rgba(252,252,252,0.7); border-radius:1rem; height:80%;">
            <form class="px-4" style="width: 100%;" action="{{route('hospital.nss.agregar')}}" method="POST" novalidate>
              @csrf
              <div class="mb-3 justify-center">
                <h5 class=" text-center titulo" >Agregar PACIENTE</h5>
              </div>
              
              @error('mensaje')
              <script>
                  Swal.fire({
                      title: 'Error al acceder',
                      text: '{{ $message }}',
                      icon: 'error',
                      timer: 1000, 
                      timerProgressBar: true,
                      showConfirmButton: false,
                  });
              </script>
              @enderror

              <div class="mb-3">
                <label for="curp" class="form-label subtitulo mx-3 my-0">Curp </label>
                <input type="text" style="border-radius: 43px; height:50px; font-size:20px" class="form-control @error ('curp') is-invalid @enderror"  value="{{old('curp')}}" name="curp" id="curp">
                @error ('curp')
                  <p class="invalid-feedback" >
                      {{$message}}
                  </p>
                @enderror
              </div>
                
              <div class="mb-3">
                <label for="nss" class="form-label  subtitulo mx-3 my-0">Número de Seguro Social</label>
                <input type="text" style="border-radius: 43px; height:50px; font-size:20px" id="nss" name="nss" class="form-control @error ('nss') is-invalid @enderror"  value="{{old('nss')}}">
                @error ('nss')
                  <p class="invalid-feedback" >
                      {{$message}}
                  </p>
                @enderror
              </div>

              <div class=" d-flex justify-content-center align-items-center">
                <button type="submit" class="btn btn-primary boton" >Guardar</button>
              </div>
            </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

