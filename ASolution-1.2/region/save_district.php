<?php

$division = htmlspecialchars($_REQUEST['division']);
$district = htmlspecialchars($_REQUEST['district']);

include '../conn.php';

$sql_query=$con->prepare("Select * from state where statename='$district' ");
$sql_query->execute();
$num=$sql_query->rowCount();


$sql=$con->prepare("Insert into state set countryid=?, statename=?  ");
$sql->bindParam(1,$division);
$sql->bindParam(2,$district);

if($num==0){

if ($sql->execute()){
       $c = $con->lastInsertId();
	echo json_encode(array(
		'id' => $c,
		'countryid' => $division,
		'statename' => $district
		
		
	));
}

}

else {
	echo json_encode(array('errorMsg'=>'Duplicate District not allow.'));
}
?>
