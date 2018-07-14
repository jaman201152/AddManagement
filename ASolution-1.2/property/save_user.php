<?php

$pno = htmlspecialchars($_REQUEST['property_no']);
$p_name = htmlspecialchars($_REQUEST['property_name']);
$p_type=htmlspecialchars($_REQUEST['property_type']);
$p_description = htmlspecialchars($_REQUEST['property_description']);
$original_amount = htmlspecialchars($_REQUEST['original_amount']);
$present_approximate_amount = htmlspecialchars($_REQUEST['present_approximate_amount']);
$date =htmlspecialchars($_REQUEST['entry_date']);


$date1= new DateTime($date);
$date2=$date1->format('Y-m-d');

include 'conn.php';

$sql = $con->prepare("insert into tbl_property set property_no =?,"
        . "property_name=?, property_type=?, property_description=?,"
        . " original_amount=?, present_approximate_amount=?,"
        . " entry_date=? ");

$sql->bindParam(1,$pno);
$sql->bindParam(2,$p_name);
$sql->bindParam(3,$p_type);
$sql->bindParam(4,$p_description);
$sql->bindParam(5,$original_amount);
$sql->bindParam(6,$present_approximate_amount);
$sql->bindParam(7,$date2);


if ($sql->execute()){
	echo json_encode(array(
		'property_id' => mysql_insert_id(),
		'property_no' => $pno,
		'property_name' => $p_name,
                'property_type' => $p_type,
                'property_description' => $p_description,
		'original_amount' => $original_amount,
                'present_approximate_amount' => $present_approximate_amount,
		'entry_date' => $date2
            
	));
}
else {
	echo json_encode(array('errorMsg'=>'Some errors occured.'));
}
