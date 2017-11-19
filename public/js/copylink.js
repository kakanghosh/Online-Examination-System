$(document).ready(function(){
	 $('#copy').click(function(){
	 	var link = $('#link');
	 	link.select();
  		document.execCommand("Copy");
	 	alert('Quiz Link Copied');
	 });
});