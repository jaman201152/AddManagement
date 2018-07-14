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

	$rs1 =$con->prepare("select * from users limit $offset,$rows");
	$rs1->execute();
	$items = array();
	while($row = $rs1->fetch(PDO::FETCH_ASSOC)){
		array_push($items, $row);
	}
	$result["rows"] = $items;

	echo json_encode($result);
        