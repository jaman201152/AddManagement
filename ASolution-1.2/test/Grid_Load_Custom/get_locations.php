<?php

include 'conn.php';

//$wg_id ='1';
if (isset($_REQUEST['wg_id'])) {
    $wg_id = $_REQUEST['wg_id'];
    $q = $con->prepare("select * from tbl_order where cust_id = :wg_id");
$q->bindValue(':wg_id', $wg_id);
$q->execute();

$result = $q->fetchAll();
echo json_encode($result);
}

else{
$q = $con->prepare("select * from tbl_order ");
//$q->bindValue(':wg_id', $wg_id);
$q->execute();

$result = $q->fetchAll();
echo json_encode($result);
}