<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Modular') }}</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="/favicon.svg" />

    @vite(['resources-site/css/site.css'])
    @yield('headEndScripts')
</head>

<body>
    <div id="app">
        @yield('content')
    </div>

    @yield('bodyEndScripts')
</body>

</html>
