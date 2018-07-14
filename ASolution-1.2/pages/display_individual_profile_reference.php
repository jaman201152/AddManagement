<?php
include '../conn.php';

$p_id=$_GET['q'];

$query=$con->prepare(" select * from tbl_reference where ref_id='$p_id' " );
$query->execute();
while($row=$query->fetch(PDO::FETCH_ASSOC)){
    extract($row);
}
?>
<style>
    .individual_profile tr td{
          font-size: 13px;
          border: 1px #ccc solid;
    }
    .individual_profile{
        border-collapse: collapse;
      
    }
   .individual_profile tr:nth-child(odd){
       
       // background:#E6E6E6;
    }
   .individual_profile tr:nth-child(even){
        //background:#E6E6E6;
    }
    .individual_profile tr td{
        padding: 1px 10px;
    }
    .individual_profile tr:hover td{
        background: #ccc;
    }
</style>
<table border="0" width="60%" class="individual_profile">
    <tr><td style="text-align:right;">Id:</td><td><?php echo $ref_id;?></td></tr>
    <tr><td  style="text-align:right;">Name:</td><td><?php echo $ref_name;?></td></tr>
    <tr><td  style="text-align:right;">Address:</td><td><?php echo $ref_address;?></td></tr>
    <tr><td  style="text-align:right;">Division:</td>
        <td><?php
        $query_div=$con->prepare(" select country from country where id='$ref_division' " );
        $query_div->execute();
        while($row=$query_div->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            echo $country;
        }
        ?></td>
    </tr>
    <tr><td  style="text-align:right;">District:</td>
          <td>
            <?php
$query_dis=$con->prepare(" select statename from state where id='$ref_district' and countryid='$ref_division' " );
        $query_dis->execute();
        while($row=$query_dis->fetch(PDO::FETCH_ASSOC)){
            extract($row);
             echo $statename;
        }
        ?>
        </td>
    </tr>
    <tr><td  style="text-align:right;">Upazila:</td><td><?php echo $ref_upazila;?></td></tr>
    <tr><td  style="text-align:right;">Phone:</td><td><?php echo $ref_phone;?></td></tr>
    <tr><td  style="text-align:right;">Email:</td><td><?php echo $ref_email;?></td></tr>
    <tr><td  style="text-align:right;">Created at:</td><td><?php $j_date=new DateTime($ref_created_at);  echo $j_date->format('d-m-Y H:i:s a');?></td></tr>
    <tr><td  style="text-align:right;">Updated at:</td><td><?php $j_date=new DateTime($ref_updated_at);  echo $j_date->format('d-m-Y H:i:s a');?></td></tr>
</table>
