<?php
include_once('connection.php');
$result= mysqli_query($conn , "SELECT * FROM player2 ORDER BY searched DESC LIMIT 5;");
echo "<ol type = '1' style='line-height:0px'>";
while ($row = mysqli_fetch_assoc($result)){
	//Printing in the searched area
  echo "<font color='#009900'><b><li>".$row['name'].": ".$row['searched']." times</li></b>"."</font><br>";

	}
echo "</ol>";
?>
