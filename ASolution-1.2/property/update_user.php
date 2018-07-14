<?php
include 'conn.php';
$id = intval($_REQUEST['id']);

$date =htmlspecialchars($_REQUEST['entry_date']);
$property_no = htmlspecialchars($_REQUEST['property_no']);
$property_type=  htmlspecialchars($_REQUEST['property_type']);
$pname = htmlspecialchars($_REQUEST['property_name']);
$pdes = htmlspecialchars($_REQUEST['property_description']);
$original_amount=  htmlspecialchars($_REQUEST['original_amount']);
$present_approximate_amount=  htmlspecialchars($_REQUEST['present_approximate_amount']);

$date1= new DateTime($date);
$date_f=$date1->format('Y-m-d');



$sql = $con->prepare("update tbl_property set entry_date=:entry_date, property_no=:property_no,"
        . " property_type=:property_type,  "
        . " property_name=:property_name,"
        . "property_description=:property_description, original_amount=:original_amount, "
        . " present_approximate_amount=:present_approximate_amount "
     . " where property_id=:id ");


$sql->bindParam(':id',$id);

$sql->bindParam(':entry_date',$date_f);
$sql->bindParam(':property_no',$property_no);
$sql->bindParam(':property_type',$property_type);
$sql->bindParam(':property_name',$pname);
$sql->bindParam(':property_description',$pdes);
$sql->bindParam(':original_amount',$original_amount);
$sql->bindParam(':present_approximate_amount',$present_approximate_amount);


if ($sql->execute()){
	echo json_encode(array(
		'property_id' => $id,
                'entry_date' => $date_f,
                'property_no' =>$property_no,
                'property_type' =>$property_type,
		'property_name' => $pname,
		'property_description' => $pdes,
		'original_amount' => $original_amount,
                'present_approximate_amount' => $present_approximate_amount
	));
}
else {
	echo json_encode(array('errorMsg'=>'Some errors occured.'));
}
