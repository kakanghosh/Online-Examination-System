@extends('layouts.landinglayout')

@section('title')
Quiz Maker | Login
@endsection

@section('style')
	<link rel="stylesheet" type="text/css" href="{{asset('css/mycss')}}/login.style.css">
@endsection

@section('maincontent')
{{--  Container starts here --}}
	<div class="container"> 
		{{-- Row starts here --}}
		<div class="row"> 
			<div class="col-lg-3"></div>
			{{-- Column starts here --}}
			<div class="col-lg-6">
				{{-- This message will brings up when a new user register --}}	
				
				@if(session()->has('registrationsucess'))
					<span class="alert alert-success">{{session('registrationsucess')}}</span>
				@endif
				 
				{{-- This Form is for login --}}
				<div class="login-form-div">
					<h3 style="margin-left: 15px;">
						Login
						{{-- This is will show login error message --}}
					</h3>
					<form method="post" class="login-form">
						@if($errors->has('username') || $errors->has('password') || session()->has('loginError'))
							<div class="alert alert-danger">{{'Username or Password Is Invalid'}}</div>
						@endif
						{{csrf_field()}}
						
						<div class="form-group">
							<label for="username">UserName</label>
							<input type="text" id="username" class="form-control" name="username" placeholder="Username" />
						</div>
						<div class="form-group">
							<label for="password">Password</label>
							<input type="password" id="password" class="form-control"  name="password" placeholder="Password" />
						</div>
						<div class="checkbox form-group">
							<label><input type="checkbox" name="remindme"> Remember Me</label>
						</div>
						<div class="form-group simple-padding">
							<input type="submit" class="btn btn-success" name="login" value="Login">
							<a href="{{route('Login.registerView')}}"> Create New Account</a>
						</div>
						
					</form> {{-- Login Form ends here --}}

				</div> {{-- Login Form div ends here --}}
			</div> {{-- Column ends here --}}
			<div class="col-lg-3"></div>
		</div> {{-- Row ends here --}}
	</div> {{-- Container ends here --}}
@endsection