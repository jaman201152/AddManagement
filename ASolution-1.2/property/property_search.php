<?php
	include 'conn.php';
	
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	$itemid = isset($_POST['itemid']) ? $_POST['itemid'] : '';
	$productid = isset($_POST['productid']) ? $_POST['productid'] : '';
	
	$offset = ($page-1)*$rows;
	
	$result = array();
	
	$where = "property_id like '%$productid%' or property_name like '%$productid%' ";
	$rs =$con->prepare("select count(*) as cnt from tbl_property where " . $where);
	$rs->execute();
        while($row=$rs->fetch(PDO::FETCH_ASSOC)){
            extract($row);
           $cnt1=$cnt;
        }
        $result["total"] = $cnt1;
	$rs1 = $con->prepare("select * from tbl_property where " . $where . " order by property_id DESC limit $offset,$rows");
	$rs1->execute();
	$items = array();
	while($row =$rs1->fetch(PDO::FETCH_ASSOC)){
		array_push($items, $row);
	}
	$result["rows"] = $items;
// ******************** row End ********************
        $footer=array();
        if(empty($productid)){
        $sql_amount_receive=$con->prepare("Select sum(original_amount) as original_amount from tbl_property limit $offset,$rows");
        $sql_amount_receive->execute();
         $sql_amount_payment=$con->prepare("Select sum(present_approximate_amount) as present_approximate_amount from tbl_property limit $offset,$rows");
        $sql_amount_payment->execute();
        } // For searching when search box is empty.
        if(!empty($productid)){
             $sql_amount_receive=$con->prepare("Select sum(original_amount) as original_amount from tbl_property where ".$where." limit $offset,$rows");
        $sql_amount_receive->execute();
         $sql_amount_payment=$con->prepare("Select sum(present_approximate_amount) as present_approximate_amount from tbl_property where ".$where." limit $offset,$rows");
        $sql_amount_payment->execute();
        } // For searching when search box is not empty.
        
        while($row_receive_amt=$sql_amount_receive->fetch(PDO::FETCH_ASSOC)){
               
        while($row_payment_amt=$sql_amount_payment->fetch(PDO::FETCH_ASSOC)){
            $a= array("property_description"=>"Total Amount (TK.):");
            $b=  array_merge($a,$row_receive_amt);
            
            
            $e=  array_merge($b,$row_payment_amt);
            array_push($footer,$e);
        }
        
        }
        $result['footer']=$footer;
        
	echo json_encode($result);
        