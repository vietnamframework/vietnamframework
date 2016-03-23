var url;
     function newlanguage(){
         $('#dlg').dialog('open').dialog('center').dialog('setTitle','New Language');
         $('#fm').form('clear');
         url = url_base+'language_backend/create';
     }
     function editlanguage(){
         var row = $('#dg').datagrid('getSelected');
         if (row){
             $('#dlg').dialog('open').dialog('center').dialog('setTitle','Edit Language');
             $('#fm').form('load',row);
             url = url_base+'language_backend/update?id='+row.id;
         }
     }
     function savelanguage(){
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
                     $('#dg').datagrid('reload');    // reload the language data
                 }
             }
         });
     }
     function destroylanguage(){
         var row = $('#dg').datagrid('getSelected');
         if (row){
             $.messager.confirm('Confirm','Are you sure you want to destroy this language?',function(r){
                 if (r){
                     $.post(url_base+'language_backend/delete',{id:row.id},function(result){
                         if (result.success){
                             $('#dg').datagrid('reload');    // reload the language data
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
     
