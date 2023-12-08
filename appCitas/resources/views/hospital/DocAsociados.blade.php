@extends('layouts.app')

@section('title', 'Doctores')

@section('aside')
    @include('layouts.aside_hospitales')
@endsection

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Allerta&family=Calistoga&display=swap');
    .nombreHospital{
      font-family: 'Allerta', sans-serif;
      color:black;
      font-size:36px;
      letter-spacing: 3px;
    }
    .medico{
        font-family: 'Allerta', sans-serif;
        color:black;
        background-color: #52A0AE;
        font-size:30px;
        margin-top: 5%;
    }
    .linea{
        width: 80%;
        border-top: 2px solid #000000 !important;
        margin-bottom: 2%;
        margin-left: auto;
        margin-right: auto;

    }
    .custom-card {
        margin-bottom: 0; /* Puedes ajustar este valor según tus preferencias */
    }

    .card-btn a.btn-citas {
        background-color: #42A8A1;
        color: #ffffff;
        border: 2px solid #42A8A1;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .card-btn a.btn-citas:hover {
        background-color: #ffffff !important;
        color: #000000 !important;
        border-color: #42A8A1 !important;
    }
    .search-container {
        margin-bottom: 1%; /* Ajusta según tus preferencias */
        display: flex;
        border-radius: 20px; /* Ajusta según tus preferencias */
        overflow: hidden;
        width: 35%; /* Ajusta el ancho del buscador según tus preferencias */
        margin-right: 5% !important;
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
<div class="container mt-3">

    <div class="row mt-3 justify-content-center">
      <div class="col-md-10">
          <div class="medico p-3 text-white rounded" style="border-radius: 5%; display: flex; align-items: center; justify-content: space-between;">
              <h2 class="medico m-0" style="margin-left: 2%; letter-spacing: 5px;">MEDICOS</h2>
              <div class="search-container">
                <input type="text" placeholder="Buscar médico...">
            </div>
          </div>
      </div>
    </div>
</div>




@endsection