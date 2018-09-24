<?php
	include '../conn.php';
	
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 5000000;
	$itemid = isset($_POST['itemid']) ? $_POST['itemid'] : '';
        $q=$_GET['invoice_q'];

	$productid = isset($_POST['productid']) ? $_POST['productid'] : $q;
	
	$offset = ($page-1)*$rows;
	
	$result = array();
	
	$where = " tbl_invoice.invoice_id like '$productid%' and tbl_invoice.cust_id like '$q' ";
	$rs =$con->prepare("select count(*) as cnt from tbl_invoice"
                . " inner join tbl_customer on tbl_invoice.cust_id=tbl_customer.cust_id
                inner join tbl_order on tbl_invoice.order_id=tbl_order.order_id 
                inner join tbl_reference on tbl_invoice.ref_id = tbl_reference.ref_id "
                . " where " . $where);
	$rs->execute();
        while($row=$rs->fetch(PDO::FETCH_ASSOC)){
            extract($row);
        }
        $result["total"] = $cnt;// Row Count End.
        
	$rs1 = $con->prepare("select *, tbl_invoice.payable_amount as payable_amt_inv from tbl_invoice"
                . "   inner join tbl_customer on tbl_invoice.cust_id=tbl_customer.cust_id
                inner join tbl_order on tbl_invoice.order_id=tbl_order.order_id 
                inner join tbl_reference on tbl_invoice.ref_id = tbl_reference.ref_id "
                . " where " . $where . " order by tbl_invoice.invoice_id DESC limit $offset,$rows");
	$rs1->execute();
	$items = array();
    $size = array();
	while($row =$rs1->fetch(PDO::FETCH_ASSOC)){
            //extract($row);
                  $date=new DateTime($row['order_date']);
                $dt = $date->format('d-M-Y');
                $row['order_date'] = $dt; // fomat date put $row array.

                $p_date = new DateTime($row['pub_date']);
                $p_dt = $p_date->format('d-M-Y');
                $row['pub_date'] =$p_dt;

                 $i_date = new DateTime($row['invoice_date']);
                $i_dt = $i_date->format('d-M-Y');
                $row['invoice_date'] =$i_dt;
                $price = floatval(preg_replace('/[^\d.]/', '', $row['price']));// convert strint to double
                $front_page= floatval(preg_replace('/[^\d.]/', '', $row['front_page']));
                $back_page= floatval(preg_replace('/[^\d.]/', '', $row['back_page']));
                $color_page= floatval(preg_replace('/[^\d.]/', '', $row['color']));
                $vat= floatval(preg_replace('/[^\d.]/', '', $row['vat']));
                $tax= floatval(preg_replace('/[^\d.]/', '', $row['tax']));
                $discount_amount = floatval(preg_replace('/[^\d.]/', '', $row['discount_amount']));// convert string to double
                $payable_amount = floatval(preg_replace('/[^\d.]/', '', $row['payable_amt_inv']));// convert string to double
                
                $row['price'] = number_format($row['price'],2,'.',','); // price column number format
                $row['discount_amount'] = number_format($row['discount_amount'],2,'.',','); // discount column number format

                $total_add_bill = $price + ($price*$front_page/100) + ($price*$back_page/100) + ($price*$color_page/100);
                $total_bill_after_dis = $total_add_bill - $discount_amount; // substitute dis amount from price
                $total_bill_amount = $total_bill_after_dis + ($total_bill_after_dis*$vat/100) + ($total_bill_after_dis*$tax/100);
                $total_bill = floatval($total_bill_amount);    
                $row['payable_amt_inv'] = number_format($payable_amount,2,'.',','); // payable_amount column number format
            
                

            // paid, not paid, condition start
                if($payable_amount < $total_bill && $payable_amount != 0 ){
                $row['status'] = 'Partially Paid';
                }
                elseif($payable_amount == $total_bill) {
                     $row['status'] = 'Not Paid';
                }
                elseif($payable_amount == 0){
                     $row['status'] = 'Paid'; // $payable_amount==0
                }
                else{
                     $row['status'] = ""; // $payable_amount==0
                }
                
               
                
//                if($p > $payable_amount){
//                    $row['status'] = 'Partially Paid';
//                }
//                if($payable_amount == 0){
//                    $row['status'] = 'Paid'; //$payable_amount === 0.00
//                }
                
                // paid, not paid, condition End
            $size['size'] = $row['o_row'] * $row['o_column'];
             $cust_invoice= array_merge($row,$size); // two array has been merge.
		array_push($items, $cust_invoice);
                
	} // invoice table while loop end.
	$result["rows"] = $items;
// *********************rows End ***************************.
        
        $footer=array();
        
        $payable_amount1=$con->prepare("select sum(tbl_invoice.payable_amount) as payable_amount from tbl_invoice"
                . " inner join tbl_customer on tbl_invoice.cust_id=tbl_customer.cust_id
                inner join tbl_order on tbl_invoice.order_id=tbl_order.order_id 
                inner join tbl_reference on tbl_invoice.ref_id = tbl_reference.ref_id "
                . " where " . $where);
	$payable_amount1->execute();
        while($row=$payable_amount1->fetch(PDO::FETCH_ASSOC)){
              
             $discount1=$con->prepare("select sum(discount_amount) as discount_amount from tbl_invoice"
                     . " inner join tbl_customer on tbl_invoice.cust_id=tbl_customer.cust_id
                inner join tbl_order on tbl_invoice.order_id=tbl_order.order_id 
                inner join tbl_reference on tbl_invoice.ref_id = tbl_reference.ref_id "
                     . " where " . $where);
	$discount1->execute();
        while($dis=$discount1->fetch(PDO::FETCH_ASSOC)){
            
                $price1=$con->prepare("select sum(price) as price from tbl_invoice"
                        . " inner join tbl_customer on tbl_invoice.cust_id=tbl_customer.cust_id
                inner join tbl_order on tbl_invoice.order_id=tbl_order.order_id 
                inner join tbl_reference on tbl_invoice.ref_id = tbl_reference.ref_id "
                        . " where " . $where);
	$price1->execute();
        while($pri=$price1->fetch(PDO::FETCH_ASSOC)){
            //$row1=  array_merge($a,$row);// two array has been merge.
            $pri['price'] = number_format($pri['price'],2,'.',',');// Total Price Calculate
            $b=array("size"=>"Total Amt."); // under unit_price column displa total (Tk.)
            $c=array_merge($b,$pri); // for price.
            $dis['discount_amount'] = number_format($dis['discount_amount'],2,'.',','); // Total discount Calculate
            $a=array_merge($c,$dis); // array merge with discount.
            

            $row['payable_amount'] = number_format($row['payable_amount'],2,'.',','); // total payable amount calculate
            $row1=  array_merge($a,$row); // two array has been merge.
            array_push($footer,$row1);
        }
          }
        }
            
        $result["footer"] =$footer;  // $footer is the element of $result array 
	
	echo json_encode($result);
