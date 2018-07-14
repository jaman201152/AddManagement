<?php

$invoice_id=  htmlspecialchars($_REQUEST['invoice_id']);
$order_id=  htmlspecialchars($_REQUEST['order_id']);
$cust_id = htmlspecialchars($_REQUEST['cust_id']);
$cust_id_new = htmlspecialchars($_REQUEST['cust_id_new']);
$ref_id1 = htmlspecialchars($_REQUEST['ref_id']);
$name1 = htmlspecialchars($_REQUEST['name']);
 // For Order Table Update
$real_price = htmlspecialchars($_REQUEST['price']);
$real_price1 = floatval(preg_replace('/[^\d.]/', '',$real_price));

$discount1 = htmlspecialchars($_REQUEST['discount']);
$discount_amt = htmlspecialchars($_REQUEST['discount_amt']);
$discount_amt1 = floatval(preg_replace('/[^\d.]/', '',$discount_amt));
$receivable_amount = $real_price1 - $discount_amt1;
 // For Order table Update 
$order_price=  htmlspecialchars($_REQUEST['order_price']);
$order_price1 = floatval(preg_replace('/[^\d.]/', '',$order_price));
$paid_amount = htmlspecialchars($_REQUEST['paid_amount']);
$pay = htmlspecialchars($_REQUEST['payable_amt_inv']);
$pay_r = floatval(preg_replace('/[^\d.]/', '',$pay));
$receive_amount1 = htmlspecialchars($_REQUEST['receive_amount']);
$ait_others_discount1 = htmlspecialchars($_REQUEST['ait_others_discount']);
$commission1 = htmlspecialchars($_REQUEST['commission']);
$payment_date = htmlspecialchars($_REQUEST['payment_date']);
$payment_method1 = htmlspecialchars($_REQUEST['payment_method']);
$check_num1 = htmlspecialchars($_REQUEST['check_num']);
$memo1=htmlspecialchars($_REQUEST['memo']);
$deposite_to1=  htmlspecialchars($_REQUEST['deposite_to']);
$due1 = htmlspecialchars($_REQUEST['due']);
$status1 = htmlspecialchars($_REQUEST['status_memo']);

date_default_timezone_set('asia/Dhaka'); // set default time zone;
$date_payment=new DateTime($payment_date);
$date_payment_f=$date_payment->format('Y-m-d');

include '../conn.php';
$sql_payment=$con->prepare("Select * from tbl_payment where invoice_id='".$invoice_id."' and cust_id='".$cust_id."' ");
$sql_payment->execute();
$num=$sql_payment->rowCount();
while($row=$sql_payment->fetch(PDO::FETCH_ASSOC)){
    extract($row);
}

$invoice_update=$con->prepare("update tbl_invoice set "
        . "ait_others_discount=:ait_others_discount, payable_amount=:due "
        . " where cust_id=:cust_id and invoice_id=:invoice_id ");
$invoice_update->bindParam(':ait_others_discount',$ait_others_discount1);
$invoice_update->bindParam(':due',$due1);
$invoice_update->bindParam(':cust_id',$cust_id);
$invoice_update->bindParam(':invoice_id',$invoice_id);
// *************** End Invoice table Update ************

$order_update=$con->prepare("update tbl_order set "
        . "price=:price,discount=:discount,discount_amount=:discount_amount, "
        . "payable_amount=:rec_amount where cust_id=:cust_id and order_id=:order_id ");
$order_update->bindParam(':price',$real_price1);
$order_update->bindParam(':discount',$discount1);
$order_update->bindParam(':discount_amount',$discount_amt1);
$order_update->bindParam(':rec_amount',$receivable_amount);
$order_update->bindParam(':cust_id',$cust_id);
$order_update->bindParam(':order_id',$order_id);
// *************** End Invoice table Update ************




// ************************ Start tbl_payment table insert *********************
if($num===0){
$sql = $con->prepare("insert into tbl_payment set invoice_id=?,"
        . "order_id=?, cust_id=?, cust_id_new=?, ref_id=?, name=?, payable_amount=?,  receive_amount=?, "
        . " ait_others_discount=?, commission=?, payment_date=?, payment_method=?, check_num=?, memo=?, "
        . " deposite_to=?, due=? ");

$sql->bindParam(1,$invoice_id);
$sql->bindParam(2,$order_id);
$sql->bindParam(3,$cust_id);
$sql->bindParam(4,$cust_id_new);
$sql->bindParam(5,$ref_id1);
$sql->bindParam(6,$name1);
$sql->bindParam(7,$pay_r);
$sql->bindParam(8,$receive_amount1);
$sql->bindParam(9,$ait_others_discount1);
$sql->bindParam(10,$commission1);
$sql->bindParam(11,$date_payment_f);
$sql->bindParam(12,$payment_method1);
$sql->bindParam(13,$check_num1);
$sql->bindParam(14,$memo1);
$sql->bindParam(15,$deposite_to1);
$sql->bindParam(16,$due1);
}
if($num!=0){
    
    $receive_amount2=$receive_amount1+$receive_amount; // Paid before add new payment.
    
    $sql=$con->prepare("update tbl_payment set receive_amount=:receive_amount,
     ait_others_discount=:ait_others_discount, commission=:commission, payment_date=:payment_date,due=:due where cust_id=:cust_id and invoice_id=:invoice_id ");
    $sql->bindParam(':receive_amount',$receive_amount2);
    $sql->bindParam(':ait_others_discount',$ait_others_discount1);
    $sql->bindParam(':commission',$commission1);
    $sql->bindParam(':payment_date',$date_payment_f);
    $sql->bindParam(':due',$due1);
    $sql->bindParam(':cust_id',$cust_id);
    $sql->bindParam(':invoice_id',$invoice_id);
    
}
// ****************** End tbl_payment insert without execute  ***************

// *************** Start tbl_ememo insert ************
$sql_num= $con->prepare("Select * from tbl_ememo where invoice_id='".$invoice_id."' and cust_id='".$cust_id."' ");
$sql_num->execute();
$num_ememo= $sql_num->rowCount();
if($num_ememo===0){
$sql_ememo = $con->prepare("insert into tbl_ememo set cust_id=?, cust_id_new=?, ref_id=?,  order_id=?, invoice_id=?,"
        . "  order_price=?, paid_amount=?, "
        . " payable_amount=?,  receive_amount=?, ait_others_discount=?, commission=?, due=?, "
        . " payment_date=?, payment_method=?,  memo=?, check_num=?, deposite_to=?, "
        . " status_memo=? ");

$sql_ememo->bindParam(1,$cust_id);
$sql_ememo->bindParam(2,$cust_id_new);
$sql_ememo->bindParam(3,$ref_id1);
$sql_ememo->bindParam(4,$order_id);
$sql_ememo->bindParam(5,$invoice_id);
$sql_ememo->bindParam(6,$order_price1);
$sql_ememo->bindParam(7,$paid_amount);
$sql_ememo->bindParam(8,$pay_r);
$sql_ememo->bindParam(9,$receive_amount1);
$sql_ememo->bindParam(10,$ait_others_discount1);
$sql_ememo->bindParam(11,$commission1);
$sql_ememo->bindParam(12,$due1);
$sql_ememo->bindParam(13,$date_payment_f);
$sql_ememo->bindParam(14,$payment_method1);
$sql_ememo->bindParam(15,$memo1);
$sql_ememo->bindParam(16,$check_num1);
$sql_ememo->bindParam(17,$deposite_to1);
$sql_ememo->bindParam(18,$status1);
}
if($num_ememo!=0){
    $sql_ememo = $con->prepare("insert into tbl_ememo set cust_id=?, cust_id_new=?, ref_id=?,  order_id=?, invoice_id=?,"
        . "  order_price=?, paid_amount=?, "
        . " payable_amount=?,  receive_amount=?, ait_others_discount=?, commission=?, due=?, "
        . " payment_date=?, payment_method=?,  memo=?, check_num=?, deposite_to=?, "
        . " status_memo=? ");

$sql_ememo->bindParam(1,$cust_id);
$sql_ememo->bindParam(2,$cust_id_new);
$sql_ememo->bindParam(3,$ref_id1);
$sql_ememo->bindParam(4,$order_id);
$sql_ememo->bindParam(5,$invoice_id);
$sql_ememo->bindParam(6,$order_price1);
$sql_ememo->bindParam(7,$paid_amount);
$sql_ememo->bindParam(8,$pay_r); // if not zero then payable amount is due amount.
$sql_ememo->bindParam(9,$receive_amount1);
$sql_ememo->bindParam(10,$ait_others_discount1);
$sql_ememo->bindParam(11,$commission1);
$sql_ememo->bindParam(12,$due1);
$sql_ememo->bindParam(13,$date_payment_f);
$sql_ememo->bindParam(14,$payment_method1);
$sql_ememo->bindParam(15,$memo1);
$sql_ememo->bindParam(16,$check_num1);
$sql_ememo->bindParam(17,$deposite_to1);
$sql_ememo->bindParam(18,$status1);
    
}

//************* END tbl_ememo INSERT WITHOUT EXECUTE ***********************


if ($sql->execute() && $invoice_update->execute() && $sql_ememo->execute() && $order_update->execute() ){
    $c = $con->lastInsertId(); // This code obtain last insert Id from database.
	echo json_encode(array(
                'payment_id' =>$c,
                'cust_id' => $cust_id,
                'cust_id_new' =>$cust_id_new,
                'ref_id' => $ref_id1,
                'order_id' => $order_id,
                'invoice_id' => $invoice_id,
                'name' => $name1,
                'payable_amount' => $pay_r,
                'receive_amount' => $receive_amount1,
                'ait_others_discount' => $ait_others_discount1,
                'commission' =>$commission1,
                'payment_date' => $payment_date,
                'payment_method' => $payment_method1,
                'check_num' => $check_num1,
                'memo' => $memo1,
                'deposite_to' => $deposite_to1,
		'due' => $due1,
                'memo_id' => $c,
                'order_price' => $order_price1,
                'paid_amount' => $paid_amount,
                'status_memo' => $status1,
                'price' =>$real_price1,
                'discount' =>$discount1,
                'discount_amount' =>$discount_amt1
		
	));
}
else {
         $inv_update = $invoice_update->errorInfo();
         $sql = $sql->errorInfo();
         $sql_ememo = $sql_ememo->errorInfo();
         $order_update = $order_update->errorInfo();
	echo json_encode(array('errorMsg'=>$inv_update."| ".$sql."| ".$sql_ememo."| ".$order_update));
}




//if( $sql_ememo->execute() ){
//    	echo json_encode(array(
//                'memo_id' => mysql_insert_id(),
//                'cust_id' => $cust_id,
//                'order_id' => $order_id,
//		'invoice_id' => $invoice_id,
//                'order_price' => $order_price1,
//                'paid_amount' => $paid_amount,
//                'payable_amount' => $payable_amount,
//                'receive_amount' => $receive_amount1,
//                'due' => $due1,
//                'payment_date' => $date_payment_f,
//                'payment_method' => $payment_method,
//                'memo' => $memo,
//                'status' => $status
//		
//                
//		
//	));
//}
//
//else {
//	echo json_encode(array('errorMsg'=>'Error ocured.'));
//}
