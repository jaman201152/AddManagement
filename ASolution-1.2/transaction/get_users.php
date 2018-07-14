<?php
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	$offset = ($page-1)*$rows;
	$result = array();

	include 'conn.php';
	$rs =$con->prepare("select count(*) as cnt from users");
	$rs->execute();
        while($row=$rs->fetch(PDO::FETCH_ASSOC)){
            extract($row);
        }
	$result["total"] = $cnt;

	$rs1 =$con->prepare("select * from tbl_transaction limit $offset,$rows");
	$rs1->execute();
	$items = array();
	while($row = $rs1->fetch(PDO::FETCH_ASSOC)){
		array_push($items, $row);
	}
	$result["rows"] = $items;
// ******************** row End ********************
        $footer=array();
        $sql_amount_receive=$con->prepare("Select sum(amount) as amount from tbl_transaction where transaction_type='Receive' limit $offset,$rows");
        $sql_amount_receive->execute();
        while($row=$sql_amount_receive->fetch(PDO::FETCH_ASSOC)){
            $a= array("member_name"=>"Total");
            $b=  array_merge($a,$row);
            array_push($footer,$b);
        }
        $result['footer']=$footer;
        
	echo json_encode($result);
        