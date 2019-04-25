<?php
include("dbpharmacy.php");

$batch=$_GET['batch'];
$sql="select *from medicine where Batch='$batch'";
$res=$con->query($sql);
$row=mysqli_fetch_assoc($res);

$myArr = array($row['Unit'],$row['M_price']);

$myJSON = json_encode($myArr);

echo $myJSON;
?>