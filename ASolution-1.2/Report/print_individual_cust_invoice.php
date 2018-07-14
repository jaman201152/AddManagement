<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
	
	<title>The Asian Age</title>
	
	<link rel='stylesheet' type='text/css' href='../Report/css/style.css' />
	<link rel='stylesheet' type='text/css' href='../Report/css/print.css' media="print" />
        <script type='text/javascript' src='../js/jquery-1.6.min.js'></script>
        <script type='text/javascript' src='../js/custom_invoice.js'></script>

</head>

<body>

	<div id="page-wrap">

		<textarea id="header">INVOICE</textarea>
		
		<div id="identity">
		
   <?php 
        include '../conn.php';
        $inv_num=$_GET['inv_id'];
        $cust_id=$_GET['cust_id'];

                  
            $sql_invoice=$con->prepare("Select * from tbl_invoice where invoice_id=$inv_num ");
            $sql_invoice->execute();
                  while($row=$sql_invoice->fetch(PDO::FETCH_ASSOC)){
                        extract($row);
                    }
                    
                    
            $sql_invoice_display=$con->prepare("Select * from tbl_invoice where invoice_id=$inv_num ");
            $sql_invoice_display->execute();
                    

?>
           
 
            <div id="logo">
   <img id="image" src="images/logo.png" alt="logo" />
              <div id="logoctr">
                <a href="javascript:;" id="change-logo" title="Change logo">Change Logo</a>
                <a href="javascript:;" id="save-logo" title="Save changes">Save</a>
                |
                <a href="javascript:;" id="delete-logo" title="Delete logo">Delete Logo</a>
                <a href="javascript:;" id="cancel-logo" title="Cancel changes">Cancel</a>
              </div>

              <div id="logohelp">
                <input id="imageloc" type="text" size="50" value="" /><br />
                (max width: 540px, max height: 100px)
              </div>
           
            </div>
            <textarea id="address">Bashoti Horizon, H # 21, R # 17, Banani, Dhaka-1213.</textarea>
		
		</div>
		
		<div style="clear:both"></div>
		
		<div id="customer">
                  <?php 
                    $sql_customer=$con->prepare("Select * from tbl_customer where cust_id=$cust_id ");
                    $sql_customer->execute();
                    while($row=$sql_customer->fetch(PDO::FETCH_ASSOC)){
                        extract($row);
                    }
                  ?>
                    <div style="float:left;display: block;">Bill To - </div>
                    <textarea id="customer-title" rows="5" cols="26"><?php echo $name.', '.$address.', '.$phone.', '.$email;?></textarea>
                    
            <table id="meta">
                <tr>
                    <td class="meta-head">Invoice #</td>
                    <td><textarea>000<?php echo $inv_num;?></textarea></td>
                </tr>
                <tr>
                    <td class="meta-head">Date</td>
                    <td><textarea id="date"></textarea></td>
                </tr>
                <tr>
                    <td class="meta-head">Amount Due</td>
                    <td><div class="due"><?php echo $payable_amount;?></div></td>
                </tr>

            </table>
		
		</div>
		
                
		<table id="items">
		
                    
                 
		  <tr>
          <th>W.O. No.</th>
		      <th>Pub_Date</th>
          <th>Size(Row*Col)</th>
		      <th>Description</th>
          <th>Order. Date</th>
		      <th>Unit Cost</th>
		      <th>Qty</th>
		      <th>Price</th>
                      <th>Discount</th>
                      <th>Payable Amount</th>
		  </tr>
                    <?php
                    $sub_total=0;
                    $gross_total=0;
                    $total_discount=0;
		     while($row1=$sql_invoice_display->fetch(PDO::FETCH_ASSOC)){
                        extract($row1);?>
                  
                    
                    <tr class="item-row">
                        
                      <td class="item-name"><div class="delete-wpr"><textarea>  <?php echo $work_order_no;?></textarea><a class="delete" href="javascript:;" title="Remove row">X</a></div></td>
                           <td style="width:150px;"><?php $p=new DateTime($pub_date); echo $p->format('d-M-Y')?></td>
                       <td><?php echo $invoice_row.'*'.$invoice_column;?></td>
		      <td class="description"><textarea>  <?php echo $description;?></textarea></td>
                      <td style="width:150px;"><?php $d=new DateTime($order_date); echo $d->format('d-M-Y')?></td>
		      <td style="width:100px;"><textarea class="cost">  <?php echo $unit_price;?></textarea></td>
		      <td><textarea class="qty">  <?php echo $qty;?></textarea></td>
                      
		      <td style="width:100px;"><span class="price">  <?php echo $price; $sub_total += $price;?></span></td>
                      <td style="width:100px;"><span class="discount_amount">  <?php echo $discount_amount; $total_discount +=$discount_amount;?></span></td>
                      <td><span class="payable_amount">  <?php echo $payable_amount; $gross_total +=$payable_amount;?></span></td>
                    
                    </tr>
                    <?php
                    }
                 
                    ?>
		
		  
	
		  
<!--		  <tr id="hiderow">
		    <td colspan="8"><a id="addrow" href="javascript:;" title="Add a row">Add a row</a></td>
		  </tr>-->
		  
		  <tr>
                      
		      <td colspan="7" class="blank"> </td>
		      <td colspan="2" class="total-line">Subtotal:</td>
                      <td class="total-value"><div id="subtotal"> <?php echo number_format($sub_total,2,'.',',');?></div>
                     
                      </td>
		  </tr>
                      <tr>
                      
		      <td colspan="7" class="blank"> </td>
		      <td colspan="2" class="total-line">Discount:</td>
                      <td class="total-value"><div id="subtotal"> <?php echo number_format($total_discount,2,'.',',');?></div>
                     
                      </td>
		  </tr>
      <tr>

          <td colspan="7" class="blank"> </td>
          <td colspan="2" class="total-line">Vat ( <?php echo $vat.'%';?>) & Tax (<?php echo $tax.'%';?>) :</td>
          <td class="total-value"><div id="vat">
          <?php 
          $v = $vat; $v_amt = $sub_total*($v/100);  
          $t = $tax; $t_amt = $sub_total*($t/100); 

          echo number_format($v_amt,2,'.',',').' + '.number_format($t_amt,2,'.',',');?>
            
          </div></td>
      </tr>

		  <tr>

		      <td colspan="7" class="blank"> </td>
		      <td colspan="2" class="total-line">Total:</td>
		      <td class="total-value"><div id="total"><?php $to = $v_amt + $t_amt + ($sub_total - $total_discount); echo number_format($to,2,'.',',');?></div></td>
		  </tr>
		  <tr>
		      <td colspan="7" class="blank"> </td>
		      <td colspan="2" class="total-line">Amount Paid:</td>
                        <?php
                            $sql_paid=$con->prepare("Select sum(receive_amount) as rec_amount from tbl_payment where cust_id='$cust_id' and invoice_id='$inv_num' ");
                            $sql_paid->execute();
                            while($row=$sql_paid->fetch(PDO::FETCH_ASSOC)){
                                extract($row);
                            }
                      ?>
                      <td class="total-value"><textarea id="paid"><?php echo number_format($rec_amount,2,'.',',');?></textarea></td>
		  </tr>
		  <tr>
		      <td colspan="7" class="blank"> </td>
		      <td colspan="2" class="total-line balance">Balance Due:</td>
                      <td class="total-value balance"><div class="due"><?php echo number_format($payable_amount,2,'.',',');?></div></td>
		  </tr>
		
		</table>
	
    



    <div id="terms">
    <div style="padding:10px 0px 50px 0;">
      <span style="float:left;">Received By</span> &nbsp; <span style="float: right;">Authorized By</span>
    </div>
    
      <h5>Terms</h5>
      <textarea>NET 30 Days. Finance Charge of 1.5% will be made on unpaid balances after 30 days.</textarea>
      <span style="float: right;"><?php $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
echo 'Print Date - '.$dt->format('d/m/Y, g:i a');?></span>
    </div>

    </div>

	
	
	
</body>

</html>