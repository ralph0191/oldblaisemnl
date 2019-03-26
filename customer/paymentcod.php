
<?php
session_start();
include ("functions/functions.php");
include ("includes/db.php");
$email = $_SESSION['customer_email'];








?>
<html>
<link rel="stylesheet" href="styles/style.css" media="all" />


	<head>
		<title>THE SECRET SERVICE.CO</title>
	</head>
	

	
<body>

<!--Main Container starts here!
			?????
-->
	<div class="mainwrapper">

<!--Header starts here-->
		<div class="header_wrapper">
		
		<h1><span>THE SECRET</span>SERVICE</h1>
		
		<a href="cart.php"><img class="imagedropshadow" id="imgcart" src="images/cartimg.png"></a>
		
		</div>
<!--Header ends here-->

<!--Menubar starts here-->
		<div class="menubar">

		<ul id="menu">
		
		<li><a class="home" href="index.php" >Home</a></li>
		<li><a href="AboutUs.php" >About Us</a></li>
		<li class="current_list_item"><a href="all_products.php">All Products</a></li>
        
		
		</ul>
		
		<div id="form">
		<form method="get" action="results.php" enctype="multipart/form-data">
		<input type="text" class="searchfrm" name="user_query" placeholder="Search for a product"/>
		<input  type="submit" class="searchbtn" name="search" value="Search" />
		
		</form>
		</div>
		
		</div>
<!--Menubar ends here-->

<!--Content starts here-->
		<div class="content_wrapper">
		
		<div id="sidebar">
		
		<div id="sidebar_title">Categories</div>
		
		<ul id="cats">
		
		<?php
		
		getCats();
		
		?>
		
		</ul>
		
		
		
		</div>
		
		 <?php
		if(isset($_SESSION['customer_email'])){
		
		
		$set = "select * from customers where customer_email='$email'";
		
		$run_set = mysqli_query($con, $set); 
		
		while($s=mysqli_fetch_array($run_set)){
			
			$cname = $s['customer_name'];
			$ccountry = $s['customer_country'];
			$ccity = $s['customer_city'];
			$ccontact = $s['customer_contact'];
			$caddress = $s['customer_address'];
			 
			}
	}
			
if(isset($_POST['update'])){


	
$get_qty = "select * from cart";			
$run_qty = mysqli_query($con, $get_qty);	
			
			while($row_qty = mysqli_fetch_array($run_qty)){
				$id = $row_qty['p_id'];
				$qty = $row_qty['qty'];	
				
				$test_sql = "select prod_price from products where prod_id='$id'";
				$run_test = mysqli_query($con, $test_sql); 
				$row_test = mysqli_fetch_array($run_test);
				
				$price = $row_test['prod_price']; 
				$total = $price * $qty;
				
				$sql = "Insert into orders (qty,pro_id,order_date,customer,Status) VALUES ('$qty','$id',CURDATE(),'$email','Pending')";
				$run4 = mysqli_query($con, $sql) or die(mysqli_error($con));
			
				$query3 = "UPDATE products SET prod_qty = prod_qty - '$qty' WHERE prod_id = '$id'";
				$result3 = mysqli_query($con, $query3); 
	
				$ip = getIp(); 
					
				$query2 = "Insert into sales (sale_date,sale_product_id,sale_buyer,sale_qty,sale_amount) VALUES (CURDATE(),'$id','$email','$qty','$total')";
				$run3 = mysqli_query($con, $query2) or die(mysqli_error($con));			

				if($result3){
		
					echo "<script>alert('Your purchase is complete, You can view your order's status on my order tab')</script>";
					echo "<script>window.open('my_account.php?my_orders','_self')</script>";
					
					$reset = "DELETE FROM cart";
					$run = mysqli_query($con, $reset) or die(mysqli_error($con));
		
				} 
			}
}
			

//$query2 = "Insert into logs (damitId,date,qtyordered,totalamtPESO,addressdelivery) VALUES ('$product_code',CURDATE(),'$product_qty','$grand_total','$location')";

		?> 
		<div id="content_area">
		<br><br><br><br>
		
		
		<center>
		<h2>Delivery Details</h2>
<table>
	<form method="post" action=""> 						
						<tr>
							<td align="center">Customer Name:</td>
							<td><input type='text' name='name' placeholder='Name' value="<?php echo $cname; ?>" required/></td>
						</tr>
						<tr>
							<td align="center"> Address:</td>
							<td><input type='text' name='address' placeholder='Name' value="<?php echo $caddress; ?>" required/></td>
						</tr>
						
						<tr>
							<td align="center">City:</td>
							<td><input type='text' name='city' placeholder='Name' value="<?php echo $ccity; ?>" required/></td>
						</tr>
						<tr>
							<td align="center">Country:</td>
							<td><select name="country" disabled>
								<option><?php echo $ccountry; ?></option>
							</select></td>
						</tr>
						<tr>
							<td align="center"> Contact Number:</td>
							<td><input type='text' name='contact' placeholder='Name' value="<?php echo $ccontact; ?>" required/></td>
						</tr>
						
				
	
	
	
</table>
<br>

		<input type="submit" name="update" value="Confirm Details" />
		</form>
	</center>
	</div>
	
	
<?php


?>

</html>