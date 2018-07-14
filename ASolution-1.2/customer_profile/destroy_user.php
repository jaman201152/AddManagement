<?php

include '../conn.php';
try{
$id = intval($_REQUEST['id']);
$sql = $con->prepare("delete from tbl_customer where cust_id=? ");
$sql->bindParam(1,$id);

$sql_order = $con->prepare("delete from tbl_order where cust_id=? ");
$sql_order->bindParam(1,$id);

$sql_invoice = $con->prepare("delete from tbl_invoice where cust_id=? ");
$sql_invoice->bindParam(1,$id);


$sql_payment = $con->prepare("delete from tbl_payment where cust_id=? ");
$sql_payment->bindParam(1,$id);

$sql_ememo = $con->prepare("delete from tbl_ememo where cust_id=? ");
$sql_ememo->bindParam(1,$id);

if ($sql->execute() && $sql_order->execute() && $sql_invoice->execute() && $sql_payment->execute() && $sql_ememo->execute() ) {
	echo json_encode(array('success'=>true));
} 
else {
	echo json_encode(array('errorMsg'=>'Some errors occured.'));
}

}

catch(PDOException $exception){
    echo "Error: " . $exception->getMessage();
}
