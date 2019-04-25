 <?php
session_start();//
include("dbpharmacy.php");

if(empty($_SESSION['Emp_id']))
{
 
  header("location:index.php");
}
$M_id=$_GET['M_id'];
$query = "SELECT * FROM medicine where M_id=$M_id";  // query to search medicine from Table
$res = $con->query($query); // query runs here
$row=mysqli_fetch_assoc($res);



if(isset($_POST['medicine']))//
{
 $mname=$_POST['mname'];
 $batch=$_POST['batch'];
$company=$_POST['company'];

  $description=$_POST['description'];
$unit=$_POST['unit']; 
$purchase=$_POST['purchase'];
$gst=$_POST['gst'];
$costing=$_POST['costing'];
$mrp=$_POST['mrp'];
$Emp_id=$_SESSION['M_id'];

$sql="update medicine set M_name='$mname',Batch='$batch',Comp_name='$company',M_desc='$description',Unit='$unit',Pur_price='$purchase',Gst='$gst',Costing='$costing',M_price='$mrp',Emp_id='$Emp_id' where M_id=$M_id ;";
$result=$con->query($sql);//mysql_query($sql)
if ($result)
{
?>
<script type="text/javascript">
window.history.go(-2);
</script>

<?php 
}else
{$a="something went wrong";
  //echo $con->error."Email or password is incorrect";
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
Update Medicine Detail Here!
</div>
<div class="card-body" style="text-align: center;">
<form  method="post"  onsubmit="return validate();" action=""  enctype="multipart/form-data" >
    <table  class= "table"  align="center"  cellpadding="4" cellspacing="2" >
  <tr>
          <td align="left" >Medicine Name</td>
          <td align="right"><input type="text" name="mname"  id="mname" value="<?php  echo $row['M_name'];  ?>" /></td>
        </tr>
        <tr>
          <td align="left">Medicine Batch</td>
          <td align="right"><input type="text" name="batch"  id="batch" value="<?php  echo $row['Batch'];  ?>"/></td>
        </tr>
          <tr>
          <td align="left">Company</td>
          <td align="right"><input type="text" name="company"  id="company" value="<?php  echo $row['Comp_name'];  ?>"/></td>
        </tr>
      <tr>
          <td align="left">Description</td>
          <td align="right">
            <textarea name="description" rows="03" cols="22" id="description"><?php  echo $row['M_desc'];  ?></textarea>
          </td>
        </tr>
           <tr>
          <td align="left">Unit</td>
          <td align="right"><input type="number" name="unit"  id="unit" value="<?php  echo $row['Unit'];  ?>"/></td>
        </tr>
        <tr>
          <td align="left">Purchase Price</td>
          <td align="right"><input type="number" name="purchase" cols="30" id="purchase" value="<?php  echo $row['Pur_price'];  ?>" /></td>
        </tr>
        <tr>
          <tr>
          <td align="left">Gst</td>
          <td align="right"><input type="number" name="gst"  id="gst" placeholder="%" value="<?php  echo $row['Gst'];  ?>" /></td>
        </tr>
        <tr>
          <td align="left">Costing</td>
          <td align="right"><input type="number" name="costing"  id="costing" value="<?php  echo $row['Costing'];  ?>"/></td>
        </tr>
          <tr>
          <td align="left">MRP</td>
          <td align="right"><input type="number" name="mrp"  id="mrp" value="<?php  echo $row['M_price'];  ?>"/></td>
        </tr>
      </table>
    
</div>
<div class="card-footer">

            <div colspan="2" align="center"><input type="submit" class="btn" style="background-color: #5FB48A;color: white;font-weight: bold;" name="medicine" value="Update"  id="login_submit"/></div>
   
          
</div>
</form>
</div>

</div>








  <div class="container-fluid " style="background-color: #5FB48A;padding: 2px;">
  <h3 style="color:white; text-align: center;font-family:sans-serif; "><b>Contact us</b>&nbsp;&nbsp;&nbsp;&nbsp;<b>Feedback</b></h3>
 
  </div>
</body>
</html><script>
   function validate()
{
var mname=$("#mname").val().trim();
var batch=$("#batch").val().trim();

var company=$("#company").val().trim();
var description=$("#description").val().trim();
var unit=$("#unit").val().trim();
var purchase=$("#purchase").val().trim();
var gst=$("#gst").val().trim();
var costing=$("#costing").val().trim();
var mrp=$("#mrp").val().trim();

if(mname=='')
{
  alert("enter medicine name");
  return false;
}
else if(batch=='')
{
  alert("enter batch");
return false;
}
else if(company=='')
{
  alert("enter company");
return false;
}
else if(description=='')
{
  alert("enter description");
return false;
}
else if(unit=='')
{
  alert("enter unit");
return false;
}
else if(purchase=='')
{
  alert("enter purchase price");
return false;
}

else if(gst=='')
{
  alert("enter gst");
return false;
}else if(costing=='')
{
  alert("enter costing price");
return false;
}else if(mrp=='')
{
  alert("enter mrp");
return false;
}else if(!(confirm("confirm medicine!")))
{
  return false;
}
else{
  return true;
}
}
</script>