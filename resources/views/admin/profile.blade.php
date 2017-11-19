@extends('layouts.adminlayout')
@section('title')
Profile
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

@if(session()->has('changepassword'))
		<h3>{{session('changepassword')}}</h3>
	@endif
	
	<table>
		<tr>
			<td colspan="2"> 
				@if( $admin->gender == 'Male')
					<img src="{{asset('profile_pic')}}/male.jpg" width="150" height="150">
				@elseif($admin->gender == 'Female')
					<img src="{{asset('profile_pic')}}/female.jpg" width="150" height="150">	
				@endif
			</td>
		</tr>
		<tr> 
			<td>Name </td> 
			<td>
				{{ $admin->first_name }}, {{ $admin->last_name }}
			</td>
		</tr>
		<tr>
			<td>User Name </td>
			<td>{{ $admin->user_name }}</td>
		</tr>
		<tr>
			<td>Gender </td> 
			<td>{{ $admin->gender }}</td> 
		</tr>
		<tr>
			<td>Date Of Birth </td> 
			<td>{{ $admin->dob }}</td> 
		</tr>
			<td>Email </td> 
			<td>{{ $admin->email }}</td> 
		</tr>
		<tr >
			<td colspan="2">
				<a href="{{route('Admin.changePassword')}}">Change Password</a>
			</td>
		</tr>
	</table>	
@endsection