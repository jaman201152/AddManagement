<div id="dg_invoice_multi_form" class="easyui-dialog" title="Create Invoices"  style="width:70%;height:100%;padding:10px"
     data-options="iconCls:'icon-invoice_color' "  toolbar="#dlg-toolbar_invoice" buttons="#dlg-buttons-multi-invoice" closed="true" >
    <div class="easyui-layout" fit="true">
        <!-- east Region Start-->
        <!--      <div data-options="region:'east',split:'true' " title="History" style="width:180px;height:400px;">
        <?php
                include 'Menu/display_invoice_right_menu.php';
        ?>
        </div>-->
        <!-- **************** east Region End ***********************-->

        <div data-options=" region:'center',split:'true'  " border="false">
            
            <form method="POST" name="form2" id="multi_invoice_form">
                <table style="border-collapse:collapse;">
                    <caption>Multiple Invoice Form</caption>
                    <thead> <th>#</th>
                    <th>Client Id</th>
                    <th>Client Id New</th>
                    <th>Order Id.</th>
                    <th>Order Date</th>
                    <th>Published Date</th>
                    <th>Invoice Date</th>
                   <th>Receivable Amount</th>
                    <th>Work Order No</th>
                   <th>Ref. Id</th>
                   <th>Item Id</th>
               
                    </thead>
                    <tbody class="multi_invoice_table"></tbody>
                </table>
               
                <br/>
                <center><h3>N.B. : Enter Published date and Invoice Date and then Save.</h3></center>






            </form>

        </div>
        <div region="south" border="false" style="text-align:right;height:30px;line-height:30px;">

        </div>


    </div> <!-- layout End -->

</div>
<!-- Start Invoice dlg buttons and All -->
<div id="dlg-buttons-multi-invoice">
    <a href="#" class="easyui-linkbutton" iconCls="icon-save" onclick="saveMultiInvoice();">Save</a>
    <a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onclick="MultiDialogboxClose()">Close</a>
</div>
<!-- End Invoice dlg buttons and All -->