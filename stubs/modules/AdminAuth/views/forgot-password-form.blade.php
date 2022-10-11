@extends('admin-auth::layouts.master')

@section('content')

<div class="flex items-center justify-center min-h-screen px-4 py-12 bg-gray-50 sm:px-6 lg:px-8">
    <div class="w-full max-w-md">
        <div>
            <h2 class="mt-6 text-3xl font-extrabold leading-9 text-center text-gray-900">
                Esqueceu sua senha?
            </h2>
        </div>

        @if (session('status'))
        <div class="px-4 py-2 mt-3 text-sm text-green-700 bg-gray-200 rounded" role="alert">
            {{ session('status') }}
        </div>
        @endif

        @if ($errors->any())
        <p class="mt-6 mb-2 text-center text-gray-700">
            Ooops, algo deu errado
        </p>
        <ul>
            @foreach ($errors->all() as $error)
            <li class="px-4 py-2 text-sm text-white bg-red-700 rounded">{{ $error }}</li>
            @endforeach
        </ul>
        @endif

        <form method="POST" action="/admin-auth/send-reset-link-email" class="mt-4">

            @csrf

            <div>
                <input type="email" name="email" autocapitalize="off" autocorrect="off" autocomplete="off"
                    aria-label="Email"
                    class="relative block w-full px-3 py-2 text-gray-900 placeholder-gray-500 border border-gray-300 rounded-md appearance-none focus:outline-none focus:shadow-outline-blue focus:border-blue-300 focus:z-10 sm:text-sm sm:leading-5"
                    placeholder="Email" />

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