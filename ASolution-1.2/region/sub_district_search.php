<?php
	include '../conn.php';
	
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10000000;
	$productid = isset($_POST['productid']) ? $_POST['productid'] : '';
	
	$offset = ($page-1)*$rows;
	
	$result = array();
	
	$where = " city.city like '%$productid%' or city.id like '%$productid%' order by city.id DESC ";
	$rs =$con->prepare("select count(*) as cnt from ((city"
                . " inner join country on country.id=city.countryid) "
                 . " inner join state on state.id=city.stateid) "
                ." where " . $where);
	$rs->execute();
        while($row=$rs->fetch(PDO::FETCH_ASSOC)){
            extract($row);
           $cnt1=$cnt;
        }
        $result["total"] = $cnt1;
        $rs1 = $con->prepare("select city.id,city.city,country.country,state.statename,city.stateid,city.countryid from ((city"
                . " inner join country on country.id=city.countryid) "
                 . " inner join state on state.id=city.stateid) "
        ." where ". $where."limit $offset,$rows");
	$rs1->execute();
	$items = array();
	while($row =$rs1->fetch(PDO::FETCH_ASSOC)){
                $a['address_custom']=substr($row['city'],0,10).'... '; // Address will show 10 characters.
                $a['name_custom']=substr($row['id'],0,50);
                //$date=new DateTime($row['join_date']); // for format date
                //$dt = $date->format('d-M-Y'); // for format date
                $b=  array_merge($a,$row);
		array_push($items, $b);
	}
	$result["rows"] = $items;
	
	echo json_encode($result);