<?php


$id = intval($_REQUEST['id']);
$cust_id = htmlspecialchars($_REQUEST['cust_id']);
$date=  htmlspecialchars($_REQUEST['order_date']);
$type = htmlspecialchars($_REQUEST['type']);
$project_name = htmlspecialchars($_REQUEST['project_name']);
$ref_id=htmlspecialchars($_REQUEST['ref_id']);
$item = htmlspecialchars($_REQUEST['item']);
$description= htmlspecialchars($_REQUEST['description']);
$row = htmlspecialchars($_REQUEST['o_row']);
$column = htmlspecialchars($_REQUEST['o_column']);
$qty = htmlspecialchars($_REQUEST['qty']);
$unit_price=htmlspecialchars($_REQUEST['unit_price']);
$price=  htmlspecialchars($_REQUEST['price']);
$front_page = htmlspecialchars($_REQUEST['front_page']);
$back_page = htmlspecialchars($_REQUEST['back_page']);
$color = htmlspecialchars($_REQUEST['color']);
$discount = htmlspecialchars($_REQUEST['discount']);
$discount_amount = htmlspecialchars($_REQUEST['discount_amount']);
$payable_amount = htmlspecialchars($_REQUEST['payable_amount']);
$vat = htmlspecialchars($_REQUEST['vat']);
$tax = htmlspecialchars($_REQUEST['tax']);
$status = htmlspecialchars($_REQUEST['status']);

date_default_timezone_set('asia/Dhaka'); // set default time zone;
$date_formate=new DateTime($date);
$date_t=$date_formate->format('Y-m-d');


include '../conn.php';

$sql = $con->prepare("update tbl_order set "
        . "order_date=:date_t, "
          . "type=:type, "
        . "project_name=:project_name, "
        . "ref_id=:ref_id, "
        . " item=:item,"
        . " description=:description, o_row=:row, o_column=:column, qty=:qty, "
        . "unit_price=:unit_price, price=:price,"
        . " front_page=:front_page, back_page=:back_page, color=:color, discount=:discount, "
        . " discount_amount=:discount_amount, payable_amount=:payable_amount, "
        . "  vat=:vat, tax=:tax, status=:status  where order_id=:id  ");

$sql->bindParam(':id',$id);
  $sql->bindParam(':date_t',$date_t);
  $sql->bindParam(':type',$type);
  $sql->bindParam(':project_name',$project_name);
  $sql->bindParam(':ref_id',$ref_id);
$sql->bindParam(':item',$item);
$sql->bindParam(':description',$description);
$sql->bindParam(':row',$row);
$sql->bindParam(':column',$column);
$sql->bindParam(':qty',$qty);
$sql->bindParam(':unit_price',$unit_price);
$sql->bindParam(':price',$price);
$sql->bindParam(':front_page',$front_page);
$sql->bindParam(':back_page',$back_page);
$sql->bindParam(':color',$color);
$sql->bindParam(':discount',$discount);
$sql->bindParam(':discount_amount', $discount_amount);
$sql->bindParam(':payable_amount',$payable_amount);
$sql->bindParam(':vat',$vat);
$sql->bindParam(':tax',$tax);
$sql->bindParam(':status',$status);
if ($sql->execute()){
	echo json_encode(array(
		'order_id' => $id,
                'cust_id' => $cust_id,
		'order_date' => $date_t,
		'type' => $type,
		'project_name' => $project_name,
                'ref_id' => $ref_id,
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
