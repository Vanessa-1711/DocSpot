@extends('layouts.app')

@section('title', 'Agregar Doctor')

@section('aside')
    @include('layouts.aside_hospitales')
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

    .image-input-container {
        display: inline-block;
        position: relative;
        margin-left: 10%;
    }

    .image-input-container label {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 150px;
        height: 150px;
        border-radius: 50%;
        border: 2px solid #ccc;
        cursor: pointer;
        background: #FFFFFF;
    }
    .image-input-container label i {
        font-size: 50px;
    }
    .image-input-container label .selected-image {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border-radius: 50%;
        background-size: cover;
        background-position: center;
    }
    .image-input-container input[type="file"] {
        display: none;
    }
</style>
<div class="container-fluid mt-5">
    <div class="row">
        <div class="col-md-6">
            <!-- Contenido de la columna izquierda (card, formulario, etc.) -->
            <div class="card p-4" style="height: 100%">
                <div class="mb-5 justify-center mt-2">
                    <h5 class=" text-center titulo" >Registrar Doctor</h5>
                </div>
                <form action="{{route('hospital.agregarDoc')}}" method="POST" novalidate enctype="multipart/form-data">
                    @csrf
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
                    <div class="row mb-3">

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="nombre" class="subtitulo">Nombre</label>
                                <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" value="{{ old('nombre') }}">
                                @error('nombre')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
  
                          <div class="mb-5">
                            <label for="fecha_nacimiento" class="form-label subtitulo mx-3 my-0">Fecha de Nacimiento</label>
                            <input type="date" class="form-control @error ('fecha_nacimiento') is-invalid @enderror"  value="{{old('fecha_nacimiento')}}" name="fecha_nacimiento" id="fecha_nacimiento">
                            @error ('fecha_nacimiento')
                              <p class="invalid-feedback" >
                                  {{$message}}
                              </p>
                            @enderror
                          </div>
                          <div class="mb-5">
                                <label for="telefono" class="form-label subtitulo mx-3 my-0">Telefono</label>
                                <input type="text" class="form-control @error ('telefono') is-invalid @enderror" name="telefono" id="telefono" value="{{ old('telefono') }}">
                                @error ('telefono')
                                    <p class="invalid-feedback">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        
                          <div class="mb-3">
                            <label for="password" class="form-label subtitulo mx-3 my-0">Contraseña</label>
                            <input type="password" class="form-control @error ('password') is-invalid @enderror"  value="{{old('password')}}"  name="password"  id="password">
                            @error ('password')
                              <p class="invalid-feedback" >
                                  {{$message}}
                              </p>
                            @enderror
                          </div>
                          
                        </div>
                        <div class="col-md-6">
                            <div class="mb-5">
                                <label for="apellido" class="subtitulo">Apellido</label>
                                <input type="text" class="form-control @error('apellido') is-invalid @enderror" id="apellido" name="apellido" value="{{ old('apellido') }}">
                                @error('apellido')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                          <div class="mb-3">
                            <label for="username" class="form-label subtitulo mx-3 my-0">Username</label>
                            <input type="text" class="form-control @error ('username') is-invalid @enderror"  value="{{old('username')}}"  name="username"  id="username">
                            @error ('username')
                              <p class="invalid-feedback" >
                                  {{$message}}
                              </p>
                            @enderror
                          </div>
                          <!-- ... -->
                          <div class="mb-3">
                            <label for="email" class="form-label subtitulo mx-3 my-0">Correo electrónico</label>
                            <input type="email" class="form-control @error ('email') is-invalid @enderror"  value="{{old('email')}}" name="email" id="email">
                            @error ('email')
                              <p class="invalid-feedback" >
                                  {{$message}}
                              </p>
                            @enderror
                          </div>
                          <div class="mb-3">
                            <label for="password_confirmation" class="form-label subtitulo mx-3 my-0">Confirmar contraseña</label>
                            <input type="password" class="form-control @error ('password_confirmation') is-invalid @enderror"  value="{{old('password_confirmation')}}" name="password_confirmation" id="password_confirmation">
                            @error ('password_confirmation')
                              <p class="invalid-feedback" >
                                  {{$message}}
                              </p>
                            @enderror
                          </div>
                        </div>
                        <div class="row mb-3">
                          <!-- Checkboxes para días de la semana -->
                          <div class="col-md-6">
                              <div class="mb-3">
                                  <label class="subtitulo" for="dia">Seleccionar Días</label>
                                  @foreach(['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'] as $dia)
                                      <div class="form-check">
                                          <input class="form-check-input @error('checkboxDias') is-invalid @enderror" type="checkbox" id="checkbox{{ $dia }}" name="checkboxDias[]" value="{{ $dia }}">
                                          <label class="form-check-label" for="checkbox{{ $dia }}">{{ $dia }}</label>
                                      </div>
                                  @endforeach
                                  @error('checkboxDias')
                                      <div class="invalid-feedback">{{ $message }}</div>
                                  @enderror
                              </div>
                          </div>
                      
                          <!-- Campos de hora (inicial y final) -->
                          <div class="col-md-6">
                              @foreach(['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'] as $dia)
                                  <div id="horas{{ $dia }}" style="display: none;">
                                      <div class="mb-3">
                                          <label for="horaInicio{{ $dia }}" class="form-label subtitulo mx-3 my-0">Hora de Entrada ({{ $dia }})</label>
                                          <input type="time" class="form-control @error('horaInicio.' . $dia) is-invalid @enderror" id="horaInicio{{ $dia }}" name="horaInicio[{{ $dia }}]">
                                          @error('horaInicio.' . $dia)
                                              <div class="invalid-feedback">{{ $message }}</div>
                                          @enderror
                                      </div>
                                      <div class="mb-3">
                                          <label for="horaFinal{{ $dia }}" class="form-label subtitulo mx-3 my-0">Hora de Salida ({{ $dia }})</label>
                                          <input type="time" class="form-control @error('horaFinal.' . $dia) is-invalid @enderror" id="horaFinal{{ $dia }}" name="horaFinal[{{ $dia }}]">
                                          @error('horaFinal.' . $dia)
                                              <div class="invalid-feedback">{{ $message }}</div>
                                          @enderror
                                      </div>
                                  </div>
                              @endforeach
                          </div>
                      </div>
                      
  
                      </div>

                    <div class=" mt-2 d-flex justify-content-center align-items-center">
                        <button type="submit" class="btn btn-outline-primary boton" >Guardar</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-6"  style="height: 500% !important;">
            <!-- Contenido de la columna derecha (imagen, etc.) -->
            <img style="border-radius:15px" src="{{ asset('img/doc3.png') }}" alt="Imagen" class="img-fluid">
        </div>
    </div>
</div>


<!-- Función para manejar la carga de imágenes -->
<script>
    function handleImageUpload(event) {
            const input = event.target;
            const imageContainer = input.parentElement;
            const selectedImage = imageContainer.querySelector('.selected-image');
    
            const file = input.files[0];
            const reader = new FileReader();
    
            reader.onload = function (e) {
            selectedImage.style.backgroundImage = `url(${e.target.result})`;
            };
    
            reader.readAsDataURL(file);
        }
    </script>

<!-- Función para habilitar o deshabilitar campos de hora -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Función para mostrar u ocultar las horas según el estado del checkbox
    function toggleHoras(checkbox) {
        var dia = checkbox.value;
        var horasDia = document.getElementById('horas' + dia);

        // Mostrar las horas si el checkbox está seleccionado
        horasDia.style.display = checkbox.checked ? 'block' : 'none';
    }

    var checkboxDias = document.querySelectorAll('input[name="checkboxDias[]"]');

    // Restaurar el estado de los checkboxes y horas al cargar la página
    checkboxDias.forEach(function (checkbox) {
        var storedValue = sessionStorage.getItem('checkbox-' + checkbox.value);

        if (storedValue) {
            checkbox.checked = true;
            toggleHoras(checkbox);
        }
    });

    // Asignar el evento change a los checkboxes
    checkboxDias.forEach(function (checkbox) {
        checkbox.addEventListener('change', function () {
            toggleHoras(checkbox);

            // Almacenar el estado del checkbox en sessionStorage
            sessionStorage.setItem('checkbox-' + checkbox.value, checkbox.checked);
        });
    });

    // Borrar sessionStorage al enviar el formulario sin errores
    var errores = document.querySelectorAll('.is-invalid');
    if (errores.length === 0) {
        checkboxDias.forEach(function (checkbox) {
            sessionStorage.removeItem('checkbox-' + checkbox.value);
        });
    }

    // Función para manejar la carga de imágenes
    function handleImageUpload(event) {
        const input = event.target;
        const imageContainer = input.parentElement;
        const selectedImage = imageContainer.querySelector('.selected-image');

        const file = input.files[0];
        const reader = new FileReader();

        reader.onload = function (e) {
            selectedImage.style.backgroundImage = `url(${e.target.result})`;
        };

        reader.readAsDataURL(file);
    }

    // Función para habilitar o deshabilitar campos de hora
    function initialize() {
        checkboxDias.forEach(function (checkbox) {
            toggleHoras(checkbox);
        });
    }

    initialize();
});

</script>


@endsection

