<?php
session_start();//
include("dbpharmacy.php");
$a="";
if(isset($_POST['submit'])) //
{
 // $Empid=$_POST['Empid'];
  $email=$_POST['email'];

$sql="select *from emplogin where Emp_mail='$email'";
$result=$con->query($sql);//mysql_query($sql)
if(mysqli_num_rows($result)>0)
{
  

    $unique_code=rand(100000,999999);//set a unique code through function
    $update="update emplogin set OTP='$unique_code' where Emp_mail='$email'";//set unique code in the field for compare in last
    $res=$con->query($update);
  
    if($res)//check for query are executed or not it exeuted it return true
    {
      header("location:http://localhost/phpclass/pharmacy_project/OTP.php?email=".$email);//redirect to otp page for enter otp
    
    }

}else
{$a="Email id is not found";
  //echo $con->error."Email or password is incorrect";
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
            <input type="email" name="email" id="email" class="form-control" placeholder="Email@.com">
          </div>
         
          <span class="row align-items-right submit">
            <?php echo $a ?>
          </span>
          <div class="form-group" >
            <input type="submit" name="submit" value="Generate OTP" class="btn float-left btn-success"><!--login button-->
          </div>
        </form>
      </div>
      <div class="card-footer">
       <!-- <div class="d-flex justify-content-center links">
          Don't have an account?<a href="#">Sign Up</a>
        </div>-->
      
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
//var Empid=$("#Empid").val().trim();
var email=$("#email").val().trim();
 if(email=='')
{
  alert("please enter Email");
return false;
}else{
  return true;
}
}
</script>