<style>
    label{
        font-weight: 700;
        color:#444;
    }
    .or_amt{
        text-align: right;
    }
    
</style>


	<table id="dg" title="All Property" class="easyui-datagrid" style="width:100%; min-height:400px"
			url="property/property_search.php"
			toolbar="#toolbar" pagination="true"
			rownumbers="true" fitColumns="true" singleSelect="true" showFooter="true">
		<thead>
			<tr>
                            <th field="ck" checkbox="true"></th>
                                <th field="property_id" width="auto">Property ID.</th>
                                <th field="property_no" width="auto">Property No.</th>
				<th field="property_name" width="auto">Property Name</th>
                                 <th field="property_type" width="auto">Type</th>
                                <th field="property_description" width="auto">Description</th>
                                <th field="original_amount" width="auto">Original Amount</th>
                                <th field="present_approximate_amount" width="auto">Present Approximate Amount</th>
                                <th field="entry_date" width="auto">Entry Date</th>
			</tr>
		</thead>
	</table>


	<div id="toolbar">
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newUser()">New Property</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" id="edt" iconCls="icon-edit" plain="true" onclick="editUser()">Edit</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" id="cnl" iconCls="icon-remove" plain="true" onclick="destroyUser()">Remove</a>
<!--                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls='icon-tip' plain='true' onclick="detailsView()">Details</a>-->
                &nbsp; &nbsp; &nbsp; &nbsp;<input type="text"  id="property_name">
		<a href="#" class="easyui-linkbutton" plain="true" iconCls="icon-search" onclick="doSearch()">Search</a>
	
        </div>

	<div id="dlg" class="easyui-dialog" style="width:600px;height:500px;padding:10px 20px"
			closed="true" buttons="#dlg-buttons">
		<div class="ftitle">Property Information Form</div>
		<form id="fm" method="post" novalidate>
                    
                    <div class="fitem">
				<label>1. entry Date: 
                                <input name="entry_date" class="easyui-datebox" >
                                </label>
                    </div>
                    
                    <div class="fitem">
                        <label>2. Property No: <input class="easyui-textbox" name="property_no" /></label>
                     </div>
                    
                        <div class="fitem">
                        <label>3. Property Type 
                          <select class="easyui-combobox" name="property_type">
                            <option value="">-- Please Select --</option>
                            <option value="Cash Account">Cash Account</option>
                            <option value="Bank Account">Bank Account</option>
                            <option value="Land">Land</option>
                          </select>
                        </label>
                    </div>
                    
			<div class="fitem">
				<label>4. Property Name: 
                                    <input name="property_name" class="easyui-textbox" id="property_name" ></label>
			</div>
                    
                           <div class="fitem">
                               <label>5. Property Description <input name="property_description" class="easyui-textbox"></label>
                            </div>
                    
			<div class="fitem">
                            <label>6. Original Amount: <input name="original_amount" class="easyui-numberbox" id="or_amt" ></label>
			</div>
                    
                    <div class="fitem">
                        <label>7. Present Approximate Amount: <input name="present_approximate_amount" id="apr_amt" class="easyui-numberbox" ></label>
				
			</div>
                 
                    	
		</form>
	</div>
    
	<div id="dlg-buttons">
		<a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveUser()" style="width:90px">Save</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Cancel</a>
	</div>
    


	<script type="text/javascript">
                
                $('#property_name').textbox({
               
                    iconCls:'icon-bill',
                    iconAlign:'left',
                    width:'100'
                    });
                    
                $('#or_amt,#apr_amt').numberbox('textbox').css('text-align','right'); 
    
		var url;
		function newUser(){
			$('#dlg').dialog('open').dialog('setTitle','New Property');
			$('#fm').form('clear');
			url = 'property/save_user.php';
		}
                
		function editUser(){
                   
			
       
               var row = $('#dg').datagrid('getSelected');
           
			if (row){
				$('#dlg').dialog('open').dialog('setTitle','Edit Property');
				$('#fm').form('load',row);
				url = 'property/update_user.php?id='+row.property_id;
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
//                                                 var row = $('#dg').datagrid('getSelected');
//                                                $.messager.show({title:'Message', msg:  'Property Id No: ' + row.property_id + ' Successfully Updated ' });
                                                
						$('#dlg').dialog('close');      // close the dialog
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
						$.post('property/destroy_user.php',{id:row.property_id},function(result){
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
				itemid: $('#property_id').val(),
				productid: $('#property_name').val()
			});
                 
		}
                
                // For Searching Member Id in Property form.
                	$(function(){
			$('#property_id').combogrid({
				panelWidth:300,
				url: 'property/get_property_property_individual.php',
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
			width:200px;
		}
		.fitem input{
			width:140px;
		}
	</style>

