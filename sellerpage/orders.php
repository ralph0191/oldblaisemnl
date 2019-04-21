<?php
$sql = "SELECT 
            order_receipt.receipt_id, order_receipt.datepurchase, order_receipt.Status
        FROM 
            order_receipt
        LEFT JOIN 
            orders ON orders.receipt_id = order_receipt.receipt_id
        LEFT JOIN
            products ON products.prod_id = orders.pro_id AND products.prod_company = '$companyCode'
        WHERE
            order_receipt.Status = 'Pending'
        GROUP BY
            receipt_id";
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
        <h3 style="text-align:center;">Recieve Orders</h3>
        <table id="usetTable" class="table">
        <thead align="center">
            <th>Tracking ID</th>
            <th>Order Date</th>
            <th>Status</th>
            <th>Receive Order<th>
	    </thead>
	    <tbody align="center">
            <?php if(!empty($order_users)) { ?>
                <?php foreach($order_users as $order) { ?>
                    <tr>
                        <td><?php echo $order['receipt_id']; ?></td>
                        <td><?php echo $order['datepurchase']; ?></td>
                        <td><?php echo $order['Status']; ?></td>
						<td>
							<a href="index.php?r_pro=<?php echo $order['receipt_id'];?>">
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