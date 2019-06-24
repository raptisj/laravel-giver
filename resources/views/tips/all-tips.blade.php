@extends('master')

@section('content')

@include('partials.nav')

<h2>Tips History</h2>

<ul>
	@foreach($history as $eachRound)
	<li>{{ $eachRound->id }}</li>
	@endforeach
</ul>


@include('partials.footer')

@endsection