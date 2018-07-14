<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Report By Client </title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
<link type="text/css" rel="stylesheet" href="../Report/css/print.css">
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
    border-bottom: 1px dashed #ddd;
    
  }
}

.p {
  text-align: center;
  padding-top: 140px;
  font-size: 14px;
}
table{border-collapse: collapse; font-family: arial, "lucida console", serif; font-size:11px; }
table, th{ border:thin #ccc solid;  padding:4px 5px; }

table, tr, td{ border:thin #ccc solid; padding:3px 3px;}

/*
For Counting Page Number
*/
#content {
    display: table;
}

#pageFooter {
    display: table-footer-group;
}

#pageFooter:after {
    counter-increment: page;
    content: counter(page);
}
/* ENd CSS for counting */

        </style>

    </head>
    <body>
        <?php
       
         include '../conn.php';
         
         
         $client_id = $_GET['client_id'];
        $from_date =New DateTime($_GET['from_date']);
       $from_date_f =  $from_date->format('Y-m-d');
        
        $to_date =New DateTime($_GET['to_date']);
      $to_date_f =  $to_date->format('Y-m-d');
      
        $sql = $con->prepare("Select * from tbl_order where order_date between '$from_date_f' and '$to_date_f'"
                . " and cust_id='$client_id' ");
        $sql->execute();
        $num = $sql->rowCount();
       
           ?>
    
      
      

<div class="container">
  <div class="row">
    <div class="col-xs-12">
      <div class="table-responsive">
      <button type="button" onclick="printPage();" id="print">Print Preview</button>
        <table summary="" class="table table-bordered table-hover">
              <?php
            $date=new DateTime($_GET['from_date']);
            $dt_from = $date->format('d-M-Y'); 
            
             $date_to=new DateTime($_GET['to_date']);
            $dt_to = $date_to->format('d-M-Y');
       ?>
          
         <thead >
   <tr style="border-bottom: none;  ">

      <th colspan="7" align="left" style="border-bottom: none;  ">
      <img src="../Report/images/logo.png" height="65" /><br/>
        49, Old Airport Road, SR Tower (6th Floor), Dhaka
      </th>
      <th colspan="3"><h2>Advertisement Department</h2><h3>Orders Report</h3></th>
    </tr>

   <tr style="border-top: none; border-bottom: none; ">
    <th colspan="5" style="border-top: none; border-bottom: none; text-align: left; padding:2px 3px;  " >Phone: +88 02 9145606, +88 02 9145608</th>
      <th colspan="4" align="right">Total Order Amt. : <span id="total_price"></span> </th>
      <th rowspan="3">Total Col. / Inch<div id="total_inch"></div></th>
    </tr>

      <tr style="border-top: none;">
    <th colspan="5" rowspan="2" style="border-top: none; text-align: left; padding:2px 3px; vertical-align: top; ">Email: advt@asianage.com</th>
      <th colspan="4" align="right">Discount: <span id="total_discount"></span> </th>
    
    </tr>

   <tr style="border-top:1px solid red;">
      
      
    <th colspan="4" align="right">Total Receivable Amt. : <span id="total_receivable_amt"></span> </th>
    
    </tr>

    <tr>
    <th colspan="10" style="background: #f1f2f3; font-size:14px; font-style: italic;">
 Total Orders from  -  <?php  echo $dt_from.' to '.$dt_to.' '; ?>
     </th>
   
    </tr>

   <tr>

    <tr>
      <th colspan="6">Monthly / Individual Report</th>
      <th rowspan="2">Total Order</th>
      <th rowspan="2">Dis/Comm. Amt.</th>
      <th rowspan="2">Receivable Amt.</th>
      <th rowspan="2">Invoice Status</th>
    </tr>

    <tr>

      <th>SL</th>
      <th> Client Id.</th>
      <th>Order Id.</th>
      <th width="80">Order Date</th>
      <th colspan="2">Size (row * column)</th>
    </tr>
  </thead>
           <tbody>
                  <?php
                  $total_price=0;
                  $total_dis_amt=0;
                  $total_receivable_amt = 0;
                  $total_col_inch = 0;
                  $srno=0;
                   while($row=$sql->fetch(PDO::FETCH_ASSOC)){
            extract($row);
                  ?>
                  <tr >
                  <td><?php echo ++$srno;?></td>
                      <td><?php echo $cust_id_new;?></td>
                       <td align="center"><?php echo $order_id;?></td>
                        <td align="center"><?php   $date=new DateTime($order_date);
                    $dt = $date->format('d-M-Y'); echo $dt;?></td>
                <td align="center"><?php echo $o_row.'*'.$o_column;?></td>
                <td align="center">
                  <?php
                      $total_size=$o_row*$o_column;
          //  $s = explode("*", $size);
          // $size_number = $s; // get the number in array with individual digit
          // for($i=0; $i<count($size_number); $i++){
          //   $digit = (int)$size_number[$i]; // store individual digit 
          //   $total_size *= $digit; 
          // }
          
         echo $total_size;  // display the product of col
         $total_col_inch +=$total_size;
                  ?>
                </td>

              
                        <td  align="right"><?php $total_price +=$price; echo number_format($price,2,'.',',');?></td>
                      
                         <td align="right"><?php $total_dis_amt += $discount_amount; echo number_format($discount_amount,2,'.',',')?></td>
                        <td align="right"><?php $total_receivable_amt +=$payable_amount; echo number_format($payable_amount,2,'.',',');?></td>
                        <td align="center"><?php echo $status; ?></td>
                  </tr>
                
            
        
        <?php
        }
        ?>
                 
                    </tbody>
        
        
        </table>
      <?php if($num==0){
            echo "<div style='color:red;'>There is no record within this time period.<div>";
        }
        ?>
      </div><!--end of .table-responsive-->
    </div>
  </div>
</div>



 


                      <div id="t_price"><?php echo number_format($total_price,2,'.',',');?></div>
                      <div id="t_discount"><?php echo number_format($total_dis_amt,2,'.',',');?></div>
                      <div id="t_receivable"><?php echo number_format($total_receivable_amt,2,'.',',');?></div>
                      <div id="t_col_inch"><?php echo $total_col_inch;?></div>

                    
<script type='text/javascript' src='../js/jquery.min.js'></script>

        <script>

        $( document ).ready(function() {
          var price = $('#t_price').text(); $('#t_price').hide(); 
          $('#total_price').text(price);

          var discount = $('#t_discount').text(); $('#t_discount').hide();
          $('#total_discount').text(discount);

          var receivable_amt = $('#t_receivable').text();  $('#t_receivable').hide();
          $('#total_receivable_amt').text(receivable_amt); 

           var col_inch = $('#t_col_inch').text();  $('#t_col_inch').hide();
          $('#total_inch').text(col_inch+" Sq. Inch"); 
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