@if (Auth::user()->user_role != 'admin')
	<script>window.location = '/menu'</script>
@endif

@extends('layouts.app')

@section('title', 'Delete Item')

@section('delete-item-form')

	<form action='{{ url("items/$item->id") }}' method="post" enctype="multipart/form-data">
		
		@csrf

		@method("DELETE")

		<div class="form-group">
			<label>Item Name</label>
			<input type="text" class="form-control" value="{{ $item->name }}" readonly>
		</div>

		<div class="form-group">
			<label>Description</label>
			<input type="text" class="form-control" value="{{ $item->description }}" readonly>
		</div>

		<div class="form-group">
			<label>Category</label>
			<input type="text" class="form-control" value="{{ $category->name }}" readonly>
		</div>

		<div class="form-group">
			<label>Status</label>
			<input type="text" class="form-control" value="{{ $status->item_status }}" readonly>
		</div>

		<button type="submit" class="btn btn-danger btn-block">Delete</button>

	</form>

@endsection

@section('content')
	
	<div class="container-fluid">
		<div class="row">
			<div class="col-6 mx-auto">
				<h3 class="text-center">Delete Item</h3>
				<div class="card">
					<div class="card-header">Item Information</div>
					<div class="card-body">
						@yield('delete-item-form')
					</div>
				</div>
			</div>
		</div>
	</div>
	
@endsection