var url;
     function newpermission(){
         $('#dlg').dialog('open').dialog('center').dialog('setTitle','New permission');
         $('#fm').form('clear');
         url = url_base+'permission_backend/create';
     }
     function editpermission(){
         var row = $('#dg').datagrid('getSelected');
         if (row){
             $('#dlg').dialog('open').dialog('center').dialog('setTitle','Edit permission');
             $('#fm').form('load',row);
             url = url_base+'permission_backend/update?id='+row.id;
         }
     }
     function scanfunction(){
    	 //ajax -> scanfunction
    	 $.post( url_base+'permission_backend/scanfunc', function( data ) {
    		 // reload data
    		 $('#dlg').dialog('close');        // close the dialog
             $('#dg').datagrid('reload');    // reload the permission data
    	});
     }
     
     function savepermission(){
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
                     $('#dg').datagrid('reload');    // reload the permission data
                 }
             }
         });
     }
     function destroypermission(){
         var row = $('#dg').datagrid('getSelected');
         if (row){
             $.messager.confirm('Confirm','Are you sure you want to destroy this permission?',function(r){
                 if (r){
                     $.post(url_base+'permission_backend/delete',{id:row.id},function(result){
                         if (result.success){
                             $('#dg').datagrid('reload');    // reload the permission data
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
     
