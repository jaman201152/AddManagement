<style>
    .left_div{
        padding:0px 50px;
        float:left;
        width:650px;
    }
    .right_div{
        float:right;
        padding:0px 100px;
        width:350px;
    }
</style>

<div id="dg_invoice" class="easyui-dialog" title="List of All Invoices "  style="width:75%;height:610px;"
    toolbar="#dlg-toolbar_invoice" buttons="#dlg-buttons-invoice" >
  <div class="easyui-layout" fit="true">
            <!-- east Region Start-->
<!--      <div data-options="region:'east',split:'true' " title="History" style="width:180px;height:450px;">
                  <?php
                        include 'Menu/display_invoice_right_menu.php';
                  ?>
      </div>-->
            <!-- **************** east Region End ***********************-->
    <div data-options=" region:'center',split:'true'  " border="false">
        <center>
        <table id="dg" title="All Invoices" class="easyui-datagrid" style="width:100%; height: 300px; overflow-x: scroll; overflow-y:scroll; "
			url="invoice/invoice_search.php" toolbar="#invoice_table_toolbar1"
			 pagination="false"
			rownumbers="true" data-options="view:scrollview"  singleSelect="true" showFooter="true" >
		<thead>
			<tr>
                                   <!-- <th data-options="field:'ck',checkbox:true "></th>-->
                    <th field="cust_id_new" width="auto" sortable="true"> Cust. ID.</th>
                       <th field="name" width="150" sortable="true"> Cust. Name.</th>
                    <th field="invoice_id" with="auto" sortable="true">Inv. Id. </th>
                    <th field="order_id" with="auto" sortable="true">Order Id. </th>  
                    <th field="pub_date" width="auto" sortable="true"> Pub. Date</th>
<!--                    <th field="price" width="auto" sortable="true" data-options="align:'right' ">  Invoice Amt.</th>
                     <th field="discount" width="auto" sortable="true" data-options="align:'right' ">Dis.(%)</th>
            <th field="discount_amount" width="auto" sortable="true" data-options="align:'right' ">Dis. Amt.</th>-->
            <!-- <th field="afterDisAmt">Receivable Amt.</th> -->
            <th field="ait_others_discount" data-options="align:'right' ">AIT/Others Discount</th>
            <th field="payable_amt_inv" width="auto" sortable="true" data-options="align:'right' ">Total Due Amt.</th>
<!--            <th field="status" data-options="sortable:'true' "> Status</th>-->
            <th field="order_date" width="auto" sortable="true">O. Date</th>
            <th field="invoice_date" width="auto" sortable="true">Inv. Date</th>
      
            <th field="ref_id" width="auto" sortable="true">Ref. Name</th>
			</tr>
		</thead>
        </table>
            </center>
        <!-- All invoice Display Table End -->

        <div class="easyui-dialog" id="dlg_payment_form" closed="true"  data-options="iconCls:'icon-bill',title:'Bill Receive Payment Form' " 
             style="padding:5px; width:100%; height: 600px; " buttons="#dlg-buttons-payment" >
                    <form name="receive_payment_form" id="receive_payment_form" method="POST">
                <h2 style="color:#555;">Customer Payment
                    <span style="float: right; color:#666;">
                        <label>Invoice ID # </label>
                        <input class="easyui-textbox" name="invoice_id" style="width:100px; border:1px #ccc solid;"/><br>
                         <label>Order ID # </label><input type="text" name="order_id" style="width:100px; border:1px #ccc solid;"/>
                    </span>
                </h2>
                <div class="left_div">
                      <table width='100%' cellpadding='5'>
                    <tr>
                        <td>Received From</td><td>
                            <input class="easyui-textbox" style="width: 300px;" name="name" id="name" readonly="readonly" />
                            <input type="hidden"  style="width: 150px;" name="cust_id" id="cust_id" />  
                            <input type="hidden"  style="width: 150px;" name="cust_id_new" id="cust_id_new" />
                            <input type="hidden" name="ref_id"> 
                        </td>
                    </tr>

                        <td>
                            </tr>
                    <tr>
                        <td>Amount</td><td><input type="text"  name="receive_amount" id="receive_amount" style=" font-weight: bold; width: 150px; padding: 2px; line-height: 18px; text-align: right;  border-radius: 5px; border:1px #ccc solid;"  required="required" autocomplete="off"/></td>
                        <td style="text-align: right;">Collected Amount</td><td><input type="text" name="paid_amount" id="paid_amount" style="width: 100px; padding: 2px; line-height: 18px;  border-radius: 5px; border:1px #ccc solid;" autocomplete="off"/></td>
                    </tr>
                    <tr><td>Commission on Receive Amt.(%)</td>
                        <td><input type="text"  name="commission" id="commission" value="20" style=" font-weight: bold; width: 100px; padding: 2px; line-height: 18px; text-align: right;  border-radius: 5px; border:1px #ccc solid;"  required="required" autocomplete="off"/></td>
                             <td>Receivable Amount</td><td><input type="text"  name="payable_amt_inv" id="payable_amount_p" style=" font-weight: bold; width: 100px; padding: 2px; line-height: 18px;  border-radius: 5px; border:1px #ccc solid;"  /></td>
                    </tr>
                    <tr>
                        <td>AIT and Others/ Adjustment:</td>
                        <td>
                            <input type="text"  name="ait_others_discount" id="ait_others_discount" style=" font-weight: bold; width: 100px; padding: 2px; line-height: 18px; text-align: right;  border-radius: 5px; border:1px #ccc solid;" value="0"  required="required" autocomplete="off"/>
                        </td>
                    </tr>
                    <tr>
                        <td>Payment Date</td><td><input class="easyui-datebox" name="payment_date" id="payment_date" required="required" value="<?php echo date('Y-m-d');?>" /></td>
                   
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
                        <td>Memo</td><td><input class="easyui-textbox" name="memo" id="memo" required="required"></td>
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

             
                <div id="dlg-buttons-payment" style="text-align: right;">
                    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-print" onclick="paymentPreview()">Print Preview</a>
                    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-save" onclick="savePayment()">Submit</a>
                    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg_payment_form').dialog('close')">Close</a>


                </div>
            </form>
                 </div>
    </div><!-- Center Region End-->
<div region="south" border="false" style="text-align:right;height:30px;line-height:30px;">
      
</div>
            
            
 </div> <!-- layout End -->

    </div><!-- dialog end -->
      <div id="dlg-toolbar_invoice">

         <a href="#" class="easyui-linkbutton" iconCls="icon-bill" onclick="newPayment()" style="width:auto;">Bill Receive</a>
         <a href="#" class="easyui-linkbutton" iconCls="icon-bill" onclick="multiPaymentWin()" style="width:auto;">Bill Receive by Client</a>
          <span style="float: right;"><input type="text" name="txtsearch_invoice"  id="txtsearch_invoice" >
            <a href="#" class="easyui-linkbutton" plain="false" iconCls="icon-search" onclick="doSearch_invoice()" title="Search By Invoice_id Or Customer Id" >Search</a>
        </span>

        <span style="float: right;">Inv. Info:
            From Date: <input type="text" class="easyui-datebox" value=""  name="txt_from_date" id="txt_from_date" placeholder="From Date" style="width:100px;" />
            To Date:  <input type="text" class="easyui-datebox" value=""  name="txt_to_date" id="txt_to_date" placeholder="To Date" style="width:100px;" />
            <a href="#" class="easyui-linkbutton" plain="false" iconCls="icon-search" onclick="filterAllInvoices()" >Filter</a>
            &nbsp; &nbsp; &nbsp;
        </span>

        </div>
    <div id="dlg-buttons-invoice">
         <a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dg_invoice').dialog('close')">Cancel</a>
    </div>

  <!-- Start Filter Dialog for All Received By Date  -->
    
    <div id="dlg_filter_by_date" class="easyui-dialog" title="Receipt by date" style="width:950px;height:500;"
        data-options="iconCls:'icon-ereceipt',resizable:true,modal:true,closed:true" >
    
    
    <table id="dg_filter_by_date"  class="easyui-datagrid" style="width:945; height: 450px; "
    data-options=" multiSort:true " 
            toolbar="#dg_toolbar_filter_by_date" 
            rownumbers="true" fitColumns="true" singleSelect="true" showFooter="true" >
           <thead>
                   <tr>
<!--                                <th data-options="field:'ck',checkbox:true "></th>-->
                                <th field="cust_id_new" width="auto" sortable="true"> Cust. ID</th>
                               <th field="invoice_id" with="auto" sortable="true">Inv. Id. </th>
                                <th field="order_id" with="auto" sortable="true">O. Id. </th>
                                <th field="pub_date" width="auto" sortable="true"> Pub. Date</th>
                <th field="order_date" width="auto" sortable="true">O. Date</th>
                    <th field="price" width="auto" sortable="true" data-options="align:'right' ">  Inv. Amt.</th>
                <th field="discount_amount" width="auto" sortable="true" data-options="align:'right' ">Comm. Amt.</th>
                <th field="afterDisAmt" width="auto" sortable="true" data-options="align:'right' ">Receivable Amt.</th>
                <th field="payable_amount" width="auto" sortable="true" data-options="align:'right' ">Total Due Amt.</th>
                  <th field="status" data-options="sortable:'true' "> Status</th>
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
     <!-- End Filter Dialog for All Received By Date  -->
    <?php
        include_once 'payment/dg_multi_payment.php';
    ?>


  
    <script type="text/javascript">
     
        function multiPaymentWin(){
            $('#w').window('open');
        }
     
     
     

         var url_payment;
      function newPayment(){
            
         var row = $('#dg').datagrid('getSelected');
              //$.messager.alert("Message",row.invoice_num,"info"); 
			if (row){
                            $('#dlg_payment_form').dialog('open');
				
				$('#receive_payment_form').form('load',row);
				url_payment = 'payment/save_payment.php';
                $('#receive_amount').focus();
                 $('#receive_amount').val("");  // when open payment form this field will be empty.
                 $('#pub_date').textbox('hide');
                                $('#due').val(""); 
                                $('#check_num').val("");
                                $('#memo').val("");
                                $('#payment_date').val("");
                                $('#payment_method').val("");// when open payment form this field will be empty.
                                //$('#dlg_payment_form').form('reset');
                                // Start Order price will be receivable amount subtract from discount.
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
                        else{
                             //$.messager.alert('Message', "Please select atleast one item for Bill Receive.", 'info');
                               $.messager.show({
                                title:'Message',
                                msg:'Please select atleast one item to Receive Bill.',
                                showType:'show'
                            });

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
							msg: result.errorMsg,
                             showType:'show'
						});
					} else {
						$('#dlg_payment_form').dialog('close');		// close the dialog
						$('#dg').datagrid('reload');	// reload the user data
                          $('#receive_payment_form').form('reset');
                           $.messager.show({
                                title:'Transaction Information',
                                msg:'Transaction saved successfully.',
                                showType:'show'
                            });
					}
				}
			});
		}

   
    
                
           $('#txtsearch_invoice').textbox({
               
                    iconCls:'icon-invoice_color',
                    iconAlign:'left',
                    width:'100'
                    
                    });
                    
                    
                      
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
                        var payable_amt = document.getElementById('payable_amount_p').value;
                        var pay = parseFloat(payable_amt.replace(/,/g, '')); // number format , remove
            if(!isNaN(pay) && pay.length!==0) {
                sum = pay;
            }
                        if(isNaN(pay)){
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
   
    // Start AIT Others on key up
    $('#ait_others_discount').each(function(){
                            $(this).keyup(function(){
                                
                                aitOthersDiscount(); 
                                //alert("test");  // AIT Others Discount Field will be trigger fire.
                           });
                    });

        function aitOthersDiscount(){
                     var sum=" ";
       $("#payable_amount_p").each(function() {
            //add only if the value is number
                        var payable_amt = document.getElementById('payable_amount_p').value;
                        var pay = parseFloat(payable_amt.replace(/,/g, '')); // number format , remove
            if(!isNaN(pay) && pay.length!==0) {
                sum = pay;
            }
                        if(isNaN(pay)){
                            $('#payable_amount_p').val("");
                        }
                        
        });

             $("#ait_others_discount").each(function(){
              
                    var receive=document.getElementById('receive_amount').value;
               var receive_amt = parseFloat(receive.replace(/,/g, '')); // number format , remove

                              var ait_discount=document.getElementById('ait_others_discount').value;
                var ait_discount_amt = parseFloat(ait_discount.replace(/,/g, '')); // number format , remove
              
            if(isNaN(this.value || this.value>receive_amt)){
                $('#ait_others_discount').val("");
                //$('#due').val("");
            }
            if(!isNaN(this.value) && this.value.length!==0){
               

               adjustment = receive_amt + ait_discount_amt;

                total=sum-adjustment;

               // if i add with unitprice it does not work but if i work with sum then 
               // it will be work. that imagine.
                 $("#due").val(total.toFixed(2));  
            }
            
        });    

        }
   
    // End AIT Others on key up

        // Start Discount change number on key up
    $('#txtdiscount').textbox({
        inputEvents:$.extend({},$.fn.textbox.defaults.inputEvents,{
            keyup:function(e){

                var discount = $(this).val(); 
                var discount_num = parseFloat(discount.replace(/,/g, '')); // number format discount %

                var price = $('#txtprice').textbox('getText');
                 var price_num = parseFloat(price.replace(/,/g, '')); // number format invoice price

                 var dis_amount = price_num*(discount_num/100); // discount Amount
                 $('#txtdiscount_amt').val(dis_amount.toFixed(2)); // put dis amount
                var after_discount_price =price_num - dis_amount; // calculate precentage
                $("#order_price").val(after_discount_price); // Price after commission


             var ait_discount=document.getElementById('ait_others_discount').value;
                var ait_discount_amt = parseFloat(ait_discount.replace(/,/g, '')); // put ait_dis amount, number
    

                var paid_amount = $('#paid_amount').val();
                var payable_amount_new = ( price_num - (dis_amount+ait_discount_amt) ) - paid_amount  ;
                 // Add discount amount and ait_discount and then substract invoice price then substract paid amount
                $('#payable_amount_p').val(payable_amount_new.toFixed(2));
                

            }
        })
    });

        // End Discount change number on key up
   
    // End substraction for due balance.
    
    function paymentPreview(){
        var row=$('#dg').datagrid('getSelected');
        if(row){
    
         var due = document.getElementById('due').value;
         var receive = document.getElementById('receive_amount').value;
         var order_price = document.getElementById('order_price').value;
         var paid_amount = document.getElementById('paid_amount').value;
         var payable_amount = document.getElementById('payable_amount_p').value;
         var payment_date = $('#payment_date').datetimebox('getText');  // get datetimebox value
         
         var payment_method = $('#payment_method').combobox('getText'); // get combobox value
        
         var check_num = document.getElementById('check_num').value;
         var memo = document.getElementById('memo').value;
         var deposite_to = $('#deposite_to').combobox('getText'); // get combobox value
         var status_memo = document.getElementById('status_memo').value;
         
    window.open("Report/preview_payment_individual_cust.php?cust_id="+row.cust_id+"&inv_id="+row.invoice_id+"&due="+due+"&receive="+receive+"&or_p="+order_price+"&paid_amt="+paid_amount+"&payable_amt="+payable_amount+"&payment_date="+payment_date+"&payment_method="+payment_method+"&check_num="+check_num+"&memo="+memo+"&deposite_to="+deposite_to+"&status_memo="+status_memo,"myNewWinsr","width=990,height=600,toolbar=0,menubar=no,status=no,resizable=yes,location=no,direction=no,scrollbars=yes");

        }
        else{
            
               $.messager.show({
                                title:'Message',
                                msg:'Please select atleast one item.',
                                showType:'show'
                            });

        }
        
    }
     

                
                
function doSearch_invoice(){
			$('#dg').datagrid('load',{
				itemid: $('#cust_id_new').val(),
				productid: $('#txtsearch_invoice').val()
			});
                
		} // End doSearch_invoice functoin


      function filterAllInvoices(){
        var from_date = $('#txt_from_date').datebox('getValue');
        var to_date = $('#txt_to_date').datebox('getValue');
        if(from_date!="" && to_date!=""){
        $('#dlg_filter_by_date').dialog('open').dialog('setTitle','List of All Invoices Billing info from date- '+from_date+' to '+to_date);
        $('#dg_filter_by_date').datagrid({
            url:'invoice/by_date_filter_all_invoices.php?from_date='+from_date+'&to_date='+to_date
        });
          }
          else{
            $.messager.show({
                title : 'Instruction:',
                msg : "Please Enter From Data and To Date.",
                showType : 'show',
                style:{
                    right:'',
                   // top:document.body.scrollTop+document.documentElement.scrollTop,
                    bottom:''
                }
            });
          }
        
    }

            function e_OrderFilterByDatePrint(){
        
               var from_date = $('#txt_from_date').datebox('getValue');
        var to_date = $('#txt_to_date').datebox('getValue');
    window.open("Report/print_preview_invoices_by_date.php?from_date="+from_date+"&to_date="+to_date,"myNewWinsr","width=900,height=600,toolbar=0,menubar=no,status=no,resizable=yes,location=no,direction=no,scrollbars=yes");
    }






                
                // Start Fillter for All Order
//        $(function(){
//			var dg = $('#dg').datagrid({
//				filterBtnIconCls:'icon-filter'
//			});
//			dg.datagrid('enableFilter', [{
//				field:'price',
//				type:'numberbox',
//				options:{precision:0},
//				op:['equal','notequal','less','greater']
//			},{
//                            field:'discount_amount',
//                            type:'numberbox',
//                            options:{precision:0},
//                            op:['equal','notequal','less','greater']
//                        },{
//				field:'payable_amount',
//				type:'numberbox',
//				options:{precision:0},
//				op:['equal','notequal','less','greater']
//			},{
//				field:'status',
//				type:'combobox',
//				options:{
//					panelHeight:'auto',
//					data:[{value:'',text:'All'},{value:'Created',text:'Created'},{value:'Invoice',text:'Invoice'}],
//					onChange:function(value){
//						if (value == ''){
//							dg.datagrid('removeFilterRule', 'status');
//						} else {
//							dg.datagrid('addFilterRule', {
//								field: 'status',
//								op: 'equal',
//								value: value
//							});
//						}
//						dg.datagrid('doFilter');
//					}
//				}
//			}]);
//		});
                
                   // End Fillter for All Order by Field

// This is for hide show event

        $.extend($.fn.textbox.methods, {
            show: function(jq){
                return jq.each(function(){
                    $(this).next().show();
                })
            },
            hide: function(jq){
                return jq.each(function(){
                    $(this).next().hide();
                })
            }
        })

    // This is for hide show event
                
    </script>