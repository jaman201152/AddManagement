
                <center>
                 <br/><br/><br/><br/><br/><br/><br/>
          <div class="easyui-panel" title="Welcome!" style="width:400px;padding:50px 40px" >
              
              <div id="dlg_register" class="easyui-dialog" buttons="#dlg-buttons" closed="true" style="width:500px; height:400px; padding:20px;" title="Register">
        
                  <form name="form_register" id="form_register" method="POST"  >
        <div style="margin-bottom:20px">
            <div>email address:</div>
            <input name="txtemail" class="easyui-textbox" data-options="prompt:'Enter a email address...',validType:'email'" style="width:100%;height:32px">
        </div>
        <div style="margin-bottom:20px">
            <div>User Name:</div>
            <input id="txtusername" name="txtusername" class="easyui-textbox" required="required" style="width:100%;height:32px">
        </div>
        <div style="margin-bottom: 20px;">
            <div>Password:</div>
            <input id="pwd" name="pwd" type="password" class="easyui-validatebox" required="required" style="width:100%;height:32px">
      
        </div>
        <div style="margin-bottom: 20px;">
            <div>Re-type Password:</div>
            <input id="rpwd" name="rpwd" type="password" class="easyui-validatebox"  validType="equals['#pwd']" style="width:100%;height:32px">
       
        </div>
             </form>
                  
           </div>
             
              
              <div id="dlg-buttons">
		<a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveUser()" style="width:90px">Submit</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg_register').dialog('close')" >Cancel</a>
	</div>
               <!-- Register Dialog End -->
        <div>
<!--            <a href="#" class="easyui-linkbutton" iconCls="icon-ok" style="width:100%;height:32px" onclick="dlg_register()">Register</a>
            <div style="text-align:center; ">Or</div>-->
            <a href="#" class="easyui-linkbutton" iconCls="icon-access_key" style="width:100%;height:32px" onclick="dlg_login()">Log In</a>
        </div>
        
            
              <div id="dlg_login" class="easyui-dialog" closed="true" title="Login" buttons="#dlg_buttons_login" style="width:500px;height:300px; padding:20px 20px;">
    <form style="padding:10px 20px 10px 40px;">
         <div style="margin-bottom:20px">
            <div>Email:</div>
            <input name="login_email" id="login_email" class="easyui-textbox login_email" data-options="prompt:'Enter a email address...',validType:'email'" style="width:100%;height:32px">
        </div>
        
         <div style="margin-bottom:20px">
            <div>Password:</div>
            <input name="login_password" id="login_password" type="password" class="easyui-textbox" style="width:100%;height:32px">
        </div>
        <div class="err" id="add_err"></div>
           <div id="dlg_buttons_login">
               <input type="submit" id="login_submit"   value="SignIn" style="padding:5px;" />
<!--            <a href="#" class="easyui-linkbutton" icon="icon-cancel" onclick="javascript:$('#dlg_login').dialog('close')">Cancel</a>-->
        </div>
    </form>
                  <div id ="profile"></div>
</div>
        
              <!-- Login Dialog End -->
    </div>
</center>
        <script>
            //$.messager.alert('Message','content','info');
            
                
                function dlg_register(){
                
                    $('#dlg_register').dialog('open');
                
                }
                
                 function dlg_login(){
                
                    $('#dlg_login').dialog('open');
                    $('.login_email').textbox('clear').textbox('textbox').focus();
                      // $('#login_email').focus();
                }
              
 // ******************* start login system
 $("#login_submit").click(function(){

  email=$("#login_email").val();
  password=$("#login_password").val();
  
  $.ajax({
   type: "POST",
   url: "admin_pages/login.php",
   data: "email="+email+"&pwd="+password,
   success: function(html){
    if(html==='true')
    {
       
        window.location="indexk.php";

    }
    else
    {
     $("#add_err").html("<san style='background:#FFECE8; border:1px red solid; padding:3px; color:#444;'>Invalid Email or password!</span>");
    }
   },
   beforeSend:function()
   {
    $("#add_err").html("Authenticating...");
   }
  });
  return false;
 });
 //**************
                
                            // extend the 'equals' rule
$.extend($.fn.validatebox.defaults.rules, {
    equals: {
        validator: function(value,param){
            return value == $(param[0]).val();
        },
        message: 'Field do not match.'
    }
});

                function saveUser(){
			$('#form_register').form('submit',{
				url: 'admin_pages/save_user.php',
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
						$('#dlg_register').dialog('close');		// close the dialog
						//$('#dg').datagrid('reload');	// reload the user data
                                                $('#dlg_login').dialog('open');
					}
				}
			});
		}
           
        </script>
