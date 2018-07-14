<?php

$cust_id = $_REQUEST['cust_id'];
$cust_id_new = $_REQUEST['cust_id_new'];
$order_id=  $_REQUEST['order_id'];
$order_date=  $_REQUEST['order_date'];
$invoice_date= $_REQUEST['invoice_date'];
$pub_date=  $_REQUEST['pub_date'];
$work_order_no = $_REQUEST['work_order_no'];
$item = $_REQUEST['item'];
$payable_amount = $_REQUEST['payable_amount'];
$ref_id= $_REQUEST['ref_id'];
$ait_others_discount=0;


include '../conn.php';
        $N = count($order_id);
        if($N!=0){ // if Request array is not empty
        for($i=0; $i < $N; $i++)
        {  // loop for inserting individual order
            
$cust_id_v=$cust_id[$i]; $cust_id_new_v=$cust_id_new[$i];$order_id_v=$order_id[$i];
$order_date_v=$order_date[$i]; $invoice_date_v=$invoice_date[$i];$pub_date_v=$pub_date[$i];
$item_v = $item[$i];$payable_amount_v=$payable_amount[$i];$work_order_no_v=$work_order_no[$i];
$ref_id_v=$ref_id[$i];
            $query_order_id=$con->prepare("Select order_id from tbl_invoice where order_id='$order_id_v' ");
    $query_order_id->execute();
    $order_num=$query_order_id->rowCount();
                                    
   if($order_num==0){          
       $sql_order_update=$con->prepare("update tbl_order set status=:status where order_id=:id  ");
       $c='1';
       $sql_order_update->bindParam(':status',$c);
       $sql_order_update->bindParam(':id',$order_id_v);
         
       date_default_timezone_set('asia/Dhaka'); // set default time zone;
    $date_formate=new DateTime($order_date_v);
    $order_date_f=$date_formate->format('Y-m-d');

    $date_invoice=new DateTime($invoice_date_v);
    $invoice_date_f=$date_invoice->format('Y-m-d');

    $date_pub=new DateTime($pub_date_v);
    $pub_date_f=$date_pub->format('Y-m-d');

    $sql = $con->prepare("insert into tbl_invoice set cust_id =?, cust_id_new=?,"
            . " order_id=?, order_date=?, "
        . "pub_date=?, invoice_date=?, "
        . " item=?, payable_amount=?, work_order_no=?, "
        . " ref_id=?, ait_others_discount=? ");
$sql->bindParam(1,$cust_id_v);
$sql->bindParam(2,$cust_id_new_v);
$sql->bindParam(3,$order_id_v);
$sql->bindParam(4,$order_date_f);
$sql->bindParam(5,$pub_date_f);
$sql->bindParam(6,$invoice_date_f);
$sql->bindParam(7,$item_v);
$sql->bindParam(8,$payable_amount_v);
$sql->bindParam(9,$work_order_no_v);
$sql->bindParam(10,$ref_id_v);
$sql->bindParam(11,$ait_others_discount);
if ($sql->execute() && $sql_order_update->execute() ){
      $last_id = $con->lastInsertId();
	echo json_encode(array(
                'invoice_id' =>$last_id,
                'cust_id' => $cust_id_v,
                'cust_id_new' => $cust_id_new_v,
		'order_id' => $order_id_v,
		'order_date' => $order_date_f,
                'pub_date' => $pub_date_f,
                'invoice_date' => $invoice_date_f,
                'item' => $item_v,
		'payable_amount' => $payable_amount_v,
    'work_order_no' => $work_order_no_v,
		'ref_id' => $ref_id_v,
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

        } // End loop for inserting individual order
        } // End  If Request array is not empty
        else{ // If Request array is empty
	echo json_encode(array('errorMsg'=>'empty select.'));  
        } // End  If Request array not empty
    