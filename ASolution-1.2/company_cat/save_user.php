<?php
$company_type_id = htmlspecialchars($_REQUEST['com_type']);
$cat_name = htmlspecialchars($_REQUEST['company_cat_name']);
$cat_status = htmlspecialchars($_REQUEST['company_cat_status']);


//$type = htmlspecialchars($_REQUEST['type']);
//$project_name = htmlspecialchars($_REQUEST['project_name']);
//$ref_name=htmlspecialchars($_REQUEST['ref_name']);
//$date=  htmlspecialchars($_REQUEST['join_date']);
//$division = htmlspecialchars($_REQUEST['division']);
//$district = htmlspecialchars($_REQUEST['district']);
//$upazila=htmlspecialchars($_REQUEST['upazila']);
//$phone=  htmlspecialchars($_REQUEST['phone']);
//$email = htmlspecialchars($_REQUEST['email']);
//$fax=htmlspecialchars($_REQUEST['fax']);
//$website=  htmlspecialchars($_REQUEST['website']);
//


include '../conn.php';

$type_sql = $con->prepare("Select company_cat_name from company_cat_tbl"
        . " where company_cat_name = '$cat_name' and companytypeid='$company_type_id'    ");
$type_sql->execute();
$type_num = $type_sql->rowCount();

if($type_num===0){
$sql = $con->prepare("insert into company_cat_tbl set companytypeid=?, company_cat_name =?,"
        . " company_cat_status=? ");

$sql->bindParam(1,$company_type_id);
$sql->bindParam(2,$cat_name);
$sql->bindParam(3,$cat_status);
}

if ($sql->execute()){
    $c = $con->lastInsertId();
	echo json_encode(array(
		'companycatid' =>$c,
            'companytypeid' =>$company_type_id,
		'company_cat_name' => $cat_name,
		'company_cat_status' => $cat_status
	));
}
else {
	echo json_encode(array('errorMsg'=>'Some errors occured.'));
}
