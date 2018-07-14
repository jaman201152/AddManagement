 <?php
 include '../conn.php';

 $p_id=$_GET['q'];

 $query=$con->prepare(" select * from tbl_customer where cust_id='$p_id' " );
 $query->execute();
 while($row=$query->fetch(PDO::FETCH_ASSOC)){
    extract($row);
 }

 ?>
 <style>
    table{
        font-family: sans-serif;
        color:#333;
    }
    .individual_profile tr td{
          font-size: 18px;
         /* border: 1px #ccc solid; */
    }
    .individual_profile{
        border-collapse: collapse;
    }
   .individual_profile tr:nth-child(odd){
        /* background:#E6E6E6;*/
    }
   .individual_profile tr:nth-child(even){
        /* background:#E6E6E6; */
    }
    .individual_profile tr td{
       /* padding: 1px 10px; */
    }
    .individual_profile tr:hover td{
      /*  background: #ccc;*/
    }
    .item{ color:#666; text-align: right; padding-right:20px; }
 </style>

    <table border="0" width="800" class="individual_profile">
    <tr><td class="item"> Company Name: <?php echo $name; ?></td></tr>
    <tr><td class="item">Id:</td><td> <?php echo $cust_id_new;?></td></tr>
    <tr><td class="item">Address:</td><td> <?php echo $address;?></td></tr>
    <tr><td class="item">Type:</td><td> <?php echo $type;?></td></tr>
    <tr><td class="item">Project name:</td><td> <?php echo $project_name;?></td></tr>
    <tr><td class="item">Reference ID:</td><td> <?php echo $ref_id;?></td></tr>
    <tr><td class="item">Joining Date:</td><td> <?php $j_date=new DateTime($join_date);  echo $j_date->format('d-m-Y H:i:s a');?></td></tr>
    <tr><td class="item">Division:</td>
        <td> <?php
        $query_div=$con->prepare(" select country from country where id='$division' " );
        $query_div->execute();
        while($row=$query_div->fetch(PDO::FETCH_ASSOC)){
            extract($row);
             echo $country;
        }
        ?></td>
        
    </tr>
    <tr><td class="item">District:</td>
          <td> <?php
        $query_dis=$con->prepare(" select statename from state where id='$district' and countryid='$division' " );
        $query_dis->execute();
        while($row=$query_dis->fetch(PDO::FETCH_ASSOC)){
            extract($row);
             echo $statename;
        }
        ?></td>
    </tr>
    <tr><td class="item">Upazila:</td><td> <?php echo $upazila;?></td></tr>
    <tr><td class="item">Phone:</td><td> <?php echo $phone;?></td></tr>
    <tr><td class="item">Email:</td><td> <?php echo $email;?></td></tr>
    <tr><td class="item">Fax:</td><td> <?php echo $fax;?></td></tr>
    <tr><td class="item">Web Site:</td><td> <?php echo $website;?></td></tr>
 </table>
       
       
 


