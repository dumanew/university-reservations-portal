<!-- @if (Auth::user()->user_role != 'admin')
	<script>window.location = '/menu'</script>
@endif-->
@extends('layouts.app')

@section('title', 'Create Student User')

@section('create-student-form')

	<form method="POST" action="{{ url('/student-list/store') }}" enctype="multipart/form-data">

		@csrf

		<div class="form-group row">
			<label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

			<div class="col-md-6">
				<input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autofocus>

				@error('name')
					<span class="invalid-feedback" role="alert">
						<strong>{{ $message }}</strong>
					</span> 
				@enderror

			</div>
		</div>

		<div class="form-group row">
			<label for="email" class="col-md-4 col-form-label text-md-right">Email address</label>

			<div class="col-md-6">
				<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus>

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

		<div class="form-group row">
			<label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>

			<div class="col-md-6">
				<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
			</div>
		</div>

		<div class="form-group row mb-0">
			<div class="col-md-8 offset-md-4">
				<button class="btn btn-primary" type="submit">Register</button>
			</div>
		</div>

	</form>

@endsection

@section('content')
	
	<div class="container-fluid">
		<div class="row">
			<div class="col-6 mx-auto">
				<h3 class="text-center">Add User</h3>
				<div class="card">
					<div class="card-header">User Information</div>
					<div class="card-body">
						@yield('create-student-form')
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection