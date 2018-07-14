<?php
include '../conn.php';
$id = intval($_REQUEST['id']);
$name = htmlspecialchars($_REQUEST['name']);
$address = htmlspecialchars($_REQUEST['address']);
$type = htmlspecialchars($_REQUEST['type']);
$project_name = htmlspecialchars($_REQUEST['project_name']);
$ref_name=htmlspecialchars($_REQUEST['ref_name']);
$date=  htmlspecialchars($_REQUEST['join_date']);
$division = htmlspecialchars($_REQUEST['division']);
$district = htmlspecialchars($_REQUEST['district']);
$upazila=htmlspecialchars($_REQUEST['upazila']);
$phone=  htmlspecialchars($_REQUEST['phone']);
$email = htmlspecialchars($_REQUEST['email']);
$fax=htmlspecialchars($_REQUEST['fax']);
$website=  htmlspecialchars($_REQUEST['website']);

date_default_timezone_set('asia/Dhaka'); // set default time zone;
$date_formate=new DateTime($date);
$date_t=$date_formate->format('Y-m-d');


$sql = $con->prepare("update tbl_customer set name=:name,"
        . "address=:address,"
        . "type=:type,"
        . "project_name=:project_name,"
        . "ref_name=:ref_name,"
        . "join_date=:join_date,"
        . "division=:division,"
        . "district=:district,"
        . "upazila=:upazila,"
        . "phone=:phone,"
        . "email=:email,"
        . "fax=:fax,"
        . "website=:website "
        . " where cust_id=:id ");


$sql->bindParam(':id',$id);
$sql->bindParam(':name',$name);
$sql->bindParam(':address',$address);
$sql->bindParam(':type',$type);
$sql->bindParam(':project_name',$project_name);
$sql->bindParam(':ref_name',$ref_name);
$sql->bindParam(':join_date',$date_t);
$sql->bindParam(':division',$division);
$sql->bindParam(':district',$district);
$sql->bindParam(':upazila',$upazila);
$sql->bindParam(':phone',$phone);
$sql->bindParam(':email',$email);
$sql->bindParam(':fax',$fax);
$sql->bindParam(':website',$website);

if ($sql->execute()){
	echo json_encode(array(
		'cust_id' => $id,
		'name' => $name,
		'address' => $address,
		'type' => $type,
		'project_name' => $project_name,
                'ref_name' => $ref_name,
                'join_date' =>$date_t,
		'division' => $division,
		'district' => $district,
		'upazila' => $upazila,
		'phone' => $phone,
                'email' => $email,
                'fax' =>$fax,
                'website' =>$website
	));
}
else {
	echo json_encode(array('errorMsg'=>'Some errors occured.'));
}
