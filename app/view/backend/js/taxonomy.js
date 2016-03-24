var url;
     function newtaxonomy(){
         $('#dlg').dialog('open').dialog('center').dialog('setTitle','New taxonomy');
         $('#fm').form('clear');
         url = url_base+'taxonomy_backend/create';
     }
     function edittaxonomy(){
         var row = $('#dg').datagrid('getSelected');
         if (row){
             $('#dlg').dialog('open').dialog('center').dialog('setTitle','Edit taxonomy');
             $('#fm').form('load',row);
             url = url_base+'taxonomy_backend/update?id='+row.id;
         }
     }
     function savetaxonomy(){
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
                     $('#dg').datagrid('reload');    // reload the taxonomy data
                 }
             }
         });
     }
     function destroytaxonomy(){
         var row = $('#dg').datagrid('getSelected');
         if (row){
             $.messager.confirm('Confirm','Are you sure you want to destroy this taxonomy?',function(r){
                 if (r){
                     $.post(url_base+'taxonomy_backend/delete',{id:row.id},function(result){
                         if (result.success){
                             $('#dg').datagrid('reload');    // reload the taxonomy data
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
     
