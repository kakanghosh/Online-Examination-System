@extends('layouts.userlayout')
@section('title')
Create Question
@endsection

@section('maincontent')

@if(session()->has('quiztitle'))
	Quiz Title: {{session('quiztitle')}}<br/>
@endif



<!-- This will print Tempory Question serial ID !-->
@if(session()->has('question_temp_id'))
	{{-- {{ session('question_temp_id') }} --}}
@endif

<form method="post">
	{{csrf_field()}}
		<div id="question">
			<p>
				Choose Question Type  
				<select name="option_type" id="option_type">
					<option value="MC">Multiple Choice</option>
					<option value="TF">True/False</option>
				</select> <br><br>
				Difficulty Level  
				<select name="difficulty_level" id="difficulty_level">
					<option value="easy">Easy</option>
					<option value="medium">Medium</option>
					<option value="hard">Hard</option>
				</select>
				<br><br>
				Question <input type="text" name="qsn" id="qsn"><br/>
				<div id="option"></div>
				<span id="add_option" style="cursor:pointer;">Add Option</span><br/>
				<div id="correct_div"></div>
				<p>
					<span id="correct_answer" style="cursor:pointer;">Set Correct Answer</span>	
					<span id="correct_ans_span"><input type='text' name = 'correct_ans' id = 'correct' /> </span>
				</p>
			</p>
		</div>
		<input type="submit" name="submit" value="Save Question"> 
		<a href="{{route('Quiz.finishCreatingQuiz')}}"> Finish Quiz Set</a>
		<a href="{{route('Quiz.cancelQuizQuestion')}}"> Cancel Quiz</a>
	</form>

	<h4>

		<!-- This will Print every question !-->
		@if(session()->has('questionset'))
			List Of Questions: <br>
			@foreach(session('questionset') as $question)
				Question: {{$question->getQuestion()}}  
				<a href="{{route( 'Quiz.deleteQuestion',[$question->getQuestionTempID()])}}"> Delete </a>
				<br>
			@endforeach
		@endif


		@if(session()->has('MC'))
			{{session('MC')}}
		@endif

		@if(session()->has('TF'))
			{{session('TF')}}
		@endif

		@if(session()->has('error'))
			{{session('error')}}
			<br>
		@endif

		@for( $i = 0; $i < sizeof($errors->get('qsn')); $i++)
			{{$errors->get('qsn')[$i]}}
			<br>
		@endfor
		@for( $i = 0; $i < sizeof($errors->get('opt.*')); $i++)
			{{$errors->get('opt.'.$i)[0]}}
			<br>
		@endfor
		@for( $i = 0; $i < sizeof($errors->get('correct_ans')); $i++)
			{{$errors->get('correct_ans')[$i]}}
			<br>
		@endfor
	</h4>
@endsection

@section('script')
<script type="text/javascript" src="{{asset('js')}}/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="{{asset('js')}}/myjquery.js"></script>
@endsection
	