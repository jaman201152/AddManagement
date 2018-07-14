<div id="company_cat" class="easyui-dialog" style="width:600px;height:450px; padding:2px 2px;"
     closed="true" buttons="#company_cat_south_buttons" title="">
    <div class="easyui-layout" fit="true"  id="cat_layout" >

        <div data-options=" region:'center', split:'true', title:'Add New Company Category', iconCls:'icon-ok' " style="padding:5px;">
            <form id="company_cat_form" method="post" novalidate>
                        <div class="fitem">
                     <label>Company Type </label><select name="com_type" id="com_type" class="easyui-combobox" style="width:150px; " required="required">
                              <?php
                    include 'conn.php';
                    $query_company_type1 = $con->prepare("Select companytypeid, company_type_name from company_type_tbl group by company_type_name");
                    $query_company_type1->execute();
                    while ($row_ref = $query_company_type1->fetch(PDO::FETCH_ASSOC)) {
                        extract($row_ref);
                        ?>
                        <option value="<?php echo $companytypeid; ?>"><?php echo $company_type_name; ?></option>
                        <?php
                    }
                    ?>
                    </select>
                                </div>
                <div class="fitem">
                    <label>Name of Company Category</label>
                    <input name="company_cat_name" class="easyui-textbox" required="true" value="">
                </div>
                 <div class="fitem">
                <label>Status</label>
                <select  name="company_cat_status" required="required" class="easyui-combobox">
                    <option value="1" >Published</option>
                    <option value="0">Unpublished</option>
                </select>
            </div>
            </form>
        </div>


    </div>
</div> 
<!-- south_buttons start for Company Category form -->
             <div id="company_cat_south_buttons">
                 <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveCompanyCat()" >Save</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#company_cat').dialog('close')" >Cancel</a>
            </div>
<script type="text/javascript">
              $(document).ready(function(){
                 
// Start Add Company Cat Add New Chanage Option.
                $('#txtproject_name').change(function(){
                    var additem_name=$('#txtproject_name').val();
                    
                   if(additem_name==='addNew'){
                       $('#company_cat').dialog('open');
                        $('#company_cat_form').form('clear');
                   }
                   
                   
                }); 
                }); // end dom ready
                       function saveCompanyCat(){
			$('#company_cat_form').form('submit',{
				url: 'company_cat/save_user.php',
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
						$('#company_cat').dialog('close');		// close the dialog
                                                
						//$('#dg').datagrid('reload');	// reload the user data
                                                // Start load Reference select data
                                                 $.ajax({
                                                        url:'company_cat/get_type.php',
                                                            success: function(data){
                                                                    var jsonData = $.parseJSON(data);
                                                            var $select = $('#txtproject_name');
                                                            $(jsonData).each(function (index, o) {    
                                                                var $option = $("<option/>").attr("value", o.companycatid).text(o.company_cat_name);
                                                                $select.append($option);
                                                            });
                                                            //$.messager.alert('message',data);
                                
                                                             }
                                                        }); // End loaded new ref_name value.
                                                             $.messager.show({
                                                            title: 'Message',
                                                            msg: 'New Company Category saved Successfully',
                                                            showType: 'show'
                                                        });
                                                        
					}
				}
			});
		} // End Save Company Cat Function.
                // End Company Cat Name Add New Chanage Option.
 
              
</script>