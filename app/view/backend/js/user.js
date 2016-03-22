var url;
     function newUser(){
         $('#dlg').dialog('open').dialog('center').dialog('setTitle','New User');
         $('#fm').form('clear');
         url = url_base+'user_backend/create';
     }
     function editUser(){
         var row = $('#dg').datagrid('getSelected');
         if (row){
             $('#dlg').dialog('open').dialog('center').dialog('setTitle','Edit User');
             row.pass = '';
             $('#fm').form('load',row);
             url = url_base+'user_backend/update?id='+row.id;
         }
     }
     function saveUser(){
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
                     $('#dg').datagrid('reload');    // reload the user data
                 }
             }
         });
     }
     function destroyUser(){
         var row = $('#dg').datagrid('getSelected');
         if (row){
             $.messager.confirm('Confirm','Are you sure you want to destroy this user?',function(r){
                 if (r){
                     $.post(url_base+'user_backend/delete',{id:row.id},function(result){
                         if (result.success){
                             $('#dg').datagrid('reload');    // reload the user data
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
     