<?php

$id = intval($_REQUEST['id']);
$divisionid = htmlspecialchars($_REQUEST['division']);
$districtid = htmlspecialchars($_REQUEST['district']);
$cityname = htmlspecialchars($_REQUEST['city']);

include '../conn.php';

    $query_subdis_name=$con->prepare("Select city from city where city='$cityname' ");
    $query_subdis_name->execute();
    $subdis_num=$query_subdis_name->rowCount();
    

$sql = $con->prepare("update city set city=:cityname,stateid=:districtid,"
        . " countryid=:divisionid where id=:id ");
$sql->bindParam(':id',$id);
$sql->bindParam(':divisionid',$divisionid);
$sql->bindParam(':districtid',$districtid);
$sql->bindParam(':cityname',$cityname);

if ($sql->execute()){
	echo json_encode(array(
		'id' => $id,
		'city' => $cityname,
		'stateid' => $districtid,
		'countryid' => $divisionid
	));
}


else {
	echo json_encode(array('errorMsg'=>'Duplicate thana not allowed.'));
}
?>
