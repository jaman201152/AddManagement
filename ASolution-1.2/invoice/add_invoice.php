<div id="dg_invoice_form" class="easyui-dialog" title="Create Invoices"  style="width:900px;height:550px;padding:10px"
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
                                <input class="easyui-textbox" name="work_order_no" id="work_order_no" required="required" readonly="readonly"></input>
                            </div>
                        </td>
                        <td>
                            <div class="easyui-panel" title="Published Date" style="width:160px; height:55px;">
                                <input class="easyui-datebox" name="pub_date" id="pub_date" required="required"></input>
                            </div> 
                        </td>
                        <td>
                            <div class="easyui-panel" title="Invoice Date" style="width:160px; height:55px;">
                                <input class="easyui-datebox" name="invoice_date" id="invoice_date" required="required"></input>
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
                                        <td>Company Name:</td><td><input class="easyui-textbox" name="name" style="width:100%;" readonly="readonly"></td>
                                    </tr>
                                    <tr>
                                        <td>Reference Name:</td><td>
                                            <select name="ref_id" class="txtref_name" style="width:200px;">
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
                    </tr>
                    <tr style="background: #f1f1f1;  ">
                        <td>
                            <select class="easyui-combobox" name="item" style="width:150px;">
                                   <?php
                            $query_additem = $con->prepare("Select typeid, type_name from tbl_type group by type_name order by typeid ASC");
                    $query_additem->execute();
                    while ($row_type = $query_additem->fetch(PDO::FETCH_ASSOC)) {
                        extract($row_type);
                        ?>
                        <option value="<?php echo $typeid;?>"><?php echo $type_name; ?></option>
                        <?php
                    }
                    ?>
                            </select>
                        </td>
                        <td> <textarea style="width:120px;height:35px;resize:none" name="description"></textarea></td>
                        <td><input type="text" name="o_row" class="row" style="width:25px; text-align: right;" readonly="readonly"></td>
                        <td><input type="text" name="o_column" class="column" style="width:30px; text-align: right;" readonly="readonly"></td>
                        <td> <input  name="qty" class="qty"  style="width:40px; text-align: right;"  readonly="readonly"></td>
                        <td> <input  name="unit_price" class="unit_price"  style="width:40px; text-align: right;"  readonly="readonly"></td>

                        <td> <input  name="price" class="price"  style="width:100px; text-align: right;" readonly="readonly"></td>
                    </tr>
                    <tr  style="font-weight: bold;"><td colspan="5"></td>
                            <td style="background: #F1F1F1; ">Gross Amount:</td>
                            <td style="background: #F1F1F1; "><span class="gross_amount"></span></td>
                        </tr>
                        <tr><td colspan="5"></td>
                            <td title="Front Page Charge(%)">Front Page Charge(%)</td>
                               <td><input type="text" name="front_page" class="front_page" style="width:100px; text-align: right;" required="required" autocomplete="off"></td>
                        </tr>
                        <tr><td colspan="5"></td>
                             <td title="Back Page Charge(%)">Back Page Charge(%)</td>
                              <td><input type="text" name="back_page" class="back_page" style="width:100px; text-align: right;" required="required" autocomplete="off"></td>
                        </tr>
                        <tr><td colspan="5"></td>
                                  <td title="Color Charge(%)">Color Charge(%)</td>
                                     <td><input type="text" name="color" class="color" style="width:100px; text-align: right;" required="required" autocomplete="off"></td>
                        </tr>
                        <tr><td colspan="5"></td>
                            <td>Dis (%)</td><td> <input  name="discount" class="discount"  style="width:100px; text-align: right;"  readonly="readonly" > </td></tr>
                        <tr><td colspan="5"></td>
                            <td>Dis Amt</td>
                        <td>
                            <input name="discount_amount" class="discount_amount" style="width: 100px; text-align: right;"  readonly="readonly">
                            <input name="ait_others_discount" type="hidden" value="0" >
                        </td>
                        </tr>
                         <tr><td colspan="5"></td>
                            <td   style="background: #F1F1F1; font-weight: bold;">Total Billing Amt.</td>
                            <td   style="background: #F1F1F1;"> <input type="text" name="txt_billing_amt" class="txt_billing_amt" style="width:100px; text-align: right;"></td>
                        </tr>
                       <tr><td colspan="5"></td>
                           <td>VAT(%)</td> <td> <input  name="vat" class="vat" value="0"  style="width:100px; text-align: right;"></td></tr>
                        <tr> <td colspan="5"></td>
                            <td>TAX(%)</td><td> <input  name="tax" class="tax" value="0"  style="width:100px; text-align: right;" ></td>
                        </tr>
                          <tr><td colspan="5"></td>
                            <td style="background: #F1F1F1; font-weight: bold;">Total Receivable Amt</td>
                            <td> <input  name="payable_amount" class="payable_amount"  style="width:100px; text-align: right;"  readonly="readonly"></td></tr>
                </table>




            </form>

        </div>
        <div region="south" border="false" style="text-align:right;height:30px;line-height:30px;">

        </div>


    </div> <!-- layout End -->

</div>
<!-- Start Invoice dlg buttons and All -->
<div id="dlg-buttons-invoice">
    <a href="#" class="easyui-linkbutton" iconCls="icon-save" onclick="saveInvoice();">Save</a>
    <a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dg_invoice_form').dialog('close')">Close</a>
</div>
<!-- End Invoice dlg buttons and All -->