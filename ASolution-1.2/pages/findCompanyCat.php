
<?php 
$companytypeId=intval($_GET['companytypeId']);
 include '../conn.php';
$query=$con->prepare("SELECT companycatid,company_cat_name FROM company_cat_tbl WHERE companytypeid='$companytypeId' ");
$query->execute();

?>
       <option value=" ">Select Any One</option>
    <option value="addNew">Add New</option>
<?php while($row=$query->fetch(PDO::FETCH_ASSOC))
        { 
    ?>
<option value=<?php echo $row['companycatid'];?>><?php echo $row['company_cat_name'];?></option>
<?php } ?>


