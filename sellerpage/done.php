<?php 


if(!isset($_SESSION['user_email'])){
	
	echo "<script>window.open('login.php?not_admin=You are not an Admin!','_self')</script>";
}
else {
	$email = $_SESSION['user_email'];
	$sql = "SELECT 
		orderid, qty, receipt_id, order_date, customer, Status, products.prod_image AS image, products.prod_title AS product_name
	FROM 
		orders
	LEFT JOIN 
		products ON products.prod_id = orders.pro_id
	WHERE
		orders.status = 'In Transit'";	

	$result = $con->query($sql);
	$order_users = [];
	if ($result->num_rows > 0) {
		$order_users = $result->fetch_all(MYSQLI_ASSOC);
	}
?>
<table style="text-align: center; align: center;" id="usetTable" class="table">
        <thead>
            <th>Order ID</th>
            <th>Product (S)</th>
            <th>Quantity</th>
            <th>Product Image</th>
            <th>Order Date</th>
            <th>Customer</th>
            <th>Status</th>
            <th>Receive Order</th>
	    </thead>
	    <tbody>
            <?php if(!empty($order_users)) { ?>
                <?php foreach($order_users as $order) { ?>
                    <tr>
                    <td><?php echo $order['orderid']; ?></td>
					<td><?php echo $order['product_name']; ?></td>
					<td><?php echo $order['qty']; ?></td>
					<td><img src="../admin_area/product_images/<?php echo $order['image'];?>" width="50" height="50"></td>
					<td><?php echo $order['order_date']; ?></td>
					<td><?php echo $order['customer']; ?></td>
					<td><?php echo $order['Status']; ?></td>
					<td><a href="d.php?d_pro=<?php $order['receipt_id'];?>"><img src="done.png" width="50" height="50"></a></td>
					
                    </tr>
                <?php } ?>
            <?php } ?>
    	</tbody>
    </table>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.js"></script>
<script>
$(document).ready(function() {
	$('#usetTable').DataTable();
} );
</script>
<?php } ?>

