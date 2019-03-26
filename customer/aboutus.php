<!DOCTYPE>

<?php
session_start();
include ("functions/functions.php");

?>

<html>
	<head>
		<title>About Us</title>
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
		<li class="current_list_item"><a class="about" href="AboutUs.php" >About Us</a></li>
		<li><a href="all_products.php">All Products</a></li>
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
			
				<div id="sidebar_title">My Account:</div>
				
				<ul id="cats">
				<?php 
				$user = $_SESSION['customer_email'];
				
				$get_img = "select * from customers where customer_email='$user'";
				
				$run_img = mysqli_query($con, $get_img); 
				
				$row_img = mysqli_fetch_array($run_img); 
				
				$c_image = $row_img['customer_image'];
				
				$c_name = $row_img['customer_name'];
				
				echo "<p style='text-align:center;'><img src='customer_images/$c_image' width='150' height='150'/></p>";
				
				?>
				<li><a href="my_account.php?my_orders">My Orders</a></li>
				<li><a href="my_account.php?edit_account">Edit Account</a></li>
				<li><a href="my_account.php?change_pass">Change Password</a></li>
				<li><a href="my_account.php?delete_account">Delete Account</a></li>
				<li><a href="logout.php">Logout</a></li>
				
				<ul>
				
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
		
		<div id="upper-content">
		<div id="welcome">
			<h2>About Us</h2>
		</div>
		
		<div id="image"></div>
			</center><br>


			
			<p style="text-indent: 50px;">
	<a href="http://www.code-pal.com" target="_blank"></a>The Secret Service.co is a premium style clothing brand developed by Angela Chaves.
The strive to attain perfection in clothing and design yielded by years of innovative talent and hard work.
			</p>
		</div>
		
	<div id="lower-content">
		<div id="column-header"><h3>Contact us @</h3>
			<p>
		  <address>
Address: #109 Doberman ave. Makati City
<br>
Phone: +811 808 80
            </address>
</p>
			
		</div>
		
		
	</div>
	


	</div>
	
	<div id="footer">&copy; 2016 Developed by <a href="#">Paul Banchiran</a>&nbsp;&nbsp;|&nbsp;&nbsp;Design by <a href="#" target="_blank" >Sebastian Roca</a> and <a href="#" target="_blank" >Leanne Fish</a></div>
	
	</div>	
	</div>
	<!--		↑↑↑↑↑
		Main Container ends here!-->
</body>	
</html>