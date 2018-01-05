@extends('layouts.userlayout')
@section('title')
Quiz Maker | Change password
@endsection


@section('maincontent')
	<div class="container"> {{-- Container Div starts here --}}
		<div class="row"> {{-- Row Div starts here --}}
			<div class="col-lg-2">
				
			</div>
			<div class="col-lg-8">
				<form method="post">
					{{csrf_field()}}
					<div class="form-group">
						<label for="oldpassword">Old Password</label>
						@if($errors->has('oldpassword'))
							<div class="alert alert-danger alert-dismissable">
								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
								{{'Enter valid password'}}
							</div>
						@endif
						<input type="password" id="oldpassword" class="form-control" name="oldpassword" placeholder="Old Password"> 
					</div>
					<div class="form-group">
						<label for="password">New Password</label>
						<input type="password" id="password" class="form-control" name="password" placeholder="New Password">
					</div>
					<div class="form-group">
						<label for="repassword">Re-Password</label>
						@if($errors->has('password'))
							<div class="alert alert-danger alert-dismissable">
								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
								{{'Password not match or Invalid'}}
							</div>
						@endif
						<input type="password" id="repassword" class="form-control" name="repassword" placeholder="Re-Password">
					</div>
					<div class="form-group">
						<input type="submit" name="submit" class="btn btn-success" value="confirm">
						<a class="btn btn-danger" href="{{route('User.showProfile')}}">Cancel</a>
					</div>
				</form>
			</div>
			<div class="col-lg-2"></div>
		</div>  {{-- Row Div ends here --}}
	</div> {{-- Container Div ends here --}}
@endsection

@section('script')
	<script type="text/javascript">
		$(document).ready(function(){
			$('#profile').attr('class','active');
		});
	</script>
@endsection