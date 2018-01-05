$(document).ready(function(){
	 $('.copy').click(function(){
	 	/*var link = $('.link'); */
	 	var link = $('.'+$(this).val());
	 	link.attr('type','text');
	 	link.select();
  		document.execCommand("Copy");
  		link.attr('type','hidden');
	 	alert('Quiz Link Copied: '+link.val());
	 	/*alert($('.'+$(this).val());*/
	 });
});