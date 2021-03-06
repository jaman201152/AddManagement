<div id="type" class="easyui-dialog" style="width:600px;height:450px; padding:2px 2px;"
     closed="true" buttons="#type_south_buttons" title="">
    <div class="easyui-layout" fit="true"  id="type_layout" >

        <div data-options=" region:'center', split:'true', title:'Add New Type', iconCls:'icon-ok' " style="padding:5px;">
            <form id="type_form" method="post" novalidate>
                <div class="fitem">
                    <label>Name of Type</label>
                    <input name="type_name" class="easyui-textbox" required="true" value="">
                </div>
                 <div class="fitem">
                <label>Status</label>
                <select  name="type_status" required="required" class="easyui-combobox">
                    <option value="1" >Published</option>
                    <option value="0">Unpublished</option>
                </select>
            </div>
            </form>
        </div>


    </div>

</div> 
<!-- south_buttons start for Type form -->
             <div id="type_south_buttons">
                 <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveType()" >Save</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#type').dialog('close')" >Cancel</a>
            </div>
<script type="text/javascript">
    
    $(document).ready(function(){
                  
              
                  // Start Add Item Add New Chanage Option.
                $('#item').change(function(){
                    var additem_name=$('#item').val();
                    
                   if(additem_name==='addNew'){
                       $('#type').dialog('open');
                        $('#type_form').form('clear');
                        
                   }
                }); 


                }); // End Dom Ready 
                
                       function saveType(){
			$('#type_form').form('submit',{
				url: 'type/save_user.php',
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
						$('#type').dialog('close');		// close the dialog
                                                
						//$('#dg').datagrid('reload');	// reload the user data
                                                // Start load Reference select data
                                                 $.ajax({
                                                        url:'type/get_type.php',
                                                            success: function(data){
                                                                    var jsonData = $.parseJSON(data);
                                                            var $select = $('#item');
                                                            $(jsonData).each(function (index, o) {    
                                                                var $option = $("<option/>").attr("value", o.typeid).text(o.type_name);
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
		} // End Save Type Function.
                // End Item Name Add New Chanage Option.
                
                

</script>