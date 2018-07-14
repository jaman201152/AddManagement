<?php

$cust_id = htmlspecialchars($_REQUEST['cust_id']);
$cust_id_new = htmlspecialchars($_REQUEST['cust_id_new']);
$date=  htmlspecialchars($_REQUEST['order_date']);
$type = htmlspecialchars($_REQUEST['type']);
$project_name = htmlspecialchars($_REQUEST['project_name']);
$ref_id=htmlspecialchars($_REQUEST['ref_id']);

$work_order_no = htmlspecialchars($_REQUEST['work_order_no']);

$item = htmlspecialchars($_REQUEST['item']);
$description= htmlspecialchars($_REQUEST['description']);
$row = htmlspecialchars($_REQUEST['o_row']);
$column = htmlspecialchars($_REQUEST['o_column']);
$qty = htmlspecialchars($_REQUEST['qty']);
$unit_price=htmlspecialchars($_REQUEST['unit_price']);
$price=  htmlspecialchars($_REQUEST['price']);
$front_page = floatval($_REQUEST['front_page']);
$back_page = floatval($_REQUEST['back_page']);
$color = floatval($_REQUEST['color']);
$discount = htmlspecialchars($_REQUEST['discount']);
$discount_amount = htmlspecialchars($_REQUEST['discount_amount']);
$payable_amount = htmlspecialchars($_REQUEST['payable_amount']);
$vat = intval($_REQUEST['vat']);
$tax = intval($_REQUEST['tax']);
$status = '0';
date_default_timezone_set('asia/Dhaka'); // set default time zone;
$date_formate=new DateTime($date);
$date_t=$date_formate->format('Y-m-d');


// For Customer Table field

$name = htmlspecialchars($_REQUEST['name']);
$address = htmlspecialchars($_REQUEST['address']);
$division = htmlspecialchars($_REQUEST['division']);
$district = htmlspecialchars($_REQUEST['district']);
$upazila=htmlspecialchars($_REQUEST['upazila']);
$contact_person=htmlspecialchars($_REQUEST['contact_person']);
$phone = htmlspecialchars($_REQUEST['phone']);
$email = htmlspecialchars($_REQUEST['email']);
$fax=htmlspecialchars($_REQUEST['fax']);
$website=  htmlspecialchars($_REQUEST['website']);
// end Customer Table field

include '../conn.php';

$customer_sql = $con->prepare("Select name from tbl_customer where name = '$name'    ");
$customer_sql->execute();
$cust_num = $customer_sql->rowCount();

$order_sql = $con->prepare("Select work_order_no from tbl_order where work_order_no = '$work_order_no'    ");
$order_sql->execute();
$order_num = $order_sql->rowCount();

 if($cust_num===0){
     //Customer Table Insert
$sql_cust_insert = $con->prepare("insert into tbl_customer set name =?, cust_id_new =?, "
        . "address=?,"
        . "type=?,"
        . "project_name=?,"
        . "ref_id=?,"
        . "join_date=?, division=?, district=?, upazila=?, contact_person=?, phone=?,"
        . " email=?, fax=?, website=? ");

$sql_cust_insert->bindParam(1,$name);
$sql_cust_insert->bindParam(2,$cust_id_new);
$sql_cust_insert->bindParam(3,$address);
$sql_cust_insert->bindParam(4,$type);
$sql_cust_insert->bindParam(5,$project_name);
$sql_cust_insert->bindParam(6,$ref_id);
$sql_cust_insert->bindParam(7,$date_t);
$sql_cust_insert->bindParam(8,$division);
$sql_cust_insert->bindParam(9,$district);
$sql_cust_insert->bindParam(10,$upazila);
$sql_cust_insert->bindParam(11,$contact_person);
$sql_cust_insert->bindParam(12,$phone);
$sql_cust_insert->bindParam(13,$email);
$sql_cust_insert->bindParam(14,$fax);
$sql_cust_insert->bindParam(15,$website);

$sql_cust_insert->execute(); // this will execute means data will inserted
// Order Table Start
$c = $con->lastInsertId(); // This code obtain last insert Id from database. It will get cust id from customer table
if($order_num===0){
$sql = $con->prepare("insert into tbl_order set cust_id =?, cust_id_new=?, "
          . "order_date=?,"
        . "type=?,"
        . "project_name=?,"
        . "ref_id=?,"
        . "work_order_no=?, item=?,"
        . " description=?, o_row=?, o_column=?, qty=?, unit_price=?, price=?,"
        . " front_page=?, back_page=?, color=?, "
        . " discount=?, discount_amount=?, payable_amount=?, vat=?, tax=?, status=?  ");

$sql->bindParam(1,$c);
$sql->bindParam(2,$cust_id_new);
$sql->bindParam(3,$date_t);
$sql->bindParam(4,$type);
$sql->bindParam(5,$project_name);
$sql->bindParam(6,$ref_id);
$sql->bindParam(7,$work_order_no);
$sql->bindParam(8,$item);
$sql->bindParam(9,$description);
$sql->bindParam(10,$row);
$sql->bindParam(11,$column);
$sql->bindParam(12,$qty);
$sql->bindParam(13,$unit_price);
$sql->bindParam(14,$price);
$sql->bindParam(15,$front_page);
$sql->bindParam(16,$back_page);
$sql->bindParam(17,$color);
$sql->bindParam(18,$discount);
$sql->bindParam(19,$discount_amount);
$sql->bindParam(20,$payable_amount);
$sql->bindParam(21,$vat);
$sql->bindParam(22,$tax);
$sql->bindParam(23,$status);

if ( $sql->execute() ){
    $c1 = $con->lastInsertId();
	echo json_encode(array(
		'cust_id' =>$c,
        'cust_id_new' =>$cust_id_new,
		'name' => $name,
		'address' => $address,
                'ref_id' => $ref_id,
                'join_date' => $date_t,
		'division' => $division,
		'district' => $district,
		'upazila' => $upazila,
                'contact_person' => $contact_person,
		'phone' => $phone,
                'email' => $email,
                'fax' => $fax,
                'website' => $website,
            'order_id' => $c1,
		'order_date' => $date_t,
                'type' => $type,
                'project_name' => $project_name,
		'work_order_no' => $work_order_no,
		'item' => $item,
                'description' => $description,
                'o_row' => $row,
                'o_column' => $column,
                'qty' => $qty,
                'unit_price' => $unit_price,
		'price' => $price,
                'front_page' => $front_page,
                'back_page' => $back_page,
                'color' => $color,
                'discount' => $discount,
                'discount_amount' => $discount_amount,
		'payable_amount' => $payable_amount,
                'vat' => $vat,
                'tax' => $tax,
                'status' => $status
	));
        
}
}
}  // if $cust_num condition End.

else {
	// echo json_encode(array('errorMsg'=>'Duplicate Customer does not allowed.'));
        if($order_num===0){
$sql_r = $con->prepare("insert into tbl_order set cust_id =?, cust_id_new=?, "
       . "order_date=?,"
        . "type=?,"
        . "project_name=?,"
        . "ref_id=?,"
        . "work_order_no=?, item=?,"
        . " description=?, o_row=?, o_column=?, qty=?, unit_price=?, price=?,"
        . " front_page=?, back_page=?, color=?, "
        . " discount=?, discount_amount=?, payable_amount=?, vat=?, tax=?, status=?  ");

$sql_r->bindParam(1,$cust_id);
$sql_r->bindParam(2,$cust_id_new);
$sql_r->bindParam(3,$date_t);
$sql_r->bindParam(4,$type);
$sql_r->bindParam(5,$project_name);
$sql_r->bindParam(6,$ref_id);
$sql_r->bindParam(7,$work_order_no);
$sql_r->bindParam(8,$item);
$sql_r->bindParam(9,$description);
$sql_r->bindParam(10,$row);
$sql_r->bindParam(11,$column);
$sql_r->bindParam(12,$qty);
$sql_r->bindParam(13,$unit_price);
$sql_r->bindParam(14,$price);
$sql_r->bindParam(15,$front_page);
$sql_r->bindParam(16,$back_page);
$sql_r->bindParam(17,$color);
$sql_r->bindParam(18,$discount);
$sql_r->bindParam(19,$discount_amount);
$sql_r->bindParam(20,$payable_amount);
$sql_r->bindParam(21,$vat);
$sql_r->bindParam(22,$tax);
$sql_r->bindParam(23,$status);

if ($sql_r->execute()){
    $c2 = $con->lastInsertId();
	echo json_encode(array(
		'order_id' => $c2,
		'cust_id' => $cust_id,
                'cust_id_new' => $cust_id_new,
		'order_date' => $date_t,
		'type' => $type,
		'project_name' => $project_name,
                'ref_id' => $ref_id,
		'work_order_no' => $work_order_no,
		'item' => $item,
                'description' => $description,
                'o_row' => $row,
                'o_column' => $column,
                'qty' => $qty,
                'unit_price' => $unit_price,
		'price' => $price,
                'front_page' => $front_page,
                'back_page' => $back_page,
                'color' => $color,
                'discount' => $discount,
                'discount_amount' => $discount_amount,
		'payable_amount' => $payable_amount,
                'vat' => $vat,
                'tax' => $tax,
                'status' => $status
	));
}

else {
	echo json_encode(array('errorMsg'=>'Some errors occured.'));
}
        } //  if condition end if work order no is exist

}


