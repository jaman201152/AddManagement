<?php
	include '../conn.php';
	
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 5;
	$itemid = isset($_POST['itemid']) ? $_POST['itemid'] : '';
        $q=$_GET['q'];
	$productid = isset($_POST['productid']) ? $_POST['productid'] : $q;
	
	$offset = ($page-1)*$rows;
	
	$result = array();
	
	$where = " order_id like '$productid%' and cust_id like '$q' ";
	$rs =$con->prepare("select count(*) as cnt from tbl_order where " . $where);
	$rs->execute();
        while($row=$rs->fetch(PDO::FETCH_ASSOC)){
            extract($row);
        }
        $result["total"] = $cnt;// Row Count End.
        
        
	$rs1 = $con->prepare("select * from tbl_order where " . $where . " order by order_id DESC limit $offset,$rows");
	$rs1->execute();
	$items = array();
	while($row =$rs1->fetch(PDO::FETCH_ASSOC)){
            
            $rs1_customer = $con->prepare("select * from tbl_customer where cust_id='$q' ");
	$rs1_customer->execute();
	
	while($row_customer =$rs1_customer->fetch(PDO::FETCH_ASSOC)){
            
                
            //extract($row);
                $d=new DateTime($row['order_date']);
                $date=$d->format('d-m-Y H:i a'); // date show like d-m-Y.
                $o_date=array("o_date"=>"$date");
                $cust_order=  array_merge($row,$row_customer); // Two table data has been displayed in one array.
                $m=  array_merge($o_date,$cust_order);
		array_push($items, $m);
                
                } // customer table while loop end.
	} // order table while loop end.
	$result["rows"] = $items;
// *********************rows End ***************************.
        $footer=array();
        
        $payable_amount1=$con->prepare("select sum(payable_amount) as payable_amount from tbl_order where " . $where);
	$payable_amount1->execute();
        $row2=array();
        while($row=$payable_amount1->fetch(PDO::FETCH_ASSOC)){
            
            foreach ($row as $row3)
                $row2['payable_amount'] = number_format($row3,2,'.',',');
            
             $discount1=$con->prepare("select sum(discount) as discount from tbl_order where " . $where);
	$discount1->execute();
         $dis2 = array();
        while($dis=$discount1->fetch(PDO::FETCH_ASSOC)){
            
           foreach($dis as $dis1)
               $dis2['discount'] = number_format($dis1,2,'.',','); // display discount in 2 decimal value.
            
                $price1=$con->prepare("select sum(price) as price from tbl_order where " . $where);
	$price1->execute();
        $pri2=array();
        while($pri=$price1->fetch(PDO::FETCH_ASSOC)){
            //$row1=  array_merge($a,$row);// two array has been merge.
            
            foreach ($pri as $pri1)
                $pri2['price'] = number_format ($pri1,2,'.',',');
            $b=array("item"=>"Total");
            
            $c= array_merge($b,$pri2); // for price.
           
            $a= array_merge($c,$dis2);
            $row1= array_merge($a,$row2); // two array has been merge.
            array_push($footer,$row1);
        }
          }
        }
            
        $result["footer"] =$footer;
	
	echo json_encode($result);
