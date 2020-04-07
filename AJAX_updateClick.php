<?php 
include_once('functions.php'); 
$conn = getDBConn('','noWelcomeText');

$id = $numClicks = '';
if (isset($_GET["id"])) { $id = filter_input( INPUT_GET, "id", FILTER_SANITIZE_URL ); }
if (is_numeric($id)) {

	// get current click num
	$sql = "SELECT numClicks FROM ads WHERE id=$id LIMIT 1";
	//echo '<br>sql: ' . $sql;
	$result = mysqli_query($conn, $sql); 
	if (mysqli_num_rows($result) > 0) 
	{ 
		while($row = mysqli_fetch_assoc($result)) { $numClicks = $row["numClicks"]; }
	}
	if($numClicks == '') { $numClicks = 0; }
	$numClicks = (int)$numClicks;
	$numClicks++;
	// UPDATE ads SET numClicks=55 WHERE id=1
	$sql = "UPDATE ads SET numClicks=$numClicks WHERE id=$id";
	$conn->query($sql) or die("Error in updating $table : " . mysql_error());
}
?> 
