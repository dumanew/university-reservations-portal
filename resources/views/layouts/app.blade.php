<!DOCTYPE html>

<html>
	<head>
		<meta charset="utf-8">

		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>@yield('title')</title>

		<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" >
		<link href="{{ asset('css/style.css') }}" rel="stylesheet" >
	</head>
	<body>

		@include('layouts.header')

		<main class="py-4">
			@yield('content')			
		</main>

		@include('layouts.footer')

		<script src="{{ asset('js/jquery.slim.min.js') }}" defer></script>
		<script src="{{ asset('js/popper.min.js') }}" defer></script>
		<script src="{{ asset('js/bootstrap.min.js') }}" defer></script>

	</body>
</html>