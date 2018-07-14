<?php
	include '../conn.php';
	
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 50000000;
	$itemid = isset($_POST['itemid']) ? $_POST['itemid'] : '';
	$productid = isset($_POST['productid']) ? $_POST['productid'] : '';
	
	$offset = ($page-1)*$rows;
	
	$result = array();
	
	//$where = "order_id like '%$productid%' or cust_id like '%$productid%' ";
        $where = "tbl_customer.cust_id_new like '%$productid%' or tbl_order.order_id like '%$productid%' or tbl_order.project_name like '%$productid%' ";
	$rs =$con->prepare("select count(*) as cnt from ((tbl_order"
               . " inner join tbl_customer on tbl_order.cust_id=tbl_customer.cust_id)"
               . " inner join tbl_reference on tbl_order.ref_id=tbl_reference.ref_id) "
                . " where " . $where);
	$rs->execute();
        while($row=$rs->fetch(PDO::FETCH_ASSOC)){
            extract($row);
           $cnt1=$cnt;
        }
        $result["total"] = $cnt1;
	$rs1 = $con->prepare("select * from ((tbl_order"
                 . " inner join tbl_customer on tbl_order.cust_id=tbl_customer.cust_id)"
                . " inner join tbl_reference on tbl_order.ref_id=tbl_reference.ref_id) "
                . " where " . $where . " order by tbl_order.order_id DESC limit $offset,$rows");
	$rs1->execute();
	$items = array();
        $total_addv_bill_footer=0;$total_vat_footer=0;$total_tax_footer=0;
        $total_payable_amt_footer=0; $total_bill_amount_after_dis_footer=0;
	while($row =$rs1->fetch(PDO::FETCH_ASSOC)){
            
             // Date format Start ******//
             
                $date=new DateTime($row['order_date']);
                $dt = $date->format('d-M-Y');
                $row['order_date'] = $dt;
                $row['name'] = $row['name'];
                $row['id_name_upaz'] = $row['cust_id_new'].', '.$row['name'].', '.$row['upazila'];
                $row['ref_id'] = $row['ref_id'];
                $row['ref_id_name_upaz'] = $row['ref_id'].', '.$row['ref_name'].', '.$row['ref_upazila'];
                // Start total bill calculation
                    $o_row = $row['o_row'];
                $o_column = $row['o_column'];
                $qty = $o_row*$o_column;
                $unit_price= $row['unit_price'];
                $gross_amount = $unit_price*$qty;
                
                $front_charge = $gross_amount*($row['front_page']/100);
                $back_charge = $gross_amount*($row['back_page']/100);
                $color_charge = $gross_amount*($row['color']/100);
                
                $total_addv_bill = ($gross_amount+$front_charge)+($back_charge+$color_charge);
                $total_addv_bill_footer += $total_addv_bill;
                $row['total_add_bill']=number_format($total_addv_bill,2,'.',',');
                $discount_charge = $total_addv_bill*($row['discount']/100);
                $total_bill_amount_after_dis = $total_addv_bill-$discount_charge;
                
                $total_bill_amount_after_dis_footer += $total_bill_amount_after_dis;
                
                $row['total_bill_after_dis'] = number_format($total_bill_amount_after_dis,2,'.',',');
                $vat_charge = $total_bill_amount_after_dis*($row['vat']/100);
                $tax_charge = $total_bill_amount_after_dis*($row['tax']/100);
                    $total_vat_footer += $vat_charge;
                    $total_tax_footer += $tax_charge;
                $total_payable_amt = $total_bill_amount_after_dis+($vat_charge+$tax_charge);
                $total_payable_amt_footer += $total_payable_amt;
            
            $row['vat_amt'] = number_format($vat_charge,2,'.',',');
            $row['tax_amt'] = number_format($tax_charge,2,'.',',');

                // End total bill calculation
            //  $row['price'] = number_format($total_bill_amount,2,'.',',');
            // End Date Format *****
            
            
		array_push($items, $row);
	}
	$result["rows"] = $items;
// ******************** row End ********************
        
        $footer=array();
        if(empty($productid)){
        $sql_amount_price=$con->prepare("Select sum(price+price*(front_page/100)+price*(back_page/100)+price*(color/100)) as price from tbl_order"
               . " inner join tbl_customer on tbl_order.cust_id=tbl_customer.cust_id "
                . " limit $offset,$rows");
        $sql_amount_price->execute();
         $sql_amount_payment=$con->prepare("Select sum(payable_amount) as payable_amount from tbl_order"
                 . " inner join tbl_customer on tbl_order.cust_id=tbl_customer.cust_id "
                 . " limit $offset,$rows");
        $sql_amount_payment->execute();
         $sql_amount_discount=$con->prepare("Select sum(discount_amount) as discount_amount from tbl_order"
                 . " inner join tbl_customer on tbl_order.cust_id=tbl_customer.cust_id "
                 . " limit $offset,$rows");
        $sql_amount_discount->execute();
        } // For searching when search box is empty.
        if(!empty($productid)){
             $sql_amount_price=$con->prepare("Select sum(price+price*(front_page/100)+price*(back_page/100)+price*(color/100)) as price from tbl_order"
                     . " inner join tbl_customer on tbl_order.cust_id=tbl_customer.cust_id "
                     . " where ".$where." limit $offset,$rows");
        $sql_amount_price->execute();
         $sql_amount_payment=$con->prepare("Select sum(payable_amount) as payable_amount from tbl_order"
                . " inner join tbl_customer on tbl_order.cust_id=tbl_customer.cust_id "
                 . " where ".$where." limit $offset,$rows");
        $sql_amount_payment->execute();
          $sql_amount_discount=$con->prepare("Select sum(discount_amount) as discount_amount from tbl_order"
                 . " inner join tbl_customer on tbl_order.cust_id=tbl_customer.cust_id "
                  . " where ".$where." limit $offset,$rows");
        $sql_amount_discount->execute();
        } // For searching when search box is not empty.
        
            $row_price=array();
        while($row_price_amt=$sql_amount_price->fetch(PDO::FETCH_ASSOC)){
               // for 2 decimal value for price
             foreach ($row_price_amt as $row3)
           // $row_price['price'] = number_format($row3,2,'.',',');
                 $total_add_bill = $row3;
            $row_price['total_add_bill'] = '<b>'.number_format($row3,2,'.',',').'</b>';
            $row_price['vat_amt'] = number_format($total_vat_footer,2,'.',',');
            $row_price['tax_amt'] = number_format($total_tax_footer,2,'.',',');
        
            // end 2 decimal value for price
             $row_payable_amt=array();
        while($row_payment_amt=$sql_amount_payment->fetch(PDO::FETCH_ASSOC)){
                
             // for 2 decimal value for payable_amt
             foreach ($row_payment_amt as $row2)
            // $row_payable_amt['payable_amount'] = number_format($row2,2,'.',',');
        
        $row_payable_amt['payable_amount'] = '<b>'.number_format($row2,2,'.',',').'</b>'; 
            // end 2 decimal value for payable_amt
            
              $row_discount=array();
            
            while($row_amount_discount=$sql_amount_discount->fetch(PDO::FETCH_ASSOC)){
                
                 // for 2 decimal value for discount
                foreach ($row_amount_discount as $row2)
             $row_discount['discount_amount'] = number_format($row2,2,'.',',');
            // end 2 decimal value for discount
                $total_dis_amt = $row2;
                    $total_addv_bill_after_dis = $total_add_bill-$total_dis_amt;
            $row_price['total_bill_after_dis'] = '<b>'.number_format($total_addv_bill_after_dis,2,'.',',').'</b>';
            
            $a= array("order_date"=>"Total Amt. (Tk.):");
            $b=  array_merge($a,$row_price);
            
            $c=  array_merge($b,$row_discount);
            
            $e=  array_merge($c,$row_payable_amt);
            
            array_push($footer,$e); // total query value and footer array merge.
            }
        }
        
        }
        $result['footer']=$footer;
        
	echo json_encode($result);
        