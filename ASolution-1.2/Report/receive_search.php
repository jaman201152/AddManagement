<?php
	include '../conn.php';
	
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 5000000;
	$itemid = isset($_POST['itemid']) ? $_POST['itemid'] : '';
	$productid = isset($_POST['productid']) ? $_POST['productid'] : '';
	
	$offset = ($page-1)*$rows;
	
	$result = array();

    $today = isset($_GET['q']) ? $_GET['q'] : ''; // for today
        
    $fromWeekDate = isset($_GET['fromWeekDate']) ? $_GET['fromWeekDate'] : ''; // for cur week
    $toWeekDate = isset($_GET['toWeekDate']) ? $_GET['toWeekDate'] : '';    // for cur week
      
    $fromlastWeekDate = isset($_GET['fromlastWeekDate']) ? $_GET['fromlastWeekDate'] : ''; // for cur week
    $tolastWeekDate = isset($_GET['tolastWeekDate']) ? $_GET['tolastWeekDate'] : '';    // for cur week
    
    $firstDayOfMonth = isset($_GET['firstDayOfMonth']) ? $_GET['firstDayOfMonth'] : ''; // for current month
    $lastDayOfMonth = isset($_GET['lastDayOfMonth']) ? $_GET['lastDayOfMonth'] : ''; // for current month
    
    $firstDayOfPreMonth = isset($_GET['firstDayOfPreMonth']) ? $_GET['firstDayOfPreMonth'] : ''; // for last month
    $lastDayOfPreMonth = isset($_GET['lastDayOfPreMonth']) ? $_GET['lastDayOfPreMonth'] : ''; // for last month
    
	$all = isset($_GET['all']) ? $_GET['all'] : ''; // for today

	
        if(!empty($today)){
            $where = "(payment_id like '%$productid%' or cust_id like '%$productid%')
                 and payment_date like '$today%' ";
        }
            
        if ( !empty($fromWeekDate) && !empty($toWeekDate) ) {
              $where = "(payment_id like '%$productid%' or cust_id like '%$productid%')
                 and payment_date between '$fromWeekDate%' and '$toWeekDate%' ";
        }
        
              if ( !empty($fromlastWeekDate) && !empty($tolastWeekDate) ) {
              $where = "(payment_id like '%$productid%' or cust_id like '%$productid%')
                 and payment_date between '$fromlastWeekDate%' and '$tolastWeekDate%' ";
        }

         if ( !empty($firstDayOfMonth) && !empty($lastDayOfMonth) ) {
              $where = "(payment_id like '%$productid%' or cust_id like '%$productid%')
                 and payment_date between '$firstDayOfMonth%' and '$lastDayOfMonth%' ";
        }
        if ( !empty($firstDayOfPreMonth) && !empty($lastDayOfPreMonth) ) {
              $where = "(payment_id like '%$productid%' or cust_id like '%$productid%')
                 and payment_date between '$firstDayOfPreMonth%' and '$lastDayOfPreMonth%' ";
        }
        
        if(!empty($all)){
            $where = "(payment_id like '%$productid%' or cust_id like '%$productid%')";
        }
        
	// $where = "payment_id like '%$productid%' or cust_id like '%$productid%' ";
	$rs =$con->prepare("select count(*) as cnt from tbl_payment where " . $where);
	$rs->execute();
        while($row=$rs->fetch(PDO::FETCH_ASSOC)){
            extract($row);
           $cnt1=$cnt;
        }
        $result["total"] = $cnt1;
	$rs1 = $con->prepare("select * from tbl_payment where " . $where . " order by payment_id DESC limit $offset,$rows");
	$rs1->execute();
	$items = array();
	while($row =$rs1->fetch(PDO::FETCH_ASSOC)){
		array_push($items, $row);
	}
	$result["rows"] = $items;
// ******************** row End ********************
        $footer=array();
        if(empty($productid)){
      
         $sql_amount_payment=$con->prepare("Select sum(payable_amount) as payable_amount from tbl_payment limit $offset,$rows");
        $sql_amount_payment->execute();

          $sql_amount_receive=$con->prepare("Select sum(receive_amount) as receive_amount from tbl_payment limit $offset,$rows");
        $sql_amount_receive->execute();

         $sql_amount_discount=$con->prepare("Select sum(due) as due from tbl_payment limit $offset,$rows");
        $sql_amount_discount->execute();
        } // For searching when search box is empty.
        if(!empty($productid)){
         
         $sql_amount_payment=$con->prepare("Select sum(payable_amount) as payable_amount from tbl_payment where ".$where." limit $offset,$rows");
        $sql_amount_payment->execute();

        $sql_amount_receive=$con->prepare("Select sum(receive_amount) as receive_amount from tbl_payment where ".$where." limit $offset,$rows");
        $sql_amount_receive->execute();

        $sql_amount_discount=$con->prepare("Select sum(due) as due from tbl_payment where ".$where." limit $offset,$rows");
        $sql_amount_discount->execute();
        } // For searching when search box is not empty.
        
            $row_receive=array();
        while($row_receive_amt=$sql_amount_receive->fetch(PDO::FETCH_ASSOC)){
               // for 2 decimal value for receive
             foreach ($row_receive_amt as $row3)
             $row_receive['receive_amount'] = number_format($row3,2,'.',',');
            // end 2 decimal value for receive
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
             $row_discount['due'] = number_format($row2,2,'.',',');
            // end 2 decimal value for discount
                
            $a= array("payment_date"=>"Total Amount (TK.):");
            $b=  array_merge($a,$row_receive);
            
            $c=  array_merge($b,$row_discount);
            
            $e=  array_merge($c,$row_payable_amt);
            array_push($footer,$e); // total query value and footer array merge.
            }
        }
        
        }
        $result['footer']=$footer;
        
	echo json_encode($result);
        