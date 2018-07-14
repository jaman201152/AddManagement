<?php
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	$offset = ($page-1)*$rows;
	$result = array();

	include '../conn.php';
        
        
	$rs =$con->prepare(" SELECT count(*) as cnt  "
                . " FROM country c"
                . " inner join state s on c.id = s.countryid"
                . " inner join city ch on s.id = ch.stateid "
                . " order by ch.id DESC  " );
	$rs->execute();
        
        while($row=$rs->fetch(PDO::FETCH_ASSOC)){
            extract($row);
        }
	$result["total"] = $cnt;

        
	$rs1 =$con->prepare(" SELECT c.country as division , s.statename as district , ch.city as thana"
                . " FROM country c"
                . " inner join state s on c.id = s.countryid"
                . " inner join city ch on s.id = ch.stateid "
                . " order by ch.id DESC  limit $offset,$rows"); // Join 3 Table Sql Syntax.
	$rs1->execute();
	$items = array();
	while($row = $rs1->fetch(PDO::FETCH_ASSOC)){
		array_push($items, $row);
	}
	$result["rows"] = $items;

	echo json_encode($result);
        