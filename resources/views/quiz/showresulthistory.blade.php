@extends('layouts.userlayout')
@section('title')
Quiz Maker | Quiz Hostory
@endsection


@section('style')
@endsection

@section('maincontent')

	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-2"></div>
			<div class="col-lg-10">
				<h2>Quiz Title: <span class="text-primary">{{$examtitle}}</span></h2>
				<table class="table-bordered table-condensed table-hover table-striped table-responsive">
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
			</div>
		</div>
	</div>

	
@endsection

@section('script')
<script type="text/javascript">
		$('#allexams').attr('class','active');
</script>
@endsection