<!DOCTYPE html>
<html lang="pt-br">

	<head>

		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		{{-- used in axios requests if needed --}}
		<meta name="csrf-token" content="{{ csrf_token() }}">

		<title>Adm</title>
		<meta name="description" content="Adm">

		<link rel="stylesheet" href="{{ mix('/backend/css/app.css') }}">

	</head>

	<body>

        @yield('content')
            
        <script src="{{ mix('/backend/js/app-auth.js') }}"></script>

	</body>

</html>