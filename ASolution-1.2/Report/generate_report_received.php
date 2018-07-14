
<?php
	include '../conn.php';

	 
    $head = $_GET['head'];

	   $from_date =New DateTime($_GET['from_date']);
       $from_date_f =  $from_date->format('Y-m-d 00:00:01');
        
       $to_date =New DateTime($_GET['to_date']);
       $to_date_f =  $to_date->format('Y-m-d 23:59:59');



	//$where = " cust_id like '%$productid%' AND invoice_date between '$from_date_f' and '$to_date_f'  order by invoice_id DESC ";
    $join_query = " Select p.cust_id,p.cust_id_new,i.order_id,p.invoice_num,i.pub_date,
                    p.payment_id,p.payment_date,p.name,p.payable_amount,p.receive_amount,
                    p.due, i.order_date, i.invoice_date, i.ref_name,i.price, i.discount, i.discount_amount
                    from tbl_invoice i inner join tbl_payment p
                    on i.invoice_id=p.invoice_num where p.payment_date between '$from_date_f' and '$to_date_f' " ; // Join Two table tbl_invoice and tbl_payment

	$rs1 = $con->prepare(" ".$join_query." ");
	$rs1->execute();

?>

<div class="container">
  <div class="row">
    <div class="col-xs-12">
      <div class="table-responsive">
        <table summary="" class="table table-bordered table-hover">
            <caption class="text-center" style="font-size: 14px;">
            <h3>The Asian Age Join</h3>
             <b><q><i><?php echo strtoupper($head);?></i></q></b> Details- On <i><strong>Pyament</strong></i> from    <?php
            $date=new DateTime($_GET['from_date']);
            $dt_from = $date->format('d-M-Y'); 
            
             $date_to=new DateTime($_GET['to_date']);
            $dt_to = $date_to->format('d-M-Y');
            echo '<span style="color:#4B2D73;"><b>'.$dt_from. '</b> to <b>' .$dt_to.'</b></span>'; ?>
            </caption> <!-- Table Caption End -->
          
               <thead>
               <th>Serial No.</th>
            <th>Cust. Id.</th>
            <th>Bill No.</th>
            <th>O. Id.</th>
            <th width="70">Pub. Date</th>
            <th width="60">Inv. Date</th>
            <th>Inv. Num.</th>
            <th>Ref. Name</th>
            
              <th>Amount</th>
              <th>Com. (%)</th>
              <th>Com. Amt.</th>
              <th>Receivable Amt.</th>
              <th>Received Amt.</th>
              <th>Due</th>
              <th>Status</th>
            
            </thead>
           <tbody>

<?php
  $serial = 1;
	while($row =$rs1->fetch(PDO::FETCH_ASSOC)){


    ?>

<tr>
  <td><?php echo $serial++;?></td>
  <td><?php echo $row['cust_id_new'];?></td>
   <td><?php echo $row['payment_id'];?></td>
  <td><?php echo $row['order_id'];?></td>

    <td width="60">
    <?php

            $date_pub = new DateTime($row['pub_date']);
                $dt2 = $date_pub->format('d-M-y');
             echo $row['pub_date'] = $dt2;
    ?>
  </td>


  <td width="60">
     <?php $date_invoice = new DateTime($row['invoice_date']);
                $dt1 = $date_invoice->format('d-M-y');
             echo  $row['invoice_date'] = $dt1; ?>
  </td>

   <td><?php echo $row['invoice_num'];?></td>
  <td><?php echo $row['ref_name'];?></td>

  <td align="right"><?php echo $row['price'];?></td>

 
  <td align="right"><?php echo $row['discount'];?></td>
    <td align="right"><?php echo $row['discount_amount'];?></td>
    <td align="right"><?php echo $row['payable_amount'];?></td>
    <td align="right"><?php echo $row['receive_amount'];?></td>
    <td align="right"><?php echo $row['due'];?></td>
    <td>
          <?php
                        if($row['payable_amount'] > $row['receive_amount']) {
                           echo "<span>Partially Paid</span>";
                        }
                        else if($row['payable_amount'] === $row['receive_amount']) {
                          echo "<span>Paid</span>";
                        }
                        else{
                           echo "<span> Not Paid</span>";
                        }

                        ?>
    </td>

</tr>

            


                  


<?php

/*
  $row['price'] = number_format($row['price'],2,'.',','); // price column number format
                $row['discount_amount'] = number_format($row['discount_amount'],2,'.',','); // discount column number format
                $row['payable_amount'] = number_format($row['payable_amount'],2,'.',','); // payable_amount column number format
                // paid, not paid, condition start
                $price = floatval(preg_replace('/[^\d.]/', '', $row['price']));// convert strint to double
                $discount_amount = floatval(preg_replace('/[^\d.]/', '', $row['discount_amount']));// convert string to double
                $payable_amount = floatval(preg_replace('/[^\d.]/', '', $row['payable_amount']));// convert string to double
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
*/



                
	}
    ?>

 </tbody>
        
        
        </table>
      </div><!--end of .table-responsive-->
    </div>
  </div>
</div>



    <!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Orders by date Info</title>
         <meta name="viewport" content="width=device-width, initial-scale=1">
<link type="text/css" rel="stylesheet" href="Report/css/print.css">
        <style>
 

table caption {
    padding: .5em 0; 
}

@media screen and (max-width: 767px) {
  table caption {
    border-bottom: 1px dashed #ddd;
    
  }
}

.p {
  text-align: center;
  padding-top: 140px;
  font-size: 14px;
}
table{border-collapse: collapse; font-family: arial, "lucida console", serif; font-size:11px; }
table, th{ border:1px #ccc dashed;  padding:8px 4px; }

table, tr, td{ border:1px #ccc dashed; padding:3px 3px;}
        </style>
    </head>
    <body>
        <?php
       
         include '../conn.php';
         
        
     $head = $_GET['head']; 
        
      $from_date =New DateTime($_GET['from_date']);
       $from_date_f =  $from_date->format('Y-m-d 00:00:01');
        
        $to_date =New DateTime($_GET['to_date']);
      $to_date_f =  $to_date->format('Y-m-d 23:59:59');
      
        $sql = $con->prepare("Select * from tbl_invoice where invoice_date between '$from_date_f' and '$to_date_f' ");
        $sql->execute();
       
           ?>
    
      
      

<div class="container">
  <div class="row">
    <div class="col-xs-12">
      <div class="table-responsive">
        <table summary="" class="table table-bordered table-hover">
            <caption class="text-center" style="font-size: 14px;">
            <h3>The Asian Age</h3>
             <b><q><i><?php echo strtoupper($head);?></i></q></b> Details- from    <?php
            $date=new DateTime($_GET['from_date']);
            $dt_from = $date->format('d-M-Y'); 
            
             $date_to=new DateTime($_GET['to_date']);
            $dt_to = $date_to->format('d-M-Y');
            echo '<span style="color:#4B2D73;"><b>'.$dt_from. '</b> to <b>' .$dt_to.'</b></span>'; ?>
            </caption> <!-- Table Caption End -->
          
               <thead>
            <th>Cust. Id.</th>
             <th>O. Id.</th>
             <th>Pub. Date</th>
             <th>Bill. No.</th><!-- This number is Invoice Number -->
             <th>Ref. Name</th>
              <th>O. Date</th>
              <th>Total Amt.</th>
              <th>Com. (%)</th>
              <th>Com. Amt.</th>
              <th>Receivable Amt.</th>
              <th>Received Amt.</th>
              <th>Due Amt.</th>
              <th>Status</th>
            
            </thead>
           <tbody>
                  <?php
                  $total_price=0;
                  $total_dis_amt=0;
                  $total_receivable_amt = 0;
                  $receivable_amt = 0;
                  $total_received_amt = 0;
                  $received_amt = 0;
                   while($row=$sql->fetch(PDO::FETCH_ASSOC)){
            extract($row);
                  ?>
                  <tr >
                      <td><?php echo $cust_id_new;?></td>
                       <td><?php echo $order_id;?></td>
                        <td width="60" align="center"><?php $date = new DateTime($pub_date); $dt= $date->format("d-M-y"); echo $dt;?></td>
                       <td><?php echo $invoice_num;?></td>
                        <td><?php echo $ref_name?></td>
                        <td align="center" width="60"><?php   $date=new DateTime($order_date);
                $dt = $date->format('d-M-y'); echo $dt;?></td>
                        <td  align="right"><?php $total_price +=$price; echo $price;?></td>
                        <td align="right"><?php echo $discount;?></td>
                         <td align="right"><?php $total_dis_amt += $discount_amount; echo number_format($discount_amount,2,'.',',')?></td>
                         <td align="right">
                            <?php
                            $receivable_amt_col = $payable_amount;

                              $receivable_amt += $receivable_amt_col;
                               echo  $receivable_amt_col;
                            ?>
                         </td>
                         <td align="right">
                              <?php 
                              $received_amt = ($price - $discount_amount) - $payable_amount;
                              $total_received_amt +=$received_amt;
                              echo $received_amt;?>
                         </td>
                        <td align="right">
                        <?php $total_receivable_amt +=$payable_amount;
                         echo $payable_amount;?>
                          
                        </td>
                        <td>

                        <?php
                        if($receivable_amt_col > $received_amt && $received_amt!=0 && $payable_amount!=0) {
                           echo "<span>Partially Paid</span>";
                        }
                        else if($receivable_amt_col = $received_amt) {
                          echo "<span>Paid</span>";
                        }
                        else if ($receivable_amt_col = $payable_amount){
                          echo "Not Paid";
                        }
                        else{
                          echo "Error Condition!";
                        }

                        ?>

                        </td>
                  </tr>
                
            
        
        <?php
        }
        ?>
                  <tr>
                      <td align="right" colspan="6">Total: </td>
                      <td align="right"><?php echo number_format($total_price,2,'.',',');?></td><td></td>
                      <td align="right"><?php echo number_format($total_dis_amt,2,'.',',');?></td>
                      <td align="right"><?php echo number_format($receivable_amt,2,'.',',');?></td>
                       <td align="right"><?php echo number_format($total_received_amt,2,'.',',');?></td>
                      <td align="right"><?php echo number_format($total_receivable_amt,2,'.',',');?></td>
                      <td></td></tr>
                    </tbody>
        
        
        </table>
      </div><!--end of .table-responsive-->
    </div>
  </div>
</div>


        
        
    </body>
</html>

        

        
       