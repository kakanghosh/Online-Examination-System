@extends('layouts.userlayout')
@section('title')
Quiz Maker | Profile
@endsection

@section('style')
	<link rel="stylesheet" type="text/css" href="{{asset('css/mycss')}}/userprofile.style.css">
@endsection

@section('maincontent')


	<div class="container">
		<div class="row">
			<div class="col-lg-2 col-md-2 text-center">
				@if( $member->gender == 'Male')
					<img src="{{asset('profile_pic')}}/male.jpg" width="150" height="150">
				@elseif($member->gender == 'Female')
					<img src="{{asset('profile_pic')}}/female.jpg" width="150" height="150">	
				@endif
				<form>
					<button class="btn btn-block bg-primary text-center">Change Picture</button>
				</form>
			</div>

			<div class="col-lg-6 col-md-10 font-size-2">
				@if(session()->has('changepassword'))
					<div class="alert alert-success alert-dismissable">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						{{session('changepassword')}}
					</div>
				@endif
				<p>
					<hr><span class="text-primary">Name: </span> 
					{{ $member->first_name }} {{ $member->last_name }}<hr>
				</p>
				<p>
					<span class="text-primary">User Name: </span>
					{{ $member->user_name }}<hr>
				</p>
				<p>
					<span class="text-primary">Gender: </span>
					{{ $member->gender }}<hr>
				</p>
				<p>
					<span class="text-primary">Birth Of Date: </span>
				    {{ $member->dob }}<hr>
				</p>
				<p>
					<span class="text-primary">Email:  </span>
					{{ $member->email }}<hr>
				</p>
				<p>
					<a href="{{route('User.changePassword')}}" class="font-size-3 text-info">Change Password</a><hr>
				</p>
			</div>
		</div>
	</div>
	
@endsection

@section('script')
	<script type="text/javascript">
		$(document).ready(function(){
			$('#profile').attr('class','active');
		});
	</script>
@endsection