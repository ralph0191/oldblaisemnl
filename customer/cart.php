<!DOCTYPE>

<?php
session_start();
include ("functions/functions.php");

?>

<html>

	<head>
		<title>THE SECRET SERVICE.CO</title>
	</head>
	
	<link rel="stylesheet" href="styles/style.css" media="all" />
	
<body>

<!--Main Container starts here!
			↓↓↓↓↓
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

		
		<?php cart(); ?>
		<div class="shopping_cart">
		
		<span style="float:right; font-size:18px; padding:5px; line-height:40px;">
					
					<?php 
					if(isset($_SESSION['customer_email'])){
					echo "<b>Welcome: </b>" . $_SESSION['customer_email'] . "<b style='color:yellow;'>Your</b>" ;
					}
					else {
					echo "<b>Welcome Guest: </b>";
					}
					?> <b style="color:yellow">Shopping Cart -</b> Total Items: <?php total_items(); ?> Total Price: <?php total_price(); ?>
					
					<?php 

		if(!isset($_SESSION['customer_email'])){
			
			echo "<a href='customer_login.php' style='color:yellow;'>Login</a>";
			
		}
		
		else{
			echo "<a href='logout.php' style='color:yellow;'>Logout</a>";
		}

		?>
					
					</span>
		
		</div>
		
		<div id="content_area">
		
		
		<div id="products_box">
		
		<form action="" method="post" enctype="multipart/form-data">
			
			<table align="center" width="750">
				
				
				
				<tr align="center">
					<th>Remove</th>
					<th>Product(s)</th>
					<th>Quantity</th>
					<th>Total Price</th>
				</tr>
				
	<?php
				
	$total = 0;
	
	global $con;
	
	$ip = getIP();
	
	$sel_price = "select * from cart where customer_id='$ip'";
	
	$run_price = mysqli_query($con, $sel_price);
	
	while($p_price=mysqli_fetch_array($run_price)){
		
		$pro_id = $p_price['p_id'];
				
		$pro_qty = $p_price['qty'];
				
		$pro_price = "select * from products where prod_id = '$pro_id'";
		
		$run_pro_price = mysqli_query($con,$pro_price);
		
		while ($pp_price = mysqli_fetch_array($run_pro_price)){
			
			$product_price = array($pp_price['prod_price']);
			$product_title = $pp_price['prod_title'];
			$product_image = $pp_price['prod_image'];
			$single_price = $pp_price['prod_price'];
			
			
			$values = array_sum($product_price);
			
			$total += $values*$pro_qty;
				
	?>
	
				<tr align="center">
					<td width="150"><input type="checkbox" name="remove[]" value="<?php echo $pro_id;?>"/></td>
					<td width="150"><?php echo $product_title; ?><br>
					
					<script>
	function imgError(image) {
    image.onerror = '';
    image.src = '../admin_area/product_images/unavail.png';
    return true;
}
	</script>					
					<img src="../admin_area/product_images/<?php echo $product_image; ?>" width="60px" height="60px" onError='imgError(this);'>
					</td>
					<td width="150"><!---<input type="text" size="4" name="qty">---><input id="" type="text" name="qty[<?php echo $pro_id; ?>]" size="4" value="<?php echo $pro_qty; ?>" style="text-align:center;"/>
                                    <input type="hidden" name="item_id[<?php echo $pro_id; ?>]" value="<?php echo $pro_id; ?>"</td>
					<td width="150"><?php echo "₱" . $single_price ?></td>
				</tr>
				
				<?php }} ?>
				
				<tr align="right">
					<td colspan="5" style="
    padding-right: 50;"><b>Sub Total:</b> <?php echo "₱" . $total?></td>
				</tr>
				
				<tr align="center">
					<td colspan="2" ><input type="submit" name="update_cart" value="Update Cart"/></td>
					
					<?php 
						
						if (isset($_POST['update_cart'])){
                    
                                foreach ($_POST['item_id'] as $key => $id) {
                                
                                    $item_id = $id;
                                    $quantity = $_POST['qty'][$key];
									
																	
                                    $update_products = "UPDATE cart SET qty = '$quantity' WHERE p_id = '$item_id';";
                                    
									$run_update = mysqli_query($con, $update_products);
                        
                                }

							echo "<script>window.open('cart.php','_self')</script>";
						
                            }
						
						?>
					
					<td><input type="submit" name="continue" value="Continue Shopping"/></td>
					<td><button><a href="checkout.php" style="text-decoration:none; color:black;">Checkout</a></button></td>
					
					
					
				</tr>
				
				
		</table>
		</form>
		
		<?php
		
		function updatecart(){
		
		global $con; 
		
		$ip = getIp();
		
		if(isset($_POST['update_cart'])){
		
			foreach($_POST['remove'] as $remove_id){
			
			$delete_product = "delete from cart where p_id='$remove_id' AND customer_id='$ip'";
			
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
	echo @$up_cart = updatecart();
	
	
		?>
		
		</div>
		
		
	</div>
		

		<div id="footer">&copy; 2016 Developed by <a href="#">Paul Banchiran</a>&nbsp;&nbsp;|&nbsp;&nbsp;Design by <a href="#" target="_blank" >Sebastian Roca</a> and <a href="#" target="_blank" >Leanne Fish</a></div>
		
		
	</div>
	<!--		↑↑↑↑↑
		Main Container ends here!-->


		
</body>	
</html>