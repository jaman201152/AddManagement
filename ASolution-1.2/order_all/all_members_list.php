   
<table id="dg" title="List of all orders" class="easyui-datagrid" style="width:100%; height: 450px; overflow-x: scroll; overflow-y:scroll; "
	data-options="view:scrollview,iconCls:'icon-order', multiSort:true " url="order_all/member_search.php"
			toolbar="#toolbar" 
			rownumbers="true" fitColumns="true" singleSelect="false" showFooter="true" >
		<thead>
			<tr>
<!--                                <th data-options="field:'ck',checkbox:true "></th>-->
                                <th data-options="field:'ck',checkbox:true "></th>
                                <th field="id_name_upaz" width="200" sortable="true">Client Id,Name,Sub-District</th>
                                <th field="order_id" with="auto" sortable="true" style="width:100px;">Order Id. </th>
                                <th field="work_order_no" with="100" sortable="true" style="width:100px;">Work Order No. </th>                               
                <th field="order_date" width="150" sortable="true">Order Date</th>
                                <th field="total_add_bill" width="150" sortable="true" data-options="align:'right' ">Billing Amt.</th>
                            <th field="discount_amount" width="100" sortable="true" data-options="align:'right' ">Dis Amt.</th>
                            <th field="total_bill_after_dis" width="150" sortable="true" data-options="align:'right' ">Bill Amt. (After Discount)</th>
                            <th field="vat_amt" width="100" sortable="true" data-options="align:'right' ">VAT</th>
                            <th field="tax_amt" width="100" sortable="true" data-options="align:'right' ">Tax</th>
				<th field="payable_amount" width="150" sortable="true" data-options="align:'right' ">Total Receivable Amt.</th>
                                <th field="status" data-options="formatter:formatStatus" width="100" sortable="true">Inv. Status</th>
                                   <th field="ref_id_name_upaz" width="150" sortable="true">Ref. Id,Name,Sub-district</th>
                                <th field="project_name" width="100" sortable="true">Project Name</th>
                        </tr>
                        
		</thead>
               
</table>


	<div id="toolbar">
          <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="false" onclick="order_individual()">Add New Order</a>
                    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="false" onclick="order_multi()">Multi-Order</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-invoice_color"  plain="false" onclick="invoice()"> Create Invoice</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-invoice_color"  plain="false" onclick="invoiceMulti()"> Create Multi-Invoices</a>
      <!--      <a href="javascript:void(0)" class="easyui-linkbutton" id="edt" iconCls="icon-edit" plain="false" onclick="editUser()">Edit </a>
            <a href="javascript:void(0)" class="easyui-linkbutton" id="cnl" iconCls="icon-remove" plain="false" onclick="destroyUser()">Destroy </a>
            <a href="javascript:void(0)" class="easyui-linkbutton" id="client_profile" iconCls="icon-profile" plain="false" onclick="profile()">Profile</a>-->

<!--      <a href="javascript:void(0)" class="easyui-linkbutton" iconCls='icon-tip' plain='true' onclick="detailsView()">Details</a>-->
<span style="float: right;"><input type="text"  id="txtsearch" />
            <a href="#" class="easyui-linkbutton" plain="false" iconCls="icon-search" onclick="doSearch()" title="Search by Customer id, Order Id, Ref. Name, Project Name" >Search</a>
    </span>
    <span style="float: right;">
        From: <input type="text" class="easyui-datebox" size="10"  name="txt_from_date" id="txt_from_date" placeholder="From Date" />
  To:  <input type="text" class="easyui-datebox" size="10"  name="txt_to_date" id="txt_to_date" placeholder="To Date" />
            <a href="#" class="easyui-linkbutton" plain="false" iconCls="icon-search" onclick="filter_AllOrders()" >Filter</a>
            &nbsp; &nbsp; &nbsp;
    </span>
            
        </div>
<!-- End Customer tool bar -->

<!-- Company Type Name Form Window-Layout Start -->
    <?php include'company_type/add_company_type.php'; ?>
<!-- End Company Type dialogbox -->

<!-- Company Category Form Window-Layout Start -->
    <?php include'company_cat/add_company_cat.php'; ?>
<!-- End Company Category dialogbox -->

<!-- Reference Name Form Window-Layout Start -->
    <?php include'reference_profile/add_reference.php'; ?>
<!-- Reference dialogbox End. -->

<!-- Type Name Form Window-Layout Start -->
    <?php include'add_type/add_type.php';?>
<!-- End Type dialogbox -->

<!-- Individual Profile dialog-Layout Start -->
<div id="profile" class="easyui-dialog" style="width:80%;height:600px; padding:2px 2px;"
		data-options="iconCls:'icon-profile' " closed="true" buttons="#south_buttons">
    <div class="easyui-layout" fit="true"  id="profile_layout" >
       
<!--        <div data-options="region:'north',split:'true'" style="width:700px; height: 45px; padding:5px 20px;">
            <a href="javascript:void(0)"  class="easyui-linkbutton" iconCls="icon-order_color" onclick="order_individual()" style="width:80px; background: #F1F1F1;">Order</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-invoice_color" onclick="invoice_individual()"  style="width:80px; background: #F1F1F1;">Invoice</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-bill" onclick="bill_individual()" style="width:80px; background: #F1F1F1;">Bill</a>
        </div>-->
        <div data-options=" region:'west',split:'true',title:' ' " style="width:150px; padding:3px;">
            <li><a href="#">Email</a></li>
        </div>
        <div data-options=" region:'center', split:'true', iconCls:'icon-ok' " style="padding:5px;width:750px; height:550px;">
            
              <table id="grid_order" title="List of Order's" class="easyui-datagrid" style="width:100%; min-height: 130px; max-height:250px;"
			toolbar="#toolbar_order" pagination="true"
			 singleSelect="true" showFooter="true" fitColumn="true" >
		<thead>
			<tr>
                            <th data-options="field:'ck',checkbox:true "></th>
                            <th field="order_id" width="auto" title="Order ID" >O. ID.</th>
                            <th field="o_date" width="auto">O. Date</th>
                            <th field="item" width="auto">Item</th>
                            <th field="ref_name" width="auto">Ref. Name</th>
                            <th field="price" width="auto" data-options="align:'right' ">Price</th>
                            <th field="discount" width="auto" data-options="align:'right' ">Discount(%)</th>
                            <th field="payable_amount" width="auto" data-options="align:'right' ">Payable Amount</th>
                            <th data-options="field:'status',align:'center',formatter:formatStatus">Status</th>
                        
			</tr>
                    
		</thead>
                
                  </table>
                  
            <br/>
            <p id="demo" style="max-height:230px; overflow-y: scroll; "></p>
             
<!--              <div id="individual_order" >
                  
              </div>-->
          
        </div>
        
         
    </div>

</div>
<!-- Individual Profile Dialog-Layout End -->
<!-- Order dialog Start -->
<div id="dlg_order_individual" class="easyui-dialog" style="width:850px;height:600px; padding:2px 2px;"
     closed="true" buttons="#order_south_buttons" title="" data-options="iconCls:'icon-order_color' ">
    <div class="easyui-layout" fit="true"  id="order_layout" >
       
     
        <div data-options=" region:'center', split:'true', title:'Order form' " style="padding:10px 20px">
             <form id="order_form" method="post" novalidate>
                <div class="fitem" style="background: #F1F1F1;">
                <label>Company Name. </label>
         <input name="cust_id"  class="easyui-combobox cust_id" id="cust_id" style="text-align: right; padding: 2px; width:250px; "  autocomplete="off" required="required" /> &nbsp;&nbsp;&nbsp;
         <input type="hidden" name="cust_id_new"  class="cust_id_new" id="cust_id_new" style="text-align: right; padding: 2px;" complete="off" required="required" /> &nbsp;&nbsp;&nbsp;
         <input type="hidden" name="name" class="name" value="" />                
                </div>
                <br/>
                <table>
                        <tr>
                            <td>      
                                <div class="fitem">
                     <label>Company Type </label>
                     <select name="type" id="txttype" style="width:150px;" onchange="companyType(this.value)">
                          <option value=" ">Select Any One</option>
                         <option value="addNew">Add New</option>
                              <?php
                    include 'conn.php';
                    $query_company_type = $con->prepare("Select companytypeid, company_type_name from company_type_tbl group by company_type_name");
                    $query_company_type->execute();
                    while ($row_ref = $query_company_type->fetch(PDO::FETCH_ASSOC)) {
                        extract($row_ref);
                        ?>
                        <option value="<?php echo $companytypeid;?>"><?php echo $company_type_name; ?></option>
                        <?php
                    }
                    ?>
                    </select>
                                </div>
                            </td>
                            <td>
                                  <div class="fitem">
                    &nbsp;&nbsp;&nbsp; <label>Company Category</label>
                    <select name="project_name" id="txtproject_name" class="txtproject_name" style="width:150px; " >
                        <option value=" ">Select Company Type First</option>
                    </select>
                        </div>
                            </td>
                        </tr>
                        
                        <tr>
                            <td>
                                   <div class="fitem">
                                      
                              <label>Reference Name</label>
                              <select name="ref_id" id="ref_name"  required="required" style="width:200px;">
                    <option value=" ">-- Please Select --</option>
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
                            </td>
                            
                    <td>
                <div class="fitem">
                <label>Contact Person Name </label>
                <input name="contact_person"  id="contact_person" class="easyui-textbox contact_person"   autocomplete="off"  />        
                </div>
                    </td>
                </tr>
               
                </table>
                
             
                <table>
                    <tr>
                        <td>
                              <div class="fitem">
                <label>Phone No </label>
                <input name="phone"  id="phone" class="easyui-textbox"   autocomplete="off"  />        
                </div>
                        </td>
                        <td>
                        <div class="fitem">
                            <label>Email </label>
                            <input name="email" class="easyui-textbox"  id="email"   />        
                        </div>
                        </td>
                    </tr>
                </table>
                <div class="fitem">
                        <label>Division</label>
                        <select  name="division" id="country" required="required" onChange="getState(this.value)">
                            <option value=" ">Select Division</option>
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
                        <div id="statediv_order_form">
                            <label>District</label>
                            <select name="district" class="district" >
                                <option value=" ">Select Division First</option>
                            </select>
                        </div>
                        
                      </div>
                    <div class="fitem">
                        
                        <div id="citydiv_order_form">
                            <label>Upazila</label>
                            <select name="upazila" class="sub_district">
                                <option value=" ">Select District First</option>
                            </select></div>
                    </div>
                <br/>
                <table>
                    <tr>
                        <td>
                              <div class="fitem">
                                  <label>Work Order No <span ></span></label><input name="work_order_no" class="easyui-textbox" id="work_order_no" required="required" style="width: 150px;">
                </div>
                        </td>
                        <td>
                             <div class="fitem">
                <label>Order Date:</label>
                <input name="order_date" id="order_date" class="easyui-datebox" required="required" value="<?php echo date("m/d/Y H:i:s, true, 'Asia/Dhaka' "); ?> "  />
             </div>
                        </td>
                    </tr>
                </table>
              
            
           <br/>
                <div class="fitem">
                    <table width='100%' class="table_order">
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
                        <td><input type="text" name="o_row" class="row" style="width:50px;" autocomplete="off" required="required"></td>
                        <td><input type="text" name="o_column" class="column" style="width:50px;" autocomplete="off" required="required"></td>
                            <td><input type="text" name="qty" class="qty" style="width:50px;" id="qty" required="required"></td>
                            <td><input type="text" name="unit_price" id="unit_price" style="width:80px;" required="required" autocomplete="off"></td>
                            <td><input type="text" name="price" id="price" style="width:100px;" required="required" autocomplete="off" readonly="readonly"></td>
                        </tr>
                     <tr  style="font-weight: bold;"><td colspan="5"></td>
                            <td style="background: #F1F1F1; ">Gross Amount:</td>
                            <td style="background: #F1F1F1; "><span class="gross_amount"></span></td>
                        </tr>
                        <tr><td colspan="5"></td>
                            <td title="Front Page Charge(%)">Front Page Charge(%)</td>
                            <td><input type="text" name="front_page" class="front_page" style="width:100px;" value="0" required="required" autocomplete="off"></td>
                        </tr>
                        <tr><td colspan="5"></td>
                             <td title="Back Page Charge(%)">Back Page Charge(%)</td>
                             <td><input type="text" name="back_page" class="back_page" style="width:100px;" required="required" value="0" autocomplete="off"></td>
                        </tr>
                        <tr><td colspan="5"></td>
                                  <td title="Color Charge(%)">Color Charge(%)</td>
                                  <td><input type="text" name="color" class="color" style="width:100px;" required="required" value="0" autocomplete="off"></td>
                        </tr>
                            
                        <tr><td colspan="5"></td>
                          <td title="Payable Amount"   style="background: #F1F1F1; font-weight: bold;">Total Advt. Bill</td>
                          <td   style="background: #F1F1F1;"> 
                              <input type="text" name="total_add_amount" class="total_add_amount" style="width:100px;" value="0" readonly="readonly"></td>
                        </tr>
                      
                       
                           <tr><td colspan="5"></td>
                        <td title="Discount">Dis.(%)</td>
                        <td><input type="text" name="discount" id="discount" style="width:100px;" value="0" autocomplete="off" required="required"> </td>
                          
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
                            <td> <input type="text" name="vat" id="vat"  style="width:100px;" autocomplete="off" value="0" required="required"></td>
                       
                        </tr>
                        <tr><td colspan="5"></td>
                            <td>TAX(%)</td>
                            <td> <input type="text" name="tax" id="tax" style="width:100px;" value="0" autocomplete="off" required="required"></td>
                        </tr>
                         <tr><td colspan="5"></td>
                            <td   style="background: #F1F1F1; font-weight: bold;">Total Payable Amt.</td>
                                <td style="background: #F1F1F1;">
                                    <input type="text"  name="payable_amount" id="payable_amount" style="width:100px;"></td>
                         <input type="hidden" name="status" id="order_status" value="0">
                         </tr>
                         <tr><td></td><td colspan="5"></td></tr>
                   
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
            var price_gross = price.toFixed(2);
            $('.gross_amount').text(price_gross); // Just show gross amount of price
                var front_page_amt = (price*front_page)/100;
                var back_page_amt = (price*back_page)/100;
                var color_amt = (price*color)/100;
                var total_advt_amt = price + (front_page_amt+back_page_amt+color_amt);
                $('.total_add_amount').val(total_advt_amt.toFixed(2)); // show tatal Advt Amount
                
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
           <a href="javascript:void(0)"  class="easyui-linkbutton" iconCls="icon-order_color" plain="true" onclick="order_individual()" >New Order</a>
           <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-invoice_color"  plain="true" onclick="invoice()">Create Invoice</a>
           <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-bill" plain="true" onclick="IndividualAllInvoice()">All Invoices</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" id="edt_order" iconCls="icon-edit" plain="true" onclick="editOrder()">Edit </a>
            <a href="javascript:void(0)" class="easyui-linkbutton" id="cnl_order" iconCls="icon-remove" plain="true" onclick="destroyOrder()">Destroy </a>
           

<!--        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls='icon-tip' plain='true' onclick="detailsView()">Details</a>-->
<span style="float: right;"><input type="text" name="txtsearch_order"  id="txtsearch_order" >
            <a href="#" class="easyui-linkbutton" plain="false" iconCls="icon-search" onclick="doSearch_order()" >Search</a>
        </span>
        </div>
<!-- south_buttons start for Order form -->
             <div id="order_south_buttons">
                 <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-reset" onclick="clearForm()" >Reset</a>
                <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveOrder()" class="Save" >Save</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg_order_individual').dialog('close')" >Cancel</a>
            </div>
<!-- south_buttons start for Order form -->
<!-- south_buttons start for invidual profile -->
             <div id="south_buttons">
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#profile').dialog('close')" >Cancel</a>
            </div>
<!-- dlg botton Start-->
	
<!-- ******************* Start Invoice Form ***************** -->
    <?php include'order_all/add_multi_order.php'; ?>
<!-- Invoice Form dialog end -->

<!-- ******************* Start Invoice Form ***************** -->

    <?php    include 'invoice/add_invoice.php'; ?>
<?php    include 'invoice/add_multi_invoice.php'; ?>
<!-- Invoice Form dialog end -->
   
    
    
    <!-- *************************** For all Individual invoices ********************* -->
    
    <div class="easyui-dialog" id="dlg_ind_all_invoices" data-options="iconCls:'icon-invoice_color' " style="width: 70%; height: 70%" closed='true' buttons='#dg_button_ind_all_invoice'>
        <div class="easyui-layout" data-options="region:'center' " >
        
            <table class="easyui-datagrid" id="dg_ind_all_invoices" pagination='true' showFooter='true' 
                   singleSelect="true" toolbar='#dg_toolbar_ind_all_invoice' style="max-height: 250px;">
                <thead>
                    <tr>
                        <th data-options="field:'ck',checkbox:true "></th>
                        <th field='invoice_num'>Invoice Num.</th>
                        <th field='cust_id'>Cust. ID</th>
                        <th field='invoice_date'>Inv. Date</th>
                        <th field='item'>Item</th>
                        <th field='size'>Size</th>
                        <th field='qty'>Qty.</th>
                        <th data-options="field:'unit_price',align:'right' ">Unit Rate</th>
                        <th data-options="field:'price',align:'right' ">Price</th>
                        <th data-options="field:'discount',align:'right' ">Commission(%)</th>
                        <th data-options="field:'payable_amount',align:'right',formatter:formatPrice">Payable Amt.</th>
                        
                    </tr>
                </thead>
            </table>
            <br/>
            
            &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
            <a href="javascript:void()" iconCls="icon-bill" class="easyui-linkbutton" onclick="loadPayment()">All Payments</a>
            
            <div id="individual_payment" style="height:150px; max-height: 160px; overflow-y: scroll;">
                         -- Click the above to see all transaction of this selected Client --
                </div>
         <div class="easyui-dialog" id="dlg_payment_form" closed="true"  data-options="iconCls:'icon-bill',title:'Bill Receive Payment Form' " 
             style="padding:5px; width:60%; height: 65%; " buttons="#dlg-buttons-payment" >
            <form name="receive_payment_form" id="receive_payment_form" method="POST">
                <h2 style="color:#555;">Customer Payment
                    <span style="float: right; color:#666;">
                        <label>Invoice Num # </label>
                        <input class="easyui-textbox" name="invoice_num" style="width:100px; border:1px #ccc solid;"/>
                        <input type="hidden" name="order_id" style="width:100px; border:1px #ccc solid;"/>
                    </span></h2>
                     <table width='100%' cellpadding='5'>
                        <tr>
                            <td>Received From</td><td>
                    <input class="easyui-textbox" style="width: 150px;" name="name" id="name" />
                    <input type="hidden"  style="width: 150px;" name="cust_id" id="cust_id" />  
                            </td>
                            <td>Payable Amount</td><td><input type="text"  name="payable_amount" id="payable_amount_p" style="width: 100px; padding: 2px; line-height: 18px; text-align: right; border-radius: 5px; border:1px #ccc solid;"  /></td>
                        </tr>
                        
                        <tr>
                            <td>Amount</td><td><input type="text"  name="receive_amount" id="receive_amount" style="width: 100px; padding: 2px; line-height: 18px; text-align: right; border-radius: 5px; border:1px #ccc solid;"  required autocomplete="off"/></td>
                            <td>Date</td><td><input class="easyui-datebox" name="payment_date" ></input></td>
                        </tr>
                        <tr>
                                <td>Pmt. Method</td><td>
                                    <select class="easyui-combobox" name="payment_method" style="width:150px;">
                                    <option value="Cash">Cash</option>
                                    <option value="Bank">Bank</option>
                                </select></td>
                                <td>Check #</td><td><input class="easyui-textbox" name="check_num"></input></td>
                        </tr>
                        <tr>
                            <td>Memo</td><td><input class="easyui-textbox" name="memo"></input></td>
                                    <td>Deposit to</td><td>
                                        <select class="easyui-combobox" name="deposite_to" style="width: 150px;">
                                    <option value="receive">Receive</option>
                                </select></td>
                        </tr>
                        
                        <tr><td></td><td></td><td></td><td></td></tr>
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
                                     <td>Amount Due</td><td><input  name="due" id="due" style="width: 100px; padding: 2px 5px; line-height: 18px; text-align: right; border-radius: 5px; border:1px #ccc solid;"/></td>
                                 </tr>
                                 
<!--                                 <tr>
                                     <td>Discount and Credits Applied</td><td><input class="easyui-textbox" name="txtdue" id="txtdue"/></td>
                                 </tr>-->
                                 <tr><td></td><td>&nbsp;</td></tr>
                             </table>
                         </fieldset>
                     </div>
                         <div id="dlg-buttons-payment" style="text-align: right;">
          
                    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-save" onclick="savePayment()">Save</a>
                    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg_payment_form').dialog('close')">Cancel</a>
                    
                        </div>
                     </form>
                 </div>    
            
            <div id="dg_toolbar_ind_all_invoice">
                <a href="javascript:void()" class="easyui-linkbutton" iconCls="icon-bill" onclick="newPayment()" >Bill Collection</a>
                <span style="float: right;"><input type="text" name="txtsearch_indi_invoice"  id="txtsearch_indi_invoice" >
                        <a href="javascript:void(0)" class="easyui-linkbutton" plain="false" iconCls="icon-search" onclick="doSearch_indi_invoice()" >Search</a>
                </span>
            </div>
              <div id="dg_button_ind_all_invoice">
                  <a href="javascript:void()" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg_ind_all_invoices').dialog('close')" >Cancel</a>
                    
            </div>
            
<!--            <div id="test">
                        <?php   
                         include 'invoice/get_ind_all_invoices.php';
                         ?>
            </div>-->
        </div>
   </div>
    
    
    <!-- Start Filter Dialog for All Orders By Date  -->
    
    <div id="dlg_filter_by_date" class="easyui-dialog" title="E_receipt by date" style="width:950px;height:500;"
        data-options="iconCls:'icon-ereceipt',resizable:true,modal:true,closed:true" >
    
    
    <table id="dg_filter_by_date"  class="easyui-datagrid" style="width:945; height: 450px; "
	data-options=" multiSort:true " 
			toolbar="#dg_toolbar_filter_by_date" 
			rownumbers="true" fitColumns="true" singleSelect="true" showFooter="true" >
		   <thead>
                    <tr>
                        <th data-options="field:'ck',checkbox:true "></th>
                        <th field="order_id" sortable="true">Order Id.</th>
                           <th field='cust_id_new'>Cust. ID</th>
                        <th field='ref_name' data-options="sortable:'true' ">Ref. Name</th>
                        <th field='order_date' sortable="true">Order. Date</th>
                        <th data-options="field:'price',align:'right'">Price.</th>
                        <th data-options="field:'discount', align:'right'">Comm. (%)</th>
                         <th data-options="field:'discount_amount', align:'right'">Comm. Amt.</th>
                        <th data-options="field:'payable_amount',align:'right' ">Receivable Amt.</th>
                        <th field="status" > Status</th>
                    </tr>
                </thead>
               
</table>
    
     <div id="dg_toolbar_filter_by_date">
        
                <a href="javascript:void()" class="easyui-linkbutton" iconCls="icon-print" onclick="e_OrderFilterByDatePrint()" >Print Preview</a>
<!--                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-print" onclick="allInvoicePrint()">All E-Reciept Print Preview</a>-->
<!--                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="" onclick="getAllReceipt()">All E-Receipt</a>-->
                <span style="float: right;"><input type="text" name="txtsearch_filter_by_date"  id="txtsearch_filter_by_date" >
                        <a href="javascript:void(0)" class="easyui-linkbutton" plain="false" iconCls="icon-search" onclick="doFilterByDateSearch()" >Search</a>
                </span>
            </div>
    
</div>
     <!-- End Filter Dialog for All Orders By Date  -->
    
    
       
    <script type="text/javascript">
    




    
    // **************** For Individual All  Start **********************
   function formatStatus(val,row){
			if (val ==='1'){
				return '<span style="color:green;">(Created)</span>';
			}
                        else if(val === '0')
                        {
                return '<a href="#" style="color:red;" onclick="invoice();">(Invoice)</a>';
                            }
                        else {
				return val;
			}
		}
   function formatPrice(val,row){
			if (val > 1000){
				return '<span style="color:red;">('+val+')</span>';
			} else {
				return val;
			}
		}
    
    function IndividualAllInvoice(){
        var row=$('#dg').datagrid('getSelected');
        $('#dlg_ind_all_invoices').dialog('open').dialog('setTitle','List of All invoices of '+row.name+', Client ID: '+row.cust_id);
        $('#dg_ind_all_invoices').datagrid({
            url:'invoice/get_ind_all_invoices.php?invoice_q='+ row.cust_id
        });  
    }
    
    
         var url_payment;
      function newPayment(){
            
         var row = $('#dg_ind_all_invoices').datagrid('getSelected');
              //$.messager.alert("Message",row.invoice_num,"info"); 
			if (row){
                            $('#dlg_payment_form').dialog('open');
				
				$('#receive_payment_form').form('load',row);
				url_payment = 'payment/save_payment.php';
			}
                        else{
                             $.messager.alert('Message', "Please select atleast one item for Bill Collection.", 'info');
                        }
         
         
     }
     
               
	function savePayment(){
			$('#receive_payment_form').form('submit',{
				url: url_payment,
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
						$('#dlg_payment_form').dialog('close');		// close the dialog
						$('#dg_ind_all_invoices').datagrid('reload');	// reload the user data
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
                    
                      $('#receive_amount').each(function(){
                            $(this).keyup(function(){
                                
                                subtraction(); 
                                //alert("test");
                           });
                    });
   function subtraction(){
       var sum=" ";
       $("#payable_amount_p").each(function() {

			//add only if the value is number
			if(!isNaN(this.value) && this.value.length!==0) {
				sum = parseFloat(this.value);
			}
                        if(isNaN(this.value)){
                            $('#payable_amount_p').val("");
                        }
                        

		});
                
          $("#receive_amount").each(function(){
              
            if(isNaN(this.value) || this.value>sum){
                $('#receive_amount').val("");
                $('#due').val("");
            }
            if(!isNaN(this.value) && this.value.length!==0){
               
               var receive=document.getElementById('receive_amount').value;
               
               
                total=sum-receive;
               // if i add with unitprice it does not work but if i work with sum then 
               // it will be work. that imagine.
                 $("#due").val(total.toFixed(2));  
            }
            
        });            
             
       
   }
    // End substraction for due balance.
    
        function loadPayment(){
           
            var row=$('#dg').datagrid('getSelected');
            
            
            if(row){    
                     $.ajax({
                           url:'payment/get_payment_individual.php?q='+row.cust_id,
                           success: function(data){
                           $('#individual_payment').html(data);
                           }
                       });//  For Individual payment display reload div.
            }
            else{
                $('#individual_payment').hide();
            }
            
                    
        }
    
    function doSearch_indi_invoice(){
        
			$('#dg_ind_all_invoices').datagrid('load',{
				
				productid: $('#txtsearch_indi_invoice').val()
			});
                
		}
    
          function filter_AllOrders(){
        var from_date = $('#txt_from_date').datebox('getValue');
        var to_date = $('#txt_to_date').datebox('getValue');
        if(from_date!="" && to_date!="") {
               $('#dlg_filter_by_date').dialog('open').dialog('setTitle','List of All Orders from date- '+from_date+' to '+to_date);
        $('#dg_filter_by_date').datagrid({
            url:'order_all/by_date_filter_all_orders.php?from_date='+from_date+'&to_date='+to_date
        });

        }
        else{
            $.messager.show({
                title: 'Instruction:',
                msg: 'Please Enter From Date and To Date.',
                showType: 'show',
                   style:{
                    right:'',
                    //left:0,
                    //top:document.body.scrollTop+document.documentElement.scrollTop,
                    bottom:''
                }
            });
        }
     
        
    }
    
            function e_OrderFilterByDatePrint(){
        
               var from_date = $('#txt_from_date').datebox('getValue');
        var to_date = $('#txt_to_date').datebox('getValue');
    window.open("Report/print_preview_order_by_date.php?from_date="+from_date+"&to_date="+to_date,"myNewWinsr","width=900,height=600,toolbar=0,menubar=no,status=no,resizable=yes,location=no,direction=no,scrollbars=yes");
        
    }
       
       
       
    // *********************** Start For Individual Profile *********************
          function profile(){
              var row=$('#dg').datagrid('getSelected');
              
              if(row){
                  
                   $('#grid_order').datagrid({
                        url:'order/get_order.php?q='+ row.cust_id
                        
                        });// grid_order individual data load.
                
                  $('#profile').dialog('open').dialog('setTitle',' Transaction of '+row.name+', Customer Id-'+row.cust_id);
                    
                    
                     $.ajax({
                            url:'pages/display_individual_profile.php?q=' + row.cust_id,
                            success: function(data){
 
                            $('#demo').html(data);
                                
                            }
                        });
                        
                        $.ajax({
                            url:'order/get_order_individual.php?q=' + row.cust_id,
                            success: function(data){
 
                            $('#individual_order').html(data);
                                
                            }
                        });
                            
                 
                    }
              else{
                  $.messager.alert('Message',"Please select Atlease one item.",'Info');
              }
			//$('#fm').form('clear');
			//url = 'save_user.php';   
		}
                // ************************* Profile Function End. ***********************
                                var url_order;
                function order_individual(){
                        
                    //var row = $('#dg').datagrid('getSelected');
                    $('#dlg_order_individual').dialog('open').dialog('setTitle','Add New Order ');
                        //$('.cust_id').val(row.cust_id);
                         url_order= 'order/save_user.php';
                         $('#order_form').form('clear');
                         $('.gross_amount').text('');
                        
                          $('#cust_id').textbox('clear').textbox('textbox').focus();
                }
                
                function saveOrder(){
                    
			$('#order_form').form('submit',{
				url: url_order,
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
                                          
						$('#dlg_order_individual').dialog('close');		// close the dialog
						$('#dg').datagrid('reload');	// reload the user data
                                               $('#order_form').form('clear');
                        
					}
				}
			});
                 
		} // SaveOrder Function End.
                var url_multi_order;
                function order_multi(){
                        
                    //var row = $('#dg').datagrid('getSelected');
                    $('#dlg_order_multi').dialog('open').dialog('setTitle','Add New Order ');
                        //$('.cust_id').val(row.cust_id);
                         url_order= 'order/multi_save_order.php';
                         $('#order_form').form('clear');
                         $('.gross_amount').text('');
                        
                          $('#cust_id').textbox('clear').textbox('textbox').focus();
                }
                
                function saveMultiOrder(){

			$('#order_form').form('submit',{
				url: url_multi_order,
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
                                          
						$('#dlg_order_multi').dialog('close');		// close the dialog
						$('#dg').datagrid('reload');	// reload the user data
                                               $('#order_form').form('clear');
                        
					}
				}
			});

		} // Multi Order Function End.
                function editOrder(){
                   
               var row = $('#grid_order').datagrid('getSelected');
               
			if (row){
				$('#order_individual').dialog('open').dialog('setTitle','Edit Order');
				$('#order_form').form('load',row);
				url_order = 'order/update_user.php?id='+row.order_id;
			}
                        else{
                             $.messager.alert('Message', "Please select atleast one item.", 'info');
                        }
                       
		}// Edit function for order End.
                function destroyOrder(){
			var row = $('#grid_order').datagrid('getSelected');
			if (row){
				$.messager.confirm('Confirm','Are you sure you want to destroy this Order?',function(r){
					if (r){
						$.post('order/destroy_user.php',{id:row.order_id},function(result){
							if (result.success){
								$('#grid_order').datagrid('reload');	// reload the user data
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
		}//Destroy Order Function End.
                  function doSearch_order(){
                      
			$('#grid_order').datagrid('load',{
				
				productid: $('#txtsearch_order').val()
			});
                 
		}
                
                // Unit price input and then Total Price display Start
                
                $('#unit_price').each(function(){
                    
                    $(this).keyup(function(){
                        
                          var qty = document.getElementById('qty').value;
                          var unitprice = document.getElementById('unit_price').value;
                         var total_price = parseFloat(qty)*parseFloat(unitprice);
                        
                        $('#price').val(total_price);
                        
                    });
                    
                });
                
               
                    // End Total Price Display.
                
                // Percentase Calculasion Start.
                   $('#discount').each(function(){
                            $(this).keyup(function(){
                                percent(); 
                           });
                    });
                    
                       function percent(){
        
                    var sum =" ";
		//iterate through each textboxes and add the values
		$("#price").each(function() {

			//add only if the value is number
			if(!isNaN(this.value) && this.value.length!==0) {
				sum = parseFloat(this.value);
			}
                        if(isNaN(this.value)){
                            $('#price').val("");
                        }
                        

		});
                
        $("#discount").each(function(){
            if(isNaN(this.value)){
                $('#discount').val("");
            }
            if(!isNaN(this.value) && this.value.length!==0){
               
               var unitprice=document.getElementById('price').value;
                var uniper=parseFloat(this.value)/100;
               per=unitprice * uniper;
                $('#discount_amount').val(per);// get discount amount
                total=sum-per;
               // if i add with unitprice it does not work but if i work with sum then 
               // it will be work. that imagine.
                
            }
            
        });
        $("#payable_amount").val(total.toFixed(2));
    }
    // Percentase Calculasion End.
               
                // *************** End Order related work ***********

                // *************** Start Invoice Form related work ***********
                var url_invoice_multi;
    function invoiceMulti() {
        var row = $('#dg').datagrid('getSelected');
        if (row) {
            $('#dg_invoice_multi_form').dialog('open').dialog('setTitle', 'Create Multiple Invoice');
            $('#dg_invoice_multi_form').form('load', row);
            // var ids = []; 
			var rows = $('#dg').datagrid('getSelections');
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
                  $('#dg').datagrid('reload');	// reload the user data
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
    

                // *************** Start Invoice Form related work ***********
                var url_invoice;
    function invoice() {

        var row = $('#dg').datagrid('getSelected');

        if (row) {
            $('#dg_invoice_form').dialog('open').dialog('setTitle', 'Create Invoice');
            $('#dg_invoice_form').form('load', row);
            var $option = $("<option/>").attr("value", row.ref_id).text(row.ref_name);
                    $('select.txtref_name').append($option);
                    $('select.txtref_name').val(row.ref_id);
                    var gross_amount = row.total_add_bill;
                    $('.gross_amount').text(gross_amount);
                var t_bill_af_dis = row.total_bill_after_dis;
            $('.txt_billing_amt').val(t_bill_af_dis);
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
                   $('#dg').datagrid('reload');	// reload the user data
                   // $('#dg_invoice_form').form('clear');
                    $('#dg_invoice_form').dialog('close');		// close the dialog
                    $.messager.show({
                        title: 'Message',
                        msg: 'Invoice Created successfully.',
                        showType: 'show'
                    });
                }
            }
        });
    }

                
// SaveInvoice Function End.
                
                            
                
                
                
                
                
    </script>

    <script type="text/javascript">
               $('#txtsearch_order').textbox({
               
                    iconCls:'icon-order_color',
                    iconAlign:'left',
                    width:'100'
                    
                    });
                    
                $('#txtsearch').textbox({
               
                    iconCls:'icon-man',
                    iconAlign:'left',
                    width:'100'
                    
                    });
                
                $('#txtsearch_indi_invoice').textbox({
                    iconCls:'icon-invoice_color',
                    iconAlign:'left',
                    width:'125'
                });
    
		var url;
		function newUser(){
			$('#dlg').dialog('open').dialog('setTitle','New Customer Information');
			$('#fm').form('clear');
			url = 'order_all/save_user.php';
		}
                
		function editUser(){
                   
               var row = $('#dg').datagrid('getSelected');
               
			if (row){
				$('#dlg').dialog('open').dialog('setTitle','Edit Member');
				$('#fm').form('load',row);
				url = 'order_all/update_user.php?id='+row.cust_id;
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
                                                   $.messager.show({
                                                    title: 'Message',
                                                    msg: 'Customer info Saved Successfully.',
                                                    showType: 'show'
                                                });
					}
				}
			});
		}
                
		function destroyUser(){
			var row = $('#dg').datagrid('getSelected');
			if (row){
				$.messager.confirm('Confirm','Are you sure you want to destroy this user?',function(r){
					if (r){
						$.post('order_all/destroy_user.php',{id:row.cust_id},function(result){
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
				itemid: $('#cust_id_new').val(),
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
						document.getElementById('statediv_order_form').innerHTML=req.responseText;	
                                            
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
		var strURL="pages/findCity.php?country="+countryId+"&state="+stateId;
		var req = getXMLHTTP();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById('citydiv_order_form').innerHTML=req.responseText;
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
        
        // END GET CITY FUNCTION for Customer
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
        // 
        // Start Fillter for All Order
        $(function(){
			var dg = $('#dg1').datagrid({
				filterBtnIconCls:'icon-filter'
			});
			dg.datagrid('enableFilter', [{
				field:'price',
				type:'numberbox',
				options:{precision:0},
				op:['equal','notequal','less','greater']
			},{
                            field:'discount_amount',
                            type:'numberbox',
                            options:{precision:0},
                            op:['equal','notequal','less','greater']
                        },{
				field:'payable_amount',
				type:'numberbox',
				options:{precision:0},
				op:['equal','notequal','less','greater']
			},{
				field:'status',
				type:'combobox',
				options:{
					panelHeight:'auto',
					data:[{value:'',text:'All'},{value:'Created',text:'Created'},{value:'Invoice',text:'Invoice'}],
					onChange:function(value){
						if (value == ''){
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

$(function(){
            $('#cust_id').combogrid({
                panelWidth:600,
                url: 'customer_profile/get_customer_all.php',
                idField:'cust_id',
                textField:'name',
                fitColumns:true,
                editable: true,
                mode:'remote',
                columns:[[
                    {field:'cust_id',title:'Customer ID',width:60},
                    {field:'cust_id_new',title:'cust_id_new',width:120},
                    {field:'name',title:'Company Name',width:300},
                    {field:'type',title:'type',align:'right',width:60},
                    {field:'ref_name',title:'Referance Name',width:100},
                    {field:'project_name',title:'project_name',align:'center',width:60},
                    {field:'district',title:'district', align:'center'}
                ]],
                onSelect:function(record){
                   //alert(record); //this is called whn user select the combobox
                  //do your stuff here///
                  var g = $('.cust_id').combogrid('grid');   // get datagrid object
                var r = g.datagrid('getSelected');  // get the selected row
                $('#cust_id_new').val(r.cust_id_new);
                $('#txtproject_name').append('<option value="'+r.project_name+'" selected="selected">'+r.project_name+'</option>');
                $('#txttype').append('<option value="'+r.type+'" selected="selected">'+r.type+'</option>');
                    
                 $('#ref_name').append('<option value="'+r.ref_id+'" selected="selected">'+r.ref_name+'</option>');
                        $('#district').combobox('setValue',r.district);
                        $('#upazila').combobox('setValue',r.upazila);
                        $('.name').val(r.name);
                        $('.contact_person').textbox('setValue',r.contact_person);
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

 function clearForm(){
            $('#order_form').form('clear');
        }

$(document).ready(function () {

        $('#selected_id').show();

        $('.table_order').delegate('.item','change',function(){
                var tr = $(this).parent().parent(); 
             tr.find('.description').focus(); 
        });


    });


    

</script>