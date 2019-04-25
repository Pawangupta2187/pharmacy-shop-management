 <?php
session_start();//
include("dbpharmacy.php");
if(empty($_SESSION['Emp_id']))
{
 
  header("location:index.php");
}
$currentdate=date("Y-m-d");
if(isset($_POST['submit']))
{

$date=$_POST['date'];
$dateto=$_POST['dateto'];


$sqlorder="SELECT * FROM `order` WHERE O_date>='$date' AND O_date<='$dateto';";//query for searching transacion between dates
$result=$con->query($sqlorder);

}

else
   {
   	$sqlorder="SELECT * FROM `order` WHERE O_date='$currentdate'";//default current date of transaction

		$result=$con->query($sqlorder);
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
  <div class="jumbotron jumbotron-fluid" style=" margin-bottom:0;background-color: #5FB48A;">
		<h1 style="color:white; text-align: center;font-family: Arial"><b><i class="fa fa-plus-square" style="font-size:48px;color:white"></i> &nbsp;Pharmacy Shop Management &nbsp;<i class="fa fa-plus-square" style="font-size:48px;color:white"></i></b></h1>
 
 </div>
<div>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark" style="color:white;">

		<form class="form-inline" action="" method="post">
   From&nbsp; <input class="form-control mr-sm-2" type="Date" placeholder="Search" name="date">
   TO &nbsp;<input class="form-control mr-sm-2" type="Date" placeholder="Search" name="dateto">
    <button class="btn btn-success " type="submit" style="background-color: #5FB48A" name="submit">Search</button>
  </form>

</nav>

</div>

<div class="container-fluid " style="background-color: white;padding: 2px;">
  <h3 style="color:black; text-align: center;font-family:Arial "><b>Transactions</b></h3>
 
  </div>     
  <table class="table table-hover ">
    <thead> 
      <tr>
        <th>Order No</th>
        <th>Date</th>
        <th>Billing Amount</th>
       <th>Items</th> 
       </tr>
        </thead>
    <tbody>  
<?php
	if(mysqli_num_rows($result)>0){ 
		while($row=mysqli_fetch_assoc($result)){ // result of query in form of array is copying in $row variable and till the array result is not get ended, while loop will run continuously
	?>
		<tr>
			<td><?php echo $row['Order_id']; ?></td>
			<td><?php echo $row['O_date']; ?></td>
			<td><?php echo $row['Amount']; ?></td>

			<td class="nav-link"><?php $url="http://localhost/phpclass/pharmacy_project/items.php?Order_id=".$row['Order_id']; 
			echo $link="<a href='".$url."'>Click</a>";?></td>			



						</tr>	

<?php
		}
	}
	else{
	?>
	<tr>
		<td colspan="11"><?php //echo print_r($sqlorder); ?>  No Record Found</td>
	</tr>
	<?php
	}?>
</tbody>
  </table>

</body>
</html>