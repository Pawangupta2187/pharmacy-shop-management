<?php
require("database.php");
$user_id=$_GET['user_id'];
$query = "SELECT * FROM register where user_id=$user_id";  // query to search users from Table
$res = $con->query($query); // query runs here
$row=mysqli_fetch_assoc($res);
$qualification_arr=explode(",",$row['qualification']);

if(isset($_POST['submits'])) 
{
	$nm=$_POST['nm'];
	$em=$_POST['em'];
	$ps =$_POST['ps'];
	$rd=$_POST['rd'];
	$bc=$_POST['q'];
	$bc=implode(",",$bc);

	$txt=$_POST['txt'];
	$nationality=$_POST['nationality'];
	$new_filename="";
	$filename=$_FILES["fl"]["name"];
	//print_r($_FILES);die;
    if($filename!="")
    {
    	$filename_arr=explode(".",$filename);
    	$ext=end($filename_arr);
    	$new_filename=time().".".$ext;
    	move_uploaded_file($_FILES["fl"]["tmp_name"],"uploads/".$new_filename);
    }else{
    	$new_filename=$_POST['old_image'];
    }
$sql="update register set name='$nm',email='$em',gender='$rd',qualification='$bc',address='$txt',Nationality='$nationality',profile='$new_filename' where user_id=$user_id";
$result=$con->query($sql);
if($result)
{
	header("location:userlist.php");
}
else
	{echo $con->error;}

}?>
<!DOCTYPE html>
<html>
<head>
	<title>regis</title>
</head>
<body>


<table border="2" cellspacing="3" cellpadding="3">
	<form method="post" enctype="multipart/form-data">
		
		<tr>
		<td colspan="2" align="center">Registration
		</td>
		</tr>

		<tr >
		<td width="50%">name
		</td>
		<td><input type="text" name="nm" value=<?php echo $row['name'];?>></td>
		</tr>

		<tr>
		<td>email
		</td>
		<td><input type="email" name="em" value=<?php echo $row['email'];?>></td>
		</tr>

		

		<tr >
		<td>gender
		</td>
		<td>male<input type="radio" name="rd" value="Male" <?php if($row['gender']=="Male"){echo "checked='checked'";} ?>>female<input type="radio" name="rd" value="Female" <?php if($row['gender']=="Female"){echo "checked='checked'";} ?>></td>
		</tr>

		<tr >
		<td>qualification
		</td>
		<td>BCA<input type="checkbox" name="q[]" value="BCA"  <?php if(in_array("BCA",$qualification_arr)){echo "checked='checked'";} ?>></br>MCA<input type="checkbox" name="q[]" value="MCA" <?php if(in_array("MCA",$qualification_arr)){echo "checked='checked'";} ?>></br>Others<input type="checkbox" name="q[]" value="Others" <?php if(in_array("Others",$qualification_arr)){echo "checked='checked'";} ?>></td>
		</tr>

		<tr >
		<td>address
		</td>
		<td><textarea rows="3" cols="7" name="txt" ><?php echo $row['address'];?></textarea></td>
		</tr>

        <tr >
		<td>Nationality
		</td>
		<td><select name="nationality" value=<?php echo $row['Nationality'];?>
		     <option value="Indian">Indian</option><option value="Non-Indian">Non-Indian</option></td>
		</tr>
		

		<tr >
		<td>profile image
		</td>
		<td><input type="file" name="fl"><input type="hidden" name="old_image" value="<?php echo $row['profile']; ?>"/>
		</td>
		</tr>
		

<tr>
		<td colspan="2" align="center"><input type="submit" name="submits" value="update">
		</td>
		</tr>

	</form>

</table>


</body>
</html>