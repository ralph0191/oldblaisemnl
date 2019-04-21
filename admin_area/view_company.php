
<table width="100%" align="center"> 
    <tr align="center">
        <td colspan="6"><h2>View All Customers Here</h2></td>
    </tr>
    <tr align="center" bgcolor="#8c6d00">
        <th>Company Name</th>
        <th>Company Code</th>
        <th>Action</th>
    </tr>
    <?php 
        include("includes/db.php");
        $get_c = "SELECT * FROM company";

        $run_c = mysqli_query($con, $get_c); 

        $i = 0;

        while ($row_c=mysqli_fetch_array($run_c)){
            
            $c_id = $row_c['CompanyID'];
            $c_name = $row_c['CompanyName'];
            $c_code = $row_c['CompanyCode'];
            $i++;

    ?>
    <tr align="center">
        <td><?php echo $i;?></td>
        <td><?php echo $c_name;?></td>
        <td><?php echo $c_code;?></td>
        <td><?php echo $c_code;?></td>
        <td><?php echo $c_code;?></td>
    </tr>
    <?php } ?>
</table>