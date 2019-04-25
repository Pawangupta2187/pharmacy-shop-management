 <?php
session_start();//

include("dbpharmacy.php");
if(empty($_SESSION['Emp_id']))
{
 
  header("location:index.php");
}

$Order_id=$_GET['Order_id'];//take order no from url

//$id=$_SESSION['Emp_id'];//$_GET['Emp_id'];
$query = "SELECT * FROM of_item where Order_id=$Order_id";  // query to search item respect to the order no.
$res = $con->query($query); // query runs here


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
Item Details here! Order No :- <?php echo $Order_id ;?>
</div>
<div class="card-body" style="text-align: center;">

		<table width="80%"  align="center"  cellpadding="4" cellspacing="2"  class="table">
	<thead> 
    
      <tr>
        <th>Item id</th>

        <th>Item Name</th>
        <th>Item Batch</th>
        <th>Item MRP</th>
        <th>Item Quantity</th>
       <th>Items Discount</th> 
        <th>Items Amount</th> 
       </tr>
        </thead>
    <tbody>  
<?php
  if(mysqli_num_rows($res)>0){ 
    while($row=mysqli_fetch_assoc($res)){ // result of query in form of array is copying in $row variable and till the array result is not get ended, while loop will run continuously
  ?>
    <tr>
      <td><?php echo $row['Item_id']; ?></td>


    <?php   $Item_id=$row['Item_id'];
    $medicine ="SELECT * FROM medicine where M_id=$Item_id;";  // query to search users from Table
$medresult = $con->query($medicine);  
$medrow=mysqli_fetch_assoc($medresult);

?>    
<td><?php echo  $medrow['M_name'];?></td>
<td><?php echo  $medrow['Batch'];?></td>


 




      <td><?php echo $row['Item_mrp']; ?></td>
      <td><?php echo $row['Item_quantity']; ?></td>
        <td><?php echo $row['Item_discount']; ?>%</td>
            <td><?php echo $row['Item_amount']; ?></td>
           



     


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
            <a href="<?php echo "test.php?id=".$Order_id;?>"><input type="button" class="btn" style="background-color: #5FB48A;color: white;font-weight: bold;"  value="Print"/></a>

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