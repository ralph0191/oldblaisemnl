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
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="css/component.css" />
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.css"/>
		<link rel="stylesheet" href="styles/style.css" media="all" type="text/css">
		<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
   		<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

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
						<ul id="cats" class="my_account_menu">
						
				<?php 
				$user = $_SESSION['customer_email'];
				
				$get_img = "select * from customers where customer_email='$user'";
				
				$run_img = mysqli_query($con, $get_img); 
				
				$row_img = mysqli_fetch_array($run_img); 
				
				$c_image = $row_img['customer_image'];
				
				$c_name = $row_img['customer_name'];
				
				if ($c_image == NULL){
					echo "<p style='text-align:center;'><img src='customer/customer_images/brad.jpg' alt='customer/customer_images/none.png' onerror='this.onerror=null; this.src='none.png';' width='150' height='150'/></p>";
				}else{
					echo "<p style='text-align:center;'><img src='customer/customer_images/$c_image' alt='customer/customer_images/none.png' onerror='this.onerror=null; this.src='none.png';'' width='150' height='150'/></p>";
				}
				?>
				
				<li><a href="my_account.php?my_orders">My Orders</a></li>
				<li><a href="my_account.php?edit_account">Edit Account</a></li>
				<li><a href="my_account.php?change_pass">Change Password</a></li>
				<li><a href="logout.php">Logout</a></li>
				
				<ul>
					</div>
		
					<div class="main_content">
						<div id="products_box">
						<?php 
				if(!isset($_GET['my_orders'])){
					if(!isset($_GET['edit_account'])){
						if(!isset($_GET['change_pass'])){
							if(!isset($_GET['delete_account'])){
							
				echo "
				<h2 style='padding:20px; color:black;'>Welcome:  $c_name </h2>
				<p style='color:black'><b>You can see your orders progress by clicking this <a href='my_account.php?my_orders'>link</a></b></p>";
				}
				}
				}
				}
				?>
				
				<?php 
				if(isset($_GET['edit_account'])){
				include("edit_account.php");
				}
				if(isset($_GET['change_pass'])){
				include("change_pass.php");
				}
				if(isset($_GET['my_orders'])){
				include("my_orders.php");
				}
				
				?>
						</div>
					
					</div>			
				</div>
			</div>	
			
			<div id="lower-content" >
				<div class="content_low">
					<h3>Contact Us</h3>					
				</div>
				<div id="get-in-touch">
					<<div id="get-in-touch">
					<div class="git_left">
						<p>
							Address: BF HOMES<br>
							Phone: +811 808 80
						</p>
					</div>
					<div class="git right">
						<body>
						<img src="images/BOTTOM.jpg" alt="bottominfo" />
					
						
					</div>
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
		&copy; 2018 Developed by <a href="#">Regine Lau, Vince Villegas & Ralph Suga</a>&nbsp;&nbsp;|&nbsp;&nbsp;Design by <a href="#" target="_blank" >Danielle Roldan</a> 
	</div>
</div>
<!--Footer ends here!-->
	
</body>	
</html>