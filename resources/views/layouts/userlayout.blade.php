<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>@yield('title')</title>
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
		<li><a href="{{route('User.index')}}">Home</a></li>
		<li><a href="{{route('User.showProfile')}}">Profile</a></li>
		<li><a href="{{route('Quiz.createQuestion')}}">Create Question</a></li>
		<li><a href="{{route('Quiz.showAllExams')}}">All Exams</a></li>
		<li><a href="{{route('User.logout')}}">Logout</a></li>
	</ul>
	<div>
		@yield('maincontent')
	</div>

	@yield('script')
</body>
</html>