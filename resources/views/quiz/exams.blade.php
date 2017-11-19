
@extends('layouts.userlayout')
@section('title')
Exams
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
	ALL exams<br><br>
	@if(sizeof($exams) != 0)
	<table>
		<tr>
			<th>Quiz title</th>
			<th>Number of Question</th>
			<th>Option</th>
			<th>Result History</th>
			<th>Status</th>
		</tr>
		@foreach($exams as $examid => $data)
			<tr>
			<td>{{$data[0]}}</td>
			<td>{{$data[1]}}</td>
			<td>
				<a href="{{route('Quiz.startExam',[str_replace(' ', '_', $data[0]),$examid]) }}">Start Exam</a>
				<input type="text"   id="link" value="{{route('Quiz.startExam',[str_replace(' ', '_', $data[0]),$examid]) }}" /> 

				<button id="copy">Copy Link</button>
			</td>
			<td>
				<a href="{{route('QuizController.showResultHistory',[$data[0],$examid])}}">Show History</a>
			</td>

			<td>
				<select class="status">
					@if($data[2] == 1)
						<option value="active_{{$examid }}" selected>Active</option>
						<option value="deactive_{{$examid }}" >Deactive</option>
					@elseif($data[2] == 0)
						<option value="active_{{$examid }}">Active</option>
						<option value="deactive_{{$examid }}" selected>Deactive</option>
					@endif
				</select>
			</td>
		</tr>
		@endforeach
		
	</table>
	@else
		{{'No Question created!'}}<br>
		<a href="{{route('Quiz.createQuestion')}}">create Quiz Now</a>
	@endif
@endsection

@section('script')
<script type="text/javascript" src="{{asset('js')}}/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="{{asset('js')}}/copylink.js"></script>
<script type="text/javascript" src="{{asset('js')}}/manage_question_status.js"></script>
@endsection