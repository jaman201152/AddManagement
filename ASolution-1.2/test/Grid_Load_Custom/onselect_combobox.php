<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
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
        <?php
        // put your code here
        ?>
                <input class="easyui-combobox" name="wg_id" id="wg_id" value="1"
        data-options="url:'get_work_groups.php',
            method:'get',
            valueField:'cust_id',
            textField:'name',
            panelHeight:'auto',
            onSelect: function(rec){
              $('#dg').datagrid({url:'get_locations.php' });
            }
    ">
                
                
                 <table  id="dg" class="easyui-datagrid" style="width:800px;height:250px"
			url="get_locations.php"
			title="Load Data" iconCls="icon-save" fitColumns="true">
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
                                <th field='upazila' width='80'>Upazila</th>
			</tr>
		</thead>
            
	</table>
        
        <script>
            
    
        </script>
    </body>
</html>
