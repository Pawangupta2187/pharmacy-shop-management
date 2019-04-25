 <?php
session_start();//

include("dbpharmacy.php");
if(empty($_SESSION['Emp_id']))
{
 
  header("location:index.php");
}



$id=$_SESSION['Emp_id'];//$_GET['Emp_id'];
$query = "SELECT * FROM employees where Emp_id=$id";  // query to search users from Table
$res = $con->query($query); // query runs here
$row=mysqli_fetch_assoc($res);

?>



<!DOCTYPE html>
<html>
<head>
	<title>Pharmacy Shop Management</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet"  type="text/css" meia="screen" href="bootstrap-4.3.1-dist\css\bootstrap.min.css">
  <script src="jquery-3.3.1.min.js"></script>
  <script src="bootstrap-4.3.1-dist\js\bootstrap.min.js"></script>
  
    <link rel="stylesheet" href="fontawesome-free-5.7.2-web\css\all.css">
    
</head>
<body style="font-family: sans-serif;">
<div class="jumbotron jumbotron-fluid" style="background-color: #5FB48A; margin-bottom: 2px;padding: 4px;padding-top: 2px;">
  <h1 style="color:white; text-align: center;font-family: Arial"><b><i class="fa fa-plus-square" style="font-size:48px;color:white"></i> &nbsp;Pharmacy Shop Management &nbsp;<i class="fa fa-plus-square" style="font-size:48px;color:white"></i></b></h1>
 
  </div>


<div class="d-flex justify-content-center h-100" style="margin: 20px;">
<div class="card" style="width:50%;">
<div class="card-header" style="font-weight: bold ;text-align: center;">
Your Profile
</div>
<div class="card-body" style="text-align: center;">

		<table width="80%"  align="center"  cellpadding="4" cellspacing="2"  class="table">
	
    <tr>
          <td align="left" >Employee ID</td>
          <td align="left" ><?php echo $row['Emp_id']; ?></td>
        </tr>
      <tr>
  			<tr>
    			<td align="left" >Employee Name</td>
    			<td align="left" ><?php echo $row['Emp_name']; ?></td>
  			</tr>
			<tr>
  				<td align="left">Gender</td>
  				<td align="left">
  					<?php echo $row['Emp_gender']; ?>
  				</td>
  			</tr>
  			<tr>
    			<td align="left">Addhar Card</td>
    			<td align="left"><?php echo $row['Emp_adhar']; ?></td>
  			</tr>
  			<tr>
    			<td align="left">Email</td>
    			<td align="left"><?php echo $row['Emp_mail']; ?>
  			</tr><tr>
    			<td align="left">Designation</td>

          <td align="left">
             <?php echo $row['Emp_designation']; ?>
          </td>
  			</tr><tr>

    			<td align="left">Address</td>
    			<td align="left"><?php echo $row['Emp_address'];?></td>
  			</tr><tr>
    			<td align="left">Salary</td>
    			<td align="left"><?php echo $row['Salary']; ?></td>
  			</tr><tr>
    			<td align="left">Duty Hours</td>
    			<td align="left"><?php echo $row['Duty_hours']; ?></td>
  			</tr>
            
            <tr>
  				<td align="left">Status</td>
  				<td align="left">
  				<?php echo $row['Status']; ?></td>
  			</tr>
<tr>
    			<td align="left">Contact Number</td>
    			<td align="left"><?php echo $row['Contact_no']; ?></td>
  			</tr>
    			
  				
			</table>
		
</div>
<div class="card-footer">

    				<div colspan="2" align="center"><input type="button" class="btn" style="background-color: #5FB48A;color: white;font-weight: bold;"  value="Back" onclick="back();"/>&nbsp;&nbsp;<a href="<?php echo "editprofile.php?Emp_id=".$_SESSION['Emp_id'];?>"><input type="button" class="btn" style="background-color: #5FB48A;color: white;font-weight: bold;"  value="Edit"/></a>


            </div>
   
  				
</div>

</div>

</div>








  <div class="container-fluid " style="background-color: #5FB48A;padding: 2px;">
  <h3 style="color:white; text-align: center;font-family:sans-serif; "><b>Contact us</b>&nbsp;&nbsp;&nbsp;&nbsp;<b>Feedback</b></h3>
 
  </div>
</body>
</html>
<script type="text/javascript">
  function back()
  {
    window.history.go(-1);
  }
</script>