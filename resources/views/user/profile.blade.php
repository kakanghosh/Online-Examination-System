@extends('layouts.userlayout')
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
				@if( $member->gender == 'Male')
					<img src="{{asset('profile_pic')}}/male.jpg" width="150" height="150">
				@elseif($member->gender == 'Female')
					<img src="{{asset('profile_pic')}}/female.jpg" width="150" height="150">	
				@endif	 
			</td>
		</tr>
		<tr> 
			<td>Name </td> 
			<td>
				{{ $member->first_name }}, {{ $member->last_name }}
			</td>
		</tr>
		<tr>
			<td>User Name </td>
			<td>{{ $member->user_name }}</td>
		</tr>
		<tr>
			<td>Gender </td> 
			<td>{{ $member->gender }}</td> 
		</tr>
		<tr>
			<td>Date Of Birth </td> 
			<td>{{ $member->dob }}</td> 
		</tr>
		<tr>
			<td>Email </td> 
			<td>{{ $member->email }}</td> 
		</tr>
		<tr >
			<td colspan="2">
				<a href="{{route('User.changePassword')}}">Change Password</a>
			</td>
		</tr>
		
	</table>	
@endsection

@section('script')
	<script type="text/javascript" src="{{ asset('js') }}/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="{{ asset('js') }}/userprofile.js"></script>
@endsection 