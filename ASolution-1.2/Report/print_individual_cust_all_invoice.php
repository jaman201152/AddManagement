<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
	
	<title>Invoice</title>
	
	<link rel='stylesheet' type='text/css' href='../Report/css/style.css' />
	<link rel='stylesheet' type='text/css' href='../Report/css/print.css' media="print" />
        <script type='text/javascript' src='../js/jquery-1.6.min.js'></script>
<!--        <script type='text/javascript' src='../js/custom_invoice.js'></script>-->

</head>

<body>

	<div id="page-wrap">

		
		
		<div id="identity">
		
   <?php 
        include '../conn.php';

        $cust_id=$_GET['cust_id'];
        
        $invoice_id_ar = explode(",", $_GET['ids']); // getting rows id by querystring then explode to an array
        $list = implode(', ', $invoice_id_ar);
// then getting array value like 46, 47 for in cluse in sql then pass to IN Clause sql syntax
       
        
$balance_due=0;
                  
            $sql_invoice=$con->prepare("Select * from tbl_invoice where cust_id=$cust_id ");
            $sql_invoice->execute();
                  while($row=$sql_invoice->fetch(PDO::FETCH_ASSOC)){
                        extract($row);
                    }
                    
            $sql_invoice_display=$con->prepare("Select * from tbl_invoice"
                        . " inner join tbl_order on tbl_invoice.order_id=tbl_order.order_id "
                    . " where tbl_invoice.invoice_id in ($list)  ");
            $sql_invoice_display->execute();
                    // all invoice display query.
?>
              <div>
                <center>
                    <img id="image" src="images/logo.png" alt="logo" /><br/>
                    <div style="padding-bottom: 2px;" >49, Old Airport Road, SR Tower(6th Floor),Dhaka-1215
                             <br/>
                                 Phone: +88-02-9145608, 9145606, 9121130 Fax: +88-02-9145607
                         </div>
                         
                </center>
                    </div>
		
                    <div  class="double">&nbsp; </div>
                    <div style="text-align: center; font-size: 20px; text-decoration: dotted; ">Advertisement Bill</div>
                 
                </div>
            
            <table border="1" width="100%">
                <tr style="font-size: 16px;">
                    <td>TIN Number :</td>
                    <td style="letter-spacing: 2px; font-weight: bold;">276688765938</td>
                    <td>VAT Reg. Number :</td>
                    <td  style="letter-spacing: 2px; font-weight: bold;">19111040664</td>
                </tr>
            </table>
            
		<div id="customer">
                  <?php 
                    $sql_customer=$con->prepare("Select * from tbl_customer where cust_id=$cust_id ");
                    $sql_customer->execute();
                    while($row=$sql_customer->fetch(PDO::FETCH_ASSOC)){
                        extract($row);
                    }
                  ?>
                    <div id="customer-title" style="border:1px #ccc solid; height: 110px; margin:5px 0px; box-sizing: border-box; width:40%;">
                        Bill To:<br>
                        <?php echo $name.'<br> '.$address.', '.$phone.',<br> '.$email;?>
                    </div>
                    
            <table id="meta"  style="margin-top:5px;">
                <tr>
                    <td class="meta-head">Invoice #</td>
                    <td><textarea><?php echo $list;?></textarea></td>
                </tr>
                <tr>
                    <td class="meta-head">Billing Date</td>
                    <td><textarea id="date"><?php $d=new DateTime(date('d-m-Y')); echo $d->format('F d-Y');?></textarea></td>
                </tr>
                <tr>
                    <?php 
$sql_payment=$con->prepare("Select sum(receive_amount) as rec_amount from tbl_payment where cust_id='$cust_id' ");
$sql_payment->execute();
while($row=$sql_payment->fetch(PDO::FETCH_ASSOC)){
    extract($row);
}
?>
                    <td class="meta-head">Amount Due</td>
                    <td><div class="due" id="due_top"></div></td>
                </tr>

            </table>
		
		</div>
		
                
		<table id="items">
                    
                 
		  <tr>
                      <th>Sr.No.</th>
                      <th>Order Id</th>
                      <th>Pub_Date</th>
		      <th contenteditable="true">Description</th>
                           <th>Size(Row*Col)</th>
                    <th>Qty</th>
		    <th>Unit Cost</th>
		      <th contenteditable="true">Price</th>
                      <th contenteditable="true">Commission</th>
                      <th contenteditable="true" >Payable Amount</th>
		  </tr>
                    <?php
                    $sub_total=0;
                    $total_discount=0;
                    $serial=1;
		     while($row1=$sql_invoice_display->fetch(PDO::FETCH_ASSOC)){
                        extract($row1);?>

                    <tr class="item-row">
                        <td align="center"><div class="delete-wpr">
                              <?php echo $serial++;?><a class="delete" href="javascript:;" title="Remove row">X</a></div></td>
                        <td><?php echo $order_id; ?></td>
                        <td style="width:180px;"><?php $d=new DateTime($pub_date); echo $d->format('d-M-Y')?></td>
                      <td class="description"><textarea>  <?php echo $description;?></textarea></td>
		         <td  style="text-align: center;"><?php echo $o_row.'*'.$o_column;?></td>
                    <td style="text-align: center; width: 180px;"><span class="qty"><?php echo $qty;?> Inch</span></td>
		  
                      <td style="width:100px;"><textarea class="cost">  <?php echo $unit_price;?></textarea></td>
                      
		      <td style="width:100px;"><span class="price">  <?php echo $price; $sub_total += $price;?></span></td>
                      <td style="width:100px;"><span class="discount_amount">  <?php echo $discount_amount; $total_discount +=$discount_amount;?></span></td>
                      <td><span class="payable_amount">  <?php echo $payable_amount; $balance_due +=$payable_amount;?></span></td>
                    
                    </tr>
                    <?php
                    }
                 
                    ?>
		
		  
	
		  
<!--		  <tr id="hiderow">
		    <td colspan="8"><a id="addrow" href="javascript:;" title="Add a row">Add a row</a></td>
		  </tr>-->
		  
		  <tr>
		      <td colspan="8" class="blank"> </td>
		      <td colspan="2" class="total-line">Subtotal</td>
                      <td class="total-value"><div id="subtotal"> <?php echo number_format($sub_total,2,'.',',');?></div>
                     
                      </td>
		  </tr>
                      <tr>
		      <td colspan="8" class="blank"> </td>
		      <td colspan="2" class="total-line">Commission</td>
                      <td class="total-value"><div id="subtotal"> <?php echo number_format($total_discount,2,'.',',');?></div>
                      </td>
		  </tr>
		  <tr>

		      <td colspan="8" class="blank"> </td>
		      <td colspan="2" class="total-line">Total</td>
		      <td class="total-value"><div id="total"><?php echo $gross_total=number_format($sub_total-$total_discount,2,'.',',');?></div></td>
		  </tr>
		  <tr>
		      <td colspan="8" class="blank"> </td>
		      <td colspan="2" class="total-line">Amount Paid</td>
                      <?php
                            $sql_paid=$con->prepare("Select sum(receive_amount) as rec_amount from tbl_payment where cust_id='$cust_id' ");
                            $sql_paid->execute();
                            while($row=$sql_paid->fetch(PDO::FETCH_ASSOC)){
                                extract($row);
                            }
                      ?>
		      <td class="total-value"><textarea id="paid"><?php echo number_format($rec_amount,2,'.',',');?></textarea></td>
		  </tr>
		  <tr>
		      <td colspan="8" class="blank"> </td>
		      <td colspan="2" class="total-line balance">Balance Due</td>
		      <td class="total-value balance">
                          <div class="due"><?php echo number_format($balance_due,2,'.',','); 
                      echo "<script type='text/javascript'> $('#due_top').text('".number_format($balance_due,2,'.',',')."');</script>";
                        ?>
                          </div>
                      </td>
		  </tr>
		<tr class="item-row">
               <td colspan="8">&nbsp;</td>
                    </tr>
           <tr class="item-row">
                         <td colspan="8">&nbsp;</td>
                    </tr>
           <tr class="item-row">
                         <td colspan="8">&nbsp;</td>
                    </tr>
           <tr class="item-row">
                         <td colspan="8">&nbsp;</td>
                    </tr>
                      <tr class="item-row">
                          <td colspan="8">&nbsp;</td>
                    </tr>
                    <tr class="item-row">
                        <td colspan="2"><span  style="border-top: 1px #ccc solid; margin-left:20px;">Prepared By</span></td>
                        <td colspan="3"><span  style="border-top: 1px #ccc solid;">Accounts Department</span></td>
                        <td colspan="3"><span  style="border-top: 1px #ccc solid;">Advertisement Manager</span></td>
                    </tr>
           <tr class="item-row">
                          <td colspan="8">&nbsp;</td>
                    </tr>
                    <tr class="item-row">
                        <td colspan="8">
                                <span style="float: right;"><?php $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
echo 'Print Date - '.$dt->format('d/m/Y, g:i a');?></span>
                        </td></tr>
		</table>
		
		<div id="terms">
		  <h5>Terms</h5>
		  <textarea>NET 30 Days. Finance Charge of 1.5% will be made on unpaid balances after 30 days.</textarea>
		</div>
	
	</div>
    <script>
        
      $(document).ready(function(){
          
   
      });
    
        
    </script>
</body>

</html>