<?php
include '../conn.php';

$c_id=$_GET['q'];

$query=$con->prepare(" select * from tbl_order where cust_id='$c_id' order by order_id DESC " );
$query->execute();?>

<table border="0" width="100%" class="individual_profile_r" >
    <caption style="font-weight: bold;">All Order</caption>
    <thead><tr>
    <th>Order ID</th>
    <th>Customer ID.</th>
    <th>Order Date</th>
    <th>Item</th>
    <th>Type</th>
    <th>Reference</th>
    <th>Total Price</th>
    <th>Discount</th>
    <th>Payable Amt.</th>
    <th></th></tr>
    </thead><tbody>
        <?php
        $pr=0;
        $dis=0;
        $amt=0;
while($row=$query->fetch(PDO::FETCH_ASSOC)){
    extract($row);?>
    <tr>
        <td><?php echo $order_id;?></td>
        <td><?php echo $cust_id;?></td>
        <td><?php $order_date1=new DateTime($order_date); echo $order_date1->format('d-m-Y');?></td>
        <td><?php echo $item;?></td>
        <td><?php echo $type;?></td>
        <td><?php echo $ref_name;?></td>
        <td><?php echo $price; $pr+=$price?></td>
        <td><?php echo $discount; $dis+=$discount?></td>
        <td><?php echo $payable_amount; $amt+=$payable_amount ?></td>
        <td width="150">
            <a href="#">Invoice</a> | <a href="#">Bill</a> | 
            <a href="javascript:void(0)" onclick="editOrder()">Edit</a> | <a href="#">Delete</a></td>
    </tr>


<?php
}
?>
    <tr style="font-weight: bold; padding: 5px; background: #ccc; color:#333;">
        <td>Total:</td><td></td><td></td><td></td><td></td>
        <td></td>
        <td><?php echo $pr;?></td> <td><?php echo $dis;?></td><td><?php echo $amt;?></td><td></td>
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

