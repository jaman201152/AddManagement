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
$qty = intval($_REQUEST['qty']);
$unit_price=floatval($_REQUEST['unit_price']);
$price=  floatval($_REQUEST['price']);
$front_page = floatval($_REQUEST['front_page']);
$back_page = floatval($_REQUEST['back_page']);
$color = floatval($_REQUEST['color']);
$discount = floatval($_REQUEST['discount']);
$discount_amount = floatval($_REQUEST['discount_amount']);
$payable_amount = floatval($_REQUEST['payable_amount']);
$vat = floatval($_REQUEST['vat']);
$tax = floatval($_REQUEST['tax']);
$status = '0';
date_default_timezone_set('asia/Dhaka'); // set default time zone;
$date_formate=new DateTime($date);
$date_t=$date_formate->format('Y-m-d');


include '../conn.php';
        
$order_sql = $con->prepare("Select work_order_no from tbl_order where work_order_no = '$work_order_no'    ");
$order_sql->execute();
$order_num = $order_sql->rowCount();

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
    $c = $con->lastInsertId();
	echo json_encode(array(
		'order_id' =>$c,
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

}

else {
	echo json_encode(array('errorMsg'=>'Some errors occured.'));
}








