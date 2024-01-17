@if (Auth::user()->user_role != 'admin')
	<script>window.location = '/menu'</script>
@endif

@extends('layouts.app')

@section('title', 'Delete User')

@section('delete-user-form')

	<form action='{{ url("student-list/$user->id") }}' method="post" enctype="multipart/form-data">
		
		@csrf

		@method("DELETE")

		<div class="form-group">
			<label>Full Name</label>
			<input type="text" class="form-control" value="{{ $user->name }}" readonly>
		</div>

		<div class="form-group">
			<label>Email</label>
			<input type="email" class="form-control" value="{{ $user->email }}" readonly>
		</div>

		<button type="submit" class="btn btn-danger btn-block">Delete</button>

	</form>

@endsection

@section('content')
	
	<div class="container-fluid">
		<div class="row">
			<div class="col-6 mx-auto">
				<h3 class="text-center">Delete User</h3>
				<div class="card">
					<div class="card-header">User Information</div>
					<div class="card-body">
						@yield('delete-user-form')
					</div>
				</div>
			</div>
		</div>
	</div>
	
@endsection