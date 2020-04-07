<?php 

// include('../../../includes/dataFunctions.php'); 
// include('../dating/dating_functions.php'); 


include_once('functions.php'); 


// --------------------------- AJAX GET SEARCH RESULT -----------------------------------
$conn = getDBConn('','noWelcomeText'); //  HUOM! eri kanta!!!! exams
$table = "categories"; // "categories";
//$result = []


$countryId = $langId = $parentId = $eId = $returnType = $showMoreClicked = $getAdPrices = $sql = '';
if (isset($_GET["l"])) { 
	$langId = filter_input( INPUT_GET, "l", FILTER_SANITIZE_URL );
	$countryId  = filter_input( INPUT_GET, "c", FILTER_SANITIZE_URL );
	if($countryId == '') { echo "<br>AJAX_getCategories: countryId missing - exit"; /*exit;*/ }
	switch ($langId) {
		case 'fi': $langId = 0; break;
		case 'sv': $langId = 1; break;
		case 'en': $langId = 2; break; // AJAX_getCategories.php?pId=4&t=links&m=1
	}


	if (isset($_GET["pId"])) {$parentId = filter_input( INPUT_GET, "pId", FILTER_SANITIZE_URL ); } // parentId
	if (isset($_GET["eId"])) {$eId = filter_input( INPUT_GET, "eId", FILTER_SANITIZE_URL ); } // eId
	if (isset($_GET["t"]))   {$returnType = filter_input( INPUT_GET, "t", FILTER_SANITIZE_URL ); } // return 
	if (isset($_GET["m"]))   {$showMoreClicked = filter_input( INPUT_GET, "m", FILTER_SANITIZE_URL ); } 
	if (isset($_GET["pr"]))  {$getAdPrices = filter_input( INPUT_GET, "pr", FILTER_SANITIZE_URL ); } 

	// if($returnType == 'links') { $totalAds = ',totalAds';} 

	echo "<br>l: $langId";
	echo "<br>c: $countryId";
	echo "<br>parentId: $parentId";
	echo "<br>eId: $eId";
	echo "<br>returnType: $returnType";
	echo "<br>showMoreClicked: $showMoreClicked";
	echo "<br>getAdPrices: $getAdPrices";

	// NEW - poista id!!!!! - was for testing only
/*
	$sql1 = "SELECT id,catId,parentId,extraId,name,catAdTypes,totalAds,pricePrivate,priceCompany";
	$sql2 = " FROM $table WHERE (countryId = $countryId AND langId = $langId AND active = '1' AND parentId";
	
	if ($returnType == 'links') {
		$sql1.= ",totalAds"; // return nums of items in each cat
		$sql2.= "= $parentId)"; 
	} else if ($returnType == 'cat1links') { // if quicklink category clicked
		//$sql.= "= $parentId)"; // TEST
		$sql2.= "< 0)";
	} else {
		// $sql2.= "< 0) OR (parentId IS NULL)"; // langId = $langId AND 
		$sql2.= ">= -1)";
	}
	//$sql2.= " AND (countryId = $countryId AND active = '1')";
	//$sql2.= " ORDER BY orderId ASC"; // old working
	$sql2.= " ORDER BY catId ASC";
	$sql2.= "  LIMIT 1";
*/

// TESTING

	$sql1 = "SELECT * FROM categories";
	echo "<br>$sql1";
	//$result = mysqli_query($conn, $sql1);
	$result = mysqli_query($conn, $sql1) or die(mysqli_error($conn)); 
	//echo "<br>" . mysqli_num_rows($result);
	if ($result === false) { 
		echo "<br> result returned null<br>";
		//echo null; exit;  
	}
	$arr = array();

	$testName = '';
	$counter = 1;
	$catAdTypes = ''; 
		
			while($row = mysqli_fetch_assoc($result)) {
				array_push($arr, array(
					'id'  		 => $row['catId'],
					'parentId' 	 => $row['parentId'],
					'eId'  		 => $row['extraId'],
					'name' 		 => $row['name'],
					'catAdTypes' => $row['catAdTypes'],
					'prp' 		 => $row['pricePrivate'],
					'prc' 		 => $row['priceCompany']
					));
					echo '<br>' . $row['name'];
			} // while


		//sleep(5);
		echo json_encode($arr);
		// echo implode(' ', $arr);
} // if (isset($_GET["l"])) {
?>



