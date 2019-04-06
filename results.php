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
						<h2>Search Results</h2><br>
						
					</div>
		
					<div class="main_content">
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
    image.src = 'admin_area/product_images/unavail.png';
    return true;
}
	</script>
			
					<img src='admin_area/product_images/$pro_image' width='180' height='180' onError='imgError(this);' />
					
					<p><b> ₱ $pro_price </b></p>
					
					<a href='all_products.php?add_cart=$pro_id'><button align='center'>Add to Cart</button></a>
	</script>
		</div>
		
		";}
			}
		?>
		<?php
		
		getCatPro();
		
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