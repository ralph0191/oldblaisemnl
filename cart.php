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
		
					<div class="main_content">
								
					
					
					
					
						<div id="cart_box">
		
				<form action="" method="post" enctype="multipart/form-data">
			
			<table align="center" width="100%">
				
				
				
				<tr align="center">
					<th>Remove</th>
					<th>Product(s)</th>
					<th>Price</th>
					<th>Quantity</th>
					<th>SubTotal</th>
				</tr>
				
	<?php
				
	$total = 0;
	$subtotal = 0;
	
	global $con;
	
	$ip = getIP();
	$id = "";
	if (isset($_SESSION['customer_email'])) {
		$id = $_SESSION['user_id'];
	}
	$sel_price = "SELECT * FROM cart WHERE customer_id='$id' OR ip='$ip' ";
	
	$run_price = mysqli_query($con, $sel_price);
	
	while($p_price=mysqli_fetch_array($run_price)){
		
		$pro_id = $p_price['p_id'];
				
		$pro_qty = $p_price['qty'];
				
		$pro_price = "SELECT * FROM products WHERE prod_id = '$pro_id'";
		
		$run_pro_price = mysqli_query($con,$pro_price);
		
		while ($pp_price = mysqli_fetch_array($run_pro_price)){
			
			$product_price = array($pp_price['prod_price']);
			$product_title = $pp_price['prod_title'];
			$product_image = $pp_price['prod_image'];
			$product_qty = $pp_price['prod_qty'];
			$single_price = $pp_price['prod_price'];
			
			
			$values = array_sum($product_price);
			$subtotal =$pro_qty*$single_price;
			$total += $values*$pro_qty;
				
	?>
	
				<tr align="center">
					<td width="150"><input type="checkbox" name="remove[]" value="<?php echo $pro_id;?>"/></td>
					<td width="150"><?php echo $product_title; ?><br>
					
					<script>
	function imgError(image) {
    image.onerror = '';
    image.src = '..admin_area/product_images/unavail.png';
    return true;
}
	</script>					
					<img src="admin_area/product_images/<?php echo $product_image; ?>" width="60px" height="60px" onError='imgError(this);'>
					</td>
					<td> <?php echo $single_price; ?></td>
					<td width="150"><!---<input type="text" size="4" name="qty">---><input id="" type="text" name="qty[<?php echo $pro_id; ?>]" size="4" value="<?php echo $pro_qty; ?>" style="text-align:center;"/>
                                    <input type="hidden" name="item_id[<?php echo $pro_id; ?>]" value="<?php echo $pro_id; ?>"</td>
									
					<?php 
						
						if (isset($_POST['update_cart'])){
							
							foreach ($_POST['item_id'] as $key => $id) {
								$quantity = $_POST['qty'][$key];	
                                if ($quantity <= $product_qty) {
									$item_id = $id;
												
									$update_products = "UPDATE cart SET qty = '$quantity' WHERE p_id = '$item_id';";
									
									$run_update = mysqli_query($con, $update_products);
									echo "<script>window.open('cart.php','_self')</script>";
								}
								else {
								echo "<script>alert('Cannot Process order, we only have $product_qty on stock! ')</script>";
								}
																
							}
							
							
						
						}
						
					?>				
									
					<td width="150"><?php echo "₱" . $subtotal; ?></td>
				</tr>
				
				<?php }} ?>				
				
		</table>	
				
		<div class="cart-btn-wrap">
		<div class="cart-btn">	<input type="submit" name="update_cart" value="Update Cart"/> </div>
										
		<div class="cart-btn">	<input type="submit" name="continue" value="Continue Shopping"/></div> </div>
					
		<div class="check_out">
		<span class='color:black'><b>Total Price:</b> <?php echo "₱" . $total?> </span>
		<button><a href="checkout.php" style="text-decoration:none; color:black;">Checkout</a></button></div>
		
		</form>
		
		<?php
		
		function updatecart(){
		
		global $con; 
		
		$ip = getIp();
		
		if(isset($_POST['update_cart'])){
		
			foreach($_POST['remove'] as $remove_id){
			
			$delete_product = "DELETE FROM cart WHERE p_id='$remove_id' AND ip='$ip'";
			
			$run_delete = mysqli_query($con, $delete_product); 
			
			if($run_delete){
			
			echo "<script>window.open('cart.php','_self')</script>";
			
			}
			
			}
			
		}
		if(isset($_POST['continue'])){
		
		echo "<script>window.open('all_products.php','_self')</script>";
		
		}
	
	}
	echo $up_cart = updatecart();
	
	
		?>
		</div>
		
								
				
						</div>
					
					</div>			
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