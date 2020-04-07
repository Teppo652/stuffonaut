<?php
include_once('functions.php'); 
$conn = getDBConn('','noWelcomeText');

$id = $active = $del = $yesterday = '';

if (isset($_GET["id"])) { 
	$id = filter_input( INPUT_GET, "id", FILTER_SANITIZE_URL ); 

	// activate or deactivate
	if (isset($_GET["active"])) { 
		$active = filter_input( INPUT_GET, "active", FILTER_SANITIZE_URL );		
		if ($active == '1' || $active == '0') { 
			$sql = "UPDATE ads SET active='".$active."' WHERE id=$id";
		} 
	}
	// delete
	if (isset($_GET["del"])) { 
		$del = filter_input( INPUT_GET, "del", FILTER_SANITIZE_URL );		
		if ($del == '1') { 
			$yesterday = getCurrentDateAsYYMMDDHHMM('yesterday') . '0000';
			$sql = "UPDATE ads SET endDate='".$yesterday."' WHERE id=$id";
			// echo "<br>DELETING, NEW DATE: $yesterday SQL: $sql";
		}
	}
	$conn->query($sql) or die("Error in updating ad : sql: $sql error: " . mysql_error());
}
?> 
