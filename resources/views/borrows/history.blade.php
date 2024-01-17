@extends('layouts.app')

@section('title', 'History')

@section('history')

	@foreach ($wagons as $wagon)

		<div class="card mb-2">
			
			<div class="card-header">
				
				<a href='#collapse-{{ $wagon["id"] }}' class="card-link" data-toggle="collapse">
					{{ $wagon->date_returned }} {{ $wagon->date_denied }} {{ $wagon->action->action }} 
				</a>

			</div>

		</div>

		<div class="collapse" id='collapse-{{ $wagon["id"] }}' data-parent="#accordion">
			
			<div class="card-body">
				
				<table class="table table-bordered">
					
					<thead>
						
						<tr>
							
							@if (is_null($wagon->date_approved))
								<th>Date Borrowed</th>
							@else
								<th>Date Approved</th>
							@endif							
							@if (is_null($wagon->date_denied))		
								<th>Date Returned</th>	
							@else
								<th>Date Denied</th>
							@endif	
							<th>Item Name</th>		
							<th>Category</th>			
							<th>Action</th>		

						</tr>	

						<tbody>

								<tr>
									@if (is_null($wagon->date_approved))
										<td>{{ $wagon->date_borrowed }}</td>
									@else
										<td>{{ $wagon->date_approved }}</td>
									@endif
									@if (is_null($wagon->date_denied))
										<td>{{ $wagon->date_returned }}</td>
									@else
										<td>{{ $wagon->date_denied }}</td>
									@endif
									<td>{{ $wagon->item->name}}</td>
									<td>{{ $wagon->category->name }}</td>
									<td>{{ $wagon->action->action }}</td>

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
		
		<h3>History</h3>

		<div id="accordion">
			
			@yield('history')

		</div>

	</div>

@endsection
