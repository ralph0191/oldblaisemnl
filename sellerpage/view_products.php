<?php

$companyCode = $_SESSION['company_code'];
$sql = "SELECT
            prod_id, prod_title, prod_image, prod_price, prod_qty, dateentered, categories.cat_title AS category
        FROM 
            products
        LEFT JOIN 
            categories ON categories.cat_id = products.prod_cat AND prod_company = '$companyCode'
        WHERE
        prod_status = 1";

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
        <h3 style="text-align:center;">Products</h3>
        <table id="usetTable" class="table">
        <thead>
            <th>Product Title</th>
            <th>Product Price</th>
            <th>Quantity</th>
            <th>Product Image</th>
            <th>Edit</th>
            <th>Delete</th>
            <th>Release Date</th>
            <th>Category</th>
	    </thead>
	    <tbody>
            <?php if(!empty($order_users)) { ?>
                <?php foreach($order_users as $order) { ?>
                    <tr>
                        <td><?php echo $order['prod_title']; ?></td>
                        <td><?php echo $order['prod_price']; ?></td>
                        <td><?php echo $order['prod_qty']; ?></td>
                        <td><img src="../admin_area/product_images/<?php echo $order['prod_image']; ?>" height="50px" width="50px"></td>
                        <td><a href="index.php?edit_pro=<?php echo $order['prod_id']; ?>">
                            <img src="edit-icon.png" width="50" height="50"></a></td>
                        <td><a href="index.php?del_pro=<?php echo $order['prod_id']; ?>">
                            <img src="del-icon.png" width="50" height="50"></a></td>
                        <td><?php echo $order['dateentered']; ?></td>
                        <td><?php echo $order['category']; ?></td>
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