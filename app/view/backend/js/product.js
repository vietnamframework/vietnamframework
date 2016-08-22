var url;
var translate = false;
     function newproduct(){
         $('#dlg').dialog('open').dialog('center').dialog('setTitle','New product');
         $('#fm').form('clear');
         nicEditors.findEditor('content_content').setContent('');
         url = url_base+'product_backend/create';
     }
     function editproduct(){
         var row = $('#dg').datagrid('getSelected');
         if (row){
             $('#dlg').dialog('open').dialog('center').dialog('setTitle','Edit product');
             nicEditors.findEditor('content_content').setContent(row.description_detail);
             row.file = '';
             $('#fm').form('load',row);
             url = url_base+'product_backend/update?id='+row.id;
         }
     }
     function transproduct(){
    	 translate = true;
         var row = $('#dg').datagrid('getSelected');
         if (row){
             $('#dlg').dialog('open').dialog('center').dialog('setTitle','Trans product');
             nicEditors.findEditor('content_content').setContent(row.description_detail);
             row.file = '';
             $('#fm').form('load',row);
             url = url_base+'product_backend/create';
         }
     }
     function saveproduct(){
    	 
    	 $("#fm #real_content").val(nicEditors.findEditor('content_content').getContent());
         $('#fm').form('submit',{
             url: url,
             onSubmit: function(){
            	 
                 return $(this).form('validate');
             },
             success: function(result){
                 var result = eval('('+result+')');

                 if (result.errorMsg){
                     $.messager.show({
                         title: 'Error',
                         msg: result.errorMsg
                     });
                 } else {
                	 
                     $('#dlg').dialog('close');        // close the dialog
                     $('#dg').datagrid('reload');    // reload the product data
                 }
             }
         });
         translate = false;
     }
     function destroyproduct(){
         var row = $('#dg').datagrid('getSelected');
         if (row){
             $.messager.confirm('Confirm','Are you sure you want to destroy this product?',function(r){
                 if (r){
                     $.post(url_base+'product_backend/delete',{id:row.id},function(result){
                         if (result.success){
                             $('#dg').datagrid('reload');    // reload the product data
                         } else {
                             $.messager.show({    // show error message
                                 title: 'Error',
                                 msg: result.errorMsg
                             });
                         }
                     },'json');
                 }
             });
         }
     }
     
     
    var myNicEditor = new nicEditor({fullPanel : true, maxHeight : 700, uploadURI : url_base + 'product_backend/upload'});

 	bkLib.onDomLoaded(function(){
 		myInstance = myNicEditor.panelInstance('content_content');
 	});
     //bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
// $(document).ready(function(){
//		var myNicEditor = new nicEditor({fullPanel : true, maxHeight : 700, uploadURI : url_base + '/admin/content/upload'});
//
//		bkLib.onDomLoaded(function(){
//				 myInstance = myNicEditor.panelInstance('content_content');
//				$("#getcontent").click(function(){
//					alert(nicEditors.findEditor('content_content').getContent());
//					return false;
//				});
//		});
		
//		$("#submit").click(function(){
//			$(".content_editor").html(nicEditors.findEditor('content_content').getContent());
//			return true;
//		});
// });

 	
 	$(document).ready(function(){
 		$("#avata_upload").click(function(){

 	        var filename = $("#file_name").val();
 	        $.ajax({
 	            type: "POST",
 	            url: url_base+"upload_backend",
 	            enctype: 'multipart/form-data',
 	            data: {
 	                file: filename
 	            },
 	            success: function (data) {
 	            	console.log(data);
 	                alert("Data Uploaded: ");
 	            }
 	        });
 	    });
 	});
 		
 		
 		//discount price_display price
 		
 		//price_display = $('#price_display imput').val();

 	