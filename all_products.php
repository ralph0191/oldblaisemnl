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
		<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
   		<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

		<!--<script src="js/modernizr.custom.js"></script>-->
		<link rel="stylesheet" href="styles/style.css" media="all" type="text/css">

<body>
<?php 
	include("includes/header.php");
	include("includes/cartpanel.php");
?>
<!--Main Container starts here!-->

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
						<h2 style="color:black;">Welcome!</h2><br>
						<p style="color:black;">
							The Blaise MNL is a retailer of premium Korean beauty products, home furniture and assorted food.
						</p>
					</div>
		
					<div class="main_content">
						<div id="products_box">
						<?php cart(); ?>
		<?php getPro();	?>
		
		<?php getCatPro(); ?>
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
<!--Main Container ends here!-->

<!--Footer starts here!-->
<div id="footer">
	<div class="footer_wrapper">
		&copy; 2018 Developed by <a href="#">Regine Lau, Ralph Suga and Vince Villegas</a>&nbsp;&nbsp;|&nbsp;&nbsp;Design by <a href="#" target="_blank" >Danielle Roldan</a> 
	</div>
</div>
<!--Footer ends here!-->
	
</body>	
</html>