@extends('welcome')

@section('titulo')
    Registro usuario
@endsection

@section('contenido')
<div class="md:flex md:justify-center md:gap-10 md:items-center">
    <div class="md:w-5/12 bg-white p-6 rounded-xl shadow-xl">
        {{-- no validate para validar cosas del lado del serivdor --}}
        {{-- Contenido del formulario --}}
        <div class="bg-white p-10 rounded-2xl" >
            {{-- Formulario de registro --}}
            <form action="{{ route('register.store') }}" method="POST" novalidate>
                {{-- Directiva de seguridad --}}
                @csrf

                {{-- Nombre --}}
                <div class="mb-5">
                    <label for="name" class="mb-2 block uppercase text-cyan-700 font-bold">Nombre</label>
                    <input type="text" name="name" id="name" placeholder="Nombre"
                    class="border p-3 w-full rounded-lg @error('name') border-red-500 @enderror" value="{{old('name')}}" 
                    {{-- old funciona para no eliminar la casilla roja hasta que se quite el error --}}
                    />
                {{-- Directiva para mostrar mensaje de error--}}
                @error('name')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center"> {{$message}}</p>
                @enderror

                </div>

                {{-- Email --}}
                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-cyan-700 font-bold">Email</label>
                    <input type="email" name="email" id="email" placeholder="Email"
                        class="border p-3 w-full rounded-lg @error('email') border-red-500 @enderror" value="{{old('email')}}">
                    {{-- Directiva para mostrar mensaje de error --}}
                    @error('email')
                        <span class="text-xs text-red-500 border-red-600 rounded">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-cyan-700 font-bold">Password</label>
                    <input type="password" name="password" id="password" placeholder="Password"
                        class="border p-3 w-full rounded-lg @error('password') border-red-500 @enderror" value="{{old('password')}}">
                    {{-- Directiva para mostrar mensaje de error --}}
                    @error('password')
                        <span class="text-xs text-red-500 border-red-600 rounded">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Confirm Password --}}
                <div class="mb-5">
                    <label for="password_confirmation" class="mb-2 block uppercase text-cyan-700 font-bold">Confirmar Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        placeholder="Confirmar Password"
                        class="border p-3 w-full rounded-lg @error('password_confirmation') border-red-500 @enderror" value="{{old('password_confirmation')}}">
                    {{-- Directiva para mostrar mensaje de error --}}
                    @error('password_confirmation')
                        <span class="text-xs text-red-500 border-red-600 rounded">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Submit --}}
                <div class="mb-5 flex justify-center">
                    <button type="submit" class="bg-cyan-600 hover:bg-cyan-700 text-white font-bold py-2 px-6 rounded-lg">
                         Registrar
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection