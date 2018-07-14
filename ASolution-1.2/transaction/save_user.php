<?php

$mid = htmlspecialchars($_REQUEST['member_id']);
$m_name = htmlspecialchars($_REQUEST['member_name']);
$memo_no= htmlspecialchars($_REQUEST["memo_no"]);
$amount = htmlspecialchars($_REQUEST['amount']);
$transaction_type = htmlspecialchars($_REQUEST['transaction_type']);
$date = htmlspecialchars($_REQUEST['payment_date']);
$received_by = htmlspecialchars($_REQUEST['received_by']);

$date1= new DateTime($date);
$date2=$date1->format('Y-m-d');

include 'conn.php';

$sql = $con->prepare("insert into tbl_transaction set member_id =?,"
        . "member_name=?,memo_no=?,"
        . "amount=?,transaction_type=?,"
        . "payment_date=?,received_by=? ");
$sql->bindParam(1,$mid);
$sql->bindParam(2,$m_name);
$sql->bindParam(3,$memo_no);
$sql->bindParam(4,$amount);
$sql->bindParam(5,$transaction_type);
$sql->bindParam(6,$date2);
$sql->bindParam(7,$received_by);

if ($sql->execute()){
	echo json_encode(array(
		't_id' => mysql_insert_id(),
		'member_id' => $mid,
		'member_name' => $m_name,
                'memo_no' => $memo_no,
		'amount' => $amount,
                'transaction_type' => $transaction_type,
		'payment_date' => $date2,
                'received_by' => $received_by
            
	));
}
else {
	echo json_encode(array('errorMsg'=>'Some errors occured.'));
}
