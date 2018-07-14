<!DOCTYPE html>
<html>
<head>
  <title></title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>



<!--   
<table>
  <?php  echo '<div style="float:right;">Transaction details in '.$month=date('F-Y').'</div>';?>
            <thead>
            <th style="font-size:12px;">  
                Date:</th>
                <?php
                
               
                // start all date of this month
                $month_modify = new DateTime('now');
                $month_modify->modify('last day of this month');
                $lstday = $month_modify->format('d'); // take last date of the month
                $lstdayint =(int) $lstday ; // convert date to integer value 
              
               $today= (int)date('d');
                for($m=1; $m<=$lstdayint; ++$m){
                    
                    if($m==$today){
                        echo '<th style="color:green;" title="Today">'.date('d' , mktime(0, 0, 0, 0, $m, 1)); // display all date of the month
                    }
                    else{
                    echo '<th>'.date('d' , mktime(0, 0, 0, 0, $m, 1)); // display all date of the month
                    }
                }
                // end all date of this month
                echo '</th>';
                ?>
            
            </thead>
            </table> -->

<?php 


include '../../conn.php';

$report ='today';

$head = $_GET['head'];
$from_month = $_GET['from_month'];
$to_month = $_GET['to_month'];
$month_year = $_GET['month_year'];
 $start_date = $month_year.'-'.$from_month.'-01'; // get start Date
 $end_date = $month_year.'-'.$to_month.'-31'; // get End Date

        $starting_year1=strtotime($start_date); // sample Starting Date
        $ending_year1=strtotime($end_date);  // sample Ending Date
                ?>
       <button type="button" onclick="printPage();" id="print">Print Preview</button>
                <table border="0" style="border-style:none;">
                    <caption><span style="padding:10px;font-size:18px; font-weight: bold; display:block; background: #f1f2f3; border: 1px #f1f2f3 solid; color:#444;">Report By Month, Year: <?php echo $month_year; ?></span></caption>
                   <th>Srno</th> <th width="120">Name of Month</th>
                   <th>Order amt.</th>
                   <th>Discount amt.</th>
<!--                    <th>Receivable amt</th> -->
                   <th>Invoice amt.</th>
                   <th>Collection amt.</th>
                   <th>Commission amt.</th>
                   <th>Due amt.</th>
<?php
$srno=1;
$total_order = 0;
$total_discount = 0;
$total_receiveable = 0;
$total_invoice = 0;
$total_collection = 0;
$total_commission = 0;
$total_due = 0;

        for($month=$starting_year1;$month<$ending_year1; $month=strtotime('+1 month', $month) ) {

        $month_number = date('Y-m-d',$month); // get selected date month year
        $firstDayOfMonth = date($month_number,strtotime('first day of this month')).' 00:00:01';
                                // get first day of the month with time
        $lastDayOfMonth = date('Y-m-t',$month).' 23:59:59';
                                  // get last day of the month with time

                      ?>
                 <tr >
                    <td align="center"> <?php echo $srno++; ?> </td>
                    <td align="left"> <?php echo date('F-Y',$month); ?></td>
                     <td align="right">
             <?php 
                $sql_order = $con->prepare("Select * from tbl_order
                    
                    where order_date between '$firstDayOfMonth' and '$lastDayOfMonth' ");
                $sql_order->execute();
                $price1= "";
                while($row=$sql_order->fetch(PDO::FETCH_ASSOC)){
                        extract($row);
                 $price1 +=$price;
                    }
                    $total_order += $price1;
                echo $price1;
                // echo $lastDayOfthisMonth = date($month_number,strtotime('last day of this month'));
                            // for($i=1; $i<=date('t',$month); $i++){

                            //     echo $month_year.'-'.date('m',$month).'-'.$i.',';

                            // }
                            // echo "Total=".date('t',$month);
                           ?>
                     </td> 
                      <td align="right">
             <?php 
             $discount1="";
                $sql_discount = $con->prepare("Select * from tbl_order where 
                     order_date between '$firstDayOfMonth' and '$lastDayOfMonth' ");
                $sql_discount->execute();
                $discount1= "";
                while($row=$sql_discount->fetch(PDO::FETCH_ASSOC)){
                        extract($row);
                 $discount1 +=$discount_amount;
                    }
                     $total_discount += $discount1;
                echo $discount1;
                    ?> 
                     </td>
<!--                      <td align="center">
                         <?php
                          $receivable_amount=$price1-$discount1;
                          $total_receiveable +=$receivable_amount;
                          echo $receivable_amount;
                           ?>
                     </td>  -->

                    <td align="right">
             <?php 
                $sql_invoice = $con->prepare("Select * from tbl_order where status ='Created' and
                     order_date between '$firstDayOfMonth' and '$lastDayOfMonth' ");
                $sql_invoice->execute();
                $invoice1= "";
                while($row=$sql_invoice->fetch(PDO::FETCH_ASSOC)){
                        extract($row);
                 $invoice1 +=$price;
                    }
                    $total_invoice += $invoice1;
                echo $invoice1;
                    ?>
                     </td>
                     <td align="right">
                   <?php 
                $sql_collection = $con->prepare("Select * from tbl_payment
                    where payment_date between '$firstDayOfMonth' and '$lastDayOfMonth' ");
                $sql_collection->execute();
                $collection1= "";
                while($row=$sql_collection->fetch(PDO::FETCH_ASSOC)){
                        extract($row);
                 $collection1 +=$receive_amount;
                    }
                    $total_collection += $collection1;
                echo $collection1;
                    ?> 
                     </td>
                     <td align="right">
                  <?php 
                $sql_commission = $con->prepare("Select * from tbl_payment
                    where payment_date between '$firstDayOfMonth' and '$lastDayOfMonth' ");
                $sql_commission->execute();
                $commission1= "";
                while($row=$sql_commission->fetch(PDO::FETCH_ASSOC)){
                        extract($row);
                        $receive_amount1 = $receive_amount;
                        $com_amt = $receive_amount1*($commission/100);
                 $commission1 +=$com_amt;
                    }
                    $total_commission += $commission1;
                echo $commission1;
                    ?> 

                     </td>
                <td align="right">
                    <?php
                          $due = $receivable_amount - $collection1;
                          $total_due +=$due;
                          echo $due;
                      ?>
                </td>
                  <tr>
                 <?php
                  } // main for loop end
                   ?>
                   <tr align="right" style="font-weight: bold;">
                    <td></td>
                    <td>Total</td>
                    <td><?php echo number_format($total_order,2,'.',','); ?></td>
                     <td><?php echo number_format($total_discount,2,'.',','); ?></td>
<!--                     <td><?php echo $total_receiveable; ?></td>  -->
                    <td><?php echo number_format($total_invoice,2,'.',','); ?></td>
                    <td><?php  echo number_format($total_collection,2,'.',','); ?></td>
                    <td><?php echo number_format($total_commission,2,'.',','); ?></td>
                    <td><?php echo number_format($total_due,2,'.',','); ?></td>
                  </tr>
                   <tr>
                    <td colspan="8" align="center" style="color:#800000;">
                       <span><i>
 for any inconvenience please mail to: kamruzzaman245@gmail.com or phone: 01719-84 58 56
</i>
                       </span>
                   </td>
               </tr>
<tr>
   <td  colspan="8">
    <div style="padding:5px; font-style: italic; background: #f1f2f3; border: 1px #f1f2f3 solid;">Developed by-MIS
   <span style="float:right;"> Powered by- www.aiminlife.com</span>
</div>
 </td>
</tr>
               </table>



               
<!-- <?php

            if($report==='today'){
            //$today = $_REQUEST['today'];
            echo "Today's Transaction.";
           $today = date('Y-m-d',mktime(0, 0, 0, date("m"), date("d"),   date("Y")));
           $between = "between '$today' and '$today'";
        }
        elseif ($report==='yesterday') {
             echo "Yesterday's Transaction.";
            $yesterday = date('Y-m-d',mktime(0, 0, 0, date("m"), date("d")-1,   date("Y")));
            $between = "between '$yesterday' and '$yesterday'";
        }
        elseif ($report==='lastSevenDays') {
             echo "Transaction of last 7 days.";
             $lastSevenDayFrom = date('Y-m-d',mktime(0, 0, 0, date("m"), date("d")-6, date("Y")));
             $lastSevenDayTo = date('Y-m-d',mktime(0, 0, 0, date("m"), date("d"), date("Y")));
            $between = "between '$lastSevenDayFrom' and '$lastSevenDayTo'";
        }
        elseif ($report==='currentMonth') {
             echo "Transaction of this month.";
              $firstDayOfMonth = date('Y-m-d',strtotime('first day of this month'));
              $lastDayOfMonth = date('Y-m-d',strtotime('last day of this month'));
              $between = "between '$firstDayOfMonth' and '$lastDayOfMonth'";
        }
           elseif ($report==='lastThirtyDays') {
               echo "Transaction of last 30 days.";
              $firstDayOftday = date('Y-m-d',mktime(0,0,0, date("m"), date("d")-29, date("Y")));
              $lastDayOftday = date('Y-m-d',mktime(0,0,0, date("m"), date("d"), date("Y")));
              $between = "between '$firstDayOftday' and '$lastDayOftday'";
        }
        elseif ($report==='lastMonth') {
            echo "Transaction of last month.";
              $firstDayOfMonth = date('Y-m-d',strtotime('first day of last month'));
              $lastDayOfMonth = date('Y-m-d',strtotime('last day of last month'));
             $between = "between '$firstDayOfMonth' and '$lastDayOfMonth'";
        }
           elseif ($report==='lastSixMonth') {
               echo "Transaction of last six months.";
                $today = date('Y-m-d',mktime(0, 0, 0, date("m")-6, date("d"),   date("Y")));
             $firstDayOflastSixMonth = date('Y-m-01',strtotime($today));
            //$fDOSM = date('Y-m-d', strtotime($time));
              $lastDaySixMonth = date('Y-m-d',strtotime('last day of last month'));
             $between = "between '$firstDayOflastSixMonth' and '$lastDaySixMonth'";
        }
        else{
            echo "Else";
        }

         ?>
          <select id="month_name" onchange="showUserForCashBook(this.value)">
                <option value="<?php date('m');?>">Select By Month</option>
               <?php

                $starting_year1=strtotime("2017-01-01"); // sample Starting Date
                $ending_year1=strtotime("2017-12-31");  // sample Ending Date

                  for($month=$starting_year1;$month<$ending_year1; $month=strtotime('+1 month', $month) ) {
                      ?>
                 <option value="<?php echo date('Y-m',$month);?>"> <?php echo date('F',$month);
                  }
                  ?>
                    
                  </option>
         
                </select>
 -->




 <script type="text/javascript">
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