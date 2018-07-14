<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="keywords" content="jquery,ui,easy,easyui,web">
	<meta name="description" content="easyui help you build your web page easily!">
	<title>Filter ComboGrid - jQuery EasyUI Demo</title>
	<link rel="stylesheet" type="text/css" href="../themes/default/easyui.css">
	<link rel="stylesheet" type="text/css" href="../themes/icon.css">
	<script type="text/javascript" src="../js/jquery.min.js"></script>
	<script type="text/javascript" src="../js/jquery.easyui.min.js"></script>
	
</head>
<body>
	<h1>Filter ComboGrid Demo</h1>

        <a href="javascript:void(0)" class="easyui-linkbutton" onclick="getValue()">Get</a>
	<input id="cg" style="width:150px"></input>
</body>
<script type="text/javascript">
		$(function(){
			$('#cg').combogrid({
				panelWidth:500,
				url: 'get_invoice_individual.php',
				idField:'invoice_num',
				textField:'name',
				fitColumns:true,
				columns:[[
					{field:'invoice_id',title:'Invoice ID',width:60},
					{field:'invoice_num',title:'Invoice Num',width:80},
					{field:'name',title:'Company Name',width:60},
					{field:'payable_amount',title:'Unit Cost',align:'right',width:60},
					{field:'ref_name',title:'Referance',width:150},
					{field:'discount',title:'Discount',align:'center',width:60}
				]]
			});
			$("input[name='mode']").change(function(){
				var mode = $(this).val();
				$('#cg').combogrid({
					mode: mode
				});
			});
                        
                       
                        
		});
	</script>
<script>
      function getValue(){
                            var a=$('#cg').combogrid('getValue');
                            $.messager.alert("message",a,"info");
                    } 
</script>
</html>
