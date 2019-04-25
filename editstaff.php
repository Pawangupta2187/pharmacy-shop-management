 <?php
session_start();//

include("dbpharmacy.php");
if(empty($_SESSION['Emp_id']))
{
 
  header("location:index.php");
}



$id=$_GET['Emp_id'];
$query = "SELECT * FROM employees where Emp_id=$id";  // query to search users from Table
$res = $con->query($query); // query runs here
$row=mysqli_fetch_assoc($res);

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
    $status=$_POST['status'];
    $contact=$_POST['contact'];


//$sql="insert into employees (`Emp_name`,`Emp_gender`,`Emp_adhar`,`Emp_mail`,`Emp_designation`,`Emp_address`,`Salary`,`Duty_hours`,`Status`,`Contact_no`)values('$ename','$gender','$acard','$email','$designation','$address','$salary','$duty','$status','$contact');";

$sql="update employees set Emp_name='$ename',Emp_gender='$gender',Emp_adhar='$acard',Emp_mail='$email',Emp_designation='$designation',Emp_address='$address',Salary='$salary',Duty_hours='$duty',Status='$status',Contact_no= '$contact' where Emp_id=$id";


$result=$con->query($sql);//mysql_query($sql)
if ($result)
{?>
<script type="text/javascript">
window.history.go(-2);
</script>

<?php }else
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
Update Staff Detail Here!
</div>
<div class="card-body" style="text-align: center;">
<form  method="post"  onsubmit="return validate();" action=""  enctype="multipart/form-data" >
		<table width="80%"  align="center"  cellpadding="4" cellspacing="2" >
	
  			<tr>
    			<td align="left" >Employee Name</td>
    			<td align="right" ><input type="text" name="ename"  id="ename" value="<?php echo $row['Emp_name']; ?>"/></td>
  			</tr>
			<tr>
  				<td align="left">Gender</td>
  				<td align="right">
  					<select name="gender" id="gender" value="<?php echo $row['Emp_gender']; ?>">
                    <option value="Male" <?php if($row['Emp_gender']=='Male'){echo "selected";} ?>>Male</option>
                    <option value="Female"<?php if($row['Emp_gender']=='Female'){echo "selected";} ?>>Female</option></select>
  				</td>
  			</tr>
  			<tr>
    			<td align="left">Addhar Card</td>
    			<td align="right"><input type="text" name="acard" id="acard" value="<?php echo $row['Emp_adhar']; ?>"/></td>
  			</tr>
  			<tr>
    			<td align="left">Email</td>
    			<td align="right"><input type="text" name="email" id="email" value="<?php echo $row['Emp_mail']; ?>"/></td>
  			</tr><tr>
    			<td align="left">Designation</td>

          <td align="right">
            <select name="designation" id="design" >
                    <option value="Pharmacist" <?php if($row['Emp_designation']=='Pharmacist'){echo "selected";} ?>>Pharmacist</option>
                    <option value="Cashier"    <?php if($row['Emp_designation']=='Cashier'){echo "selected";} ?> >Cashier</option></select>
          </td>
  			</tr><tr>

    			<td align="left">Address</td>
    			<td align="right"><textarea name="address" rows="03" cols="22" id="address" ><?php echo $row['Emp_address'];?></textarea></td>
  			</tr><tr>
    			<td align="left">Salary</td>
    			<td align="right"><input type="number" name="salary" id="salary" value="<?php echo $row['Salary']; ?>"/></td>
  			</tr><tr>
    			<td align="left">Duty Hours</td>
    			<td align="right"><input type="number" name="duty" id="duty" value="<?php echo $row['Duty_hours']; ?>"/></td>
  			</tr>
            
            <tr>
  				<td align="left">Status</td>
  				<td align="right">
  					<select name="status" value="<?php echo $row['Status']; ?>" id="status" >
                    <option value="Paid" <?php if($row['Status']=='Paid'){echo "selected";} ?>>Paid</option>
                    <option value="Not paid" <?php if($row['Status']=='Not Paid'){echo "selected";} ?>>Not paid</option></select>
  				</td>
  			</tr>
<tr>
    			<td align="left">Contact Number</td>
    			<td align="right"><input type="tel" name="contact" id="contact" value="<?php echo $row['Contact_no']; ?>"/></td>
  			</tr>
    			
  				
			</table>
		
</div>
<div class="card-footer">

    				<div colspan="2" align="center"><input type="submit" class="btn" style="background-color: #5FB48A;color: white;font-weight: bold;" name="staff" value="Update"  id="login_submit"/></div>
   
  				
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
var status=$("#status").val().trim();
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
else if(status=='')
{
  alert("select status");
return false;
}
else if(contact=='')
{
  alert("enter contact");
return false;
}
else if(!(confirm("Conifirm Staff!")))
{
  return false;
}else{
  return true;
}
}
</script>