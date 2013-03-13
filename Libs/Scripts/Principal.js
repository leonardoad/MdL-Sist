$(document).ready(function(){
	var h = $(window).height();
	$('#containerPrincipal').height(h - 16);
	$('#iframePrincipal').height(h - 50)
	$(window).resize(function(){
		var h = $(window).height();
		$('#containerPrincipal').height(h - 16);
		$('#iframePrincipal').height(h - 50)
	});
	
	$(function(){
		//$('#containerLogin').width($(window).width() - 5);
		//$('#containerLogin').height($(window).height() - 2);
		//$('#containerLogin').css('opacity', '0.8	');
		$('.containerWindow').css('top', ($(window).height() / 2)  - ($('.containerWindow').height() / 2) + 'px');
		$('.containerWindow').css('left', ($(window).width()  / 2)  - ($('.containerWindow').width()  / 2)  + 'px')
	})
});