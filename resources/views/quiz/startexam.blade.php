
@extends('layouts.userlayout')

@section('title')
@if(session()->has('examtitle'))
	Quiz Maker | {{session('examtitle')}}
@endif
@endsection

@section('maincontent')
	<h2>Quiz Title: <span style="font-size: 20px;color: blue;">{{$examtitle}}</span></h2>
	<form method="post">
		{{ csrf_field() }}
	@php
		session(['allquestions'=> $questions]);
			$count = 1;
	@endphp
	@foreach ($questions as $question) 
		Question {{$count}}: {{ $question->getQuestion() }}
			<br>
			@foreach($question->getOptionList() as $opt)
				<input type="radio" name="{{ $question->getQuestionID() }}"  value="{{ $opt }}"> {{ $opt }}
				<br>
			@endforeach
			@php
				$count += 1;
			@endphp
		<br>
		<hr>
	@endforeach
	<input type="submit" name="submit" value="Finish Quiz">
	</form>
	
@endsection