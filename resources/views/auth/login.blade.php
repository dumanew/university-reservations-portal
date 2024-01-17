@extends('layouts.app')

@section('title', 'Login Page')

@section('login-form')

	<form method="POST" action="{{ route('login') }}">

		@csrf

		<div class="form-group row">
			<label for="email" class="col-md-4 col-form-label text-md-right">Email address</label>

			<div class="col-md-6">
				<input type="email" id="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus>

				@error('email')
					<span class="invalid-feedback" role="alert">
						<strong>{{ $message }}</strong>
					</span>
				@enderror

			</div>
		</div>

		<div class="form-group row">
			<label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

			<div class="col-md-6">
				<input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" required>

				@error('password')
					<span class="invalid-feedback" role="alert">
						<strong>{{ $message }}</strong>
					</span>
				@enderror

			</div>
		</div>

		<div class="form-group row mb-0">
			<div class="col-md-8 offset-md-4">
				<button class="btn btn-primary" type="submit">Login</button>
			</div>
		</div>

	</form>

@endsection

@section('content')

	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<div class="card">
					<div class="card-header">Login</div>
					<div class="card-body">
						@yield('login-form')
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection