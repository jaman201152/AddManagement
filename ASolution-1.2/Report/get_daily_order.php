<?php
	include '../conn.php';
	
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	$itemid = isset($_POST['itemid']) ? $_POST['itemid'] : '';
	$productid = isset($_POST['productid']) ? $_POST['productid'] : '';
	
	$offset = ($page-1)*$rows;
	
	$result = array();
	$today= $_GET['qa'];
        //$today = '2016-05-08';
        
        
	$where = "order_date like '$today%' or cust_id like '$today%' ";
	$rs =$con->prepare("select count(*) as cnt from tbl_order where " . $where);
	$rs->execute();
        while($row=$rs->fetch(PDO::FETCH_ASSOC)){
            extract($row);
           $cnt1=$cnt;
        }
        $result["total"] = $cnt1;
	$rs1 = $con->prepare("select * from tbl_order where " . $where . " order by order_id DESC limit $offset,$rows");
	$rs1->execute();
	$items = array();
	while($row =$rs1->fetch(PDO::FETCH_ASSOC)){
		array_push($items, $row);
	}
	$result["rows"] = $items;
// ******************** row End ********************
        $footer=array();
        if(empty($productid)){
        $sql_amount_price=$con->prepare("Select sum(price) as price from tbl_order limit $offset,$rows");
        $sql_amount_price->execute();
         $sql_amount_payment=$con->prepare("Select sum(payable_amount) as payable_amount from tbl_order limit $offset,$rows");
        $sql_amount_payment->execute();
         $sql_amount_discount=$con->prepare("Select sum(discount) as discount from tbl_order limit $offset,$rows");
        $sql_amount_discount->execute();
        } // For searching when search box is empty.
        if(!empty($productid)){
             $sql_amount_price=$con->prepare("Select sum(price) as price from tbl_order where ".$where." limit $offset,$rows");
        $sql_amount_price->execute();
         $sql_amount_payment=$con->prepare("Select sum(payable_amount) as payable_amount from tbl_order where ".$where." limit $offset,$rows");
        $sql_amount_payment->execute();
          $sql_amount_discount=$con->prepare("Select sum(discount) as discount from tbl_order where ".$where." limit $offset,$rows");
        $sql_amount_discount->execute();
        } // For searching when search box is not empty.
        
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
             $row_discount['discount'] = number_format($row2,2,'.',',');
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
        
        