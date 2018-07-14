<?php

$current_pass = htmlspecialchars($_REQUEST['txt_current_pwd']);
$new_passwordg = htmlspecialchars($_REQUEST['new_pwd']);
$emailg = htmlspecialchars($_REQUEST['txtemail']);



//date_default_timezone_set('asia/Dhaka'); // set default time zone;
//$date_formate=new DateTime($date);
//$date_t=$date_formate->format('Y-m-d H:i:s');


include '../conn.php';

    $query_cust_name=$con->prepare("Select * from user where email='$emailg' and password = '$current_pass' ");
    $query_cust_name->execute();
    $user_num=$query_cust_name->rowCount();

   if($user_num!=0){
$sql = $con->prepare(" update user set password=:new_password  where email=:emailg " );

$sql->bindParam(':emailg',$emailg);
$sql->bindParam(':new_password',$new_passwordg);




if ($sql->execute()){
	echo json_encode(array(
		'srno' => mysql_insert_id(),
                'password' => $new_passwordg
		
		
               
	));
}

}  // if $num condition End.

else {
	echo json_encode(array('errorMsg'=>'Password do not changed.'));
}
