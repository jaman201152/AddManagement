<?php
    include '../conn.php';
        $query_invoice_num=$con->prepare("Select * from tbl_invoice order by invoice_id DESC limit 1 ");
        $query_invoice_num->execute();
        if($query_invoice_num!=0){
            while($row=$query_invoice_num->fetch(PDO::FETCH_ASSOC)){
                    extract($row);
                    $invoice_num1=$invoice_id+1;
                }
            }
            ?>
<input class="easyui-textbox"  name="invoice_num" id="invoice_num" required="required" value="<?php echo $invoice_num1;?>"  readonly="readonly">
                        