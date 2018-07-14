    <div class="easyui-accordion" data-options="fit:true,border:false">
        <div title="Title1" style="padding:10px;" class="alert">
                        content1
        </div>
        <div title="Title2" data-options="selected:true" style="padding:10px;">
                        content2
        </div>
        <div title="Title3" style="padding:10px">
                        content3
        </div>
    </div>
<script>
$(document).ready(function(){
    $('.alert').click(function(){
         $.messager.alert("Message","Content1");
    });
   
});  
</script>