
<?php

    if(isset($_POST['fromWeekDate']) && isset($_POST['toWeekDate'])){
         $fromWeekDate = $_POST['fromWeekDate'];
            $fromWeekDaten=new DateTime($fromWeekDate);
            $fromWeekDatef = $fromWeekDaten->format('Y-m-d');
                
         $toWeekDate = $_POST['toWeekDate'];
         $toWeekDaten=new DateTime($toWeekDate);
         $toWeekDatef=$toWeekDaten->format('Y-m-d');
       // $fromWeekDatef.$toWeekDatef;
    }
        if(isset($_POST['tolastWeekDate']) && isset($_POST['fromlastWeekDate'])){
          $fromlastWeekDate = $_POST['fromlastWeekDate'];
          $fromlastWeekDaten=new DateTime($fromlastWeekDate);
           $fromlastWeekDatef = $fromlastWeekDaten->format('Y-m-d');
                
         $tolastWeekDate = $_POST['tolastWeekDate'];
         $tolastWeekDaten=new DateTime($tolastWeekDate);
         
         $tolastWeekDatef=$tolastWeekDaten->format('Y-m-d');
       // $fromWeekDatef.$toWeekDatef;
    }
    
    if (isset($_POST['today'])) {
        $today = $_POST['today'];
       // $today;
    }
    if(isset($_POST['firstDayOfMonth']) && isset($_POST['lastDayOfMonth'])){
         $firstDayOfMonth = $_POST['firstDayOfMonth'];
          $lastDayOfMonth = $_POST['lastDayOfMonth'];
       //  $firstDayOfMonth.$lastDayOfMonth;
    }
        if(isset($_POST['first_day_pre_month']) && isset($_POST['last_day_pre_month'])){
        $first_day_pre_month = $_POST['first_day_pre_month'];
        $last_day_pre_month = $_POST['last_day_pre_month'];
       //  $firstDayOfMonth.$lastDayOfMonth;
    }
    if(isset($_POST['all'])){
        $all = $_POST['all'];
       // "all time period.";
    }

 ?>

<table id="report_table_win" title="List of all Received
     <?php if(isset($_POST['today'])) {echo $today;?>
           <a href='Report/delemited_data_order.php?today=<?php echo $today;?>' target='_blank'>Export as Excel</a>
   <?php } 
    elseif(isset($_POST['fromWeekDate']) && isset($_POST['toWeekDate'])){echo " Form: ".$fromWeekDatef." to ".$toWeekDatef;?>
           <a href='Report/delemited_data_order.php?from_date=<?php echo $fromWeekDatef;?>&to_date=<?php echo $toWeekDatef;?>' target='_blank'>Export as Excel</a>
   <?php }
        elseif(isset($_POST['fromlastWeekDate']) && isset($_POST['tolastWeekDate'])){echo " Form: ".$fromlastWeekDatef." to ".$tolastWeekDatef;?>
           <a href='Report/delemited_data_order.php?from_date=<?php echo $fromlastWeekDatef;?>&to_date=<?php echo $tolastWeekDatef;?>' target='_blank'>Export as Excel</a>
   <?php }
    elseif(isset($_POST['firstDayOfMonth']) && isset($_POST['lastDayOfMonth'])){echo " Form: ".$firstDayOfMonth." to ".$lastDayOfMonth;?>
           <a href='Report/delemited_data_order.php?from_date=<?php echo $firstDayOfMonth;?>&to_date=<?php echo $lastDayOfMonth;?>' target='_blank'>Export as Excel</a>
   <?php }
        elseif(isset($_POST['first_day_pre_month']) && isset($_POST['first_day_pre_month'])){echo " Form: ".$first_day_pre_month." to ".$last_day_pre_month;?>
           <a href='Report/delemited_data_order.php?from_date=<?php echo $first_day_pre_month;?>&to_date=<?php echo $last_day_pre_month;?>' target='_blank'>Export as Excel</a>
   <?php }
     elseif(isset($_POST['all'])){
       echo "[ All time period ]";
    ?>
           <a href='Report/delemited_data_order.php?date=<?php echo $all;?>' target='_blank'>Export as Excel</a>
   <?php }else{  echo "[There is no data for this time peroid.]"; } ?>
       " class="easyui-datagrid" style="width:auto; height:400px; overflow-y: scroll;"

			rownumbers="true" singleSelect="true" showFooter="true" >
		<thead>
			<tr>
<!--                                <th data-options="field:'ck',checkbox:true "></th>-->
								<th field="payment_id" with="auto" sortable="true">Bill No. </th>
								<th field="invoice_id" with="auto" sortable="true">Inv. No. </th>
                                <th field="order_id" with="auto" sortable="true">O. Id. </th>
                                <th field="cust_id_new" width="auto" sortable="true"> Cust. ID.</th>
				<th field="payment_date" width="auto" sortable="true">Payment Date</th>
                <th field="payable_amount" width="auto" sortable="true" data-options="align:'right' ">Receivable Amt.</th>
				<th field="receive_amount" width="auto" sortable="true" data-options="align:'right' ">Received Amt.</th>
				<th field="due" width="auto" sortable="true" data-options="align:'right' ">Due on Received Amt.</th>
			</tr>
		</thead>
</table>


	<div id="toolbar">

            
	
        </div>
<!-- End Customer tool bar -->
<script type="text/javascript">
             // ************** Start Clients Funtions **********************
//   function Clients(){
//   $('#jloading').html('<img src="../themes/default/images/loading.gif"> Loading...');
//
//                       $('#container').panel({
//                href:'customer_profile/all_members_list.php',
//                onLoad:function(){
//                    $('#jloading').panel('clear');
//                }
//                
//                });
//            }   
         // **************************** End Clients Function ********************************  
       

        var today = "<?php $to = !empty($today) ? $today : "";  echo $to;?>";
        var toWeekDate = "<?php $toWeekD = !empty($toWeekDatef) ? $toWeekDatef : "";  echo $toWeekD;?>";
        var fromWeekDate = "<?php $fromWeekD = !empty($fromWeekDatef) ? $fromWeekDatef : "";  echo $fromWeekD;?>";

        var tolastWeekDate = "<?php $tolastWeekD = !empty($tolastWeekDatef) ? $tolastWeekDatef : "";  echo $tolastWeekD;?>";
        var fromlastWeekDate = "<?php $fromlastWeekD = !empty($fromlastWeekDatef) ? $fromlastWeekDatef : "";  echo $fromlastWeekD;?>";


        var firstDayOfMonth = "<?php $fdom = !empty($firstDayOfMonth) ? $firstDayOfMonth : "";  echo $fdom;?>";
        var lastDayOfMonth = "<?php $ldom = !empty($lastDayOfMonth) ? $lastDayOfMonth : "";  echo $ldom;?>";
        
        var firstDayOfPreMonth = "<?php $fdopm = !empty($first_day_pre_month) ? $first_day_pre_month : "";  echo $fdopm;?>";
        var lastDayOfPreMonth = "<?php $ldopm = !empty($last_day_pre_month) ? $last_day_pre_month : "";  echo $ldopm;?>";
        
         var all = "<?php $all=!empty($all) ? $all : ""; echo $all; ?>";

        if(today!==""){
               $('#report_table_win').datagrid({
                url:'Report/receive_search.php?q='+today
            });
        }

              if(fromWeekDate!=="" && toWeekDate!==""){
                //alert(fromWeekDate+toWeekDate);
                      $('#report_table_win').datagrid({
                            url:'Report/receive_search.php?fromWeekDate='+fromWeekDate+" & toWeekDate="+toWeekDate
                    });
                }
            if(fromlastWeekDate!=="" && tolastWeekDate!==""){
                //alert(fromWeekDate+toWeekDate);
                      $('#report_table_win').datagrid({
                            url:'Report/receive_search.php?fromlastWeekDate='+fromlastWeekDate+" & tolastWeekDate="+tolastWeekDate
                    });
                }        
                
           if(firstDayOfMonth!=="" && lastDayOfMonth!==""){
                //alert(fromWeekDate+toWeekDate);
                      $('#report_table_win').datagrid({
                            url:'Report/receive_search.php?firstDayOfMonth='+firstDayOfMonth+" & lastDayOfMonth="+lastDayOfMonth
                    });
                }
               if(firstDayOfPreMonth!=="" && lastDayOfPreMonth!==""){
                //alert(fromWeekDate+toWeekDate);
                      $('#report_table_win').datagrid({
                            url:'Report/receive_search.php?firstDayOfPreMonth='+firstDayOfPreMonth+" & lastDayOfPreMonth="+lastDayOfPreMonth
                    });
                }
                
            if(all!==""){
               $('#report_table_win').datagrid({
                url:'Report/receive_search.php?all='+all
            });
        }
                  
    
    
  
         
        
         </script>
