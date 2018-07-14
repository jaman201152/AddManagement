<?php
 // $id = empty($_POST['case']) ? " " : $_POST['case']; // get selection id
 // $N = count($id); 
 $q_invoice_id=  $_REQUEST['case'];
 $N = count($q_invoice_id);

        
$q_order_id=  $_REQUEST['order_id'];
$q_ref_id = $_REQUEST['ref_id'];
$q_receive_amt=  $_REQUEST['price_after_dis'];

$cust_id = htmlspecialchars($_REQUEST['cust_id']);
$cust_id_new = htmlspecialchars($_REQUEST['cust_id_new']);

$name1 = htmlspecialchars($_REQUEST['name']);


$ait_others_discount1 = htmlspecialchars($_REQUEST['ait_others_discount']);
$commission1 = htmlspecialchars($_REQUEST['commission']);

$payment_date1 = htmlspecialchars($_REQUEST['payment_date']);
date_default_timezone_set('asia/Dhaka'); // set default time zone;
$date_payment=new DateTime($payment_date1);
$date_payment_f=$date_payment->format('Y-m-d');

$payment_method1 = htmlspecialchars($_REQUEST['payment_method']);
$check_num1 = htmlspecialchars($_REQUEST['check_num']);
$memo1=htmlspecialchars($_REQUEST['memo']);
$deposite_to1=  htmlspecialchars($_REQUEST['deposite_to']);
$due1 = htmlspecialchars($_REQUEST['due']);
$status1 = htmlspecialchars($_REQUEST['status_memo']);



include '../conn.php';



    if($N!=0){ // if Request array is not empty
        for($i=0; $i < $N; $i++)
        {  // loop for inserting individual invoice in tbl_payment
        
                    $sql_payment=$con->prepare("Select * from tbl_payment where "
                            . " invoice_id='".$q_invoice_id[$i]."' and cust_id='".$cust_id."' ");
                    $sql_payment->execute();
                    $num=$sql_payment->rowCount();
                    while($row=$sql_payment->fetch(PDO::FETCH_ASSOC)){
                        extract($row);
                    }
                    
//        $invoice_update=$con->prepare("update tbl_invoice set "
//        . "ait_others_discount=:ait_others_discount, payable_amount=:due "
//        . " where cust_id=:cust_id and invoice_id=:invoice_id ");
//    $invoice_update->bindParam(':ait_others_discount',$ait_others_discount1);
//    $invoice_update->bindParam(':due',$due1);
//    $invoice_update->bindParam(':cust_id',$cust_id);
//    $invoice_update->bindParam(':invoice_id',$q_invoice_id[$i]);
//    // *************** End Invoice table Update ************

            // ************************ Start tbl_payment table insert *********************
if($num===0){

$sql = $con->prepare("Insert into tbl_payment set invoice_id=?,"
        . "order_id=?, cust_id=?, cust_id_new=?, ref_id=?, name=?, payable_amount=?,  receive_amount=?, "
        . " ait_others_discount=?, commission=?, payment_date=?, payment_method=?, check_num=?, memo=?, "
        . " deposite_to=?, due=? ");

$sql->bindParam(1,$q_invoice_id[$i]);
$sql->bindParam(2,$q_order_id[$i]);
$sql->bindParam(3,$cust_id);
$sql->bindParam(4,$cust_id_new);
$sql->bindParam(5,$q_ref_id[$i]);
$sql->bindParam(6,$name1);
$sql->bindParam(7,$q_receive_amt[$i]);
$sql->bindParam(8,$q_receive_amt[$i]);
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
      
if ($sql->execute()){
    $c = $con->lastInsertId(); // This code obtain last insert Id from database.
	echo json_encode(array(
                'payment_id' =>$c,
                'cust_id' => $cust_id,
                'cust_id_new' =>$cust_id_new,
                'ref_id' => $q_ref_id[$id],
                'order_id' => $q_order_id[$i],
                'invoice_id' => $q_invoice_id[$i],
                'name' => $name1,
                'payable_amount' => $q_receive_amt[$i],
                'receive_amount' => $q_receive_amt[$i],
                'ait_others_discount' => $ait_others_discount1,
                'commission' =>$commission1,
                'payment_date' => $date_payment_f,
                'payment_method' => $payment_method1,
                'check_num' => $check_num1,
                'memo' => $memo1,
                'deposite_to' => $deposite_to1,
		'due' => $due1
		
	));
}
else {
         $arr = $sql->errorInfo();
	echo json_encode(array('errorMsg'=>$arr));
}

            
      } // End  If Request array is not empty
    }else{ // If Request array is empty
	echo json_encode(array('errorMsg'=>'empty select. Please atleast one invoice'));  
        } // End  If Request array not empty




//
//// *************** Start tbl_ememo insert ************
//$sql_num= $con->prepare("Select * from tbl_ememo where invoice_id='".$invoice_id."' and cust_id='".$cust_id."' ");
//$sql_num->execute();
//$num_ememo= $sql_num->rowCount();
//if($num_ememo===0){
//$sql_ememo = $con->prepare("Insert into tbl_ememo set cust_id=?, cust_id_new=?, ref_id=?,  order_id=?, invoice_id=?,"
//        . "  order_price=?, paid_amount=?, "
//        . " payable_amount=?,  receive_amount=?, ait_others_discount=?, commission=?, due=?, "
//        . " payment_date=?, payment_method=?,  memo=?, check_num=?, deposite_to=?, "
//        . " status_memo=? ");
//
//$sql_ememo->bindParam(1,$cust_id);
//$sql_ememo->bindParam(2,$cust_id_new);
//$sql_ememo->bindParam(3,$ref_id1);
//$sql_ememo->bindParam(4,$order_id);
//$sql_ememo->bindParam(5,$invoice_id);
//$sql_ememo->bindParam(6,$order_price1);
//$sql_ememo->bindParam(7,$paid_amount);
//$sql_ememo->bindParam(8,$pay_r);
//$sql_ememo->bindParam(9,$receive_amount1);
//$sql_ememo->bindParam(10,$ait_others_discount1);
//$sql_ememo->bindParam(11,$commission1);
//$sql_ememo->bindParam(12,$due1);
//$sql_ememo->bindParam(13,$date_payment_f);
//$sql_ememo->bindParam(14,$payment_method1);
//$sql_ememo->bindParam(15,$memo1);
//$sql_ememo->bindParam(16,$check_num1);
//$sql_ememo->bindParam(17,$deposite_to1);
//$sql_ememo->bindParam(18,$status1);
//}
//if($num_ememo!=0){
//    $sql_ememo = $con->prepare("Insert into tbl_ememo set cust_id=?, cust_id_new=?, ref_id=?,  order_id=?, invoice_id=?,"
//        . "  order_price=?, paid_amount=?, "
//        . " payable_amount=?,  receive_amount=?, ait_others_discount=?, commission=?, due=?, "
//        . " payment_date=?, payment_method=?,  memo=?, check_num=?, deposite_to=?, "
//        . " status_memo=? ");
//
//$sql_ememo->bindParam(1,$cust_id);
//$sql_ememo->bindParam(2,$cust_id_new);
//$sql_ememo->bindParam(3,$ref_id1);
//$sql_ememo->bindParam(4,$order_id);
//$sql_ememo->bindParam(5,$invoice_id);
//$sql_ememo->bindParam(6,$order_price1);
//$sql_ememo->bindParam(7,$paid_amount);
//$sql_ememo->bindParam(8,$pay_r); // if not zero then payable amount is due amount.
//$sql_ememo->bindParam(9,$receive_amount1);
//$sql_ememo->bindParam(10,$ait_others_discount1);
//$sql_ememo->bindParam(11,$commission1);
//$sql_ememo->bindParam(12,$due1);
//$sql_ememo->bindParam(13,$date_payment_f);
//$sql_ememo->bindParam(14,$payment_method1);
//$sql_ememo->bindParam(15,$memo1);
//$sql_ememo->bindParam(16,$check_num1);
//$sql_ememo->bindParam(17,$deposite_to1);
//$sql_ememo->bindParam(18,$status1);
//    
//}
//
////************* END tbl_ememo INSERT WITHOUT EXECUTE ***********************






