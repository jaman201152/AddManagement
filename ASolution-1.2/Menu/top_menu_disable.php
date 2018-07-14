<?php

?>
<center>
&nbsp;&nbsp;&nbsp;

<a href="indexk.php" id="home_btn" class="easyui-linkbutton" data-options="plain:false,iconCls:'icon-home' " style="width:80px; ">Home</a>
<a href="?pages=customer_profile/all_members_list.php" id="clients_btn" class="easyui-linkbutton" data-options="iconCls:'icon-customer' " style="width:80px;" title="Clients Profile, Order, Payment" >Clients</a>
        <a href="?pages=order_all/all_members_list.php" id="order_btn" class="easyui-linkbutton" data-options="iconCls:'icon-order' " style="width:80px; " title="All order list">Orders</a>
        <a href="?pages=invoice/display_invoice_form.php" id="invoice_btn" class="easyui-linkbutton" data-options="iconCls:'icon-invoice_color'" style="width:80px; " title="All Invoice">Invoices</a>
        <a href="?pages=e_receipt/all_ereceipt_display.php" id="receipt_btn" class="easyui-linkbutton" data-options="iconCls:'icon-ereceipt'" style="width:80px; " title="All E-Receipt" onclick="AllEReceipt()">Receipt</a>
<!--        <a href="#" class="easyui-linkbutton" data-options="iconCls:'icon-print'" style="width:80px; ">Print</a>-->
<a href="?pages=payment/display_receive_payment_form.php" id="bill_btn" class="easyui-linkbutton" data-options="iconCls:'icon-bill'" style="width:80px; ">Bill</a>
        <a href="?pages=region/display_region.php" id="region_btn" class="easyui-linkbutton" data-options="iconCls:'icon-region'" style="width:80px; " title="Clients Region">Region</a>
        <a href="#" class="easyui-menubutton" id="samity_btn" data-options="plain:false,menu:'#mm5' " style="width:80px; ">Samity</a>

        <a href="#" class="easyui-menubutton" id="tools_btn" data-options="plain:false,menu:'#mm4',iconCls:'icon-tools' " style="width: 80px;">Tools</a>
                <a href="#" class="easyui-menubutton" id="help_btn" data-options="plain:false,menu:'#mm2',iconCls:'icon-help'" style="width:80px; ">Help</a>
        <a href="index.php" class="easyui-linkbutton" id="logout_btn" data-options="iconCls:'icon-lock' " style="width:80px; ">Log Out</a>
        <?php
 //echo $_SESSION['s_email'];

?>
        <div id="mm2" style="width:100px;">
            <div>Help</div>
            <div id="btn-about">About</div>
        </div>
        
          <div id="mm4" style="width:100px;">
            <div>Options</div>
        </div>
        <div id="mm5">
             <div>
                <a href="?pages=members/index.php" style="text-decoration: none; color:#444;">All Members</a>
            </div>
            <div>
                <a href="?pages=transaction/index.php" style="text-decoration: none; color:#444;">Transaction</a>
            </div>
            <div>
                <a href="?pages=property/index.php" style="text-decoration: none; color: #444;">Property</a>
            </div>
            
        </div>
        
        
<!-- Top Menu End -->

        <div id="about-data" data-options="title:'About ASolution'" class="easyui-dialog" closed="true" style="width:400px; height:300px;padding:10px;">
           <h2>ASolution</h2>
             <center>
             <img src="images/logo.png" style="width:120px;height:50px"><br/><br/>
             <h4>Version-1.0</h4><br/><br/><br/>
            IT Consultant and Solution Company in Bangladesh.
            </center>
        </div>
</center>
        <script>
            $(document).ready(function(){
                $('#btn-about').click(function(){
                    $('#about-data').dialog('open');
                      
                });
                
                $('#home_btn').linkbutton('disable');
                $('#clients_btn').linkbutton('disable');
                $('#order_btn').linkbutton('disable');
                $('#invoice_btn').linkbutton('disable');
                $('#receipt_btn').linkbutton('disable');
                $('#bill_btn').linkbutton('disable');
                $('#region_btn').linkbutton('disable');
                $('#samity_btn').linkbutton('disable');
                $('#tools_btn').linkbutton('disable');
                $('#help_btn').linkbutton('disable');
                $('#logout_btn').linkbutton('disable');
                
            
            });
        </script>
        