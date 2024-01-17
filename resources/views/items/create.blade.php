@if (Auth::user()->user_role != 'admin')
	<script>window.location = '/menu'</script>
@endif

@extends('layouts.app')

@section('title', 'Add Item')

@section('add-item-form')

	<form action="{{ url('items/store') }}" method="post" enctype="multipart/form-data">

		@csrf

		<div class="form-group">
			<label>Item Name</label>
			<input type="text" class="form-control" name="name" required>
		</div>

		<div class="form-group">
			<label>Description</label>
			<input type="text" class="form-control" name="description" required>
		</div>

		<div class="form-group">
			<select class="form-control" name="category_id">
				<option value selected disabled>Select Category</option>
				@foreach ($categories as $category)
					<option value="{{ $category->id }}">{{ $category->name }}</option>
				@endforeach
			</select>
		</div>

		<div class="form-group">
			<select class="form-control" name="status_id">
				<option value selected disabled>Select Status</option>
				@foreach ($statuses as $status)
					<option value="{{ $status->id }}">{{ $status->item_status }}</option>
				@endforeach
			</select>
		</div>

		<div class="form-group">
			<label>Quantity</label>
			<input type="number" class="form-control" name="quantity" value="1" min="1" required>
		</div>
		
		<div class="form-group">
			<label>Image</label>
			<input type="file" class="form-control" name="image" required>
		</div>

		<button type="submit" class="btn btn-success btn-block">Add</button>
		
	</form>

@endsection

@section('content')
	
	<div class="container-fluid">
		<div class="row">
			<div class="col-6 mx-auto">
				<h3 class="text-center">Add Item</h3>
				<div class="card">
					<div class="card-header">Item Information</div>
					<div class="card-body">
						@yield('add-item-form')
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection