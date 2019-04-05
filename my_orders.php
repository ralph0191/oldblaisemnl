<?php 

	$sql = "SELECT
		orders.orderid, products.prod_title, orders.qty, products.prod_image, orders.status, orders.order_date
	FROM 
		orders 
	LEFT JOIN
		products ON products.prod_id = orders.pro_id
	WHERE
		 orders.customer = 'eizen'
		 ORDER BY orders.order_date DESC";
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
		<th>Order ID</th>
		<th>Product (S)</th>
		<th>Quantity</th>
		<th>Order Date</th>
		<th>Status</th>
	</thead>
	<tbody>
		<?php if(!empty($order_users)) { ?>
			<?php foreach($order_users as $order) { ?>
				<tr>
					<td><?php echo $order['orderid']; ?></td>
					<td><?php echo $order['prod_title']; ?></td>
					<td><?php echo $order['qty']; ?></td>
					<td><?php echo $order['status']; ?></td>
					<td><?php echo $order['order_date']; ?></td>
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

