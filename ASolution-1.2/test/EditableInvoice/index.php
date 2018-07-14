<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
	
	<title>Editable Invoice</title>
	
	<link rel='stylesheet' type='text/css' href='css/style.css' />
	<link rel='stylesheet' type='text/css' href='css/print.css' media="print" />
        <script type='text/javascript' src='../../js/jquery-1.6.min.js'></script>
	<script type='text/javascript' src='js/example.js'></script>

</head>

<body>

	<div id="page-wrap">

		<textarea id="header">INVOICE</textarea>
		
		<div id="identity">
		
            <textarea id="address">Customer Name, Banani, Dhaka-1213.</textarea>

            <div id="logo">

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
              <img id="image" src="images/logo.png" alt="logo" />
            </div>
		
		</div>
		
		<div style="clear:both"></div>
		
		<div id="customer">

            <textarea id="customer-title">Banani, Dhaka-1213.</textarea>
                    
            <table id="meta">
                <tr>
                    <td class="meta-head">Invoice #</td>
                    <td><textarea>000123</textarea></td>
                </tr>
                <tr>
                    <td class="meta-head">Date</td>
                    <td><textarea id="date">December 15, 2009</textarea></td>
                </tr>
                <tr>
                    <td class="meta-head">Amount Due</td>
                    <td><div class="due">$875.00</div></td>
                </tr>

            </table>
		
		</div>
		
                
		<table id="items">
		
                    
                    <?php 
                    include '../../conn.php';
                    $sql_invoice=$con->prepare("Select * from tbl_invoice where cust_id='4' ");
                    $sql_invoice->execute();
                 
                    
                    
                    
                    ?>
		  <tr>
		      <th>Item</th>
		      <th>Description</th>
		      <th>Unit Cost</th>
		      <th>Quantity</th>
		      <th>Price</th>
                      <th>Discount</th>
                      <th>Payable Amount</th>
		  </tr>
                    <?php
                    $sub_total=0;
                    $gross_total=0;
		     while($row=$sql_invoice->fetch(PDO::FETCH_ASSOC)){
                        extract($row);?>
                  
                    
                    
                    <tr class="item-row">
                        
                      <td class="item-name"><div class="delete-wpr"><textarea>  <?php echo $item;?></textarea><a class="delete" href="javascript:;" title="Remove row">X</a></div></td>
		      <td class="description"><textarea>  <?php echo $description;?></textarea></td>
		      <td><textarea class="cost">  <?php echo $unit_price;?></textarea></td>
		      <td><textarea class="qty">  <?php echo $qty;?></textarea></td>
                      
		      <td><span class="price">  <?php echo $price; $sub_total += $price;?></span></td>
                      <td><span class="discount_amount">  <?php echo $discount_amount;?></span></td>
                      <td><span class="payable_amount">  <?php echo $payable_amount; $gross_total +=$payable_amount;?></span></td>
                    
                    </tr>
                    <?php
                    }
                    ?>
		
		  
	
		  
		  <tr id="hiderow">
		    <td colspan="7"><a id="addrow" href="javascript:;" title="Add a row">Add a row</a></td>
		  </tr>
		  
		  <tr>
                      
		      <td colspan="4" class="blank"> </td>
		      <td colspan="2" class="total-line">Subtotal</td>
		      <td class="total-value"><div id="subtotal"> <?php echo $sub_total;?></div>
                     
                      </td>
		  </tr>
		  <tr>

		      <td colspan="4" class="blank"> </td>
		      <td colspan="2" class="total-line">Total</td>
		      <td class="total-value"><div id="total"><?php echo $sub_total;?></div></td>
		  </tr>
		  <tr>
		      <td colspan="4" class="blank"> </td>
		      <td colspan="2" class="total-line">Amount Paid</td>

		      <td class="total-value"><textarea id="paid">0.00</textarea></td>
		  </tr>
		  <tr>
		      <td colspan="4" class="blank"> </td>
		      <td colspan="2" class="total-line balance">Balance Due</td>
		      <td class="total-value balance"><div class="due"><?php echo $sub_total;?></div></td>
		  </tr>
		
		</table>
		
		<div id="terms">
		  <h5>Terms</h5>
		  <textarea>NET 30 Days. Finance Charge of 1.5% will be made on unpaid balances after 30 days.</textarea>
		</div>
	
	</div>
	
</body>

</html>