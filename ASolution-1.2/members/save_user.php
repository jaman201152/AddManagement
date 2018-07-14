<?php

$firstname = htmlspecialchars($_REQUEST['firstname']);
$lastname = htmlspecialchars($_REQUEST['lastname']);
$phone = htmlspecialchars($_REQUEST['phone']);
$email = htmlspecialchars($_REQUEST['email']);
$present_add=htmlspecialchars($_REQUEST['presentadd']);
$permanent_add=  htmlspecialchars($_REQUEST['permanentadd']);
        
include 'conn.php';

$sql = $con->prepare("insert into users set firstname =?,"
        . "lastname=?,"
        . "phone=?,"
        . "email=?,"
        . "presentadd=?,"
        . "permanentadd=? ");
$sql->bindParam(1,$firstname);
$sql->bindParam(2,$lastname);
$sql->bindParam(3,$phone);
$sql->bindParam(4,$email);
$sql->bindParam(5,$present_add);
$sql->bindParam(6,$permanent_add);
if ($sql->execute()){
	echo json_encode(array(
		'id' => mysql_insert_id(),
		'firstname' => $firstname,
		'lastname' => $lastname,
		'phone' => $phone,
		'email' => $email,
                'presentadd' => $permanent_add,
                'permanentadd' =>$permanent_add
	));
}
else {
	echo json_encode(array('errorMsg'=>'Some errors occured.'));
}
