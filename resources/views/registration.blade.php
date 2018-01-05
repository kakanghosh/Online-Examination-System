@extends('layouts.landinglayout')
@section('title')
Quiz Maker | Sign Up
@endsection
@section('style')
	<link rel="stylesheet" type="text/css" href="{{asset('js/date')}}/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="{{asset('js/date')}}/jquery-ui.structure.css">
	<link rel="stylesheet" type="text/css" href="{{asset('js/date')}}/jquery-ui.theme.css">
	<link rel="stylesheet" type="text/css" href="{{asset('css/mycss')}}/registration.style.css">
@endsection

@section('maincontent')
	
	{{-- This is main container div --}}
	<div class="container"> 
		{{-- This is row div --}}
		<div class="row">
			<div class="col-lg-3"></div>
			{{-- This is column div --}}
			<div class="col-lg-7">
				{{-- This is registration div --}}
				<div class="registration-div">
					{{-- This is registration form --}}
					<form method="post">

						{{csrf_field()}}
						<div class="form-group">

							<label for="firstname">First Name</label>
							@if($errors->has('firstname'))
								<p class="alert alert-danger">{{'First Name is required'}}</p>
							@endif
							<input type="text" id="firstname" class="form-control" name="firstname" value="{{session('firstname')}}" placeholder="First Name"> 
						</div>
						<div class="form-group">
							<label for="lastname">Last Name</label>
							@if($errors->has('lastname'))
								<p class="alert alert-danger">{{'Last Name is required'}}</p>
							@endif
							<input type="text" id="lastname" class="form-control" name="lastname" value="{{session('lastname')}}" placeholder="Last Name">
						</div>

						<div class="form-group">
							<label for="username">User Name</label>
							@if($errors->has('username'))
								<p class="alert alert-danger">{{'User Name is Invalid'}}</p>
							@endif
							<input type="text" id="username" class="form-control" name="username" value="{{session('username')}}" placeholder="User Name">							
						</div>

						<div class="form-group">
							<label for="gender">Gender</label>
							@if($errors->has('gender'))
								<p class="alert alert-danger">{{'Gender is Required'}}</p>
							@endif
							@if(session('gender') == 'Male')
								<input type="radio" name="gender"  value="Male" checked> Male
								<input type="radio" name="gender" value="Female"> Female
							@elseif(session('gender') == 'Female')
								<input type="radio" name="gender"  value="Male" > Male
								<input type="radio" name="gender" value="Female" checked> Female
							@else
								<input type="radio" name="gender"  value="Male" > Male
								<input type="radio" name="gender" value="Female"> Female
							@endif
						</div>

						<div class="form-group">
							<label for="datepicker">Date Of Birth</label>
							@if($errors->has('dob'))
								<p class="alert alert-danger">{{'Date Of Birth is required'}}</p>
							@endif
							<input type="text" name="dob" id="datepicker" class="form-control" value="{{session('dob')}}" placeholder="Choose Date Of Birth">
						</div>

						<div class="form-group">
							<label for="email">Email</label>
							@if($errors->has('email'))
								<p class="alert alert-danger">{{'Valid email  is required'}}</p>
							@endif
							<input type="text" name="email" id="email" class="form-control" value="{{session('email')}}" placeholder="Email">
						</div>
						<div class="form-group">
							<label for="password">Password</label>
							@if($errors->has('password'))
								<p class="alert alert-danger">{{'Valid Password is required'}}</p>
							@endif
							<input type="password" id="password" class="form-control" name="password" placeholder="Password">
						</div>
						<div class="form-group">
							<label for="repassword">Re-Password</label>
							<input type="password" id="repassword" class="form-control" name="repassword" placeholder="Re-Password">
						</div>
						<div class="form-group">
							<input type="submit" class="btn btn-primary" name="register" value="Register">
							<a href="{{route('Login.loginView')}}">Goto Login</a>
						</div>
					</form> {{-- Registration form ends here --}}
				</div> {{-- Registration div ends here --}}
			</div> {{-- Column div ends here --}}
			<div class="col-lg-2"></div>
		</div> {{-- Row div ends here --}}
	</div> {{-- Main Cintainer div ends here --}}
@endsection

@section('script')
	{{-- This script will generate JQuery Date Picker --}}
	<script type="text/javascript" src="{{asset('js')}}/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="{{asset('js/date')}}/jquery-ui.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$( "#datepicker" ).datepicker();
		});
	</script>
@endsection
