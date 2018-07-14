<?php
include '../conn.php';

$p_id=$_GET['q'];

$query=$con->prepare(" select * from tbl_customer where cust_id_new='$p_id' " );
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
    <tr><td style="text-align:right;">Id:</td><td><?php echo $cust_id_new;?></td></tr>
    <tr><td  style="text-align:right;">Name:</td><td><?php echo $name;?></td></tr>
    <tr><td  style="text-align:right;">Address:</td><td><?php echo $address;?></td></tr>
    <tr><td  style="text-align:right;">Type:</td><td><?php echo $type;?></td></tr>
    <tr><td  style="text-align:right;">Project name:</td><td><?php echo $project_name;?></td></tr>
    <tr><td  style="text-align:right;">Reference Id:</td><td><?php echo $ref_id;?></td></tr>
    <tr><td  style="text-align:right;">Joining Date:</td><td><?php $j_date=new DateTime($join_date);  echo $j_date->format('d-m-Y H:i:s a');?></td></tr>
    <tr><td  style="text-align:right;">Division:</td>
        <td><?php
        $query_div=$con->prepare(" select country from country where id='$division' " );
        $query_div->execute();
        while($row=$query_div->fetch(PDO::FETCH_ASSOC)){
            extract($row);
             echo $country;
        }
       
        
        ?></td>
        
    </tr>
    <tr><td  style="text-align:right;">District:</td>
          <td><?php
        $query_dis=$con->prepare(" select statename from state where id='$district' and countryid='$division' " );
        $query_dis->execute();
        while($row=$query_dis->fetch(PDO::FETCH_ASSOC)){
            extract($row);
             echo $statename;
        }
       
        
        ?></td>
    
    </tr>
    <tr><td  style="text-align:right;">Upazila:</td><td><?php echo $upazila;?></td></tr>
    <tr><td  style="text-align:right;">Phone:</td><td><?php echo $phone;?></td></tr>
    <tr><td  style="text-align:right;">Email:</td><td><?php echo $email;?></td></tr>
    <tr><td  style="text-align:right;">Fax:</td><td><?php echo $fax;?></td></tr>
    <tr><td  style="text-align:right;">Web Site:</td><td><?php echo $website;?></td></tr>
</table>
