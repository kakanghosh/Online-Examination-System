@extends('layouts.userlayout')
@section('title')
Result
@endsection

@section('maincontent')
	@if(session()->has('resultset'))
		@foreach(session('resultset') as $eachresultset)
			<span style="color: red; font-size: 20px;">Question: </span>{{ $eachresultset->getQuestion() }}<br>
			Your Answer: {{ $eachresultset->getAnswer() }}<br>
			Correct Answer: {{ $eachresultset->getCorrectAnswer() }}
			<br><br>
		@endforeach
	@endif

	@if(session()->has('result'))
		Total Question: {{ session('result')->getTotalQuestion() }} <br>
		Answered Question: {{ session('result')->getAnsweredQuestion() }} <br>
		<span style="color: red; font-size: 20px;">Your Result: </span> {{ session('result')->getAverageResult() }} %<br>
	@endif
@endsection