@extends('layouts.adminlayout')
@section('title')
Edit Member info
@endsection

@section('style')
	<style type="text/css">
		table{
			border-collapse: collapse;
		}
		th{
			color: red;
		}
		table, td, th {
    		border: 1px solid black;
    		text-align: left;
		}

	</style>
@endsection

@section('maincontent')
	<form method="post">
		{{csrf_field()}}
		<table>
			<tr>
				<td>user ID</td>
				<td>{{$user->user_id}}</td>
			</tr>
			<tr>
				<td>First Name</td>
				<td><input type="text" name="fname" value="{{$user->first_name}}"></td>
			</tr>
			<tr>
				<td>Last Name</td>
				<td><input type="text" name="lname" value="{{$user->last_name}}"></td>
			</tr>
			<tr>
				<td>User Name</td>
				<td>{{$user->user_name}}</td>
			</tr>
			<tr>
				<td>Email</td>
				<td>{{$user->email}}</td>
			</tr>
			<tr>
				<td>User type</td>
				<td>
					{{$user->user_type}}
					<select name="usertype" id="usertype">
						@if( $user->user_type == 'ADMIN')
				  			<option value="1" selected>Admin</option>
				  			<option value="2">Member</option>
				  		@elseif( $user->user_type == 'MEMBER')
				  			<option value="1">Admin</option>
				  			<option value="2" selected>Member</option>
				  		@endif
					</select>
				</td>
			</tr>
		</table>
		<br>
		<input type="submit" name="submit" value="update">
		<a href="{{route('Admin.deleteMember',[$user->user_id])}}">Delete</a>
	</form>
	
@endsection
