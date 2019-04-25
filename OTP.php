<?php
session_start();//
include("dbpharmacy.php");
$a="";
if(isset($_POST['submit'])) //
{
  $email=$_GET['email'];
  $OTP=$_POST['OTP'];
  
$sql="select *from emplogin where Emp_mail='$email'";
$result=$con->query($sql);//mysql_query($sql)
if(mysqli_num_rows($result)>0)
{
   
$row=mysqli_fetch_assoc($result);
  if($row['OTP']==$OTP)//check otp here if otp match then access reidrect to a new page with otp in url.
  {
   // $update="update emplogin set OTP='NULL' where Emp_id='$email'";
   // $result1=$con->query($update);
      header("location:http://localhost/phpclass/pharmacy_project/updatepass.php?email=".$email."&OTP=".$OTP);
  }
  else
    {$a="OTP not match";
    }

}else
{$a="Something wrong";//error in sql query for fetching some information.
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
   <div class="card" style="height: 35%">
      <div class="card-header">
          
      </div>
      <div class="card-body">
        <form method="post" onsubmit="return validate();">
          
          <div class="input-group form-group">
            <div class="input-group-prepend">
           
            </div>
            <input type="text" name="OTP" id="OTP" class="form-control" placeholder="Enter OTP">
          </div>
         
          <span class="row align-items-right submit">
            <?php echo $a ?>
          </span>
          <div class="form-group" >
            <input type="submit" name="submit" value="Enter" class="btn float-left btn-success"><!--login button-->
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
var otp=$("#OTP").val().trim();
if(otp=='')
{
  alert("please enter OTP");
  return false;
}else{
  return true;
}
}
</script>