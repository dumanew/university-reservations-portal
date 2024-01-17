@if (Auth::user()->user_role != 'admin')
	<script>window.location = '/menu'</script>
@endif

@extends('layouts.app')

@section('title', 'Edit Item')

@section('edit-item-form')

	<form action='{{ url("items/$item->id") }}' method="post" enctype="multipart/form-data">
		
		@csrf

		@method("PUT")

		<div class="form-group">
			<label>Item Name</label>
			<input type="text" class="form-control" value="{{ $item->name }}" name="name" required>
		</div>

		<div class="form-group">
			<label>Description</label>
			<input type="text" class="form-control" value="{{ $item->description }}" name="description" required>
		</div>

		<div class="form-group">
			<label>Category</label>
			<select name="category_id" class="form-control">
				<option value selected disabled>Select Category</option>

				@foreach ($categories as $category)
					@if ($category->id == $item->category_id)
						<option value="{{ $category->id }}" selected>{{ $category->name }}</option>
					@else
						<option value="{{ $category->id }}">{{ $category->name }}</option>
					@endif
				@endforeach
			</select>
		</div>

		<div class="form-group">
			<label>Status</label>
			<select name="status_id" class="form-control">
				<option value selected disabled>Select Status</option>

				@foreach ($statuses as $status)
					@if ($status->id == $item->status_id)
						<option value="{{ $status->id }}" selected>{{ $status->item_status }}</option>
					@else
						<option value="{{ $status->id }}">{{ $status->item_status }}</option>
					@endif
				@endforeach
			</select>
		</div>

		<div class="form-group">
			<label>Image</label>
			<input type="file" class="form-control" name="image">
		</div>

		<button type="submit" class="btn btn-success btn-block">Save</button>

	</form>

@endsection

@section('content')
	
	<div class="container-fluid">
		<div class="row">
			<div class="col-6 mx-auto">
				<h3 class="text-center">Edit Item</h3>
				<div class="card">
					<div class="card-header">Item Information</div>
					<div class="card-body">
						@yield('edit-item-form')
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection