<?php 

$countryId=intval($_GET['country']);
$stateId=intval($_GET['state']);
 include '../conn.php';
$query=$con->prepare("SELECT id,city FROM city WHERE countryid='$countryId' AND stateid='$stateId'");
$query->execute();

?>
<label>Upazila</label>
<select name="upazila" class="easyui-combobox sub_district" required="required">
    <option value=" ">Select Upazila</option>
<?php while($row=$query->fetch(PDO::FETCH_ASSOC)) {
     extract($row);
//$batchid=$row["id"];
//$batchname=$row["city"];

 ?>
<option value="<?php echo $id;?>"><?php echo $city;?></option>
<?php } ?>
</select>



