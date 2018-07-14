<?php

$cust_id = htmlspecialchars($_REQUEST['cust_id']);
$cust_id_new = htmlspecialchars($_REQUEST['cust_id_new']);
$order_id=  htmlspecialchars($_REQUEST['order_id']);
$order_date=  htmlspecialchars($_REQUEST['order_date']);
$invoice_date=  htmlspecialchars($_REQUEST['invoice_date']);
$pub_date=  htmlspecialchars($_REQUEST['pub_date']);
$item = htmlspecialchars($_REQUEST['item']);
$description= htmlspecialchars($_REQUEST['description']);
$invoice_row = htmlspecialchars($_REQUEST['o_row']);
$invoice_column = htmlspecialchars($_REQUEST['o_column']);
$qty = htmlspecialchars($_REQUEST['qty']);
$unit_price=htmlspecialchars($_REQUEST['unit_price']);
$price=  htmlspecialchars($_REQUEST['price']);
$front_page=  htmlspecialchars($_REQUEST['front_page']);
$back_page=  htmlspecialchars($_REQUEST['back_page']);
$color=  htmlspecialchars($_REQUEST['color']);
$discount = htmlspecialchars($_REQUEST['discount']);
$discount_amount=  htmlspecialchars($_REQUEST['discount_amount']);
$ait_others_discount = htmlspecialchars($_REQUEST['ait_others_discount']);
$payable_amount = htmlspecialchars($_REQUEST['payable_amount']);
$work_order_no = htmlspecialchars($_REQUEST['work_order_no']);
$vat = htmlspecialchars($_REQUEST['vat']);
$tax = htmlspecialchars($_REQUEST['tax']);
$ref_id=htmlspecialchars($_REQUEST['ref_id']);


date_default_timezone_set('asia/Dhaka'); // set default time zone;
$date_formate=new DateTime($order_date);
$date_t=$date_formate->format('Y-m-d');

$date_invoice=new DateTime($invoice_date);
$invoice_date_f=$date_invoice->format('Y-m-d');

$date_pub=new DateTime($pub_date);
$pub_date_f=$date_pub->format('Y-m-d');

include '../conn.php';
    $query_order_id=$con->prepare("Select order_id from tbl_invoice where order_id='$order_id' ");
    $query_order_id->execute();
    $order_num=$query_order_id->rowCount();
                                    
   if($order_num==0){          
       $sql_order_update=$con->prepare("update tbl_order set status=:status where order_id=:id  ");
       $c='1';
       $sql_order_update->bindParam(':status',$c);
       $sql_order_update->bindParam(':id',$order_id);
         
$sql = $con->prepare("insert into tbl_invoice set cust_id =?, cust_id_new=?, "
        . "order_id=?, order_date=?, invoice_date=?, pub_date=?, "
        . " item=?, "
        . " payable_amount=?,"
        . " work_order_no=?, "
        . " ref_id=?, ait_others_discount=? ");

$sql->bindParam(1,$cust_id);
$sql->bindParam(2,$cust_id_new);
$sql->bindParam(3,$order_id);
$sql->bindParam(4,$date_t);
$sql->bindParam(5,$invoice_date_f);
$sql->bindParam(6,$pub_date_f);
$sql->bindParam(7,$item);
$sql->bindParam(8,$payable_amount);
$sql->bindParam(9,$work_order_no);
$sql->bindParam(10,$ref_id);
$sql->bindParam(11,$ait_others_discount);

if ($sql->execute() && $sql_order_update->execute() ){
      $last_id = $con->lastInsertId();
	echo json_encode(array(
                'invoice_id' =>$last_id,
                'cust_id' => $cust_id,
                'cust_id_new' => $cust_id_new,
		'order_id' => $order_id,
		'order_date' => $date_t,
                'invoice_date' => $invoice_date_f,
                'pub_date' => $pub_date_f,
                'item' => $item,
		'payable_amount' => $payable_amount,
    'work_order_no' => $work_order_no,
		'ref_id' => $ref_id,
            'ait_others_discount' =>$ait_others_discount
		
	));
}
else{
    $arr = $sql->errorInfo();
    echo json_encode(array('errorMsg'=>$arr));
}

  }
  
else {
	echo json_encode(array('errorMsg'=>'Duplicate Invoice does not Created.'));
}
