<?php

$q = isset($_POST['q']) ? strval($_POST['q']) : '';

include '../conn.php';

$rs = $con->prepare("select * from users where id like '%$q%' ");
$rs->execute();
$rows = array();
while($row =$rs->fetch(PDO::FETCH_ASSOC)){
	$rows[] = $row;
}
echo json_encode($rows);


