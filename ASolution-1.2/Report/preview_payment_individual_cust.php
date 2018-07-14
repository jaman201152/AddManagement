<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
	
	<title>Receive Payment Receipt</title>
	
	<link rel='stylesheet' type='text/css' href='../Report/css/style.css' />
	<link rel='stylesheet' type='text/css' href='../Report/css/print.css' media="print" />
        <script type='text/javascript' src='../js/jquery-1.6.min.js'></script>
        <script type='text/javascript' src='../js/custom_invoice.js'></script>

</head>

<body>

	<div id="page-wrap">

		<!-- <textarea id="header"> </textarea> -->
            <div style="padding-top:10px; text-align: center;">&nbsp; 
             <img src="images/logo.png" height="60" />
                <br/><br/>
            </div>
		<div id="identity">
		
   <?php 
        include '../conn.php';
        $inv_num=$_GET['inv_id'];
        $cust_id=$_GET['cust_id'];
         $due_request = $_REQUEST['due'];
         $receive_amt = $_REQUEST['receive'];
         $order_price = $_REQUEST['or_p'];
         $paid_amount = $_REQUEST['paid_amt'];
         $payable_amount_request = $_REQUEST['payable_amt'];
         $payment_date = $_REQUEST['payment_date'];
         $payment_method_request = $_REQUEST['payment_method'];
         $check_num_request = $_REQUEST['check_num'];
         $memo_request = $_REQUEST['memo'];
        $deposite_to_request = $_REQUEST['deposite_to'];
         $status_memo = $_REQUEST['status_memo'];
        
            $sql_invoice=$con->prepare("Select * from tbl_ememo where invoice_num=$inv_num and cust_id=$cust_id ");
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
                    <td class="meta-head">Invoice Num #</td>
                    <td><textarea>00<?php echo $inv_num;?></textarea></td>
                </tr>
                <tr>
                    <td class="meta-head">Customer ID</td>
                    <td><?php echo $cust_id_new;?></td>
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
                            Receipt Number: # <?php //echo '00'.$memo_id; ?>
                        </td>
                    </tr>
                  
                    <tr>
                <td colspan="5">Received From</td> <td colspan="3">The Amount of Tk. <?php echo "<span class='highlight'>".number_format(intval($receive_amt),2,'.',',')."</span>";?></td>
                    </tr>
                     <tr>
                        <td colspan="8">
                            In Words :     
                             <?php 
                         include '../functions/number_to_words.php';
                         echo "<span style='text-transform: capitalize;'>".convert_number_to_words($receive_amt)." Tk. Only</span>";
                        ?>
                        </td> 
                    </tr>
                     <tr>
                         <td colspan="4" rowspan="3">
                              Total Amount: <?php echo "<span style='font-weight:700;'>".$payable_amount_request."</span>";?><br/>
                              Collection Amount: <?php echo "<span style='font-weight:700;'>".number_format(intval($receive_amt),2,'.',',')."</span>";?> <br/>
                              Amount Due(ATI): <?php echo "<span style='font-weight:700;'>".$due_request."</span>";?><br/>
                         </td>  <td colspan="3">Cash</td> <td><?php if($payment_method_request==='Cash'){echo " <input type='checkbox' checked/>";} else {echo " <input type='checkbox' />"; }?></td> 
                    </tr>
                     <tr>
                        <td colspan="3">Cheque</td> <td> <?php if($payment_method_request==='Bank'){echo " <input type='checkbox' checked/>&nbsp; &nbsp; &nbsp; &nbsp;  ".$deposite_to_request." , A/C # ".$check_num_request;} else {echo " <input type='checkbox' />"; }?></td> 
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

        <div style="padding:5px; float:left;">
    <img alt="123ABC" src="../test/barcode.php?codetype=Codabar&size=40&text=zaman" />
        </div>
                                    <span style="padding:10px;" >Powered by- www.aiminlife.com</span>
    

</div>
	</div>
	
    
    
</body>

</html>