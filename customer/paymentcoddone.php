
<?php
session_start();
include ("functions/functions.php");
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
			

		?> 
		<div id="content_area">
	
	</div>
	
	
dasdasdasdas

</html>