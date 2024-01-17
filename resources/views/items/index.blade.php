@extends('layouts.app')

@section('title', 'Menu')

@section('content')

	<div class="container-fluid">
		<h3 class="text-center">Menu</h3>

		@if (!empty(Auth::user()) && Auth::user()->user_role == 'admin')
			<a href="{{ url('items/create') }}" class="btn btn-primary d-block">Add Item</a>
		@endif

		<div class="row">
			
			@foreach ($items as $item)

				<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 mt-3 h-100">

					<div class="card-group h-100">

						<div class="card h-100 my-auto mx-auto">

							<img src='{{ asset("storage/$item->image_location") }}' class="card-img-top" width="100%" height="300px">

							<div class="card-body flex-column h-100">

								<h4 class="card-title text-monospace text-uppercase text-center mx-auto h-100 flex-grow-1 text-truncate">{{ $item->name }}</h4>

								<p class="card-text">{{ $item->category->name }}</p> 

								<p class="card-text">{{ $item->status->item_status }} | Quantity: {{ $item->quantity }}</p>
								<p class="card-text"></p>

								<p class="card-text">{{ $item->description }}</p>

							</div>

							<div class="card-footer h-100">								

								@if (!empty(Auth::user()))

									@if (Auth::user()->user_role == "admin")

										<div class="btn-group btn-block">
											
											<a href='{{ url("items/$item->id/edit") }}' class="btn btn-info">Edit</a>
											<a href='{{ url("items/$item->id/delete-confirm") }}' class="btn btn-danger">Delete</a>										

										</div>

									@elseif (Auth::user()->user_role == "student")

										@if ($item->quantity == '0' || $item->status_id == '2' || $item->status_id == '3')

											<form class="btn-block btn-group" data-id="{{ $item->id }}">
												<a href='{{ url("wagon/$item->id") }}' class="btn btn-success disabled">Request</a>
											</form>

										@else

											<form class="btn-block btn-group" data-id="{{ $item->id }}">
												<a href='{{ url("wagon/$item->id") }}' class="btn btn-success">Request</a>
											</form>

										@endif

									@endif

								@endif

							</div>

						</div>

					</div>

				</div>

			@endforeach

		</div>

	</div>

@endsection

@if (!empty(session()->get('message')))
	<script>alert('{{ session()->get("message") }}')</script>
@endif