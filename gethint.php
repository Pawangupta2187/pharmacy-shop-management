<?php

include("dbpharmacy.php");
$mn=$_REQUEST["q"];
$sql5="SELECT * FROM medicine WHERE M_name='$mn';";

$result5=$con->query($sql5);

if(mysqli_num_rows($result5)>0){ 
 
echo '<datalist id="batch">';

  while($row4=mysqli_fetch_assoc($result5))
  {

  
   echo '<option value="'.$row4['Batch'].'" id="opt"></option>';
   


}
 echo '</datalist>';
}

?>

