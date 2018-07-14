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
                    
            $sql_invoice_display=$con->prepare("Select * from tbl_invoice "
                    . " inner join tbl_order on tbl_invoice.order_id=tbl_order.order_id "
                    . " where invoice_id=$inv_num ");
            $sql_invoice_display->execute();
                    

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
                    
                    <table id="meta" style="margin-top:5px;">
                <tr>
                    <td class="meta-head">Order #</td>
                    <td><textarea><?php echo $order_id;?></textarea></td>
                </tr>
                <tr>
                    <td class="meta-head">Invoice #</td>
                    <td><textarea>000<?php echo $inv_num;?></textarea></td>
                </tr>
                <tr>
                    <td class="meta-head">Billing Date</td>
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
                    <th>Order. Date</th>
		    <th>Pub_Date</th>
                    <th>Description</th>
                    <th>Size(Row*Col)</th>
                    <th>Qty</th>
		    <th>Unit Cost</th>
		    <th>Amount</th>
		  </tr>
                    <?php
                    $sub_total=0;
                    $gross_total=0;
                    $total_discount=0;
		     while($row1=$sql_invoice_display->fetch(PDO::FETCH_ASSOC)){
                        extract($row1);?>
                    <tr style="border: 1; vertical-align: center;">
                        
                     <td class="item-name" style="height: 80px; text-align: center;"><div class="delete-wpr"><span>  <?php echo $work_order_no;?></span><a class="delete" href="javascript:;" title="Remove row">X</a></div></td>
                    <td width="120"  style="text-align: center;"><?php $d=new DateTime($order_date); echo $d->format('d-M-Y')?></td>
                    <td width="120"  style="text-align: center;"><?php $p=new DateTime($pub_date); echo $p->format('d-M-Y')?></td>
                    <td class="description"  style="text-align: center;"><span>  <?php echo $description;?></span></td>
                           <td  style="text-align: center;"><?php echo $o_row.'*'.$o_column;?></td>
                           <td width="50" style="text-align: center;"><span class="qty">  <?php echo $qty;?> Inch</span></td>
		      <td style="width:100px; text-align: center;"><span class="cost"><?php echo $unit_price;?></span></td>
                      <td style=" text-align: center;">  <?php echo number_format($price,2,'.',',');?></td>      
		    
                    </tr>
                    <?php
                    }
                
                    ?>
	
		  
<!--		  <tr id="hiderow">
		    <td colspan="8"><a id="addrow" href="javascript:;" title="Add a row">Add a row</a></td>
		  </tr>-->
		  
		  <tr>
            <td rowspan="13" colspan="5" class="blank" align="center">
                <div style="border:1px #ccc solid; padding:15px; width:55%;">All Payment Acceptable only by <br/>
                      A/C Payee crossed Cheque/DD/PO in favour of -<br/>
                      <b>The Asian Age<br/>
                          A/C No. : 1820901031253<br/>
                          Pubali Bank Ltd., Farmgate Branch.
                      </b>
            </div>
                      </td>
		     
		      <td colspan="2" class="total-line">Gross Amount:</td>
                    
           <td  style="text-align: right; height: 5px;"> <span class="price"> 
            <?php echo number_format($price,2,'.',','); 
           $sub_total += $price;?></span></td>
		  </tr>
                <tr>
          <td colspan="2" class="total-line"  style="height: 15px;">Front Page Chrg:</td>
            <td  style="text-align: right; height: 5px;">
              <?php
              $front_page_amt = $price*$front_page/100;
                  echo number_format($front_page_amt,2,'.',',');
              ?>
              </td>
        </tr>
            <tr>
                 <td colspan="2" class="total-line" >Back Page Chrg:</td>
            <td  style="text-align: right; height: 5px;">
              <?php
              $back_page_amt = $price*$back_page/100;
                  echo number_format($back_page_amt,2,'.',',');
              ?>
            </td>
                </tr>
     <tr>
          <td colspan="2" class="total-line">Color Chrg:</td>
          <td  style="text-align: right; height: 5px;">
                <?php
              $color_amt = $price*$color/100;
                  echo number_format($color_amt,2,'.',',');
              ?>
              </td>
         </tr>
      <tr>
        <tr>
          <td colspan="2" class="total-line">Discount:</td>
            <td style="text-align: right; height: 5px;">
                <span class="discount_amount">
                  <?php echo number_format($discount_amount,2,'.',','); $total_discount +=$discount_amount;?>
                </span></td>
         </tr>
            <tr>
          <td colspan="2" class="total-line">Total Advt. Bill:</td>
              <td style="text-align: right; height: 5px;"><span class="payable_amount">  <?php
               $gross_total +=($price+$front_page_amt+$back_page_amt+$color_amt)-$total_discount;
               echo number_format($gross_total,2,'.',',');
               ?></span></td>
         </tr>
    
          <tr>

          <td colspan="2" class="total-line" >Vat (<?php echo $vat.'%';?>):</td>
          <td  style="text-align: right; height: 5px;">
            <?php $v = $vat; $v_amt = $gross_total*($v/100);
            echo number_format($v_amt,2,'.',',');
             ?>
          </td>
        </tr>
          <tr>
            <td colspan="2" class="total-line"> Tax (<?php echo $tax.'%';?>):</td>
          <td style="text-align: right; height: 5px;" >
            <div id="vat"  >
          <?php
          $t = $tax; $t_amt = $gross_total*($t/100); 
          echo number_format($t_amt,2,'.',',');
          ?>
            </div>
          </td>
      </tr>
            <tr>
                  <td colspan="2" class="total-line">Payable Amount:</td>    
                      <td  style="text-align: right; height: 5px;">
                          <span class="payable_amount">  
                        <?php 
                        $net_amount = $gross_total+($v_amt+$t_amt);
                          echo number_format($net_amount,2,'.',',');
                        ?></span>
                      </td>
            </tr>
        
          
      <tr>
		<tr>
		      <td colspan="2" class="total-line">Amount Paid:</td>
                        <?php
                            $sql_paid=$con->prepare("Select sum(receive_amount) as rec_amount from tbl_payment where cust_id='$cust_id' and invoice_id='$inv_num' ");
                            $sql_paid->execute();
                            while($row=$sql_paid->fetch(PDO::FETCH_ASSOC)){
                                extract($row);
                            }
                        ?>
  <td style="text-align: right; height: 5px;">
      <span id="paid"  style="text-align: right;"><?php echo number_format($rec_amount,2,'.',',');?></span></td>
		  </tr>
		  <tr>
		      <td colspan="2" class="total-line balance">Balance Due:</td>
                      <td class="balance" style="text-align: right; height: 5px;" ><div class="due" style="text-align: right;">
                          <?php echo number_format($payable_amount,2,'.',',');?>
                          </div></td>
		  </tr>
                    <tr   class="item-row" >
                        <td   colspan="8"> <br>
                            Receivable Amount ( In Words ):
                            <span  style="font-weight: bold;">
                        <?php
                                include '../Report/wordtonumber.class.php';
                                $numbertoword=new WordToNumber();
                                $inwords = $numbertoword->convertNumberToWord($payable_amount);
                                if($inwords=='0'){
                                echo 'Zero Tk.';
                                }else{
                                    echo ucwords($inwords).' Tk.';
                                }
                        ?>
                                </span>
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
      <h5></h5>

    </div>

    </div>
        
	
	
</body>

</html>