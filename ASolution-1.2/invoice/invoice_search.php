<?php
	include '../conn.php';
	
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 5000000;
	$itemid = isset($_POST['itemid']) ? $_POST['itemid'] : '';
	$productid = isset($_POST['productid']) ? $_POST['productid'] : '';
	
	$offset = ($page-1)*$rows;
	
	$result = array();
	
	//$where = " invoice_num like '%$productid%'  ";
        $where = " ( tbl_invoice.cust_id_new like '%$productid%' or tbl_invoice.invoice_id like '%$productid%' "
                . " or tbl_customer.name like '%$productid%' or tbl_invoice.order_id like '%$productid%' "
                . " or tbl_invoice.order_date like '%$productid%' or tbl_reference.ref_id like '%$productid%' ) ";
	$rs =$con->prepare("select count(*) as cnt from tbl_invoice
                inner join tbl_customer on tbl_invoice.cust_id=tbl_customer.cust_id
                inner join tbl_order on tbl_invoice.order_id=tbl_order.order_id 
                inner join tbl_reference on tbl_invoice.ref_id = tbl_reference.ref_id 
                where " . $where);
	$rs->execute();
        while($row=$rs->fetch(PDO::FETCH_ASSOC)){
            extract($row);
           $cnt1=$cnt;
        }
        $result["total"] = $cnt1;
        // row count End.
        
        
	$rs1 = $con->prepare("select *, tbl_invoice.payable_amount as payable_amt_inv from tbl_invoice
            inner join tbl_order on tbl_invoice.order_id=tbl_order.order_id 
            inner join tbl_reference on tbl_invoice.ref_id = tbl_reference.ref_id 
            inner join tbl_customer on tbl_invoice.cust_id=tbl_customer.cust_id
        where ".$where." order by tbl_invoice.invoice_id DESC limit $offset,$rows");
	$rs1->execute();
	$items = array();
	while($row =$rs1->fetch(PDO::FETCH_ASSOC)){
                
//            $row['address']=substr($row['address'],0,10).'... '; // Address will show 10 characters.
//            
                $date=new DateTime($row['invoice_date']);
                $dt = $date->format('d-M-Y');
                $row['invoice_date'] = $dt; // fomat date put $row array.

                 $date=new DateTime($row['order_date']);
                $dt = $date->format('d-M-Y');
                $row['order_date'] = $dt; // fomat date put $row array.

                  $date=new DateTime($row['pub_date']);
                $dt = $date->format('d-M-Y');
                $row['pub_date'] = $dt; // fomat date put $row array.
                
                $row['price'] = number_format($row['price'],2,'.',','); // price column number format
                $row['discount_amount'] = number_format($row['discount_amount'],2,'.',','); // discount column number format
                $row['payable_amt_inv'] = number_format($row['payable_amt_inv'],2,'.',','); // payable_amount column number format
                // paid, not paid, condition start
                $price = floatval(preg_replace('/[^\d.]/', '', $row['price']));// convert strint to double
                $discount_amount = floatval(preg_replace('/[^\d.]/', '', $row['discount_amount']));// convert string to double
                $payable_amount = floatval(preg_replace('/[^\d.]/', '', $row['payable_amt_inv']));// convert string to double
                $p= $price - $discount_amount; // substitute dis amount from price
                if($payable_amount < $p ){
                $row['status'] = 'Partially Paid';
                }
                   if($payable_amount == $p) {
                     $row['status'] = 'Not Paid';
                }
                    if($payable_amount == 0){
                     $row['status'] = 'Paid'; // $payable_amount==0
                }
                // End paid, Not Paid, Condition 

//                $row['afterDisAmt'] = $p;



//                $p=  array_merge($paid,$row);
		          array_push($items, $row);
	}
   
	$result["rows"] = $items;
        
        
        // ************************ Main Row End Now ***************************

        // ******************** For footer array Display Satart ***************************
        $footer =array();
	$price = $con->prepare("select sum(price) as price from tbl_invoice"
                . " inner join tbl_customer on tbl_invoice.cust_id=tbl_customer.cust_id
                inner join tbl_order on tbl_invoice.order_id=tbl_order.order_id 
                inner join tbl_reference on tbl_invoice.ref_id = tbl_reference.ref_id "
                . " where " . $where . " limit $offset,$rows");
	$price->execute();
            $row_price = array();
           
	while($pri =$price->fetch(PDO::FETCH_ASSOC)){
             // for 2 decimal value for price
             foreach ($pri as $row3)
             $row_price['price'] = number_format($row3,2,'.',',');
           // end 2 decimal value for price
        $discount = $con->prepare("select sum(discount_amount) as discount_amount from tbl_invoice"
                . " inner join tbl_customer on tbl_invoice.cust_id=tbl_customer.cust_id
                inner join tbl_order on tbl_invoice.order_id=tbl_order.order_id 
                inner join tbl_reference on tbl_invoice.ref_id = tbl_reference.ref_id "
                . " where " . $where . " limit $offset,$rows");
	$discount->execute();
     $row_dis = array();
      
	while($dis =$discount->fetch(PDO::FETCH_ASSOC)){
           // for 2 decimal value for price
        foreach ($dis as $row2) 
          $row_dis['discount_amount'] = number_format($row2,2,'.',',');
        
  // end 2 decimal value for price


        $payable = $con->prepare("select sum(tbl_invoice.payable_amount) as payable_amount from tbl_invoice"
               . " inner join tbl_customer on tbl_invoice.cust_id=tbl_customer.cust_id
                inner join tbl_order on tbl_invoice.order_id=tbl_order.order_id 
                inner join tbl_reference on tbl_invoice.ref_id = tbl_reference.ref_id "
                . " where " . $where . " limit $offset,$rows");
	$payable->execute();
        $row_payable = array();
          

	while($pay =$payable->fetch(PDO::FETCH_ASSOC)){ 

    

        // for 2 decimal value for price
        foreach ($pay as $row1) 
          $row_payable['payable_amount'] = number_format($row1,2,'.',',');
        
  // end 2 decimal value for price

          $price2 = floatval(preg_replace('/[^\d.]/', '', $row3));// convert strint to double of price
            $discount_amount2 =floatval(preg_replace('/[^\d.]/', '', $row2));// convert strint to double of discount_amount
            $afterDisAmt = $price2 - $discount_amount2;
            $a_dis_amt = array("afterDisAmt"=>number_format($afterDisAmt,2,'.',',') ); // display after discount amount



           $b=array("cust_id"=>"Total Amt.");
           
           
           $price1 = array_merge($b,$row_price);
           $p=  array_merge($price1,$row_payable);
           $d=  array_merge($p,$row_dis);
           $a=array_merge($d,$a_dis_amt);

           array_push($footer,$a);
        }
        
        }
        }
        $result['footer']=$footer;
        
	echo json_encode($result);
        