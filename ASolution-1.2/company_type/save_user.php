<?php

$type_name = htmlspecialchars($_REQUEST['company_type_name']);
$type_status = htmlspecialchars($_REQUEST['company_type_status']);


//$type = htmlspecialchars($_REQUEST['type']);
//$project_name = htmlspecialchars($_REQUEST['project_name']);
//$ref_name=htmlspecialchars($_REQUEST['ref_name']);
//$date=  htmlspecialchars($_REQUEST['join_date']);
//$division = htmlspecialchars($_REQUEST['division']);
//$district = htmlspecialchars($_REQUEST['district']);
//$upazila=htmlspecialchars($_REQUEST['upazila']);
//$phone=  htmlspecialchars($_REQUEST['phone']);
//$email = htmlspecialchars($_REQUEST['email']);
//$fax=htmlspecialchars($_REQUEST['fax']);
//$website=  htmlspecialchars($_REQUEST['website']);
//


include '../conn.php';

$type_sql = $con->prepare("Select company_type_name from company_type_tbl"
        . " where company_type_name = '$type_name'    ");
$type_sql->execute();
$type_num = $type_sql->rowCount();

if($type_num===0){
$sql = $con->prepare("insert into company_type_tbl set company_type_name =?,"
        . " company_type_status=? ");

$sql->bindParam(1,$type_name);
$sql->bindParam(2,$type_status);
}

if ($sql->execute()){
    $c = $con->lastInsertId();
	echo json_encode(array(
		'companytypeid' =>$c,
		'company_type_name' => $type_name,
		'company_type_status' => $type_status
	));
}
else {
	echo json_encode(array('errorMsg'=>'Some errors occured.'));
}
