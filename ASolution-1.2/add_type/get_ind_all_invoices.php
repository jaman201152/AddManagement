<?php
	include '../conn.php';
	
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 5000000;
	$itemid = isset($_POST['itemid']) ? $_POST['itemid'] : '';
        $q=$_GET['invoice_q'];

	$productid = isset($_POST['productid']) ? $_POST['productid'] : $q;
	
	$offset = ($page-1)*$rows;
	
	$result = array();
	
	$where = " tbl_payment.payment_id like '$productid%' and tbl_reference.ref_id like '$q' ";
	$rs =$con->prepare("select count(*) as cnt from tbl_payment"
                . " inner join tbl_reference on tbl_payment.ref_id=tbl_reference.ref_id "
                . " where " . $where);
	$rs->execute();
        while($row=$rs->fetch(PDO::FETCH_ASSOC)){
            extract($row);
        }
        $result["total"] = $cnt;// Row Count End.
        
	$rs1 = $con->prepare("select * from tbl_payment"
                . " inner join tbl_reference on tbl_payment.ref_id = tbl_reference.ref_id"
                . " where " . $where . " order by payment_id DESC limit $offset,$rows");
	$rs1->execute();
	$items = array();
    $size = array();
    $total_commission=0;
	while($row =$rs1->fetch(PDO::FETCH_ASSOC)){
            //extract($row);
                //   $date=new DateTime($row['order_date']);
                // $dt = $date->format('d-M-Y');
                // $row['order_date'] = $dt; // fomat date put $row array.
                
            


                 $i_date = new DateTime($row['payment_date']);
                $i_dt = $i_date->format('d-M-Y');
                $row['payment_date'] =$i_dt;

                $row['receive_amount'] = number_format($row['receive_amount'],2,'.',','); // discount column number format
                $row['payable_amount'] = number_format($row['payable_amount'],2,'.',','); // payable_amount column number format
                // paid, not paid, condition start
                $receive_amount = floatval(preg_replace('/[^\d.]/', '', $row['receive_amount']));// convert string to double
                $payable_amount = floatval(preg_replace('/[^\d.]/', '', $row['payable_amount']));// convert string to double
                $p= $payable_amount - $receive_amount; // substitute dis amount from price
                    if($payable_amount < $p ){
                $row['status'] = 'Partially Paid';
                }
                   if($payable_amount == $p) {
                     $row['status'] = 'Paid';
                }

                $commission = floatval(preg_replace('/[^\d.]/', '', $row['commission']));
                $commission_amount =$receive_amount*($commission/100);
                $total_commission += $commission_amount;
                $row['commission_amount'] = number_format($commission_amount,2,'.',',');
                


		array_push($items, $row);

	} // invoice table while loop end.
	$result["rows"] = $items;
// *********************rows End ***************************.

        $footer=array();

        $payable_amount1=$con->prepare("select sum(payable_amount) as payable_amount from tbl_payment"
                . " inner join tbl_reference on tbl_payment.ref_id=tbl_reference.ref_id where " . $where);
	$payable_amount1->execute();
        while($row=$payable_amount1->fetch(PDO::FETCH_ASSOC)){
            
             $discount1=$con->prepare("select sum(receive_amount) as receive_amount from tbl_payment"
                     . " inner join tbl_reference on tbl_payment.ref_id=tbl_reference.ref_id where " . $where);
	$discount1->execute();
        while($dis=$discount1->fetch(PDO::FETCH_ASSOC)){
            
            
            //$row1=  array_merge($a,$row);// two array has been merge.
            $b=array("name"=>"Total Amt."); // under unit_price column displa total (Tk.)

            $dis['receive_amount'] = number_format($dis['receive_amount'],2,'.',','); // Total discount Calculate
            $a=array_merge($b,$dis); // array merge with discount.
            

            $row['payable_amount'] = number_format($row['payable_amount'],2,'.',','); // total payable amount calculate
            $row['commission_amount'] =number_format($total_commission,2,'.',',');
            $row['payment_date'] = 'Total:';
            $row1=  array_merge($a,$row); // two array has been merge.

            array_push($footer,$row1);
        
          }
        }
            
        $result["footer"] =$footer;  // $footer is the element of $result array 
	
	echo json_encode($result);
