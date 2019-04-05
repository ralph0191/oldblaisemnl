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
                    <div class="text"><?php
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
    <div class="col-lg-6">
        <div class="au-card recent-report">
            <div class="au-card-inner">
                <h3 class="title-2">Sales by Month</h3>
                <div class="chart-info">
                </div>
                <div class="recent-report__chart">
                    <canvas id="recent-rep-chart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>