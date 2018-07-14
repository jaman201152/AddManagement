<?php

$ref_name = htmlspecialchars($_REQUEST['ref_name']);
$ref_address = htmlspecialchars($_REQUEST['ref_address']);
$ref_division = htmlspecialchars($_REQUEST['ref_division']);
$ref_district = htmlspecialchars($_REQUEST['district']);
$ref_upazila = htmlspecialchars($_REQUEST['upazila']);
$ref_phone = htmlspecialchars($_REQUEST['ref_phone']);
$ref_email = htmlspecialchars($_REQUEST['ref_email']);

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
$date = date("Y-m-d");
date_default_timezone_set('asia/Dhaka'); // set default time zone;
$date_formate=new DateTime($date);
$ref_created_at=$date_formate->format('Y-m-d');


include '../conn.php';

$sql = $con->prepare("insert into tbl_reference set ref_name =?,"
        . "ref_address=?, ref_division=?, ref_district=?, ref_upazila=?, ref_phone=?, ref_email=?, ref_created_at=?, ref_updated_at=? ");

$sql->bindParam(1,$ref_name);
$sql->bindParam(2,$ref_address);
$sql->bindParam(3,$ref_division);
$sql->bindParam(4,$ref_district);
$sql->bindParam(5,$ref_upazila);
$sql->bindParam(6,$ref_phone);
$sql->bindParam(7,$ref_email);
$sql->bindParam(8,$ref_created_at);
$sql->bindParam(9,$ref_updated_at);



if ($sql->execute()){
    $c = $con->lastInsertId();
	echo json_encode(array(
		'ref_id' =>$c,
		'ref_name' => $ref_name,
		'ref_address' => $ref_address,
		'ref_division' => $ref_division,
		'ref_district' => $ref_district,
		'ref_upazila' => $ref_upazila,
                'ref_phone' => $ref_phone,
                'ref_email' => $ref_email,
                'ref_created_at' => $ref_created_at,
                'ref_updated_at' => $ref_updated_at
	));
}
else {
	echo json_encode(array('errorMsg'=>'Some errors occured.'));
}
