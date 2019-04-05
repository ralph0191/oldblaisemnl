<div class="main_wrapper">
    <div class="login_details">
        <?php 
            if(isset($_SESSION['customer_email'])){
                echo "<b>Welcome: </b>" . $_SESSION['username'] ;
                echo "<span class='my_account'><a href='my_account.php'> My Account </a></span>";
            }
            else {
                echo "<b>Welcome Guest: </b>";
            }
        ?>	
        <?php 

            if(!isset($_SESSION['customer_email'])){
        
                echo "<a href='login.php' style='color:teal;'>Login</a>";}
    
            else{
                echo "<a href='logout.php' style='color:teal;'>- Logout</a>";
            }
            ?>	
			</div>
            <div class="shopping_cart">		
                <div class="shopping_details">
                    <a href="cart.php"><img class="imagedropshadow" id="imgcart" src="images/cartpink.png"></a>
                    <span class="item_details"><b style="color:black">Shopping Cart</b> - Total Items: <?php total_items(); ?> Total Price: <?php total_price(); ?>  </span>
                </div>		
            </div>
		