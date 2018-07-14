<?php
//build the query
$query="SELECT cust_id, name
FROM tbl_customer order by name ASC";

//execute the query
$data = $con->query($query);
//convert result resource to array
$result = $data->fetchAll(PDO::FETCH_ASSOC);

//view the entire array (for testing)
//print_r($result);

//display array elements
$result1 = "test";

?>
<style>
    delRow{
        z-index: 999;
    }
    .block label { display: inline-block; width: 140px;  text-align: right; }
    .more_field{
        display:none;
    }
</style>
<!-- Order dialog Start -->
<div id="dlg_order_multi" class="easyui-dialog" style="width:100%;height:600px; padding:2px 2px;"
     closed="true" buttons="#order_south_multi_buttons" title="" data-options="iconCls:'icon-order_color' ">
    <div class="easyui-layout" fit="true"  id="order_layout" >
       
     
        <div data-options=" region:'center', split:'true', title:'Order form' " style="padding:10px 20px">
             <form id="order_form" method="post" novalidate>

           <br/>
                <div class="fitem">
                    <table width='100%' class="table_order">
                
                     <thead style="background: #F1F1F1;">
                         <tr>
                        <th>Company Name.</th>
                        <th>Work Order No</th>
                        <th>Order Date:</th>
                        <th>Item</th>
                        <th>Position/Description</th>
                        <th>Row</th>
                        <th>Column</th>
                        <th title="Quantity">Qty</th>
                        <th>Unit Price</th>
                        <th>Price</th>
<th><a href="#" class="addRow  btn btn-success">Add Row</a></th>  
                        </thead>
                                <tbody>
                        <tr>
                        
                            <td>
                                <div style="background: #F1F1F1;">
                                              <select name="item" class="item" id="item" style="width:150px;">
                                 <option value=" "> select any one </option>
                                <option value="addNew"> Add New </option>
                            <?php
                            $query_cust_multi = $con->prepare("Select cust_id,name from tbl_customer order by name ASC");
                    $query_cust_multi->execute();
                    while ($row_type = $query_cust_multi->fetch(PDO::FETCH_ASSOC)) {
                        extract($row_type);
                        ?>
                        <option value="<?php echo $cust_id; ?>"><?php echo $name." [Insertion id- ".$cust_id."]"; ?></option>
                        <?php
                    }
                    ?>
                            </select>
                                    <?php
//                                         echo "<select name='cust_id' class='cust_id' required='required' style='width:150px;'>";
//                                    foreach($result as $output) {
//                                    echo "<option value='".$output['cust_id']."'>".$output['name']."</option>";
//                                    }
//                                    echo "</select>";
                                    ?>
         <input type="hidden" name="cust_id_new"  class="cust_id_new" id="cust_id_new" style="text-align: right; padding: 2px;" complete="off" required="required" /> &nbsp;&nbsp;&nbsp;              
                            </div>
                            </td>
                                <td>
                                  <input name="order_date" id="order_date" class="easyui-datebox" required="required" value="<?php echo date("m/d/Y H:i:s, true, 'Asia/Dhaka' "); ?> "  />
           
                            </td>
                            <td>
                                      <input name="work_order_no" class="easyui-textbox" id="work_order_no" required="required" style="width: 150px;">
                            </td>
                        <td>
                            <select name="item" class="item" id="item" style="width:130px;">
                                 <option value=" "> select any one </option>
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
                        <td><input type="text" class="description" name="description" style="width:100px;"></td>
                        <td><input type="text" name="o_row" class="row" style="width:50px;" autocomplete="off" required="required"></td>
                        <td><input type="text" name="o_column" class="column" style="width:50px;" autocomplete="off" required="required"></td>
                            <td><input type="text" name="qty" class="qty" style="width:50px;" id="qty" required="required"></td>
                            <td><input type="text" name="unit_price" id="unit_price" style="width:80px;" required="required" autocomplete="off"></td>
                            <td>
                                <input type="text" name="price" id="price" style="width:100px;" required="required" autocomplete="off" readonly="readonly">
                                <a href="#" class="show_field">Show</a>
                                
                                <div class="more_field">
                                    <span>Gross Amount: <span class="gross_amount" style=""></span></span><br>
                                    <div class="block"><label for="front_page">Front Page(%): </label>
                                        <input type="text" name="front_page" class="front_page" style="" value="0" required="required" autocomplete="off"></div>
                                    <div class="block"><label for="back_page">Back Page(%):</label> 
                                        <input type="text" name="back_page" class="back_page" style="" required="required" value="0" autocomplete="off"></div><br>
                                        <div class="block"><label for="color">Color(%):  </label>
                               <input type="text" name="color" class="color" style="" required="required" value="0" autocomplete="off"></div><br>
                               <div class="block" title="Payable Amount"   style="background: #F1F1F1; font-weight: bold;"><label for="total_add_amount">Total Advt. Bill </label>
                              <input type="text" name="total_add_amount" class="total_add_amount" style="" value="0" readonly="readonly"></div><br>
                              <div class="block"><label for="discount">Dis.(%)  </label>
                         <input type="text" name="discount" id="discount" style="" value="0" autocomplete="off" required="required"></div><br>
                         <div class="block" title="Discount Amount"><label for="discount_amount">Dis. Amt.  </label>
                         <input type="text" name="discount_amount" id="discount_amount" style="" autocomplete="off" required="required" readonly="readonly"></div><br>
                         <div class="block"   style="background: #F1F1F1; font-weight: bold;"><label for="txt_billing_amt">Total Billing Amt. </label>
                             <input type="text" name="txt_billing_amt" class="txt_billing_amt" style=""></div><br>
                             <div class="block"><label for="vat">VAT(%):  </label>
                         <input type="text" name="vat" id="vat"  style="" autocomplete="off" value="0" required="required"></div><br>
                         <div class="block"><label for="tax">TAX(%):  </label>
                           <input type="text" name="tax" id="tax" style="" value="0" autocomplete="off" required="required"></div><br>
                           <div class="block"   style="background: #F1F1F1; font-weight: bold;"><label for="payable_amount">Total Payable Amt. </label>
                        <input type="text"  name="payable_amount" id="payable_amount" style="">
                        <input type="hidden" name="status" id="order_status" value="0"></div>
                     
                                </div>
                            </td>
                            
                        </tr>
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

<!-- south_buttons start for Order form -->
             <div id="order_south_multi_buttons">
                 <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-reset" onclick="clearForm()" >Reset</a>
                <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveOrderMulti()" class="Save" >Save</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg_order_multi').dialog('close')" >Cancel</a>
            </div>
<!-- south_buttons start for Order form -->

<!-- dlg botton Start-->
<script type="text/javascript">
              $(document).ready(function(){
// -------------- Add Row ---------------------
        $('.addRow').on('click',function(){
            addRow();
        });
        function addRow(){
            var tr =    '<tr>'+
                        '<td><select name="item" class="item" id="item" style="width:150px;">'+
                        '<option value=" "> select any one </option>'+
                        '<?php
                            $query_cust_multi = $con->prepare("Select * from tbl_customer order by name ASC limit 0,20");
                    $query_cust_multi->execute();
                    while ($row_cust = $query_cust_multi->fetch(PDO::FETCH_ASSOC)) {
                        extract($row_cust); ?>'+
                        '<option value="<?php echo $cust_id; ?>"><?php echo $name."Insertion Id- ".$cust_id; ?></option>'+
                        '<?php } ?>'+
                    '</select></td>'+
                    '<td class="center"><input type="text" name="work_order_no[]" class="work_order_no" required="required"></td>'+
                    '<td class="center"><input type="text" name="order_date[]" class="order_date"></td>'+
                    '<td><select name="item" class="item" id="item" style="width:150px;">'+
                                 '<option value=" "> select any one </option>'+
                            '<?php
                    $query_additem = $con->prepare("Select typeid, type_name from tbl_type group by type_name order by typeid ASC");
                    $query_additem->execute();
                    while ($row_type = $query_additem->fetch(PDO::FETCH_ASSOC)) {
                        extract($row_type); ?>'+
                        '<option value="<?php echo $typeid; ?>"><?php echo $type_name; ?></option>'+
                        '<?php } ?>'+
                    '</select></td>'+
                '<td><input type="text" class="description" name="description" style="width:120px;"></td>'+
                '<td><input type="text" name="o_row" class="row" style="width:50px;" autocomplete="off" required="required"></td>'+
                '<td><input type="text" name="o_column" class="column" style="width:50px;" autocomplete="off" required="required"></td>'+
                '<td><input type="text" name="qty" class="qty" style="width:50px;" id="qty" required="required"></td>'+
                '<td><input type="text" name="unit_price" id="unit_price" style="width:80px;" required="required" autocomplete="off"></td>'+
                '<td><input type="text" name="price" id="price" style="width:100px;" required="required" autocomplete="off" readonly="readonly">'+
                      '<a href="#" class="show_field">Show</a><div class="more_field">'+
            '<span>Gross Amount: <span class="gross_amount" style=""></span></span><br>'+
            '<div>Front Page(%): '+
            '<input type="text" name="front_page" class="front_page" style="width:100px;" value="0" required="required" autocomplete="off"></div><br>'+
            '<div>Back Page(%): '+
            '<input type="text" name="back_page" class="back_page" style="width:100px;" required="required" value="0" autocomplete="off"></div><br>'+
            '<div>Color(%): '+
            '<input type="text" name="color" class="color" style="width:100px;" required="required" value="0" autocomplete="off"></div><br>'+
            '<div title="Payable Amount"   style="background: #F1F1F1; font-weight: bold;">Total Advt. Bill'+
            '<input type="text" name="total_add_amount" class="total_add_amount" style="width:100px;" value="0" readonly="readonly"></div><br>'+
            '<div>Dis.(%)'+
            '<input type="text" name="discount" id="discount" style="width:100px;" value="0" autocomplete="off" required="required"></div><br>'+
            '<div title="Discount Amount">Dis. Amt.'+
            '<input type="text" name="discount_amount" id="discount_amount" style="width: 100px;" autocomplete="off" required="required" readonly="readonly"></div><br>'+
            '<div   style="background: #F1F1F1; font-weight: bold;">Total Billing Amt.'+
            '<div>VAT(%):<input type="text" name="txt_billing_amt" class="txt_billing_amt" style="width:100px;"></div><br>'+
            '<input type="text" name="vat" id="vat"  style="width:100px;" autocomplete="off" value="0" required="required"></div><br>'+
            '<div>TAX(%): <input type="text" name="tax" id="tax" style="width:100px;" value="0" autocomplete="off" required="required"></div><br>'+
            '<div   style="background: #F1F1F1; font-weight: bold;">Total Payable Amt.'+
            '<input type="text"  name="payable_amount" id="payable_amount" style="width:100px;">'+
            '<input type="hidden" name="status" id="order_status" value="0"></div>'+
            '</div>'+
            '</td>'+       
        '<td class="center"><a href="#" class="delRow  btn btn-danger">Del</a></td>'+
  
            '</tr>';
        $('tbody').append(tr);
        };
   // -------------- Delete Row ---------------------
        $('.delRow').live('click',function(){
            var l = $('tbody tr').length; 
            if(l===1){
                alert("You can not remove last one.");
            } else{
            $(this).parent().parent().remove();
           // total();
            }
        });
// -------------- End Delete Row ---------------------     
          // -------------- Show Row ---------------------
        $('.show_field').live('click',function(){
             $('.more_field').toggle(); 
        });
// -------------- End Show Row ---------------------
             }); // end dom ready
             
             </script>