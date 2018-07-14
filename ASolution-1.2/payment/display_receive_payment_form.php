    
<div id="dd" class="easyui-window" title="Receive Payments"
     data-options="iconCls:'icon-bill' " style="width:900px;height:600px; padding: 5px;" >
        
        <div class="easyui-layout"  style="width:875px;height:552px;">
            <div data-options="region:'west',split:'true',title:'Accept Payments'" style="width:160px;">
                
            </div>
             <div data-options="region:'center',split:'true' " style="width:760px; padding:5px;">
                 <div class="easyui-panel" style="padding:5px;">
                     <form name="receive_pament_form">
                     <h2>Customer Payment</h2>
                     <table width='100%' cellpadding='5'>
                        <tr>
                            <td>Received From</td><td>
                    <input class="easyui-combobox" style="width: 200px;" name="invoice_num" id="invoice_num">
                                
                                     </input>
                             
                                <a href="javascript:void()" class="easyui-linkbutton" onclick="loadPayment()">Load</a>
                            </td>
                            <td>Customer Balance</td><td>0.00</td>
                        </tr>
                        
                        <tr>
                            <td>Amount</td><td><input class="easyui-textbox" style="width: 100px; text-align: right;" value="0.00" name="amount"/></td>
                            <td>Date</td><td><input class="easyui-datebox" name="pmt_date"></input></td>
                        </tr>
                        <tr>
                            <td>Pmt. Method</td><td><input class="easyui-combo" name="pmt_method"></input></td>
                            <td>Check #</td><td><input class="easyui-textbox"></input></td>
                        </tr>
                        <tr>
                            <td>Memo</td><td><input class="easyui-textbox" name="pmt_memo"></input></td>
                            <td>Deposit to</td><td><input class="easyui-combo"></input></td>
                        </tr>
                        
                        <tr><td></td><td></td><td></td><td></td></tr>
                        <tr><td></td><td></td><td></td><td></td></tr>
                     </table>
                   
                     <div id="individual_payment" style="height:150px; max-height: 160px; overflow-y: scroll;">
                         -- Select Receive from field To see all transaction. --
                     </div>
                       
                        
                 
                         
                       
                     <div style="width: 400px;">
                         <br/>
                         <fieldset style="border:1px #ccc solid;"><legend>Amounts for selected Invoices</legend>
                             <table>
                                 <tr>
                                     <td>Amount Due</td><td><input class="easyui-textbox" name="txtdue" id="txtdue"/></td>
                                 </tr>
                                 <tr>
                                     <td>Applied</td><td><input class="easyui-textbox" name="txtdue" id="txtdue"/></td>
                                 </tr>
                                 <tr>
                                     <td>Discount and Credits Applied</td><td><input class="easyui-textbox" name="txtdue" id="txtdue"/></td>
                                 </tr>
                                 <tr><td></td><td>&nbsp;</td></tr>
                             </table>
                         </fieldset>
                     </div>
                        <div id="receive-payment-buttons" style="float: right;">
                    <a href="#" class="easyui-linkbutton" iconCls="icon-save" onclick="javascript:alert('save')">Save</a>
                    <a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dd').dialog('close')">Close</a>
                    <input type="reset" class="easyui-linkbutton"  value="Reset" style="padding:6px 12px;">
                    </div>
                     </form>
                 </div>
                 
              
            </div>
           
        
        </div>
   
    </div>
<script>
   
        
       
        function loadPayment(){
           
            
            var a=$('#invoice_num').combobox('getValue');
            
            if(a){    
                     $.ajax({
                           url:'payment/get_payment_individual.php?q='+a,
                           success: function(data){
                           $('#individual_payment').html(data);
                           }
                       });//  For Individual payment display reload div.
            }
            else{
                $('#individual_payment').hide();
            }
            
                    
        }
        
        
 
</script>
<script type="text/javascript">
		$(function(){
			$('#invoice_num').combogrid({
				panelWidth:500,
				url: 'invoice/get_invoice_individual.php',
				idField:'cust_id',
				textField:'name',
				fitColumns:true,
				columns:[[
					{field:'cust_id',title:'Customer ID',width:60},
					//{field:'invoice_num',title:'Invoice Num',width:80},
					{field:'name',title:'Company Name',width:60},
					//{field:'payable_amount',title:'Unit Cost',align:'right',width:60},
					{field:'ref_name',title:'Referance Name',width:150}
					//{field:'discount',title:'Discount',align:'center',width:60}
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