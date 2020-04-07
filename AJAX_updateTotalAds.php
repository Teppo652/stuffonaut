<?php 

function updateTotalAds($id, $conn) {
	// get current totalAds
	$sql = "SELECT totalAds FROM categories WHERE id=$id LIMIT 1";
	//echo '<br>sql: ' . $sql;
	$result = mysqli_query($conn, $sql); 
	if (mysqli_num_rows($result) > 0) 
	{ 
		while($row = mysqli_fetch_assoc($result)) { $totalAds = $row["totalAds"]; }
	}
	if($totalAds == '') { $totalAds = 0; }
	$totalAds = (int)$totalAds;
	$totalAds++;
	$sql = "UPDATE categories SET totalAds=$totalAds WHERE id=$id";
	$conn->query($sql) or die("Error in updating totalAds : sql: $sql error: " . mysql_error());
}

?> 
