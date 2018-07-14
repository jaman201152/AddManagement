<?php
	include '../conn.php';
	
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10000;
	$productid = isset($_POST['productid']) ? $_POST['productid'] : '';
	
	$offset = ($page-1)*$rows;
	
	$result = array();
	
	$where = " tbl_customer.cust_id_new like '%$productid%' or tbl_customer.name like '%$productid%' order by tbl_customer.cust_id DESC ";
	$rs =$con->prepare("select count(*) as cnt from (((tbl_customer "
                . " inner join country on tbl_customer.division=country.id)"
                . " inner join state on tbl_customer.district=state.id)"
//                ." inner join city on tbl_customer.upazila = city.id) "
                . " inner join tbl_reference on tbl_customer.ref_id = tbl_reference.ref_id) "
                ." where " .$where);
	$rs->execute();
        while($row=$rs->fetch(PDO::FETCH_ASSOC)){
            extract($row);
           $cnt1=$cnt;
        }
        $result["total"] = $cnt1;
        $rs1 = $con->prepare("select * from (((tbl_customer "
        ." inner join country on tbl_customer.division=country.id) "
        ." inner join state on tbl_customer.district = state.id) "
//        ." inner join city on tbl_customer.upazila = city.id) "
        ." inner join tbl_reference on tbl_customer.ref_id = tbl_reference.ref_id) "
        ." where ".$where." limit $offset,$rows");
	$rs1->execute(); 
	$items = array(); 
	while($row =$rs1->fetch(PDO::FETCH_ASSOC)){
                $a['address_custom']=substr($row['address'],0,10).'... '; // Address will show 10 characters.
                $a['name_custom']=substr($row['name'],0,50);
                //$date=new DateTime($row['join_date']); // for format date
                //$dt = $date->format('d-M-Y'); // for format date

                $row['join_date'] = $row['join_date'];
                $b=  array_merge($a,$row);
		array_push($items, $b);
	}
	$result["rows"] = $items;
	
	echo json_encode($result);