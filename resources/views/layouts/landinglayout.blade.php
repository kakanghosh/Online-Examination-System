<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>@yield('title')</title>
	<link rel="stylesheet" type="text/css" href="{{asset('css')}}/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="{{asset('css')}}/bootstrap-theme.min.css">
	<link rel="shortcut icon" href="{{asset('')}}/logo.ico" type="image/x-icon">
	<style type="text/css">
		ul li{
			padding: 5px;
		}
	</style>
	@yield('style')
</head>
<body>

	<nav class="navbar navbar-default" style="border-radius: 0px;">
		<div class="container-fluid">
			<div class="navbar-header">
     			 <a class="navbar-brand" href="{{route('ladingpage')}}">Quiz Maker</a>
   		 	</div>
			<ul class="navbar navbar-nav navbar-right" style="list-style-type: none; padding: 10px;">
				<li>
					<a href="{{route('Login.loginView')}}">
						<span class="glyphicon glyphicon-log-in"></span>		
					 	 Login 
					</a>
				</li>

				<li>
					<a href="{{route('Login.registerView')}}">
						<span class="glyphicon glyphicon-user"></span>
						 Sign Up 
					</a>
				</li>		
			</ul>
		</div>
	</nav>
	@yield('maincontent')
	@yield('script')
</body>
</html>