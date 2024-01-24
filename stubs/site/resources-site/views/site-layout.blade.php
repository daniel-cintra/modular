<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title inertia>{{ config('app.name', 'Modular') }}</title>

    <link rel="icon" href="/favicon.svg" />

    @vite(['resources-site/css/site.css'])
    @yield('headEndScripts')
</head>

<body class="bg-gray-100">
    <div id="app">
        @yield('content')
    </div>

    @yield('bodyEndScripts')
</body>

</html>
