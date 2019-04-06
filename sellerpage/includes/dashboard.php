<div class="row m-t-25">
    <div class="col-sm-6 col-lg-3">
        <div class="overview-item overview-item--c1">
            <div class="overview__inner">
                <div class="overview-box clearfix">
                    <div class="icon">
                        <i class="zmdi zmdi-account-o"></i>
                    </div>
                    <div class="text"><?php
                                        $sql = "SELECT SUM(sale_amount) AS MonthlySales FROM ecommerce.sales
                                WHERE MONTH(sale_date) = MONTH(NOW()) AND YEAR(sale_date) = YEAR(NOW());";
                                        $result = mysqli_query($con, $sql);
                                        $resultCheck = mysqli_num_rows($result);

                                        if ($resultCheck > 0) {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                echo "<h2>₱" . $row['MonthlySales'] . "</h2>";
                                            }
                                        }
                                        else{
                                            echo "<h2>₱0</h2>"; 
                                        }
                                        ?>
                        <span>This Month's Sales</span>
                    </div>
                </div>
                <div class="overview-chart">
                    <canvas id="widgetChart1"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="overview-item overview-item--c2">
            <div class="overview__inner">
                <div class="overview-box clearfix">
                    <div class="icon">
                        <i class="zmdi zmdi-shopping-cart"></i>
                    </div>
                    <div class="text"><?php
                                        $sql = "SELECT SUM(sale_amount) AS YearlySales FROM ecommerce.sales
                                WHERE YEAR(sale_date) = YEAR(NOW());";
                                        $result = mysqli_query($con, $sql);
                                        $resultCheck = mysqli_num_rows($result);

                                        if ($resultCheck > 0) {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                echo "<h2>₱" . $row['YearlySales'] . "</h2>";
                                            }
                                        }

                                        else{
                                            echo "<h2>₱0</h2>"; 
                                        }
                                        ?>
                        <span>This Year's Sales</span>
                    </div>
                </div>
                <div class="overview-chart">
                    <canvas id="widgetChart2"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="overview-item overview-item--c3">
            <div class="overview__inner">
                <div class="overview-box clearfix">
                    <div class="icon">
                        <i class="zmdi zmdi-calendar-note"></i>
                    </div>
                    <div class="text"><?php
                                        $sql = "SELECT SUM(sale_qty) AS Sales FROM ecommerce.sales
                                    WHERE YEAR(sale_date) = YEAR(NOW());";
                                        $result = mysqli_query($con, $sql);
                                        $resultCheck = mysqli_num_rows($result);

                                        if ($resultCheck > 0) {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                echo "<h2>" . $row['Sales'] . " items<h2/>";
                                            }
                                        }
                                        else {
                                            echo "<h2>0 items<h2/>";
                                        }
                                        
                                        ?>
                        <span>This Year's Item Sales</span>
                    </div>
                </div>
                <div class="overview-chart">
                    <canvas id="widgetChart3"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="overview-item overview-item--c4">
            <div class="overview__inner">
                <div class="overview-box clearfix">
                    <div class="icon">
                        <i class="zmdi zmdi-money"></i>
                    </div>
                    <div class="text">
                    <?php
                        $sql = "SELECT SUM(sale_amount) AS TotalSales FROM ecommerce.sales;";
                        $result = mysqli_query($con, $sql);
                        $resultCheck = mysqli_num_rows($result);

                        if ($resultCheck > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<h2>₱" . $row['TotalSales'] . " <h2/>";
                            }
                        }
                    
                    ?>
                        <span>Total Sales</span>
                    </div>
                </div>
                <div class="overview-chart">
                    <canvas id="widgetChart4"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <h2 align="center" colspan="9">
                    LOW STOCK PRODUCTS
            </h2>
            <br />
            <table id="usetTable" class="table"> 
                    <thead align="center" style="text-align:center;">
                        <th>I.D.</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Stock</th>
                    </thead>
                <?php 
                include("includes/db.php");
                
                $sql = "SELECT prod_id, prod_title, prod_qty, prod_image
                FROM 
                    ecommerce.products 
                WHERE
                    products.prod_qty <= 20";
                $result = $con->query($sql);
                $order_users = [];
                if ($result->num_rows > 0) {
                    $order_users = $result->fetch_all(MYSQLI_ASSOC);
                }
                
                ?>

                <tbody>
                    <?php if(!empty($order_users)) { ?>
                        <?php foreach($order_users as $order) { ?>
                            <tr align="center" style="text-align:center;">
                        
                                 <td><?php echo $order['prod_id'];?></td>
                                <td><?php echo $order['prod_title'];?></td>
                                <td>
                                    <img src="../admin_area/product_images/<?php echo $order['prod_image'];?>" width="60" height="60"/>
                                </td>
                                <td><?php echo $order['prod_qty'];?></td>
                            </tr>
                        <?php } ?>
                    <?php } ?>
                </tbody>
            </table>
        </div>
            <div class="col-md-6">
                <h2 colspan="9" style="text-align: center;">ORDERS TODAY</h2>
                <br />
                <table id="usetTable" class="table">
                    <thead>
                        <th>Order ID</th>
                        <th>Product (S)</th>
                        <th>Quantity</th>
                        <th>Product Image</th>
                        <th>Customer</th>
                        <th>Order Date</th>
                    </thead>
                    <?php 
                        include("includes/db.php");
                        
                        $sql = "SELECT orders.orderid, products.prod_title, orders.qty, 
                        products.prod_image, orders.customer, orders.order_date
                        FROM 
                            orders 
                        LEFT JOIN
                            products ON products.prod_id = orders.pro_id
                        WHERE
                            DATE(orders.order_date) = DATE(now());";
                        $result = $con->query($sql);
                        $order_users = [];
                        if ($result->num_rows > 0) {
                            $order_users = $result->fetch_all(MYSQLI_ASSOC);
                        }
                    
                    ?>
                    <tbody>
                        <?php if(!empty($order_users)) { ?>
                            <?php foreach($order_users as $order) { ?>
                                <tr>
                                    <td><?php echo $order['orderid']; ?></td>
                                    <td><?php echo $order['prod_title']; ?></td>
                                    <td><?php echo $order['qty']; ?></td>
                                    <td><img src="../admin_area/product_images/<?php echo $order['prod_image']; ?>" height="50px" width="50px"></td>
                                    <td><?php echo $order['customer'] ?></td>
                                    <td><?php echo $order['order_date']; ?></td>
                                </tr>
                            <?php } ?>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
    </div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.js"></script>
<script>
$(document).ready(function() {
	$('#usetTable').DataTable();
} );
</script>
