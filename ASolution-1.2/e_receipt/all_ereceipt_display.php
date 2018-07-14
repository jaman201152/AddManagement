<div style="max-height: 400px; overflow: scroll;">
    

<table id="dg" title="List of all E-Receipt" class="easyui-datagrid" style="width:auto; height: 350px; "
	data-options="iconCls:'icon-order', multiSort:true " url="e_receipt/get_all_ereceipt.php"
			toolbar="#toolbar" 
			rownumbers="true" fitColumns="true" singleSelect="true" showFooter="true" >
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
                        <th data-options="field:'due',align:'right'  ">Due</th>
                        <th field="status" > Status</th>
                    </tr>
                </thead>
               
</table>


	<div id="toolbar">
             <a href="javascript:void()" class="easyui-linkbutton" iconCls="icon-print" onclick="e_Receipt_Print()" >Print Preview Selected E-Reciept</a>
      <!--      <a href="javascript:void(0)" class="easyui-linkbutton" id="edt" iconCls="icon-edit" plain="false" onclick="editUser()">Edit </a>
            <a href="javascript:void(0)" class="easyui-linkbutton" id="cnl" iconCls="icon-remove" plain="false" onclick="destroyUser()">Destroy </a>
            <a href="javascript:void(0)" class="easyui-linkbutton" id="client_profile" iconCls="icon-profile" plain="false" onclick="profile()">Profile</a>-->

<!--      <a href="javascript:void(0)" class="easyui-linkbutton" iconCls='icon-tip' plain='true' onclick="detailsView()">Details</a>-->




<span style="float: right;"><input type="text"  name="txtsearch" id="txtsearch" placeholder="Ememo_id / Invoice Num" />
            <a href="#" class="easyui-linkbutton" plain="false" iconCls="icon-search" onclick="doSearch()" >Search</a>
        </span>

<span style="float: right;">
   From Date: <input type="text" class="easyui-datebox"  name="txt_from_date" id="txt_from_date" placeholder="From Date" />
  To Date:  <input type="text" class="easyui-datebox"  name="txt_to_date" id="txt_to_date" placeholder="To Date" />
            <a href="#" class="easyui-linkbutton" plain="false" iconCls="icon-search" onclick="filter_AllEreceipt()" >Filter</a>
            &nbsp; &nbsp; &nbsp;
        </span>
            
	
        </div>
<!-- End Customer tool bar -->

<div id="dlg_filter_by_date" class="easyui-dialog" title="E_receipt by date" style="width:850px;height:500;"
        data-options="iconCls:'icon-ereceipt',resizable:true,modal:true,closed:true" >
    
    
    <table id="dg_filter_by_date"  class="easyui-datagrid" style="width:845; height: 450px; "
	data-options=" multiSort:true " 
			toolbar="#dg_toolbar_filter_by_date" 
			rownumbers="true" fitColumns="true" singleSelect="true" showFooter="true" >
		   <thead>
                    <tr>
                        <th data-options="field:'ck',checkbox:true "></th>
                        <th field="memo_id" sortable="true">E_Memo Id.</th>
                        <th field='invoice_id' data-options="sortable:'true' ">Invoice Num.</th>
                        <th field='order_id' >Order Id.</th>
                        <th field='cust_id'>Cust. ID</th>
                        <th field='payment_date' sortable="true">Payment. Date</th>
                        <th data-options="field:'payable_amount',align:'right'">Receivable Amt.</th>
                        <th data-options="field:'receive_amount',align:'right' ">Receive Amt.</th>
                        <th data-options="field:'paid_amount',align:'right' ">Paid Amt.</th>
                        <th data-options="field:'due',align:'right'  ">Due</th>
                        <th field="status" > Status</th>
                    </tr>
                </thead>
               
</table>
    
     <div id="dg_toolbar_filter_by_date">
        
                <a href="javascript:void()" class="easyui-linkbutton" iconCls="icon-print" onclick="e_ReceiptFilterByDatePrint()" >Print Preview Selected E-Reciept</a>
<!--                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-print" onclick="allInvoicePrint()">All E-Reciept Print Preview</a>-->
<!--                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="" onclick="getAllReceipt()">All E-Receipt</a>-->
                <span style="float: right;"><input type="text" name="txtsearch_filter_by_date"  id="txtsearch_filter_by_date" >
                        <a href="javascript:void(0)" class="easyui-linkbutton" plain="false" iconCls="icon-search" onclick="doFilterByDateSearch()" >Search</a>
                </span>
            </div>
    
</div>

</div>
<script>
          function doSearch(){
                      
			$('#dg').datagrid('load',{
				
				productid: $('#txtsearch').val()
			});
                 
		}
                
                
             function e_Receipt_Print(){
        var row=$('#dg').datagrid('getSelected');
        if(row){
              
    window.open("Report/preview_payment_ind_ereceipt.php?cust_id="+row.cust_id+"&inv_num="+row.invoice_id+"&order_id="+row.order_id+"&ememo_id="+row.memo_id,"myNewWinsr","width=900,height=600,toolbar=0,menubar=no,status=no,resizable=yes,location=no,direction=no,scrollbars=yes");

        }
        else{
              $.messager.alert('Message', "Please select atleast one item for e_receipt.", 'info');
        }
        
    }
    
    //End All E-receipt display
    
//    function filter_AllEreceipt(){
//        
//        var from_date = $('#txt_from_date').datebox('getValue');
//        var to_date = $('#txt_to_date').datebox('getValue');
//        //alert(from_date + to_date);
//           window.open("Report/preview_payment_from_to_date_ereceipt.php?from_date="+from_date+" && to_date="+to_date,"myNewWinsr","width=900,height=600,toolbar=0,menubar=no,status=no,resizable=yes,location=no,direction=no,scrollbars=yes");
//
//    }
    
     function filter_AllEreceipt(){
        var from_date = $('#txt_from_date').datebox('getValue');
        var to_date = $('#txt_to_date').datebox('getValue');
        
        $('#dlg_filter_by_date').dialog('open').dialog('setTitle','List of All E-Receipt from '+from_date+' to '+to_date);
        $('#dg_filter_by_date').datagrid({
            url:'e_receipt/by_date_filter_ereceipt.php?from_date='+from_date+'&to_date='+to_date
        });
        
    }
    
    function doFilterByDateSearch(){
        
        $('#dg_filter_by_date').datagrid('load',{
				
				productid: $('#txtsearch_filter_by_date').val()
			});
        
    }
    
            function e_ReceiptFilterByDatePrint(){
        var row=$('#dg_filter_by_date').datagrid('getSelected');
        if(row){
              
    window.open("Report/preview_payment_ind_ereceipt.php?cust_id="+row.cust_id+"&inv_num="+row.invoice_id+"&order_id="+row.order_id+"&ememo_id="+row.memo_id,"myNewWinsr","width=900,height=600,toolbar=0,menubar=no,status=no,resizable=yes,location=no,direction=no,scrollbars=yes");

        }
        else{
              $.messager.alert('Message', "Please select atleast one item for e_receipt.", 'info');
        }
        
    }
    
    
</script>