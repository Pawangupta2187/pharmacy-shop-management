 <?php
session_start();//
include("dbpharmacy.php");
 
if(empty($_SESSION['Emp_id']))
{
 
  header("location:index.php");
}

$Emp_id=$_SESSION['Emp_id'];
if(isset($_POST['customer']))//
{

 $cname=$_POST['cname'];
 $gender=$_POST['gender'];
 $acard=$_POST['acard'];
    $email=$_POST['email'];
    $address=$_POST['address'];
       $contact=$_POST['contact'];


$sql="insert into customer (`cust_name`,`gender`,`adhar`,`email`,`address`,`contact`,`Emp_id`)values('$cname','$gender','$acard','$email','$address','$contact','$Emp_id');";//query for insert staff detail.


$result=$con->query($sql);//mysql_query($sql)
if(!$result)
{
  echo "error";
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
Add  Customer Detail Here!
</div>
<div class="card-body" style="text-align: center;">
<form  method="post"  onsubmit="return validate();"   enctype="multipart/form-data" >
			
  			<div class="form-group" >
    			 <label for="cname" class="mb-2 mr-sm-2">Name</label>
    			<input type="text" name="cname"  class="form-control mb-2 mr-sm-2" id="cname" placeholder="Enter Full Name" />
  			</div>
        <div   class="form-group" >
		           <label for="gender" class="mb-2 mr-sm-2">Gender</label>
  					<select name="gender" id="gender"  class="form-control mb-2 mr-sm-2">
                    <option value="Male" >Male</option>
                    <option value="Female">Female</option></select>
  				</div>
  		 
          <div class="form-group">
       <label for="acard" class="mb-2 mr-sm-2">Aadhaar</label>
    			<input type="text" name="acard" id="acard"  class="form-control mb-2 mr-sm-2" placeholder="Enter Aadhaar" />
  			</div>


  			<div class="form-group">
    		<label for="email" class="mb-2 mr-sm-2">Email</label>
    			<input type="email" name="email" id="email"  class="form-control mb-2 mr-sm-2" placeholder="Enter Email" />
          </div>
        

    			   <div class="form-group">
        <label for="address" class="mb-2 mr-sm-2">Address</label>
    			<textarea name="address" rows="03" cols="22" id="address" class="form-control mb-2 mr-sm-2" placeholder="Enter Address"></textarea> 
          </div>
            
    			<div class="form-group">
        <label for="contact" class="mb-2 mr-sm-2">Contact Number</label>
    		<input type="tel" name="contact" id="contact" class="form-control mb-2 mr-sm-2" placeholder="Enter Contact" />
        </div>
    			
  				
		
		
</div>
<div class="card-footer">

    				<div colspan="2" align="center"><input type="submit" class="btn" style="background-color: #5FB48A;color: white;font-weight: bold;" name="customer" value="ADD"  id="login_submit"/></div>
   
  				
</div>
</form>

</div>

</div>








  <div class="container-fluid " style="background-color: #5FB48A;padding: 2px;">
  <h3 style="color:white; text-align: center;font-family:sans-serif; "><b>Contact us</b>&nbsp;&nbsp;&nbsp;&nbsp;<b>Feedback</b></h3>
 
  </div>
</body>
</html>




<script>
   
   function validate()
{


var ename=$("#cname").val().trim();
var gender=$("#gender").val().trim();
var acard=$("#acard").val().trim();
var email=$("#email").val().trim();
var address=$("#address").val().trim();
var contact=$("#contact").val().trim();

if(cname=='')
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
else if(address=='')
{
  alert("enter address");
return false;
}

else if(contact=='')
{
  alert("enter contact");
return false;
}else if(!(confirm("Register Customer!")))
{
  return false;
}
else{
  return true;
}
}
</script>