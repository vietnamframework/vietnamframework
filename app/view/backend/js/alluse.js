var url_curent = window.location.href;

$(document).ready(function(){
	$(".sidebar-menu li a").each(function(){
		var text_search = "/" + $(this).attr('href');
		n = url_curent.search(text_search);
		if(n != -1) {
			$(this).parent('li').addClass('active');
		} else {
			$(this).parent('li').removeClass('active');
		}
	});
});