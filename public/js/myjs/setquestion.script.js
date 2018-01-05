$(document).ready(function(){
	$('#createquestion').attr('class','active');
	//Adding scroll bar to question div
	var windowHeight = $(window).height();
	/*$('.all-question').css("height", windowHeight+"px");*/
	/*alert($('.all-question').height());*/
	if ($('.all-question').height() >= windowHeight) {
		$('.all-question').css("height", windowHeight+"px")
		$('.all-question').css("overflow-y", "scroll");
	}

	//If Minimum question is not in the set
	/*finishquizset*/
	$('#finishquizset').click(function(){
		var numberOfQuestion = $('#numberofqsn').val();
		var link = $('#finishquizlink').val();
		if (numberOfQuestion < 2) {
			alert('Minimum Number of Question is not set.\n'+'Minimum Question is 2');
		}else{
			$(this).attr('href',link);
		}
		
	});
});