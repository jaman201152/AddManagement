<?php

include 'conn.php';
try{
$id = intval($_REQUEST['id']);
$sql = $con->prepare("delete from users where id=? ");

$sql->bindParam(1,$id);

if ($sql->execute()){
	echo json_encode(array('success'=>true));
} 
else {
	echo json_encode(array('errorMsg'=>'Some errors occured.'));
}

}

catch(PDOException $exception){
    echo "Error: " . $exception->getMessage();
}
