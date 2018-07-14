<div id="reference" class="easyui-dialog" style="width:600px;height:500px; padding:2px 2px;"
     closed="true" buttons="#reference_south_buttons" title="">
    <div class="easyui-layout" fit="true"  id="profile_layout" >



        <div data-options=" region:'center', split:'true', title:'Add New Reference', iconCls:'icon-ok' " style="padding:5px;">
            <form id="reference_form" method="post" novalidate>
                <div class="fitem">
                    <label>Name</label>
                    <input name="ref_name" class="easyui-textbox" required="true" value="">
                </div>
                <div class="fitem">
                    <label>Address</label>
                    <input name="ref_address" class="easyui-textbox" required="true">
                </div>
                 <div class="fitem">
                <label>Division</label>
                <select  name="ref_division" id="country" onChange="getStateRef(this.value)" required="required">
                    <option value="">Select Division</option>
                    <option value="1">Dhaka</option>
                    <option value="2">Chittagong</option>
                    <option value="3">Rajshahi</option>
                    <option value="4">Khulna</option>
                    <option value="5">Barisal</option>
                    <option value="6">Sylhet</option>
                    <option value="7">Rangpur</option>
                    <option value="8">Mymensingh</option>
                </select>
            </div>
            <div class="fitem">
                <div id="ref_statediv">
                    <label>District</label>
                    <select name="district" class="district" >
                        <option value="">Select Division First</option>
                    </select>
                </div>
            </div>
            <div class="fitem">
                <div id="ref_citydiv">
                    <label>Upazila</label>
                    <select name="upazila" class="ref_upazila">
                        <option value="">Select District First</option>
                    </select></div>
            </div>
                <div class="fitem">
                    <label>Phone</label>
                    <input name="ref_phone" class="easyui-textbox" required="true">
                </div>
                <div class="fitem">
                    <label>Email</label>
                    <input name="ref_email" class="easyui-textbox">
                </div>


            </form>
        </div>


    </div>

</div> 
<!-- south_buttons start for reference form -->
             <div id="reference_south_buttons">
                 <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveReference()" >Save</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#reference').dialog('close')" >Cancel</a>
            </div>
<script type="text/javascript">
     
     $(document).ready(function(){
         
           // Start Reference_Name Add New Chanage Option.
                $('#ref_name').change(function(){
                    var ref_name=$('#ref_name').val();
                    
                   if(ref_name==='addNew'){
                       $('#reference').dialog('open').dialog('setTitle','Add Reference Info');
                       $('#reference_form').form('clear');
                   }
                }); // End Changing  Reference Name
         
     });
            
             
              
                 
                
                            function saveReference(){
			$('#reference_form').form('submit',{
				url: 'reference_profile/save_user.php',
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
						$('#reference').dialog('close');		// close the dialog
                                                
						//$('#dg').datagrid('reload');	// reload the user data
                                                // Start load Reference select data
                                                 $.ajax({
                                                        url:'reference_profile/get_reference.php',
                                                            success: function(data){
                                                                    var jsonData = $.parseJSON(data);
                                                            var $select = $('#ref_name');
                                                            $(jsonData).each(function (index, o) {    
                                                                var $option = $("<option/>").attr("value", o.ref_id).text(o.ref_name);
                                                                $select.append($option);
                                                            });
                                                            //$.messager.alert('message',data);
                                
                                                             }
                                                        }); // End loaded new ref_name value.
                                                             $.messager.show({
                                                            title: 'Message',
                                                            msg: 'New Reference Saved Successfully',
                                                            showType: 'show'
                                                        });
                                                        
					}
				}
			});
		} // End Save Reference Function.
                // End Reference_Name Add New Chanage Option.



</script>