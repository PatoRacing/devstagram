@extends('layouts.app')

@section('titulo')
    Inicia sesión en DevStagram
@endsection('titulo')

@section('contenido')
    <div class="md:flex md:justify-center md:gap-10  md:items-center">
        <div class="md:w-6/12 p-5"><!--md= media querie-->
            <img src="{{asset('img/login.jpg')}}" alt="Imagen login de usuario">
        </div>

        <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-xl">
            <form method="POST" action="{{route('login')}}" novalidate>
                @csrf
                @if(session('mensaje'))
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                        {{session('mensaje')}}
                    </p>
                @endif
                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-grey-500 font-bold">
                        Email
                    </label>
                    <input
                    type="email"
                    name="email"
                    id="email"
                    placeholder="Tu email de registro"
                    class="border p-3 w-full rounded-lg @error('email') border-red-500 @enderror"
                    value="{{old('email')}}"
                    />
                    @error('email')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{$message}}
                        </p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-grey-500 font-bold">
                        Password
                    </label>
                    <input
                    type="password"
                    name="password"
                    id="password"
                    placeholder="Password de registro"
                    class="border p-3 w-full rounded-lg @error('password') border-red-500 @enderror"
                    />
                    @error('password')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{$message}}
                        </p>
                    @enderror
                </div>

                <div class="mb-5">
                    <input
                    type="checkbox"
                    name="remember">
                    <label class="text-gray-500 text-sm">
                        Mantener sesión abierta
                    </label>
                </div>
                
                <input
                type="submit"
                value="Iniciar Sesión"
                class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer 
                uppercase font-bold w-full p-3 text-white rounded-lg"
                />
            </form>
        </div>
    </div>

@endsection('contenido')