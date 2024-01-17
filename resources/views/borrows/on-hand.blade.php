@extends('layouts.app')

@section('title', 'Wagon')

@section('on-hand')

	@foreach ($wagons as $wagon)

		@if ($wagon->user_id == Auth::user()->id)

			<div class="card mb-2">
				
				<div class="card-header">
					
					<a href='#collapse-{{ $wagon["id"] }}' class="card-link" data-toggle="collapse">
						{{ $wagon->date_borrowed }}
					</a>

				</div>

			</div>

			<div class="collapse" id='collapse-{{ $wagon["id"] }}' data-parent="#accordion">
				
				<div class="card-body">
					
					<table class="table table-bordered">
						
						<thead>
							
							<tr>
								
								<th>Item Name</th>		
								<th>Category</th>		
								<th>Quantity</th>		
								<th>Status</th>		
								<th>Action</th>		

							</tr>	

							<tbody>

									<tr>
										
										<td>{{ $wagon->item->name}}</td>
										<td>{{ $wagon->category->name }}</td>
										<td>{{ $wagon->quantity }}</td>
										<td>{{ $wagon->status->item_status }}</td>
										<td>{{ $wagon->action->action }}</td>

									</tr>	

							</tbody>					

						</thead>

					</table>

				</div>

			</div>

		@elseif (is_null($wagon->user_id))
			<div>
				<p>No items in the wagon.</p>
			</div>
		@endif

	@endforeach

@endsection

@section('content')

	<div class="container-fluid">
		
		<h3>Wagon</h3>

		<div id="accordion">
			
			@yield('on-hand')

		</div>

	</div>

@endsection
