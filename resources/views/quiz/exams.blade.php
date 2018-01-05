
@extends('layouts.userlayout')
@section('title')
Quiz Maker | Quizes
@endsection

@section('style')
	
@endsection

@section('maincontent')
	
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-2"></div>
			<div class="col-lg-8">
				@if(sizeof($exams) != 0)
					<table class="table-bordered table-condensed table-hover table-striped">
						<tr>
							<th>Quiz Title</th>
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
								<a class="btn  btn-primary" href="{{route('Quiz.startExam',[str_replace(' ', '_', $data[0]),$examid]) }}">Start Exam</a> 
								<input type="hidden"   class="{{$examid}}" value="{{route('Quiz.startExam',[str_replace(' ', '_', $data[0]),$examid]) }}" />

								<button class="btn btn-default copy" value="{{$examid}}" >Copy Link</button>
							</td>
							<td>
								<a class="btn btn-info" href="{{route('QuizController.showResultHistory',[$data[0],$examid])}}">Show Results</a>
							</td>

							<td>
								<select class="btn btn-default status">
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
					<div class="alert alert-danger">
						{{'No Quiz created!'}}
						<a href="{{route('Quiz.createQuestion')}}">create Quiz Now</a>
					</div>
				@endif
			</div>
			<div class="col-lg-2"></div>
		</div>
	</div>


@endsection

@section('script')
	<script type="text/javascript" src="{{asset('js')}}/copylink.js"></script>
	<script type="text/javascript" src="{{asset('js')}}/manage_question_status.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#allexams').attr('class','active');
		});
	</script>
@endsection