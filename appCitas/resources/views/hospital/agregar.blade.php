@extends('layouts.app')

@section('title', 'Dashboard')

@section('aside')
    @include('layouts.aside_hospitales')
@endsection


@section('content')
<style>
  
    @import url('https://fonts.googleapis.com/css2?family=Allerta&family=Calistoga&display=swap');

    .titulo{
      font-family: 'Allerta', serif;
      color:black;
      font-size:30px;
      letter-spacing: 3px;
    }
    .subtitulo{
      font-family: 'Allerta', sans-serif;
      color:black;
      font-size:20px;
      letter-spacing: 3px;
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
<div class="cont">
    <div class="cont-2" style="background-image:url('{{asset('img/doc2.png')}}') ">
    </div>
    <div class="cont-2 p-5">
      <div class="d-flex align-items-center justify-content-center h-custom-2 w-100 h-100" style="height:auto !important">
        <div class="card p-4 w-100 h-100 justify-content-start align-items-center bg-primary" style="background-color: #42A8A1 !important" >
          <div class="card-body p-0 w-100 " >
            <div class="w-100 justify-content-center align-items-start py-4 px-0" style=" background-color: rgba(252,252,252,0.7); border-radius:1rem; height:80%;">
            <form class="px-4" style="width: 100%;" action="{{route('hospital.nss.agregar')}}" method="POST" novalidate>
              @csrf
              <div class="mb-3 justify-center">
                <h5 class=" text-center titulo" >Agregar Paciente</h5>
              </div>
             

              <div class="mb-3">
                <label for="curp" class="form-label subtitulo mx-3 my-0">CURP </label>
                <input type="text" style="border-radius: 43px; height:50px; font-size:20px" class="form-control @error ('curp') is-invalid @enderror"  value="{{old('curp')}}" name="curp" id="curp">
                @error ('curp')
                  <p class="invalid-feedback" >
                      {{$message}}
                  </p>
                @enderror
                
              </div>
                
              <div class="mb-3">
                <label for="nss" class="form-label  subtitulo mx-3 my-0">Número de Seguro</label>
                <input type="text" style="border-radius: 43px; height:50px; font-size:20px" id="nss" name="nss" class="form-control @error ('nss') is-invalid @enderror"  value="{{old('nss')}}">
                @error ('nss')
                  <p class="invalid-feedback" >
                      {{$message}}
                  </p>
                @enderror
              </div>

              <div class=" d-flex justify-content-center align-items-center">
                <button type="submit" class="btn btn-outline-primary boton" >Guardar</button>
              </div>
            </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

