<?php 


if(!isset($_SESSION['user_email'])){
	
	echo "<script>window.open('login.php?not_admin=You are not an Admin!','_self')</script>";
}
else {
?>
<table width="1000px" align="center" > 

	
	<tr align="center">
		<td colspan="11"><h2>Pending Orders</h2></td>
	</tr>
	
	<tr align="center" bgcolor="#ff8000" style="text-align:center;">
		<th>Order ID</th>
		<th style="display:none">transaction ID</th>
		<th>Product (S)</th>
		<th>Quantity</th>
		<th>Product Image</th>
		<th>Order Date</th>
		<th>Customer</th>
		<th>customer address</th>
		<th>customer contact</th>
		<th>Status</th>
		<th>Receive Order</th>
		
	</tr>
	<?php 
	include("includes/db.php");
	
	$email = $_SESSION['customer_email'];
	
	$get_order = "select * from orders where status= 'Pending'";
	
	$run_order = mysqli_query($con, $get_order); 
	
	while ($row_pro=mysqli_fetch_array($run_order)){
		$receipt = $row_pro['receipt_id'];
		$order_id = $row_pro['orderid'];
		$qty = $row_pro['qty'];
		$pro_id = $row_pro['pro_id'];
		$order_date = $row_pro['order_date'];
		$cust = $row_pro['customer'];
		$status = $row_pro['status'];
		$address = $row_pro['customer_address'];
		$contact = $row_pro['customer_contact'];
		$i++;
		
		$get_pro = "select * from products where prod_id='$pro_id'";
		$run_pro = mysqli_query($con, $get_pro); 
		
		$row_pro=mysqli_fetch_array($run_pro); 
		
		$pro_image = $row_pro['prod_image']; 
		$pro_title = $row_pro['prod_title'];
	

		
?>

	<tr align="center" style="text-align:center;">
			<td><?php echo $order_id;?></td>
		<td style="display:none"><?php echo $receipt;?></td>
		<td><?php echo $pro_title;?></td>
			<td><?php echo $qty;?></td>
		<td><img src="../admin_area/product_images/<?php echo $pro_image;?>" width="50" height="50" /></td>
		
		<td><?php echo $order_date;?></td>
		<td><?php echo $cust;?></td>
		<td><?php echo $address;?></td>
		<td><?php echo $contact;?></td>
		<td><?php echo $status;?></td>
		<td><a href="r.php?r_pro=<?php echo $receipt;?>"><img src="done.png" width="50" height="50"></a></td>
		
	</tr>
	<?php


	}


	?>
</table>

<?php } ?>

