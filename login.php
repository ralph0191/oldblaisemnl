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
						<h2>Log In</h2><br>
						
					</div>
		
					<div class="main_content">
						<div id="login_box">
						<form action="login.php" method="post" id="frmLogin" enctype="multipart/form-data">
					<div class="error-message"><?php if(isset($message)) { echo $message; } ?></div>	
					<div class="field-group">
					<div><label for="login">Email</label></div>
					<div><input name="email" type="text" class="input-field"></div>
					</div>
					<div class="field-group">
					<div><label for="password">Password</label></div>
					<div><input name="pass" type="password" class="input-field"> </div>
					</div>
					<div class="field-group">
					<div><input type="submit" class="login" name="login" value="Login" class="form-submit-button"></span></div>
					</div>       
				</form>
				
				<?php
				if(isset($_POST['login'])){
					$c_email = $_POST['email'];
					$c_pass = $_POST['pass'];						
					$message="";
						if(!empty($_POST["login"])) {
							$sel_c = "select * from customers where customer_pass='$c_pass' AND customer_email='$c_email'";		
							$run_c = mysqli_query($con, $sel_c);
							$check_customer = mysqli_num_rows($run_c); 
							
							if($check_customer==0){
								echo "<script>alert('Password or email is incorrect, please try again!')</script>";
								return true;
							} else {
								$_SESSION["user_id"] = $check_customer['customer_id'];
								$_SESSION['customer_address'] = $check_customer['customer_address'];
								$_SESSION['customer_email'] = $check_customer['customer_email'];
							}
							
							$cus_id = $_SESSION["user_id"]; 
							$sel_cart = "select * from cart where customer_id='$cus_id'";
							$run_cart = mysqli_query($con, $sel_cart); 
							$check_cart = mysqli_num_rows($run_cart); 
							
							if($check_customer>0 AND $check_cart==0){
								$_SESSION['customer_email']=$c_email; 
								echo "<script>alert('You logged in successfully!')</script>";
								echo "<script>window.open('index.php','_self')</script>";							
							}
						}
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
		&copy; 2018 Developed by <a href="#">Regine Lau & Ralph Suga</a>&nbsp;&nbsp;|&nbsp;&nbsp;Design by <a href="#" target="_blank" >Miguel Delos Santos</a> 
	</div>
</div>
<!--Footer ends here!-->
	
</body>	
</html>