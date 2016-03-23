var url;
     function newnews(){
         $('#dlg').dialog('open').dialog('center').dialog('setTitle','New News');
         $('#fm').form('clear');
         url = url_base+'news_backend/create';
     }
     function editnews(){
         var row = $('#dg').datagrid('getSelected');
         if (row){
             $('#dlg').dialog('open').dialog('center').dialog('setTitle','Edit News');
             $('#fm').form('load',row);
             url = url_base+'news_backend/update?id='+row.id;
         }
     }
     function savenews(){
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
                     $('#dg').datagrid('reload');    // reload the news data
                 }
             }
         });
     }
     function destroynews(){
         var row = $('#dg').datagrid('getSelected');
         if (row){
             $.messager.confirm('Confirm','Are you sure you want to destroy this news?',function(r){
                 if (r){
                     $.post(url_base+'news_backend/delete',{id:row.id},function(result){
                         if (result.success){
                             $('#dg').datagrid('reload');    // reload the news data
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
     bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
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