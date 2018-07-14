<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Invoice And Billing System</title>
    <link rel="stylesheet" type="text/css" href="themes/metro/easyui.css">
    <link rel="stylesheet" type="text/css" href="themes/mobile.css">
    <link rel="stylesheet" type="text/css" href="themes/icon.css">
    <script type="text/javascript" src="jquery.min.js"></script>
    <script type="text/javascript" src="jquery.easyui.min.js"></script>
    <script type="text/javascript" src="jquery.easyui.mobile.js"></script>
</head>
<body>

 <div class="easyui-navpanel" style="position:relative">
        <header>
            <div class="m-toolbar">
                <div class="m-title">Order, Invoice And Billing System</div>
            </div>
        </header>
        <footer>
        <center><p>Copyright@ 2014 - 2017</p></center>
           <!-- <div class="m-buttongroup m-buttongroup-justified" style="width:100%">
                <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-large-picture',size:'large',iconAlign:'top',plain:true">Picture</a>
                <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-large-clipart',size:'large',iconAlign:'top',plain:true">Clip Art</a>
                <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-large-shapes',size:'large',iconAlign:'top',plain:true">Shapes</a>
                <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-large-smartart',size:'large',iconAlign:'top',plain:true">SmartArt</a>
            </div>
            -->
        </footer>
        <div style="text-align:center;margin:50px 30px">
            <a href="javascript:void(0)" class="easyui-linkbutton" data-options="plain:true,outline:true" style="width:80px;height:30px" onclick="$('#dlg1').dialog('open').dialog('center')">Login</a>
        </div>
 
        <div id="dlg1" class="easyui-dialog" style="padding:20px 6px;width:80%;" data-options="inline:true,modal:true,closed:true,title:'Login'">
            <div style="margin-bottom:10px">
                <input class="easyui-textbox" id="login_email" data-options="prompt:'Type Email address',iconCls:'icon-man'" style="width:100%;height:30px">
            </div>
            <div>
                <input class="easyui-passwordbox" id="login_password" type="password" data-options="prompt:'Type password'" style="width:100%;height:30px">
            </div>
            <div class="dialog-button">
            <div class="err" id="add_err"></div><br/>
                <a href="javascript:void(0)" id="login_submit" class="easyui-linkbutton" style="width:100%;height:35px" >Sign in</a>
            </div>
        </div>
    </div>
    

<script>
// ******************* start login system
 $("#login_submit").click(function(){


    $('#login_email').textbox('textbox').attr('autocomplete', 'on');


  email=$("#login_email").val();
  password=$("#login_password").val();
  
  $.ajax({
   type: "POST",
   url: "../admin_pages/login.php",
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
    $("#add_err").html("Loading...");
   }
  });
  return false;
 });
 //**************

</script>



</body>
</html>