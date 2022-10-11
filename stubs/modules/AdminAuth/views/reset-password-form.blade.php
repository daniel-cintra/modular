@extends('admin-auth::layouts.master')

@section('content')

<div class="flex items-center justify-center min-h-screen px-4 py-12 bg-gray-50 sm:px-6 lg:px-8">
    <div class="w-full max-w-md">
        <div>
            <h2 class="mt-6 text-3xl font-extrabold leading-9 text-center text-gray-900">
                Redefinição de Senha
            </h2>
        </div>

        <form method="POST" action="/admin-auth/reset-password" class="mt-4">

            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <div>
                <input type="text" name="email" id="email" autocapitalize="off" autocorrect="off" autocomplete="off"
                    value="{{ $email ?? old('email') }}" aria-label="Email" autofocus class=" @error('email') bg-red-100 @enderror appearance-none rounded-md relative block w-full px-3
                    py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none
                    focus:shadow-outline-blue focus:border-blue-300 focus:z-10 sm:text-sm sm:leading-5"
                    placeholder="Email" />

                @error('email')
                <p class="px-4 py-2 text-sm text-white bg-red-700 rounded">{{ $message }}</p>
                @enderror
            </div>


            <div class="mt-6">
                <input id="password" type="password"
                    class="@error('password') bg-red-100 @enderror appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 focus:z-10 sm:text-sm sm:leading-5"
                    name="password" autocomplete="new-password" placeholder="Nova Senha (mínimo de 8 caracteres)">

                @error('password')
                <p class="px-4 py-2 text-sm text-white bg-red-700 rounded">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-6">
                <div class="col-md-6">
                    <input type="password" name="password_confirmation"
                        class="relative block w-full px-3 py-2 text-gray-900 placeholder-gray-500 border border-gray-300 rounded-md appearance-none focus:outline-none focus:shadow-outline-blue focus:border-blue-300 focus:z-10 sm:text-sm sm:leading-5"
                        autocomplete="new-password" placeholder="Confirme a Nova Senha">
                </div>
            </div>

            <div class="mt-6">
                <button type="submit"
                    class="relative flex justify-center w-full px-6 py-3 text-sm font-medium text-white transition duration-150 ease-in-out bg-green-600 border border-transparent rounded-md group hover:bg-green-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700">
                    Enviar
                </button>
            </div>

        </form>
    </div>
</div>



@endsection