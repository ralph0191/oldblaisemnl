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
					$c_email = mysqli_real_escape_string($con,$_POST['email']);
					$c_pass = mysqli_real_escape_string($con,$_POST['pass']);						
					$message="";

						if (!empty($_POST["login"])) {
							$sel_c = "SELECT * FROM customers WHERE customer_pass='$c_pass' AND customer_email='$c_email'";		
							$result = $con->query($sel_c);

							if ($result->num_rows > 0) {
								while ($row = $result->fetch_assoc()) {
									$_SESSION['customer_name'] = $row['customer_name'];
									$_SESSION["customer_id"] = $row['customer_id'];
									$_SESSION['customer_email'] = $row['customer_email'];
								}
							}
							else {
								echo "<script>alert('Password or email is incorrect, please try again!')</script>";
								return true;
							}
							
							$ip = getIp();
							$cus_id = $_SESSION["customer_id"];
							$sel_cart = "SELECT * FROM cart WHERE customer_id = '$cus_id' OR ip = '$ip'";
							$run_cart = mysqli_query($con, $sel_cart); 
							$check_cart = mysqli_num_rows($run_cart); 
							
							if($result->num_rows > 0 AND $check_cart === 0) {
								echo "<script>alert('You logged in successfully!')</script>";
								echo "<script>window.open('index.php','_self')</script>";							
							}
							else {
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