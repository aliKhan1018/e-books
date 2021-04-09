<?php
	include './inc/database.inc.php';
	$db = new database();
	
	$category_id = $_POST["category_id"];
	
	$q = "SELECT * FROM subcategory where category_id = $category_id";
	$result = $db->query($q);
?>
<option value="">Select SubCategory</option>
<?php
while($row = mysqli_fetch_array($result)) {
?>
	<option value="<?php echo $row["id"];?>"><?php echo $row["name"];?></option>
<?php
}
?>