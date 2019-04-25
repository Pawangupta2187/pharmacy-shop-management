<?php 
session_start();
include('dbpharmacy.php');
if(empty($_SESSION['Emp_id']))
{
  header("location:index.php");
}else
{
  $Emp_id=$_SESSION['Emp_id'];
  $sql="select *from employees where Emp_id='$Emp_id'";//selection of page according to designation
  $result=$con->query($sql);
  $row=mysqli_fetch_assoc($result);
 if(!($row['Emp_designation']=="Cashier"))
 {
    header("location:index.php");
 }
}

?>

<!DOCTYPE html>
<html>
<head>

<title>Pharmacy Shop Management</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet"  type="text/css" media="screen" href="bootstrap-4.3.1-dist\css\bootstrap.min.css">
  <script src="jquery-3.3.1.min.js"></script>
  <script src="bootstrap-4.3.1-dist\js\bootstrap.min.js"></script>
  
    <link rel="stylesheet" href="fontawesome-free-5.7.2-web\css\all.css">

<script>
function showCustomer(str) {

  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("txtHint").innerHTML =
      this.responseText;
    }
  };
  xhttp.open("GET", str+".php", true);
  xhttp.send();
}
</script>




<!--script for navbar hovring-->
    <script type="text/javascript">

      function change(x)
      {
        x.style.background="#5FB48A";
      }
      function changeout(x)
      {
        x.style.background="";
      }
    </script>

</head>
    

    <body style="font-family: sans-serif;" onload="">
<div class="jumbotron jumbotron-fluid" style=" margin-bottom:0;background-color: #5FB48A;">

    <h1 style="color:white; text-align: center;font-family: Arial"><b><i class="fa fa-plus-square" style="font-size:48px;color:white"></i> &nbsp;Pharmacy Shop Management &nbsp;<i class="fa fa-plus-square" style="font-size:48px;color:white"></i></b></h1>
 
 </div>


 
<div>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark"  >
  <a class="navbar-brand" href="#">Hello Cashier(<?php echo $_SESSION['name'];  ?>)</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="nav nav-pills" style="color:white;">
    

       <div>
       
       <li class="dropdown" >
            <a class="nav-link dropdown-toggle" style="color:white;" class="dropntn" href="#"  data-toggle="dropdown" onmouseover="change(this)" onmouseout="changeout(this)">
              Medicine
            </a>
          <div class="dropdown-menu">
       
           <a class="dropdown-item" href="#" onclick="showCustomer('medicinedetail')"  onmouseover="change(this)" onmouseout="changeout(this)">Medicine Detail</a>
              </div>
       </li>
       </div>
<div>
       
       <li class="dropdown" >
            <a class="nav-link dropdown-toggle" style="color:white;" class="dropntn" href="#"  data-toggle="dropdown" onmouseover="change(this)" onmouseout="changeout(this)">
                Stock
            </a>
          <div class="dropdown-menu">
       
           <a class="dropdown-item" href="#" onclick="showCustomer('stockdetail')" onmouseover="change(this)" onmouseout="changeout(this)">Stock Detail</a>
           <a class="dropdown-item" href="addstock.php"onmouseover="change(this)" onmouseout="changeout(this)">Add stock</a>
           
          </div>
       </li>
       </div>
<div>
       
       <li class="dropdown" >
            <a class="nav-link dropdown-toggle" style="color:white;" class="dropntn" href="#"  data-toggle="dropdown" onmouseover="change(this)" onmouseout="changeout(this)">
                Supplier
            </a>
          <div class="dropdown-menu">
       
           <a class="dropdown-item" href="#" onclick="showCustomer('supplierdetail')" onmouseover="change(this)" onmouseout="changeout(this)">Supplier Detail</a>
         
            <a class="dropdown-item" href="#" onmouseover="change(this)" onmouseout="changeout(this)">Supply item</a>
          </div>
       </li>
       </div>



       <div>
       
       <li class="dropdown" >
            <a class="nav-link dropdown-toggle" style="color:white;" class="dropntn" href="#"  data-toggle="dropdown" onmouseover="change(this)" onmouseout="changeout(this)">
                Special Customer
            </a>
          <div class="dropdown-menu">
       
            <a class="dropdown-item" href="customer.php" onmouseover="change(this)" onmouseout="changeout(this)">Customer Detail</a>
       <a class="dropdown-item" href="addcustomer.php" onmouseover="change(this)" onmouseout="changeout(this)">Register Customer</a>
          
           
          
          </div>
       </li>
       </div>


<div>
       
       <li class="dropdown" >
            <a class="nav-link dropdown-toggle" style="color:white;" class="dropntn" href="#"  data-toggle="dropdown" onmouseover="change(this)" onmouseout="changeout(this)">
                Bills
            </a>
          <div class="dropdown-menu">
       
           <a class="dropdown-item" href="newbill.php" onmouseover="change(this)" onmouseout="changeout(this)">Generate Bills(customer)</a>
           <a class="dropdown-item" href="#"onmouseover="change(this)" onmouseout="changeout(this)">Generate Bills(Supplier)</a>
   <a class="dropdown-item" href="transaction.php"onmouseover="change(this)" onmouseout="changeout(this)">Transactions</a><!-- new -->

          
          </div>
       </li>
       </div>


<div>
       
       <li class="dropdown" >
            <a class="nav-link dropdown-toggle" style="color:white;" class="dropntn" href="#"  data-toggle="dropdown" onmouseover="change(this)" onmouseout="changeout(this)">
                Profile
            </a>
          <div class="dropdown-menu">
       
            <a class="dropdown-item" href="<?php echo "profile.php?Emp_id=".$_SESSION['Emp_id'];?>" onmouseover="change(this)" onmouseout="changeout(this)">Profile Detail</a>
       
          
           
          
          </div>
       </li>
       </div>









    </ul>
  </div>  


    <ul class="nav navbar-nav navbar-right">
<li >
 <a href="logout.php" class="nav-link"  onmouseover="change(this)" onmouseout="changeout(this)" style="color: white">Logout</a>

</li>
</ul>
</nav>
</div>



<div id="txtHint" style="padding-bottom: 0px;"><?php  include("chartcanvas.php"); ?></div>


<footer class="container-fluid" style=" float:left ;background-color: #5FB48A;padding: 2px;">
  <h3 style="color:white; text-align: center;font-family:sans-serif; "><b>Contact us</b>&nbsp;&nbsp;&nbsp;&nbsp;<b>Feedback</b></h3>
 
  </footer>






</body>
</html>
