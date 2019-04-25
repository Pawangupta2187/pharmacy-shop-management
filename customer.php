  <?php
session_start();//
include("dbpharmacy.php");
if(empty($_SESSION['Emp_id']))
{
 
  header("location:index.php");
}



if(isset($_POST['submit']))
{

$customer_name=$_POST['customer_name'];

$sql="SELECT * FROM `customer` WHERE cust_name  LIkE '%$customer_name%';";//query for search customer
$result=$con->query($sql);
}
else{

$sql="select *from customer";
$result=$con->query($sql);//mysql_query($sql)
}
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

<div class="jumbotron jumbotron-fluid" style="background-color: #5FB48A; margin-bottom: 0px;padding: 4px;padding-top: 2px;">
  <h1 style="color:white; text-align: center;font-family: Arial"><b><i class="fa fa-plus-square" style="font-size:48px;color:white"></i> &nbsp;Pharmacy Shop Management &nbsp;<i class="fa fa-plus-square" style="font-size:48px;color:white"></i></b></h1>
 
  </div>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark" style="color:white;">

        <form class="form-inline" action="" method="post">
   <input class="form-control mr-sm-2" type="text" placeholder="Search By Name" name="customer_name">
     <button class="btn btn-success " type="submit" style="background-color: #5FB48A" name="submit">Search</button>
  </form>

</nav>
<div class="container-fluid " style="background-color: white;padding: 0px;">
  <h3 style="color:black; text-align: center;font-family:Arial "><b>Customer Details</b></h3>
 


  </div>     
  <table class="table table-hover ">
    <thead> 
      <tr>
        <th>Customer ID</th>
        <th>Name</th>
         <th>Gender</th>
        <th>Adhar</th>
        <th>Email ID</th>
  		<th>Address</th>
        <th>Contact</th>
        <th>Register By</th>
        <th>Records</th>
      </tr>
    </thead>
    <tbody>  
<?php
	if(mysqli_num_rows($result)>0){ 
		while($row=mysqli_fetch_assoc($result)){ // result of query in form of array is copying in $row variable and till the array result is not get ended, while loop will run continuously
	?>
		<tr>

			<td><?php echo $row['cust_id']; ?></td>
			<td><?php echo $row['cust_name']; ?></td>
			<td><?php echo $row['gender']; ?></td>
			<td><?php echo $row['adhar']; ?></td>
			<td><?php echo $row['email']; ?></td>
			<td><?php echo $row['address']; ?></td>
			<td><?php echo $row['contact']; ?></td>
			<td><?php echo $row['Emp_id']; ?></td>

<td class="nav-link"><?php $url="http://localhost/phpclass/pharmacy_project/customer_record.php?cust_id=".$row['cust_id']; 
			echo $link="<a href='".$url."'>Click</a>";?> </td>		
			
			
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