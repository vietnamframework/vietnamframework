var url;
     function newcategory(){
         $('#dlg').dialog('open').dialog('center').dialog('setTitle','New Category');
         $('#fm').form('clear');
         url = url_base+'category_backend/create';
     }
     function editcategory(){
         var row = $('#dg').datagrid('getSelected');
         if (row){
             $('#dlg').dialog('open').dialog('center').dialog('setTitle','Edit Category');
             $('#fm').form('load',row);
             url = url_base+'category_backend/update?id='+row.id;
         }
     }
     function savecategory(){
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
                     $('#dg').datagrid('reload');    // reload the category data
                 }
             }
         });
     }
     function destroycategory(){
         var row = $('#dg').datagrid('getSelected');
         if (row){
             $.messager.confirm('Confirm','Are you sure you want to destroy this category?',function(r){
                 if (r){
                     $.post(url_base+'category_backend/delete',{id:row.id},function(result){
                         if (result.success){
                             $('#dg').datagrid('reload');    // reload the category data
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
     
