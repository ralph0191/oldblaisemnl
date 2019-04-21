<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php

include ("includes/db.php");
	/*if(!isset($_SESSION['user_email'])){
		
		echo "<script>window.open('login.php?not_admin=You are not an Admin!','_self')</script>";
	}*/
	$getCompany = "SELECT * FROM company";
	
	$result = $con->query($getCompany);					
	$order_company = [];
	if ($result->num_rows > 0) {
		$order_company = $result->fetch_all(MYSQLI_ASSOC);
	}		
	
?>


<html xmlns="http://www.w3.org/1999/xhtml">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

	<head>
		<title>Insert Seller</title>
	</head>
	
	<body>

		<form action="" method="POST" enctype="multipart/form-data">
			<table align="center" width="780">
				<tr align="center">
					<td colspan="3"><h2>Add new Seller</h2></td>
				</tr>
				<tr>
					<td align="center" style="padding:10px;"><b>Email Address</b></td>
					<td align="center" colspan="2"><input type="email" name="prod_title" required/></td>
				</tr>
				<tr>
					<td align="center" style="padding:10px;"><b>First Name</b></td>
					<td align="center" colspan="2"><input type="text" name="prod_first" required/></td>
				</tr>
				<tr>
					<td align="center" style="padding:10px;"><b>Last Name</b></td>
					<td align="center" colspan="2"><input type="text" name="prod_last" required/></td>
				</tr>
				<tr>
					<td align="center" style="padding:10px;"><b>Seller password</b></td>
					<td align="center" colspan="2"><input type="password" name="staff_pass" required/></td>
				</tr>
				<tr>
					<td align="center" style="padding:10px"><b>Seller Company </b></td>
					<td align="center" colspan="2"> 
						<select class="form-control" id="select" required>
							<?php if(!empty($order_company)) { ?>
								<?php foreach($order_company as $order) { ?>
										<option value="<?php echo $order['CompanyCode']; ?>"><?php echo $order['CompanyName']; ?></option>
								<?php } ?>
							<?php } ?>
						</select>
					</td>
				</tr>
				<tr>
					<td colspan="3" align="center" style="padding:10px;"><input type="submit" name="insert_post" value="Add SELLER!" /></td>
				</tr>

			</table>

		</form>


	</body>

</html>


<?php

if(isset($_POST['insert_post'])){
	
	//getting text data from the fields
	
	$prod_title = mysqli_real_escape_string($con, $_POST['prod_title']);
	$staff_pass = mysqli_real_escape_string($con, $_POST['staff_pass']);
	$prod_first = mysqli_real_escape_string($con, $_POST['prod_first']);
	$prod_last = mysqli_real_escape_string($con, $_POST['prod_last']);
	
	//getting file data from the field/s
	//$prod_image = $_FILES['prod_image']['name'];
	//$prod_tmp_image = $_FILES['prod_image']['tmp_name'];
	
	//move_uploaded_file($prod_tmp_image, "product_images/$prod_image");
	  
	  
	  $check=mysqli_query($con,"SELECT * FROM staff WHERE staff_email='$prod_title'");
    $checkrows=mysqli_num_rows($check);
	
	if ($checkrows>0) {
		echo "<script>alert('Staff exists! Please try again')</script>";
		echo "<script>window.open('index.php?insert_seller!','_self')</script>";
	
	} 
	
	else{
	
	$insert_prod = "INSERT INTO staff (staff_email,staff_pass, FirstName, LastName) 
		VALUES ('$prod_title','$staff_pass', '$prod_first', '$prod_last')";

	$insert_pro=mysqli_query($con,$insert_prod);
	
	if($insert_pro){
		
		echo "<script>alert('Staff has been added!')</script>";
		echo "<script>window.open('index.php?insert_seller!','_self')</script>";
		
	}
	
}
}
?>