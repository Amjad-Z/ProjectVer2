<?php
header('Content-Type: application/json');

include_once('connection.php');

//$sqlQuery = "SELECT name,rating FROM player2 ORDER BY rating DESC LIMIT 5;";
$sqlQuery = "SELECT name,goals FROM player2 ORDER BY goals DESC LIMIT 5;";

$result = mysqli_query($conn,$sqlQuery);

$data = array();
foreach ($result as $row) {
	$data[] = $row;
}

mysqli_close($conn);

echo json_encode($data);
?>
