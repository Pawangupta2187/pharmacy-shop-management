 <?php
session_start();//
include("dbpharmacy.php");
if(empty($_SESSION['Emp_id']))//check session is created or not 
{
 
  header("location:index.php");
}



$sql="select *from medicine";///query for fetching medicine detail
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
  <h3 style="color:black; text-align: center;font-family:Arial "><b>Medicine Details</b></h3>
 
  </div>     
  <table class="table table-hover ">
    <thead> 
      <tr>
        <th>Medicine ID</th>
        <th>Medicine Name</th>
        <th>Batch</th>
       <th>Company</th> 
        <th>Description</th>
        <th>Unit</th>
        <th>Purchase</th>
        <th>Gst(%)</th>
        <th>Costing</th>
        <th>MRP</th>
        <th>Employee ID</th>
        <th>Action</th>
  		    </thead>
    <tbody>  
<?php
	if(mysqli_num_rows($result)>0){ 
		while($row=mysqli_fetch_assoc($result)){ // result of query in form of array is copying in $row variable and till the array result is not get ended, while loop will run continuously
	?>
		<tr>
			<td><?php echo $row['M_id']; ?></td>
			<td><?php echo $row['M_name']; ?></td>
			<td><?php echo $row['Batch']; ?></td>

			<td><?php echo $row['Comp_name']; ?></td>
			<td><?php echo $row['M_desc']; ?></td>
					<td><?php echo $row['Unit']; ?></td>
					<td><?php echo $row['Pur_price']; ?></td>
					<td><?php echo $row['Gst']; ?></td>
		<td><?php echo $row['Costing']; ?></td>
				<td><?php echo $row['M_price']; ?></td>
			<td><?php echo $row['Emp_id']; ?></td>
					
					
<td class="nav-link"><?php $url="http://localhost/phpclass/pharmacy_project/editmedicine.php?M_id=".$row['M_id']; //here medicine id is redirect to another page for edit medicine detail.
			echo $link="<a href='".$url."'>edit</a>";?></td>			




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
  

</body>
</html>