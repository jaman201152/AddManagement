<div class="easyui-accordion" data-options="fit:'true',border:'false' " style="height:400px;" title="History">
        <div title="Summery" style="padding:10px;" data-options="selected:true">
                        content1 <a href="#" class="easyui-linkbutton" onclick="allInvoices()">All invoices</a>
        </div>
        <div title="Recent Transactions"  style="padding:10px;">
                        content2
        </div>
        <div title="Notes" style="padding:10px">
                        content3
        </div>
</div>
<div class="easyui-dialog" data-options="title:'All Invoices of selected Clients.' " closed="true" id="dg-all-invoices" style="width: 80%; height: 80%;">
    <table class="easyui-datagrid" url="invoice/invoice_search.php">
        <th field="invoice_num"></th>
    </table>
</div>
<script>
$(document).ready(function(){
   
   
});  
function allInvoices(){
    $('#dg-all-invoices').dialog('open');
}
</script>