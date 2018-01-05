@extends('layouts.userlayout')
@section('title')
Quiz Maker | Home
@endsection
@section('style')
	<link rel="stylesheet" type="text/css" href="{{asset('css/mycss')}}/userhome.style.css">
@endsection

@section('maincontent')
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-3"></div>
			<div class="col-lg-6" style="text-align: center;">
				@if(session()->has('firstname'))
					<div class="alert alert-success">
						<h3>
							Welcome! {{session('firstname')}}
						</h3>
					</div>
				@endif
			</div>
			<div class="col-lg-3"></div>
		</div>
	</div>
@endsection

@section('script')
	<script type="text/javascript">
		$(document).ready(function(){
			$('#home').attr('class','active');
		});
	</script>
@endsection