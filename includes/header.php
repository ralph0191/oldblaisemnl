<!--Header starts here-->
<div class="header_wrapper">
	<div class="header">
		<div class="logo">
			<h1><span>BLAISE</span>MNL</h1>
		</div>
	<!--Menubar starts here-->
		<div class="menu_wrapper">
			<div class="menubar">
				<ul id="menu">		
					<li class="current_list_item"><a class="home" href="index.php" >Home</a></li>
					<li><a href="AboutUs.php" >About Us</a></li>
					<li><a href="all_products.php">All Products</a></li>				
				<?php 
					if(isset($_SESSION['customer_email'])){

					}
					else {
						echo "<li><a href='customer_register.php'>Register</a></li>";
					}
				?>
				</ul>

				<div id="form" class="search_form">
					<form method="get" action="results.php" enctype="multipart/form-data">
					<input type="text" class="searchfrm" name="user_query" placeholder="Search for a product"/>
					<input  type="submit" class="searchbtn" name="search" value="Search" />
					</form>
				</div>
			</div>
		</div>
	<!--Menubar ends here-->
	</div>	
</div>