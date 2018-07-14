<?php
    include '../conn.php';
        $q = $_REQUEST['q'];
         if(empty($q)){

                $query_cust_print = $con->prepare("Select * from tbl_customer
                 inner join tbl_reference on tbl_customer.ref_id=tbl_reference.ref_id ");
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
    <caption><h3>List of All Customer</h3></caption>
    <thead>
    <th>Srno.</th>
    <th>ID.</th>
    <th>Company Name</th>
    <th>Address</th>
    <th>Phone</th>
    <th>Email</th>
    <th>Type</th>
    <th>Company Category</th>
    <th>Reference Name</th>
    </thead>
                        <?php
                        $srno=1;
                    while ($row = $query_cust_print->fetch(PDO::FETCH_ASSOC))
                                    {
                        extract($row);
                        ?>
                    <tr>
                        <td><?php echo $srno++.'.'; ?></td>
                        <td> <?php echo $cust_id_new; ?> </td>
                        <td><?php echo $name; ?></td>
                        <td> <?php echo $address; ?> </td>
                        <td> <?php echo $phone; ?> </td>
                        <td> <?php echo $email; ?> </td>

                        <td> <?php echo $type; ?> </td>
                        <td> <?php echo $project_name; ?> </td>
                        <td> <?php echo $ref_name; ?> </td>
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
                   $query_cust_print = $con->prepare("Select * from tbl_customer
            inner join tbl_reference on tbl_customer.ref_id=tbl_reference.ref_id
                    where division=$id ");
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
    <caption><h3>List of All Customer in Division <?php echo $q; ?></h3></caption>
    <thead>
    <th>Srno.</th>
    <th>ID.</th>
    <th>Company Name</th>
    <th>Address</th>
    <th>Phone</th>
    <th>Email</th>
    <th>Type</th>
    <th>Company Category</th>
    <th>Reference Name</th>
    </thead>
                        <?php
                        $srno=1;
                    while ($row = $query_cust_print->fetch(PDO::FETCH_ASSOC))
                                    {
                        extract($row);
                        ?>
                    <tr>
                        <td><?php echo $srno++.'.'; ?></td>
                        <td> <?php echo $cust_id_new; ?> </td>
                        <td><?php echo $name; ?></td>
                        <td> <?php echo $address; ?> </td>
                        <td> <?php echo $phone; ?> </td>
                        <td> <?php echo $email; ?> </td>

                        <td> <?php echo $type; ?> </td>
                        <td> <?php echo $project_name; ?> </td>
                        <td> <?php echo $ref_name; ?> </td>
                        <?php
                    }
                ?>
                        </tr>
                   
</table>



<?php
                       
             }            

            
         }

    

 ?>
