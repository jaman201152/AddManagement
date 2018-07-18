
<table id="dg" title="List of all references" class="easyui-datagrid" style="width:auto; max-height:450px; overflow: scroll; min-height: 500px;"
       data-options="iconCls:'icon-customer',remoteSort:false, multiSort:true " url="reference_profile/member_search.php"
       toolbar="#toolbar" pagination="false"
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
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="false" onclick="newReference()">New Reference </a>
    <?php
    if ($_SESSION['s_email'] == 'admin@dailyasianage.com' || $_SESSION['s_email'] == 'superadmin@dailyasianage.com') {
        ?>
        <a href="javascript:void(0)" class="easyui-linkbutton" id="edt" iconCls="icon-edit" plain="false" onclick="editUser()">Edit </a>
        <a href="javascript:void(0)" class="easyui-linkbutton" id="cnl" iconCls="icon-remove" plain="false" onclick="destroyUser()">Destroy </a>

        <?php
    }
    ?>
    <a href="javascript:void(0)" class="easyui-linkbutton" id="client_profile" iconCls="icon-profile" plain="false" onclick="profile()">Profile</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" id="customerPrint" iconCls="icon-print" plain="false" target="_blank" >Print</a>
    <span id='selected_id'></span>
    <!--        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls='icon-tip' plain='true' onclick="detailsView()">Details</a>-->
    <span style="float: right;"><input type="text"  id="txtsearch" />
        <a href="#" class="easyui-linkbutton" plain="false" iconCls="icon-search" onclick="doSearch()" >Search</a>
    </span>

</div>
<!-- End Customer tool bar -->


<div id="dlg" class="easyui-dialog" data-options="iconCls:'icon-add' " style="width:700px;height:500px;padding:10px 80px 10px 80px"
     closed="true" buttons="#dlg-buttons">
    <fieldset><legend>Customer Information</legend>
        <form id="fm" method="post" novalidate>

            <div class="fitem">
                <label>Company Name</label>
                <input name="name" id="name"  class="easyui-textbox" style="width:200px;" required="true">
                <label>Company ID</label>
                <input type="text" id="cust_id_new" name="cust_id_new" value="" readonly="readonly">
            </div>
            <div class="fitem">
                <label>Town/House No.</label>
                <input name="address" id="address" class="easyui-textbox" required="true">
            </div>

            <div class="fitem">
                <label>Type</label>
                <select name="type" required="required">
                    <option value="">-- Please Select --</option>
                    <option value="Government">Government</option>
                    <option value="Private">Private</option>
                    <option value="Multinational">Multinational</option>
                    <option value="Others">Others</option>
                </select>
            </div>
            <div class="fitem">
                <label>Company Category</label>
                <select name="project_name" required="required">
                    <option value="">-- Please Select --</option>
                    <option value="Apparel_Garment">Apparel/Garment</option>
                    <option value="Bank">Bank</option>
                    <option value="Real_State">Real State</option>
                    <option value="Insurance">Insurance</option>
                    <option value="Industry">Industry</option>
                    <option value="Electronics">Electronics</option>
                    <option value="Pharmaceutical">Pharmaceutical</option>
                    <option value="Telecommunication">Telecommunication</option>
                    <option value="Group_of_Companies">Group of Companies</option>
                    <option value="Others">Others</option>
                </select>
            </div>
            <div class="fitem" >
                <label>Reference Name</label>
                <select name="ref_id" id="ref_name" required="required">
                    <option value="">-- Please Select --</option>
                    <option value="addNew">Add New</option>
                    <?php
                    include 'conn.php';
                    $query_ref = $con->prepare("Select ref_id, ref_name,ref_upazila from tbl_reference group by ref_name");
                    $query_ref->execute();
                    while ($row_ref = $query_ref->fetch(PDO::FETCH_ASSOC)) {
                        extract($row_ref);
                        ?>
                        <option value="<?php echo $ref_id; ?>"><?php echo $ref_name.' - '.$ref_upazila; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
            <div class="fitem">
                <label>Date</label>
                <input name="join_date" id="join_date" class="easyui-datebox">
                (M-d-Y)
            </div>
            <div class="fitem">
                <label>Division</label>
                <select  name="division" id="country" onChange="getState(this.value)" required="required">
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
                    <select name="upazila" class="upazila">
                        <option value="">Select District First</option>
                    </select></div>
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
                <label>Web site</label>
                <input name="website" class="easyui-textbox">
            </div>
        </form>
    </fieldset>
    <!-- Form End --> 
</div>
<!-- Reference Name Form Window-Layout Start -->
<div id="reference" class="easyui-dialog" style="width:600px;height:500px; padding:2px 2px;"
     closed="true" buttons="#reference_south_buttons">
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

</div> <!-- Reference dialogbox End. -->


<!-- Individual Profile dialog-Layout Start -->
<div id="profile" class="easyui-dialog" style="width:1024px;height:600px; padding:2px 2px;"
     data-options="iconCls:'icon-profile' " closed="true" buttons="#south_buttons">
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
        <div data-options=" region:'center', split:'true', iconCls:'icon-ok' " style="padding:5px;width:750px; height:550px;">

            <table id="grid_order" title="List of All Order's on Individual Reference" class="easyui-datagrid" style="width:100%; min-height: 130px; max-height:250px;"
                   toolbar="#toolbar_order" pagination="true"
                   singleSelect="true" showFooter="true" fitColumn="true" >
                <thead>
                    <tr>
                        <th data-options="field:'ck',checkbox:true "></th>
                        <th field="order_id" width="auto" title="Order ID" >O. ID.</th>
                        <th field="order_date" width="auto">O. Date</th>
                        <th field="item" width="auto">Item</th>
<!--                        <th data-options="field:'status',align:'center',formatter:formatStatus ">Inv. Status</th>-->
                        <th field="size"> Size </th>
                        <th field="price" data-options="align:'right' " width="auto">Price</th>
                    <th field="discount" width="auto" data-options="align:'right' ">Dis(%)</th>
                        <th field="discount_amount" width="auto" data-options="align:'right' ">Dis Amt.</th>
                        <th field="payable_amount" width="auto" data-options="align:'right' ">Receivable Amt.</th>
                        <th field="vat" width="auto" data-options="align:'right' ">VAT(%)</th>
                        <th field="tax" width="auto" data-options="align:'right' ">TAX(%)</th>
                        <th field="ref_name" width="auto">Ref. Name</th>
                    </tr>

                </thead>

            </table>

            <br/>
            <li>
                <a href="javascript:void(0)" class="easyui-linkbutton" id="indcustomerPrint" iconCls="icon-print" plain="false" >Print Reference Info</a>
                <a href="javascript:void(0)" class="easyui-linkbutton" id="orderPrint" iconCls="icon-print" plain="false" target="_blank" >Print Order Info</a>
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-home" plain="false" onclick="details_company()" >Reference Details</a>
            </li>
<!--                        <div id="individual_order" ></div>-->
            <p id="demo" style="max-height:300px; overflow-y: scroll; "></p>


        </div>


    </div>

</div>
<!-- Individual Profile Dialog-Layout End -->

<!-- Order dialog Start -->
<div id="order_individual" class="easyui-dialog" style="width:900px;height:450px; padding:2px 2px;"
     closed="true" buttons="#order_south_buttons" data-options="iconCls:'icon-order_color' ">
    <div class="easyui-layout" fit="true"  id="order_layout" >

        <div data-options=" region:'center', split:'true', title:'Order form' " style="padding:10px 20px">
            <form id="order_form" method="post" novalidate>
                <div class="fitem" style="background: #F1F1F1;">

                    <label>Company Name: </label>
         <input name="cust_id"  class="easyui-combobox cust_id" id="cust_id" style="text-align: right; padding: 2px; width:250px; "  autocomplete="off" required="required" /> &nbsp;&nbsp;&nbsp;
         <input type="hidden" name="cust_id_new"  class="cust_id_new" id="cust_id_new" style="text-align: right; padding: 2px;" complete="off" required="required" /> &nbsp;&nbsp;&nbsp;
         <input type="hidden" name="name" class="name" value="" />     

                </div>
                <br/>
                <div class="fitem hidden_custom">
                    &nbsp;&nbsp;&nbsp;<label>Type </label><select name="type" id="txttype" style="width:150px; ">
                        <option value=""></option>
                        <option value="Government">Government</option>
                        <option value="Private">Private</option>
                        <option value="Multinational">Multinational</option>
                    </select>
                </div>
                <div class="fitem hidden_custom">
                    &nbsp;&nbsp;&nbsp;<label>Company Category</label><select name="project_name"  class="txtproject_name" style="width:150px; " >
                        <option value=""></option>

                        <option value="Apparel_Garment">Apparel/Garment</option>
                        <option value="Bank">Bank</option>
                        <option value="Real_State">Real State</option>
                        <option value="Insurance">Insurance</option>
                        <option value="Industry">Industry</option>
                        <option value="Electronics">Electronics</option>
                        <option value="Pharmaceutical">Pharmaceutical</option>
                        <option value="Telecommunication">Telecommunication</option>
                        <option value="Technology">Technology</option>
                        <option value="News_Paper">News Paper</option>
                        <option value="Group_of_Companies">Group of Companies</option>
                        <option value="Information_Technology">Information Technology</option>
                        <option value="Others">Others</option>
                    </select>
                </div>

                <div class="fitem">
                    &nbsp;&nbsp;&nbsp;<label>Reference Name</label><select name="ref_id" class="txtref_name" style="width:150px; ">
                        <option value=""></option>
                        <?php
                        $query_ref_order = $con->prepare("Select ref_id,ref_name,ref_upazila from tbl_reference group by ref_name ");
                        $query_ref_order->execute();
                        while ($row_ref_order = $query_ref_order->fetch(PDO::FETCH_ASSOC)) {
                            extract($row_ref_order);
                            ?>
                            <option value="<?php echo $ref_id; ?>"><?php echo $ref_name.' - '.$ref_upazila; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="fitem">
                    <br/>
                    &nbsp;&nbsp;&nbsp;<label>Work Order No</label><input name="work_order_no" class="easyui-textbox" id="work_order_no" required="required" style="width: 150px;">

                </div>
                <div class="fitem">
                    &nbsp;&nbsp;&nbsp;<br/><br/>
                    <label>Order Date:</label>
                    <input name="order_date" id="order_date" class="easyui-datetimebox" required="required" />
                </div>
                <br/><br/>
                <div class="fitem">
                    <table width='100%' class="table_order">
                    <tbody>
                        <tr style="background: #F1F1F1;"><td>Item</td><td>Description</td><td>Row</td><td>Column</td>
                            <td title="Quantity">Qty</td><td>Unit Price</td><td>Price</td><td title="Discount">Dis.(%)</td>
                            <td title="Discount Amount">Dis. Amt.</td><td title="Payable Amount">Receivable Amt.</td><td>VAT(%)</td><td>TAX(%)</td></tr>
                        <tr style="background: #F1F1F1;">
                            <td>
                            <select name="item" class="item" style="width:80px;">
                                <option value="Advertisement"> Advertisement </option>
                                <option value="others"> Others </option>
                            </select>
                        </td>
                        <td><input type="text" class="description" name="description" style="width:120px;"></td>
                        <td><input type="text" name="row" class="row" style="width:25px;" autocomplete="off"></td>
                        <td><input type="text" name="column" class="column" style="width:30px;" autocomplete="off"></td>
                            <td><input type="text" name="qty" class="qty" style="width:50px;" id="qty" ></td><td><input type="text" name="unit_price" id="unit_price" style="width:50px;" required="required" autocomplete="off"></td>
                            <td><input type="text" name="price" id="price" style="width:50px;" required="required" autocomplete="off" readonly="readonly"></td>
                            <td><input type="text" name="discount" id="discount" style="width:50px;" autocomplete="off" required="required"> </td>
                            <td><input type="text" name="discount_amount" id="discount_amount" style="width: 50px;" autocomplete="off" required="required" readonly="readonly"></td>
                            <td>
                                <input type="text" name="payable_amount" id="payable_amount" style="width:100px;" required="required" readonly="readonly">

                                <input type="hidden" name="status" id="order_status" value="Invoice">
                            </td>
                            <td> <input type="text" name="vat" id="vat" value="0" style="width:50px;" required="required"></td>
                            <td> <input type="text" name="tax" id="tax" value="0" style="width:50px;" required="required"></td>
                        </tr>
    </tbody>
                    </table>    
                </div>
            </form>
        </div>

    </div>
</div> <!-- Order dialogBox End. -->



<div id="toolbar_order">
<!--    <a href="javascript:void(0)"  class="easyui-linkbutton" iconCls="icon-add" plain="false" onclick="order_individual()" >New Order</a>-->
<!--     <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-invoice_color"  plain="false" onclick="invoice()">Create Invoice</a> -->

    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-bill" plain="false" onclick="IndividualAllInvoice()">Payment / Bill </a>

 <!--    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ereceipt" plain="false" onclick="IndividualAllEReceipt()">E-Receipt</a> -->





    <?php
    if ($_SESSION['s_email'] == 'admin@dailyasianage.com' || $_SESSION['s_email'] == 'superadmin@dailyasianage.com') {
        ?>
        <a href="javascript:void(0)" class="easyui-linkbutton" id="edt_order" iconCls="icon-edit" plain="false" onclick="editOrder()">Edit Order </a>
        <a href="javascript:void(0)" class="easyui-linkbutton" id="cnl_order" iconCls="icon-remove" plain="false" onclick="destroyOrder()">Destroy Order </a>

        <?php
    }
    ?>



    <!--        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls='icon-tip' plain='true' onclick="detailsView()">Details</a>-->
    <span style="float: right;"><input type="text" name="txtsearch_order"  id="txtsearch_order" placeholder="Search By Order Id" >
        <a href="#" class="easyui-linkbutton" plain="false" iconCls="icon-search" onclick="doSearch_order()" title="Search by Order Id." >Search</a>
    </span>
</div>
<!-- south_buttons start for Order form -->
<div id="order_south_buttons">

    <a href="javascript:void(0)" class="easyui-linkbutton c6" id="s_update" iconCls="icon-ok" onclick="saveOrder()" >Save</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#order_individual').dialog('close')" >Close</a>
</div>
<!-- south_buttons start for Order form -->

<!-- south_buttons start for reference form -->
<div id="reference_south_buttons">
    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveReference()" >Save</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#reference').dialog('close')" >Close</a>
</div>
<!-- south_buttons start for invidual profile -->
<div id="south_buttons">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#profile').dialog('close')" >Close</a>
</div>
<!-- dlg botton Start-->
<div id="dlg-buttons">
    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveUser()" style="width:90px">Save</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')" >Cancel</a>
</div>

<!-- ******************* Start Invoice Form ***************** -->
<div id="dg_invoice_form" class="easyui-dialog" title="Create Invoices"  style="width:900px;height:500px;padding:10px"
     data-options="iconCls:'icon-invoice_color' "  toolbar="#dlg-toolbar_invoice" buttons="#dlg-buttons-invoice" closed="true" >
    <div class="easyui-layout" fit="true">
        <!-- east Region Start-->
        <!--      <div data-options="region:'east',split:'true' " title="History" style="width:180px;height:400px;">
        <?php
        include 'Menu/display_invoice_right_menu.php';
        ?>
              </div>-->
        <!-- **************** east Region End ***********************-->

        <div data-options=" region:'center',split:'true'  " border="false">

            <form method="POST" name="form2" id="invoice_form">
                <table style="border-collapse:collapse;" width="100%">

                    <tr style="background:#f1f1f1;">

                        <td>
                            <label>Customer ID. </label>
                            <input type="text" name="cust_id_new" id="cust_id_new"  class="cust_id_new" style="text-align: right; padding: 2px; width: 120px;" readonly="readonly" /> &nbsp;&nbsp;&nbsp;
                            <input type="hidden" name="cust_id" id="cust_id"  class="cust_id" style="text-align: right; padding: 2px; width: 50px;" /> &nbsp;&nbsp;&nbsp;

                            <label>Order ID. </label><input type="text" name="order_id" style="width:50px;text-align: right;" readonly="readonly" /><!-- order_id value auto load when form load. -->

                        </td><td width="50">&nbsp;</td>
                        <td>
                            <label>Order Date:</label>
                            <input name="order_date" readonly="readonly"  />
                        </td><td width="50">&nbsp;</td>
                        <td>

                        </td>
                    </tr>
                    <tr>
                        <td colspan="5">&nbsp;</td>
                    </tr>
                </table>
                <table width='100%'>
                    <tr>
                        <td>
                            <div class="easyui-panel" title="Work Order No" style="width:160px; height:55px;">
                                <input class="easyui-textbox" name="work_order_no" id="work_order_no" required="required"></input>
                            </div>
                        </td>
                        <td>
                            <div class="easyui-panel" title="Published Date" style="width:160px; height:55px;">
                                <input class="easyui-datetimebox" name="pub_date" id="pub_date" required="required"></input>
                            </div> 
                        </td>
                        <td>
                            <div class="easyui-panel" title="Invoice Date" style="width:160px; height:55px;">
                                <input class="easyui-datetimebox" name="invoice_date" id="invoice_date" required="required"></input>
                            </div> 

                        </td>
                        <td>

                        </td>

                    </tr>
                    <tr>
                        <td><div style="font-weight: 700; color: #ccc;">Invoice</div>
                            <div class="easyui-panel" title="Bill To" style="width:300px; height: 200px;">
                                <table>
                                    <tr>
                                        <td>Company Name:</td><td><input class="easyui-textbox" name="name" style="width:auto;"></td>
                                    </tr>
                                    <tr>
                                        <td>Reference Name:</td><td>
                                            <select name="ref_id" class="txtref_name">
                                                        <?php
                        $query_ref_order = $con->prepare("Select ref_id,ref_name,ref_upazila from tbl_reference group by ref_name ");
                        $query_ref_order->execute();
                        while ($row_ref_order = $query_ref_order->fetch(PDO::FETCH_ASSOC)) {
                            extract($row_ref_order);
                            ?>
                            <option value="<?php echo $ref_id; ?>"><?php echo $ref_name.' - '.$ref_upazila; ?></option>
                            <?php
                        }
                        ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Address:</td><td><input class="easyui-textbox" name="address" style="width:auto;"></td>
                                    </tr>
                                    <tr>
                                        <td>Phone:</td><td><input class="easyui-textbox" name="phone" style="width:auto;"></td>
                                    </tr>
                                    <tr>
                                        <td>Email:</td><td><input class="easyui-textbox" name="email" style="width:auto;"></td>
                                    </tr>
                                    <tr>
                                        <td>Fax:</td><td><input class="easyui-textbox" name="fax" style="width:auto;"></td>
                                    </tr>
                                </table>
                            </div>
                        </td>

                    </tr>

                </table>
                <br/>


                <table width='100%' style="border-collapse: collapse; padding: 10px; margin:0;  ">
                    <tr style="background: #f1f1f1; font-weight: 700; ">
                        <td>Item</td>
                        <td>Description</td>
                        <td>Row</td>
                        <td>Column</td>
                        <td>Qty</td>
                        <td>Unit Price</td>
                        <td>Price</td>
                        <td>Dis (%)</td>
                        <td>Dis At</td>
                        <td>Receivable Amt</td>
                        <td>VAT(%)</td>
                        <td>TAX(%)</td>
                    </tr>
                    <tr style="background: #f1f1f1;  ">
                        <td>
                            <select class="easyui-combobox" name="item" style="width:100px;">
                                <option>test1</option>
                                <option>test2</option>
                            </select>
                        </td>
                        <td> <textarea style="width:120px;height:35px;resize:none" name="description"></textarea></td>
                        <td><input type="text" name="o_row" class="row" style="width:25px;" readonly="readonly"></td>
                        <td><input type="text" name="o_column" class="column" style="width:30px;" readonly="readonly"></td>
                        <td> <input  name="qty"  style="width:40px;"  readonly="readonly"></td>
                        <td> <input  name="unit_price"  style="width:40px;"  readonly="readonly"></td>

                        <td> <input  name="price"  style="width:40px;" readonly="readonly"></td>
                        <td> <input  name="discount"  style="width:40px;"  readonly="readonly"> </td>
                        <td>
                            <input name="discount_amount" style="width: 40px;"  readonly="readonly">
                            <input name="ait_others_discount" type="hidden" value="0" >
                        </td>

                        <td> <input  name="payable_amount"  style="width:40px;"  readonly="readonly"></td>
                        <td> <input  name="vat" value="0"  style="width:40px;"></td>
                        <td> <input  name="tax" value="0"  style="width:40px;" ></td>

                    </tr>
                </table>




            </form>

        </div>
        <div region="south" border="false" style="text-align:right;height:30px;line-height:30px;">

        </div>


    </div> <!-- layout End -->

</div><!-- Invoice Form dialog end -->

<div id="dlg-buttons-invoice">
    <a href="#" class="easyui-linkbutton" iconCls="icon-save" onclick="saveInvoice();">Save</a>
    <a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dg_invoice_form').dialog('close')">Close</a>
</div>
<!-- End Invoice dlg buttons and All -->



<!-- *************************** For all Individual invoices ********************* -->

<div class="easyui-dialog" id="dlg_ind_all_invoices" data-options="iconCls:'icon-invoice_color' " style="width: 78%; height: 90%" closed='true' buttons='#dg_button_ind_all_invoice'>
    <div class="easyui-layout" data-options="region:'center' " >

        <table class="easyui-datagrid" id="dg_ind_all_invoices" pagination='false' showFooter='true' 
               singleSelect="true" rownumbers='true' toolbar='#dg_toolbar_ind_all_invoice' 
               sortName="order_id" sortOrder="desc"
               style="width:auto; height: 250px;">
            <thead>
                <tr>
                    <th data-options="field:'ck',checkbox:true "></th>
                    <th field="order_id" sortable="true">O. Id</th>
                    <th field='payment_id'>Payment. Id.</th>
                    <th field='payment_date' sortable="true">Payment. Date</th>
                    <th data-options="field:'payable_amount',align:'right' ">Receivable Amount</th>
                    <th data-options="field:'receive_amount',align:'right' ">Received Amount</th>
                    <th data-options="field:'commission',align:'right' ">Commission (%)</th>
                    <th data-options="field:'commission_amount',align:'right' ">Commission Amount</th>
                    
                    <th data-options="field:'due',align:'right',formatter:formatPrice">Due Amt.</th>
                    <th field="status" data-options="sortable:'true' "> Status</th>
                </tr>
            </thead>
        </table>
        <br/>

        &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
        <a href="javascript:void()" iconCls="icon-bill" class="easyui-linkbutton" onclick="loadPayment()">All Payments</a>

        <div id="individual_payment" style="max-height: 200px;">
            -- Click the above to see all transaction of this selected Reference --
        </div>
        <div class="easyui-dialog" id="dlg_payment_form" closed="true"  data-options="iconCls:'icon-bill' " 
             style="padding:5px; width:700px; height: 600px; " buttons="#dlg-buttons-payment" >
            <form name="receive_payment_form" id="receive_payment_form" method="POST">
                <h2 style="color:#555;">Reference Payment
                    <span style="float: right; color:#666;">
                        <label>Invoice ID # </label>
                        <input class="easyui-textbox" name="invoice_id" style="width:100px; border:1px #ccc solid;" readonly="readonly" />
                        Order Id # <input type="text" name="order_id" style="width:100px; border:1px #ccc solid;"  readonly="readonly"  />
                    </span>
                </h2>
                <table width='100%' cellpadding='5'>
                    <tr>
                        <td>Payment To</td><td>
                            <input class="easyui-textbox" style="width: 200px;" name="ref_name" id="name" />
                            <input type="hidden"  style="width: 150px;" name="cust_id" id="cust_id" />  
                            <input type="hidden"  style="width: 150px;" name="cust_id_new" id="cust_id_new" /> 
                        </td>
                        <td style="text-align: right;">
                            Collection Amount: <br/>
                            Commission (%):  <br/><br/>
                            Commission Amount:<br/>
                            Invoice Amount (After Commission):
                        </td>
                        <td>
                            <input class="easyui-textbox" name="receive_amount" id="txtprice" style="margin:3px;" /><br/>
                            <input class="easyui-textbox" name="commission" id="txtdiscount" style="margin:3px;" /><br/>
                            <input type="text" name="discount_amt" id="txtdiscount_amt" style="  width: 100px; padding: 2px; line-height: 18px;  border-radius: 5px; border:1px #ccc solid;" value=""  /><br/>
                            <input  type="text"  name="order_price" id="order_price" style="  width: 100px; padding: 2px; line-height: 15px;  border-radius: 5px; border:1px #ccc solid;" /></td>
                    </tr>
                    <tr>
                        <td> Amount</td><td><input type="text"  name="receive_amount" id="receive_amount" style=" font-weight: bold; width: 100px; padding: 2px; line-height: 18px; text-align: right;  border-radius: 5px; border:1px #ccc solid;"  required="required" autocomplete="off"/></td>
                        <td style="text-align: right;">Paid Amount</td><td><input type="text" name="paid_amount" id="paid_amount" style="  width: 100px; padding: 2px; line-height: 18px;  border-radius: 5px; border:1px #ccc solid;"/></td>
                    </tr>
                    <tr><td>Commission on Collection Amt.(%)</td>
                        <td><input type="text"  name="commission" id="commission" style=" font-weight: bold; width: 100px; padding: 2px; line-height: 18px; text-align: right;  border-radius: 5px; border:1px #ccc solid;"  required="required" autocomplete="off"/></td>
                             <td>Receivable Amount</td><td><input type="text"  name="payable_amount" id="payable_amount_p" style=" font-weight: bold; width: 100px; padding: 2px; line-height: 18px;  border-radius: 5px; border:1px #ccc solid;"  /></td>
                    </tr>
                    <tr>
                        <td>AIT and Others/ Adjustment:</td>
                        <td>
                            <input type="text"  name="ait_others_discount" id="ait_others_discount" style=" font-weight: bold; width: 100px; padding: 2px; line-height: 18px; text-align: right;  border-radius: 5px; border:1px #ccc solid;" value="0"  required="required" autocomplete="off"/>
                        </td>
                    </tr>
                    <tr>
                        <td>Payment Date</td><td><input class="easyui-datetimebox" name="payment_date" id="payment_date" /></td>
                   

                    </tr>
                    <tr>
                        <td>Pmt. Method</td><td>
                            <select class="easyui-combobox" name="payment_method" id="payment_method" style="width:150px;">
                                <option value="Cash">Cash</option>
                                <option value="Bank">Bank</option>
                            </select></td>
                        <td>Check #</td><td><input class="easyui-textbox" name="check_num" id="check_num"></input></td>
                    </tr>
                    <tr>
                        <td>Memo</td><td><input class="easyui-textbox" name="memo" id="memo"></td>
                        <td>Deposit to</td>
                        <td>
                            <select class="easyui-combobox" name="deposite_to" id="deposite_to" style="width: 150px;">
                                <option value="">-- Please Select --</option>
                                <option value="Sonali Bank Ltd">Sonali Bank</option>
                                <option value="Premier Bank">Premier Bank</option>
                                <option value="Agrani Bank Ltd">Agrani Bank Ltd.</option>
                                <option value="Dutch Bangla Bank Ltd">Dutch Bangla Bank Ltd.</option>
                                <option value="Dhaka Bank Ltd">Dhaka Bank Ltd.</option>
                            </select>
                        </td>
                    </tr>

                    <tr><td><input type="hidden" name="status_memo" id="status_memo" value=""></td><td></td><td></td><td></td></tr>
                    <tr><td></td><td></td><td></td><td></td></tr>
                </table>

                <!--                     <div id="individual_payment" style="height:150px; max-height: 160px; overflow-y: scroll;">
                                          Select Receive from field To see all transaction. 
                                     </div>-->





                <div style="width: 350px;">
                    <br/>
                    <fieldset style="border:1px #ccc solid;"><legend>Amounts for selected Invoice</legend>
                        <table>
                            <tr>
                                <td>Amount Due</td><td><input  name="due" id="due" style="width: 100px; padding: 2px 5px; line-height: 18px; text-align: right; border-radius: 5px; border:1px #ccc solid;" required="required"/></td>
                            </tr>

<!--                                 <tr>
    <td>Discount and Credits Applied</td><td><input class="easyui-textbox" name="txtdue" id="txtdue"/></td>
</tr>-->
                            <tr><td></td><td>&nbsp;</td></tr>
                        </table>
                    </fieldset>
                </div>
                <div id="dlg-buttons-payment" style="text-align: right;">
                    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-print" onclick="paymentPreview()">Print Preview</a>
                    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-save" onclick="savePayment()">Save</a>
                    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg_payment_form').dialog('close')">Close</a>


                </div>
            </form>
        </div>    

        <div id="dg_toolbar_ind_all_invoice">
            <?php
            if ($_SESSION['s_email'] === 'admin@dailyasianage.com' || $_SESSION['s_email'] === 'superadmin@dailyasianage.com') {
                ?>
                <a href="javascript:void()" class="easyui-linkbutton" iconCls="icon-bill" onclick="newPayment()" >Bill Collection</a> | 
                <?php
            }
            ?>

            <a href="javascript:void()" class="easyui-linkbutton" iconCls="icon-print" onclick="invoicePrint()" >Print Preview Selected Invoice</a>| 
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-print" onclick="allInvoicePrint()">All Invoice Print Preview</a>
            <?php
            if ($_SESSION['s_email'] === 'admin@dailyasianage.com' || $_SESSION['s_email'] === 'superadmin@dailyasianage.com') {
                ?>
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="" onclick="getAllPayments()">All E-Receipt</a>
                <?php
            }
            ?>

            <span style="float: right;"><input type="text" name="txtsearch_indi_invoice"  id="txtsearch_indi_invoice" >
                <a href="javascript:void(0)" class="easyui-linkbutton" plain="false" iconCls="icon-search" onclick="doSearch_indi_invoice()" >Search</a>
            </span>
        </div>
        <div id="dg_button_ind_all_invoice">
            <a href="javascript:void()" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg_ind_all_invoices').dialog('close')" >Close</a>

        </div>

        <!--            <div id="test">
        <?php
        include 'invoice/get_ind_all_invoices.php';
        ?>
                    </div>-->
    </div>
</div>

<!-- End Indivisul All Invoices-->

<!-- *************************** Start  For all Individual E-Receipt ********************* -->

<div class="easyui-dialog" id="dlg_ind_all_ereceipt" data-options="iconCls:'icon-invoice_color' " style="width: 78%; height: 90%" closed='true' buttons='#dg_button_ind_all_ereceipt'>
    <div class="easyui-layout" data-options="region:'center' " >

        <table class="easyui-datagrid" id="dg_ind_all_ereceipt" pagination='false' showFooter='true' 
               singleSelect="true" rownumbers='true' toolbar='#dg_toolbar_ind_all_ereceipt' 
               sortName="order_id" sortOrder="desc"
               style="width:auto; height: 250px;">
            <thead>
                <tr>
                    <th data-options="field:'ck',checkbox:true "></th>
                    <th field="memo_id" sortable="true">E_Memo Id.</th>
                    <th field='invoice_id' data-options="sortable:'true' ">Invoice ID.</th>
                    <th field='order_id' >Order Id.</th>
                    <th field='cust_id'>Cust. ID</th>
                    <th field='payment_date' sortable="true">Payment. Date</th>
                    <th data-options="field:'payable_amount',align:'right'">Receivable Amt.</th>
                    <th data-options="field:'receive_amount',align:'right' ">Receive Amt.</th>
                    <th data-options="field:'paid_amount',align:'right' ">Paid Amt.</th>
                    <th data-options="field:'due',align:'right' ,formatter:formatPrice ">Due</th>
                    <th field="status" > Status</th>
                </tr>
            </thead>
        </table>
        <br/>






        <div id="dg_toolbar_ind_all_ereceipt">

            <a href="javascript:void()" class="easyui-linkbutton" iconCls="icon-print" onclick="e_Receipt_Print()" >Print Preview Selected E-Reciept</a>
            <!--                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-print" onclick="allInvoicePrint()">All E-Reciept Print Preview</a>-->
            <!--                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="" onclick="getAllReceipt()">All E-Receipt</a>-->
            <span style="float: right;"><input type="text" name="txtsearch_indi_ereceipt"  id="txtsearch_indi_ereceipt" >
                <a href="javascript:void(0)" class="easyui-linkbutton" plain="false" iconCls="icon-search" onclick="doSearch_indi_ereceipt()" >Search</a>
            </span>
        </div>
        <div id="dg_button_ind_all_ereceipt">
            <a href="javascript:void()" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg_ind_all_ereceipt').dialog('close')" >Close</a>

        </div>

        <!--            <div id="test">
        <?php
        include 'invoice/get_ind_all_invoices.php';
        ?>
                    </div>-->
    </div>
</div>
<!-- ***************** End FOR ALL individual E- RECEIPT ****************** -->



<script type="text/javascript">


// For Order start combogird
$(function(){
            $('#cust_id').combogrid({
                panelWidth:500,
                url: 'customer_profile/get_customer_all.php',
                idField:'cust_id',
                textField:'name',
                fitColumns:true,
                editable: true,
                mode:'remote',
                columns:[[
                    {field:'cust_id',title:'Customer ID',width:60},
                    {field:'cust_id_new',title:'cust_id_new',width:80},
                    {field:'name',title:'Company Name',width:60},
                    {field:'type',title:'type',align:'right',width:60},
                    {field:'ref_name',title:'Referance Name',width:150},
                    {field:'project_name',title:'project_name',align:'center',width:60},
                    {field:'district',title:'district', align:'center'}
                ]],
                onSelect:function(record){
                   //alert(record); //this is called whn user select the combobox
                  //do your stuff here///
                  var g = $('.cust_id').combogrid('grid');   // get datagrid object
                var r = g.datagrid('getSelected');  // get the selected row
                $('.cust_id_new').val(r.cust_id_new);
                $('#txtproject_name').append('<option value="'+r.project_name+'" selected="selected">'+r.project_name+'</option>');
                $('#txttype').append('<option value="'+r.type+'" selected="selected">'+r.type+'</option>');

                 $('#txtref_name').append('<option value="'+r.ref_id+'" selected="selected">'+r.ref_id+'</option>');
                        $('#district').combobox('setValue',r.district);
                         $('#upazila').combobox('setValue',r.upazila);
                         $('.name').val(r.name);
                       $('#phone').textbox('setValue',r.phone);
                       $('#email').textbox('setValue',r.email);
                       
                       
            },
            onChange:function(value){
               var gettext = value;
               $('.name').val(gettext); // For new customer name writting
                var dt = new Date();
                var time = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();

                                 var str = "", abbr = "";
                str = value;
                str = str.split(' ');
                var length = str.length - 1;
                for (i = 0; i < str.length; i++) {
                    //abbr = str[i].substr(0,1);
                    abbr = str[0].substr(0,1) + str[length].substr(0,1); // this will take first character of first word and last word
                 $('#cust_id_new').val(abbr+'-'+dt.getFullYear().toString().substr(2,2)+dt.getMonth()+dt.getMinutes()+dt.getSeconds());
                    // automatically create customer ID new after writting Company Name
                }

            }

            });

            $("input[name='mode']").change(function(){
                var mode = $(this).val();
                $('#cg').combogrid({
                    mode: mode
                });
            });
                        
                       
                        
        });  


    // **************** For Individual All  Start **********************
    function formatStatus(val, row) {
        if (val === 'Created') {
            return '<span style="color:green;">(' + val + ')</span>';
        } else if (val === 'Invoice') {
            return '<span style="color:red;">(' + val + ')</span>';
        }
        else {
            return val;
        }
    }
    function formatPrice(val, row) {
        if (val > 1000) {
            return '<span style="color:red;">(' + val + ')</span>';
        } else {
            return val;
        }
    }

    function IndividualAllEReceipt() {
        var row = $('#dg').datagrid('getSelected');
        $('#dlg_ind_all_ereceipt').dialog('open').dialog('setTitle', 'List of All E-Receipt of ' + row.name + ', Client ID: ' + row.cust_id);
        $('#dg_ind_all_ereceipt').datagrid({
            url: 'e_receipt/get_ind_all_ereceipt.php?ereceipt_q=' + row.cust_id
        });
    }
    // Individually EReceipt display End.



    function IndividualAllInvoice() {
        var row = $('#dg').datagrid('getSelected');
        $('#dlg_ind_all_invoices').dialog('open').dialog('setTitle', 'List of All invoices on Reference Name: ' + row.ref_name + ', Reference ID: ' + row.ref_id);
        $('#dg_ind_all_invoices').datagrid({
            url: 'reference_profile/get_ind_all_invoices.php?invoice_q=' + row.ref_id
        });
    }


    var url_payment;
    function newPayment() {

        var row = $('#dg_ind_all_invoices').datagrid('getSelected');
        //$.messager.alert("Message",row.invoice_num,"info"); 
        if (row) {

            $('#dlg_payment_form').dialog('open').dialog('setTitle', 'Receive Payment Form of ' + row.ref_name + ', Reference ID: ' + row.ref_id);

            $('#dlg_payment_form').dialog('open');


            $('#receive_payment_form').form('load', row);

            url_payment = 'payment/save_payment.php';
            $('#receive_amount').focus();
            $('#receive_amount').val("");  // when open payment form this field will be empty.
            $('#due').val("");
            $('#check_num').val("");
            $('#memo').val("");
            $('#payment_date').val("");
            $('#payment_method').val("");// when open payment form this field will be empty.
            //$('#dlg_payment_form').form('reset');
            // Start Order price will be receivable amount subtract from discount.
            var price = row.price;
            var dis_amt = row.discount_amount;

            var p = parseFloat(price.replace(/,/g, '')) - parseFloat(dis_amt.replace(/,/g, ''));
            $('#order_price').val(p); // invoice price after commission
            // End Order price will be receivable amount subtract from discount.
            $('#txtdiscount_amt').val(dis_amt); // put discount amt
            // Start For Display Paid Amt in payment form
            //parseFloat('100,000.00'.replace(/,/g, ''))
            var order_price = document.getElementById('order_price').value;
            var payable_amount1 = row.payable_amount;
            var ait_others = row.ait_others_discount;

            var payable_ait_amt = parseFloat(payable_amount1.replace(/,/g, '')) + parseFloat(ait_others.replace(/,/g, ''));
            var paid_amt = parseFloat(order_price.replace(/,/g, '')) - payable_ait_amt;
            document.getElementById('paid_amount').value = paid_amt.toFixed(2);

            // End Display Paid Amt in payment form

        }
        else {
            $.messager.show({
                title: 'Message',
                msg: 'Please select atleast one item for Bill Collection.',
                showType: 'show'
            });

        }


    }


    function savePayment() {
        $('#receive_payment_form').form('submit', {
            url: url_payment,
            onSubmit: function () {
                return $(this).form('validate');
            },
            success: function (result) {
                var result = eval('(' + result + ')');
                if (result.errorMsg) {
                    $.messager.show({
                        title: 'Error',
                        msg: result.errorMsg,
                        showType: 'show'
                    });
                } else {
                    $('#dlg_payment_form').dialog('close');     // close the dialog
                    $('#dg_ind_all_invoices').datagrid('reload');   // reload the user data
                    $('#receive_payment_form').form('reset');
                    $.messager.show({
                        title: 'Info',
                        msg: 'Transaction saved successfully.',
                        showType: 'show'
                    });

                }
            }
        });

    }

// ********************* Start Row and column ******************
$('.table_order tbody').delegate('.row,.column,.qty','keyup',function(){
        var tr=$(this).parent().parent();
        var row = tr.find('.row').val();
        var column = tr.find('.column').val();
        var qty = tr.find('.qty').val();
        var total_qty = row*column;
        $('.qty').val(total_qty);

});
// ********************* End Row and column ******************
    // ******************* start substraction for due balance. *****************

    $('#receive_amount').each(function () {
        $(this).keyup(function () {

            subtraction();
            //alert("test");
        });
    });
    function subtraction() {
        var sum = " ";
        $("#payable_amount_p").each(function () {

            //add only if the value is number
            var payable_amt = document.getElementById('payable_amount_p').value;
            var pay = parseFloat(payable_amt.replace(/,/g, '')); // number format , remove
            if (!isNaN(pay) && pay.length !== 0) {
                sum = pay;
            }
            if (isNaN(pay)) {
                $('#payable_amount_p').val("");
            }


        });

        $("#receive_amount").each(function () {


            var sum = " ";
            $("#payable_amount_p").each(function () {

                //add only if the value is number
                var payable_amt = document.getElementById('payable_amount_p').value;
                var pay = parseFloat(payable_amt.replace(/,/g, '')); // number format , remove
                if (!isNaN(pay) && pay.length !== 0) {
                    sum = pay;
                }
                if (isNaN(pay)) {
                    $('#payable_amount_p').val("");
                }


            });


            if (isNaN(this.value) || this.value > sum) {
                $('#receive_amount').val("");
                $('#due').val("");
            }
            if (!isNaN(this.value) && this.value.length !== 0) {

                var receive = document.getElementById('receive_amount').value;

                total = sum - receive;

                if (total == '0.00') {
                    $('#ait_others_discount').val('0'); // if total is zero then ait field will be zero
                }

                // if i add with unitprice it does not work but if i work with sum then 
                // it will be work. that imagine.
                $("#due").val(total.toFixed(2));
            }

        });


    }


    $('#ait_others_discount').each(function () {
        $(this).keyup(function () {

            aitOthersDiscount();
            //alert("test");  // AIT Others Discount Field will be trigger fire.
        });
    });

    function aitOthersDiscount() {
        var sum = " ";
        $("#payable_amount_p").each(function () {
            //add only if the value is number
            var payable_amt = document.getElementById('payable_amount_p').value;
            var pay = parseFloat(payable_amt.replace(/,/g, '')); // number format , remove
            if (!isNaN(pay) && pay.length !== 0) {
                sum = pay;
            }
            if (isNaN(pay)) {
                $('#payable_amount_p').val("");
            }

        });

        $("#ait_others_discount").each(function () {

            var receive = document.getElementById('receive_amount').value;
            var receive_amt = parseFloat(receive.replace(/,/g, '')); // number format , remove

            var ait_discount = document.getElementById('ait_others_discount').value;
            var ait_discount_amt = parseFloat(ait_discount.replace(/,/g, '')); // number format , remove

            if (isNaN(this.value || this.value > receive_amt)) {
                $('#ait_others_discount').val("");
                //$('#due').val("");
            }
            if (!isNaN(this.value) && this.value.length !== 0) {


                adjustment = receive_amt + ait_discount_amt;

                total = sum - adjustment;

                // if i add with unitprice it does not work but if i work with sum then 
                // it will be work. that imagine.
                $("#due").val(total.toFixed(2));
            }

        });

    }

    // Start Discount change number on key up
    $('#txtdiscount').textbox({
        inputEvents: $.extend({}, $.fn.textbox.defaults.inputEvents, {
            keyup: function (e) {

                var discount = $(this).val();
                var discount_num = parseFloat(discount.replace(/,/g, '')); // number format discount %

                var price = $('#txtprice').textbox('getText');
                var price_num = parseFloat(price.replace(/,/g, '')); // number format invoice price

                var dis_amount = price_num * (discount_num / 100); // discount Amount
                $('#txtdiscount_amt').val(dis_amount.toFixed(2)); // put dis amount
                var after_discount_price = price_num - dis_amount; // calculate precentage
                $("#order_price").val(after_discount_price); // Price after commission

                var ait_discount = document.getElementById('ait_others_discount').value;
                var ait_discount_amt = parseFloat(ait_discount.replace(/,/g, '')); // number format , remove


                var paid_amount = $('#paid_amount').val();
                var payable_amount_new = (price_num - (dis_amount + ait_discount_amt)) - paid_amount;
                // Add discount amount and ait_discount and then substract invoice price then substract paid amount
                $('#payable_amount_p').val(payable_amount_new.toFixed(2));


            }
        })
    })
    // End Discount change number on key up

    // End substraction for due balance.




    function loadPayment() {

        var row = $('#dg').datagrid('getSelected');


        if (row) {
            $.ajax({
                url: 'payment/get_payment_individual.php?q=' + row.cust_id,
                success: function (data) {
                    $('#individual_payment').html(data);
                }
            });//  For Individual payment display reload div.
        }
        else {
            $('#individual_payment').hide();
        }


    }

    function doSearch_indi_invoice() { // FOR INDIVIDUAL INVOICES SEARCH

        $('#dg_ind_all_invoices').datagrid('load', {
            productid: $('#txtsearch_indi_invoice').val()
        });

    }

    function doSearch_indi_ereceipt() { // FOR INDIVIDUAL ERECEIPT SEARCH
        $('#dg_ind_all_ereceipt').datagrid('load', {
            productid: $('#txtsearch_indi_ereceipt').val()
        });

    }




    function paymentPreview() {
        var row = $('#dg_ind_all_invoices').datagrid('getSelected');
        if (row) {


            var due = document.getElementById('due').value;
            var receive = document.getElementById('receive_amount').value;
            var order_price = document.getElementById('order_price').value;
            var paid_amount = document.getElementById('paid_amount').value;
            var payable_amount = document.getElementById('payable_amount_p').value;
            var payment_date = $('#payment_date').datetimebox('getText');   // get datetimebox value

            var payment_method = $('#payment_method').combobox('getText'); // get combobox value

            var check_num = document.getElementById('check_num').value;
            var memo = document.getElementById('memo').value;
            var deposite_to = $('#deposite_to').combobox('getText'); // get combobox value
            var status_memo = document.getElementById('status_memo').value;

            window.open("Report/preview_payment_individual_cust.php?cust_id=" + row.cust_id + "&inv_id=" + row.invoice_id + "&due=" + due + "&receive=" + receive + "&or_p=" + order_price + "&paid_amt=" + paid_amount + "&payable_amt=" + payable_amount + "&payment_date=" + payment_date + "&payment_method=" + payment_method + "&check_num=" + check_num + "&memo=" + memo + "&deposite_to=" + deposite_to + "&status_memo=" + status_memo, "myNewWinsr", "width=990,height=600,toolbar=0,menubar=no,status=no,resizable=yes,location=no,direction=no,scrollbars=yes");

        }
        else {
            $.messager.show({
                title: 'Message',
                msg: 'Please select atleast one item..',
                showType: 'show'
            });
        }


    }

    // E_RECEIPT PRINT


    function e_Receipt_Print() {
        var row = $('#dg_ind_all_ereceipt').datagrid('getSelected');
        if (row) {

            window.open("Report/preview_payment_ind_ereceipt.php?cust_id=" + row.cust_id + "&inv_num=" + row.invoice_id + "&order_id=" + row.order_id + "&ememo_id=" + row.memo_id, "myNewWinsr", "width=900,height=600,toolbar=0,menubar=no,status=no,resizable=yes,location=no,direction=no,scrollbars=yes");

        }
        else {

            $.messager.show({
                title: 'Message',
                msg: 'Please select atleast one item for e_receipt.',
                showType: 'show'
            });
        }

    }

    // INVOICE PRINT START 
    function invoicePrint() {
        var row = $('#dg_ind_all_invoices').datagrid('getSelected');
        if (row) {

            window.open("Report/print_individual_cust_invoice.php?cust_id=" + row.cust_id + "&inv_id=" + row.invoice_id, "myNewWinsr", "width=990,height=600,toolbar=0,menubar=no,status=no,resizable=yes,location=no,direction=no,scrollbars=yes");

        }
        else {
            $.messager.show({
                title: 'Message',
                msg: 'Please select atleast one item.',
                showType: 'show'
            });
        }

    }

    function allInvoicePrint() {
        var row = $('#dg').datagrid('getSelected');

        window.open("Report/print_individual_cust_all_invoice.php?cust_id=" + row.cust_id, "myNewWinsr", "width=990,height=600,toolbar=0,menubar=no,status=no,resizable=yes,location=no,direction=no,scrollbars=yes");
    }

    // INVOICE PRINT END



    // *********************** Start For Individual Profile *********************


    // Start to Create Customer Id New //

    $('#name').textbox({
        onChange: function (value) {

            var dt = new Date();
            var time = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();

            var str = "", abbr = "";
            str = value;
            str = str.split(' ');
            var length = str.length - 1;
            for (i = 0; i < str.length; i++) {
                //abbr += str[i].substr(0,1);
                abbr = str[0].substr(0, 1) + str[length].substr(0, 1); // this will take first character of first word and last word    
                $('#cust_id_new').val(abbr + '-' + dt.getFullYear().toString().substr(2, 2) + dt.getMonth() + dt.getMinutes() + dt.getSeconds());
                // automatically create customer ID new after writting Company Name
            }

        }
    });
    // End to Create Customer Id New //


    function profile() {
        var row = $('#dg').datagrid('getSelected');

        if (row) {

            $('#grid_order').datagrid({
                url: 'reference_profile/get_order.php?q=' + row.ref_id
            });// grid_order individual data load.

            $('#profile').dialog('open').dialog('setTitle', ' Details of ' + row.ref_name + ', Reference Id: ' + row.ref_id);

//            $.ajax({
//                url: 'order/get_order_individual.php?q=' + row.cust_id,
//                success: function (data) {
//
//                    $('#individual_order').html(data);
//
//                }
//            });

        }
        else {
            $.messager.show({
                title: 'Message',
                msg: 'Please select atleast one Reference. And create new order, invoice, bill and more..',
                showType: 'show'
            });
        }
        //$('#fm').form('clear');
        //url = 'save_user.php';   
    }
    // ************************* Profile Function End. ***********************

    // Start Reference_Name Add New Chanage Option.
    $('#ref_name').change(function () {
        var ref_name = $('#ref_name').val();

        if (ref_name === 'addNew') {
            $('#reference').dialog('open').dialog('setTitle', 'Add Reference Info');
            $('#reference_form').form('clear');
        }
    }); // End Changing  Reference Name.
    function saveReference() {
        $('#reference_form').form('submit', {
            url: 'reference_profile/save_user.php',
            onSubmit: function () {
                return $(this).form('validate');
            },
            success: function (result) {
                var result = eval('(' + result + ')');
                if (result.errorMsg) {
                    $.messager.show({
                        title: 'Error',
                        msg: result.errorMsg
                    });
                } else {
                    
                    $('#reference').dialog('close');        // close the dialog
                    //$('#dg').datagrid('reload');  // reload the user data
                    // Start load Reference select data
                    $.ajax({
                        url: 'reference_profile/get_reference.php',
                        success: function (data) {
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
    // Start Individual Order
    var url_order;
    function order_individual() {

        var row = $('#dg').datagrid('getSelected');
        $('#order_individual').dialog('open').dialog('setTitle', 'Add New Order on Ref Id: ' + row.ref_id);
        $('#order_form').form('clear');
        $('.cust_id').val(row.cust_id);
        $('.cust_id_new').val(row.cust_id_new);
        $('select#txttype').val(row.type);
        $('select.txtproject_name').val(row.project_name);
        // var ref_name =row.ref_name;

        var $option = $("<option/>").attr("value", row.ref_id).text(row.ref_name);
                    $('select.txtref_name').append($option);
        url_order = 'order/individual_save_order.php';
        $('select.txtref_name').val(row.ref_id);

        $('#order_status').val('Invoice');
        $('.name').val(row.name);
        $('#work_order_no').textbox('clear').textbox('textbox').focus();
    }
    function editOrder() {

        var row = $('#grid_order').datagrid('getSelected');

        if (row) {
            $('#order_individual').dialog('open').dialog('setTitle', 'Edit Order');
            $('#order_form').form('load', row);
            var jd = row.order_date;
            var d = new Date(jd);
            var date = d.getDate();
            var month = d.getMonth() + 1;
            var year = d.getFullYear();
            //(date + "/" + month + "/" + year);
            var datea = month + "/" + date + "/" + year;
            $('#order_date').datetimebox('setValue', datea);
            url_order = 'order/update_user.php?id=' + row.order_id;
            //$.messager.alert('Message', "Update Successfully.", 'info');
        }
        else {
            //$.messager.alert('Message', "Please select atleast one item.", 'info');
            $.messager.show({
                title: 'Message',
                msg: 'Please select atleast one item to Edit.',
                showType: 'show'
            });
        }

    } // Edit function for order End.

    function saveOrder() {
        $('#order_form').form('submit', {
            url: url_order,
            onSubmit: function () {
                return $(this).form('validate');
            },
            success: function (result) {
                var result = eval('(' + result + ')');
                if (result.errorMsg) {
                    $.messager.show({
                        title: 'Error',
                        msg: result.errorMsg
                    });
                } else {

                    $('#grid_order').datagrid('reload');    // reload the user data
                    $('#order_form').form('clear');
                    $('#order_individual').dialog('close');     // close the dialog
                $.messager.show({
                title: 'Message',
                msg: 'Order Saved Successfuly.',
                showType: 'show'
            });
//                    var row = $('#dg').datagrid('getSelected');
//                    $.ajax({
//                        url: 'order/get_order_individual.php?q=' + row.cust_id,
//                        success: function (data) {
//                            $('#individual_order').html(data);
//                        }
//                    });// reload div.

                }
            }
        });
    } // SaveOrder Function End.

    function destroyOrder() {
        var row = $('#grid_order').datagrid('getSelected');
        if (row) {
            $.messager.confirm('Confirm', 'Are you sure you want to destroy this Order?', function (r) {
                if (r) {
                    $.post('order/destroy_user.php', {id: row.order_id}, function (result) {
                        if (result.success) {
                            $('#grid_order').datagrid('reload');    // reload the user data
                        } else {
                            $.messager.show({// show error message
                                title: 'Error',
                                msg: result.errorMsg
                            });
                        }
                    }, 'json');
                }
            });
        }
        else {
            //$.messager.alert('Message','Please select atleast one item.','info');
            $.messager.show({
                title: 'Message',
                msg: 'Please select atleast one item.',
                showType: 'show'
            });
        }
    }//Destroy Order Function End.
    function doSearch_order() {

        $('#grid_order').datagrid('load', {
            productid: $('#txtsearch_order').val()
        });

    }
    function details_company() {
        var row = $('#dg').datagrid('getSelected');
            $.ajax({
                url: 'pages/display_individual_profile_reference.php?q=' + row.ref_id,
                success: function (data) {
                    $('p#demo').html(data);
                }
            });
    }
    
    function loadDoc() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                document.getElementById("demo").innerHTML =
                        this.responseText;
            }
        };
        xhttp.open("GET", "ajax_info.txt", true);
        xhttp.send();
    }

    // Unit price input and then Total Price display Start

    $('#unit_price').each(function () {

        $(this).keyup(function () {

            var qty = document.getElementById('qty').value;
            var unitprice = document.getElementById('unit_price').value;
            var total_price = parseFloat(qty) * parseFloat(unitprice);

            $('#price').val(total_price);

        });

    });


    // End Total Price Display.

    // Percentase Calculasion Start.
    $('#discount').each(function () {
        $(this).keyup(function () {
            percent();
        });
    });

    function percent() {

        var sum = " ";
        //iterate through each textboxes and add the values
        $("#price").each(function () {

            //add only if the value is number
            if (!isNaN(this.value) && this.value.length !== 0) {
                sum = parseFloat(this.value);
            }
            if (isNaN(this.value)) {
                $('#price').val("");
            }


        });

        $("#discount").each(function () {
            if (isNaN(this.value)) {
                $('#discount').val("");
            }
            if (!isNaN(this.value) && this.value.length !== 0) {

                var unitprice = document.getElementById('price').value;
                var uniper = parseFloat(this.value) / 100;
                per = unitprice * uniper;
                $('#discount_amount').val(per);// get discount amount
                total = sum - per; //get total payable amount not decimal value
                // if i add with unitprice it does not work but if i work with sum then 
                // it will be work. that imagine.

            }

        });
        $("#payable_amount").val(total.toFixed(2)); // paybale amount with decimal value.
    }
    // Percentase Calculasion End.

    // *************** End Order related work ***********

    // *************** Start Invoice Form related work ***********
    var url_invoice;
    function invoice() {

        var row = $('#grid_order').datagrid('getSelected');

        if (row) {
            $('#dg_invoice_form').dialog('open').dialog('setTitle', 'Create Invoice');
            $('#dg_invoice_form').form('load', row);

            var $option = $("<option/>").attr("value", row.ref_id).text(row.ref_name);
                    $('select.txtref_name').append($option);
                    $('select.txtref_name').val(row.ref_id);
            url_invoice = 'invoice/save_invoice.php';
        }
        else {
            //$.messager.alert('Message', "Please select atleast one item for Invoice.", 'info');
            $.messager.show({
                title: 'Message',
                msg: 'Please select atleast one item..',
                showType: 'show',
                style: {
                    right: '',
                    bottom: ''
                }

            });
        }

    } // invoice function.
    function saveInvoice() {
        $('#invoice_form').form('submit', {
            url: url_invoice,
            onSubmit: function () {
                return $(this).form('validate');
            },
            success: function (result) {
                var result = eval('(' + result + ')');
                if (result.errorMsg) {
                    $.messager.show({
                        title: 'Error',
                        msg: result.errorMsg
                    });
                } else {
                    $('#dg_invoice_form').dialog('close');      // close the dialog
                    $('#grid_order').datagrid('reload');    // reload the user data
                    $('#invoice_form').form('clear');



                    // $.messager.alert('Message',"Saved successfully ","info");
                    $.messager.show({
                        title: 'Message',
                        msg: 'Invoice Created successfully.',
                        showType: 'show'
                    });

//                                        var row = $('#dg').datagrid('getSelected');
//                                        
//                                    $.ajax({
//                            url:'order/get_order_individual.php?q=' + row.cust_id,
//                            success: function(data){
// 
//                            $('#individual_order').html(data);
//                                
//                            }
//                        });//  For Individual Order display reload div.

                }
            }
        });
    }

    // SaveInvoice Function End.




</script>
<script type="text/javascript">
    $('#txtsearch_order').textbox({
        iconCls: 'icon-order_color',
        iconAlign: 'left',
        width: '100'
    });

    $('#txtsearch').textbox({
        iconCls: 'icon-man',
        iconAlign: 'left',
        width: '100'
    });

    $('#txtsearch_indi_invoice').textbox({
        iconCls: 'icon-invoice_color',
        iconAlign: 'left',
        width: '125'
    });

    var url;
    function newReference() {
            $('#reference').dialog('open').dialog('setTitle','New Reference Information');
            $('#reference_form').form('clear');
            url = 'reference_profile/save_user.php';
    }

    function editUser() {

        var row = $('#dg').datagrid('getSelected');

        if (row) {
            $('#reference').dialog('open').dialog('setTitle','Edit Reference');
                $('#reference_form').form('load',row);
                $('select.district').append('<option value="' + row.id + '" selected="selected" >' + row.statename + '</option>');
                $('select.ref_upazila').append('<option  value="' + row.ref_upazila + '" selected="selected">' + row.ref_upazila + '</option>');
                url = 'reference_profile/update_user.php?id='+row.ref_id;
        }
        else {
            $.messager.show({
                title: 'Message',
                msg: 'Please select atleast one item..',
                showType: 'show'
            });
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
                        $('#reference').dialog('close');        // close the dialog
                        $('#dg').datagrid('reload');    // reload the user data
                              $.messager.show({
                                title: 'Message',
                                msg: 'Saved reference successfully.',
                                showType: 'show'
                            });
                    }
                }
            });
        }

    function detailsView() {
        var row = $('#dg').datagrid('getSelected');
        if (row) {
            $('#dlg').dialog('open').dialog('setTitle', 'All information');
            $('#fm').from('load', row);
        }
        else {
            $.messager.show({
                title: 'Message',
                msg: 'Please select atleast one item.',
                showType: 'show'
            });
        }
    }



    function destroyUser() {
        var row = $('#dg').datagrid('getSelected');
        if (row) {
            $.messager.confirm('Confirm', 'Are you sure you want to destroy this Reference? You will lost all data from database of this Reference. Confirm! ', function (r) {
                if (r) {
                    $.post('reference_profile/destroy_user.php', {id: row.ref_id}, function (result) {
                        if (result.success) {
                            $('#dg').datagrid('reload');    // reload the user data
                                  $.messager.show({
                                    title: 'Message',
                                    msg: 'Delete one reference name Successfully',
                                    showType: 'show'
                                });
                        } else {
                            $.messager.show({// show error message
                                title: 'Error',
                                msg: result.errorMsg
                            });
                        }
                    }, 'json');
                }
            });
        }
        else {
            $.messager.show({
                title: 'Message',
                msg: 'Please select atleast one item..',
                showType: 'show'
            });
        }
    }
    // For Search Function
    function doSearch() {
        $('#dg').datagrid('load', {
            productid: $('#txtsearch').val()
        });

    }






</script>
<!-- ****************** For Tripple Combo ******************** -->

<script language="javascript" type="text/javascript">
// Roshan's Ajax dropdown code with php
// This notice must stay intact for legal use
// Copyright reserved to Roshan Bhattarai - nepaliboy007@yahoo.com
// If you have any problem contact me at http://roshanbh.com.np
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
                        document.getElementById('ref_citydiv').innerHTML = req.responseText;
                    } else {
                        alert("There was a problem while using XMLHTTP:\n" + req.statusText);
                    }
                }
            }
            req.open("GET", strURL, true);
            req.send(null);
        }

    }
    // END GET CITY FUNCTION for Customers

    function getStateRef(countryId) {

        var strURL = "pages/findState.php?country=" + countryId;
        var req = getXMLHTTP();

        if (req) {

            req.onreadystatechange = function () {
                if (req.readyState == 4) {
                    // only if "OK"
                    if (req.status == 200) {
                        document.getElementById('ref_statediv').innerHTML = req.responseText;

                    } else {
                        alert("There was a problem while using XMLHTTP:\n" + req.statusText);
                    }
                }
            }
            req.open("GET", strURL, true);
            req.send(null);
        }
    }

    // END GET CITY FUNCTION for Reference

    // Start Filter for Individual Order
    $(function () {
        var dg = $('#dg').datagrid({
            filterBtnIconCls: 'icon-filter'
        });
        dg.datagrid('enableFilter', [{
                field: 'country',
                type: 'combobox',
                options: {
                    panelHeight: 'auto',
                    data: [{value: '', text: 'All'}, {value: 'Dhaka', text: 'Dhaka'},
                        {value: 'Chittagong', text: 'Chittagong'},
                        {value: 'Rajshahi', text: 'Rajshahi'},
                        {value: 'Khulna', text: 'Khulna'}, {value: 'Barisal', text: 'Barisal'},
                        {value: 'Sylhet', text: 'Sylhet'}],
                    onChange: function (value) {
                        if (value == '') {
                            dg.datagrid('removeFilterRule', 'country');
                        } else {
                            dg.datagrid('addFilterRule', {
                                field: 'country',
                                op: 'equal',
                                value: value
                            });
                        }
                        dg.datagrid('doFilter');
                        document.getElementById('selected_id').innerHTML = value; // To Print
                    }
                }
            }, {
                field: 'discount_amount',
                type: 'numberbox',
                options: {precision: 0},
                op: ['equal', 'notequal', 'less', 'greater']
            }, {
                field: 'payable_amount',
                type: 'numberbox',
                options: {precision: 0},
                op: ['equal', 'notequal', 'less', 'greater']
            }, {
                field: 'status',
                type: 'combobox',
                options: {
                    panelHeight: 'auto',
                    data: [{value: '', text: 'All'}, {value: 'Created', text: 'Created'}, {value: 'Invoice', text: 'Invoice'}],
                    onChange: function (value) {
                        if (value == '') {
                            dg.datagrid('removeFilterRule', 'status');
                        } else {
                            dg.datagrid('addFilterRule', {
                                field: 'status',
                                op: 'equal',
                                value: value
                            });
                        }
                        dg.datagrid('doFilter');
                    }
                }
            }]);
    });

</script>


<script type="text/javascript">

    $(document).ready(function () {

        $('#selected_id').show();

        $('tbody').delegate('.item','change',function(){
                var tr = $(this).parent().parent(); 
             tr.find('.description').focus(); 
        });

    });

    $(function () {

//                $('#dg').datagrid({
//                    onSelect: function(rowIndex, rowData)
//                     {
////                         total = 0;
//////                        for(var i=0; i<=rowIndex; i++){
//////                         total += parseFloat(rowData.cust_id);
//////                       //alert(rowIndex + rowData.cust_id);
//////                        }
//                    total = parseFloat(rowData.cust_id);
//                       document.getElementById('selected_id').innerHTML = total;
//                     }
//                 });

        // var cust_id = document.getElementById('selected_id').innerHTML;
        // Start For Print

        $("#customerPrint").on("click", function ()
        {
            // var row = $('#dg').datagrid('getSelected');
            // var cust_id = row.cust_id;
            var cust_id = $('#selected_id').text();
            // alert(cust_id);
            var hrf = $(this).attr("href", "reference_profile/printReference.php?q=" + cust_id);
//                $("#customerPrint").printPage({
//                    url: hrf,
//                    attr: "href",
//                    message:"Your document is being created.."
//                  });
        });
        $("#indcustomerPrint").on("click", function ()
        {
            var row = $('#dg').datagrid('getSelected');
            var ref_id = row.ref_id;
            // var hrf = $(this).attr("href", "reference_profile/individualPrintCustomer.php?q=" + ref_id);
             window.open("reference_profile/individualPrintReference.php?q=" + ref_id,"myNewWinsr","width=990,height=600,toolbar=0,menubar=no,status=no,resizable=yes,location=no,direction=no,scrollbars=yes");

        });
        

    });
    


</script>
