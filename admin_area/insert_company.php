<form action="" method="POST" enctype="multipart/form-data">

	<table align="left" width="100%">

		<tr align="center">
			<td colspan="3"><h2>Insert New Company Here</h2></td>
		</tr>
		
		<tr>
			<td align="center" style="padding:10px;"><b>Company Title:</b></td>
			<td align="center" colspan="2"><input class="form-control" type="text" name="com_title" required/></td>
		</tr>

		<tr>
			<td align="center" style="padding:10px;"><b>Company Code (Max 5 characters):</b></td>
            <td align="center" colspan="2"><input class="form-control" type="text" maxlength="5" name="com_code" required/></td>
		
		</tr>
		<tr>
			<td colspan="3" align="center" style="padding:10px;"><input type="submit" name="insert_post" value="Insert Product" /></td>
        </tr>
	</table>
</form>

<?php
    if(isset($_POST['insert_post'])){
        
        //getting text data from the fields
        $comp_title = mysqli_real_escape_string($con,$_POST['com_title']);
        $comp_code = mysqli_real_escape_string($con,$_POST['com_code']);
        $checker = true;
        
        if ($comp_title === "" || $comp_title === null) {
            $checker = false;
            echo "<script>alert('Company name is Empty!')</script>";
            echo "<script>window.open('#')></script>";
            
        }
        if ($comp_code === "" || $comp_code === null) {
            $checker = false;
            echo "<script>alert('Company code is Empty!')</script>";
            echo "<script>window.open('#')</script>";
        }
        if (strlen($comp_code) >= 6) {
            $checker = false;
            echo "<script>alert('Company code is more than 5 Characters!')</script>";
            echo "<script>window.open('#')</script>";
            
        }
        if ($checker) {
            
            $insert_comp = "INSERT INTO company(CompanyCode, CompanyName)
            VALUES ('$comp_title', '$comp_code')";
            $insert_pro=mysqli_query($con,$insert_comp);	
            echo "<script>alert('comp has been inserted!')</script>";
        }
        
    }
?>
