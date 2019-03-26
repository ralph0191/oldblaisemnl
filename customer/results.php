<!DOCTYPE>

<?php

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
        <li><a href="my_account.php">My Account</a></li>
		
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
			
			echo "<a href='../customer_login.php' style='color:yellow;'>Login</a>";
			
		}
		
		else{
			echo "<a href='logout.php' style='color:yellow;'>Logout</a>";
		}

		?>
					
					</span>
		
		</div>
		
		<div id="content_area">
		
		
		
		<div id="products_box">
		
		<?php 
	
			if(isset($_GET['search'])){
				
	$search_query = $_GET['user_query'];
		
	$get_pro = "select * from products where prod_title like '%$search_query%'";
	
	$run_pro = mysqli_query($con, $get_pro);
	
	while($row_pro = mysqli_fetch_array($run_pro)){
		
		$pro_id = $row_pro['prod_id'];
		$pro_title = $row_pro['prod_title'];
		$pro_cat = $row_pro['prod_cat'];
		$pro_qty = $row_pro['prod_qty'];
		$pro_price = $row_pro['prod_price'];
		$pro_image = $row_pro['prod_image'];
		
		echo "
		
		<div id='single_product'>
		
			<h4>$pro_title</h4>
					
					<script>
	function imgError(image) {
    image.onerror = '';
    image.src = '../admin_area/product_images/unavail.png';
    return true;
}
	</script>
			
					<img src='../admin_area/product_images/$pro_image' width='180' height='180' onError='imgError(this);' />
					
					<p><b> ₱ $pro_price </b></p>
					
					<a href='all_products.php?add_cart=$pro_id'><button align='center'>Add to Cart</button></a>
			
		</div>
		
		";
	}	
	}

		?>
		<?php
		
		getCatPro();
		
		?>
		
		
		</div>
		
		
</script>
		
	</div>
		

		<div id="footer">&copy; 2016 Developed by <a href="#">Paul Banchiran</a>&nbsp;&nbsp;|&nbsp;&nbsp;Design by <a href="#" target="_blank" >Sebastian Roca</a> and <a href="#" target="_blank" >Leanne Fish</a></div>
		
		
	</div>
	<!--		↑↑↑↑↑
		Main Container ends here!-->


		
</body>	
</html>