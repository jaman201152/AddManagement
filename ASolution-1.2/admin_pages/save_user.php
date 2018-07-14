<?php

$usernameg = htmlspecialchars($_REQUEST['txtusername']);
$passwordg = htmlspecialchars($_REQUEST['pwd']);
$emailg = htmlspecialchars($_REQUEST['txtemail']);



//date_default_timezone_set('asia/Dhaka'); // set default time zone;
//$date_formate=new DateTime($date);
//$date_t=$date_formate->format('Y-m-d H:i:s');


include '../conn.php';

    $query_cust_name=$con->prepare("Select * from user where username='$usernameg' and email='$emailg' ");
    $query_cust_name->execute();
    $user_num=$query_cust_name->rowCount();

   if($user_num===0){
$sql = $con->prepare("insert into user set username =?, password=?, email=? " );

$sql->bindParam(1,$usernameg);
$sql->bindParam(2,$passwordg);
$sql->bindParam(3,$emailg);


if ($sql->execute()){
	echo json_encode(array(
		'srno' => mysql_insert_id(),
                'username' => $usernameg,
                'password' => $passwordg,
		'email' => $emailg
		
               
	));
}

}  // if $num condition End.

else {
	echo json_encode(array('errorMsg'=>'This username or email is not available.'));
}
