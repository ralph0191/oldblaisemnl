
<div>


<?php 
	include("includes/db.php");

	$total = 0;
	
	global $con; 
	
	$ip = getIp(); 
	$id = "";
	if (isset($_SESSION['customer_email'])) {
		$id = $_SESSION['customer_id'];
	}
	$sel_price = "SELECT * FROM cart WHERE customer_id='$id' AND ip='$ip' ";
	
	$run_price = mysqli_query($con, $sel_price); 
	
	while ($p_price=mysqli_fetch_array($run_price)) {
		$pro_id = $p_price['p_id']; 
		$pro_price = "SELECT * FROM products WHERE prod_id='$pro_id'";
		$run_pro_price = mysqli_query($con,$pro_price); 
		
		while ($pp_price = mysqli_fetch_array($run_pro_price)) {
			$product_price = array($pp_price['prod_price']);
			$product_name = $pp_price['prod_title'];
			$values = array_sum($product_price);
			$total +=$values;
		
		}
	}

?>

<h2 align="center"  style="padding:2px; color:white">Cash on Delivery</h2>

 <form action="paymentcod.php" method="post">



  <!-- Specify a Buy Now button. -->
  <input type="hidden" name="cmd" value="_xclick">

  <!-- Specify details about the item that buyers will purchase. -->
<input type="hidden" name="item_name" value="<?php echo $product_name; ?>">
<input type="hidden" name="item_number" value="<?php echo $pro_id; ?>">
<input type="hidden" name="amount" value="<?php echo $total; ?>">
<input type="hidden" name="currency_code" value="PHP">



  <!-- Display the payment button. -->
  <input type="image" name="submit" border="0"
  src="https://www.paypalobjects.com/webstatic/en_US/i/btn/png/btn_buynow_107x26.png"
  alt="Buy Now">
  <img alt="" border="0" width="1" height="1"
  src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" >

</form>

</div>