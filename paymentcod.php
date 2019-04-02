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
		
		
		$set = "select * from customers where customer_email='$email'";
		
		$run_set = mysqli_query($con, $set); 
		
		while($s=mysqli_fetch_array($run_set)){
			$cid = $s['customer_id'];
			$cname = $s['customer_name'];
			$ccountry = $s['customer_country'];
			$ccity = $s['customer_city'];
			$caddress=$s['customer_address'];
			$contact = $s['customer_contact'];
			}
	}
			
if (isset($_POST['update'])){
	$get_qty = "SELECT * FROM cart";			
	$run_qty = mysqli_query($con, $get_qty);	
	$reciptsql = "INSERT INTO order_receipt (cust_email,total) VALUES ('$email', '0')";
	$run5 = mysqli_query($con, $reciptsql);
	$selreceipt= mysqli_query($con,"select MAX(receipt_id) as maxid from order_receipt");
	$rowxsd =mysqli_fetch_assoc($selreceipt);
	$maxidx= $rowxsd['maxid'];

	while ($row_qty = mysqli_fetch_array($run_qty)){
		$id = $row_qty['p_id'];
		$qty = $row_qty['qty'];	
		$arraysum = array_sum($qty);
		$test_sql = "select prod_price from products where prod_id='$id'";
		$run_test = mysqli_query($con, $test_sql); 
		$row_test = mysqli_fetch_array($run_test);
				
		$price = $row_test['prod_price']; 
		$total = $price * $qty;
		$sql = "Insert into orders (receipt_id, qty, pro_id, order_date, customer, Status, customer_address, recieved_by, customer_contact, date_paid) 
					VALUES ('$maxidx','$qty','$id',CURDATE(),'$email','Pending','$caddress', 'N/A', '123', '')";
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