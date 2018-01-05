
$(document).ready(function(){
	

	$('#option_type').click(function(){
		console.log($('#option_type').val());
		if ($('#option_type').val() == 'TF') {
			var tf = "<select class = 'btn btn-primary' name = 'correct_ans' id = 'correct'>"+
					"<option value = 'true'> True</option>"+
					"<option value = 'false'>False</option>"+ 
					"</select>";	
			$('#add_option').hide('slow');
			$('#option').hide('slow');
			$('#correct').replaceWith(tf);
		}else if ($('#option_type').val() == 'MC'){
			$('#add_option').show('show');
			$('#option').show('show');
			var mc = "<input type='text' class = 'form-control' name = 'correct_ans' id = 'correct' /> ";
			$('#correct').replaceWith(mc);
		}
	});
	
	var html_element = "<div  id = 'new_option' style='margin-top:10px;'>"+ 
						"<input style = 'width:50%; display:inline-block;' class = 'form-control' type='text' name = 'opt[]' id = 'opt' placeholder = 'Type Option'/> "+
						"<button class = 'btn btn-danger' id = 'remove' type = 'button'>X</button> "+
						"</div>";
						/*<a href = '#'  id ='remove'> X </a>*/
	$('#add_option').click(function(e){
		$('#option').append(html_element);
	});

	$('#option').on('click','#remove',function(e){
		$(this).parent('div#new_option').remove();
	});
});

