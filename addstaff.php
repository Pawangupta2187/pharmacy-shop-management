 <?php
session_start();//
include("dbpharmacy.php");
 
if(empty($_SESSION['Emp_id']))
{
 
  header("location:index.php");
}
if(isset($_POST['staff']))//
{

 $ename=$_POST['ename'];
 $gender=$_POST['gender'];
 $acard=$_POST['acard'];
    $email=$_POST['email'];
    $designation=$_POST['designation'];
    $address=$_POST['address'];
    $salary=$_POST['salary'];
    $duty=$_POST['duty'];
   // $status=$_POST['status'];
    $contact=$_POST['contact'];


$sql="insert into employees (`Emp_name`,`Emp_gender`,`Emp_adhar`,`Emp_mail`,`Emp_designation`,`Emp_address`,`Salary`,`Duty_hours`,`Contact_no`)values('$ename','$gender','$acard','$email','$designation','$address','$salary','$duty','$contact');";//query for insert staff detail.


$result=$con->query($sql);//mysql_query($sql)
if ($result)
{
 $unique_pass=rand(1000000,9999999);//when staff detail is successfully submited then a default password get genrated and send to staff (on email or msg )
  $sqllogin="insert into emplogin(`Password`,`Emp_mail`)values('$unique_pass','$email')";//generate default password and set in database.
	 $resuttlogin=$con->query($sqllogin);
   
?>
<script type="text/javascript">
window.history.go(-2);
</script>

<?php 
}else
{
echo "something went wrng";;
  echo $con->error;
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
Add Staff Detail Here!
</div>
<div class="card-body" style="text-align: center;">
<form  method="post"  onsubmit="return validate();"  enctype="multipart/form-data" >
		<table width="80%"  class="table" align="center"  cellpadding="4" cellspacing="2" >
	
  			<tr>
    			<td align="left" >Employee Name</td>
    			<td align="right" ><input type="text" name="ename"  id="ename"/></td>
  			</tr>
			<tr>
  				<td align="left">Gender</td>
  				<td align="right">
  					<select name="gender" id="gender">
                    <option value="Male" >Male</option>
                    <option value="Female">Female</option></select>
  				</td>
  			</tr>
  			<tr>
    			<td align="left">Addhar Card</td>
    			<td align="right"><input type="text" name="acard" id="acard"/></td>
  			</tr>
  			<tr>
    			<td align="left">Email</td>
    			<td align="right"><input type="text" name="email" id="email"/></td>
  			</tr><tr>
    			<td align="left">Designation</td>

          <td align="right">
            <select name="designation" id="design">
                    <option value="Pharmacist">Pharmacist</option>
                    <option value="Cashier">Cashier</option></select>
          </td>
  			</tr><tr>

    			<td align="left">Address</td>
    			<td align="right"><textarea name="address" rows="03" cols="22" id="address"></textarea></td>
  			</tr><tr>
    			<td align="left">Salary</td>
    			<td align="right"><input type="number" name="salary" id="salary"/></td>
  			</tr><tr>
    			<td align="left">Duty Hours</td>
    			<td align="right"><input type="number" name="duty" id="duty"/></td>
  			</tr>
            
            
<tr>
    			<td align="left">Contact Number</td>
    			<td align="right"><input type="tel" name="contact" id="contact"/></td>
  			</tr>
    			
  				
			</table>
		
</div>
<div class="card-footer">

    				<div colspan="2" align="center"><input type="submit" class="btn" style="background-color: #5FB48A;color: white;font-weight: bold;" name="staff" value="ADD"  id="login_submit"/></div>
   
  				
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


var ename=$("#ename").val().trim();
var gender=$("#gender").val().trim();
var acard=$("#acard").val().trim();
var email=$("#email").val().trim();

var design=$("#design").val().trim();
var address=$("#address").val().trim();
var salary=$("#salary").val().trim();
var duty=$("#duty").val().trim();
//var status=$("#status").val().trim();
var contact=$("#contact").val().trim();

if(ename=='')
{
  alert("enter  name");
  return false;
}
else if(gender=='')
{
  alert("select gender");
return false;
}
else if(acard=='')
{
  alert("enter adhar");
return false;
}
else if(email=='')
{
  alert("enter email");
return false;
}

else if(design=='')
{
  alert("select designation ");
return false;
}

else if(address=='')
{
  alert("enter address");
return false;
}
else if(salary=='')
{
  alert("enter Salary");
return false;
}
else if(duty=='')
{
  alert("enter duty hours");
return false;
}
else if(contact=='')
{
  alert("enter contact");
return false;n
}else if(!(confirm("Add staff!")))
{
  return false;
}
else{
  return true;
}
}
</script>