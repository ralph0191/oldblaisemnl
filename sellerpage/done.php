<?php 
	if(!isset($_SESSION['seller_email'])){
		
		echo "<script>window.open('login.php?not_admin=You are not an Admin!','_self')</script>";
	}
	else {
		$email = $_SESSION['seller_email'];
		$sql = "SELECT 
					order_receipt.receipt_id, order_receipt.datepurchase, order_receipt.Status
				FROM 
					order_receipt
				LEFT JOIN 
					orders ON orders.receipt_id = order_receipt.receipt_id
				LEFT JOIN
					products ON products.prod_id = orders.pro_id AND products.prod_company = '$companyCode'
				WHERE
					order_receipt.Status = 'In Transit'
				GROUP BY
					receipt_id";
		$result = $con->query($sql);
		$order_users = [];
		if ($result->num_rows > 0) {
			$order_users = $result->fetch_all(MYSQLI_ASSOC);
		}
?>
<table style="text-align:center;" id="usetTable" class="table">
	<h3 style="text-align:center;">Confirm Transactions</h3>
        <thead>
			<th>Tracking ID</th>
			<th>Order Date</th>
			<th>Status</th>
			<th>Finish Transaction<th>
	    </thead>
	    <tbody>
            <?php if(!empty($order_users)) { ?>
                <?php foreach($order_users as $order) { ?>
                    <tr>
                    	<td><?php echo $order['receipt_id']; ?></td>
                        <td><?php echo $order['datepurchase']; ?></td>
                        <td><?php echo $order['Status']; ?></td>
						<td>
							<a href="index.php?d_pro=<?php echo $order['receipt_id'];?>">
								<img src="done.png" width="50" height="50">
							</a>
						</td>
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

