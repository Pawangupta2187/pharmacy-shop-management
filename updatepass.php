<?php
session_start();//
include("dbpharmacy.php");
$a="";
if(isset($_POST['submit'])) //
{
  $password=$_POST['new1'];
  $email=$_GET['email'];
  $OTP=$_GET['OTP'];
$sql="select *from emplogin where Emp_mail='$email' AND OTP='$OTP'";//data fetch only when condtion match
$result=$con->query($sql);//mysql_query($sql)
if(mysqli_num_rows($result)>0)
{
  $update="update emplogin set OTP='NULL' where Emp_mail='$email'";//set OTP to NULL in database
   $result1=$con->query($update);

    $sqlupdate="update emplogin set Password='$password' where Emp_mail='$email'";
  $resupdate=$con->query($sqlupdate);//set new password
header("location:index.php");

}else
{$a="something went wrong";//something wrong in fetching information.
  
}
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Pharmacy Shop Management</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet"  type="text/css" meia="screen" href="bootstrap-4.3.1-dist\css\bootstrap.min.css">
  <script src="jquery-3.3.1.min.js"></script>
  <script src="bootstrap-4.3.1-dist\js\bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="loginpage.css">
    <link rel="stylesheet" href="fontawesome-free-5.7.2-web\css\all.css">
    
</head>
<body>

<div class="jumbotron jumbotron-fluid" style="background-color: #5FB48A; margin-bottom: 2px;padding: 4px;padding-top: 2px;">
  <h1 style="color:white; text-align: center;font-family: Arial"><b><i class="fa fa-plus-square" style="font-size:48px;color:white"></i> &nbsp;Pharmacy Shop Management &nbsp;<i class="fa fa-plus-square" style="font-size:48px;color:white"></i></b></h1>
 
  </div>
<div class="container">
  <div class="d-flex justify-content-center h-100">
   <div class="card">
      <div class="card-header">
          
      </div>
      <div class="card-body">
        <form method="post" onsubmit="return validate();">
          <div class="input-group form-group">
            <div class="input-group-prepend">
                   </div>
            <input type="password" name="new1" id="new1" class="form-control" placeholder="Enter password">
            
          </div>
          <div class="input-group form-group">
            <div class="input-group-prepend">
           
            </div>
            <input type="password" name="new2" id="new2" class="form-control" placeholder="Conifirm password">
          </div>
         
          <span class="row align-items-right submit" style="color:white">
            <?php echo $a ?>
          </span>
          <div class="form-group" >
            <input type="submit" name="submit" value="Create new password" class="btn float-left btn-success"><!--login button-->
          </div>
        </form>
      </div>
      <div class="card-footer">
      
      
      </div>
    </div>
  </div>
  
</div>
<div class="container-fluid" style="background-color: #5FB48A;margin-bottom: 0px;padding: 2px;">
  <h3 style="color:white; text-align: center;font-family:Arial "><b>Contact us</b>&nbsp;&nbsp;&nbsp;&nbsp;<b>Feedback</b></h3>
 
  </div>
</body>
</html>
<script>
   function validate()
{
var new1=$("#new1").val().trim();
var new2=$("#new2").val().trim();
if(new1=='')//input value is blank it return false
{
  alert("please enter password");
  return false;
}
else if(new2=='')
{
  alert("please conifirm password");
return false;
}
else if(new1!=new2)
{
  alert("password not match");
  return false;
}else if(!(confirm("Conifirm Password!")))
{
  return false;
}
else{
  return true;
}
}
</script>