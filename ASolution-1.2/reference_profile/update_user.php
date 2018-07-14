<?php
include '../conn.php';
$id = intval($_REQUEST['id']);



$ref_name = htmlspecialchars($_REQUEST['ref_name']);
$ref_address = htmlspecialchars($_REQUEST['ref_address']);
$ref_division = htmlspecialchars($_REQUEST['ref_division']);
$ref_district = htmlspecialchars($_REQUEST['district']);
$ref_upazila = htmlspecialchars($_REQUEST['upazila']);
$ref_phone = htmlspecialchars($_REQUEST['ref_phone']);
$ref_email = htmlspecialchars($_REQUEST['ref_email']);


$date = date("Y-m-d");
date_default_timezone_set('asia/Dhaka'); // set default time zone;
$date_formate=new DateTime($date);
$ref_updated_at=$date_formate->format('Y-m-d');


$sql = $con->prepare("update tbl_reference set ref_name=:name,"
        . "ref_address=:address,"
        . "ref_division=:division,"
        . "ref_district=:district,"
        . "ref_upazila=:upazila,"
        . "ref_phone=:phone,"
        . "ref_email=:email,"
        . "ref_updated_at=:updated_at"
        . " where ref_id=:id ");

$sql->bindParam(':id',$id);
$sql->bindParam(':name',$ref_name);
$sql->bindParam(':address',$ref_address);
$sql->bindParam(':division',$ref_division);
$sql->bindParam(':district',$ref_district);
$sql->bindParam(':upazila',$ref_upazila);
$sql->bindParam(':phone',$ref_phone);
$sql->bindParam(':email',$ref_email);
$sql->bindParam(':updated_at',$ref_updated_at);

if ($sql->execute()){
	echo json_encode(array(
		'ref_id' => $id,
		'ref_name' => $ref_name,
		'ref_address' => $ref_address,
		'ref_division' => $ref_division,
		'ref_district' => $ref_district,
		'ref_upazila' => $ref_upazila,
		'ref_phone' => $ref_phone,
                'ref_email' => $ref_email,
                'ref_updated_at' =>$ref_updated_at
	));
}
else {
	echo json_encode(array('errorMsg'=>'Some errors occured.'));
}
