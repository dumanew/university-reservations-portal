@if (Auth::user()->user_role != 'admin')
	<script>window.location = '/menu'</script>
@endif

@extends('layouts.app')

@section('title', 'Approved Requests')

@section('approved-form')

	@foreach ($wagons as $wagon)

		<div class="card mb-2">
			
			<div class="card-header">

				<a href='#collapse-{{ $wagon["id"] }}' class="card-link" data-toggle="collapse">
					{{ $wagon->date_approved }} {{ $wagon->user->name }}
				</a>

			</div>

		</div>

		<div class="collapse" id='collapse-{{ $wagon["id"] }}' data-parent="#accordion">
			
			<div class="card-body">
				
				<table class="table table-bordered">
					
					<thead>
						
						<tr>
							
							<th>Student Name</th>
							<th>Date Borrowed</th>
							<th>Item Name</th>		
							<th>Category</th>		
							<th>Status</th>		
							<th>Action</th>		

						</tr>	

						<tbody>

							<tr>
								
								<td class="text-center">{{ $wagon->user->name}}</td>
								<td class="text-center">{{ $wagon->date_borrowed }}</td>
								<td class="text-center">{{ $wagon->item->name}}</td>
								<td class="text-center">{{ $wagon->category->name }}</td>
								<td class="text-center">{{ $wagon->status->item_status }}</td>
								<td class="text-center">

									{{ $wagon->action->action }}
			
									<div class="btn-group btn-block text-center">

										<form action='{{ url("approved/$wagon->id/return") }}' method="post" enctype="multipart/form-data">
											@csrf

											@method("PUT")
											<input type="hidden" value="{{$wagon->item_id}}" name="itemId">

											<button class="btn btn-success">Return</button>
										</form>

									</div>

								</td>

							</tr>	

						</tbody>					

					</thead>

				</table>

			</div>

		</div>

	@endforeach

@endsection

@section('content')

	<div class="container-fluid">

		<h3>Approved Requests</h3>

		<div id="accordion">
			
			@yield('approved-form')

		</div>

	</div>

@endsection