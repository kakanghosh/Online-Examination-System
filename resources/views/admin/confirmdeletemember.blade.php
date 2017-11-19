@extends('layouts.adminlayout')
@section('title')
Confirm Delete
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

		a{
			text-decoration: none;
		}

	</style>
@endsection

@section('maincontent')
	<table>
		<tr>
			<td>User ID</td>
			<td>{{$user->user_id}}</td>
		</tr>
		<tr>
			<td>Name</td>
			<td>{{$user->first_name}}, {{$user->last_name}}</td>
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
			<td>User Type</td>
			<td>{{$user->user_type}}</td>
		</tr>
		<tr>
			<td><button><a href="{{route('Admin.confirmDeleteMember',$user->user_id)}}">Confirm Delete</a></button></td>
			<td><button><a href="{{route('Admin.memberDetails')}}">Cancel</a></button></td>
		</tr>
	</table>
@endsection