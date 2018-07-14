
	
	<table id="dg" title="Clients Region" class="easyui-datagrid" style="width:auto;height:400px;"
			url="region/get_users.php"
			toolbar="#toolbar" pagination="true" data-options="iconCls:'icon-customer', remoteSort:false, multiSort:true "
			rownumbers="true" fitColumns="true" singleSelect="true">
		<thead>
			<tr>
                              <th field="thana" width="50" sortable="true">Thana / Upazilla</th>
				<th field="district" width="50" sortable="true">District</th>
                            <th field="division" width="50" sortable="true">Division</th>
				
			</tr>
		</thead>
	</table>
	<div id="toolbar">
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newDistrict()">Manage District</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="dlgLayout()">Manage Thana/Upazilla</a>
<!--		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editUser()">Edit User</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyUser()">Remove User</a>-->
	</div>

<!-- Add District Start -->
	<div id="dlg_district" class="easyui-dialog" style="width:800px;height:480px;padding:10px 20px"
			closed="true" buttons="#dlg-district-buttons">
		<div class="ftitle">Add District Information</div>
		<form id="fm_district" method="post" novalidate>
			<div class="fitem">
				<label>Division:</label>
                                <select  name="division" id="country" onChange="getState(this.value)" width="300">
                            <option value="">Select Division</option>
                            <option value="1">Dhaka</option>
                            <option value="2">Chittagong</option>
                            <option value="3">Rajshahi</option>
                            <option value="4">Khulna</option>
                            <option value="5">Barisal</option>
                            <option value="6">Sylhet</option>
                            <option value="7">Rangpur</option>
                            <option value="8">Mymensing</option>
                        </select>
                                
			</div>
			<div class="fitem">
				<label>District:</label>
				<input name="district" class="easyui-textbox">
			</div>
			
		</form>
	</div>
	<div id="dlg-district-buttons">
		<a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveDistrict()" style="width:90px">Save</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg_district').dialog('close')" style="width:90px">Cancel</a>
	</div>
<!-- ********** End Add District Start ************** -->


<!-- Start Thana / Upazilla -->
	
             <div id="dlg_layout" class="easyui-dialog" style="width:800px;height:600px;"
			closed="true" buttons="#dlg-buttons">
                 <div class="easyui-layout" fit="true"  id="profile_layout" >

        <!--        <div data-options="region:'north',split:'true'" style="width:700px; height: 45px; padding:5px 20px;">
                    <a href="javascript:void(0)"  class="easyui-linkbutton" iconCls="icon-order_color" onclick="order_individual()" style="width:80px; background: #F1F1F1;">Order</a>
                    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-invoice_color" onclick="invoice_individual()"  style="width:80px; background: #F1F1F1;">Invoice</a>
                    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-bill" onclick="bill_individual()" style="width:80px; background: #F1F1F1;">Bill</a>
                </div>-->
<!--        
 <div data-options=" region:'west',split:'true',title:' ' " style="width:80px; padding:3px;">
        </div>
         -->
        <div data-options=" region:'center', split:'true', iconCls:'icon-ok' " style="padding:5px;width:800px; height:600px;">

            <table id="grid_sub_district" title="List of All Sub-Districts" class="easyui-datagrid" style="width:100%; min-height: 300px; max-height:400px;"
                   toolbar="#toolbar_sub_district" pagination="true"
                   singleSelect="true" showFooter="true" rownumbers="true" fitColumn="true"  url="region/sub_district_search.php" >
                <thead>
                    <tr>
                         <th data-options="field:'ck',checkbox:true " ></th>
                         <th field="id" width="auto">Sub-District Id</th>
                        <th field="city" width="auto">Sub-District</th>
                        <th field="statename"> District </th>
                         <th field="country" width="100" sortable="true" data-options="align:'right' ">Division</th>
                    
                    </tr>

                </thead>

            </table>



        </div>


    </div>
             </div>

             <div id="dlg" class="easyui-dialog" style="width:500px;height:350px;"
			closed="true" buttons="#dlg-buttons">     
		
		<form id="fm" method="post" novalidate>
			<div class="fitem">
				<label>Division:</label>
                                <select  name="division" id="country" class="division" onChange="getState(this.value)" width="300">
                            <option value="">Select Division</option>
                            <option value="1">Dhaka</option>
                            <option value="2">Chittagong</option>
                            <option value="3">Rajshahi</option>
                            <option value="4">Khulna</option>
                            <option value="5">Barisal</option>
                            <option value="6">Sylhet</option>
                            <option value="7">Rangpur</option>
                             <option value="8">Mymensing</option>
                        </select>
                                
			</div>
			<div class="fitem">
				<div id="statediv">
                            <label>District</label>
                            <select name="district" class="district"  >
                                <option value="">Select Division First</option>
                            </select>
                                </div>
			</div>
			<div class="fitem">
				<label>Enter New Thana/Sub-District Name:</label>
				<input name="city" class="easyui-textbox">
			</div>
                  
			<div id="citydiv"></div>
                  
		</form>
                
	</div>
	<div id="dlg-buttons">
		<a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveUser()" style="width:90px">Save</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Cancel</a>
	</div>

<div id="toolbar_sub_district">
    <a href="javascript:void(0)"  class="easyui-linkbutton" iconCls="icon-add" plain="false" onclick="newUser()" >New Sub-District</a>

    <?php
    if ($_SESSION['s_email'] == 'admin@dailyasianage.com' || $_SESSION['s_email'] == 'superadmin@dailyasianage.com') {
        ?>
        <a href="javascript:void(0)" class="easyui-linkbutton" id="edt_order" iconCls="icon-edit" plain="false" onclick="editSubDistrict()">Edit Sub-District </a>
<!--        <a href="javascript:void(0)" class="easyui-linkbutton" id="cnl_order" iconCls="icon-remove" plain="false" onclick="destroySubDistrict()">Destroy Sub-District </a>-->

        <?php
    }
    ?>

    <!--        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls='icon-tip' plain='true' onclick="detailsView()">Details</a>-->
    <span style="float: right;"><input type="text" name="txtsearch"  id="txtsearch" placeholder="Search By Sub-District name" >
        <a href="#" class="easyui-linkbutton" plain="false" iconCls="icon-search" onclick="doSearch()" title="Search By Sub-District name" >Search</a>
    </span>
</div>
             
             

	
<!-- End Thana / Upazilla -->

	<script type="text/javascript">
            
                $('#txtsearch').textbox({
                     iconCls: 'icon-region',
                     iconAlign: 'left',
                     width: '100'
    });
       // For Search Function
    function doSearch() {
        $('#grid_sub_district').datagrid('load', {
            productid: $('#txtsearch').val()
        });

    }
    
            function dlgLayout(){
			$('#dlg_layout').dialog('open').dialog('setTitle','Sub-District');
		}
                
		var url;
		function newUser(){
			$('#dlg').dialog('open').dialog('setTitle','Add new Sub-district');
			$('#fm').form('clear');
			url = 'region/save_user.php';
		}
		function editSubDistrict(){
			var row = $('#grid_sub_district').datagrid('getSelected');

			if (row){
				$('#dlg').dialog('open').dialog('setTitle','Edit Sub-district');
				$('#fm').form('load',row);
				url = 'region/update_sub_district.php?id='+row.id;
                                            $('select.division').append('<option value="' + row.countryid + '" selected="selected" >' + row.country + '</option>');
                                             $('select.district').append('<option value="' + row.stateid + '" selected="selected" >' + row.statename + '</option>');
			}else {
            $.messager.show({
                title: 'Message',
                msg: 'Please select atleast one row to Edit.',
                showType: 'show'
            });
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
                                                $('#grid_sub_district').datagrid('reload');
					}
				}
			});
		}
		function destroySubDistrict(){
			var row = $('#grid_sub_district').datagrid('getSelected');
			if (row){
				$.messager.confirm('Confirm','Are you sure you want to destroy this user?',function(r){
					if (r){
						$.post('region/destroy_sub_district.php',{id:row.id},function(result){
							if (result.success){
								$('#grid_sub_district').datagrid('reload');	// reload the user data
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
		}
                
                // End Thana
                 var url_district;
                function newDistrict(){
			$('#dlg_district').dialog('open').dialog('setTitle','New District');
			$('#fm_district').form('clear');
			url_district = 'region/save_district.php';
		}
                
                	function saveDistrict(){
			$('#fm_district').form('submit',{
				url: url_district,
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
						$('#dlg_district').dialog('close');		// close the dialog
						$('#dg').datagrid('reload');	// reload the user data
					}
				}
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
        <!-- ****************** For Tripple Combo ******************** -->
        
        <script language="javascript" type="text/javascript">
// Roshan's Ajax dropdown code with php
// This notice must stay intact for legal use
// Copyright reserved to Roshan Bhattarai - nepaliboy007@yahoo.com
// If you have any problem contact me at http://roshanbh.com.np
function getXMLHTTP() { //fuction to return the xml http object
		var xmlhttp=false;	
		try{
			xmlhttp=new XMLHttpRequest();
		}
		catch(e)	{		
			try{			
				xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(e){
				try{
				xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
				}
				catch(e1){
					xmlhttp=false;
				}
			}
		}
		 	
		return xmlhttp;
    }
	
	
	
	function getState(countryId) {		
		
		var strURL="pages/findState.php?country="+countryId;
		var req = getXMLHTTP();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById('statediv').innerHTML=req.responseText;	
                                                
					} else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}		
	}
	function getCity(countryId,stateId) {		
		var strURL="pages/show_thana.php?country="+countryId+"&state="+stateId;
		var req = getXMLHTTP();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
                                        //  alert(req.status);
					if (req.status == 200) {						
						document.getElementById('citydiv').innerHTML=req.responseText;	
                                            
					} else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}
				
	}
</script>
</body>
</html>