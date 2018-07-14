<div id="company_type" class="easyui-dialog" style="width:600px;height:450px; padding:2px 2px;"
     closed="true" buttons="#company_type_south_buttons" title="">
    <div class="easyui-layout" fit="true"  id="company_type_layout" >

        <div data-options=" region:'center', split:'true', title:'Add New Company Type', iconCls:'icon-ok' " style="padding:5px;">
            <form id="company_type_form" method="post" novalidate>
                <div class="fitem">
                    <label>Name of Company Type</label>
                    <input name="company_type_name" class="easyui-textbox" required="true" value="">
                </div>
                 <div class="fitem">
                <label>Status</label>
                <select  name="company_type_status" required="required" class="easyui-combobox">
                    <option value="1" >Published</option>
                    <option value="0">Unpublished</option>
                </select>
            </div>
            </form>
        </div>


    </div>
</div> 
<!-- south_buttons start for Company Type form -->
             <div id="company_type_south_buttons">
                 <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveCompanyType()" >Save</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#company_type').dialog('close')" >Cancel</a>
            </div>
<script>
    
    $(document).ready(function(){
       
 // Start Add Company Type Add New Chanage Option.
                $('#txttype').change(function(){
                    var additem_name=$('#txttype').val();
                    
                   if(additem_name==='addNew'){
                       $('#company_type').dialog('open');
                        $('#company_type_form').form('clear');
                   }
                }); 
          
    });   // End Dom Ready 
                 
                       function saveCompanyType(){
			$('#company_type_form').form('submit',{
				url: 'company_type/save_user.php',
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
						$('#company_type').dialog('close');		// close the dialog
                                                
						//$('#dg').datagrid('reload');	// reload the user data
                                                // Start load Reference select data
                                                 $.ajax({
                                                        url:'company_type/get_type.php',
                                                            success: function(data){
                                                                    var jsonData = $.parseJSON(data);
                                                            var $select = $('#txttype');
                                                            $(jsonData).each(function (index, o) {    
                                                                var $option = $("<option/>").attr("value", o.companytypeid).text(o.company_type_name);
                                                                $select.append($option);
                                                            });
                                                            //$.messager.alert('message',data);
                                
                                                             }
                                                        }); // End loaded new ref_name value.
                                                             $.messager.show({
                                                            title: 'Message',
                                                            msg: 'New Type saved Successfully',
                                                            showType: 'show'
                                                        });
                                                        
					}
				}
			});
		} // End Save Company Type Function.
                // End Company Type Name Add New Chanage Option.
       
</script>