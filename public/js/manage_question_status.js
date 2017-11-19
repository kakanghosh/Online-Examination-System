"use strict";
$(document).ready(function(){
	$('.status').change(function(){
		var value = $(this).val();
		$.ajax({
			url: '/updatequestionstatus',
			data: {
				questionid : getQuestionSetID(value),
				status : getStatus(value)
			},
			success:function(result){
				
			}
		});
	});
});

function getQuestionSetID(data){
	var lastIndex = data.lastIndexOf('_') + 1;
	return data.substring(lastIndex,data.length);
}

function getStatus(data){
	var lastIndex = data.lastIndexOf('_');
	return data.substring(0,lastIndex);
}