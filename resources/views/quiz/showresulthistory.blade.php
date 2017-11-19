@extends('layouts.userlayout')
@section('title')
Result
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
	<h2>Quiz Title: <span style="font-size: 20px;color: blue;">{{$examtitle}}</span></h2>
	<table>
		<tr>
			<th>Name</th>
			<th>Result</th>
		</tr>
	@foreach($resultset as $result)
		<tr>
			<td>
				{{$result[0]}} 
			</td>
			<td>
				{{$result[1]}}%
			</td>
		</tr>
	@endforeach
	</table>
@endsection