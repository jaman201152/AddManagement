<?php

if(!$_SESSION['s_email']){
    header("location: index.php");
}
   $ledger=substr($_SERVER['REQUEST_URI'],49,-4);
?>
<style>
        .selected{
        font-weight: bold;
        color:#23527c;
    }
</style>
<center>
&nbsp;&nbsp;&nbsp;

        <a href="indexk.php" class="easyui-linkbutton" data-options="plain:false,iconCls:'icon-home'" style="width:80px; ">
            <span <?php if($ledger==''){echo 'class="selected"';} ?>>Report</span>
        </a>
        <a href="?pages=customer_profile/all_members_list.php" class="easyui-linkbutton" data-options="iconCls:'icon-customer' " style="width:80px;" title="Clients Profile, Order, Payment" >
            <span <?php if($ledger=='all_members_list'){echo 'class="selected"';} ?>>Clients</span>
        </a>
<!-- For uncomplete -->
        <a href="?pages=order_all/all_members_list.php" class="easyui-linkbutton" data-options="iconCls:'icon-order' " style="width:80px; " title="All order list">
            <span <?php if($ledger=='bers_list'){echo 'class="selected"';} ?>>Orders</span>
        </a>
        <?php
        if($_SESSION['s_email'] ==='admin@dailyasianage.com' || $_SESSION['s_email'] ==='superadmin@dailyasianage.com'){
            ?>
                 <a href="?pages=invoice/display_invoice_form.php" class="easyui-linkbutton" data-options="iconCls:'icon-invoice_color'" style="width:150px; " title="All Invoice">
                      <span <?php if($ledger=='nvoice_form'){echo 'class="selected"';} ?>>Invoices/Bill</span>
                  </a>
<!-- 
                   <a href="?pages=e_receipt/all_ereceipt_display.php" class="easyui-linkbutton" data-options="iconCls:'icon-ereceipt'" style="width:120px; " title="All E-Receipt" onclick="AllEReceipt()">
                       <span <?php if($ledger=='ceipt_display'){echo 'class="selected"';} ?>>E-Receipt</span>
                   </a>-->

            <?php
        }
        ?>
      <!-- For uncomplete -->
       
<!--        <a href="#" class="easyui-linkbutton" data-options="iconCls:'icon-print'" style="width:80px; ">Print</a>-->
      <!--  <a href="?pages=payment/display_receive_payment_form.php" class="easyui-linkbutton" data-options="iconCls:'icon-bill'" style="width:80px; ">Bill</a> -->
        <a href="?pages=reference_profile/all_members_list.php" class="easyui-linkbutton" data-options="iconCls:' icon-customer' " style="width: 100px" title="All Reference">
            <span <?php if($ledger=='/all_members_list'){echo 'class="selected"';} ?>>Agent</span>
        </a>
       
      <a href="?pages=region/display_region.php" class="easyui-linkbutton" data-options="iconCls:'icon-region'" style="width:80px; " title="Clients Region">
            <span <?php if($ledger=='gion'){echo 'class="selected"';} ?>>Region</span>
        </a>

<!-- 

   <a href="#" class="easyui-menubutton" data-options="plain:false,menu:'#mm5' " style="width:80px; ">Samity</a>

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
-->





        <a href="#" class="easyui-menubutton" data-options="plain:false,menu:'#mm4',iconCls:'icon-asettings' " style="width: 100px;">
            <span <?php if($ledger=='_homepage'){echo 'class="selected" ';}?>>Settings</span>
        </a>
                <a href="#" class="easyui-menubutton" data-options="plain:false,menu:'#mm2',iconCls:'icon-help'" style="width:80px;">Help</a>
        <a href="index.php" class="easyui-linkbutton" data-options="iconCls:'icon-lock'" style="width:80px; ">Log Out</a>
        <?php
 echo $_SESSION['s_email'];
?>
        <div id="mm2" style="width:100px;">
            <div>Help</div>
            <div id="btn-about">About</div>
        </div>
        
          <div id="mm4">
            <div style="width:250px; height:50px;">
                <a href="?pages=admin_pages/admin_homepage.php" class="easyui-linkbutton" data-options="iconCls:'icon-access_key',plain:true" style="width:auto; ">Change Password</a>
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
              
            });
        </script>
        