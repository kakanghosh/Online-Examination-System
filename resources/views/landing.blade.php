<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title></title>
	<link rel="stylesheet" type="text/css" href="{{asset('css')}}/app.css">
	<style type="text/css">
		body{
			background-color: white;
		}
		td{
			padding: 10px;
		}
	</style>
</head>
<body>

	<table>
		<tr>
			<td> <a href="{{route('Login.loginView')}}"> Login </a> </td>
			<td> <a href="{{route('Login.registerView')}}"> Register </a></td>
		</tr>
	</table>
	<hr>
</body>
</html>