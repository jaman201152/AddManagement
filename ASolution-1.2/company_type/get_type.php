<?php
	
	$result = array();

	include '../conn.php';
	
	$rs =$con->prepare("select count(*) as cnt from company_type_tbl");
	$rs->execute();
        while($row=$rs->fetch(PDO::FETCH_ASSOC)){
            extract($row);
        }
	//$result["total"] = $cnt;
    
	$rs1 =$con->prepare("select * from company_type_tbl order by companytypeid DESC limit 1 ");
	$rs1->execute();
	$items = array();
	while($row = $rs1->fetch(PDO::FETCH_ASSOC)){
		array_push($items, $row);
	}
	$items;

	echo json_encode($items);

