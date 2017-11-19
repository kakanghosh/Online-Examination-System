@extends('layouts.userlayout')
@section('title')
Create Question
@endsection

@section('maincontent')
	<form method="post">
		{{csrf_field()}}
		Quiz title <input type="text" name="question_title" id="question_title"> 
		@if ($errors->has('question_title'))
			<span style="color: red;">Quiz Title Is Required ***</span>
		@endif
		<br/>
		<input type="submit" name="submit" value="GO">
	</form>

@endsection