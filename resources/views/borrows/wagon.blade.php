@extends('layouts.app')

@section('title', 'Request Wagon')

@section('request-wagon')

	<form action="{{ url('wagon/store') }}" method="post" enctype="multipart/form-data">

		@csrf

		<input type="integer" value="{{ $item->id }}" name="itemId" hidden>

		<div class="form-group">
			<label>Student Name</label>
			<input type="text" class="form-control" value="{{ $user->name }}" readonly>
		</div>

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

		<div class="form-group">
			<label>Quantity</label>
			<input type="number" class="form-control" name="quantity" value="1" min="1" max="{{ $item->quantity }}" required>
		</div>

		<button type="submit" class="btn btn-success btn-block">Request</button>
			
	</form>

@endsection

@section('content')
	
	<div class="container-fluid">
		<div class="row">
			<div class="col-6 mx-auto">
				<h3 class="text-center">Request Item</h3>
				<div class="card">
					<div class="card-header">Item Information</div>
					<div class="card-body">
						@yield('request-wagon')
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection

@if (!empty(session()->get('message')))
	<script>alert('{{ session()->get("message") }}')</script>
@endif