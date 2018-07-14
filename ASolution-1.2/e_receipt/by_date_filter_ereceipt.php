<?php
	include '../conn.php';
	
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 500000;
	$itemid = isset($_POST['itemid']) ? $_POST['itemid'] : '';
       
	$productid = isset($_POST['productid']) ? $_POST['productid'] : '' ;
	
	   $from_date =New DateTime($_GET['from_date']);
       $from_date_f =  $from_date->format('Y-m-d 00:00:01');
        
        $to_date =New DateTime($_GET['to_date']);
      $to_date_f =  $to_date->format('Y-m-d 23:59:59');
      
	$offset = ($page-1)*$rows;
	
	$result = array();
	
	$where = " cust_id like '%$productid%' AND payment_date between '$from_date_f' and '$to_date_f'  order by memo_id DESC ";
	$rs =$con->prepare("select count(*) as cnt from tbl_ememo where " . $where);
	$rs->execute();
        while($row=$rs->fetch(PDO::FETCH_ASSOC)){
            extract($row);
           $cnt1=$cnt;
        }
        $result["total"] = $cnt1;
	$rs1 = $con->prepare("select * from tbl_ememo where " . $where . " limit $offset,$rows");
	$rs1->execute();
	$items = array();
	while($row =$rs1->fetch(PDO::FETCH_ASSOC)){
            
               $date=new DateTime($row['payment_date']);
                $dt = $date->format('d-M-Y');
                $row['payment_date'] = $dt; // fomat date put $row array.
		array_push($items, $row);
                
	}
        
	$result["rows"] = $items;
        
        // *********************rows End ***************************.
	
        $footer = array() ;
        
                $payable_amount1=$con->prepare("select sum(payable_amount) as payable_amount from tbl_ememo where " . $where);
	$payable_amount1->execute();
        while($row=$payable_amount1->fetch(PDO::FETCH_ASSOC)){
              
             $discount1=$con->prepare("select sum(paid_amount) as paid_amount from tbl_ememo where " . $where);
	$discount1->execute();
        while($dis=$discount1->fetch(PDO::FETCH_ASSOC)){
            
                $price1=$con->prepare("select sum(receive_amount) as receive_amount from tbl_ememo where " . $where);
	$price1->execute();
        while($pri=$price1->fetch(PDO::FETCH_ASSOC)){
            //$row1=  array_merge($a,$row);// two array has been merge.
            $pri['receive_amount'] = number_format($pri['receive_amount'],2,'.',',');// Total Price Calculate
            $b=array("payment_date"=>"Total (Tk.)"); // under unit_price column displa total (Tk.)
            $c=array_merge($b,$pri); // for price.
            $dis['paid_amount'] = number_format($dis['paid_amount'],2,'.',','); // Total discount Calculate
            $a=array_merge($c,$dis); // array merge with discount.
            $row['payable_amount'] = number_format($row['payable_amount'],2,'.',','); // total payable amount calculate
            $row1=  array_merge($a,$row); // two array has been merge.
            array_push($footer,$row1);
        }
          }
        }
        
         $result["footer"] =$footer;
        
	echo json_encode($result);