<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>@yield('title')</title>
	<script type="text/javascript" src="{{asset('js')}}/jquery-3.2.1.min.js"></script>
	<link rel="stylesheet" type="text/css" href="{{asset('css')}}/app.css">
	<style type="text/css">
		body{
			background-color: white;
		}
		ul li{
			display: inline;
			padding: 5px;
		}
	</style>
	@yield('style')
</head>
<body>
	
	<ul>
		<li><a href="{{route('Admin.index')}}">Home</a></li>
		<li><a href="{{route('Admin.memberDetails')}}">Member List</a></li>
		<li><a href="{{ route('Admin.showprofile') }}">Profile</a></li>
		<li><a href="{{route('Admin.logout')}}">Logout</a></li>
	</ul>
	<div class="container">
		@yield('maincontent')
	</div>
	@yield('script')
</body>
</html>