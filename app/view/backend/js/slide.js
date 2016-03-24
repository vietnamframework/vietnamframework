var url;
     function newslide(){
         $('#dlg').dialog('open').dialog('center').dialog('setTitle','New Slide');
         $('#fm').form('clear');
         url = url_base+'slide_backend/create';
     }
     function editslide(){
         var row = $('#dg').datagrid('getSelected');
         if (row){
             $('#dlg').dialog('open').dialog('center').dialog('setTitle','Edit Slide');
             $('#fm').form('load',row);
             url = url_base+'slide_backend/update?id='+row.id;
         }
     }
     function saveslide(){
         $('#fm').form('submit',{
             url: url,
             onSubmit: function(){
                 return $(this).form('validate');
             },
             success: function(result){
                 var result = eval('('+result+')');
                 
                 console.log(result);
                 if (result.errorMsg){
                     $.messager.show({
                         title: 'Error',
                         msg: result.errorMsg
                     });
                 } else {
                     $('#dlg').dialog('close');        // close the dialog
                     $('#dg').datagrid('reload');    // reload the slide data
                 }
             }
         });
     }
     function destroyslide(){
         var row = $('#dg').datagrid('getSelected');
         if (row){
             $.messager.confirm('Confirm','Are you sure you want to destroy this slide?',function(r){
                 if (r){
                     $.post(url_base+'slide_backend/delete',{id:row.id},function(result){
                         if (result.success){
                             $('#dg').datagrid('reload');    // reload the slide data
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
     
