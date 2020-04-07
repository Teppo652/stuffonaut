<?php
// AJAX_updateUserSettings.php?uId=CCCABC&act=get
// AJAX_updateUserSettings.php?uId=CCCABC&cat1=112&cat2=221&hCats=345,323&act=save
include_once('functions.php'); 
$conn = getDBConn('','noWelcomeText');
$userSafeId = $action = $res = '';
$startCat1 = $startCat2 = $hiddenCats = -1;
$table = 'userSettings';

if (isset($_GET["uId"])) { 
	$userSafeId = filter_input( INPUT_GET, "uId", FILTER_SANITIZE_URL );

	if (isset($_GET["act"])) { $action = filter_input( INPUT_GET, "act", FILTER_SANITIZE_URL ); }
	if (isset($_GET["cat1"])) { $startCat1 = filter_input( INPUT_GET, "cat1", FILTER_SANITIZE_URL ); }
	if (isset($_GET["cat2"])) { $startCat2 = filter_input( INPUT_GET, "cat2", FILTER_SANITIZE_URL ); }
	if (isset($_GET["hCats"])) { $hiddenCats = filter_input( INPUT_GET, "hCats", FILTER_SANITIZE_URL ); }

	// get userSettings
	$sql = "SELECT * FROM $table WHERE userSafeId='$userSafeId' LIMIT 1";
	//echo '<br>get userSettings sql: ' . $sql . '<br>';
	$result = mysqli_query($conn, $sql); 
	//if (mysqli_num_rows($result) > 0) 
	if($result)
	{ 
		while($row = mysqli_fetch_assoc($result)) { 
			$res = $row["startCat1"].'#'.$row["startCat2"].'#'.$row["hiddenCats"]; 
		}
	} else { $res = ''; }

	if($action == 'get') {
		if($res != '') { return $res; } else { return ''; }
		//if($res != '') { echo "Result:".$res; } else { echo "Result:".''; } // for testing
	} else if($action == 'save') {
		if($res == '') {
			// TODO: check that hiddenFields legth is not over 500
			// save hidden cats

			// echo "<br>userSafeId:$userSafeId";
			// echo "<br>startCat1:$startCat1";
			// echo "<br>startCat2:$startCat2";
			// echo "<br>hiddenCats:$hiddenCats";

			$stmt = $conn->prepare("INSERT INTO $table (userSafeId,startCat1,startCat2,hiddenCats) VALUES (?,?,?,?)");
			$stmt->bind_param("siis", $userSafeId,$startCat1,$startCat2,$hiddenCats);
		    // put data in session
		    // saveInSession($safeId,$name,'pref1','pref2','pref3');

		} else {
			// update hidden cats
			/*
			$sql = "UPDATE $table SET startCat1=$startCat1,startCat2=$startCat2,hiddenCats='$hiddenCats' WHERE userSafeId='$userSafeId'";
			echo "SQL:$sql";
			$conn->query($sql) or die("Error in updating $table : " . mysql_error());
			*/
			$data = "startCat1=?,startCat2=?,hiddenCats=?";
			$stmt = $conn->prepare("UPDATE $table SET $data WHERE userSafeId=?"); // ,$adPrice d=float
			$stmt->bind_param('iiss',$startCat1,$startCat2,$hiddenCats,$userSafeId);
		}
		$stmt->execute();
		$stmt->close();
	} 
}
?> 
