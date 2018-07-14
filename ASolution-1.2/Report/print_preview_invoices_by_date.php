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

        <style>
 
   body{
              font-family: Tahoma, Geneva, sans-serif;
                  color:#333;
            }
            
table caption {
	padding: .5em 0; 
}

@media screen and (max-width: 767px) {
  table caption {
    border-bottom: 1px solid #ddd;
    
  }
}

.p {
  text-align: center;
  padding-top: 140px;
  font-size: 14px;
}
table{border-collapse: collapse; font-family: arial, "lucida console", serif; font-size:11px; }
table, th{ border:1px #ccc solid;  padding:10px 5px;}
table, tr, td{ border:1px #ccc solid; padding:5px 5px;}
        </style>
    </head>
    <body>
        <?php
       
         include '../conn.php';
         
         
       
        
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
            <caption class="text-center"><h2>The Asian Age</h2> Invoices Billing Info. from    <?php
            $date=new DateTime($_GET['from_date']);
            $dt_from = $date->format('d-M-Y'); 
            
             $date_to=new DateTime($_GET['to_date']);
            $dt_to = $date_to->format('d-M-Y');
            echo '<span style="color:#4B2D73;">'.$dt_from. ' to ' .$dt_to.'</span>'; ?></caption>
          
               <thead>
            <th>Cust. Id.</th>
             <th>O. Id.</th>
             <th>Pub. Date</th>
             <th>Bill. No.</th> <!-- Invoice Number is Bill No. -->
             <th>Ref. Id</th>
              <th width="100">O. Date</th>
              <th>Price</th>
              <th>Dis. (%)</th>
              <th>Dis. Amt.</th>
              <th>Receivable Amt.</th>
              <th>Total Due Amt.</th>
<!--              <th>Status</th>-->
            
            </thead>
           <tbody>
                  <?php
                  $total_price=0;
                  $total_dis_amt=0;
                  $total_receivable_amt = 0;
                  $receivable_amt = 0;
                   while($row=$sql->fetch(PDO::FETCH_ASSOC)){
            extract($row);
                  ?>
                  <tr >
                      <td><?php echo $cust_id_new;?></td>
                       <td><?php echo $order_id;?></td>
                        <td><?php $date = new DateTime($pub_date); $dt= $date->format("d-M-Y"); echo $dt;?></td>
                       <td><?php echo $invoice_id;?></td>
                        <td><?php echo $ref_id?></td>
                        <td align="center"><?php   $date=new DateTime($order_date);
                $dt = $date->format('d-M-Y'); echo $dt;?></td>
                        <td  align="right"><?php $total_price +=$price; echo number_format($price,2,'.',',');?></td>
                        <td align="right"><?php echo $discount;?></td>
                         <td align="right"><?php $total_dis_amt += $discount_amount; echo number_format($discount_amount,2,'.',',')?></td>
                         <td align="right">
                            <?php
                            $receivable_amt_col = $price - $discount_amount;
                           
                             echo  number_format($receivable_amt_col);

                              $receivable_amt += $receivable_amt_col;
                            ?>
                         </td>
                        <td align="right"><?php $total_receivable_amt +=$payable_amount; echo number_format($payable_amount,2,'.',',');?></td>
<!--                        <td>

                        <?php
                        if($price > $payable_amount) {
                           echo "<span>Partially Paid</span>";
                        }
                        else if($price == $payable_amount) {
                          echo "<span>Not Paid</span>";
                        }
                        else{
                           echo "<span>Paid</span>";
                        }

                        ?>

                        </td>-->
                  </tr>
                
        <?php
        }
        ?>
                  <tr>
                      <td align="center" colspan="6">Total Amount: </td>
                      <td align="right"><?php echo number_format($total_price,2,'.',',');?></td><td></td>
                      <td align="right"><?php echo number_format($total_dis_amt,2,'.',',');?></td>
                      <td align="right"><?php echo number_format($receivable_amt,2,'.',',');?></td>
                      <td align="right"><?php echo number_format($total_receivable_amt,2,'.',',');?></td>
                      </tr>
                    </tbody>
        
        
        </table>
      </div><!--end of .table-responsive-->
    </div>
  </div>
</div>


        
        
    </body>
</html>
