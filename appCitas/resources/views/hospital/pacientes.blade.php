@extends('layouts.app')

@section('title', 'Hospitales')

@section('aside')
    @include('layouts.aside_hospitales')
@endsection


@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
    
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
              <h2 class="medico m-0" style="margin-left: 2%; letter-spacing: 5px;  color:white">PACIENTES</h2>
              <div class="search-container">
                  <input id="searchInput" type="text" class="px-3 py-2" style="font-size:17px" placeholder="Buscar paciente...">
              </div>
          </div>
      </div>
  </div>
<div class="container-fluid py-5">
    <div class="row" id="hospitalList">
        @foreach($nombresPacientes as $nombre)
            <div class="col-xl-3 col-md-4 col-sm-4 mb-4 medicoo" data-id="{{ $nombre->nombre }}">
                <div class="card">
                    <div class="card-body text-center">
                        <h4 class="card-title mb-3" style="color: #52A0AE;">{{ $nombre ->nombre }}</h4>
                        <img src="https://laboratoriosniam.com/wp-content/uploads/2018/07/michael-dam-258165-unsplash_WEB2.jpg" class="card-img-top rounded" style="border-radius: 15px;" alt="Paciente Imagen">
                        <div class="card-btn mt-2" style="display: flex;align-items: center;justify-content: center;">
                          <a href="{{ route('hospital.vermasPaciente', ['id' => $nombre->id]) }}" class="btn pr-2" type="submit" style="background-color: #42A8A1; color: #ffffff; margin-right: 10px;"><i class="fas fa-eye"> </i> Ver más</a>
                          <form action="{{ route('hospital.paciente.destroy', $nombre->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background-color: #42A8A1; color: #ffffff;" class="btn delete-button text-red-600 delete-button mb-0">
                                <i class="fas fa-trash"></i> 
                                Eliminar
                            </button>
                        </form>

                        </div>
                        
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection



<!--   Core JS Files   -->
<script src="{{asset('js/core/popper.min.js')}}"></script>
<script src="{{asset('js/core/bootstrap.min.js')}}"></script>
<script src="{{asset('js/plugins/perfect-scrollbar.min.js')}}"></script>
<script src="{{asset('js/plugins/smooth-scrollbar.min.js')}}"></script>
<script src="{{asset('js/plugins/chartjs.min.js')}}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready( function () {
        
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
<script>

  document.addEventListener('DOMContentLoaded', function () {
      const searchInput = document.getElementById('searchInput');
      const hospitalList = document.getElementById('hospitalList');
      const originalCards = hospitalList.innerHTML;

      searchInput.addEventListener('input', function (e) {
          const searchString = e.target.value.trim().toLowerCase();

          // Restablecer el contenido original de la lista antes de aplicar el filtro
          hospitalList.innerHTML = originalCards;

          // Si el campo de búsqueda está vacío, no es necesario aplicar el filtro
          if (searchString === '') {
              return;
          }

          const hospitals = hospitalList.getElementsByClassName('medicoo');
          const filteredHospitals = Array.from(hospitals).filter(function (hospital) {
              const hospitalName = hospital.getAttribute('data-id').toLowerCase();
              return hospitalName.includes(searchString);
          });

          // Mostrar solo los elementos que coinciden con la búsqueda
          hospitalList.innerHTML = '';
          filteredHospitals.forEach(function (hospital) {
              hospitalList.appendChild(hospital.cloneNode(true));
          });
      });
  });



</script>

<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
<script src="{{asset('js/argon-dashboard.min.js?v=2.0.4')}}"></script>