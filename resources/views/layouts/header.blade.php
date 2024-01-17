<nav class="navbar navbar-expand-lg navbar-dark bg-dark">

	<a href="{{ url('/menu') }}" class="navbar-brand">{{ config('app.name', 'University Reservations Portal') }}</a>

	<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbar">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse text-right" id="navbar">

		<ul class="navbar-nav ml-auto">
			
			@guest

				<li class="nav-item">
					<div class="text-white text-center nav-link" >Hello, Guest!</div>
				</li>

				<li class="nav-item">
					<a href="{{ url('/login') }}" class="nav-link">Login</a>
				</li>

			@else

				@if (!empty(Auth::user()))

					@if (Auth::user()->user_role == "admin")

						<li class="nav-item">
							<div class="text-white text-center nav-link">Hello, {{ Auth::user()->name }}!</div>
						</li>

						<li class="nav-item">
							<a href="{{ url('/action') }}" class="nav-link">Student Requests</a>
						</li>

						<li class="nav-item">
							<a href="{{ url('/approved') }}" class="nav-link">Approved Requests</a>
						</li>

						<li class="nav-item">
							<a href="{{ url('/transactions') }}" class="nav-link">Transactions</a>
						</li>

						<li class="nav-item">
							<a href="{{ url('/student-list') }}" class="nav-link">Student List</a>
						</li>

						<li class="nav-item">
							<a onclick="document.querySelector('#logout-form').submit()" href="#" class="nav-link">Logout</a>
						</li>

					@elseif (Auth::user()->user_role == "student")

						<li class="nav-item">
							<div class="text-white text-center nav-link">Hello, {{ Auth::user()->name }}!</div>
						</li>


						<li class="nav-item">
							<a href="{{ url('/on-hand/$wagon->id') }}" class="nav-link">On-Hand</a>
						</li>
						
						<li class="nav-item">
							<a href="{{ url('/history') }}" class="nav-link">History</a>
						</li>

						<li class="nav-item">
							<a onclick="document.querySelector('#logout-form').submit()" href="#" class="nav-link">Logout</a>
						</li>
					
					@endif

				@endif

			@endguest

		</ul>

	</div>

</nav>

<form action="{{ route('logout') }}" id="logout-form" class="d-none" method="POST">
	@csrf
</form>