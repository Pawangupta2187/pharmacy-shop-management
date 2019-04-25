 <?php
session_start();//
include("dbpharmacy.php");
if(empty($_SESSION['Emp_id']))
{
 
  header("location:index.php");
}



$sql="select *from suppliers";
$result=$con->query($sql);//mysql_query($sql)
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
<div class="container-fluid " style="background-color: white;padding: 2px;">
  <h3 style="color:black; text-align: center;font-family:Arial "><b>Supplier Details</b></h3>
 
  </div>     
  <table class="table table-hover ">
    <thead> 
      <tr>
        <th>Supplier_id</th>
        <th>Name</th>
        <th>Contact</th>
        <th>Paid_amount</th>
        <th>Due_amount</th>
  		    <th>Emp_id</th>
  		    <th>Action</th>
  		    </thead>
    <tbody>  
<?php
	if(mysqli_num_rows($result)>0){ 
		while($row=mysqli_fetch_assoc($result)){ // result of query in form of array is copying in $row variable and till the array result is not get ended, while loop will run continuously
	?>
		<tr>
			<td><?php echo $row['Supplier_id']; ?></td>
			<td><?php echo $row['Supplier_name']; ?></td>
			<td><?php echo $row['Supplier_contact']; ?></td>

			<td><?php echo $row['paid_amount']; ?></td>
			<td><?php echo $row['due_amount']; ?></td>
			
				<td><?php echo $row['Emp_id']; ?></td>	


<td class="nav-link">t</td>			

						</tr>		
	<?php
		}
	}
	else{
	?>
	<tr>
		<td colspan="11">No Record Found</td>
	</tr>
	<?php
	}?>
</tbody>
  
</div>
</body>
</html>