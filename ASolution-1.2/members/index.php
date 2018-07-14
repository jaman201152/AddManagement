
	


	<table id="dg" title="All Member's" class="easyui-datagrid" style="width:auto; min-height:400px"
			url="members/member_search.php"
			toolbar="#toolbar" pagination="true"
			rownumbers="true" fitColumns="true" singleSelect="true" showFooter="true">
		<thead>
			<tr>
                            <th field="ck" checkbox="true"></th>
                            <th field="id" width="auto">ID.</th>
                            <th field="firstname" width="auto">First Name</th>
                            <th field="phone" width="auto">Phone</th>
                            <th field="email" width="auto">Email</th>
                            <th field="presentadd" width="auto">Present Address</th>
                            <th field="permanentadd" width="auto">Permanent Address</th>
                           
                                
			</tr>
		</thead>
	</table>

  
	<div id="toolbar">
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newUser()">New</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" id="edt" iconCls="icon-edit" plain="true" onclick="editUser()">Edit</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" id="cnl" iconCls="icon-remove" plain="true" onclick="destroyUser()">Delete</a>
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls='icon-tip' plain='true' onclick="detailsView()">Transaction</a>
                &nbsp; &nbsp; &nbsp; &nbsp;<input type="text"  id="firstname">
		<a href="#" class="easyui-linkbutton" plain="true" iconCls="icon-search" onclick="doSearch()">Search</a>
	
        </div>
   
	
	<div id="dlg" class="easyui-dialog" style="width:500px;height:380px;padding:10px 20px"
			closed="true" buttons="#dlg-buttons">
		<div class="ftitle">Member Information</div>
		<form id="fm" method="post" novalidate>
			<div class="fitem">
				<label>First Name:</label>
				<input name="firstname" class="easyui-textbox" required="true">
			</div>
			<div class="fitem">
				<label>Last Name:</label>
				<input name="lastname" class="easyui-textbox" required="true">
			</div>
			<div class="fitem">
				<label>Phone:</label>
				<input name="phone" class="easyui-textbox">
			</div>
			<div class="fitem">
				<label>Email:</label>
				<input name="email" class="easyui-textbox" validType="email">
			</div>
                    <div class="fitem">
				<label>Present Address:</label>
				<input name="presentadd" class="easyui-textbox" >
			</div>
                    <div class="fitem">
				<label>Permanent Address:</label>
				<input name="permanentadd" class="easyui-textbox" >
			</div>
		</form>
	</div>
    
	<div id="dlg-buttons">
		<a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveUser()" style="width:90px">Save</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Cancel</a>
	</div>
    <!-- Member Dialog End -->
    <div id="dlg_transaction" class="easyui-dialog" closed="true" style="height:600px; width:800px;" buttons="#dlg_tra_buttons">
        <div class="easyui-layout" fit='true' >
            <div data-options="region:'north',title:'North' " style="height:80px">
                
            </div>
             <div data-options="region:'center',title:'Center'" style="width:600px">
                
            </div>

             <div data-options="region:'west',title:'West'" style="width:150px">
                
            </div>
        </div>
    </div>
    <div id="dlg_tra_buttons">
        <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveUser()" style="width:90px">Save</a>
	<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg_transaction').dialog('close')" style="width:90px">Cancel</a>
	
    </div>
 

	<script type="text/javascript">
                
                $('#firstname').textbox({
               
                    iconCls:'icon-man',
                    iconAlign:'left',
                    width:'100'
                    });
    
		var url;
		function newUser(){
			$('#dlg').dialog('open').dialog('setTitle','New Member');
			$('#fm').form('clear');
			url = 'members/save_user.php';
		}
                
		function editUser(){
                   
			
       
               var row = $('#dg').datagrid('getSelected');
           
			if (row){
				$('#dlg').dialog('open').dialog('setTitle','Edit Member');
				$('#fm').form('load',row);
				url = 'members/update_user.php?id='+row.id;
			}
                        else{
                             $.messager.alert('Message', "Please select atleast one item.", 'info');
                        }
                       
		}
                
                function detailsView(){
                    var row=$('#dg').datagrid('getSelected');
                    if(row){
                      $('#dlg_transaction').dialog('open').dialog('setTitle','Transaction Of '+row.firstname+', Member ID - '+row.id);
                    }
                    else{
                             $.messager.alert('Message', "Please select atleast one item.", 'info');
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
					if (result.errorMsg){
						$.messager.show({
							title: 'Error',
							msg: result.errorMsg
						});
					} else {
						$('#dlg').dialog('close');		// close the dialog
						$('#dg').datagrid('reload');	// reload the user data
					}
				}
			});
		}
                
		function destroyUser(){
			var row = $('#dg').datagrid('getSelected');
			if (row){
				$.messager.confirm('Confirm','Are you sure you want to destroy this user?',function(r){
					if (r){
						$.post('members/destroy_user.php',{id:row.id},function(result){
							if (result.success){
								$('#dg').datagrid('reload');	// reload the user data
							} else {
								$.messager.show({	// show error message
									title: 'Error',
									msg: result.errorMsg
								});
							}
						},'json');
					}
				});
			}
                        else{
                            $.messager.alert('Message','Please select atleast one item.','info');
                        }
		}
                // For Search Function
                function doSearch(){
			$('#dg').datagrid('load',{
				itemid: $('#id').val(),
				productid: $('#firstname').val()
			});
                 
		}
                
               
	</script>
	<style type="text/css">
		#fm{
			margin:0;
			padding:10px 30px;
		}
		.ftitle{
			font-size:14px;
			font-weight:bold;
			padding:5px 0;
			margin-bottom:10px;
			border-bottom:1px solid #ccc;
		}
		.fitem{
			margin-bottom:5px;
		}
		.fitem label{
			display:inline-block;
			width:80px;
		}
		.fitem input{
			width:160px;
		}
	</style>
