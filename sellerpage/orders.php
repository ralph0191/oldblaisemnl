<?php
$sql = "SELECT
orders.orderid, products.prod_title, orders.qty, products.prod_image,
orders.status, orders.order_date, orders.customer, orders.customer_contact,
orders.customer_address
FROM 
orders 
LEFT JOIN
	products 	ON    products.prod_id = orders.pro_id
WHERE
	orders.status = 'Pending'";
$result = $con->query($sql);
$order_users = [];
if ($result->num_rows > 0) {
    $order_users = $result->fetch_all(MYSQLI_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Datatable</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <table id="usetTable" class="table">
        <thead>
            <th>Order ID</th>
            <th>Product (S)</th>
            <th>Quantity</th>
            <th>Product Image</th>
            <th>Order Date</th>
			<th>Customer</th>
			<th>Customer Address</th>
			<th>Customer Contact</th> 
            <th>Status</th>
			<th>Receive Order</th>
	    </thead>
	    <tbody>
            <?php if(!empty($order_users)) { ?>
                <?php foreach($order_users as $order) { ?>
                    <tr>
                        <td><?php echo $order['orderid']; ?></td>
                        <td><?php echo $order['prod_title']; ?></td>
                        <td><?php echo $order['qty']; ?></td>
                        <td>
							<img src="../admin_area/product_images/<?php echo $order['prod_image']; ?>">
						</td>
                        <td><?php echo $order['order_date']; ?></td>
						<td><?php echo $order['customer']; ?></td>
						<td><?php echo $order['customer_address']; ?></td>
						<td><?php echo $order['customer_contact']; ?></td>
						<td><?php echo $order['status']; ?></td>
						<td>
							<a href="r.php?r_pro=<?php echo $receipt;?>">
								<img src="done.png" width="50" height="50">
							</a>
						</td>
                    </tr>
                <?php } ?>
            <?php } ?>
    	</tbody>
    </table>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#usetTable').DataTable();
        } );
    </script>
</body>
</html>