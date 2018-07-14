<?php

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


include '../conn.php';

    $query_cust_name=$con->prepare("Select * from tbl_customer where name='$name' ");
    $query_cust_name->execute();
    $cust_num=$query_cust_name->rowCount();

   if($cust_num==0){ 
$sql = $con->prepare("insert into tbl_customer set name =?,"
        . "address=?,"
        . "type=?,"
        . "project_name=?,"
        . "ref_name=?,"
        . "join_date=?, division=?, district=?, upazila=?, phone=?,"
        . " email=?, fax=?, website=? ");

$sql->bindParam(1,$name);
$sql->bindParam(2,$address);
$sql->bindParam(3,$type);
$sql->bindParam(4,$project_name);
$sql->bindParam(5,$ref_name);
$sql->bindParam(6,$date_t);
$sql->bindParam(7,$division);
$sql->bindParam(8,$district);
$sql->bindParam(9,$upazila);
$sql->bindParam(10,$phone);
$sql->bindParam(11,$email);
$sql->bindParam(12,$fax);
$sql->bindParam(13,$website);

if ($sql->execute()){
        $c = $con->lastInsertId();
	echo json_encode(array(
		'cust_id' => $c,
		'name' => $name,
		'address' => $address,
		'type' => $type,
		'project_name' => $project_name,
                'ref_name' => $ref_name,
                'join_date' => $date_t,
		'division' => $division,
		'district' => $district,
		'upazila' => $upazila,
		'phone' => $phone,
                'email' => $email,
                'fax' => $fax,
                'website' => $website
	));
}

}

else {
	echo json_encode(array('errorMsg'=>'Duplicate Customer does not excepted.'));
}
