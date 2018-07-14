<?php
include '../conn.php';

$c_id=$_GET['q'];

$query=$con->prepare(" select * from tbl_invoice"
            . " inner join tbl_customer on tbl_invoice.cust_id=tbl_customer.cust_id
                inner join tbl_order on tbl_invoice.order_id=tbl_order.order_id 
                inner join tbl_reference on tbl_invoice.ref_id = tbl_reference.ref_id "
        . " where tbl_customer.cust_id='$c_id' order by tbl_order.order_id ASC " );
$query->execute();
$num = $query->rowCount();
?>

<table border="0" width="100%" class="individual_profile_r" >
    <caption style="font-weight: bold;">All Invoices
   
    </caption>
    <thead><tr>
            <th><input type="checkbox" id="selectall" style="width:30px;" disabled /></th>
    <th>Order ID</th>
    <th>Customer ID.</th>
    <th>Order Date</th>
    <th>Reference</th>
    <th>Order Amt. </th>
    <th>Discount</th>
    <th>Order Amt. <br>(After Dis)</th>
    <th>Vat/Tax Amt.</th>
    <th>Payable Amt.</th>
    <th>Ref. Id</th></tr>
    </thead><tbody>
        <?php
       
        $pr=0;
        $dis=0;
        $amt=0; $t_vat_tax=0; $t_order_after_dis=0;
         if($num!=0){
while($row=$query->fetch(PDO::FETCH_ASSOC)){
    extract($row);
    ?>
    <tr>
        <td><input type="checkbox" class="case" name="case[]" value="<?php echo $invoice_id;?>" style="width:30px;" /></td>
        <td><?php echo $order_id;?>
              <input type="hidden" name="order_id[]" value="<?php echo $order_id;?>">
        </td>
        <td><?php echo $cust_id_new;?>
        </td>
        <td><?php $order_date1=new DateTime($order_date); echo $order_date1->format('d-m-Y');?>
            
        </td>
        <td><?php $pub_date1=new DateTime($pub_date); echo $pub_date1->format('d-m-Y');?></td>
        <td align="right">
            <?php
             $unit_price= $qty * $unit_price;
        $front_charge=$unit_price*($front_page/100);
        $back_charge=$unit_price*($back_page/100);
        $color_charge=$unit_price*($color/100);
        $t_price = $unit_price + $front_charge + $back_charge+ $color_charge;
            echo $t_price; $pr+=$t_price;
                    ?>
        </td>
        <td align="right">
            <?php echo $discount_amount; $dis+=$discount_amount?></td>
          <td  align="right">  <?php
                    $order_after_dis=$t_price-$discount_amount;
                    echo '<div class="price_after_dis">'.$order_after_dis.'</div>'; 
          $t_order_after_dis+=$order_after_dis;
                  ?>
              <input type="hidden" name="price_after_dis[]" value="<?php echo $order_after_dis;?>">
          </td>
        <td align="right">
            <?php
                $vat_charge = $t_price*($vat/100);
                $tax_charge = $t_price*($tax/100);
                $t_vat_tax += ($vat_charge+$tax_charge);
                echo $vat_charge+$tax_charge;
            ?>
        </td>
        <td align="right"><?php echo $payable_amount; $amt+=$payable_amount ?></td>
        <td  align="right"><?php echo $ref_id;?>
            <input type="hidden" name="ref_id[]" value="<?php echo $ref_id;?>">
        </td>
          </tr>
<?php
        }}else{
            echo "<tr align='center'><td colspan='11' style='color:red;'>There is no result to be shown.</td></tr>";
        }
?>
    <tr style="font-weight: bold; padding: 5px; background: #F1F1F1; text-align: right; color:#333;">
        <td></td><td></td><td></td><td></td>
        <td>Total:</td>
        <td><?php echo number_format($pr,2,'.',',');?></td>
        <td><?php echo number_format($dis,2,'.',',');?></td>
        <td  class="total_price"><?php echo number_format($t_order_after_dis,2,'.',',');?></td>
        <td><?php echo number_format($t_vat_tax,2,'.',',');?></td>
        <td><?php echo number_format($amt,2,'.',',');?></td>
        <td></td>
    </tr>
    </tbody>
    </table>

<style>
    .individual_profile_r{
        border-collapse: collapse;
    }
    .individual_profile_r thead th{
        background:#F1F1F1; padding: 5px; color:#333;
    }
   
</style>

<script>
    $(document).ready(function(){
           
          // add multiple select / deselect functionality
          
	$("#selectall").click(function () {
                   
		  $('.case').attr('checked', this.checked);
                  var checkLength = $(".case:checked").length; // count all checked item
                  $('.countSelect').text(checkLength); // show count all checked item
              $('#grandtotal').css({'border':'2px green solid','text-align':'right'});     
        $("#grandtotal").val(function() { // this will get all select value or not select value
                //declare a variable to keep the sum of the values
                var sum = 0;
                //using an iterator find and sum the values of checked checkboxes
                $(".case:checked").each(function() {
                    var price = $(this).closest('tr').find('td div.price_after_dis').text();
                    var pricef=parseFloat(price);
                  sum += pricef;
                });
                return sum.toFixed(2);
              }); // this will get all select value or not select value
              
          
  
	}); // all select Click Event End
        

       var checkLength = $(".case:checked").length;
        $('.countSelect').text(checkLength);

	// if all checkbox are selected, check the selectall checkbox
	// and viceversa 
        $('tr').find('td input.case').attr("disabled", true); // All checkbox will disabeld
 $('#receive_amount_multi').on('keyup',function(e){
     var t = $(this).val();
     if(t.length>0){ // if field is not empty
         $('tr').find('td input.case').removeAttr("disabled");
         $('#selectall').removeAttr('disabled');
            $(".case").click(function(){
                $(this).closest('tr').find('td input.case').removeAttr("disabled");
                       $('#receive_amount_multi').focus();
            var checkLength = $(".case:checked").length;
            $('.countSelect').text(checkLength);
		if($(".case").length === $(".case:checked").length) {
                        $("#selectall").attr("checked", "checked");
                    $('#multi_payment_save_btn').linkbutton('enable');
		}else{
			$("#selectall").removeAttr("checked");
                         $('#multi_payment_save_btn').linkbutton('disable'); // save button disabled
		}
                
	});
     }else{ // if field is not empty
                $('#receive_amount_multi').focus();
            $('tr').find('td input.case').attr("disabled", true);
             $('#selectall').attr('disabled', true);
     }
 }); // End keyup on receive collection amount
 

     // End Select All and indevidual select
    
        var total_price=$('.total_price').text();
           $('.balance_due').text(total_price);
        
    // ******************** 
    //add change event action on checkbox
$(".case").on("change", function() {
 var a = $(".case:checked").length;
if(a>=1){
      $('#multi_payment_save_btn').linkbutton('enable');
}else{
      $('#multi_payment_save_btn').linkbutton('disable'); // save button disabled
}
                       $('#receive_amount_multi').focus();
  //change input #grandtotal value according check/uncheck checkboxes
  $('#grandtotal').css({'border':'2px green solid','text-align':'right'});
  $("#grandtotal").val(function() {
    //declare a variable to keep the sum of the values
    var sum = 0;
    //using an iterator find and sum the values of checked checkboxes
    $(".case:checked").each(function() {
        var price = $(this).closest('tr').find('td div.price_after_dis').text();
        var pricef=parseFloat(price);
      sum += pricef;
    });
    return sum.toFixed(2);
  });
  
        

});


           
           
           
        });
        
//           function userTyped(commen, e){
//                    
//                if(e.value.length > 0){
//                    alert('test');
//                    document.getElementsById(commen).disabled=false;
//                }else{
//                    document.getElementsById(commen).disabled=true;
//                }
//                
//        }


        
</script>

