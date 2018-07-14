<style type="text/css">
    input[type=text] {
    padding: 5px 5px;
    margin: 5px 0;
    box-sizing: border-box;
    text-align: right;
    font-size:14px;
}
</style>
<div id="w" class="easyui-window" title="Customer Payment by Client" data-options="iconCls:'icon-save',closed:'true'" style="width:1024px;height:650px;padding:5px;">
        <div class="easyui-layout" data-options="fit:true">
<!--            <div data-options="region:'east',split:true" style="width:100px"></div>-->
            <div data-options="region:'center'" style="padding:10px;">
                
                 <form id="receive_multi_payment_form" method="post" novalidate>
                        <span  style="float:right;">Selected Items:<span class="countSelect"></span></span>
                <div class="fitem" style="background: #F1F1F1;">
                <label>Company Name. </label>
         <input name="cust_id"  class="easyui-combobox cust_id" id="cust_id" style="text-align: right; padding: 2px; width:250px; "  autocomplete="off" required="required" /> &nbsp;&nbsp;&nbsp;
         <input type="hidden" name="cust_id_new"  class="cust_id_new" id="cust_id_new" style="text-align: right; padding: 2px;" complete="off" required="required" /> &nbsp;&nbsp;&nbsp;
         <input type="hidden" name="name" class="name" value="" />  
         <div style="display:inline;">
            Balance Due: <span class="balance_due" style="color:#800000;font-size:14px;"></span><br>
            <span  style="float:right;">Selected Amt. <input type="text" id="grandtotal" value=""></span>
         </div>
                </div>
                        <table>
                  <tr>
                      <td>Collection Amount</td><td><input type="text" onkeyup="userTyped('selectall', this)"  name="receive_amount" id="receive_amount_multi" style="padding: 5px 5px; font-weight: bold; width: 150px; text-align: right;  border-radius: 5px; border:1px #ccc solid;"  required="required" autocomplete="off"/></td>
                        <td style="text-align: right;">Paid Amount</td><td><input type="text" name="paid_amount" id="paid_amount" style="  width: 100px; padding: 2px; line-height: 18px;  border-radius: 5px; border:1px #ccc solid;"/></td>
                    </tr>
                    <tr>
                        <td>Commission on Collection Amt.(%)</td>
                        <td><input type="text"  name="commission" id="commission" value="20" style=" font-weight: bold; width: 100px; padding: 2px; line-height: 18px; text-align: right;  border-radius: 5px; border:1px #ccc solid;"  required="required" autocomplete="off"/></td>
                    </tr>
                        <tr>
                        <td>AIT and Others/ Adjustment:</td>
                        <td>
                            <input type="text"  name="ait_others_discount" id="ait_others_discount" style=" font-weight: bold; width: 100px; padding: 2px; line-height: 18px; text-align: right;  border-radius: 5px; border:1px #ccc solid;" value="0"  required="required" autocomplete="off"/>
                        </td>
                    </tr>
                    <tr>
                        <td>Payment Date</td>
                        <td>
                            <div class="fitem">
                                <input class="easyui-datebox" name="payment_date" id="payment_date" required="required" value="<?php echo date('Y-m-d');?>" />
                            </div>
                        </td>

                    </tr>
                    <tr>
                        <td>Pmt. Method</td><td>
                            <select class="easyui-combobox" name="payment_method" id="payment_method" style="width:150px;" required="required">
                                <option value="Cash">Cash</option>
                                <option value="Bank">Bank</option>
                            </select></td>
                        <td>Check #</td><td><input class="easyui-textbox" name="check_num" id="check_num"></input></td>
                    </tr>
                    <tr>
                        <td>Memo</td><td><input class="easyui-textbox" name="memo" id="memo" required="required"></td>
                        <td>Deposit to</td>
                        <td>
                            <select class="easyui-combobox" name="deposite_to" id="deposite_to" style="width: 150px;">
                                <option value="">-- Please Select --</option>
                                <option value="Sonali Bank Ltd">Sonali Bank</option>
                                <option value="Premier Bank">Premier Bank</option>
                                <option value="Agrani Bank Ltd">Agrani Bank Ltd.</option>
                                <option value="Dutch Bangla Bank Ltd">Dutch Bangla Bank Ltd.</option>
                                <option value="Dhaka Bank Ltd">Dhaka Bank Ltd.</option>
                            </select>
                        </td>
                    </tr>

                    <tr><td><input type="hidden" name="status_memo" id="status_memo" value=""></td><td></td><td></td><td></td></tr>
                
                        </table><br>
                        <div id="individual_invoice" style=" min-height:200px; max-height:300px;overflow-y: scroll;">
                            <br>
                            <center>[Please select any one company to see the list of all Invoices]</center>
  
    </div>      
                        
                        <div data-options="region:'south',border:false" style="text-align:right;padding:5px 0 0;">
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-print" onclick="paymentPreview()">Print Preview</a>
                <a href="javascript:void(0)" class="easyui-linkbutton" id="multi_payment_save_btn" iconCls="icon-save" onclick="saveMiltiPayment()">Save</a>
                <a class="easyui-linkbutton" data-options="iconCls:'icon-cancel'" href="javascript:void(0)" onclick="cancel()" style="width:80px">Cancel</a>
            </div>
                              
                  
                 </form>

            </div>
            
         
        </div>
    </div>

    
    
    <script>
            
            $(function(){
            $('#cust_id').combogrid({
                panelWidth:600,
                url: 'customer_profile/get_customer_all.php',
                idField:'cust_id',
                textField:'name',
                fitColumns:true,
                editable: true,
                mode:'remote',
                columns:[[
                    {field:'cust_id',title:'Insertion ID',width:60},
                    {field:'cust_id_new',title:'Cust Id',width:120},
                    {field:'name',title:'Company Name',width:300},
                    {field:'ref_name',title:'Referance Name',width:150},
                    {field:'project_name',title:'project_name',align:'center',width:60},
                    {field:'district',title:'district', align:'center'}
                ]],
                onSelect:function(record){
                   //alert(record); //this is called whn user select the combobox
                  //do your stuff here///
                  var g = $('.cust_id').combogrid('grid');   // get datagrid object
                var r = g.datagrid('getSelected');  // get the selected row

                $('#cust_id_new').val(r.cust_id_new);
                $('#txtproject_name').append('<option value="'+r.project_name+'" selected="selected">'+r.project_name+'</option>');
                $('#txttype').append('<option value="'+r.type+'" selected="selected">'+r.type+'</option>');
                    
                 $('#ref_name').append('<option value="'+r.ref_id+'" selected="selected">'+r.ref_name+'</option>');
                        $('#district').combobox('setValue',r.district);
                        $('#upazila').combobox('setValue',r.upazila);
                        $('.name').val(r.name);
                        $('.contact_person').textbox('setValue',r.contact_person);
                        $('#phone').textbox('setValue',r.phone);
                        $('#email').textbox('setValue',r.email);
                var cust_id = r.cust_id;
                // load invoice for this customer
                      $.ajax({
                            url:'payment/get_all_indi_invoice.php?q='+cust_id,
                            success: function(data){
                            $('#individual_invoice').html(data);
                            }
                        }); // End loading invoice for this customer
                        $('#receive_amount_multi').focus();
                        
                        
            },
            onChange:function(value){
               var gettext = value;
               $('.name').val(gettext); // For new customer name writting
                var dt = new Date();
                var time = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();

                                 var str = "", abbr = "";
                str = value;
                str = str.split(' ');
                var length = str.length - 1;
                for (i = 0; i < str.length; i++) {
                    //abbr = str[i].substr(0,1);
                    abbr = str[0].substr(0,1) + str[length].substr(0,1); // this will take first character of first word and last word
                 $('#cust_id_new').val(abbr+'-'+dt.getFullYear().toString().substr(2,2)+dt.getMonth()+dt.getMinutes()+dt.getSeconds());
                    // automatically create customer ID new after writting Company Name
                }

            }

            });

            $("input[name='mode']").change(function(){
                var mode = $(this).val();
                $('#cg').combogrid({
                    mode: mode
                });
            });
                        
      // ------------------------- //                 
                     
         
                     
        });
        
        function cancel(){
            $('#w').window('close');
            $('#individual_invoice').html('');
        }
        
            var url_multi_payment='payment/save_multi_payment.php';
        function saveMiltiPayment() {
        $('#receive_multi_payment_form').form('submit', {
            url: url_multi_payment,
            onSubmit: function () {
                return $(this).form('validate');
            },
            success: function (result) {
                var result = eval('(' + result + ')');
                if (result.errorMsg) {
                    $.messager.show({
                        title: 'Error',
                        msg: result.errorMsg,
                        showType: 'show'
                    });
                } else {
                    $('#w').window('close');		// close the dialog
                    $.messager.show({
                        title: 'Info',
                        msg: 'Transaction saved successfully.',
                        showType: 'show'
                    });

                }
            }
        });

    }
    

 
        
            
    </script>