@if (Auth::user()->user_role != 'admin')
	<script>window.location = '/menu'</script>
@endif

@extends('layouts.app')

@section('title', 'Student List')

@section('content')

	<div class="container-fluid">

		<h3 class="text-center">Student List</h3>

		@if (!empty(Auth::user()) && Auth::user()->user_role == 'admin')
			<a href="{{ url('student-list/student-create') }}" class="btn btn-primary d-block">Add User</a>
		@endif
			
		<table class="table table-hover my-1">
			
			<thead>
				<tr>
					<th class="text-center" scope="col">Full Name</th>
					<th class="text-center" scope="col">Email</th>
					<th class="text-center" scope="col">Status</th>
					<th class="text-center" scope="col">Options</th>
				</tr>
			</thead>

			<tbody>
				@foreach ($users as $user)
					<tr scope="row">
						<td class="text-center">{{ $user->name }}</td>
						<td class="text-center">{{ $user->email }}</td>
						<td class="text-center"></td>
						<td class="text-center">
							<div class="btn-group btn-block">
								<a href='{{ url("student-list/$user->id/student-edit") }}' class="btn btn-info">Edit</a>
								<a href='{{ url("student-list/$user->id/student-delete") }}' class="btn btn-danger">Delete</a>
							</div>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>	

	</div>

@endsection

@if (!empty(session()->get('message')))
	<script>alert('{{ session()->get("message") }}')</script>
@endif