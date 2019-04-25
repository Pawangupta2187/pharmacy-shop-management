<?php
 include("dbpharmacy.php");

$date=date("Y-m-d");
$y=$d=date("Y");
$m=date("m");
$d=$d=date("d");
$befordate=$m-1;
$fromdate=$y."-".$befordate."-".$d;
//echo $fromdate;"SELECT * FROM `sales` WHERE Date>='$fromdate' AND Date<='$date';





if(isset($_POST['submit']))
{

$searchfromdate=$_POST['date'];
$searchtodate=$_POST['dateto'];


$sql="SELECT * FROM `sales` WHERE Date>='$searchfromdate' AND Date<='$searchtodate';";
$res=$con->query($sql);
}

else{

$sql="SELECT * FROM `sales` WHERE Date>='$fromdate' AND Date<='$date';";
$res=$con->query($sql);

}
$dataPoints = array();
//$day=1;
//print_r($sql);
/*
//Best practice is to create a separate file for handling connection to database
try{
     // Creating a new connection.
    // Replace your-hostname, your-db, your-username, your-password according to your database
    $link = new \PDO(   'mysql:host=your-hostname;dbname=your-db;charset=utf8mb4', //'mysql:host=localhost;dbname=canvasjs_db;charset=utf8mb4',
                        'your-username', //'root',
                        'your-password', //'',
                        array(
                            \PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                            \PDO::ATTR_PERSISTENT => false
                        )
                    );
	
    $handle = $link->prepare('select x, y from datapoints'); 
    $handle->execute(); 
    $result = $handle->fetchAll(\PDO::FETCH_OBJ);
		
    foreach($result as $row){                                                  */
    if(mysqli_num_rows($res)>0){ 
        while($row=mysqli_fetch_assoc($res))  
{ 
        array_push($dataPoints, array("y"=> $row['Cur_sales'],"label" => $row['Date']));//"x"=> $row['Cur_sales']));
}
}
   

   /* }
	$link = null;
}
catch(\PDOException $ex){
    print($ex->getMessage());
}
	*/
?>
<!DOCTYPE HTML>
<html>
<head>  
<script>
onload= function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	exportEnabled: true,
	theme: "light2", // "light1", "light2", "dark1", "dark2"
	title:{
		text: "Datewise sales "
	},
	data: [{
		type: "line", //change type to bar, line, area, pie, etc  
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>
</head>
<body >






<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<div>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark" style="color:white;">

        <form class="form-inline" action="" method="post">
   From&nbsp; <input class="form-control mr-sm-2" type="Date" placeholder="Search" name="date">
   TO &nbsp;<input class="form-control mr-sm-2" type="Date" placeholder="Search" name="dateto">
    <button class="btn btn-success " type="submit" style="background-color: #5FB48A" name="submit">Search</button>
  </form>

</nav>

</div>
</body>
</html>   