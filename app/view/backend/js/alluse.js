var url_curent = window.location.href;

$(document).ready(function(){
	$(".sidebar-menu a").each(function(){
		var text_search = "/" + $(this).attr('href');
		n = url_curent.search(text_search);
		//console.log($(this).attr('href'));
		if(n != -1) {
			$(this).parent().parent('ul').attr('style', '');
			$(this).parent().parent('ul').addClass('menu-open');
			$(this).parent().parent().parent('li').addClass('active');
			$(this).parent('li').addClass('active');
		} else {
			$(this).parent().parent().parent('li').removeClass('active');
			$(this).parent('li').removeClass('active');
		}
	});
});