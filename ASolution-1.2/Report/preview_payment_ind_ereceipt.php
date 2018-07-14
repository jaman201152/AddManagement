<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
	
	<title>Receive Payment Receipt</title>
	
	<link rel='stylesheet' type='text/css' href='../Report/css/style.css' />
	<link rel='stylesheet' type='text/css' href='../Report/css/print.css' media="print" />
        <script type='text/javascript' src='../js/jquery-1.6.min.js'></script>
        <script type='text/javascript' src='../js/custom_invoice.js'></script>
        <style type="text/css">
            body{
              font-family: Tahoma, Geneva, sans-serif;
                  color:#444;
            }
        </style>
</head>

<body>

	<div id="page-wrap">

	<div style="padding-top:10px; text-align: center;">&nbsp; 
             <img src="images/logo.png" height="60" />
                <br/><br/>
            </div>
		<div id="identity">
		
   <?php 
        include '../conn.php';
        $inv_num=$_GET['inv_num'];
        $cust_id=$_GET['cust_id'];
        $order_id=$_GET['order_id'];
        $ememo_id=$_GET['ememo_id'];
        
            $sql_invoice=$con->prepare("Select * from tbl_ememo where invoice_id=$inv_num and "
                   . "cust_id=$cust_id and order_id=$order_id and memo_id=$ememo_id ");
            $sql_invoice->execute();
                  while($row=$sql_invoice->fetch(PDO::FETCH_ASSOC)){
                        extract($row);
                        
                    }
                    
                    
            $sql_invoice_display=$con->prepare("Select * from tbl_invoice where invoice_id=$inv_num ");
            $sql_invoice_display->execute();
                    

?>
         

        
		
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
                    <div style="float:left;display: block;">Received From - </div>
                    <textarea id="customer-title" rows="5" cols="26"><?php echo $name.', '.$address.', '.$phone.', '.$email;?></textarea>
                    
            <table id="meta">
                 <tr>
                    <td class="meta-head">Customer ID</td>
                    <td><?php echo "00".$cust_id;?></td>
                </tr>
                <tr>
                    <td class="meta-head">Order #</td>
                    <td><textarea><?php echo '00'.$order_id;?></textarea></td>
                </tr>
                <tr>
                    <td class="meta-head">Invoice #</td>
                    <td><textarea><?php echo '00'.$inv_num;?></textarea></td>
                </tr>
               
<!--                <tr>
                    <td class="meta-head">Date</td>
                    <td><textarea id="date"></textarea></td>
                </tr>-->
                <tr>
                    <td class="meta-head">Payment Date</td>
                    <td><div class="due"><?php $d= new DateTime($payment_date); $df = $d->format('d, F Y'); echo "<span class='highlight'>".$df."</span>";?></div></td>
                </tr>
            </table>
		
		</div>
		
                
		<table id="items">
		
		
<!--		  <tr id="hiderow">
		    <td colspan="8"><a id="addrow" href="javascript:;" title="Add a row">Add a row</a></td>
		  </tr>-->
		

                    <tr>
                        <td colspan="5" rowspan="1"><h3 style="text-align: center;">Cash Receipt</h3></td>
                        <td colspan="3" >
                            Receipt # <?php echo '00'.$memo_id; ?>
                        </td>
                    </tr>
                
                    <tr>
                <td colspan="5">Services: Advertisement</td> <td colspan="3">Amount: <?php echo "<span class='highlight'>".number_format(intval($receive_amount),2,'.',',')."</span>";?></td>
                    </tr>
                     <tr>
                        <td colspan="8">Amount (In Words) :
                        <?php 
                         include '../functions/number_to_words.php';
                         echo "<span style='text-transform: capitalize;'>".convert_number_to_words($receive_amount)." Tk. Only</span>";
                        ?>
                        </td> 
                    </tr>
                     <tr>
                         <td colspan="4" rowspan="4">
                              Total Amount: <?php echo "<span style='font-weight:700;'>".$payable_amount."</span>";?><br/>
                              Collection Amount: <?php echo "<span style='font-weight:700;'>".number_format(intval($receive_amount),2,'.',',')."</span>";?> <br/>
                              Amount Due(ATI): <?php echo "<span style='font-weight:700;'>".$due."</span>";?><br/>
                         </td>  <td colspan="3">Cash</td> <td><?php if($payment_method==='Cash'){echo " <input type='checkbox' checked/>";} else {echo " <input type='checkbox' />"; }?></td> 
                    </tr>
                     <tr>
                        <td colspan="3">Cheque</td> <td> <?php if($payment_method==='Bank'){echo " <input type='checkbox' checked/>&nbsp; &nbsp; &nbsp; &nbsp;  ".$deposite_to." , ".$check_num;} else {echo " <input type='checkbox' />"; }?></td> 
                    </tr>
                
                     <tr>
                        <td colspan="4">Received By:</td> 
                    </tr>
		</table>
		
<!--		<div id="terms">
		  <h5>Terms</h5>
		  <textarea></textarea>
		</div>-->
<div style="padding:3px; color:#444; font-size: 12px; font-weight: 500; font-style: italic; text-align: right;">
    <span >Powered by- www.aiminlife.com</span>
</div>
	</div>
	
</body>

</html>