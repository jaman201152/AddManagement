<style>
    label{
        font-weight: 700;
        color:#444;
    }
</style>


	<table id="dg" title="All Transaction" class="easyui-datagrid" style="width:100%; min-height:400px"
			url="transaction/member_search.php"
			toolbar="#toolbar" pagination="true"
			rownumbers="true" fitColumns="true" singleSelect="true" showFooter="true">
		<thead>
			<tr>
                            <th field="ck" checkbox="true"></th>
                                <th field="t_id" width="auto">Transaction ID.</th>
				<th field="member_id" width="auto">Member's Id</th>
				<th field="member_name" width="auto">Member's Name</th>
                                <th field="memo_no" width="auto">Memo No</th>
                                <th field="amount" width="auto">Amount</th>
                                <th field="transaction_type" width="auto">Transaction Type</th>
                                <th field="payment_date" width="auto">Payment Date</th>
                                <th field="received_by" width="auto">Ordered By</th>
			</tr>
		</thead>
	</table>

  
	<div id="toolbar">
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newUser()">New Transaction</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" id="edt" iconCls="icon-edit" plain="true" onclick="editUser()">Edit</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" id="cnl" iconCls="icon-remove" plain="true" onclick="destroyUser()">Remove</a>
<!--                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls='icon-tip' plain='true' onclick="detailsView()">Details</a>-->
                &nbsp; &nbsp; &nbsp; &nbsp;<input type="text"  id="member_name">
		<a href="#" class="easyui-linkbutton" plain="true" iconCls="icon-search" onclick="doSearch()">Search</a>
	
        </div>

	<div id="dlg" class="easyui-dialog" style="width:600px;height:500px;padding:10px 20px"
			closed="true" buttons="#dlg-buttons">
		<div class="ftitle">Member transaction Form</div>
		<form id="fm" method="post" novalidate>
                    <div class="fitem">
                        <label>Memo No: <input class="easyui-textbox" name="memo_no" required="required" ></label>
                     </div>
                        <div class="fitem">
				<label>Member's ID: <input name="member_id" class="easyui-combobox" id="member_id" required="required"  ></label>
                                
			</div>
			<div class="fitem">
				<label>Member's Name: 
                                    <input name="member_name" class="easyui-textbox" id="member_name" ></label>
                                
			</div>
			<div class="fitem">
				<label>Amount: <input name="amount" class="easyui-numberbox" required="required" ></label>
				
			</div>
                    <div class="fitem">
                        <label>Type 
                          <select class="easyui-combobox" name="transaction_type" required="required">
                            <option value="">-- Please Select --</option>
                            <option value="Deposit">Deposit</option>
                            <option value="Withdraw">Withdraw</option>
                        </select>
                        </label>
                    
                    </div>
                    
			<div class="fitem">
				<label>Payment Date: 
                                <input name="payment_date" class="easyui-datebox" required="required" >
                                </label>
				
			</div>
                    	<div class="fitem">
				<label>Received By:
                                <input name="received_by" class="easyui-textbox" >
                                </label>
				
			</div>
		</form>
	</div>
    
	<div id="dlg-buttons">
		<a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveUser()" style="width:90px">Save</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Cancel</a>
	</div>
    
 

	<script type="text/javascript">
                
                $('#member_name').textbox({
               
                    iconCls:'icon-man',
                    iconAlign:'left',
                    width:'100'
                    });
    
		var url;
		function newUser(){
			$('#dlg').dialog('open').dialog('setTitle','New Transaction');
			$('#fm').form('clear');
			url = 'transaction/save_user.php';
		}
                
		function editUser(){
                   
			
       
               var row = $('#dg').datagrid('getSelected');
           
			if (row){
				$('#dlg').dialog('open').dialog('setTitle','Edit Transaction');
				$('#fm').form('load',row);
				url = 'transaction/update_user.php?id='+row.t_id;
			}
                        else{
                             $.messager.alert('Message', "Please select atleast one item.", 'info');
                        }
                       
		}
                
                function detailsView(){
                    var row=$('#dg').datagrid('getSelected');
                    if(row){
                        $('#dlg').dialog('open').dialog('setTitle','All information');
                        $('#fm').from('load',row);
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
						$.post('transaction/destroy_user.php',{id:row.t_id},function(result){
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
				itemid: $('#member_id').val(),
				productid: $('#member_name').val()
			});
                 
		}
                
                // For Searching Member Id in Transaction form.
                	$(function(){
			$('#member_id').combogrid({
				panelWidth:300,
				url: 'transaction/get_transaction_member_individual.php',
				idField:'id',
				textField:'id',
				fitColumns:true,
				columns:[[
					{field:'id',title:'Customer ID',width:60},
					//{field:'invoice_num',title:'Invoice Num',width:80},
					{field:'firstname',title:'First Name',width:60},
					//{field:'payable_amount',title:'Unit Cost',align:'right',width:60},
					{field:'email',title:'Email Address',width:150}
					//{field:'discount',title:'Discount',align:'center',width:60}
				]]
			});    
                        
		});
                
               
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

