<!DOCTYPE>

<?php
session_start();
include ("functions/functions.php");

?>

<html>
	<head>
		<title>Blaise MNL</title>
	</head>
		<link rel="shortcut icon" href="../favicon.ico"> 
		<link rel="stylesheet" type="text/css" href="css/default.css" />
		<link rel="stylesheet" type="text/css" href="css/component.css" />
		<!--<script src="js/modernizr.custom.js"></script>-->
		<link rel="stylesheet" href="styles/style.css" media="all" type="text/css">

<body>
<?php 
	include("includes/header.php");
	include("includes/cartpanel.php");
?>
		

<!--Content starts here-->
	<div class="content_wrapper">
		<div id="content_area">
			<div class="upper_content">
				<div id="sidebar">		
					<div id="sidebar_title">Categories</div>
						<ul id="cats">		
							<?php getCats(); ?>		
						</ul>		
				</div>			
				
				<div class="upper_content">
					<div class="content_up">
						<h2>Welcome!</h2><br>
						<p>
							The Blaise MNL is a retailer of premium Korean beauty products, home furniture and assorted food.
						</p>
					</div>
				</div>
					<div class="main_content">
		
		 <?php
		if(isset($_SESSION['customer_email'])){
		
		$email = $_SESSION['customer_email'];
		
		
		$set = "SELECT * FROM customers WHERE customer_email='$email'";
		
		$run_set = mysqli_query($con, $set); 
		
		while($s=mysqli_fetch_array($run_set)){
			$cid = $s['customer_id'];
			$cname = $s['customer_name'];
			$ccountry = $s['customer_country'];
			$ccity = $s['customer_city'];
			$caddress=$s['customer_address'];
			$contact = $s['customer_contact'];
			$_SESSION = $contact;
			}
	}
			
if (isset($_POST['update'])){
	$ip = getIp();
	$id = "";
	if (isset($_SESSION['customer_email'])) {
		$id = $_SESSION['user_id'];
	}
	$get_qty = "SELECT * FROM cart WHERE customer_id = '$id' OR ip='$ip'";			
	$run_qty = mysqli_query($con, $get_qty);	
	$reciptsql = "INSERT INTO `order_receipt` (`cust_email`, `Status`) VALUES ('$email', 'Pending')";
	$run5 = mysqli_query($con, $reciptsql);
	
	$get_receipt = "SELECT 
		MAX(receipt_id) AS maxid 
	FROM 
		order_receipt
	WHERE 
		cust_email = '$email'
	";
	$receipt = $con->query($get_receipt);

	$receiptMax = 0;
	if ($receipt->num_rows > 0) {
		while ($row = $receipt->fetch_assoc()) {
			$receiptMax = $row['maxid'];
		}
	}
	$getAgain = "SELECT * FROM cart WHERE customer_id = '$id' OR ip='$ip'";			
	$runGet = $con->query($getAgain);
	while ($rows = $runGet->fetch_assoc()) {
		$prodId = $rows['p_id'];
		$prodQty = $rows['qty'];
		$customer = $rows['customer_id'];

		$insertOrderSQL = "INSERT INTO `orders` (`receipt_id`, `qty`, `pro_id`, `order_date`, `CustomerID`, `Status`, `recieved_by`) 
		VALUES ($receiptMax, $prodQty, $prodId, CURDATE(), $customer, 'Pending', 'None')";
		$runInsertSQL = mysqli_query($con, $insertOrderSQL) or die(mysqli_error($con));
		$reduceProductSQL = "UPDATE products SET prod_qty = prod_qty - '$prodQty' WHERE prod_id = '$prodId'";
		$runReduceSQL = mysqli_query($con, $reduceProductSQL) or die(mysqli_error($con));
	
		if($runReduceSQL){

			echo "<script>window.open('my_account.php?my_orders','_self')</script>";	
			echo "<script>alert('Your purchase is complete, You can view your order's status on my order tab')</script>";
			
			$reset = "DELETE FROM cart WHERE customer_id = '$id' OR ip='$ip'";
			$run = mysqli_query($con, $reset) or die(mysqli_error($con));
		}
	}
	/*
	while ($row_qty = mysqli_fetch_array($run_qty)){
		$prodId = $row_qty['p_id'];
		$qty = $row_qty['qty'];	
		$arraysum = array_sum($qty);
		$test_sql = "SELECT prod_price FROM products WHERE prod_id='$prodId'";
		$run_test = mysqli_query($con, $test_sql); 
		$row_test = mysqli_fetch_array($run_test);
				
		$price = $row_test['prod_price']; 
		$total = $price * $qty;
		$sql = "INSERT INTO orders (receipt_id, qty, pro_id, order_date, customer, Status, customer_address, recieved_by, customer_contact, date_paid) 
					VALUES ('$receipt','$qty','$proId',CURDATE(),'$email','Pending','$caddress', 'N/A', '', '')";
		$run4 = mysqli_query($con, $sql) or die(mysqli_error($con));
		
		$query3 = "UPDATE products SET prod_qty = prod_qty - '$qty' WHERE prod_id = '$proId'";
		$result3 = mysqli_query($con, $query3); 

		$ip = getIp(); 
			
		if($result3){

			echo "<script>window.open('my_account.php?my_orders','_self')</script>";	
			echo "<script>alert('Your purchase is complete, You can view your order's status on my order tab')</script>";
			
			$reset = "DELETE FROM cart WHERE customer_id = '$id' OR ip='$ip'";
			$run = mysqli_query($con, $reset) or die(mysqli_error($con));
		} 
	}*/
}
			?> 



		
		<div class="payment_box">	
		
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
		<td align="center"> Contact Number:	</td>
		<td><input type='text' name='contact' placeholder='Name' value="<?php echo $contact; ?>" required/></td>
	</tr>
</table>
<br>	

	<input type="submit" name="update" value="Confirm Details" class="confirm_details"/>
	</form>
	</center>
	</div>			
		</div>
			
			</div>		
			
			<div id="lower-content" >
				<div class="content_low">
					<h3>Contact Us</h3>					
				</div>
				<div id="get-in-touch">
					<div class="git_left">
						<p>
							Address: BF HOMES<br>
							Phone: +811 808 80
						</p>
					</div>
					<div class="git right">
						<h3>How's our website? Add your suggestions!</h3>
						<ul id="contact-list">
							<li>Name:<input type="text"></input></li>
							<li>Email:<input type="text"></input></li>
							<li id="message">Message:<textarea rows="3"  ></textarea></li>
							<a href="#">Send</a>
						</ul>
					</div>
				</div>
			</div>
		</div>	
	</div>
	</div>
<!--Main Container ends here!-->

<!--Footer starts here!-->

<div id="footer">
	<div class="footer_wrapper">
		&copy; 2018 Developed by <a href="#">Regine Lau & Ralph Suga</a>&nbsp;&nbsp;|&nbsp;&nbsp;Design by <a href="#" target="_blank" >Miguel Delos Santos</a> 
	</div>
</div>
<!--Footer ends here!-->
	
</body>	
</html>