<?php

 include_once '../conn.php';
 $email_post = $_POST['email'];
 $password_post = $_POST['pwd'];

 $query = $con->prepare("SELECT * FROM user WHERE email = '$email_post' AND password = '$password_post'");
 $query->execute();
 while($row=$query->fetch(PDO::FETCH_ASSOC)){
     extract($row);
 }
 $num_row = $query->rowCount();

 if( $num_row > 0 ) {
      session_start();
  echo 'true';
  $_SESSION['s_email']=$email_post;
  $_SESSION['s_pwd'] = $password_post;

 }
 else{
 echo 'false';
 }
