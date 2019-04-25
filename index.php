 <!--login page of pharmacy ooshop managemnet-->

 <?php
session_start();//
include("dbpharmacy.php");
$a=""; 
if(isset($_POST['submit'])) //
{
  $email=$_POST['id'];
  $password=$_POST['password'];

$sql="select *from emplogin where Emp_mail='$email' AND Password='$password'";//check id and password
$result=$con->query($sql);//mysql_query($sql)
if(mysqli_num_rows($result)>0)
{
 
  //print_r($userdata);die;//show that how data fetch
   $sqlpage="select *from employees where Emp_mail='$email'";//selection of page according to designation
  $resultpage=$con->query($sqlpage);
  $rowpage=mysqli_fetch_assoc($resultpage);



  $_SESSION['Emp_id']=$rowpage['Emp_id'];//userid is variable in session and column field in userdata;
  $_SESSION['name']=$rowpage['Emp_name'];


 
        if($rowpage['Emp_designation']=="Cashier")
            header("location:cashierhomepage.php");
          else if($rowpage['Emp_designation']=="Pharmacist")
             header("location:pharmacisthomepage.php");
          else
             header("location:managerhomepage.php");//for redirect to the home.php
}else
{$a="Email or password not correct";
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
        <h3>Sign In</h3>
        <div class="d-flex justify-content-end social_icon">
         <!-- <span><i class="fab fa-facebook-square"></i></span>
          <span><i class="fab fa-google-plus-square"></i></span>
          <span><i class="fab fa-twitter-square"></i></span>-->
        </div>
      </div>
      <div class="card-body">
        <form method="post" onsubmit="return validate();">
          <div class="input-group form-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-user"></i></span>
            </div>
            <input type="text" name="id" id="id" class="form-control" placeholder="usermail">
            
          </div>
          <div class="input-group form-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-key"></i></span>
            </div>
            <input type="password" name="password" id="password" class="form-control" placeholder="password">
          </div>
          <div class="row align-items-center remember">
            <input type="checkbox">Remember Me
          </div>
          <span class="row align-items-left remember">
            <?php echo $a ?>
          </span>
          <div class="form-group">
            <input type="submit" name="submit" value="Login" class="btn float-right login_btn"><!--login button-->
          </div>
        </form>
      </div>
      <div class="card-footer">
       <!-- <div class="d-flex justify-content-center links">
          Don't have an account?<a href="#">Sign Up</a>
        </div>-->
        <div class="d-flex justify-content-center">
          <a href="forgot.php">Forgot your password?</a>
        </div>
      </div>
    </div>
  </div>
  
</div>
<div class="container-fluid " style="background-color: #5FB48A;margin-bottom: 0px;padding: 2px;height: 50px;">
  <h3 style="color:white; text-align:;font-family:Arial ;font-size: 15px;"> <span style="text-align: left;">Copyright &copy; 1996-2018 Pharmacy Solution. All rights reserved.
  </span><div style="text-align: right">Terms of Use | Privacy Policy | Link to Us | Feedback</div></h3>
 
  </div>
</body>
</html>
<script>
   function validate()
{
var id=$("#id").val().trim();
var password=$("#password").val().trim();
if(id=='')
{
  alert("please enter email");
  return false;
}
else if(password=='')
{
  alert("enter password");
return false;
}else{
  return true;  
}
}
</script>