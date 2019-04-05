	<?php 
	include("includes/db.php");
	include("../functions/functions.php");
	error_reporting('0');
	
	?>

	
	
	<?php 

	?>
	<center>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<form action='index.php?view_customers' method='post' name='form_filter' >
<select name="value"><?php  ?>
    <option value="1">K-Beauty</option>
    <option value="2">Food</option>
	<option value="3">Home</option>
    <option value="4">Makeup</option>
	<option value="5">Skincare</option>
</select>
<input type='submit' value = 'Filter'> 
</form>
</center>
	<br>
	<center>
	<h2 colspan="9" style="text-align: center;">View Inventory by Category</h2>
	<br />
	<table width="100%" align="center"> 

	
	<tr align="center" bgcolor="#e3e5e8" style="text-align:center;">
		<th>I.D.</th>
		<th>Name</th>
		
		<th>Price</th>

	</tr>
	
<?php 

if(isset($_POST['value'])) {
	if($_POST['value'] == '1') {
		// query to get all  records  
		$query = "SELECT * FROM products WHERE prod_cat='1'";  
		
	}  
	elseif($_POST['value'] == '2') {  
		// query to get all  records  
		$query = "SELECT * FROM products WHERE prod_cat='2'";  
	} elseif($_POST['value'] == '3') { 
		// query to get all records  
		$query = "SELECT * FROM products WHERE prod_cat='3'";  
	}  
	} elseif($_POST['value'] == '4') { 
		// query to get all records  
		$query = "SELECT * FROM products WHERE prod_cat='4'";  
	}
	elseif($_POST['value'] == '5') { 
		// query to get all records  
		$query = "SELECT * FROM products WHERE prod_cat='5'";  
	}
		
	$sql = mysqli_query($con,$query);  
	

	
	while ($row=mysqli_fetch_array($sql)){ 
		// Echo your rows here... 
		$i = $row['prod_id'];
		$echo = $row['prod_title'];
		$price = '₱' . $row['prod_price'];
	
	



?>


</center>




<tr align="center" style="text-align:center;">
<td><?php echo $i;?></td>
		<td><?php echo $echo;?></td>
		<td><?php echo $price; ?></td>
	
		
		
	
	

<?php
}
?>
</tr>
	</table>