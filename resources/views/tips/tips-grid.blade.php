@extends('master')

@section('content')

@include('partials.nav')

<div class="container">
	<div class="row">
		<div class="col m6">
			<div class="total-tips">
				<h4>Total Tips</h4> 
				@if (session('key'))
				<h5 class="blue-text text-darken-2">{{ session('key') }}$</h5>
				@endif	
			</div>
			<form method="POST" action="{{ url('total-tips')}}">
				{{csrf_field()}}
				<input type="number" name="total_tips" required />
				<button type="submit" class="waves-effect waves-light btn z-depth-3">Add Tips</button>
			</form>
		</div>
		<div class="col m6">
			<div class="summed-hours">
				<h4>Summed Hours</h4>
				@isset($summedHours)
				<h5 class="blue-text text-darken-2">{{ $summedHours }}</h5>
				@endisset
			</div>
		</div> 
	</div>

	<div class="row">
		<div class="col s12 m8 offset-l2 l6 offset-l3">
			<div class="add-user">
				<h3>Add Users</h3>
				<p>If you wanna get the 'green', double check the hours.</p>
				<form action="/tips" method="POST">
					{{csrf_field()}}
					<div class="input-field">
						<label for="name">Add User</label>
						<input type="text" id="name" name="name" />
					</div>
					<div class="input-field">
						<label for="hours">Add Hours</label>
						<input type="number" id="hours" name="hours" />
					</div>
					<button type="submit" class="btn-floating btn-large waves-effect waves-light red z-depth-3"><i class="material-icons">add</i></button>
				</form>
			</div>
		</div>
	</div>

	@if (session('success'))
	<div class="alert-msg alert-msg-green z-depth-3">
		<p>{{ session('success') }}</p>
	</div>
	@elseif(session('deleted'))
	<div class="alert-msg alert-msg-red z-depth-3">
		<p>{{ session('deleted') }}</p>
	</div>
	@endif

	<div class="row">
		@if(count($person) > 0)
		@foreach($person as $person)
		<div class="col s12 m4">
			<div class="card blue-grey z-depth-3">
				<div class="card-content white-text">
					<span class="card-title">{{ $person->name }}</span>
					<p>Hours: {{ $person->hours }}</p>
					<p>Ammount: {{ $person->ammount }}$</p>
				</div>
				<div class="card-action">
					<form action="/tips/{{ $person->id }}" method="POST">
						{{ method_field('DELETE') }}
						{{ csrf_field() }}
						<button type="submit" class="btn-floating btn-medium waves-effect waves-light"><i class="material-icons">clear</i></button>
					</form>
				</div>
			</div>
		</div>
		@endforeach
		@endif
	</div>
</div>


@include('partials.footer')

@endsection
