<?php
include 'conn.php';



$rs = $con->prepare("select * from tbl_customer group by name ");
$rs->execute();
$rows = array();
while($row =$rs->fetch(PDO::FETCH_ASSOC)){
	$rows[] = $row;
}
echo json_encode($rows);


