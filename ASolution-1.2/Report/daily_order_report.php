<?php
          
//         $d=new DateTime($row['order_date']);
//                $date=$d->format('d-m-Y H:i a'); // date show like d-m-Y.
//                $o_date=array("o_date"=>"$date");
//                $cust_order=  array_merge($row,$row_customer); // Two table data has been displayed in one array.
//                $m=  array_merge($o_date,$cust_order);
//		array_push($items, $m);
                
        //$today=new DateTime();
       
       $q=$_GET['q'];
      
?>
<table id="dg" title="List of all orders" class="easyui-datagrid" style="width:auto; min-height:400px"
	data-options="iconCls:'icon-order',remoteSort:false,multiSort:true " 
			toolbar="#toolbar" pagination="true"
			rownumbers="true" fitColumns="true" singleSelect="true" showFooter="true" >
		<thead>
			<tr>
<!--                                <th data-options="field:'ck',checkbox:true "></th>-->
                                <th field="order_id" with="auto" sortable="true">Order Id. </th>
                                <th field="cust_id" width="auto" sortable="true"> Cust. ID.</th>
				<th field="order_date" width="auto" sortable="true">Order Date</th>
                                <th field="price" width="auto" sortable="true">Price</th>
				<th field="discount" width="auto" sortable="true">Discount(%)</th>
				<th field="payable_amount" width="auto" sortable="true">payable_amount</th>
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
        var date="<?php echo $q;?>";
  
         $('#dg').datagrid({
            
                url:'report/get_daily_order.php?qa='+date
                
        });
    
    
         </script>
