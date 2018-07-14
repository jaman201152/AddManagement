<?php
include '../conn.php';

$c_id=$_GET['q'];

$query=$con->prepare(" select * from tbl_payment where cust_id='$c_id' order by payment_id DESC " );
$query->execute();
$num=$query->rowCount();

?>

<table border="0" width="100%" class="individual_profile_r" cellpadding="5" >
    <caption style="font-weight: bold; color:#777;">List of All Payments</caption>
    <thead>
    <tr>
    <th>Inv. ID.</th>
    <th>Bill. No.</th>
    <th>Cust. ID.</th>
    <th>Payment Date</th>
    <th>Receivable Amt.</th>
    <th>Receive Amt.</th>
    <th>AIT or Others Discount</th>
    <th align="center">Due</th>
    <th>Status</th>
    </tr>
    </thead>
    <tbody>
        <?php
        $pa=0;
        $rec=0;
        $a_o_d=0;
        $due1=0;
while($row=$query->fetch(PDO::FETCH_ASSOC)){
    extract($row);?>
    <tr>
        <td><?php echo $invoice_id;?></td>
        <td><?php echo $payment_id;?></td>
        <td><?php echo $cust_id_new;?></td>
  
        <td><?php $payment_date1=new DateTime($payment_date); echo $payment_date1->format('d-m-Y');?></td>
        <td align="right"><?php echo $payable_amount; $pa+=$payable_amount?></td>
        <td align="right"><?php echo $receive_amount; $rec+=$receive_amount?></td>
        <td align="right"> <?php echo $ait_others_discount; $a_o_d+=$ait_others_discount; ?> </td>
        <td align="right"><?php echo $due; $due1+=$due ?></td>
        <td>
            <?php

               $r = (double) $receive_amount;
               $p = (double) $payable_amount;
               $a = (double) $ait_others_discount;
               $t_r = $r + $a;
               if($p == $t_r){
                echo "Paid";
               }
               elseif($p > $t_r){
                echo "Partially Paid";
               }
               else{
                echo "Not Comment";
               }
                
                
                
           
            
            ?>
            
        </td>
    </tr>


<?php
}
?>
    <tr style="font-weight: bold; padding: 20px; background:#F1F1F1; color:#444;">
        <td></td> <td></td> <td></td>
        <td align="right">Total:</td>
        <td align="right"><?php echo number_format($pa,2,'.',',');?></td>
        <td align="right"><?php echo number_format($rec,2,'.',',');?></td>
        <td align="right"><?php echo number_format($a_o_d,2,'.',',')?></td>
        <td align="right"><?php echo number_format($due1,2,'.',',');?></td>
    </tr>
    <tr> <td colspan="10" align="center"> <br/>Records-<?php echo $num; ?> </td> </tr>
    </tbody>
    </table>
<style>

    .individual_profile_r{
        border-collapse: collapse;
    }
    .individual_profile_r thead th{
        background:#F1F1F1; padding: 5px; color:#444;
    }

        .individual_profile_r thead { display: block; }
        .individual_profile_r tbody { display: block; } .individual_profile_r tr { display: block; } 
        .individual_profile_r td { display: block; }  .individual_profile_r th { display: block; } 

       .individual_profile_r tr:after {
            content: ' ';
            display: block;
            visibility: hidden;
            clear: both;
        }

       .individual_profile_r thead th {
            height: 30px;
            /*text-align: left;*/
        }

       .individual_profile_r tbody {
            height: 120px;
            overflow-y: auto;
        }

      .individual_profile_r thead {
            /* fallback */
        }

      .individual_profile_r tbody td, thead th {
            width: 9%;
            float: left;
        }

        .individual_profile_r tr:nth-last-child(2) td{
            background: #f6f7f8; border-top:1px #ccc solid;
        }
   
</style>

