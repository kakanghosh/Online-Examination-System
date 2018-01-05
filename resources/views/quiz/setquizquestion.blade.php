@extends('layouts.userlayout')
@section('title')
Quiz Maker | Create Quiz
@endsection

@section('style')
@endsection

@section('maincontent')

<!-- This will print Tempory Question serial ID !-->
{{-- @if(session()->has('question_temp_id'))
	{{ session('question_temp_id') }}
@endi --}}

	<div class="container-fluid"> {{-- Container Div starts here --}}
		<div class="row"> {{-- Row Div starts here --}}
			<div class="col-lg-6" style="padding: 15px;">
				{{-- This will print the Quiz Title --}}
				@if(session()->has('quiztitle'))
					<div class="text-warning">
						<h2>Quiz Title: {{session('quiztitle')}}</h2>
					</div>
				@endif

				{{-- If Question is Multiple Choice then option must --}}
				@if(session()->has('MC'))
					<div class="alert alert-danger alert-dismissable">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						{{session('MC')}}
					</div>
				@endif

				{{-- If Question is True / False then option must be true false type --}}
				@if(session()->has('TF'))
					<div class="alert alert-danger alert-dismissable">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						{{session('TF')}}
					</div>
				@endif

				{{-- This will print is the field is not filled  --}}
				@if($errors->has('qsn'))
					<div class="alert alert-danger alert-dismissable">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						{{$errors->first('qsn')}}
					</div>
				@endif

				@if($errors->has('opt.*'))
					<div class="alert alert-danger alert-dismissable">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						{{$errors->first('opt.*')}}
					</div>	
				@endif

				@if($errors->has('correct_ans'))
					<div class="alert alert-danger alert-dismissable">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						{{$errors->first('correct_ans')}}
					</div>	
				@endif

				<form method="post"> {{-- Form starts here --}}
					{{csrf_field()}}
					<div class="form-group">
						<label for="">Choose Question Type</label>
						<select name="option_type" class="btn btn-primary" id="option_type"
							style="margin-right: 50px;">
							<option value="MC">Multiple Choice</option>
							<option value="TF">True/False</option>
						</select>
						<label>Difficulty Level</label>
						<select class="btn btn-primary" name="difficulty_level" id="difficulty_level">
							<option value="1">Easy</option>
							<option value="2">Medium</option>
							<option value="3">Hard</option>
						</select>
					</div>
					<div class="form-group">
						<label for="qsn">Question</label>
						<input type="text" name="qsn" class="form-control" id="qsn" placeholder="Type Your Question">
					</div>
					<div class="form-group">
						<span class="btn btn-primary" id="add_option" style="cursor:pointer;">
							Add Option
						</span>
						<div id="option"></div>
						{{-- <div id="correct_div"></div> --}}
					</div>
					<div class="form-group">
						<label for="correct" style="cursor:pointer;">Set Correct Answer</label>	
						<span id="correct_ans_span"><input style="width: 50%;" class="form-control" type='text' name = 'correct_ans' id = 'correct' placeholder="Type Correct Answer"> </span>
					</div>

					<div class="form-group">
						<input type="submit" class="btn btn-primary" name="submit" value="Save Question"> 
						<a id="finishquizset" class="btn btn-success" href=""> Finish Creating Quiz</a>
						<input type="hidden" id = "finishquizlink" value="{{route('Quiz.finishCreatingQuiz')}}">
						<input type="hidden" id = "numberofqsn" value="{{sizeof(session('questionset'))}}">

						<a class="btn btn-danger" href="{{route('Quiz.cancelQuizQuestion')}}"> Cancel Quiz</a>
					</div>
				</form>	{{-- Form ends here --}}
			</div>
			
			<div class="col-lg-6 show-question-div" style="border-left: 1px solid #eee; padding: 15px;">
				<!-- This will Print every question !-->
				@if(session()->has('questionset'))
					<label class="text-info" style="font-size: 20px;">
						List Of Questions (<span id="questionNumber">{{sizeof(session('questionset'))}}</span>)
					</label>
					<hr>
					<div class="all-question">
					@foreach(session('questionset') as $question)
							<div class="form-group">
								<h2>
									<span class="text-danger">Question:</span> <br>  
									{{$question->getQuestion()}} 
								</h2> 
								<a href="{{route( 'Quiz.deleteQuestion',[$question->getQuestionTempID()])}}"> 		Delete
								</a>
							</div>
					@endforeach
					</div>
				@endif
			</div>


		</div>  {{-- Row Div ends here --}}
	</div> {{-- Container Div ends here --}}

		
@endsection

@section('script')
	<script type="text/javascript" src="{{asset('js')}}/myjquery.js"></script>
	<script type="text/javascript" src="{{asset('js/myjs')}}/setquestion.script.js"></script>
@endsection

