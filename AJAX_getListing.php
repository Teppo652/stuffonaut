<?php 
// header('Content-Type: text/html; charset=utf-8');
include_once('functions.php'); 
// --------------------------- AJAX GET SEARCH RESULT -----------------------------------
$conn = getDBConn('','noWelcomeText');
$thisPage = "index.php";


/* ============NEW use this================= */
/*
// init variables
$fields = 'searchText,cat1,cat2,area1,area2,adType,advertiserType,sortBy,tableStyle,page'; 
$fieldsArr = explode(',', $fields);
for($i = 0; $i < count($fieldsArr); $i++) {
	$fieldName = $fieldsArr[$i];
	$$fieldName = '';
}
*/


// INIT
$userId = $countryGeoId = $langId = $cat1 = $cat2 = $area = $area0 = $area1 = $area2 = $area3 = $isCompany = $adType = $title = $mainImg = $img = $texts = $price = $createdDate = $startDate = $endDate = $isEnhanced = $adPassword = $stars = $numClicks = $numComments = $active = $prefix = "";
//$userId = $countryId = $langId = $cat1 = $cat2 = $area1 = $area2 = $isCompany = $adType = $title = $img = $texts = $price = $createdDate = $startDate = $endDate = $isEnhanced = $active = '';


$tableData = '';
// init pagination
$paginationData = '';
$limit = 10; // number of items per page in pagination
if (isset($_GET['page'])) { $page = filter_input( INPUT_GET, 'page', FILTER_SANITIZE_URL ); } else { $page = 1; } // default 1
$start=($page-1)*$limit;

/* latest
drop table ads;

create table ads (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,userId INT,countryId INT,langId INT,cat1 INT,cat2 INT,area1 INT,area2 INT,isCompany BOOLEAN,adType TINYINT UNSIGNED,title VARCHAR(50),img VARCHAR(255),texts VARCHAR(2000),price INT,createdDate INT,startDate INT,endDate INT,isEnhanced TINYINT UNSIGNED,active TINYINT UNSIGNED);



INSERT INTO ads (userId,countryId,langId,cat1,cat2,area1,area2,isCompany,adType,title,img,texts,price,createdDate,startDate,endDate,isEnhanced,active) VALUES 
(1,1,2,1,null,1,1,0,0,'title6','img1','texts1',15,181010,181010,181019,null,1),
(2,1,2,2,null,1,1,0,0,'title7','img2','texts2',25,181010,181010,181019,null,1),
(3,1,2,3,null,1,1,0,0,'title8','img3','texts3',35,181011,181011,181019,null,1),
(4,1,2,4,null,1,1,0,0,'title9','img4','texts4',45,181011,181011,181019,null,1),
(5,1,2,5,null,1,1,0,0,'title10','img5','texts5',55,181012,181012,181019,null,1);
*/

// OR separate lines 
/* 
$userId = '';
$countryGeoId = '';
$langId = '';
$cat1 = '';
$cat2 = '';
$area = $area0 = $area1 = $area2 = $area3 = '';  
*/
$isCompany = '';
/*
$adType = '';
$title = '';
$img = '';
$texts = '';
$price = '';
$createdDate = '';
$startDate = '';
$endDate = '';
$isEnhanced = '';
$active = '';
 */ 
$searchText = '';
$mainCat = '';
//$area = '';
//$area0 = '';
//$area1 = '';
//$area2 = '';
$adType = '';
$advertiserType = '';
$sortBy = '';
$tableStyle = '';

// code 
$searchCriteria = ''; 
$sqlExtra = ''; 
//if (isset($_GET["searchCriteria"])) 
//{ 
//	$searchCriteria = filter_input( INPUT_GET, 'searchCriteria', FILTER_SANITIZE_URL ); 
//	echo '<br>searchCriteria: ' . $searchCriteria;
//} 

// search form
// adType="0"&advertiserType="all"&sortBy="time"&tableStyle="cards"
// ?tableStyle="cards"&adType=0&advertiserType="all"&sortBy="time"
//if (isset($_GET["countryId"])) { $countryId = filter_input( INPUT_GET, "countryId", FILTER_SANITIZE_URL ); }
//if (isset($_GET["langId"])) { $langId = filter_input( INPUT_GET, "langId", FILTER_SANITIZE_URL ); }
//switch ($langId) {
//		case 'fi': $langId = 0; break;
//		case 'sv': $langId = 1; break;
//		case 'en': $langId = 2; break;
//}

if (isset($_GET["countryGeoId"])) { $countryGeoId = filter_input( INPUT_GET, "countryGeoId", FILTER_SANITIZE_URL ); }

// cAdId currAdId

// =================================== get single users all ads ===================================
$currAdId = '';
if (isset($_GET["cAdId"])) { 
	$currAdId = filter_input( INPUT_GET, "cAdId", FILTER_SANITIZE_URL ); 
	$userId = '';
	// get userId
	$sql = "SELECT userId FROM ads WHERE id=$currAdId LIMIT 1";
	//echo '<br>sql: ' . $sql;
	$result = mysqli_query($conn, $sql); 
	if (mysqli_num_rows($result) > 0) { while($row = mysqli_fetch_assoc($result)) { $userId = $row["userId"]; } }


	$sql = "SELECT a.id, a.cat1, a.cat2, a.area, a.area0, a.area1, a.area2, a.area3, a.isCompany, a.title, a.mainImg, a.img, a.price, a.startDate, a.stars, a.numClicks, a.numComments, c.name as cat1Name, c2.name as cat2Name FROM ads as a INNER JOIN categories as c ON a.cat1=c.id LEFT JOIN categories as c2 ON a.cat2=c2.id 
		WHERE a.userId=$userId AND a.active=1";
	$sql .= " AND countryGeoId=" . $countryGeoId;

} else {

	// ====================================== normal search ==============================================

	if (isset($_GET["area"])) { $area = filter_input( INPUT_GET, "area", FILTER_SANITIZE_URL ); }
	if (isset($_GET["area0"])) { $area0 = filter_input( INPUT_GET, "area0", FILTER_SANITIZE_URL ); }
	if (isset($_GET["area1"])) { $area1 = filter_input( INPUT_GET, "area1", FILTER_SANITIZE_URL ); }
	if (isset($_GET["area2"])) { $area2 = filter_input( INPUT_GET, "area2", FILTER_SANITIZE_URL ); }
	if (isset($_GET["area3"])) { $area3 = filter_input( INPUT_GET, "area3", FILTER_SANITIZE_URL ); }



	/* uusin */
	if (isset($_GET["tableStyle"])) { $tableStyle = filter_input( INPUT_GET, "tableStyle", FILTER_SANITIZE_URL ); } 
	if (isset($_GET["searchText"])) { $searchText = urldecode(filter_input( INPUT_GET, "searchText", FILTER_SANITIZE_URL )); }
	if (isset($_GET["cat1"])) { $cat1 = filter_input( INPUT_GET, "cat1", FILTER_SANITIZE_URL ); }

	if (isset($_GET["adType"])) { $adType = filter_input( INPUT_GET, "adType", FILTER_SANITIZE_URL ); }
	if (isset($_GET["advertiserType"])) { $advertiserType = filter_input( INPUT_GET, "advertiserType", FILTER_SANITIZE_URL ); }
	if (isset($_GET["sortBy"])) { $sortBy = filter_input( INPUT_GET, "sortBy", FILTER_SANITIZE_URL ); } else { $sortBy = 'time'; } // default 1 //// time,price





	//countryGeoId=2661886
	//&area=2673722




	// // pagination texts
	// $firstPageText = $previousPageText = $nextPageText = $lastPageText = '';
	// if (isset($_GET["firstPage"])) { $firstPageText = filter_input( INPUT_GET, "firstPage", FILTER_SANITIZE_URL ); }
	// if (isset($_GET["previousPage"])) { $previousPaText = filter_input( INPUT_GET, "previousPage", FILTER_SANITIZE_URL ); }
	// if (isset($_GET["nextPage"])) { $nextPageText = filter_input( INPUT_GET, "nextPage", FILTER_SANITIZE_URL ); }
	// if (isset($_GET["lastPage"])) { $lastPageText = filter_input( INPUT_GET, "lastPage", FILTER_SANITIZE_URL ); }


	// echo '<br>tableStyle: ' . $tableStyle . '<br>';






	// TODO: add  cat1

	// echo '<h2>sqlExtra</h2>';
	// echo '<br>tableStyle: ' . $tableStyle;
	// echo '<br>searchText: ' . $searchText;
	// echo '<br>adType: ' . $adType;
	// echo '<br>advertiserType: ' . $advertiserType;
	// echo '<br>sortBy: ' . $sortBy;

	// TODO: select layout according to $tableStyle value!!!



	// --------- SQL query --------- 
	//$totNumberOfItems = 0;
	
	

	$fields = 'id,cat1,cat2,area,area0,area1,area2,area3,isCompany,title,mainImg,img,price,startDate,stars,numClicks,numComments';
	$prefix = $cat1 == "" ? "" : "a.";



	// for testing - fetches all - no attributes
	//$sql = "SELECT id,cat1,cat2,area,area0,area1,area2,area3,isCompany,title,mainImg,price,startDate
	//			FROM ads WHERE active=1";

	// use in PRODUCTION !!!!!!
	// if($countryGeoId == null) { return null; exit; } // exit if no country


	/* toimiva */
	//if($cat1 == '') {
	//	// all are in same category - do not return cat1 name, get it in client -------------------------------TEMP *!!!
	//	// $sql = "SELECT id,cat1,cat2,area,area0,area1,area2,area3,isCompany,title,mainImg,price,startDate,numComments
	//	$sql = "SELECT *
	//			FROM ads WHERE active=1"; //    
	//} else {
	  	// with cat1 names - return cat1 name   -- ads cat1= categories id
	  	// toimiva
	  	/*
		$sql = "SELECT a.id, a.cat1, a.cat2, a.area, a.area0, a.area1, a.area2, a.area3, a.isCompany, a.title, a.mainImg, a.img, a.price, a.startDate, a.stars, a.numClicks, a.numComments, c.name FROM ads as a INNER JOIN categories as c ON a.cat1=c.id WHERE a.active=1"; 
		*/
	//	$sql = "SELECT a.id, a.cat1, a.cat2, a.area, a.area0, a.area1, a.area2, a.area3, a.isCompany, a.title, a.mainImg, a.img, a.price, a.startDate, a.stars, a.numClicks, a.numComments, c.name FROM ads as a INNER JOIN categories as c ON a.cat1=c.id WHERE a.active=1"; 
	//}

	// if($cat1 == '') {        
		// all in different category 1 - return cat1 and cat2 name
		/* toimiva
		$sql = "SELECT a.id, a.cat1, a.cat2, a.area, a.area0, a.area1, a.area2, a.area3, a.isCompany, a.title, a.mainImg, a.img, a.price, a.startDate, a.stars, a.numClicks, a.numComments, c.name as cat1Name, c2.name as cat2Name FROM ads as a INNER JOIN categories as c ON a.cat1=c.id LEFT JOIN categories as c2 ON a.cat2=c2.id 
			WHERE a.active=1";
		*/
		/* UUSI jossa seller stats */
		/* hakee tuplia serverillä 
		$sql = "SELECT a.id, a.cat1, a.cat2, a.area, a.area0, a.area1, a.area2, a.area3, a.isCompany, a.title, a.mainImg, a.img, a.price, a.startDate, a.stars, a.numClicks, a.numComments, u.name, u.userSinceDate, u.totAds, u.totActAds, c.name as cat1Name, c2.name as cat2Name FROM ads as a INNER JOIN categories as c ON a.cat1=c.catId LEFT JOIN categories as c2 ON a.cat2=c2.catId JOIN users as u ON a.userId=u.id 
			WHERE a.active=1"; */

		/* TEST
		$sql = "SELECT a.id, a.cat1, a.cat2, a.area, a.area0, a.area1, a.area2, a.area3, a.isCompany, a.title, a.mainImg, a.img, a.price, a.startDate, a.stars, a.numClicks, a.numComments, u.name, u.userSinceDate, u.totAds, u.totActAds FROM ads as a 
		JOIN (SELECT name FROM categories GROUP BY u.id) as catNames ON a.cat1=categories.catId 
		LEFT JOIN categories as c2 ON a.cat2=c2.catId JOIN users as u ON a.userId=u.id 
			WHERE a.active=1"; */
		// korjattu:
		/* SELECT a.id, a.userId, a.cat1, a.cat2, a.area, a.area0, a.area1, a.area2, a.area3, a.isCompany, a.title, a.mainImg, a.img, a.price, a.startDate, a.stars, a.numClicks, a.numComments, u.name, u.userSinceDate, u.totAds, u.totActAds, c.name as cat1Name, c2.name as cat2Name FROM ads as a 
		INNER JOIN categories as c ON a.cat1=c.catId 
		LEFT JOIN categories as c2 ON a.cat2=c2.catId 
		JOIN users as u ON a.userId=u.id 
		WHERE a.active=1
		GROUP BY a.userId */
		$sql = "SELECT a.id, a.userId, a.cat1, a.cat2, a.area, a.area0, a.area1, a.area2, a.area3, a.isCompany, a.title, a.mainImg, a.img, a.price, a.startDate, a.stars, a.numClicks, a.numComments, u.name, u.userSinceDate, u.totAds, u.totActAds, c.name as cat1Name, c2.name as cat2Name FROM ads as a INNER JOIN categories as c ON a.cat1=c.catId LEFT JOIN categories as c2 ON a.cat2=c2.catId JOIN users as u ON a.userId=u.id WHERE a.active=1 GROUP BY a.userId";

		
		/* uusin jossa org info -  ei tarvita tässä! 
		$sql = "SELECT a.id, a.cat1, a.cat2, a.area, a.area0, a.area1, a.area2, a.area3, a.isCompany, a.title, a.mainImg, a.img, a.price, a.startDate, a.stars, a.numClicks, a.numComments, u.name, u.userSinceDate, u.totAds, u.totActAds, o.aboutOrganisation as orgInfo, o.logo, c.name as cat1Name, c2.name as cat2Name FROM ads as a INNER JOIN categories as c ON a.cat1=c.id LEFT JOIN categories as c2 ON a.cat2=c2.id JOIN users as u ON a.userId=u.id JOIN orginfo as o ON u.safeId=o.userSafeId 
			WHERE a.active=1"; */
		

	/*
	} else {
		// cat1 is selected - no need to get it from DB
		if($cat2 == '') {
			// cat2 is not selected - get it from DB
			$sql = "SELECT a.id, a.cat1, a.cat2, a.area, a.area0, a.area1, a.area2, a.area3, a.isCompany, a.title, a.mainImg, a.img, a.price, a.startDate, a.stars, a.numClicks, a.numComments, c.name FROM ads as a INNER JOIN categories as c ON a.cat2=c.id WHERE a.active=1";
		} else {
			// all are in same category 1 - don't return cat1 name
			$sql = "SELECT a.id, a.cat1, a.cat2, a.area, a.area0, a.area1, a.area2, a.area3, a.isCompany, a.title, a.mainImg, a.img, a.price, a.startDate, a.stars, a.numClicks, a.numComments FROM ads as a WHERE a.active=1";
		}
	}
	*/

	// uudempi - ei koeiltu
	/*
	if($cat1 != '') {
		// return with cat2 name (when cat1 is selected)
		$sql = 'SELECT a.id, a.cat1, a.cat2, a.area, a.area0, a.area1, a.area2, a.area3, a.isCompany, a.title, a.mainImg, a.price, a.startDate, a.numComments, c.name AS "catName" FROM ads as a INNER JOIN categories as c ON a.cat2=c.id WHERE a.active=1';  
	} else {
	  	// return with cat1 name (when no cat1 is selected)
		$sql = 'SELECT a.id, a.cat1, a.cat2, a.area, a.area0, a.area1, a.area2, a.area3, a.isCompany, a.title, a.mainImg, a.price, a.startDate, a.numComments, c.name AS "catName" FROM ads as a INNER JOIN categories as c ON a.cat1=c.id WHERE a.active=1'; 
	}
	*/
	// $sql .= " WHERE active=1";
	$sql .= " AND countryGeoId=" . $countryGeoId;

	// $sql .= " ORDER BY $prefix" . "startDate DESC";

	//echo '<br>SQL:   ' . $sql . '   <br> ';

	//// TEMP
	//$prefix = '';
	//$sql = "SELECT id,cat1,cat2,area2,isCompany,title,mainImg,price,startDate
	//			FROM ads";
	//$sql .= " WHERE active=1";

	// if ($countryId != '') { 				$sql .= " AND $prefix" . "countryId=$countryId"; }
	// if ($langId != '') { 					$sql .= " AND $prefix" . "langId=$langId"; }

	// working?
	//if ($area  != '') { $sql .= " AND $prefix" . "area=$area"; } //  &&  $area != '-1'
	//if ($area0 != '') { $sql .= " AND $prefix" . "area0=$area0"; } //  && $area0 != '-1'
	//if ($area1 != '') { $sql .= " AND $prefix" . "area1=$area1"; } //  && $area1 != '-1'
	//if ($area2 != '') { $sql .= " AND $prefix" . "area2=$area2"; } //  && $area2 != '-1'

	// test
	if ($area3 != '') { $sql .= " AND $prefix" . "area3=$area3"; } else {
		if ($area2 != '') { $sql .= " AND $prefix" . "area2=$area2"; } else {
			if ($area1 != '') { $sql .= " AND $prefix" . "area1=$area1"; } else {
				if ($area1 != '') { $sql .= " AND $prefix" . "area1=$area1"; } else {
					if ($area0 != '') { $sql .= " AND $prefix" . "area0=$area0"; }
				}
			}
		}
	}

	// ==============================================================================================
	// if ($cat1 != '' && $cat1 != '-1') 	  { $sql .= " AND $prefix" . "cat1=$cat1"; } // undefined - fixed
	// ==============================================================================================

	/* TESTING:
	Tested by changin value in DB:
	countryId
	adType
	time startDate price
	active

	*/

} // END else

// USE IN PRODUCTION SITE!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
$catName = '';
// if cat2 is selected then cat1 is not sent in AJAX query attributes
if ($cat1 != '' && $cat1 != '-1') 	  { $sql .= " AND $prefix" . "cat1=$cat1"; }
if ($cat2 != '') 					  { $sql .= " AND $prefix" . "cat2=$cat2"; }


//if ($adType != '' && $adType != '-1') { $sql .= " AND $prefix" . "adType=$adType"; }
if ($adType != '') 					  { $sql .= " AND $prefix" . "adType=$adType"; } else 
									  { $sql .= " AND $prefix" . "adType=0"; }
if ($advertiserType != '') { 
	 if($advertiserType == 'private') { $sql .= " AND $prefix" . "isCompany=0"; } else
		   							  { $sql .= " AND $prefix" . "isCompany=1"; }
}

//$sql .= " AND $prefix" . "title LIKE '%" . $searchText . "%'"; //
if (strlen($searchText) > 2) { 			$sql .= " AND $prefix" . "title LIKE '%" . $searchText . "%'"; } // searches only from titles  KE '%tuoli%"  KE '%a';





if($sortBy == 'time')  	  			  { $sql .= " ORDER BY $prefix" . "startDate DESC"; } else
		   							  { $sql .= " ORDER BY $prefix" . "price ASC"; }



// JOIN area2,3,4 -> tulee geoname saitista!
/*
Lägenheter, Liljeholmen

toimii:
SELECT b.id,b.cat1,b.cat2,b.area2,b.isCompany,b.title,b.mainImg,b.price,b.startDate, categories.name 
FROM ads as b 
INNER JOIN categories ON b.cat1=categories.id
WHERE b.active=1 AND b.adType=0 AND b.isCompany=1 AND categories.langId=1


MALLI:
SELECT Orders.OrderID, Customers.CustomerName, Orders.OrderDate
FROM Orders
INNER JOIN Customers ON Orders.CustomerID=Customers.CustomerID;
*/
$result = mysqli_query($conn, $sql);
//echo '<br>getListing SQL: ' . $sql;
//if ($result === false) { echo 'NOTHING FOUND'; exit;  }
if ($result === false) { return null; exit;  } /* NEW */


$totalItems = mysqli_num_rows(mysqli_query($conn, $sql)); // pagination
$totalPages = $totalItems/$limit; // pagination
// echo '<br>totalItems: ' . $totalItems; 
// echo '<br>totalPages: ' . $totalPages; 

// TEMP POIS PÄÄLTÄ ====================================!!!!!!!!!!!!!!!!!!!!!!!!!!!
$sql .= " LIMIT " . $start . ", " . $limit;

//echo '<br>sql: ' . $sql; 
$result = mysqli_query($conn, $sql); 

if (mysqli_num_rows($result) > 0) 
{ 
	$tempCounter = 1;
	$arr = array();
	//echo '<br>Found ' . mysqli_num_rows($result) . ' items.<br>'; 
if($totalPages > 1) { $paginationData .= showPagination($thisPage, '', '', '', '', $totalPages, $start, $page, $limit); } // pagination

// TEST:
//$paginationData .= showPagination($thisPage, '', '', '', '', 12, 1, $page, $limit);


	//while($row = mysqli_fetch_assoc($result)) 
	//{ 
		//$totNumberOfItems++;
		/*
	echo '<table>';
		echo '<tr><td>userId</td><td>' . $row["userId"] . '</td></tr>';
		echo '<tr><td>countryId</td><td>' . $row["countryId"] . '</td></tr>';
		echo '<tr><td>langId</td><td>' . $row["langId"] . '</td></tr>';
		echo '<tr><td>cat1</td><td>' . $row["cat1"] . '</td></tr>';
		echo '<tr><td>cat2</td><td>' . $row["cat2"] . '</td></tr>';
		echo '<tr><td>title</td><td>' . $row["title"] . '</td></tr>';
		echo '<tr><td>img</td><td>' . $row["img"] . '</td></tr>';
		echo '<tr><td>texts</td><td>' . $row["texts"] . '</td></tr>';
		echo '<tr><td>price</td><td>' . $row["price"] . '</td></tr>';
		echo '<tr><td>createdDate</td><td>' . $row["createdDate"] . '</td></tr>';
		echo '<tr><td>startDate</td><td>' . $row["startDate"] . '</td></tr>';
		echo '<tr><td>endDate</td><td>' . $row["endDate"] . '</td></tr>';
		echo '<tr><td>isEnhanced</td><td>' . $row["isEnhanced"] . '</td></tr>';
		echo '<tr><td>active</td><td>' . $row["active"] . '</td></tr>';
	echo '</table>';
	*/



		// $userId = $row["userId"]     ;
		// $countryId = $row["countryId"]  ;
		// $langId = $row["langId"]     ;
	//	$id = $row["id"];
	//	$cat1 = $row["cat1"];
	//	$cat2 = $row["cat2"];
//
	//	//$area1 = $row["area1"]       ;
	//	$area2 = $row["area2"]       ;
//
	////	$isCompany = $row["isCompany"];  if($isCompany == '1') { $isCompany = '<span class="highlight">butik</span>'; } else { $isCompany =''; }
	//	//$adType = $row["adType"];
//
	//	$title = $row["title"];
//
	//	$img = $row["mainImg"]; 
	//	if($img =="") { 
	//		$img = '<span class="noImageIcon"></span>'; 
	//	} else { 
	//		////$img = '<img src="adImgs/' . $img . '">'; 
	//		//$img = '<img src="https://picsum.photos/186/143/?image=' . rand(1,300) . '">';
	//		$img = 'https://picsum.photos/186/143/?image=' . rand(1,300);
	//	}
	//	$img = rand(1,300); // temp
//
	//	//$texts = $row["texts"]      ;
	//	
	//	$price = $row["price"]      ;
	//	//$createdDate = 	displayDbDate($row["createdDate"]);
	//	
	//	//$endDate = 		displayDbDate($row["endDate"]);
	//	$isEnhanced = '';
	//	$active = '';


		


/*
$itemData = <<<EOT
			<a href="#">
			  <div id="$id" class="item">
				<div class="imgPanel">
					$img
				</div>
				<div class="textPanel">
					$isCompany
					<span class="text"><a>cat:$cat1</a>, <a class="location"><b>$placeName</b></a></span>
					<span class="time">$startDate</span>
					<span class="title">
						$tempCounter. $title
					</span>
					<div class="price">$price kr</div>
				</div>
			  </div>
			</a>
EOT;
*/
		// echo $itemData; //  mainImg,isCompany,cat1,cat2,area2,title,price,startDate 
		 		 //  id,cat1,cat2,area2,isCompany,title,mainImg,price,startDate
		// echo $itemData;
//		$tableData .= $itemData;

		/*
		array_push($arr, array(
			"id"  		 => $row["id"],
			"img"  		 => $img,
			"isCompany"  => $row["isCompany"],
			"cat1"  	 => $row["cat1"],
			"placeName"  => $placeName,
			"startDate"  => $startDate,
			"adTitle"    => $row["title"],
			"price"  	 => $row["price"]
			));
		*/

		//if($isCompany] == null) {
		//	// isCompany is null
		//} else 

			// cat == -1 --> bring cat names
	while($row = mysqli_fetch_assoc($result)) 
	{	 
		$catName = $placeName = '';
		/* NEW */
		// $img = rand(1,300); // oikeasti $row["mainImg"],
		//$placeName = "Dummy place"; // getGeoPlaceName($row["area2"]); // '2696270');   ------------------------------------ DO THIS IN JS!!!!

		/* for testing
	 	     if($area3 != '') { $placeName = '3:' . getGeoPlaceName($area3); }
	 	else if($area2 != '') { $placeName = '2:' . getGeoPlaceName($area2); }
	 	else if($area1 != '') { $placeName = '1:' . getGeoPlaceName($area1); }
	 	else if($area0 != '') { $placeName = '0:' . getGeoPlaceName($area1) . ', ' . getGeoPlaceName($area0); }
		*/
	 	/*
	 	     if($area3 != '') { $placeName = getGeoPlaceName($area3); }
	 	else if($area2 != '') { $placeName .= ', ' . getGeoPlaceName($area2) . '(2)'; }
	 	else if($area1 != '') { $placeName .= ', ' . getGeoPlaceName($area1) . '(1)'; }
	 	else if($area0 != '') { $placeName .= ', ' . getGeoPlaceName($area0) . '(0)'; }
		*/

/* xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx */
/* xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx */
/* xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx */
/* xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx */
/* xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx */
// THIS CAUSES EXECUTION TIME O BE OVER 30 SECS!!!!!
	 	// no need to show area if area selected in search panel
	// 	if($area0 == '') { $placeName .= getGeoPlaceName($row["area0"]) . ' - '; } 
	// 	if($area1 == '') { $placeName .= getGeoPlaceName($row["area1"]) . ' '; }
	// 	if($area2 == '') { $placeName .= getGeoPlaceName($row["area2"]) . ' '; }
	// 	if($area3 == '') { $placeName .= getGeoPlaceName($row["area3"]); }

	 	// ------------------------------------ DO THIS IN JS!!!!

/* xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx */
/* xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx */
/* xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx */
/* xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx */
	 	//$catName = 'test';
	//  	if ($cat1 != '' && $cat1 != '-1') 	  { $catName = getCatName($cat1,$conn); 
	// 	if ($cat2 != '' && $cat2 != '-1') 	  { $catName .= ', ' . getCatName($cat2,$conn); 


//	if($area == '-1') {
//		$placeName = getGeoPlaceName($row["area0"]) . ' ' . getGeoPlaceName($row["area1"]);
//	} else if ($area0 == '-1') {
//		$placeName = getGeoPlaceName($row["area1"]);
//	} else {
//		$placeName = 'get in JS';
//	}
		

		//$startDate = displayDbDate($row["startDate"]);
//$img = $row["id"] . '_' . $row["mainImg"]; 
		//$row["cat1name"] = ""; // REMOPVE!!!!!!!!!!!!!
		// if(!isset($row["cat1name"]) { $row["cat1name"] = '';}





// IS THIS NEEDED? was in use
	//	if($row["area2"] == '0') { $row["area2"] = $row["area1"];}




		// TODO
		// if $tableStyle = cards - return only the needed fields
	 	$catName = ucfirst(strtolower($row["cat1Name"]));
	 	if($row["cat2Name"] != '') { $catName .= ' - ' . $row["cat2Name"]; }
	 	if($row["numClicks"] == '') { $row["numClicks"] = '0'; }
	 	if($row["stars"] == '') { $row["stars"] = '0'; }
	 	if($row["isCompany"] == '0') { $row["name"] = ''; }

		//if($cat1 == '') {
			//$arr[] = $row;
			// cat1 has value - UUSIN
			array_push($arr, array(
			"id"  		  	 => $row["id"],
			"mainImg" 	  	 => $row["mainImg"],
			"img"  		  	 => $row["img"],
			"isCompany"   	 => $row["isCompany"],
			"cat1" 		  	 => $row["cat1"],
			"cat2"  	  	 => $row["cat1"],
			"catName"  	  	 => $catName,
			"placeName"   	 => $placeName,
			"name"			 => $row["name"],
			"startDate"   	 => $row["startDate"],
			"adTitle"     	 => $row["title"],
			"price"  	  	 => $row["price"],
			"stars"  	  	 => round($row["stars"]), 
			"numClicks"   	 => $row["numClicks"],
			"numComments" 	 => $row["numComments"],
			"userSinceDate"  => $row["userSinceDate"],
			"totActAds"		 => $row["totActAds"]
			)); // totAds(not in use uet) - new added users name


			// put back: 	"adTitle"    => $row["title"],
		//} else {
		//	$arr[] = $row;
		//	// all have same cat1 - do not return cat1 name, get it in client
		//	array_push($arr, array(
		//	"id"  		  => $row["id"],
		//	"img"  		  => $img,
		//	"isCompany"   => $row["isCompany"],
		//	"cat2"  	  => $row["cat2"],
		//	"placeName"   => $row["area2"],
		//	"startDate"   => $startDate,
		//	"adTitle"     => $row["title"],
		//	"price"  	  => $row["price"],
		//  "numComments" => $row["numComments"]
		//	));// put back: 	"adTitle"    => $row["title"],
		//}


		// molemmille sama
/*
		array_push($arr, array(
			"id"  		  => $row["id"],
			"img"  		  => $img,
			"isCompany"   => $row["isCompany"],
			"cat1" 		  => $row["cat1"],  
			"cat2"  	  => $row["cat2"],
			"placeName"   => $placeName,
			"startDate"   => $startDate,
			"adTitle"     => $row["title"],
			"price"  	  => $row["price"],
			"numComments" => $row["numComments"]
			)); 	
*/


		$tempCounter++; 
		//echo '<br>FOUND: ' . $tempCounter .  ' ' . $title;
	}  // while
	// echo '<link rel="stylesheet" type="text/css" href="pagination.css">';
} else {  $arr =''; } // no data was found


//echo '<br>totalPages:' . ceil($totalPages);
//echo '<br>totalItems:' . $totalItems;
//echo '<br>paginationData:' . $paginationData;
//$result  = array();
//$result['totNumberOfItems'] = 'totNumberOfItems'; // $totalItems; 
//$result['tableData'] = $arr;
//$result['paginationData'] = 'paginationData'; //$paginationData;

//$result=array("Volvo","BMW","Toyota");
////return json_encode(array($result));

// $ads = array( );
// $ads["car1"] = "Volvo";
// $ads["car2"] = "BMW";
// $ads["car3"] = "Toyota";
// if(count($arr) == 0) { $arr =''; }


//echo implode(',', $arr);


$response =array( );
$response["data"] = $arr;
$response["page"] =	$page;
$response["totalPages"] = ceil($totalPages);
$response["totalItems"] = $totalItems;
$response["sql"] = $sql;  //  --------------------------- debugging
echo json_encode($response); 


//return json_encode(array($result));

// return json_encode($result);

//echo $tableData; /* TOIMII */
// echo implode('', $arr);
// return json_encode($arr); /* NEW */
//sleep(5);

/* =======works====== */
//echo json_encode($arr);  
/* ================== */

// echo '<input id="totalItems" type="hidden" value="' . $totalItems . '">';



// return $result;
//echo json_encode($tableData); 




/* geonames test - move to ajax get listing
6295630 Earth, 6255148 Eurooppa, 2661886 Ruotsi, 2673722 Stockholm, 2696270 Liljeholmsviken
echo 'GEO test: ' . getGeoPlaceName('2696270') . '<br>'; */
// test url http://api.geonames.org/getJSON?geonameId=2673722&username=adssite8578578&lang=fi
function getGeoPlaceName($geonameId, $langId='fi') {
    $url = 'secure.geonames.org/getJSON?geonameId=' . $geonameId . '&username=adssite8578578&lang=' . $langId;
    $string = file_get_contents($url);
    $jsonIterator = new RecursiveIteratorIterator(
      new RecursiveArrayIterator(json_decode($string, TRUE)),
      RecursiveIteratorIterator::SELF_FIRST);
    foreach ($jsonIterator as $key => $val) {
    	foreach ($jsonIterator as $key2 => $val2) {
    		// $result .=  $key2 . '=' . $val2 . '<br>'; // $result .=  join($val, ', ');
    		if($key2 == 'toponymName') { return $val2; }
    	}
    }
  }

function getCatName($catId,$conn) { // TODO add lang id!!!!
  $sql = "SELECT name FROM categories WHERE catId=$catId LIMIT 1";
  echo '<br>SQL: ' . $sql;
  $result = mysqli_query($conn, $sql); 
  if (mysqli_num_rows($result) > 0) 
  {
    while($row = mysqli_fetch_assoc($result)) { return $row["name"]; }
  }
}


?> 
