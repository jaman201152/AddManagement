<?php
include '../conn.php';

$c_id=$_GET['q'];

$query=$con->prepare(" select * from tbl_invoice"
            . " inner join tbl_customer on tbl_invoice.cust_id=tbl_customer.cust_id
                inner join tbl_order on tbl_invoice.order_id=tbl_order.order_id 
                inner join tbl_reference on tbl_invoice.ref_id = tbl_reference.ref_id "
        . " where tbl_customer.cust_id='$c_id' order by tbl_order.order_id ASC " );
$query->execute();?>

<table border="0" width="100%" class="individual_profile_r" >
    <caption style="font-weight: bold;">All Invoices
   
    </caption>
    <thead><tr>
            <th><input type="checkbox" id="selectall" style="width:30px;"/></th>
    <th>Order ID</th>
    <th>Invoice ID</th>
    <th>Customer ID.</th>
    <th>Order Date</th>
    <th>Reference</th>
    <th>Total Price</th>
    <th>Discount</th>
    <th>Payable Amt.</th>
    <th>Ref. Id</th></tr>
    </thead><tbody>
        <?php
        $pr=0;
        $dis=0;
        $amt=0;
while($row=$query->fetch(PDO::FETCH_ASSOC)){
    extract($row);
    ?>
    <tr>
        <td><input type="checkbox" class="case" name="case[]" value="<?php echo $invoice_id;?>" style="width:30px;"/></td>
        <td><?php echo $order_id;?></td>
         <td><?php echo $invoice_id;?></td>
        <td><?php echo $cust_id_new;?></td>
        <td><?php $order_date1=new DateTime($order_date); echo $order_date1->format('d-m-Y');?></td>
        <td><?php $pub_date1=new DateTime($pub_date); echo $pub_date1->format('d-m-Y');?></td>
        <td>
            <?php echo '<div class="price">'.$price.'</div>'; $pr+=$price?>
        </td>
        <td><?php echo $discount; $dis+=$discount?></td>
        <td><?php echo $payable_amount; $amt+=$payable_amount ?></td>
        <td><?php echo $ref_id;?></td>
          </tr>

    <?php
    }
    ?>
    <tr style="font-weight: bold; padding: 5px; background: #ccc; color:#333;">
        <td>Total:</td><td></td><td></td><td></td><td></td>
        <td></td>
        <td><?php echo $pr;?></td> <td><?php echo $dis;?></td><td><?php echo $amt;?></td>
        <td></td>
    </tr>
    </tbody>
    </table>
<style>
    .individual_profile_r{
        border-collapse: collapse;
    }
    .individual_profile_r thead th{
        background:#ccc; padding: 5px; color:#333;
    }
   
</style>

<script>
    $(document).ready(function(){
           
          // add multiple select / deselect functionality
	$("#selectall").click(function () {
		  $('.case').attr('checked', this.checked);
                  var checkLength = $(".case:checked").length;
                  $('.countSelect').text(checkLength);
	});
        
 var checkLength = $(".case:checked").length;
        $('.countSelect').text(checkLength);
	// if all checkbox are selected, check the selectall checkbox
	// and viceversa
        
        
            var ids=[]; // let ids is a array
            var invoiceArray=[];
    $(".case").click(function(){
        var invoice_id = $(this).val();
        var add_total = 0;
        if($(this).is(':checked')){ // check checkbox checked or unchecked if checked
        
//        invoiceArray.push(invoice_id);
//         function checkValue(value,arr){
//  var status = 'Not exist';
//  for(var i=0; i<invoiceArray.length; i++){
//   var name = invoiceArray[i];
//   if(name === value){
//    status = 'Exist';
//    break;
//        }
//    }
//    return status;
// }
//  var status = checkValue(invoice_id,invoiceArray);

                  var price = $(this).closest('tr').find('td div.price').text();
              ids.push(price); // keep the value in array for each click
         //	alert(ids.join('\n'));
       for (var i = 0; i < ids.length; i++) {
           add_total += ids[i];
        }
        }else{ // if not checked
//                var index = invoiceArray.indexOf(invoice_id);
//                if (index > -1) {
//                invoiceArray.splice(index, 1);
//                    }
                var price = $(this).closest('tr').find('td div.price').text();
                add_total-price;
         //	alert(ids.join('\n'));
      }

  
        var total = add_total;
        $('.selected_amt').text(total); // show total sum in the class selected_amt
        var checkLength = $(".case:checked").length;
        $('.countSelect').text(checkLength);
        
		if($(".case").length === $(".case:checked").length) {
			$("#selectall").attr("checked", "checked");
		} else {
			$("#selectall").removeAttr("checked");
                       
		}
	});

     // End Select All and indevidual select

           
        });
</script>

