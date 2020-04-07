<?php
include_once('functions.php'); 
$conn = getDBConn('','noWelcomeText'); 

$cat2Id = $langId = '';
$arr = array();
if (isset($_GET["cat2Id"])) 
{ 
	$cat2Id = filter_input( INPUT_GET, "cat2Id", FILTER_SANITIZE_URL ); 
	if (isset($_GET["cat2Id"])) 
	{
		$langId = filter_input( INPUT_GET, "langId", FILTER_SANITIZE_URL ); 
		if (is_numeric($cat2Id)) 
		{

			$sql = "SELECT name FROM categories WHERE langId=$langId AND catId=$cat2Id LIMIT 1";
			//echo '    ' . $sql . '  ';
			$result = mysqli_query($conn, $sql); 
			if (mysqli_num_rows($result) > 0) 
			{ 
				while($row = mysqli_fetch_assoc($result)) { echo $row["name"]; }
			}
		}
	}
}
?> 