@extends('layouts.userlayout')
@section('title')
Change password
@endsection


@section('maincontent')
	<form method="post">
		{{csrf_field()}}
		Old Passowrd <input type="password" name="oldpassword"> 
		@if($errors->has('oldpassword'))
			{{'Enter valid password'}}
		@endif
		<br><br>
		New Password <input type="password" name="password">
		@if($errors->has('password'))
			{{'Password not match or Invalid'}}
		@endif
		<br><br>
		Confirm Password <input type="password" name="repassword"><br>
		<input type="submit" name="submit" value="confirm">
		<a href="{{route('Admin.showprofile')}}">Cancel</a>
	</form>
@endsection