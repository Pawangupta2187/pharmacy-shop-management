<?php

 include("dbpharmacy.php");

$date=date("Y-m-d");
$sum=0;
$sql="SELECT * FROM `order` WHERE O_date='$date';";
$res=$con->query($sql);
	if(mysqli_num_rows($res)>0){ 
		while($row=mysqli_fetch_assoc($res)){

$sum=$sum+$row['Amount'];

		}
}
$sql1="SELECT * FROM `sales` WHERE Date='$date';";

$res1=$con->query($sql1);

if($res1)
{ //echo "update";
	$sql2="UPDATE `sales` set Cur_sales='$sum' where Date='$date'";
}
else
{
	$sql="INSERT INTO `sales`(`Date`, `Cur_sales`) VALUES ('$date','$sum');";
}
$res2=$con->query($sql2);
if(!($res2))
{
	print_r($res2);
}
else
{?>
<script type="text/javascript">
window.history.go(-1);
</script>

<?php

}

?>