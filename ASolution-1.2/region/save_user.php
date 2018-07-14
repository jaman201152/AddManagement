<?php

$division = htmlspecialchars($_REQUEST['division']);
$district = htmlspecialchars($_REQUEST['district']);
$thana = htmlspecialchars($_REQUEST['city']);


include '../conn.php';

$sql_query=$con->prepare("Select city from city where city='$thana' ");
$sql_query->execute();
$num=$sql_query->rowCount();

if($num===0){

$sql=$con->prepare("Insert into city set countryid=?, stateid=?, city=? ");

$sql->bindParam(1,$division);
$sql->bindParam(2,$district);
$sql->bindParam(3,$thana);


if ($sql->execute()){
      $c = $con->lastInsertId();
	echo json_encode(array(
		'id' => $c,
		'countryid' => $division,
		'stateid' => $district,
		'city' => $thana
	));
}

} // if $num end

else {
	echo json_encode(array('errorMsg'=>'Duplicate thana not allowed.'));
}
?>
