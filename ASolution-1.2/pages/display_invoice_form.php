    <div id="dd" class="easyui-dialog" title="Create Invoices"  style="width:900px;height:600px;padding:10px"
    toolbar="#dlg-toolbar" buttons="#dlg-buttons">
  <div class="easyui-layout" fit="true">
            <!-- east Region Start-->
      <div data-options="region:'east',split:'true' " title="History" style="width:180px;height:500px;">
                  <?php
                        include 'Menu/display_invoice_right_menu.php';
                  ?>
      </div>
            <!-- **************** east Region End ***********************-->
    
    <div data-options=" region:'center',split:'true'  " border="false">
       
        <form method="POST" name="form1" id="invoice_form">
            <table style="border-collapse:collapse;" width="100%">
                <tr style="background:#f1f1f1;">
                    <td><label>Customer: Job</label></td>
                    <td width="10">&nbsp;</td><td><label>Class: </label></td>
                     <td width="150">&nbsp;</td><td><label>Company: </label></td><td></td>
                </tr>
                <tr style="background:#f1f1f1;">
                
                    <td><input id="customer" style="width:100px"
                    url="data/combobox_data.json"
                    valueField="id" textField="text">
                        </input>
                    </td><td width="50">&nbsp;</td>
                    <td><input id="class" style="width:100px"
                    url="data/combobox_data.json"
                    valueField="id" textField="text">
                        </input>
                    </td><td width="50">&nbsp;</td>
                    <td><input id="company" style="width:100px"
                    url="data/combobox_data.json"
                    valueField="id" textField="text">
                        </input>
                    </td>
                </tr>
                <tr>
                    <td colspan="5">&nbsp;</td>
                </tr>
            </table>
                <table width='100%'>
                <tr>
                    <td></td> <td></td>
                    <td>
                        <div class="easyui-panel" title="Date" style="width:160px; height:55px;">
                            <input class="easyui-datetimebox" name="txtdate" id="txtdate"></input>
                        </div> 
                         
                    </td>
                    <td>
                          <div class="easyui-panel" title="Invoice # " style="width:160px; height:55px;">
                            <input class="easyui-textbox" name="txtinvoice" id="txtinvoice">
                        </div>
                    </td>
                
                </tr>
                <tr>
                    <td><div style="font-weight: 700;">Invoice</div>
                        <div class="easyui-panel" title="Bill To" style="width:300px; height: 200px;">
                           
                        </div>
                    </td>
                   
                </tr>
           
            </table>
            <br/>
           
                  
            <table width='100%' style="border-collapse: collapse; padding: 10px; margin:0;  ">
                     <tr style="background: #f1f1f1; font-weight: 700; ">
                    <td>Item</td>
                    <td>Description</td>
                    <td>Qty</td>
                    <td>Rate</td>
                    <td>Class</td>
                    <td>Amount</td>
                </tr>
                <tr style="background: #f1f1f1;  ">
                        <td>
                            <select class="easyui-combo" style="width:100px;">
                            <option>test1</option>
                            <option>test2</option>
                        </select>
                            </td>
                    <td> <textarea style="width:120px;height:35px;resize:none"></textarea></td>
                    <td> <input class="" name="txtqt" id="txtqt" style="width:40px;"></td>
                    <td> <input class="" name="txtrate" id="txtrate" style="width:40px;"></td>
                    <td> <input class="" name="txtclass" id="txtclass" style="width:40px;"></td>
                    <td> <input class="" name="txtamount" id="txtdate" style="width:40px;"></td>
                  
                </tr>
            </table>    
            
      
         
         
        </form>
      
    </div>
<div region="south" border="false" style="text-align:right;height:30px;line-height:30px;">
      
</div>
            
            
 </div> <!-- layout End -->

    </div><!-- dialog end -->
      <div id="dlg-buttons">
        
            
        
        <a href="#" class="easyui-linkbutton" iconCls="icon-save" onclick="javascript:alert('save')">Save</a>
        <a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dd').dialog('close')">Close</a>
   
        </div>
    <script>
     
            $('#customer').combobox({
    formatter:function(row){
    var imageFile = 'images/' + row.icon;
    return '<img class="item-img" src="%27%2bimageFile%2b%27.html"/><span class="item-text">'+row.text+'</span>';
    }
    });
    
           $('#class').combobox({
    formatter:function(row){
    var imageFile = 'images/' + row.icon;
    return '<img class="item-img" src="%27%2bimageFile%2b%27.html"/><span class="item-text">'+row.text+'</span>';
    }
    });
    
         $('#company').combobox({
    formatter:function(row){
    var imageFile = 'images/' + row.icon;
    return '<img class="item-img" src="%27%2bimageFile%2b%27.html"/><span class="item-text">'+row.text+'</span>';
    }
    });
   
    </script>