<?php

$name = htmlspecialchars($_REQUEST['name']);
$cust_id_new = htmlspecialchars($_REQUEST['cust_id_new']);
$address = htmlspecialchars($_REQUEST['address']);
$type = htmlspecialchars($_REQUEST['type']);
$project_name = htmlspecialchars($_REQUEST['project_name']);
$ref_id=htmlspecialchars($_REQUEST['ref_id']);
$date=  htmlspecialchars($_REQUEST['join_date']);
$division = htmlspecialchars($_REQUEST['division']);
$district = htmlspecialchars($_REQUEST['district']);
$upazila=htmlspecialchars($_REQUEST['upazila']);
$contact_person=htmlspecialchars($_REQUEST['contact_person']);
$phone=  htmlspecialchars($_REQUEST['phone']);
$email = htmlspecialchars($_REQUEST['email']);
$fax=htmlspecialchars($_REQUEST['fax']);
$website=  htmlspecialchars($_REQUEST['website']);

date_default_timezone_set('asia/Dhaka'); // set default time zone;
$date_formate=new DateTime($date);
$date_t=$date_formate->format('Y-m-d');


include '../conn.php';

    $query_cust_name=$con->prepare("Select name from tbl_customer where name='$name' ");
    $query_cust_name->execute();
    $cust_num=$query_cust_name->rowCount();

   if($cust_num===0){
$sql = $con->prepare("insert into tbl_customer set name =?, cust_id_new =?, "
        . "address=?,"
        . "type=?,"
        . "project_name=?,"
        . "ref_id=?,"
        . "join_date=?, division=?, district=?, upazila=?, contact_person=?, phone=?,"
        . " email=?, fax=?, website=? ");

$sql->bindParam(1,$name);
$sql->bindParam(2,$cust_id_new);
$sql->bindParam(3,$address);
$sql->bindParam(4,$type);
$sql->bindParam(5,$project_name);
$sql->bindParam(6,$ref_id);
$sql->bindParam(7,$date_t);
$sql->bindParam(8,$division);
$sql->bindParam(9,$district);
$sql->bindParam(10,$upazila);
$sql->bindParam(11,$contact_person);
$sql->bindParam(12,$phone);
$sql->bindParam(13,$email);
$sql->bindParam(14,$fax);
$sql->bindParam(15,$website);

if ($sql->execute()){
    $c = $con->lastInsertId();
	echo json_encode(array(
		 'cust_id' =>$c,
		'name' => $name,
        'cust_id_new' =>$cust_id_new,
		'address' => $address,
		'type' => $type,
		'project_name' => $project_name,
                'ref_id' => $ref_id,
                'join_date' => $date_t,
		'division' => $division,
		'district' => $district,
		'upazila' => $upazila,
                'contact_person' => $contact_person,
		'phone' => $phone,
                'email' => $email,
                'fax' => $fax,
                'website' => $website
	));
}

}  // if $num condition End.

else {
	echo json_encode(array('errorMsg'=>'Duplicate Customer does not allowed.'));
}
