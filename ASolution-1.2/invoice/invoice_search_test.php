<?php
	include '../conn.php';
	
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 5000000;
	$itemid = isset($_POST['itemid']) ? $_POST['itemid'] : '';
	$productid = isset($_POST['productid']) ? $_POST['productid'] : '';
	
	$offset = ($page-1)*$rows;
	
	$result = array();
	
	//$where = " invoice_num like '%$productid%'  ";
        $where = " cust_id like '%$productid%'  ";
	$rs =$con->prepare("select count(*) as cnt from tbl_invoice where " . $where);
	$rs->execute();
        while($row=$rs->fetch(PDO::FETCH_ASSOC)){
            extract($row);
           $cnt1=$cnt;
        }
        $result["total"] = $cnt1;
        // row count End.
        
        
           $sql_paid = $con->prepare("select sum(receive_amount) as receive_amount from tbl_payment where " . $where . " limit $offset,$rows");
	$sql_paid->execute();
	while($paid =$sql_paid->fetch(PDO::FETCH_ASSOC)){
            
	$rs1 = $con->prepare("select * from tbl_invoice where " . $where . " order by invoice_id DESC limit $offset,$rows");
	$rs1->execute();
	$items = array();
	while($row =$rs1->fetch(PDO::FETCH_ASSOC)){
                
            $row['address']=substr($row['address'],0,10).'... '; // Address will show 10 characters.
            
                $date=new DateTime($row['invoice_date']);
                $dt = $date->format('d-M-Y');
                $row['invoice_date'] = $dt; // fomat date put $row array.
                
                $p=  array_merge($paid,$row);
		array_push($items, $p);
	}
        }
	$result["rows"] = $items;
        
        
        // ************************ Main Row End Now ***************************
        // ******************** For footer array Display Satart ***************************
        $footer =array();
	$price = $con->prepare("select sum(price) as price from tbl_invoice where " . $where . " limit $offset,$rows");
	$price->execute();
            $row_price = array();
           
	while($pri =$price->fetch(PDO::FETCH_ASSOC)){
             // for 2 decimal value for price
             foreach ($pri as $row3)
             $row_price['price'] = number_format($row3,2,'.',',');
           // end 2 decimal value for price
        $discount = $con->prepare("select sum(discount_amount) as discount_amount from tbl_invoice where " . $where . " limit $offset,$rows");
	$discount->execute();
     $row_dis = array();
      
	while($dis =$discount->fetch(PDO::FETCH_ASSOC)){
           // for 2 decimal value for price
        foreach ($dis as $row2) 
          $row_dis['discount_amount'] = number_format($row2,2,'.',',');
        
  // end 2 decimal value for price


        $payable = $con->prepare("select sum(payable_amount) as payable_amount from tbl_invoice where " . $where . " limit $offset,$rows");
	$payable->execute();
        $row_payable = array();
   
         $sql_paid = $con->prepare("select sum(receive_amount) as receive_amount from tbl_payment where " . $where . " limit $offset,$rows");
	$sql_paid->execute();
	while($paid =$sql_paid->fetch(PDO::FETCH_ASSOC)){
          

	while($pay =$payable->fetch(PDO::FETCH_ASSOC)){ 

        // for 2 decimal value for price
        foreach ($pay as $row1) 
          $row_payable['payable_amount'] = number_format($row1,2,'.',',');
        
  // end 2 decimal value for price

           $b=array("order_id"=>"Total:");
           
          
           $price1 = array_merge($b,$row_price);
           $paid=  array_merge($price1,$paid);
           $p=  array_merge($paid,$row_payable);
           $d=  array_merge($p,$row_dis);
           $a=array_merge($d);
           array_push($footer,$a);
        }
        }
        }
        }
        $result['footer']=$footer;
        
	echo json_encode($result);
        