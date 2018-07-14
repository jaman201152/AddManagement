<?php
	include '../conn.php';
	
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	$itemid = isset($_POST['itemid']) ? $_POST['itemid'] : '';
	$productid = isset($_POST['productid']) ? $_POST['productid'] : '';
	
	$offset = ($page-1)*$rows;
	
	$result = array();
	
	$where = "ref_id like '%$productid%' or ref_name like '%$productid%' ";
	$rs =$con->prepare("select count(*) as cnt from tbl_reference
				inner join country on tbl_reference.ref_division=country.id 
				inner join state on tbl_reference.ref_district=state.id
	 			where " . $where);
	$rs->execute();
        while($row=$rs->fetch(PDO::FETCH_ASSOC)){
            extract($row);
           $cnt1=$cnt;
        }
        $result["total"] = $cnt1;
	$rs1 = $con->prepare("select * from tbl_reference 
		inner join country on tbl_reference.ref_division=country.id 
		inner join state on tbl_reference.ref_district=state.id
		  where " . $where . " limit $offset,$rows");
	$rs1->execute();
	$items = array();
	while($row =$rs1->fetch(PDO::FETCH_ASSOC)){
		array_push($items, $row);
	}
	$result["rows"] = $items;
	
	echo json_encode($result);