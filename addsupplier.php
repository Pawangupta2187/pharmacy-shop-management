 <?php
session_start();//
include("dbpharmacy.php");
if(empty($_SESSION['Emp_id']))
{
 
  header("location:index.php");
}


if(isset($_POST['supplier']))//
{

 $sname=$_POST['sname'];
 $pno=$_POST['pno'];
 $pamount=$_POST['pamount'];
    $damount=$_POST['damount'];
   $empid=1;
$sql="insert into suppliers(`Supplier_name`,`Supplier_contact`,`paid_amount`,`due_amount`,`Emp_id`)values('$sname','$pno','$pamount','$damount','$empid');";//query for add supplier 


$result=$con->query($sql);//mysql_query($sql)
if ($result)
{
	?>
<script type="text/javascript">
window.history.go(-2);
</script>

<?php 
}else
{
  echo $con->error."something went wrong";
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
Add Supplier Detail Here!
</div>
<div class="card-body" style="text-align: center;">
<form  method="post"  onsubmit="return validate()" action=""  enctype="multipart/form-data" >
		<table  class="table" width="80%"  align="center"  cellpadding="4" cellspacing="2" >
	
  			<tr>
    			<td align="left" >Supplier Name</td>
    			<td align="right" ><input type="text" name="sname"  id="sname"/></td>
  			</tr>
		  			<tr>
    			<td align="left">Contact no</td>
    			<td align="right"><input type="tel" name="pno" id="pno"/></td>
  			</tr>
  			<tr>
    			<td align="left">Paid_amount</td>
    			<td align="right"><input type="number" name="pamount" id="pamount"/></td>
  			</tr><tr>
        <tr>
          <td align="left">Due_amount</td>
          <td align="right"><input type="number" name="damount" id="damount"/></td>
        </tr>
			</table>
		
</div>
<div class="card-footer">

    				<div colspan="2" align="center"><input type="submit" class="btn" style="background-color: #5FB48A;color: white;font-weight: bold;" name="supplier" value="ADD"  id="supplier"/></div>
   
  				
</div>
</form>
</div>

</div>








  <div class="container-fluid fixed-bottom" style="background-color: #5FB48A;padding: 2px;">
  <h3 style="color:white; text-align: center;font-family:sans-serif; "><b>Contact us</b>&nbsp;&nbsp;&nbsp;&nbsp;<b>Feedback</b></h3>
 
  </div>
</body>
</html><script>
   function validate()
{
var sname=$("#sname").val().trim();
var pno=$("#pno").val().trim();
var pamount=$("#pamount").val().trim();
var damount=$("#damount").val().trim();

if(sname=='')
{
  alert("enter suppplier name");
  return false;
}
else if(pno=='')
{
  alert("enter contact num");
return false;
}
else if(pamount=='')
{
  alert("paid amount");
return false;
}
else if(damount=='')
{
  alert("enter price");
return false;
}else if(!(confirm("Conifirm Password!")))
{
  return false;
}else{
  return true;
}
}
</script>