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
    table{
        font-family: sans-serif;
        color:#333;
    }
    .individual_profile tr td{
          font-size: 18px;
         // border: 1px #ccc solid;
    }
    .individual_profile{
        border-collapse: collapse;
    }
   .individual_profile tr:nth-child(odd){
       // background:#E6E6E6;
    }
   .individual_profile tr:nth-child(even){
        // background:#E6E6E6;
    }
    .individual_profile tr td{
       // padding: 1px 10px;
    }
    .individual_profile tr:hover td{
      //  background: #ccc;
    }
    .item{ color:#666; text-align: right; padding-right:20px; }
 </style>
       <button type="button" onclick="printPage();" id="print">Print Preview</button>
    <table border="0" width="800" class="individual_profile">
    <tr><td class="item"> Company Name: <?php echo $ref_name; ?></td></tr>
    <tr><td class="item">Id:</td><td> <?php echo $ref_id;?></td></tr>
    <tr><td class="item">Address:</td><td> <?php echo $ref_address;?></td></tr>
    <tr><td class="item">Reference ID:</td><td> <?php echo $ref_id;?></td></tr>
    <tr><td class="item">Create Date:</td><td> <?php $j_date=new DateTime($ref_created_at);  echo $j_date->format('d-M-Y');?></td></tr>
    <tr><td class="item">Division:</td>
        <td> <?php
        $query_div=$con->prepare(" select country from country where id='$ref_division' " );
        $query_div->execute();
        while($row=$query_div->fetch(PDO::FETCH_ASSOC)){
            extract($row);
             echo $country;
        }
        ?></td>
        
    </tr>
    <tr><td class="item">District:</td>
          <td> <?php
        $query_dis=$con->prepare(" select statename from state where id='$ref_district' and countryid='$ref_division' " );
        $query_dis->execute();
        while($row=$query_dis->fetch(PDO::FETCH_ASSOC)){
            extract($row);
             echo $statename;
        }
        ?></td>
    </tr>
    <tr><td class="item">Upazila:</td><td> <?php echo $ref_upazila;?></td></tr>
    <tr><td class="item">Phone:</td><td> <?php echo $ref_phone;?></td></tr>
    <tr><td class="item">Email:</td><td> <?php echo $ref_email;?></td></tr>
 </table>
       
        <script type="text/javascript">
  function printPage() {
        //Get the print button and put it into a variable
         var printButton = document.getElementById("print");
      //print();
        //Set the print button visibility to 'hidden' 
        printButton.style.visibility = 'hidden';
        //Print the page content
        window.print();
        //Set the print button to 'visible' again 
        //[Delete this line if you want it to stay hidden after printing]
        printButton.style.visibility = 'visible';
    }
 </script>
       
 


