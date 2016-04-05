var url;
     function newgroup(){
         $('#dlg').dialog('open').dialog('center').dialog('setTitle','New group');
         $('#fm').form('clear');
         url = url_base+'group_backend/create';
     }
     function editgroup(){
         var row = $('#dg').datagrid('getSelected');
         if (row){
             $('#dlg').dialog('open').dialog('center').dialog('setTitle','Edit group');
             $('#fm').form('load',row);
             url = url_base+'group_backend/update?id='+row.id;
         }
     }
     function savegroup(){
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
                     $('#dg').datagrid('reload');    // reload the group data
                 }
             }
         });
     }
     function destroygroup(){
         var row = $('#dg').datagrid('getSelected');
         if (row){
             $.messager.confirm('Confirm','Are you sure you want to destroy this group?',function(r){
                 if (r){
                     $.post(url_base+'group_backend/delete',{id:row.id},function(result){
                         if (result.success){
                             $('#dg').datagrid('reload');    // reload the group data
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
     
