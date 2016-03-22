var url;
     function newmenu(){
         $('#dlg').dialog('open').dialog('center').dialog('setTitle','New Menu');
         $('#fm').form('clear');
         url = url_base+'menu_backend/create';
     }
     function editmenu(){
         var row = $('#dg').datagrid('getSelected');
         if (row){
             $('#dlg').dialog('open').dialog('center').dialog('setTitle','Edit Menu');
             $('#fm').form('load',row);
             url = url_base+'menu_backend/update?id='+row.id;
         }
     }
     function savemenu(){
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
                     $('#dg').datagrid('reload');    // reload the menu data
                 }
             }
         });
     }
     function destroymenu(){
         var row = $('#dg').datagrid('getSelected');
         if (row){
             $.messager.confirm('Confirm','Are you sure you want to destroy this menu?',function(r){
                 if (r){
                     $.post(url_base+'menu_backend/delete',{id:row.id},function(result){
                         if (result.success){
                             $('#dg').datagrid('reload');    // reload the menu data
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
     
