<?php
/* takes users safeId and returns requested fieldname value (phone or email) */
include_once('functions.php'); 
$conn = getDBConn('','noWelcomeText'); 

$safeId = $fieldName = '';
$arr = array();
if (isset($_GET["fieldName"])) 
{ 
	if (isset($_GET["safeId"])) 
	{
		$fieldName = filter_input( INPUT_GET, "fieldName", FILTER_SANITIZE_URL ); 
		$safeId = filter_input( INPUT_GET, "safeId", FILTER_SANITIZE_URL );
		$sql = "SELECT $fieldName FROM users WHERE safeId='$safeId' LIMIT 1";
		//echo '<br>   ' . $sql . '<br>';
		$result = mysqli_query($conn, $sql); 
		if (mysqli_num_rows($result) > 0) 
		{ 
			while($row = mysqli_fetch_assoc($result)) { 
				switch($fieldName) {
				  case 'phone': echo $row["phone"]; break;
				  case 'email': echo simple_crypt($row["email"], 'd'); break;
				} 
			}
		}
	}
}
?> 