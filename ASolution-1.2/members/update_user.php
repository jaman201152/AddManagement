<?php
include 'conn.php';
$id = intval($_REQUEST['id']);
$firstname = htmlspecialchars($_REQUEST['firstname']);
$lastname = htmlspecialchars($_REQUEST['lastname']);
$phone = htmlspecialchars($_REQUEST['phone']);
$email = htmlspecialchars($_REQUEST['email']);
$present_add=htmlspecialchars($_REQUEST['presentadd']);
$permanent_add=htmlspecialchars($_REQUEST['permanentadd']);


$sql = $con->prepare("update users set firstname=:firstname,"
        . "lastname=:lastname,"
        . "phone=:phone,"
        . "email=:email,"
        . "presentadd=:preaddress,"
        . "permanentadd=:peraddress where id=:id ");


$sql->bindParam(':id',$id);

$sql->bindParam(':firstname',$firstname);
$sql->bindParam(':lastname',$lastname);
$sql->bindParam(':phone',$phone);
$sql->bindParam(':email',$email);
$sql->bindParam(':preaddress',$present_add);
$sql->bindParam(':peraddress',$permanent_add);

if ($sql->execute()){
	echo json_encode(array(
		'id' => $id,
		'firstname' => $firstname,
		'lastname' => $lastname,
		'phone' => $phone,
		'email' => $email,
                'presentadd' => $present_add,
                'permanentadd' =>$permanent_add
	));
}
else {
	echo json_encode(array('errorMsg'=>'Some errors occured.'));
}
