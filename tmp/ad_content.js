$(document).ready(function(){
	var myNicEditor = new nicEditor({fullPanel : true, maxHeight : 700, uploadURI : base_url + '/admin/content/upload'});

	bkLib.onDomLoaded(function(){
			 myInstance = myNicEditor.panelInstance('content_content');
			$("#getcontent").click(function(){
				alert(nicEditors.findEditor('content_content').getContent());
				return false;
			});
	});
	
	$("#submit").click(function(){
		validate();
		
		$(".content_editor").html(nicEditors.findEditor('content_content').getContent());
		return true;
	});

	$( "#content_category" ).change(function() {
		var category_id = $( "#content_category option:selected" ).val();
		window.location = base_url + "/admin/content?categoryid=" + category_id;
	  });

	 $(' input[type=reset]').click(function() {
		 $(' input[type=text]').val('');
		 nicEditors.findEditor('content_content').setContent('');
		return false;
	 });
});

function validate() {
	
}
function pagin(page) {
	var category_id = $("#content_category option:selected" ).val();
	window.location = base_url + "/admin/content?page=" + page + "&categoryid=" + category_id;
}