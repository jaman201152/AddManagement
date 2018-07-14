<?php
// Session has already start in top menu page.


?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        // put your code here
        
        ?><center>
        <br/><br/>
              <div id="dlg_pass_change" class="easyui-panel" closed="false" title="Change Password?" data-options="footer:'#pass_change_footer' " style="width:500px;height:350px; padding:20px 20px;">
                  <form style="padding:10px 20px 10px 40px;" id="form_pass_change" name="form_pass_change" method="POST">
         <div style="margin-bottom:20px">
            <div>Type Current Password:</div>
            <input type="txt_current_pwd" name="txt_current_pwd" class="easyui-textbox" data-options="" style="width:100%;height:32px">
            <input type="hidden" name="txtemail" value="<?php echo $_SESSION['s_email']; ?>"/>
        </div>
        <div style="margin-bottom: 20px;">
            <div>New Password:</div>
            <input id="new_pwd" name="new_pwd" type="password" class="easyui-validatebox" style="width:100%;height:32px">
        </div>
        <div style="margin-bottom: 20px;">
            <div>Re-type New Password:</div>
            <input id="new_rpwd" name="new_rpwd" type="password" class="easyui-validatebox"  validType="equals['#new_pwd']" style="width:100%;height:32px">
        </div>
        
        
    </form>
</div>
             
        
        <div id="pass_change_footer" style="padding-left: 100px; text-align: right;">
            <a href="#" class="easyui-linkbutton" iconCls="icon-ok" style="width:200px; height:32px; " onclick="PassChange()">Password Change Confirm</a>
        </div>
        </center>
        <script>
            function PassChange(){
                $('#dlg_pass_change').dialog('open');
            }
            
            // extend the 'equals' rule
$.extend($.fn.validatebox.defaults.rules, {
    equals: {
        validator: function(value,param){
            return value == $(param[0]).val();
        },
        message: 'Field do not match.'
    }
});

        function PassChange(){
			$('#form_pass_change').form('submit',{
				url: 'admin_pages/pass_change.php',
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(result){
					var result = eval('('+result+')');
					if (result.errorMsg){
						$.messager.show({
							title: 'Error',
							msg: result.errorMsg
						});
					} else {
						$('#dlg_pass_change').dialog('close');		// close the dialog
						//$('#dg').datagrid('reload');	// reload the user data
                                                $.messager.alert('Message',"Password Changed Successfull",'Info');
					}
				}
			});
		}
        </script>
    </body>
</html>
