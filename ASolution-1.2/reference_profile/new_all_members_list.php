
<table id="dg" title="List of all references" class="easyui-datagrid" style="width:auto; min-height:400px"
			url="reference_profile/member_search.php"
			toolbar="#toolbar" pagination="true"
			rownumbers="true" fitColumns="true" singleSelect="true">
		<thead>
			<tr>
                <th field="ref_id" width="auto">ID.</th>
				<th field="ref_name" width="auto">Name</th>
                <th field="ref_address" width="auto">Address</th>
                <th field="country" width="auto">Division</th>
                <th field="statename" width="auto">District</th>
                <th field="ref_upazila" width="auto">Upazila</th>
                <th field="ref_phone" width="auto">Phone</th>
                <th field="ref_email" width="auto">Email</th>
                <th field="ref_created_at" width="auto">Created at</th>
                <th field="ref_updated_at" width="auto">Updated at</th>
			</tr>
		</thead>
	</table>


	<div id="toolbar">
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newReference()">New </a>
		<a href="javascript:void(0)" class="easyui-linkbutton" id="edt" iconCls="icon-edit" plain="true" onclick="editUser()">Edit </a>
<!-- 		<a href="javascript:void(0)" class="easyui-linkbutton" id="cnl" iconCls="icon-remove" plain="true" onclick="destroyUser()">Destroy </a> -->
                <a href="javascript:void(0)" class="easyui-linkbutton" id="client_profile" iconCls="icon-profile" plain="true" onclick="profile()">Profile</a>
<!--                 <a href="javascript:void(0)" class="easyui-linkbutton" id="order" iconCls="icon-order_color" plain="true" onclick="order()">Order</a> -->
<!--                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls='icon-tip' plain='true' onclick="detailsView()">Details</a>-->
&nbsp; &nbsp; &nbsp; &nbsp;<input type="text"  id="txtsearch">
		<a href="#" class="easyui-linkbutton" plain="true" iconCls="icon-search" onclick="doSearch()">Search</a>
	
        </div>
    
	
	<div id="dlg" class="easyui-dialog" style="width:750px;height:530px;padding:10px 80px 10px 80px"
			closed="true" buttons="#dlg-buttons">
		
		<form id="fm" method="post" novalidate>
                    <div class="ftitle">Customer Information</div>
		<div class="fitem">
				<label>Name</label>
                                
                                <input name="name"  class="easyui-textbox" required="true">
			</div>
			<div class="fitem">
				<label>Address</label>
				<input name="address" class="easyui-textbox" required="true">
			</div>
			<div class="fitem">
				<label>Type</label>
				<input name="type" class="easyui-textbox">
			</div>
			<div class="fitem">
				<label>Project Name</label>
                                 <select name="project_name" required="required">
                                    <option value="">-- Please Select --</option>
                                    <option value="Government">Government</option>
                                    <option value="Private">Private</option>
                                    <option value="Non-Government">Non-Government</option>
                                    <option value="Others">Others</option>
                                </select>
			</div>
                    <div class="fitem" >
				<label>Referance Name</label>
                                <select name="ref_name" id="ref_name" required="required">
                                    <option value="">-- Please Select --</option>
                                    <option value="addNew">Add New</option>
                                    <option value="Government">Sabbir</option>
                                    <option value="Private">Rasel</option>
                                    <option value="Non-Government">Morshed</option>
                                    <option value="Others">Khalid</option>
                                </select>
			</div>
                    <div class="fitem">
				<label>Joining Date</label>
				<input name="join_date" class="easyui-datetimebox">
			</div>
                    <div class="fitem">
                        <label>Division</label>
                        <select name="division" >
                            <option value="">-- Please Select --</option>
                            <option value="Dhaka">Dhaka</option>
                            <option value="Chittagong">Chittagong</option>
                            <option value="Rajshahi">Rajshahi</option>
                            <option value="Khulna">Khulna</option>
                            <option value="Barisal">Barisal</option>
                            <option value="Sylhet">Sylhet</option>
                            <option value="Rangpur">Rangpur</option>
                        </select>
                    </div>
                      <div class="fitem">
                        <label>District</label>
                        <select name="district">
                           <option value="">-- Please Select --</option>
                            <option value="Dhaka">Dhaka</option>
                            <option value="Chittagong">Chittagong</option>
                            <option value="Rajshahi">Rajshahi</option>
                            <option value="Khulna">Khulna</option>
                            <option value="Barisal">Barisal</option>
                            <option value="Sylhet">Sylhet</option>
                            <option value="Rangpur">Rangpur</option>
                        </select>
                      </div>
                    <div class="fitem">
                        <label>Upazila</label>
                        <select name="upazila" >
                           <option value="">-- Please Select --</option>
                            <option value="Dhaka">Dhaka</option>
                            <option value="Chittagong">Chittagong</option>
                            <option value="Rajshahi">Rajshahi</option>
                            <option value="Khulna">Khulna</option>
                            <option value="Barisal">Barisal</option>
                            <option value="Sylhet">Sylhet</option>
                            <option value="Rangpur">Rangpur</option>
                        </select>
                    </div>
                    <div class="fitem">
				<label>Phone</label>
				<input name="phone" class="easyui-textbox" >
			</div>
                    <div class="fitem">
				<label>Email</label>
				<input name="email" class="easyui-textbox" >
			</div>
                    <div class="fitem">
				<label>Fax</label>
				<input name="fax" class="easyui-textbox" >
			</div>
                    <div class="fitem">
				<label>Website</label>
				<input name="website" class="easyui-textbox">
                    </div>
		</form>
            <!-- Form End --> 
	</div>
<!-- Reference Name Form Window-Layout Start -->
<div id="reference" class="easyui-dialog" style="width:700px;height:550px; padding:2px 2px;"
			closed="true" buttons="#reference_south_buttons">
    <div class="easyui-layout" fit="true"  id="profile_layout" >
       
        
        <div data-options=" region:'west',split:'true',title:' ' " style="width:150px; padding:3px;">
            <li><a href="#">Order Now</a></li>
        </div>
        <div data-options=" region:'center', split:'true', title:'Add New Reference', iconCls:'icon-ok' " style="padding:5px;">
            <form id="reference_form" method="post" novalidate="">
                <div class="fitem">
				<label>Name</label>
				<input name="ref_name" class="easyui-textbox" required="true">
                </div>
                <div class="fitem">
				<label>Village/House No</label>
				<input name="ref_address" class="easyui-textbox" required="true">
                </div>
            <div class="fitem">
                <label>Division</label>
                <select  name="ref_division" id="country" onChange="getState(this.value)" required="required">
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
                <div id="statediv">
                    <label>District</label>
                    <select name="district" class="district" >
                        <option value="">Select Division First</option>
                    </select>
                </div>
            </div>
            <div class="fitem">
                <div id="citydiv">
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

</div> <!-- Reference dialogbox End. -->


<!-- Individual Profile dialog-Layout Start -->
<div id="profile" class="easyui-dialog" style="width:900px;height:650px; padding:2px 2px;"
			closed="true" buttons="#south_buttons">
    <div class="easyui-layout" fit="true"  id="profile_layout" >
       
        
        <div data-options=" region:'west',split:'true',title:' ' " style="width:150px; padding:3px;">
            <!-- <li><a href="#">Order Now</a></li> -->
        </div>
        <div data-options=" region:'center', split:'true', title:'Profile', iconCls:'icon-ok' " style="padding:5px;">
            
                <table id="grid_order" title="List of Order's" class="easyui-datagrid" style="width:100%; min-height: 130px; max-height:250px;"
                   toolbar="#toolbar_order" pagination="true"
                   singleSelect="true" showFooter="true" fitColumn="true" >
                <thead>
                    <tr>
                    
                    
                    </tr>

                </thead>

            </table>


              <p id="demo"></p>
        </div>
        
         
    </div>

</div>
<!-- south_buttons start for reference form -->
<div id="reference_south_buttons">
    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveReference()" >Save</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#reference').dialog('close')" >Close</a>
</div>

<!-- south_buttons start for invidual profile -->
             <div id="south_buttons">
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#profile').dialog('close')" style="width:90px">Close</a>
            </div>
<!-- dlg botton Start-->
	<div id="dlg-buttons">
		<a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveUser()" style="width:90px">Save</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Cancel</a>
	</div>
       
<script>
          function profile(){
              var row=$('#dg').datagrid('getSelected');
              if(row){

                    $('#grid_order').datagrid({
                url: 'reference_profile/get_order.php?q=' + row.cust_id

                    });// grid_order individual data load.
                  $('#profile').dialog('open').dialog('setTitle','Transaction of '+row.ref_name);
                 
                     $.ajax({
                            url:'pages/display_individual_profile_reference.php?q=' + row.ref_id,
                            success: function(data){
                            $('#demo').html(data);
                            }
                        });

                    }
              else{
                  $.messager.alert('Message',"Please select Atlease one item.",'Info');
              }
              
			
			//$('#fm').form('clear');
			//url = 'save_user.php';
                    
		}
                
                $('#ref_name').change(function(){
                    var ref_name=$('#ref_name').val();
                   if(ref_name==='addNew'){
                       $('#reference').dialog('open').dialog('setTitle','test');
                   } 
                });
    </script>
    <script type="text/javascript">
               
                $('#txtsearch').textbox({
               
                    iconCls:'icon-man',
                    iconAlign:'left',
                    width:'100'
                    
                    });
    
		var url;
		function newReference(){
			$('#reference').dialog('open').dialog('setTitle','New Reference Information');
			$('#reference_form').form('clear');
			url = 'reference_profile/save_user.php';
		}
                
		function editUser(){
                   
               var row = $('#dg').datagrid('getSelected');
               
			if (row){
				$('#reference').dialog('open').dialog('setTitle','Edit Reference');
				$('#reference_form').form('load',row);
                $('select.district').append('<option value="' + row.id + '" selected="selected" >' + row.statename + '</option>');
                $('select.ref_upazila').append('<option  value="' + row.ref_upazila + '" selected="selected">' + row.ref_upazila + '</option>');
				url = 'reference_profile/update_user.php?id='+row.ref_id;
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
                
		function saveReference(){
			$('#reference_form').form('submit',{
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
						$('#reference').dialog('close');		// close the dialog
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
						$.post('reference_profile/destroy_user.php',{id:row.ref_id},function(result){
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
				itemid: $('#cust_id').val(),
				productid: $('#txtsearch').val()
			});
                 
		}
         
// Start Ajax City District Thana select

        function getXMLHTTP() { //fuction to return the xml http object
        var xmlhttp = false;
        try {
            xmlhttp = new XMLHttpRequest();
        }
        catch (e) {
            try {
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            catch (e) {
                try {
                    xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
                }
                catch (e1) {
                    xmlhttp = false;
                }
            }
        }

        return xmlhttp;
    }



    function getState(countryId) {

        var strURL = "pages/findState.php?country=" + countryId;
        var req = getXMLHTTP();

        if (req) {

            req.onreadystatechange = function () {
                if (req.readyState == 4) {
                    // only if "OK"
                    if (req.status == 200) {
                        document.getElementById('statediv').innerHTML = req.responseText;

                    } else {
                        alert("There was a problem while using XMLHTTP:\n" + req.statusText);
                    }
                }
            }
            req.open("GET", strURL, true);
            req.send(null);
        }
    }
    
    function getCity(countryId, stateId) {
        var strURL = "pages/findCity.php?country=" + countryId + "&state=" + stateId;
        var req = getXMLHTTP();

        if (req) {

            req.onreadystatechange = function () {
                if (req.readyState == 4) {
                    // only if "OK"
                    if (req.status == 200) {
                        document.getElementById('citydiv').innerHTML = req.responseText;
                    } else {
                        alert("There was a problem while using XMLHTTP:\n" + req.statusText);
                    }
                }
            }
            req.open("GET", strURL, true);
            req.send(null);
        }

    }
    // END GET CITY FUNCTION
                
              
               
	</script>