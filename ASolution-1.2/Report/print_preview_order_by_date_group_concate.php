<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Total Orders by Date </title>
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
         
         
        
        $from_date =New DateTime($_GET['from_date']);
       $from_date_f =  $from_date->format('Y-m-d');
        
        $to_date =New DateTime($_GET['to_date']);
        $to_date_f =  $to_date->format('Y-m-d');
      
        $sql = $con->prepare("Select"
                ." tbl_customer.cust_id,tbl_customer.cust_id_new,state.statename,
                    tbl_customer.name,tbl_order.price,tbl_order.payable_amount,
                    tbl_order.discount_amount,tbl_order.status,tbl_order.o_row,tbl_order.o_column,
                    tbl_order.order_id,tbl_order.order_date,count(cust_id) as order_number,
                    group_concat(order_id) as indi_order_id,
                    group_concat(order_date) as indi_order_date,
                    group_concat(qty) as indi_qty,
                    SUM(qty * unit_price) priceEach,
        SUM((qty * unit_price)*(front_page/100)) as front_charge,
        SUM((qty * unit_price)*(back_page/100)) as back_charge,
        SUM((qty * unit_price)*(color/100)) as color_charge,
        SUM(discount_amount) as discount_amt,
        SUM(qty * unit_price)+SUM((qty * unit_price)*(front_page/100))+SUM((qty * unit_price)*(back_page/100))
        +SUM((qty * unit_price)*(color/100))-SUM(discount_amount) as total_bill,
       (SUM(qty * unit_price)+SUM((qty * unit_price)*(front_page/100))+SUM((qty * unit_price)*(back_page/100))
        +SUM((qty * unit_price)*(color/100))-SUM(discount_amount))*vat/100 as vat_amt,
        (SUM(qty * unit_price)+SUM((qty * unit_price)*(front_page/100))+SUM((qty * unit_price)*(back_page/100))
        +SUM((qty * unit_price)*(color/100))-SUM(discount_amount))*tax/100 as tax_amt "
                . " from tbl_customer "
                . " inner join tbl_order USING(cust_id)"
                . " INNER JOIN state on tbl_customer.district=state.id  "
                
                . " where tbl_order.order_date between '$from_date_f' and '$to_date_f'"
                . " GROUP BY  tbl_order.cust_id ");
        $sql->execute();
        
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

      <th colspan="3" align="left" style="border-bottom: none;  ">
      <img src="../Report/images/logo.png" height="65" /><br/>
        49, Old Airport Road, SR Tower (6th Floor), Dhaka
      </th>
      <th colspan="5"><h2>Advertisement Department</h2><h3>Orders Report</h3></th>
    </tr>

   <tr style="border-top: none; border-bottom: none; ">
    <th colspan="4" style="border-top: none; border-bottom: none; text-align: left; padding:2px 3px;  " >Phone: +88 02 9145606, +88 02 9145608</th>
      <th colspan="3" align="right">Total Order Amt. : <span id="total_price"></span> </th>
      <th rowspan="3">Total Col. / Inch<div id="total_inch"></div></th>
    </tr>

      <tr style="border-top: none;">
    <th colspan="4" rowspan="2" style="border-top: none; text-align: left; padding:2px 3px; vertical-align: top; ">Email: advt@asianage.com</th>
      <th colspan="3" align="right">Vat & Tax: <span id="total_discount"></span> </th>
    </tr>

   <tr style="border-top:1px solid red;">
      
    <th colspan="3" align="right">Total Receivable Amt. : <span id="total_receivable_amt"></span> </th>
    
    </tr>

    <tr>
    <th colspan="8" style="background: #f1f2f3; font-size:14px; font-style: italic;">
 Total Orders from  -  <?php  echo $dt_from.' to '.$dt_to.' '; ?>
     </th>
   
    </tr>

   <tr>

    <tr>
      <th colspan="5">Monthly / Individual Report</th>
      <th rowspan="2">Total Order Amt.</th>
      <th rowspan="2">Vat. & Tax.</th>
      <th rowspan="2">Receivable Amt. (Tk.)</th>
   
    </tr>

    <tr>
      <th>SL</th>
      <th> Client Id, Client Name & Number of Order</th>
      <th>Order Id.</th>
      <th width="80">Order Date</th>
      <th>Size (sq. inch)</th>
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
                      <td width="auto"><?php echo $cust_id_new.',<br> '.$name.', '.$statename.' ['.$order_number.']';?></td>
                       
                      <td align="left">
                              <div style="max-width:100px; overflow-x: scroll;">
                              <?php echo $indi_order_id;?>
                              </div>
                      </td>
                        <td align="center">
                             <div style="max-width:200px; max-height: 70px; overflow: scroll;">
                        <?php   
                        echo $indi_order_date;
                        ?>
                             </div>
                        </td>
                <td align="center">
                     <div style="max-width:100px; overflow-x: scroll;">
                    <?php echo $indi_qty;
                         
                $total_size=$o_row*$o_column;
          //  $s = explode("*", $size);
          // $size_number = $s; // get the number in array with individual digit
          // for($i=0; $i<count($size_number); $i++){
          //   $digit = (int)$size_number[$i]; // store individual digit 
          //   $total_size *= $digit; 
          // }  
         $total_col_inch +=$total_size;
                ?>
                     </div>
                     </td>
                        <td  align="right">
                            <?php
                        $total_price +=$total_bill; echo number_format($total_bill,2,'.',',');
                        ?></td>
                         <td align="right"><?php
                         $vat_tax = $vat_amt+$tax_amt;
                         $total_dis_amt += $vat_amt;
                         echo number_format($vat_tax,2,'.',',')?></td>
                        <td align="right"><?php
                            $total_amt= $total_bill+$vat_tax;
                        $total_receivable_amt +=$total_amt;
                        echo number_format($total_amt,2,'.',',');?></td>
                       
                  </tr>
                
            
        
        <?php
        }
        ?>
                 
                    </tbody>
        
        
        </table>
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