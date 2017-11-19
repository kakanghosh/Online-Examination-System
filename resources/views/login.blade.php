<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Login Here</title>
	<link rel="stylesheet" type="text/css" href="{{asset('css')}}/app.css">
	<style type="text/css">
		body{
			background-color: white;
		}
	</style>
</head>
<body>
	<h3>Login</h3>
	<h2>
		@if(session()->has('registrationsucess'))
			{{session('registrationsucess')}}
		@endif
	</h2>
	<form method="post">
		{{csrf_field()}}
		<table>
			<tr>
				<td>User Name</td>
				<td> <input type="text" name="username" /> </td>
			</tr>
			<tr>
				<td>Password</td>
				<td> <input type="password" name="password" /> </td>
			</tr>
			<tr> 
			<td><input type="submit" name="login" value="Login"></td>
			<td><a href="{{route('Login.registerView')}}">Create Account</a></td>
			</tr>
		</table>
	</form>
	@if ($errors->any())
		@foreach ($errors->all() as $message)
			{{$message}}
			<br/>
		@endforeach
	@endif
	<h2>{{session('loginError')}}</h2>
</body>
</html>