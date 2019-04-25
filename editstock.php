 <?php
session_start();//
include("dbpharmacy.php");

if(empty($_SESSION['Emp_id']))
{
 
  header("location:index.php");
}



$M_id=$_GET['M_id'];
$query = "SELECT * FROM medicine where M_id=$M_id";  // query to search users from Table
$res = $con->query($query); // query runs here
$row=mysqli_fetch_assoc($res);




if(isset($_POST['medicine']))//
{
  $a="";
   $mname=$_POST['mname'];
  $batch=$_POST['batch'];
$quan=$_POST['quan'];
 $exp=$_POST['exp'];
 $sql1="select * from medicine where M_name='$mname' AND Batch='$batch'";
$result1=$con->query($sql1);
if(mysqli_num_rows($result1)>0)
    {
      $row1=mysqli_fetch_assoc($result1);
    }
    else{
      echo "you select wrong medicine";
    }
    
//$result1=$con->query($sql1);
//$row1=mysqli_fetch_assoc($result1)
$Mid=$row1['M_id'];

$sql2="select *from stock where M_id=$Mid";
$result2=$con->query($sql2);
$lastupdate=date("Y-m-d");
//$actquan=$actquan+$quan;
$status='In-stock';

if(mysqli_num_rows($result2)>0)
    {
      $row2=mysqli_fetch_assoc($result2);
      $actquan=$row2['Actuall_quantity'];
$actquan=$actquan+$quan;
$sql3="UPDATE stock SET  Last_update = '$lastupdate', 
                        Quantity_update = $quan,
                        Expiry='$exp',Status = '$status',
                        Actuall_quantity = $actquan 
                         where M_id=$Mid";


    }
else
{
 //$result2=$con->query($sql2);
//$row2=mysqli_fetch_assoc($result2)
$sql3="insert into stock(`M_id`,`Last_update`,`Quantity_update`,`Expiry`,`Status`,`Actuall_quantity`)values('$Mid','$lastupdate','$quan','$exp','$status','$quan');";
}
$result3=$con->query($sql3);//mysql_query($sql)
if ($result3)
{
$message="Stock add successfully";
//echo "<script type='text/javascript'>alert('$message');</script>";
 
 header("location:managerhomepage.php");
  //for redirect to the 
}else
{
  print_r($sql3);
echo "something wrong";  //echo $con->error."Email or password is incorrect";
}
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
<div class="jumbotron jumbotron-fluid" style="background-color: #5FB48A; margin-bottom: 2px;padding: 4px;padding-top: 2px;">
  <h1 style="color:white; text-align: center;font-family: Arial"><b><i class="fa fa-plus-square" style="font-size:48px;color:white"></i> &nbsp;Pharmacy Shop Management &nbsp;<i class="fa fa-plus-square" style="font-size:48px;color:white"></i></b></h1>
 
  </div>


<div class="d-flex justify-content-center h-100" style="margin: 20px;">
<div class="card" style="width:50%;">
<div class="card-header" style="font-weight: bold ;text-align: center;">
Edit Stock Details Here!
</div>
<div class="card-body" style="text-align: center;">
<form  method="post"  onsubmit="return validate()" action=""  enctype="multipart/form-data" >
		<table  class ="table "width="80%"  align="center"  cellpadding="4" cellspacing="2" >
	 



   <tr>
  <td align="left">
<label for="country_name">Medicine</label></td>
<td  align="right" ><input id="mname" name="mname" type="text" list="Medicine"    value="<?php  echo $row['M_name'];  ?>"  />
<datalist id="Medicine">
   <?php
   $sql4="select *from medicine;";
   $result4=$con->query($sql4);
   if(mysqli_num_rows($result4)>0){ 
    while($row4=mysqli_fetch_assoc($result4)){
   ?>
   <option value="<?php echo $row4['M_name']; ?>">
   

   <?php
    }
}
   ?>
</datalist>
</td>

</tr>
   <tr>
  <td align="left">
<label for="country_name">Batch</label></td>
<td  align="right" ><input id="batch" name="batch" type="text" list="Batch" value="<?php  echo $row['Batch'];  ?>" />
<datalist id="Batch">
   <?php
   $sql4="select *from medicine;";
   $result4=$con->query($sql4);
   if(mysqli_num_rows($result4)>0){ 
    while($row4=mysqli_fetch_assoc($result4)){
   ?>
   <option value="<?php echo $row4['Batch']; ?>">
   

   <?php
    }
}
   ?>
</datalist>
</td>

</tr>


  			<tr>
    			<td align="left">Medicine Quantity</td>
    			<td align="right"><input type="number" name="quan"  id="quan" value=<?php  echo $row['Actuall_quantity'];  ?>/></td>
  			</tr>
			
 <tr>
          <td align="left">Expiry Date</td>
          <td align="right"><input type="Date" name="exp"  id="exp" value="<?php  echo $row['Expiry'];  ?>"/></td>
        </tr>
      


  				
			</table>
		
</div>
<div class="card-footer">

    				<div colspan="2" align="center"><input type="submit" class="btn" style="background-color: #5FB48A;color: white;font-weight: bold;" name="medicine" value="ADD"  id="login_submit"/></div>
   
  				
</div>
</form>
</div>

</div>




  <div class="container-fluid fixed-bottom" style="background-color: #5FB48A;padding: 2px;">
  <h3 style="color:white; text-align: center;font-family:sans-serif; "><b>Contact us</b>&nbsp;&nbsp;&nbsp;&nbsp;<b>Feedback</b></h3>
 
  </div>
</body>
</html>
<script>
   function validate()
{
var mname=$("#mname").val().trim();
var quan=$("#quan").val().trim();


if(mname=='')
{
  alert("enter medicine name");
  return false;
}
else if(quan=='')
{
  alert("enter Quantity");
return false;
}
else if(!(confirm("Conifirm Password!")))
{
  return false;
}
else{
  return true;
}
}
</script>-->