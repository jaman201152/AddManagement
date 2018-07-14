
<?php 
$country=intval($_GET['country']);
 include '../conn.php';
$query=$con->prepare("SELECT id,statename FROM state WHERE countryid='$country' ");
$query->execute();

?>
<label>District</label>
<select name="district" class="easyui-combobox district"  required="required" onchange="getCity(<?php echo $country?>,this.value)">
    <option value=" ">Select District</option>
<?php while($row=$query->fetch(PDO::FETCH_ASSOC)) {    
    extract($row);
    ?>

<option value=<?php echo $id;?>><?php echo $statename;?></option>
<?php } ?>
</select>

