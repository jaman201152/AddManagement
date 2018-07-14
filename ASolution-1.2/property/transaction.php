<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<table id="dg" class="easyui-datagrid" data-options=" 'title':'test','pagination':'true','showFooter':'true' " >
    <thead>
        <tr>
            <th field='t_id'>Id</th>
        </tr>
    </thead>
</table>

<script type="text/javascript">
    $('#dg').datagrid({
        url:'transaction/member_search.php'
    });
</script>


