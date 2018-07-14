<?php
include 'conn.php';
$query=$con->prepare("Select * from users");
$query->execute();
while($row=$query->fetch(PDO::FETCH_ASSOC)){
    extract($row);
    //echo $firstname;
}
?>
<center>
    <div class="easyui-panel" title="Register" style="width:400px;padding:30px 60px">
        <div style="margin-bottom:20px">
            <div class="test">Email:</div>
            <input class="easyui-textbox" data-options="prompt:'Enter a email address...',validType:'email'" style="width:100%;height:32px">
        </div>
        <div style="margin-bottom:20px">
            <div>First Name:</div>
            <input class="easyui-textbox" style="width:100%;height:32px">
        </div>
        <div style="margin-bottom:20px">
            <div>Last Name:</div>
            <input class="easyui-textbox" style="width:100%;height:32px">
        </div>
        <div style="margin-bottom:20px">
            <div>Company:</div>
            <input class="easyui-textbox" style="width:100%;height:32px">
        </div>
        
        <div>
            <a href="#" class="easyui-linkbutton" iconCls="icon-ok" style="width:100%;height:32px">Register</a>
        </div>
    </div>
</center>
<script>
    
    $(document).ready(function(){
        
            //$.messager.alert('Congratulation!','Wellcome to our Software.','Information'); 
            
    });
    
   
</script>


