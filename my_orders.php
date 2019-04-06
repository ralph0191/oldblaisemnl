<?php 
	$user = $_SESSION['customer_email'];
	$sql = "SELECT receipt_id, datepurchase, cust_email, Status
	FROM order_receipt
	WHERE cust_email = '$user'
	ORDER BY receipt_id DESC";
	$result = $con->query($sql);
	$order_users = [];
	if ($result->num_rows > 0) {
		$order_users = $result->fetch_all(MYSQLI_ASSOC);
	}
?>
<h1>MY ORDERS</h1>
<br/>
<table align="center" id="usetTable" class="table"> 
	<thead>
		<th>tracking ID</th>
		<th>Order Date</th>
		<th>Status</th>
		<th>Action</th>
	</thead>
	<tbody>
		<?php if(!empty($order_users)) { ?>
			<?php foreach($order_users as $order) { ?>
				<tr>
					<td><a href="orderdetails.php?orderNo=<?php echo $order['receipt_id']; ?>"><?php echo $order['receipt_id']; ?></a></td>
					<td><?php echo $order['datepurchase']; ?></td>
					<td><?php echo $order['Status']; ?></td>
					
					<<td><a class="btn btn-danger" href="orderdetails.php?orderNo=<?php echo $order['receipt_id']; ?>">Delete</a></td>
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

