<?php
	include '../conn.php';
	
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 5000000;
	$itemid = isset($_POST['itemid']) ? $_POST['itemid'] : '';
       
	$productid = isset($_POST['productid']) ? $_POST['productid'] : '' ;
	
	   $from_date =New DateTime($_GET['from_date']);
       $from_date_f =  $from_date->format('Y-m-d 00:00:01');
        
        $to_date =New DateTime($_GET['to_date']);
      $to_date_f =  $to_date->format('Y-m-d 23:59:59');
      
	$offset = ($page-1)*$rows;
	
	$result = array();
	
	$where = " cust_id like '%$productid%' AND order_date between '$from_date_f' and '$to_date_f'  order by order_id DESC ";
	$rs =$con->prepare("select count(*) as cnt from tbl_order where " . $where);
	$rs->execute();
        while($row=$rs->fetch(PDO::FETCH_ASSOC)){
            extract($row);
           $cnt1=$cnt;
        }
        $result["total"] = $cnt1;
	$rs1 = $con->prepare("select * from tbl_order where " . $where . " limit $offset,$rows");
	$rs1->execute();
	$items = array();
	while($row =$rs1->fetch(PDO::FETCH_ASSOC)){
            
              $date=new DateTime($row['order_date']);
                $dt = $date->format('d-M-Y');
                $row['order_date'] = $dt;
                
		array_push($items, $row);
                
	}
        
	$result["rows"] = $items;
        
        // *********************rows End ***************************.
	
       $footer=array();
       
      
             $sql_amount_price=$con->prepare("Select sum(price) as price from tbl_order where ".$where." limit $offset,$rows");
        $sql_amount_price->execute();
         $sql_amount_payment=$con->prepare("Select sum(payable_amount) as payable_amount from tbl_order where ".$where." limit $offset,$rows");
        $sql_amount_payment->execute();
          $sql_amount_discount=$con->prepare("Select sum(discount_amount) as discount_amount from tbl_order where ".$where." limit $offset,$rows");
        $sql_amount_discount->execute();
     
        
            $row_price=array();
        while($row_price_amt=$sql_amount_price->fetch(PDO::FETCH_ASSOC)){
               // for 2 decimal value for price
             foreach ($row_price_amt as $row3)
             $row_price['price'] = number_format($row3,2,'.',',');
            // end 2 decimal value for price
             $row_payable_amt=array();
        while($row_payment_amt=$sql_amount_payment->fetch(PDO::FETCH_ASSOC)){
                
             // for 2 decimal value for payable_amt
             foreach ($row_payment_amt as $row2)
             $row_payable_amt['payable_amount'] = number_format($row2,2,'.',',');
            // end 2 decimal value for payable_amt
            
              $row_discount=array();
            
             
            while($row_amount_discount=$sql_amount_discount->fetch(PDO::FETCH_ASSOC)){
                
                 // for 2 decimal value for discount
                foreach ($row_amount_discount as $row2)
             $row_discount['discount_amount'] = number_format($row2,2,'.',',');
            // end 2 decimal value for discount
                
            $a= array("order_date"=>"Total Amount (TK.):");
            $b=  array_merge($a,$row_price);
            
            $c=  array_merge($b,$row_discount);
            
            $e=  array_merge($c,$row_payable_amt);
            
            array_push($footer,$e); // total query value and footer array merge.
            }
        }
        
        }
        $result['footer']=$footer;
        
	echo json_encode($result);
        