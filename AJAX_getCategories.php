<?php 

// include('../../../includes/dataFunctions.php'); 
// include('../dating/dating_functions.php'); 

// TEST
// http://localhost/UUSI/common/SITES/montaSaittia/stuffonaut/AJAX_getCategories.php?pId=4&t=links&m=1&l=1&c=1

include_once('functions.php'); 


// --------------------------- AJAX GET SEARCH RESULT -----------------------------------
$conn = getDBConn('','noWelcomeText'); //  HUOM! eri kanta!!!! exams
$table = "categories"; // "categories";
//$result = []


$countryId = $langId = $parentId = $eId = $returnType = $showMoreClicked = $getAdPrices = $sql = '';
if (isset($_GET["l"])) { 
	$langId = filter_input( INPUT_GET, "l", FILTER_SANITIZE_URL );
	$countryId  = filter_input( INPUT_GET, "c", FILTER_SANITIZE_URL );
	if($countryId == '') { echo "<br>AJAX_getCategories: countryId missing - exit"; exit; }
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

	//echo "<br>l: $langId";
	//echo "<br>c: $countryId";
	//echo "<br>parentId: $parentId";
	//echo "<br>eId: $eId";
	//echo "<br>returnType: $returnType";
	//echo "<br>showMoreClicked: $showMoreClicked";
	//echo "<br>getAdPrices: $getAdPrices";

	// SELECT id,parentId,name,orderId FROM categoriestest WHERE parentId=2 ORDER BY orderId ASC
	

	/* OLD	
	$sql1 = "SELECT catId,parentId,extraId,name,catAdTypes";
	if($getAdPrices == '1') { $sql1.= ",pricePrivate,priceCompany";  }
	$sql2 = " FROM $table WHERE (langId = $langId  AND parentId";
	// if car
	if($eId == '3' && $showMoreClicked == '') {  // if car - get only first 0-8 car models if cat2 not selected
		$sql1.= ",totalAds"; 
		$sql2 .= "=$parentId AND totalAds>0) ORDER BY totalAds DESC  LIMIT 8";
	} else {
		// all others
		if ($returnType == 'defaultLinks') { // THIS NOT IN USE - done in Javascript 
			$sql2.= "< 0)";
		} else if ($returnType == 'links') {
			$sql1.= ",totalAds"; // return nums of items in each cat
			$sql2.= "= $parentId)"; 
		} else if ($returnType == 'cat1links') { // if quicklink category clicked
			//$sql.= "= $parentId)"; // TEST
			$sql2.= "< 0)";
		} else {
			$sql2.= "< 0) OR (langId = $langId AND parentId IS NULL)";
		}
		$sql2.= " ORDER BY orderId ASC";
		$sql2.= "  LIMIT 20";
	}
	*/

	// NEW - poista id!!!!! - was for testing only
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
		// $sql2.= ">= -1)";
		$sql2.= "< 0) OR (countryId = $countryId AND langId = $langId AND active = '1' AND parentId IS NULL)";
	}
	//$sql2.= " AND (countryId = $countryId AND active = '1')";
	//$sql2.= " ORDER BY orderId ASC"; // old working
	$sql2.= " ORDER BY catId ASC";

/*
ORIG:
	$sql1 = "SELECT id,catId,parentId,extraId,name,catAdTypes,totalAds,pricePrivate,priceCompany";
	$sql2 = " FROM $table WHERE (langId = $langId  AND parentId";
	
	if ($returnType == 'links') {
		$sql1.= ",totalAds"; // return nums of items in each cat
		$sql2.= "= $parentId)"; 
	} else if ($returnType == 'cat1links') { // if quicklink category clicked
		//$sql.= "= $parentId)"; // TEST
		$sql2.= "< 0)";
	} else {
		$sql2.= "< 0) OR (langId = $langId AND parentId IS NULL)";
	}
	$sql2.= " ORDER BY orderId ASC"; // old working
	//$sql2.= " ORDER BY catId ASC";
	// $sql2.= "  LIMIT 20";


*/
	
	/*
SELECT id,countryId,catId,parentId,extraId,name,catAdTypes,totalAds,pricePrivate,priceCompany FROM categories WHERE (countryId = 2661886 AND langId = 1 AND active = '1' AND parentId >= -1) ORDER BY catId ASC
	*/

	// user cat settings
	if ($returnType == 'catSettings') {
		$returnType = 'select';
		$sql1 = "SELECT *";
		$sql2 = " FROM $table WHERE (langId = $langId  AND parentId='-1')";
	
	}

	
	// echo "<br><br>".$sql1.$sql2."<br><br>";  exit;
/*
switch ($parentId) {
	case '1':
	case '2':
	case '3':
	case '121':
	case '149':
	case '176':
	case '196':
	case '263':
	echo '<br>SQL: ' . $sql . '<br>';
	break;
}
*/
	$result = mysqli_query($conn, $sql1.$sql2);
	//echo "<br>" . mysqli_num_rows($result);
	if ($result === false) { 
		//echo "<br> result returned null<br>";
		echo null; exit;  
	}
	$arr = array();

	//$jsonData = [];
	//$jsonData = new array();
	//$data = '';
	//if (mysqli_num_rows($result))
	//{

	/* NEW */
	$testName = '';
	$counter = 1;
	$catAdTypes = '';  /*  NEW: ||  $returnType == 'links' */
	if ($returnType == 'select' || $returnType == 'links') {
		
		if($getAdPrices == '1') {  // get prices
//echo "<br> get prices";
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
			} // while
		} else  {
//echo "<br> regular";  
			while($row = mysqli_fetch_assoc($result)) {
				//$testName = $counter.' '.$row['id'].' '.$row['name']; // $row['name']
				array_push($arr, array(
					'id'  		 => $row['catId'],
					'parentId' 	 => $row['parentId'],
					'eId'  		 => $row['extraId'],
					'name' 		 => $row['name'],
					'catAdTypes' => $row['catAdTypes']
					)); $counter++;
//echo "<br>" . $row['catId'] . '  ' . $row['name'];
			} // while
		}
	} else {
//echo "<br> get links";
		// returnType = links
		while($row = mysqli_fetch_assoc($result)){
			array_push($arr, array(
				'id'  		 => $row['catId'], 
				'name' 		 => $row['name'],
				'num'	 	 => $row['totalAds']
				));
		}  // while
	}





/* OLD

	if ($returnType == 'select') {
		while($row = mysqli_fetch_assoc($result)){ // TODO move this inside each if!!!
			//array_push($arr, array(
			//	'id'  		 => $row['id'], 
			//	'parentId' 	 => $row['parentId'],
			//	'name' 		 => $row['name'],
			//	'catAdTypes' => $row['catAdTypes']
			//	));

			//array_push($arr, array(
			//	'id'  		 => $row['id'], 
			//	'parentId' 	 => $row['parentId'],
			//	'name' 		 => $row['name'],
			//	'catAdTypes' => $row['catAdTypes']
			//	));

			//if(!isset($row['catAdTypes'])) { $row['catAdTypes'] = ''; }

			//if($row['catAdTypes'] != '')
			if(isset($row['catAdTypes']))
			{
				// -------------- with catAdTypes --------------
				if($getAdPrices == '1') {  // get prices
					array_push($arr, array(
						'id'  		 => $row['catId'],
						'eId'  		 => $row['extraId'],
						'name' 		 => $row['name'],
						'catAdTypes' => $row['catAdTypes'],
						'prp' 		 => $row['pricePrivate'],
						'prc' 		 => $row['priceCompany']
						));
				} else if($row['parentId'] == null) {
					// parentId is null
					array_push($arr, array(
						'id'  		 => $row['catId'],
						'eId'  		 => $row['extraId'],
						'name' 		 => $row['name'],
						'catAdTypes' => $row['catAdTypes']
						));
				} else {
					// parentId has value
					array_push($arr, array(
						'id'  		 => $row['catId'], 
						'parentId' 	 => $row['parentId'],
						'eId'  		 => $row['extraId'],
						'name' 		 => $row['name'],
						'catAdTypes' => $row['catAdTypes']
						));
				}

			} else {

				// -------------- no catAdTypes --------------
				if($row['parentId'] == null) {
					// parentId is null
					array_push($arr, array(
						'id'  		 => $row['catId'],
						'name' 		 => $row['name']
						));
				} else {
					// parentId has value
					array_push($arr, array(
						'id'  		 => $row['catId'], 
						'parentId' 	 => $row['parentId'],
						'name' 		 => $row['name']
						));
				}
			}
			
		} 
	} else {
		// links
		while($row = mysqli_fetch_assoc($result)){
			array_push($arr, array(
				'id'  		 => $row['catId'], 
				'name' 		 => $row['name'],
				'num'	 	 => $row['totalAds']
				));
		} 
	}
end old */

		/*
		switch ($returnType) {
			case 'defaultLinks':
				while($row = mysqli_fetch_assoc($result)){
					//echo '<a href="#" id="cat2_' . $row['id'] . '">' . ucfirst(mb_strtolower($row['name'], "UTF-8")) . '</a>';
					// array_push($jsonData, array('id' => $row['id'], 'name' => urlencode(ucfirst(mb_strtolower($row['name'], "UTF-8")))));
					array_push($jsonData, array('id' => $row['id'], 'parentId' => $row['parentId'],'name' => $row['name']));
				} break;
			case 'links':
				while($row = mysqli_fetch_assoc($result)){
					echo '<a href="#" id="cat2_' . $row['id'] . '">' . $row['name'] . '</a>'; 
				} break;
			default: /* select */
				// echo '<option value="-1">' . "Alla kategorier" . "</option>";
		/*
				while($row = mysqli_fetch_assoc($result)){
					if($row["parentId"] == -1) 
					{ 
						if($row['id'] > 2) { echo '<option disabled>' . "&nbsp;" . "</option>"; } // empty row
						$data = ' disabled '; // style="color:#000"
						echo "<option" . $data  . ">" . strtoupper($row['name']) . "</option>";
					} else { 
						$data = " value=" . $row['id']; 
						echo "<option" . $data  . ">" . $row['name'] . "</option>";
					}
					// echo "<option id=" . $row['id']  . ">" . $row['name'] . "</option>";
				} break;
		*/
		//} // switch
		// if($returnType == 'defaultLinks') { return $options; }
		//return json_encode($arr);
		//sleep(5);
		
		echo json_encode($arr);
		//echo $arr;
	/*
		while($row = mysqli_fetch_assoc($result))
		{			
			if ($returnType == 'links') {
				echo '<a href="#">' . $row["name"] . '</a>';
			} else {
				// 
				if($row["parentId"] == -1) 
				{ 
					if($row["id"] > 2) { echo '<option disabled>' . "&nbsp;" . "</option>"; } // empty row
					$data = ' disabled '; // style="color:#000"
				} else { $data = " value=" . $row["id"]; }
				echo "<option " . $data  . ">" . $row["name"] . "</option>";

				// echo "<option id=" . $row["id"]  . ">" . $row["name"] . "</option>";
			}
		}
	*/
	//} else { echo "0 results"; }
	//return $data;
} // if (isset($_GET["l"])) {
?>



