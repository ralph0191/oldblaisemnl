<?php
    $companyCode = $_SESSION['company_code'];
    $sql = "SELECT
                phaseout.phaseoutID AS PhaseID, products.prod_title AS Title, products.prod_image as image, categories.cat_title as Category, 
                phaseout.deletedin as DateDeleted, phaseout.Deletedby as Nameby
            FROM  
                phaseout
            LEFT JOIN 
                products ON products.prod_id = phaseout.ProductID AND products.prod_company = '$companyCode'
            LEFT JOIN
                categories ON categories.cat_id = prod_cat
            WHERE products.prod_status = 0";
    $result = $con->query($sql);
    $order_products = [];
    if ($result->num_rows > 0) {
        $order_products = $result->fetch_all(MYSQLI_ASSOC);
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
        <table id="usetTable" class="table" style="text-align: center; align: center;">
        <thead>
            <th>ACTION</th>
            <th>Product Name</th>
            <th>Product Image</th>
            <th>Category</th>
            <th>Date Removed</th>
            <th>Removed By</th>
	    </thead>
	    <tbody>
            <?php if(!empty($order_products)) { ?>
                <?php foreach($order_products as $order) { ?>
                    <tr>
                        <td><?php echo $order['PhaseID']; ?></td>
                        <td><?php echo $order['Title']; ?></td>
                        <td><img src="../admin_area/product_images/<?php echo $order['image']; ?>" height="50px" width="50px"></td>
                        <td><?php echo $order['Category']; ?></td>
                        <td><?php echo $order['DateDeleted'] ?></td>
                        <td><?php echo $order['Nameby']; ?></td>
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