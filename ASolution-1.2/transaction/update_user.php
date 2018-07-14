<?php
include 'conn.php';
$id = intval($_REQUEST['id']);
$member_id = htmlspecialchars($_REQUEST['member_id']);
$member_name = htmlspecialchars($_REQUEST['member_name']);
$memo_no = htmlspecialchars($_REQUEST['memo_no']);
$amount = htmlspecialchars($_REQUEST['amount']);
$transaction_type = htmlspecialchars($_REQUEST['transaction_type']);
$payment_date = htmlspecialchars($_REQUEST['payment_date']);
$received_by = htmlspecialchars($_REQUEST['received_by']);

$date1= new DateTime($payment_date);
$date_f=$date1->format('Y-m-d');


$sql = $con->prepare("update tbl_transaction set member_id=:member_id,member_name=:member_name,memo_no=:memo_no,"
        . "amount=:amount,transaction_type=:transaction_type,"
        . "payment_date=:payment_date,received_by=:received_by "
        . " where t_id=:id ");


$sql->bindParam(':id',$id);

$sql->bindParam(':member_id',$member_id);
$sql->bindParam(':member_name',$member_name);
$sql->bindParam(':memo_no',$memo_no);
$sql->bindParam(':amount',$amount);
$sql->bindParam(':transaction_type',$transaction_type);
$sql->bindParam(':payment_date',$date_f);
$sql->bindParam(':received_by',$received_by);


if ($sql->execute()){
	echo json_encode(array(
		't_id' => $id,
                'member_id' => $member_id,
		'member_name' => $member_name,
                'memo_no' => $memo_no,
		'amount' => $amount,
                'transaction_type' => $transaction_type,
		'payment_date' => $date_f,
                'received_by' => $received_by
		
	));
}
else {
	echo json_encode(array('errorMsg'=>'Some errors occured.'));
}
