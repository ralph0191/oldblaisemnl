<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php

include("includes/db.php");

?>


<html xmlns="http://www.w3.org/1999/xhtml">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

	<head>
		<title>Insert Products</title>
	</head>
	
<body>

<form action="" method="POST" enctype="multipart/form-data">

	<table align="left" width="100%">

		<tr align="center">
			<td colspan="3"><h2>Insert New Items Here</h2></td>
		</tr>
		
		<tr>
			<td align="center" style="padding:10px;"><b>Product Title:</b></td>
			<td align="center" colspan="2"><input class="form-control" type="text" name="prod_title" required/></td>
		</tr>

		<tr>
			<td align="center" style="padding:10px;"><b>Product Category:</b></td>
			<td align="center" colspan="2"><select class="form-control" name="prod_cat" required><option>Select a Category</option>
			
			<?php
				$get_cats = "SELECT * FROM categories";
				
				$run_cats = mysqli_query($con,$get_cats);
				
				while($row_cats=mysqli_fetch_array($run_cats)){
					
					$cat_id = $row_cats['cat_id'];
					$cat_title = $row_cats['cat_title'];
					echo "<option value='$cat_id'>$cat_title</option>";
				}
			?>
			
			</select>
			</td>
		</tr>

		<tr>
			<td align="center" style="padding:10px;"><b>Product Quantity:</b></td>
			<td align="center" colspan="2" ><input type="number" class="form-control" name="prod_qty" required/></td>
		</tr>

		<tr>
			<td align="center" style="padding:10px;"><b>Product Price:</b></td>
			<td align="center" colspan="2"><input type="text" class="form-control" name="prod_price" required/></td>
		</tr>
		<tr>
			<td align="center" style="padding:10px;"><b>Product Description:</b></td>
			<td align="center" colspan="2"><input class="form-control" type="text" name="prod_desc" required/></td>
		</tr>

		<tr>
			<td align="center" style="padding:10px;"><b>Product Image:</b></td>
			<td align="center"><input type="file" name="prod_image" style="padding-left:70px;" required/></td>
		</tr>
		<tr>
			<td colspan="3" align="center" style="padding:10px;"><input type="submit" name="insert_post" value="Insert Product" /></td>
		</tr>

	</table>

</form>


</body>

</html>


<?php

if(isset($_POST['insert_post'])){
	
	//getting text data from the fields
	$companyCode = $_SESSION['company_code'];
	$prod_title =  mysqli_real_escape_string($con,$_POST['prod_title']);
	$prod_cat = mysqli_real_escape_string($con, $_POST['prod_cat']);
	$prod_qty = mysqli_real_escape_string($con,$_POST['prod_qty']);
	$prod_price = mysqli_real_escape_string($con, $_POST['prod_price']);
	$prod_desc = mysqli_real_escape_string($con, $_POST['prod_desc']);
	
	//getting file data from the field/s
	$prod_image = $_FILES['prod_image']['name'];
	$prod_tmp_image = $_FILES['prod_image']['tmp_name'];
	
	move_uploaded_file($prod_tmp_image, "../admin_area/product_images/$prod_image");
	
	$insert_prod = "INSERT INTO 
						`products` (`prod_title`, `prod_cat`, `prod_company`,`prod_qty`, `prod_price`, `prod_image`, `prod_desc`) 
					VALUES ('$prod_title', '$prod_cat', '$companyCode', '$prod_qty', '$prod_price', '$prod_image', '$prod_desc')";
	$insert_pro=mysqli_query($con,$insert_prod);	
		echo "<script>alert('Product has been inserted!')</script>";
		echo "<script>window.open('#')</script>";
		
	
	
}
?>