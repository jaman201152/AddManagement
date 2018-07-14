<link type="text/css" rel="stylesheet" href="../Report/css/print.css">
<style>
    table thead th{
        background-color:#ccc;
    }
    table tr td{
        border-bottom: 1px #ccc solid;
    }

table caption {
    padding: .5em 0; 
}

@media screen and (max-width: 767px) {
  table caption {
    border-bottom: 1px dashed #ddd;
    
  }
}

.p {
  text-align: center;
  padding-top: 140px;
  font-size: 14px;
}
table{border-collapse: collapse; font-family: arial, "lucida console", serif; font-size:11px; }
table, th{ border:thin #ccc solid;  padding:4px 5px; }

table, tr, td{ border:thin #ccc solid; padding:3px 3px;}

/*
For Counting Page Number
*/
#content {
    display: table;
}

#pageFooter {
    display: table-footer-group;
}

#pageFooter:after {
    counter-increment: page;
    content: counter(page);
}
/* ENd CSS for counting */

        </style>

        
   <button type="button" onclick="printPage();" id="print">Print Preview</button>


<?php
    include '../conn.php';
        $q = $_REQUEST['q'];
         if(empty($q)){

                $query_cust_print = $con->prepare("Select * from tbl_reference"
                        . " inner join country on tbl_reference.ref_division = country.id"
                        . " inner join state on tbl_reference.ref_district = state.id ");
                $query_cust_print->execute();
                ?>

<table>
    <caption><h3>List of All Reference</h3></caption>
    <thead>
    <th>Srno.</th>
    <th>ID.</th>
    <th>Company Name</th>
    <th>Address</th>
    <th>Phone</th>
    <th>Email</th>
    <th>Division</th>
    <th>District</th>
    <th>Upazila</th>
    </thead>
                        <?php
                        $srno=1;
                    while ($row = $query_cust_print->fetch(PDO::FETCH_ASSOC))
                                    {
                        extract($row);
                        ?>
                    <tr>
                        <td><?php echo $srno++.'.'; ?></td>
                        <td> <?php echo $ref_id; ?> </td>
                        <td><?php echo $ref_name; ?></td>
                        <td> <?php echo $ref_address; ?> </td>
                        <td> <?php echo $ref_phone; ?> </td>
                        <td> <?php echo $ref_email; ?> </td>
                        <td> <?php echo $country; ?> </td>
                        <td> <?php echo $statename; ?> </td>
                        <td> <?php echo $ref_upazila; ?> </td>
                        <?php
                    }
                ?>
                        </tr>
                   
</table>

<?php
         }
         else{

             $dist = $con->prepare("Select * from country where country ='$q' ");
             $dist->execute();
             while($row_dist = $dist->fetch(PDO::FETCH_ASSOC)){
                 extract($row_dist);
                   $query_cust_print = $con->prepare("Select * from tbl_reference"
                           . " where ref_division=$id ");
                       $query_cust_print->execute();
                       ?>
<style>
    table thead th{
        background-color:#ccc;
    }
    table tr td{
        border-bottom: 1px #ccc solid;
    }
</style>
<table>
    <caption><h3>List of All Reference in Division- <?php echo $q; ?></h3></caption>
    <thead>
    <th>Srno.</th>
    <th>ID.</th>
    <th>Company Name</th>
    <th>Address</th>
    <th>Phone</th>
    <th>Email</th>
    <th>Division</th>
    </thead>
                        <?php
                        $srno=1;
                    while ($row = $query_cust_print->fetch(PDO::FETCH_ASSOC))
                                    {
                        extract($row);
                        ?>
                    <tr>
                        <td><?php echo $srno++.'.'; ?></td>
                        <td> <?php echo $ref_id; ?> </td>
                        <td><?php echo $ref_name; ?></td>
                        <td> <?php echo $ref_address; ?> </td>
                        <td> <?php echo $ref_phone; ?> </td>
                        <td> <?php echo $ref_email; ?> </td>
                        <td> <?php echo $country; ?> </td>
                        <?php
                    }
                ?>
                        </tr>
                   
</table>



<?php
                       
             }            

            
         }

    

 ?>
<script>
    
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