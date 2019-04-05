<!DOCTYPE>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<?php
session_start();
include ("functions/functions.php");

if (!isset($_SESSION['user_email'])){
	
	echo "<script>window.open('login.php?not_admin=You are not an Admin!','_self')</script>";
}
else {
	$email = $_SESSION['user_email'];

if (isset($_GET['orderNo'])){
	
	$receiptId = $_GET['orderNo'];

?>

<html>
	<head>
		<title>Blaise MNL</title>
	</head>
	<link rel="shortcut icon" href="../favicon.ico"> 
    <link rel="stylesheet" type="text/css" href="css/default.css" />
    <link rel="stylesheet" type="text/css" href="css/component.css" />
    
    <script src="js/modernizr.custom.js"></script>
	<link rel="stylesheet" href="styles/style.css" media="all">
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
                <?php 
                $customerName = "";
                $customerContact = "";
                $customerAddress = "";
                $customerPurchase = "";
                
                $selectCustomer = "SELECT customers.customer_name AS CName, customers.customer_address AS Address,
                customers.customer_contact AS Contact, DATE(order_receipt.datepurchase) AS BuyDate, order_receipt.Status AS stats         
                FROM 
                    order_receipt
                LEFT JOIN 
                    customers ON customers.customer_email = order_receipt.cust_email
                WHERE
                    order_receipt.receipt_id = '$receiptId'";
                    
                $runCustomer = $con->query($selectCustomer)  or die($conn->error);
                
                while ($rows = $runCustomer->fetch_assoc()) {
                    $customerName = $rows['CName'];
                    $customerContact = $rows['Contact'];
                    $customerAddress = $rows['Address'];
                    $customerPurchase = $rows['BuyDate'];
                    $status = $rows['stats'];
                }
                ?>
				<div class="upper_content">
					<div class="content_up">
                        <h2>Order Details!</h2><br>
					</div>
					<div class="main_content">
						<div class="row">
                            <div class="col-md-6">
                                <h4>Customer Information</h4>
                                <div class="row" style="text-align:left;">
                                    <div class="col-md-6">
                                        <h5>Name:</h5>
                                    </div>
                                    <div class="col-md-6">
                                        <h5><?php echo $customerName;?></h5>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Contact Number#:</h5>
                                    </div>
                                    <div class="col-md-6">
                                        <h5><?php echo $customerContact;?></h5>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Address:</h5>
                                    </div>
                                    <div class="col-md-6">
                                        <h5><?php echo $customerAddress;?></h5>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Order Date:</h5>
                                    </div>
                                    <div class="col-md-6">
                                        <h5><?php echo $customerPurchase;?></h5>
                                    </div>     
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h4>Order Information</h4>
                                <table width="100%" align="center" > 
                                   <tr align="center" bgcolor="#ff8000" style="text-align:center;">
                                        <th>Name</th>
                                        <th>Quantity</th>
                                        <th>Image</th>
                                        <th>price</th>                                    
                                    </tr>
                                    <?php 
                                        $selectOrder = "SELECT     
                                            products.prod_title AS title, products.prod_image AS ProdImage,
                                            orders.qty AS quantity, products.prod_price AS Price
                                        FROM 
                                            order_receipt
                                        LEFT JOIN 
                                            orders ON orders.receipt_id = order_receipt.receipt_id
                                        LEFT JOIN
                                            products ON products.prod_id = orders.pro_id
                                        WHERE
                                            order_receipt.receipt_id = '$receiptId'";
                                        $totalPay = 0;
                                        $runSelectOrder = $con->query($selectOrder);
                                        while ($rowProd = $runSelectOrder->fetch_assoc()) {
                                            $pro_title = $rowProd['title'];
                                            $qty = $rowProd['quantity'];
                                            $pro_image = $rowProd['ProdImage'];
                                            $price = $rowProd['Price'];

                                            $getValue = $qty * $price;
                                            $totalPay += $getValue;
                                        
                                    ?>
                                    <tr align="center" style="text-align:center;">
                                        <td><?php echo $pro_title;?></td>
                                        <td><?php echo $qty;?></td>
                                        <td><img src="admin_area/product_images/<?php echo $pro_image;?>" width="50" height="50" /></td>
                                        <td><?php echo $price;?></td>
                                   </tr>
                                    <?php 
                                        }
                                    ?>
                                </table> 
                            </div>
                            <div class="col-md-6" style="text-align:left;">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>Status:</h5>
                                    </div>
                                    <div class="col-md-6">
                                        <h5><?php echo $status; ?></h5>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h5>Total Amount: </h5>
                                        </div>
                                        <div class="col-md-6">
                                            <h5> <?php echo $totalPay; ?></h5>
                                        </div>
                                    </div>
                                </div>
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
		&copy; 2018 Developed by <a href="#">Regine Lau, Ralph Suga and Vince Villegas</a>&nbsp;&nbsp;|&nbsp;&nbsp;Design by <a href="#" target="_blank" >Danielle Roldan</a> 
	</div>
</div>
<!--Footer ends here!-->
<?php
    }
}

?>
</body>	
</html>