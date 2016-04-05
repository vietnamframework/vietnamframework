var url;
     function newurlfriend(){
         $('#dlg').dialog('open').dialog('center').dialog('setTitle','New Urlfriend');
         $('#fm').form('clear');
         url = url_base+'urlfriend_backend/create';
     }
     function editurlfriend(){
         var row = $('#dg').datagrid('getSelected');
         if (row){
             $('#dlg').dialog('open').dialog('center').dialog('setTitle','Edit Urlfriend');
             $('#fm').form('load',row);
             url = url_base+'urlfriend_backend/update?id='+row.id;
         }
     }
     function saveurlfriend(){
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
                     $('#dg').datagrid('reload');    // reload the urlfriend data
                 }
             }
         });
     }
     function destroyurlfriend(){
         var row = $('#dg').datagrid('getSelected');
         if (row){
             $.messager.confirm('Confirm','Are you sure you want to destroy this urlfriend?',function(r){
                 if (r){
                     $.post(url_base+'urlfriend_backend/delete',{id:row.id},function(result){
                         if (result.success){
                             $('#dg').datagrid('reload');    // reload the urlfriend data
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
     
