@extends('layouts.userlayout')
@section('title')
Home
@endsection


@section('maincontent')
	@if(session()->has('firstname'))
		<h2>Welcome {{session('firstname')}}</h2>
	@endif
@endsection