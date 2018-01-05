<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>@yield('title')</title>
	<link rel="stylesheet" type="text/css" href="{{asset('css')}}/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="{{asset('css')}}/bootstrap-theme.min.css">
	<link rel="shortcut icon" href="{{asset('')}}/logo.ico" type="image/x-icon">
	@yield('style')
</head>
<body>
	
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<nav class="navbar navbar-default row" style="border-radius: 0px;">
					<div class="container">
						<div class="navbar-header">
			     			 <a class="navbar-brand" href="{{route('ladingpage')}}">Quiz Maker</a>
			   		 	</div>
						<ul class="nav navbar-nav">
							<li id="home"><a href="{{route('User.index')}}">Home</a></li>
							<li id="profile"><a href="{{route('User.showProfile')}}">Profile</a></li>
							<li id="createquestion"><a href="{{route('Quiz.createQuestion')}}">Create Question</a></li>
							<li id="allexams"><a href="{{route('Quiz.showAllExams')}}">All Exams</a></li>
						</ul>
						<ul class="nav navbar-nav navbar-right">
							<li><img width="40" height="40" alt="Brand" src="{{asset('profile_pic')}}/male.jpg"></li>
							<li> <a href="{{route('User.logout')}}"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
						</ul>
					</div>
				</nav>
			</div>
		</div>
	</div>

	<div>
		@yield('maincontent')
	</div>
	{{-- Scripts are added here --}}
	<script type="text/javascript" src="{{asset('js')}}/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="{{asset('js')}}/bootstrap.min.js"></script>
	@yield('script')
</body>
</html>