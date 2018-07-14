
<?php 

$countryId=intval($_GET['country']);
$stateId=intval($_GET['state']);
 include '../conn.php';
$query=$con->prepare("SELECT id,city FROM city WHERE countryid='$countryId' AND stateid='$stateId'");
$query->execute();
$num = $query->rowCount();
?>
<p  style=" color:#444;">
   <?php
if($num!=0){
echo  "<h5> Existing Thana/Sub-District:   </h5>";
 while($row=$query->fetch(PDO::FETCH_ASSOC)) {
     extract($row);
//$batchid=$row["id"];
//$batchname=$row["city"];

 ?>
<?php

echo $city.', ';
?>
<?php
}
 }
else
{
    echo " No Item of the selected District.";
}
?>

</p>




