<style>
    .left_div{
        padding:0px 50px;
        float:left;
    }
    .right_div{
        float:right;
        padding:0px 100px;
    }
</style>

<table id="dg" title="List of all clients" class="easyui-datagrid" style="width:auto; max-height:450px; overflow: scroll; min-height: 400px;"
       data-options="view:scrollview,iconCls:'icon-customer',remoteSort:false, multiSort:true " url="customer_profile/member_search.php"
       toolbar="#toolbar" pagination="false"
       rownumbers="true" fitColumns="true" singleSelect="true">
    <thead>
        <tr>
            <th data-options="field:'ck',checkbox:true " ></th>
            <th field="cust_id" width="50" sortable="true" title="test1">#</th>
            <th field="cust_id_new" width="100" sortable="true" title="test1">ID.</th>
            <th field="name_custom" width="150" sortable="true" title="test">Name</th>
            <th field="address_custom" width="auto">Town/House</th>
            <th field="country" width="auto">Division</th>
            <th field="statename" width="auto">District</th>
            <th field="upazila" width="auto">Thana</th>
            <th field="type" width="auto" sortable="true">Type</th>
            <th field="project_name" width="auto" sortable="true">Company Category</th>
            <th field="ref_name" width="auto" sortable="true">Reference Name</th>
            <th field="contact_person" width="auto" sortable="true">Contact Person Name</th>
            <th field="phone" width="auto">Phone</th>
            <th field="email" width="auto">Email</th>
            <th field="join_date">Clients Create date</th>
            <th field="website" width="auto">Web site</th>
        </tr>
    </thead>
</table>

<!-- Company Type Name Form Window-Layout Start -->
    <?php include_once 'company_type/add_company_type.php'; ?>
<!-- End Company Type dialogbox -->

<!-- Company Category Form Window-Layout Start -->
    <?php include_once 'company_cat/add_company_cat.php'; ?>
<!-- End Company Category dialogbox -->

<!-- Type Name Form Window-Layout Start -->
    <?php include'add_type/add_type.php';?>
<!-- End Type dialogbox -->


<div id="toolbar">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="false" onclick="newUser()">New Clients </a>

    <?php
    if ($_SESSION['s_email'] == 'admin@dailyasianage.com' || $_SESSION['s_email'] == 'superadmin@dailyasianage.com') {
        ?>
        <a href="javascript:void(0)" class="easyui-linkbutton" id="edt" iconCls="icon-edit" plain="false" onclick="editUser()">Edit </a>
<!--        <a href="javascript:void(0)" class="easyui-linkbutton" id="cnl" iconCls="icon-remove" plain="false" onclick="destroyUser()">Destroy </a>-->

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


<div id="dlg" class="easyui-dialog" data-options="iconCls:'icon-add' " style="width:700px;height:550px;padding:10px 80px 10px 80px"
     closed="true" buttons="#dlg-buttons">
    <fieldset style="border:1px #ccc solid;"><legend>Customer Information</legend>
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
                <select name="type" id="txttype" required="required"  onchange="companyType(this.value)">
                    <option value="">Select Any One</option>
                    <option value="addNew">Add New</option>
                              <?php
                   
                    $query_company_type = $con->prepare("Select companytypeid, company_type_name from company_type_tbl group by company_type_name");
                    $query_company_type->execute();
                    while ($row_ref = $query_company_type->fetch(PDO::FETCH_ASSOC)) {
                        extract($row_ref);
                        ?>
                        <option value="<?php echo $companytypeid; ?>"><?php echo $company_type_name; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
            <div class="fitem">
                <label>Company Category</label>
            <select name="project_name" id="txtproject_name" required="required">
                    <option value="0">Select Company Type First</option>
                    </select>
            </div>
            <div class="fitem" >
                <label>Reference Name</label>
                <select name="ref_id" id="ref_name" required="required" style="width:150px;">
                    <option value="">-- Please Select --</option>
                    <option value="addNew">Add New</option>
                    <?php
                    $query_ref = $con->prepare("Select ref_id, ref_name,ref_upazila from tbl_reference group by ref_name");
                    $query_ref->execute();
                    while ($row_ref = $query_ref->fetch(PDO::FETCH_ASSOC)) {
                        extract($row_ref);
                        ?>
                        <option value="<?php echo $ref_id;?>"><?php echo $ref_name.', Id.'.$ref_id.' - '.$ref_upazila; ?></option>
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
                <label>Contact Person Name</label>
                <input name="contact_person" class="easyui-textbox" >
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
<div id="profile" class="easyui-dialog" style="width:1124px;height:600px; padding:2px 2px;"
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
        <div data-options=" region:'center', split:'true', iconCls:'icon-ok' " style="padding:5px;width:900px; height:550px;">

            <table id="grid_order" title="List of Order's" class="easyui-datagrid" style="width:100%; min-height: 200px; max-height:350px;"
                   toolbar="#toolbar_order" pagination="true"
                   singleSelect="false" showFooter="true" fitColumn="true" >
                <thead>
                    <tr>
                        <th data-options="field:'ck',checkbox:true "></th>
                        <th field="order_id" width="auto" title="Order ID" >O. ID.</th>
                        <th field="order_date" width="auto">O. Date</th>
                        <th data-options="field:'status',align:'center',formatter:formatStatus ">Inv. Status</th>
                        <th field="size"> Size </th>
                        <th field="price" data-options="align:'right' " width="auto">Price</th>
                        <th field="front_page" width="100" sortable="true" data-options="align:'right' ">Front Page(%)</th>
                        <th field="back_page" width="100" sortable="true" data-options="align:'right' ">Back Page(%)</th>
                        <th field="color" width="100" sortable="true" data-options="align:'right' ">Color(%)</th>
                        <th field="discount" width="auto" data-options="align:'right' ">Dis(%)</th>
                        <th field="discount_amount" width="auto" data-options="align:'right' ">Dis Amt.</th>
                        <th field="payable_amount" width="auto" data-options="align:'right' ">Receivable Amt.</th>
                        <th field="vat" width="auto" data-options="align:'right' ">VAT(%)</th>
                        <th field="tax" width="auto" data-options="align:'right' ">TAX(%)</th>
                        <th field="ref_name" width="auto">Ref. Name</th>
                        <th field="item" width="auto">Item</th>

                    </tr>

                </thead>

            </table>

            <br/>
            <li>
                <a href="javascript:void(0)" class="easyui-linkbutton" id="indcustomerPrint" iconCls="icon-print" plain="false" target="_blank" >Print Company Info</a>
                <a href="javascript:void(0)" class="easyui-linkbutton" id="orderPrint" iconCls="icon-print" plain="false" target="_blank" >Print Order Info</a>
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-home" plain="false" onclick="details_company()" >Company Details</a>
            </li>
<!--                        <div id="individual_order" ></div>-->
            <p id="demo" style="max-height:300px; overflow-y: scroll; "></p>


        </div>


    </div>

</div>
<!-- Individual Profile Dialog-Layout End -->

<!-- Order dialog Start -->
<div id="order_individual" class="easyui-dialog" style="width:800px;height:600px; padding:2px 2px;"
     closed="true" buttons="#order_south_buttons" data-options="iconCls:'icon-order_color' ">
    <div class="easyui-layout" fit="true"  id="order_layout" >

        <div data-options=" region:'center', split:'true', title:'Order form' " style="padding:10px 20px">
            <form id="order_form" method="post" novalidate>
                <div class="fitem" style="background: #F1F1F1;">

                    <label>Company Name: </label>
                    <input type="hidden" name="cust_id_new" class="cust_id_new" readonly="readonly" />
                    <input name="cust_id" type="hidden"  class="cust_id" style="text-align: right; padding: 2px;" />
                    <input type="text" name="name" class="name" value="" style="text-transform:capitalize;" readonly="readonly"  /> 

                    &nbsp;&nbsp;&nbsp;<label>Reference Name</label>
                    <select name="ref_id" class="txtref_name" style="width:150px; ">
                        <option value=""></option>
                        <?php
                        $query_ref_order1 = $con->prepare("Select ref_id,ref_name,ref_upazila from tbl_reference group by ref_name ");
                        $query_ref_order1->execute();
                        while ($row_ref_order = $query_ref_order1->fetch(PDO::FETCH_ASSOC)) {
                            extract($row_ref_order);
                            ?>
                            <option value="<?php echo $ref_id; ?>"><?php echo $ref_name.' - '.$ref_upazila; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                
                </div>
                <br/>
                <div class="fitem hidden_custom">
                    &nbsp;&nbsp;&nbsp;<label>Company Type </label><select name="type" id="txttype" style="width:150px; ">
                        <option value=""></option>
             <?php
                 
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
                <div class="fitem hidden_custom">
                    &nbsp;&nbsp;&nbsp;<label>Company Category</label><select name="project_name"  class="txtproject_name" style="width:150px; " >
                        <option value=""></option>
                        <?php
                    $query_company_cat1 = $con->prepare("Select companycatid, company_cat_name from company_cat_tbl group by company_cat_name");
                    $query_company_cat1->execute();
                    while ($row_ref = $query_company_cat1->fetch(PDO::FETCH_ASSOC)) {
                        extract($row_ref);
                        ?>
                        <option value="<?php echo $companycatid; ?>"><?php echo $company_cat_name; ?></option>
                        <?php
                    }
                    ?>
                    </select>
                </div>
                
                <div class="fitem">
                    &nbsp;&nbsp;&nbsp;<label>Work Order No</label><input name="work_order_no" class="easyui-textbox" id="work_order_no" required="required" style="width: 150px;">

                    &nbsp;&nbsp;&nbsp;
                    <label>Order Date:</label>
                    <input name="order_date" id="order_date" class="easyui-datebox" required="required" />
                
                </div>
                <br/>
                <div class="fitem">
                    <table width='100%' class="table_order">
                    <tbody>
                        <tr style="background: #F1F1F1;"><td>Item</td><td>Position/Description</td><td>Row</td><td>Column</td>
                            <td title="Quantity">Qty</td><td>Unit Price</td><td>Price</td>
                        </tr>
                        <tr style="background: #F1F1F1;">
                            <td>
                            <select name="item" class="item" id="item" style="width:150px;">
                                     <option value="addNew"> Add New </option>
                                      <?php
                            $query_additem = $con->prepare("Select typeid, type_name from tbl_type group by type_name order by typeid ASC");
                    $query_additem->execute();
                    while ($row_type = $query_additem->fetch(PDO::FETCH_ASSOC)) {
                        extract($row_type);
                        ?>
                        <option value="<?php echo $typeid; ?>"><?php echo $type_name; ?></option>
                        <?php
                    }
                    ?>
                            </select>
                        </td>
                        <td><input type="text" class="description" name="description" style="width:120px;"></td>
                        <td><input type="text" name="o_row" class="row" style="width:50px;" autocomplete="off"></td>
                        <td><input type="text" name="o_column" class="column" style="width:50px;" autocomplete="off"></td>
                            <td><input type="text" name="qty" class="qty" style="width:50px;" id="qty" ></td>
                            <td><input type="text" name="unit_price" id="unit_price" style="width:50px;" required="required" autocomplete="off"></td>
                            <td><input type="text" name="price" id="price" style="width:50px;" required="required" autocomplete="off" readonly="readonly"></td>
                        </tr>
                        <tr  style="font-weight: bold;"><td colspan="5"></td>
                            <td style="background: #F1F1F1; ">Gross Amount:</td>
                            <td style="background: #F1F1F1; "><span class="gross_amount"></span></td>
                        </tr>
                        <tr><td colspan="5"></td>
                            <td title="Front Page Charge(%)">Front Page Charge(%)</td>
                               <td><input type="text" name="front_page" class="front_page" style="width:100px;" required="required" autocomplete="off"></td>
                        </tr>
                        <tr><td colspan="5"></td>
                             <td title="Back Page Charge(%)">Back Page Charge(%)</td>
                              <td><input type="text" name="back_page" class="back_page" style="width:100px;" required="required" autocomplete="off"></td>
                        </tr>
                        <tr><td colspan="5"></td>
                                  <td title="Color Charge(%)">Color Charge(%)</td>
                                     <td><input type="text" name="color" class="color" style="width:100px;" required="required" autocomplete="off"></td>

                        </tr>
                            
                        <tr><td colspan="5"></td>
                          <td title="Payable Amount"   style="background: #F1F1F1; font-weight: bold;">Total Advt. Bill</td>
                          <td   style="background: #F1F1F1;"> 
                              <input type="text" name="total_add_amount" class="total_add_amount" style="width:100px;" value="0" readonly="readonly"></td>
                        </tr>
                      
                       
                           <tr><td colspan="5"></td>
                        <td title="Discount">Dis.(%)</td>
                          <td><input type="text" name="discount" id="discount" style="width:100px;" autocomplete="off" required="required"> </td>
                          
                        </tr>
                        <tr><td colspan="5"></td>
                         <td title="Discount Amount">Dis. Amt.</td>
                              <td><input type="text" name="discount_amount" id="discount_amount" style="width: 100px;" autocomplete="off" required="required" readonly="readonly"></td>
                        
                        </tr>
                         <tr><td colspan="5"></td>
                            <td   style="background: #F1F1F1; font-weight: bold;">Total Billing Amt.</td>
                            <td   style="background: #F1F1F1;"> <input type="text" name="txt_billing_amt" class="txt_billing_amt" style="width:100px;"></td>
                        </tr>
                          <tr><td colspan="5"></td>
                            <td>VAT(%)</td>
                              <td> <input type="text" name="vat" id="vat"  style="width:100px;" autocomplete="off" required="required"></td>
                       
                        </tr>
                        <tr><td colspan="5"></td>
                            <td>TAX(%)</td>
                            <td> <input type="text" name="tax" id="tax" style="width:100px;" autocomplete="off" required="required"></td>
                        </tr>
                         <tr><td colspan="5"></td>
                            <td   style="background: #F1F1F1; font-weight: bold;">Total Payable Amt.</td>
                                <td style="background: #F1F1F1;">
                                    <input type="text"  name="payable_amount" id="payable_amount" style="width:100px;" readonly="readonly"></td>
                         <input type="hidden" name="status" id="order_status" value="1">
                         </tr>
                         <tr><td></td><td colspan="5"></td></tr>
                        
                    
                        
                               
                      
    </tbody>
                    </table>	
                </div>
            </form>
            <script>
                $(document).ready(function(){
                    
                    
    // -------------- Calculate Row ---------------------
        $('.table_order tbody').delegate('.row,.column,.front_page,.back_page,.color,#unit_price,#vat,#tax,#discount','keyup',function(){
            // ******** row price cal ********
            var row = $('.row').val();
            var col = $('.column').val();
            var qty = row*col;
            $('.qty').val(qty);
            var t_qty = parseFloat($('.qty').val());
            var unit_price = $('#unit_price').val();
            var total_price = t_qty*unit_price;
            $('#price').val(total_price);
            var to_price = $('#price').val();
         //  console.log(t_qty);
           // ******** End row price cal ********
            var front_page = $('.front_page').val();
            var back_page = $('.back_page').val();
            var color = $('.color').val();
            var price =parseFloat(to_price);
            $('.gross_amount').text(price); // Just show gross amount of price
                var front_page_amt = (price*front_page)/100;
                var back_page_amt = (price*back_page)/100;
                var color_amt = (price*color)/100;
                var total_advt_amt = price + (front_page_amt+back_page_amt+color_amt);
                $('.total_add_amount').val(total_advt_amt); // show tatal Advt Amount
                
                var discount = $('#discount').val();
                var dis_amount = (total_advt_amt*discount)/100;
                var to_fixed_dis_amount = dis_amount.toFixed(2);
                $('#discount_amount').val(to_fixed_dis_amount);// get 2 decimal point of Dis Amount

                var total_billing_amt = total_advt_amt-dis_amount;
                var to_fixed_billing_amount = total_billing_amt.toFixed(2);
                $('.txt_billing_amt').val(to_fixed_billing_amount);

                var vat = $('#vat').val();
                var tax = $('#tax').val();
                var vat_amt = total_billing_amt*(vat/100);
                var tax_amt = total_billing_amt*(tax/100);
                var total_vat_tax = vat_amt+tax_amt;
                var payable_amount = total_billing_amt+total_vat_tax;
                var payable_amount_des = payable_amount.toFixed(2);
                $('#payable_amount').val(payable_amount_des);

           // console.log(dis_amount);
               // console.log(front_page_amt+' '+back_page_amt+' '+color_amt);
        });

   
        // -------------- End Calculate Row ---------------------
                   
                   
                   
                });
            </script>
        </div>

    </div>
</div> <!-- Order dialogBox End. -->



<div id="toolbar_order">
    <a href="javascript:void(0)"  class="easyui-linkbutton" iconCls="icon-add" plain="false" onclick="order_individual()" >New Order</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-invoice_color"  plain="false" onclick="invoice()">Create Invoice</a>
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-invoice_color"  plain="false" onclick="invoiceMulti()">Create Invoices by Multi-Select</a>

    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-bill" plain="false" onclick="IndividualAllInvoice()">Invoices / Bill </a>

    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ereceipt" plain="false" onclick="IndividualAllEReceipt()">E-Receipt</a>





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
        <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveUserAndNew()" style="width:auto">Save & New</a>
    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveUser()" style="width:90px">Save</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')" >Cancel</a>
</div>

<!-- ******************* Start Invoice Form ***************** -->

 <?php    include 'invoice/add_invoice.php'; ?>
<?php    include 'invoice/add_multi_invoice.php'; ?>
<!-- Invoice Form dialog end -->





<!-- *************************** For all Individual invoices ********************* -->

<div class="easyui-dialog" id="dlg_ind_all_invoices" data-options="iconCls:'icon-invoice_color' " style="width: 100%; height: 90%" closed='true' buttons='#dg_button_ind_all_invoice'>
    <div class="easyui-layout" data-options="region:'center' " >

        <table class="easyui-datagrid" id="dg_ind_all_invoices" pagination='false' showFooter='true' 
               singleSelect="false" rownumbers='true' toolbar='#dg_toolbar_ind_all_invoice' 
               sortName="order_id" sortOrder="desc"
               style="width:100%; height: 250px;">
            <thead>
                <tr>
                    <th data-options="field:'ck',checkbox:true "></th>
                    <th field="order_id" sortable="true">O. Id</th>
                    <th field='invoice_id'>Inv. Id.</th>
                    <th field='pub_date'>Pub. Date</th>
                    <th field='invoice_date'>Inv. Date</th>
                    <th field='order_date' sortable="true">O. Date</th>
                    <th field='size'>Size</th>
                    <th data-options="field:'price',align:'right' ">Price</th>
                <th data-options="field:'front_page',align:'right' " width="100">F. Page Charge(%)</th>
                <th data-options="field:'back_page',align:'right' "  width="100">B. Page Charge(%)</th>
                    <th data-options="field:'color',align:'right' "  width="100">Colr. Charge(%)</th>
                    <th data-options="field:'discount',align:'right' ">Dis.(%)</th>
                    <th data-options="field:'discount_amount',align:'right' ">Dis. Amt.</th>
            <th data-options="field:'vat',align:'right' ">VAT(%)</th>
            <th data-options="field:'tax',align:'right' ">TAX(%)</th>
                    <th data-options="field:'ait_others_discount',align:'right' "  width="100">AIT/Orthers</th>
                    <th data-options="field:'payable_amt_inv',align:'right',formatter:formatPrice">Due Amt.</th>
                    <th field="status" data-options="sortable:'true' "> Status</th>
                </tr>
            </thead>
        </table>
        <br/>

        &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
        <a href="javascript:void()" iconCls="icon-bill" class="easyui-linkbutton" onclick="loadPayment()">All Payments</a>
-- Click to see all transaction of this Client --
        <div id="individual_payment" style="max-height: 200px;">
            
        </div>
        <div class="easyui-dialog" id="dlg_payment_form" closed="true"  data-options="iconCls:'icon-bill' " 
             style="padding:5px; width:100%; height: 600px; " buttons="#dlg-buttons-payment" >
            <form name="receive_payment_form" id="receive_payment_form" method="POST">
                <h2 style="color:#555;">Customer Payment
                    <span style="float: right; color:#666;">
                        <label>Invoice ID # </label>
                        <input class="easyui-textbox" name="invoice_id" style="width:100px; border:1px #ccc solid;"/>
                        <input type="hidden" name="order_id" style="width:100px; border:1px #ccc solid;"/>
                    </span>
                </h2>
                <div class="left_div">
                      <table width='100%' cellpadding='5'>
                    <tr>
                        <td>Received From</td><td>
                            <input class="easyui-textbox" style="width: 200px;" name="name" id="name" />
                            <input type="hidden"  style="width: 150px;" name="cust_id" id="cust_id" />  
                            <input type="hidden"  style="width: 150px;" name="cust_id_new" id="cust_id_new" />
                            <input type="hidden" name="ref_id"> 
                        </td>
                    </tr>

                        <td>
                            </tr>
                    <tr>
                        <td>Amount</td><td><input type="text"  name="receive_amount" id="receive_amount" style=" font-weight: bold; width: 100px; padding: 2px; line-height: 18px; text-align: right;  border-radius: 5px; border:1px #ccc solid;"  required="required" autocomplete="off"/></td>
                        <td style="text-align: right;">Collected Amount</td><td><input type="text" name="paid_amount" id="paid_amount" style="  width: 100px; padding: 2px; line-height: 18px;  border-radius: 5px; border:1px #ccc solid;"/></td>
                    </tr>
                    <tr><td>Commission on Receive Amt.(%)</td>
                        <td><input type="text"  name="commission" id="commission" style=" font-weight: bold; width: 100px; padding: 2px; line-height: 18px; text-align: right;  border-radius: 5px; border:1px #ccc solid;"  required="required" autocomplete="off"/></td>
                             <td>Receivable Amount</td><td><input type="text"  name="payable_amt_inv" id="payable_amount_p" style=" font-weight: bold; width: 100px; padding: 2px; line-height: 18px;  border-radius: 5px; border:1px #ccc solid;"  /></td>
                    </tr>
                    <tr>
                        <td>AIT and Others/ Adjustment:</td>
                        <td>
                            <input type="text"  name="ait_others_discount" id="ait_others_discount" style=" font-weight: bold; width: 100px; padding: 2px; line-height: 18px; text-align: right;  border-radius: 5px; border:1px #ccc solid;" value="0"  required="required" autocomplete="off"/>
                        </td>
                    </tr>
                    <tr>
                        <td>Payment Date</td><td><input class="easyui-datebox" name="payment_date" id="payment_date" required="required" /></td>
                   

                    </tr>
                    <tr>
                        <td>Pmt. Method</td><td>
                            <select class="easyui-combobox" name="payment_method" id="payment_method" style="width:150px;" required="required">
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
                </div>
                <div class="right_div">
                   
                    Price:<br>
                            <input class="easyui-textbox" name="price" id="txtprice" id="txtprice_p" style="margin:3px;" /><br/>
                       
                            Front Page(%):<br>
                             <input class="easyui-textbox" name="front_page" id="front_page_p" style="margin:3px;" /><br/>
                        
                        Back Page (%):<br>
                             <input class="easyui-textbox" name="back_page" id="back_page_p" style="margin:3px;" /><br/>
                        
                        Color Page (%):<br>
                             <input class="easyui-textbox" name="color" id="color_p" style="margin:3px;" /><br/>
                      
                        Discount (%): <br>
                         <input class="easyui-textbox" name="discount" id="txtdiscount" style="margin:3px;" /><br/>
                           
                       
                        Discount Amount:<br>
                         <input type="text" name="discount_amt" id="txtdiscount_amt" style="  width: 100px; padding: 2px; line-height: 18px;  border-radius: 5px; border:1px #ccc solid;" value=""  /><br/>
                           
                        
                        Total Advt. Bill (excluding VAT & TAX):<br>
                        <input  type="text"  name="order_price" id="order_price" style="  width: 100px; padding: 2px; line-height: 15px;  border-radius: 5px; border:1px #ccc solid;" /><br>
                        
                        VAT(%):<br>
                            <input class="easyui-textbox" name="vat" id="vat_p" style="margin:3px;" /><br/>
                      
                        TAX(%):<br>
                            <input class="easyui-textbox" name="tax" id="tax_p" style="margin:3px;" /><br/>
                       Total Amount (including VAT & TAX):<br>
                       <input type="text"  name="total_amount_v_t" id="total_amount_v_t" style="  width: 100px; padding: 2px; line-height: 15px;  border-radius: 5px; border:1px #ccc solid;" /><br/>
                 
                </div>
              

                <!--                     <div id="individual_payment" style="height:150px; max-height: 160px; overflow-y: scroll;">
                                          Select Receive from field To see all transaction. 
                                     </div>-->





                <div style="width: 350px; padding:0px 50px;">
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
                    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-save" onclick="savePayment()">Submit</a>
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

            <a href="javascript:void()" class="easyui-linkbutton" iconCls="icon-print" onclick="invoicePrint()" >Print Single Invoice</a>| 
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-print" onclick="allInvoicePrint()">Print Multi Invoice</a>
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



    // **************** For Individual All  Start **********************
    function formatStatus(val, row) {
        if (val === '1') {
            return '<span style="color:green;">(Created)</span>';
        } else if (val === '0') {
            return '<a href="#" style="color:red;" onclick="invoice();">(Invoice)</a>';
        }
        else {
            return val;
        }
    }
    function formatPrice(val, row) {
        if (val > 5000) {
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
        $('#dlg_ind_all_invoices').dialog('open').dialog('setTitle', 'All invoices of ' + row.name + ', Client ID: ' + row.cust_id_new);
        $('#dg_ind_all_invoices').datagrid({
            url: 'invoice/get_ind_all_invoices.php?invoice_q=' + row.cust_id
        });
    }


    var url_payment;
    function newPayment() {

        var row = $('#dg_ind_all_invoices').datagrid('getSelected');
        //$.messager.alert("Message",row.invoice_num,"info"); 
        if (row) {

            $('#dlg_payment_form').dialog('open').dialog('setTitle', 'Receive Payment Form of ' + row.name + ', Client ID: ' + row.cust_id_new);

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
            var price = row.price; var price_amt = parseFloat(price.replace(/,/g, ''));
            var front_page= row.front_page; var front_parse_amt= parseFloat(front_page.replace(/,/g, ''));
            var front_amt = price_amt*(front_parse_amt/100);
            
            var back_page= row.back_page; var back_parse_amt= parseFloat(back_page.replace(/,/g, ''));
            var back_amt = price_amt*(back_parse_amt/100);
            
            var color_page= row.color; var color_parse_amt= parseFloat(color_page.replace(/,/g, ''));
            var color_amt = price_amt*(color_parse_amt/100); 
            
            var dis_amt = row.discount_amount;
            
            var p = price_amt + parseFloat(front_amt) + parseFloat(back_amt) 
                    + parseFloat(color_amt) - parseFloat(dis_amt.replace(/,/g, '')); // without vat and tax
            $('#order_price').val(p); // invoice price after commission
            // End Order price will be receivable amount subtract from discount.
            $('#txtdiscount_amt').val(dis_amt); // put discount amt
            
            var vat = row.vat; var vat1 = parseFloat(vat);
            var vat_amt = p*(vat1/100);
            
            var tax = row.tax; var tax1 = parseFloat(tax);
            var tax_amt = p*(tax1/100);
            
            // Start For Display Paid Amt in payment form
            //parseFloat('100,000.00'.replace(/,/g, ''))
            var total_amount = p + vat_amt + tax_amt; // including vat and tax
            var total_amount1 = total_amount.toFixed(2);
            $('#total_amount_v_t').val(total_amount1);
            
            var payable_amount = row.payable_amt_inv; var payable_amount1 = payable_amount.replace(/,/g, '');
            var ait_others = row.ait_others_discount; var ait_others1 = ait_others.replace(/,/g, '');

            var payable_ait_amt = parseFloat(payable_amount1) + parseFloat(ait_others1);
            var paid_amt = parseFloat(total_amount) - parseFloat(payable_ait_amt);
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
                    $('#dlg_payment_form').dialog('close');		// close the dialog
                    $('#dg_ind_all_invoices').datagrid('reload');	// reload the user data
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

var x = document.getElementById('individual_payment');
if(x.style.display === "none"){
    x.style.display = "block";
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
}else{
    x.style.display = "none";
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
            var payment_date = $('#payment_date').datebox('getText');	// get datetimebox value

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
        var rows = $('#dg_ind_all_invoices').datagrid('getSelections');
        var ids=[];
        if (row) {
                    for(var i=0; i<rows.length; i++){
             ids.push(rows[i].invoice_id);
    }
    //   	alert(ids.join('\n'));
        
          window.open("Report/print_individual_cust_invoice_new.php?cust_id=" + row.cust_id + "&inv_id=" + row.invoice_id, "myNewWinsr", "width=990,height=600,toolbar=0,menubar=no,status=no,resizable=yes,location=no,direction=no,scrollbars=yes");
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
 var rows = $('#dg_ind_all_invoices').datagrid('getSelections');
        var ids=[];
            if (row) {
                      for(var i=0; i<rows.length; i++){
             ids.push(rows[i].invoice_id);
        }
        window.open("Report/print_individual_cust_all_invoice.php?cust_id=" + row.cust_id + "&ids=" + ids, "myNewWinsr", "width=990,height=600,toolbar=0,menubar=no,status=no,resizable=yes,location=no,direction=no,scrollbars=yes");
        }
        
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
                url: 'order/get_order.php?q=' + row.cust_id

            });// grid_order individual data load.

            $('#profile').dialog('open').dialog('setTitle', ' Order of ' + row.name + ', Customer Id: ' + row.cust_id_new);

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
                msg: 'Please select atleast one Client. And create new order, invoice, bill and more..',
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
                    
                    $('#reference').dialog('close');		// close the dialog
                    //$('#dg').datagrid('reload');	// reload the user data
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
        $('#order_individual').dialog('open').dialog('setTitle', 'Add New Order. Customer Id: ' + row.cust_id_new);
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
            $('#order_date').datebox('setValue', datea);
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
        $('order_save_btn').val("Please Wait...");
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
                $('order_save_btn').val("Save");
                    $('#grid_order').datagrid('reload');	// reload the user data
                    $('#order_form').form('clear');
                    $('#order_individual').dialog('close');		// close the dialog
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
                            $('#grid_order').datagrid('reload');	// reload the user data
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
          var x = document.getElementById("demo");
    if (x.style.display === "none") {
        x.style.display = "block";
         var row = $('#dg').datagrid('getSelected');
            $.ajax({
                url: 'pages/display_individual_profile.php?q=' + row.cust_id_new,
                success: function (data) {
                    $('p#demo').html(data);
                }
            });
    } else {
        x.style.display = "none";
    }
       

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

        // *************** Start Multi Invoice Form related work ***********
                var url_invoice_multi;
    function invoiceMulti() {
        var row = $('#grid_order').datagrid('getSelected');
        if (row) {
            $('#dg_invoice_multi_form').dialog('open').dialog('setTitle', 'Create Multiple Invoice');
            $('#dg_invoice_multi_form').form('load', row);
            // var ids = []; 
			var rows = $('#grid_order').datagrid('getSelections');
                        var sr =1;
                        
			for(var i=0; i<rows.length; i++){
                            
                               var tr = '<tr  style="background:#f1f1f1;"><td>'+ sr++ +'</td>'+
        '<td class="center"><input type="text" name="cust_id[]" required="required" readonly="true" autocomplete="off" value="'+rows[i].cust_id+'"></td>'+
        '<td class="center"><input type="text" name="cust_id_new[]" required="required" readonly="true" autocomplete="off" value="'+rows[i].cust_id_new+'"></td>'+
        '<td class="center"><input type="text" name="order_id[]" required="required" readonly="true" autocomplete="off" value="'+rows[i].order_id+'"></td>'+
        '<td class="center"><input type="text" name="order_date[]" value="'+rows[i].order_date+'" readonly="true"></td>'+
        '<td class="center"><input type="text" name="pub_date[]" class="pub_date" ></td>'+
        '<td class="center"><input type="text" name="invoice_date[]" class="invoice_date" ></td>'+
        '<td class="center"><input type="text" name="payable_amount[]" readonly="true" value="'+rows[i].payable_amount+'"></td>'+
        '<td class="center"><input type="text" name="work_order_no[]" readonly="true" value="'+rows[i].work_order_no+'"></td>'+
        '<td class="center"><input type="text" name="ref_id[]" readonly="true" class="easyui-datebox" value="'+rows[i].ref_id+'"></td>'+
        '<td class="center"><input type="text" name="item[]" readonly="true" value="'+rows[i].item+'"></td>'+    
                        '</tr>';
                     $('tbody.multi_invoice_table').append(tr);
				// ids.push(rows[i].order_id);
			}
//			alert(ids.join('\n'));
            url_invoice_multi = 'invoice/save_multi_invoice.php';
        }
        else {
            //$.messager.alert('Message', "Please select atleast one item for Invoice.", 'info');
            $.messager.show({
                title: 'Message',
                msg: 'Please select atleast one order.',
                showType: 'show',
                style: {
                    right: '',
                    bottom: ''
                }

            });
       }
    } // invoice Multiple function.
    function saveMultiInvoice() {
               var pub_date =  $('.pub_date').val();
               var invoice_date =  $('.invoice_date').val();
               if(pub_date!=="" && invoice_date!==""){
        $('#multi_invoice_form').form('submit', {
            url: url_invoice_multi,
            onSubmit: function () {
                return $(this).form('validate');
            },
            success: function (result) {
                console.log(result);
                var result1 = eval('(' + result + ')');
                if (result1.errorMsg) {
                    $.messager.show({
                        title: 'Error',
                        msg: result1.errorMsg
                    });
                } else {
                  $('#grid_order').datagrid('reload');	// reload the user data
                   // $('#dg_invoice_form').form('clear');
                     $('tbody.multi_invoice_table').text(""); // after submit row of table will be empty
                    $('#dg_invoice_multi_form').dialog('close');  // close the dialog
                    $.messager.show({
                        title: 'Message',
                        msg: 'Invoice Created successfully.',
                        showType: 'show'
                    });
                }
            }
        });
               }else{
                   alert('Please Fill all of the Published Date and Invoice Date.');
               }
    }
    function MultiDialogboxClose(){
         $('#dg_invoice_multi_form').dialog('close');
           $('tbody.multi_invoice_table').text("");
    }
// End Multiple Invoice
 // *************** Start Individual Invoice Form related work ***********
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
                msg: 'Please select atleast one order.',
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
                var result1 = eval('(' + result + ')');
                if (result1.errorMsg) {
                    $.messager.show({
                        title: 'Error',
                        msg: result1.errorMsg
                    });
                } else {
                
                   $('#grid_order').datagrid('reload');	// reload the user data
                   // $('#invoice_form').form('clear');
                     $('tbody.multi_invoice_table').text(""); // after submit row of table will be empty
                    $('#dg_invoice_form').dialog('close');		// close the dialog
//                    setTimeout(
//                         function(){
//                                document.getElementById( "invoice_form" ).reset();
//                            },5);
                    // $.messager.alert('Message',"Saved successfully ","info");
                    $.messager.show({
                        title: 'Message',
                        msg: 'Invoice Created successfully.',
                        showType: 'show'
                    });
   
                }
            }
        });
    }

    // Individual Invoice SaveInvoice Function End.


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
    function newUser() {
        $('#dlg').dialog('open').dialog('setTitle', 'New Customer Information');
        $('#fm').form('clear');
        url = 'customer_profile/save_user.php';
    }

    function editUser() {

        var row = $('#dg').datagrid('getSelected');

        if (row) {
            $('#dlg').dialog('open').dialog('setTitle', 'Edit Member');
            $('#fm').form('load', row);
            var jd = row.join_date;
            var d = new Date(jd);
            var date = d.getDate();
            var month = d.getMonth() + 1;
            var year = d.getFullYear();
            //(date + "/" + month + "/" + year);
            var datea = month + "/" + date + "/" + year;
            $('#cust_id_new').val(row.cust_id_new);
            $('select#ref_name').append('<option value="' + row.ref_id + '" selected="selected" >' + row.ref_name + '</option>');
            $('select.address').append('<option value="' + row.address + '" selected="selected" >' + row.address + '</option>');
            $('select.district').append('<option value="' + row.id + '" selected="selected" >' + row.statename + '</option>');
            $('select.upazila').append('<option  value="' + row.id + '" selected="selected">' + row.city + '</option>');
            url = 'customer_profile/update_user.php?id=' + row.cust_id;
        }
        else {
            $.messager.show({
                title: 'Message',
                msg: 'Please select atleast one item..',
                showType: 'show'
            });
        }

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

    function saveUser() {
        $('#fm').form('submit', {
            url: url,
            onSubmit: function () {
                return $(this).form('validate');
            },
            success: function (result) {
                var result1 = eval('(' + result + ')');
                if (result1.errorMsg) {
                    $.messager.show({
                        title: 'Error',
                        msg: result1.errorMsg
                    });
                } else {
                    $('#dlg').dialog('close');		// close the dialog
                    $('#dg').datagrid('reload');	// reload the user data
                    $.messager.show({
                        title: 'Message',
                        msg: 'Customer info Saved Successfully.',
                        showType: 'show'
                    });
                }
            }
        });
    }
    // End Save User Function
    
    function saveUserAndNew() {
        $('#fm').form('submit', {
            url: url,
            onSubmit: function () {
                return $(this).form('validate');
            },
            success: function (result) {
                var result1 = eval('(' + result + ')');
                if (result1.errorMsg) {
                    $.messager.show({
                        title: 'Error',
                        msg: result1.errorMsg
                    });
                } else {
                    $('#dlg').dialog('open');// close the dialog
                    $('#fm').form('reset');
                    $('#cust_id_new').val('');
                    $('#dg').datagrid('reload');	// reload the user data
                    $.messager.show({
                        title: 'Message',
                        msg: 'Customer info Saved Successfully.',
                        showType: 'show'
                    });
                }
            }
        });
    }


    function destroyUser() {
        var row = $('#dg').datagrid('getSelected');
        if (row) {
            $.messager.confirm('Confirm', 'Are you sure you want to destroy this Client? You will lost all data from database of this Client. Confirm! ', function (r) {
                if (r) {
                    $.post('customer_profile/destroy_user.php', {id: row.cust_id}, function (result) {
                        if (result.success) {
                            $('#dg').datagrid('reload');	// reload the user data
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
    
       
       // START COMPANY TYPE ON SELECT SHOW COMPANY CATEGORY
       
       function companyType(companytypeId) {		
		
		var strURL="pages/findCompanyCat.php?companytypeId="+companytypeId;
		var req = getXMLHTTP();
		// alert(companytypeId);
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById('txtproject_name').innerHTML=req.responseText;	
                                            
					} else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}		
	}
       // END COMPANY TYPE ON SELECT SHOW COMPANY CATEGORY

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
                    data: [{value: '', text: 'All'}, {value: '1', text: 'Created'}, {value: '0', text: 'Invoice'}],
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
            var hrf = $(this).attr("href", "customer_profile/printCustomer.php?q=" + cust_id);
//                $("#customerPrint").printPage({
//                    url: hrf,
//                    attr: "href",
//                    message:"Your document is being created.."
//                  });
        });
        $("#indcustomerPrint").on("click", function ()
        {
            var row = $('#dg').datagrid('getSelected');
            var cust_id = row.cust_id;
            var hrf = $(this).attr("href", "customer_profile/individualPrintCustomer.php?q=" + cust_id);

        });
        
           $("#orderPrint").on("click", function ()
        {
            var row = $('#dg').datagrid('getSelected');
            var cust_id = row.cust_id;
            var hrf = $(this).attr("href", "customer_profile/print_order_indi.php?q=" + cust_id);

        });
        

    });
    


</script>
