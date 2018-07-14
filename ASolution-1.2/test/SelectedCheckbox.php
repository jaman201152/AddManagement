<?php
include '../conn.php';

?>

<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="keywords" content="jquery,ui,easy,easyui,web">
	<meta name="description" content="easyui help you build your web page easily!">
	<title>jQuery EasyUI Demo</title>
	<link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/themes/default/easyui.css">
	<link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/themes/icon.css">
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.4.4.min.js"></script>
	<script type="text/javascript" src="http://www.jeasyui.com/easyui/jquery.easyui.min.js"></script>
	
</head>
<body>
    
     <!-- ****************  Start for  Order ***************  -->
     	<h1>Order Table</h1>
	<div style="margin-bottom:20px">
		<a href="#" onclick="getSelected()">GetSelected</a>
		<a href="#" onclick="getSelections()">Orders Calculate</a>
	</div>
        <table  id="tt" class="easyui-datagrid" style="width:800px;height:250px"
			url="get_order.php"
			title="Load Data" showFooter="true" iconCls="icon-save" fitColumns="true" data-options="rownumbers:true ">
		<thead>
			<tr>
                            <th data-options="field:'ck', checkbox:'true' "></th>
				<th field="cust_id" width="80">Cust. Id.</th>
                                <th field="order_id" width="60" align="center">Order. Id.</th>
                                <th field="qty">Qty.</th>
				<th field="unit_price" width="80" align="right">Unit Price</th>
                                <th field="price" width="80" align="right">Price</th>
				<th field="discount" width="80" align="right">Discount(%)</th>
                                <th field="discount_amount" width="80" align="right">Discount_amt</th>
				<th field="payable_amount" width="150">Payable Amount</th>
				<th field="order_date" width="80">Order Date</th>
			</tr>
		</thead>
            
	</table>
       
        


        <table>
            <tr><td>Selected Amount:</td><td><div id="selected_amount"> </div></td></tr>
        </table> 
        
        <!--  *************** End for Order ************** -->
        
    
	<h1>Invoice Table</h1>
	<div style="margin-bottom:20px">
		<a href="#" onclick="getSelected()">GetSelected</a>
		<a href="#" onclick="getSelections()">GetSelections</a>
	</div>
        
        
        
        
	<table  id="tt_invoice" class="easyui-datagrid" style="width:600px;height:250px"
			url="get_invoice_individual.php"
			title="Load Data" iconCls="icon-save" fitColumns="true">
		<thead>
			<tr>
                            <th data-options="field:'ck', checkbox:'true' "></th>
				<th field="cust_id" width="80">Cust. Id.</th>
                                <th field="invoice_num" width="60" align="center">Inv. Num.</th>
				
				<th field="unit_price" width="80" align="right">Unit Price</th>
				<th field="unitcost" width="80" align="right">Unit Cost</th>
				<th field="payable_amount" width="150">Payable Amount</th>
				<th field="order_date" width="80">Order Date</th>
			</tr>
		</thead>
              
	</table>
        <table>
            <tr><td>Selected Amount:</td><td><div id="selected_amount"> </div></td></tr>
        </table>
        
        <div style="margin:20px 0"></div>
    <div class="easyui-panel" style="width:100%;max-width:400px;padding:30px 60px;">
        <div style="margin-bottom:20px">
            <label class="label-top">State:</label>
            <select class="easyui-combobox" name="state" id="state" style="width:100%;height:26px;">
                <option value="Dhaka">Dhaka</option>
                <option value="Chittagong">Chittagong</option>
                <option value="Rajshahi">Rajshahi</option>
                <option value="Khulna">Khulna</option>
            
            </select>
        </div>
        <div id="sel_val"></div>
    </div>
        
        
        <script>
            
           //var rows1 = $('#tt').datagrid('getSelections');
           
            $(function(){
                 $('#tt').datagrid({
                    onSelect: function(rowIndex, rowData)
                     {
                         total = 0;
                        for(var i=0; i<=rowIndex; i++){
                         total += parseFloat(rowData.payable_amount);
                       //alert(rowIndex + rowData.payable_amount);
                        }
                       document.getElementById('selected_amount').innerHTML = total;
                     }
                 });
                 });
                 
                 // for OnSelect Changed Event//
                 
                 (function($){
  $.extend($.fn.datagrid.defaults, {
    onSelect: function(index, row){
      var opts = $(this).datagrid('options');
      if (opts.onSelectRow){
        opts.onSelectRow.call(this, index, row);
      }
      if (opts.selectedIndex !== index){
        opts.selectedIndex = index;
        if (opts.onSelectChanged){
          opts.onSelectChanged.call(this, index, row);
        }
      }
    }
  });
})(jQuery);

// End For OnSelect Event //
            
            
		function getSelected(){
			var row = $('#tt').datagrid('getSelected');
			if (row){
				alert('Item ID:'+row.invoice_num+"\nPrice:"+row.payable_amount);
			}
                        else{
                             $.messager.alert('Message', "Please select atleast one item.", 'info');
                        }
		}
		function getSelections(){
			
			var rows = $('#tt').datagrid('getSelections');
                       if(rows){
                           
                        var total = 0 ;
			for(var i=0; i<rows.length; i++){
				//ids.push(rows[i].payable_amount);
                              total += parseFloat(rows[i].payable_amount);
			}
                        
			document.getElementById('selected_amount').innerHTML = total;
                    }
                    
                    else{
                             $.messager.alert('Message', "Please select atleast one item.", 'info');
                        }
                 
		}
                
               //var rows = $('#tt').datagrid('getSelections');
                //$.messager.alert('Message', "Please select atleast one item.", 'info');
                
                
                // For Combox Start
                     $('#state').combobox({
                    onChange:function(data){
                 
                 $('#sel_val').html('you have selected<span style="color:green;"> ' + data +  '</span> !');
                            
        }
        });
                
	</script>
</body>
</html>