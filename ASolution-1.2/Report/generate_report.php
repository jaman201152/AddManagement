
<?php
	include '../conn.php';

    $head = $_GET['head'];

	   $from_date =New DateTime($_GET['from_date']);
       $from_date_f =  $from_date->format('Y-m-d 00:00:01');
        
       $to_date =New DateTime($_GET['to_date']);
       $to_date_f =  $to_date->format('Y-m-d 23:59:59');

      $date=new DateTime($_GET['from_date']);
            $dt_from = $date->format('d-M-Y'); 
            
             $date_to=new DateTime($_GET['to_date']);
            $dt_to = $date_to->format('d-M-Y');
      
	
	?>

    <!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Invoice Billing Info by Date</title>
         <meta name="viewport" content="width=device-width, initial-scale=1">
<link type="text/css" rel="stylesheet" href="../Report/css/print.css">
        <style>
 

table caption {
    padding: .5em 0; 
}

@media screen and (max-width: 767px) {
  table caption {
    border-bottom: 1px dashed #ddd;
    
  }
}

@media print {
    .footer{
      position: absolute;  bottom: 0; width: 100%; text-align: right; padding:5px;
  }
}

.p {
  text-align: center;
  padding-top: 140px;
  font-size: 14px;
}
table{border-collapse: collapse; font-family: arial, "lucida console", serif; font-size:11px; font-weight:200; }
table, th{ border:thin #ccc solid;  padding:4px 5px; }

table, tr, td{ border:thin #ccc solid; padding:3px 3px;}
        </style>
    </head>
    <body>

<div class="container">
  <div class="row">
      <div class="col-xs-12">
      <button type="button" onclick="printPage()" id="print">Print Preview</button>
          <table class="table table-responsive" cellpadding="0" cellspacing="0">
  <thead >
   <tr style="border-bottom: none;  ">

      <th colspan="6" align="left" style="border-bottom: none;  ">
      <img src="../Report/images/logo.png" height="65" /><br/>
        49, Old Airport Road, SR Tower (6th Floor), Dhaka
      </th>
      <th colspan="4"><h2>Advertisement Department</h2><h3>Invoices/Billing Report</h3></th>
    </tr>

   <tr style="border-top: none; border-bottom: none; ">
    <th colspan="5" style="border-top: none; border-bottom: none; text-align: left; padding:2px 3px;  " >Phone: +88 02 9145606, +88 02 9145608</th>
      <th colspan="4" align="right">Total Invoice / Billing Amt:
       &nbsp;&nbsp;&nbsp;&nbsp;<span id="total_price"></span> </th>
      <th rowspan="3" width="90">Total Col./ Inch<div id="total_inch"></div></th>
    </tr>

      <tr style="border-top: none;">
    <th colspan="5" style="border-top: none; text-align: left; padding:2px 3px; vertical-align: top; ">Email: advt@asianage.com</th>
      <th colspan="4" align="right">Total Received:
       &nbsp;&nbsp;&nbsp;&nbsp;<span id="total_received_amt"></span> </th>
      
    </tr>

   <tr>
      <th width="80">Total AIT / Others Dis.</th>
      <th align="center"> <span id="total_ait_discount"></span> </th>
      <th colspan="3" align="right">Total Discount:</th>
      <th width="80" align="center"><div id="total_discount"></div></th>
      <th colspan="3" align="right">Total Due Amt:
      &nbsp;&nbsp;&nbsp;&nbsp; <span id="total_receivable_amt"></span> </th>
    
    </tr>

    <tr>
    <th colspan="10" style="background: #f1f2f3; font-size:14px;">
 Date:  <?php  echo $dt_from.' to '.$dt_to.' '; ?>
     </th>
   
    </tr>

   <tr>

    <tr>
      <th colspan="5">Monthly / Individual Report</th>
      <th rowspan="2">Invoice. Amt.</th>
      <th rowspan="2">Received Amt.</th>
      <th rowspan="2">Dis. Amt.</th>
      <th rowspan="2" width="100">AIT and Others Discount</th>
      <th rowspan="2">Due Amt.</th>
     
    </tr>

    <tr>

      <th width="60">SL</th>
      <th>Bill No. & Client Id.</th>
      <th>Pub Date</th>
      <th colspan="2">Size (row*col)</th>

      
    </tr>
  </thead>
  <tbody>
<?php
    $sql_new = $con->prepare("Select * from tbl_invoice  where invoice_date between '$from_date_f' and '$to_date_f' ");
        $sql_new->execute();

            $total_price_new=0;
            $total_discount_amount_new=0;
            $total_receivable_amt_new=0;
            $total_received_amt_new=0;
            $srno = 0;
            $total_col_inch=0;
            $total_ait_others_discount = 0;

        while($row_new = $sql_new->fetch(PDO::FETCH_ASSOC)){
          extract($row_new);
?>
   <tr>
      <td align="center"> <?php echo ++$srno.'.';  ?> </td>
       <td align="center"> <?php echo $invoice_id.'. '.$cust_id_new ?> </td>
       <td align="center"> <?php $pub_f = new DateTime($pub_date);  echo $pub_f->format('d-M-Y'); ?> </td>
       <td align="center"> <?php echo $invoice_row.'*'.$invoice_column; ?> </td>
       <td>
         <?php
         /*
         $total_size=1;
          $s = filter_var($size, FILTER_SANITIZE_NUMBER_INT); 
          $size_number = str_split($s); // get the number in array with individual digit
          for($i=0; $i<count($size_number); $i++){
            $digit = (int)$size_number[$i]; // d
            $total_size *= $digit; 
          }
        echo $total_size; // display the product of col
        $total_col_inch +=$total_size;

        */
          // $total_size=1;
          //  $s = explode("*", $size);
          // $size_number = $s; // get the number in array with individual digit
          // for($i=0; $i<count($size_number); $i++){
          //   $digit = (int)$size_number[$i]; // store individual digit 
          //   $total_size *= $digit; 
          // }
        echo $qty.'"'; // display the product of col
        $total_col_inch +=$qty;
        
         ?>

       </td>
      <td align="center">
       <?php

       echo $price; // Invoice Amount
       $total_price_new += $price; 
        ?>
          
        </td>

              <td align="center"> 

      <?php
      $received_amt_new =($price - $discount_amount - $ait_others_discount) - $payable_amount;
       echo $received_amt_new; 

      $total_received_amt_new += $received_amt_new; 
      
       ?> 

       </td>

      <td align="center">

       <?php
        echo $discount_amount;
        $total_discount_amount_new += $discount_amount; 
         ?>
         

       </td>
       <td align="center">
          <?php 
          echo $ait_others_discount;
          $total_ait_others_discount +=$ait_others_discount; 
          ?>
       </td>
      <td align="center">
       <?php
           $receivable_amt_new = $payable_amount ;
           echo $receivable_amt_new;
           $total_receivable_amt_new += $receivable_amt_new;
        ?>
          
        </td>

    </tr>


<?php
        }
?>


  </tbody>
</table>
      </div>

  </div>
</div>
<div class="footer" style=" position: absolute;  bottom: 0; width: 100%; text-align: right; padding:5px;">
Printed By: .....................................<br/>
Print Date: 
<?php
$dateTime = new DateTime();
$d = $dateTime->setTimezone(new DateTimeZone('Asia/Dhaka'));
 echo $d->format('d/m/Y H:i:s a');
 ?>

 </div>

<div id="t_price"><?php echo number_format($total_price_new,2,'.',',');?> </div>
<div id="t_discount"><?php echo number_format($total_discount_amount_new,2,'.',','); ?></div>
<div id="t_recievable_amt"><?php echo number_format($total_receivable_amt_new,2,'.',','); ?></div>
<div id="t_received_amt"><?php echo number_format($total_received_amt_new,2,'.',','); ?></div>
<div id="t_col_inch"><?php echo $total_col_inch;?></div>
<div id="t_ait_others_discount"><?php echo number_format($total_ait_others_discount,2,'.',',');?></div>

   <script type='text/javascript' src='../js/jquery.min.js'></script>

        <script>

        $( document ).ready(function() {
          var price = $('#t_price').text(); $('#t_price').hide(); 
          $('#total_price').text(price);

          var discount = $('#t_discount').text(); $('#t_discount').hide();
          $('#total_discount').text(discount);

          var receivable_amt = $('#t_recievable_amt').text();  $('#t_recievable_amt').hide();
          $('#total_receivable_amt').text(receivable_amt);

          var received_amt = $('#t_received_amt').text(); $('#t_received_amt').hide();
          $('#total_received_amt').text(received_amt);

          var t_inch = $('#t_col_inch').text(); $('#t_col_inch').hide();
          $('#total_inch').text(t_inch+' Sqr. Inch');

          var t_ait = $('#t_ait_others_discount').text(); $('#t_ait_others_discount').hide();
          $('#total_ait_discount').text(t_ait);

        });



function printPage() {
        //Get the print button and put it into a variable
         var printButton = document.getElementById("print");
      //print();
        //Set the print button visibility to 'hidden' 
        printButton.style.visibility = 'hidden';
        //Print the page content
        window.print();
        //Set the print button to 'visible' again 
        //[Delete this line if you want it to stay hidden after printing]
        printButton.style.visibility = 'visible';
    }

        </script>
    </body>
</html>