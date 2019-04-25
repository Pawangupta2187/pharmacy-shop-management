 <?php
session_start();//

include("dbpharmacy.php");
if(empty($_SESSION['Emp_id']))
{
 
  header("location:index.php");
}

$cust_id=$_GET['cust_id'];

//$id=$_SESSION['Emp_id'];//$_GET['Emp_id'];
$query = "SELECT * FROM customer_record where Cust_id=$cust_id";  // query to search users from Table
$res = $con->query($query); // query runs here
//$row=mysqli_fetch_assoc($res);

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
<div class="card" style="width:70%;">
<div class="card-header" style="font-weight: bold ;text-align: center;">
Item Details here! Customer Id :- <?php echo $cust_id ;?>
</div>
<div class="card-body" style="text-align: center;">

		<table width="80%"  align="center"  cellpadding="4" cellspacing="2"  class="table">
	<thead> 
    
      <tr>
        <th>Customer id</th>

        <th>Order No</th>
         <th>Total Amount
         </th>
        <th>Status</th>

         <th>Items</th>
            </tr>
        </thead>
    <tbody>  
<?php
  if(mysqli_num_rows($res)>0){ 
    while($row=mysqli_fetch_assoc($res)){ // result of query in form of array is copying in $row variable and till the array result is not get ended, while loop will run continuously
  ?>
    <tr>

         <?php   $id=$row['Order_id'];
    $sqlamount ="SELECT * FROM `order` where Order_id=$id;";  // query to search users from Table
$amountresult = $con->query($sqlamount);  
$amountrow=mysqli_fetch_assoc($amountresult);

?>


      <td><?php echo $row['Cust_id']; ?></td>

<td><?php echo  $row['Order_id'];?></td>
<td><?php echo  $amountrow['Amount'];?></td>
<td><?php echo  $row['status'];?></td>
          
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
		
</div>
<div class="card-footer">

    				<div colspan="2" align="center"><input type="button" class="btn" style="background-color: #5FB48A;color: white;font-weight: bold;"  value="Back" onclick="back();"/>


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