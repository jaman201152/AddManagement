<?php

include '../conn.php';
try{
$id = intval($_REQUEST['id']);
$sql = $con->prepare("delete from tbl_order where order_id=? ");
$sql->bindParam(1,$id);

$sql_tbl_invoice = $con->prepare("delete from tbl_invoice where order_id=? ");
$sql_tbl_invoice->bindParam(1,$id);

$sql_tbl_ememo = $con->prepare("delete from tbl_ememo where order_id=? ");
$sql_tbl_ememo->bindParam(1,$id);

$sql_tbl_payment = $con->prepare("delete from tbl_payment where order_id=? ");
$sql_tbl_payment->bindParam(1,$id);

if ($sql->execute() && $sql_tbl_invoice->execute() && $sql_tbl_ememo->execute() && $sql_tbl_payment->execute() ){
	echo json_encode(array('success'=>true));
} 
else {
	echo json_encode(array('errorMsg'=>'Some errors occured.'));
}

}

catch(PDOException $exception){
    echo "Error: " . $exception->getMessage();
}
