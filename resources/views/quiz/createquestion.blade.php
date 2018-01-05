@extends('layouts.userlayout')
@section('title')
Quiz Maker | Set Quiz Title
@endsection

@section('maincontent')
	

	<div class="container"> {{-- Container Div starts here --}}
		<div class="row"> {{-- Row Div starts here --}}
			<div class="col-lg-2">
				
			</div>
			<div class="col-lg-8">
				<form method="post"> {{-- Form starts here --}}
					{{csrf_field()}}
					<div class="form-group">
						@if ($errors->has('question_title'))
							<div class="alert alert-danger">
								{{'Quiz Title Is Required'}}
							</div>
						@endif
						<label for="question_title">Quiz Title</label>
						<input type="text" class="form-control" name="question_title" id="question_title" placeholder="Type Quiz Title">
					</div>
					<div class="form-group">
						<input type="submit" class="btn btn-success" name="submit" value="GO">
					</div>
				</form>	{{-- Form ends here --}}
			</div>
			<div class="col-lg-2"></div>
		</div>  {{-- Row Div ends here --}}
	</div> {{-- Container Div ends here --}}

@endsection

@section('script')
	<script type="text/javascript">
		$(document).ready(function(){
			$('#createquestion').attr('class','active');
		});
	</script>
@endsection