<?php

$id = intval($_REQUEST['id']);

include '../conn.php';

$sql = $con->prepare("delete from city where id=:id");

$sql->bindParam(':id',$id);


if ( $sql->execute() ){
	echo json_encode(array('success'=>true));
} else {
	echo json_encode(array('errorMsg'=>'Some errors occured.'));
}
