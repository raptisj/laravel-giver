@extends('master')

@section('content')

@include('partials.nav')

<h2>Tips History</h2>

<ul>
	@foreach($history as $eachRound)
	<li>{{ $eachRound->id }}</li>
	<li>{{ $eachRound->days_total }}</li>
	@endforeach

{{-- 	@isset($historyTips)
	@foreach($historyTips->tipsRound as $someTip)
	<li>{{ $someTip->days_total }}</li>
	@endforeach
	@endisset --}}
</ul>

@include('partials.footer')

@endsection