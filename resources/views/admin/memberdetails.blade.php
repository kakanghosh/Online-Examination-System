
@extends('layouts.adminlayout')

@section('title')
Member List
@endsection

@section('style')
	<style type="text/css">
		table{
			border-collapse: collapse;
			width: 50%;
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

	<h2>Member List</h2> 
	<table>
		<tr>
			<th>Full Name</th>
			<th>User Name</th>
			<th>Email</th>
			<th>User Type</th>
			<th>Settings</th>
		</tr>
		@foreach($users as $user)
			@if($user->user_id != session('userid'))
				<tr> 
					<td>{{$user->first_name}} {{', '}} {{$user->last_name}}</td>
					<td>{{$user->user_name}}</td>
					<td>{{$user->email}}</td>
					<td>{{$user->user_type}}</td>
					<td><a href=" {{route('Admin.editMemberDetails',[$user->user_id])}} ">Edit</a></td>
				</tr>
			@endif
		<br>
	@endforeach
	</table>

@endsection