<?php 
include_once('functions.php'); 
$conn = getDBConn('','noWelcomeText');
$thisPage = "index.php";

// INIT
$userId = $countryGeoId = $langId = $cat1 = $cat2 = $area = $area0 = $area1 = $area2 = $area3 = $isCompany = $adType = $title = $mainImg = $img = $texts = $price = $createdDate = $startDate = $endDate = $isEnhanced = $adPassword = $numComments = $active = "";

$isCompany = $searchText = $mainCat = $advertiserType = $sortBy = $tableStyle = '';

// cars


// code 
$searchCriteria = $sqlExtra = ''; 

if (isset($_GET["countryGeoId"])) { $countryGeoId = filter_input( INPUT_GET, "countryGeoId", FILTER_SANITIZE_URL ); }
if (isset($_GET["area"])) { $area = filter_input( INPUT_GET, "area", FILTER_SANITIZE_URL ); }
if (isset($_GET["area0"])) { $area0 = filter_input( INPUT_GET, "area0", FILTER_SANITIZE_URL ); }
if (isset($_GET["area1"])) { $area1 = filter_input( INPUT_GET, "area1", FILTER_SANITIZE_URL ); }
if (isset($_GET["area2"])) { $area2 = filter_input( INPUT_GET, "area2", FILTER_SANITIZE_URL ); }
if (isset($_GET["area3"])) { $area3 = filter_input( INPUT_GET, "area3", FILTER_SANITIZE_URL ); }

/* uusin */
if (isset($_GET["searchText"])) { $searchText = filter_input( INPUT_GET, "searchText", FILTER_SANITIZE_URL ); }
if (isset($_GET["cat1"])) { $cat1 = filter_input( INPUT_GET, "cat1", FILTER_SANITIZE_URL ); }

if (isset($_GET["adType"])) { $adType = filter_input( INPUT_GET, "adType", FILTER_SANITIZE_URL ); }
if (isset($_GET["advertiserType"])) { $advertiserType = filter_input( INPUT_GET, "advertiserType", FILTER_SANITIZE_URL ); }
if (isset($_GET["sortBy"])) { $sortBy = filter_input( INPUT_GET, "sortBy", FILTER_SANITIZE_URL ); } else { $sortBy = 'time'; } // default 1 //// time,price
//if (isset($_GET["tableStyle"])) { $tableStyle = filter_input( INPUT_GET, "tableStyle", FILTER_SANITIZE_URL ); } 
if (isset($_GET['page'])) { $page = filter_input( INPUT_GET, 'page', FILTER_SANITIZE_URL ); } else { $page = 1; } // default 1



//$sql .= " AND $prefix" . "area1=$area1";
/*
DB:
vehicleMainType
isNew
make
model

year
driven
hp
fuel
gear
leasing
vehicleType
drive
color


DB:
vehicleMainType	tinyint(3)
isNew	tinyint(3)
make	int(11)	
model	tinyint(3)
year	int(11)	
driven	int(11)	
hp	int(11)
fuel	tinyint(3)
gear	tinyint(3)
leasing	tinyint(3)
vehicleType	tinyint(3)
drive	tinyint(3)
color	tinyint(3)


URL
priceS = priceE= modelS = modelE= drivenS = drivenE = hpS = hpE= fuel = gear = leasing = carType = drive = colors
'&modelS='+modelS : '');
'&modelE='+modelE : '');
'&drivenS='+drivenS : '');
'&drivenE='+drivenE : '');
'&hpS='+hpS  : '');
'&hpE='+hpE : '');
'&fuel='+fuel : '');
'&gear='+gear : '');
'&leasing='+leasing : '');
'&carType='+carType : '');
'&drive='+drive : '');
'&colors='+colors : '');
*/
// ==========================================================
// --------- SQL query --------- 
$tableData = '';
$paginationData = '';

// pagination
$limit = 10; // number of items per page
$start=($page-1)*$limit;

$fields = 'id,cat1,cat2,area,area0,area1,area2,area3,isCompany,title,mainImg,price,startDate';
$prefix = $cat1 == "" ? "" : "a.";

// use in PRODUCTION !!!!!!
// if($countryGeoId == null) { return null; exit; } // exit if no country

/* toimiva LAST */
if($cat1 == '') {
	// all are in same category - do not return cat1 name, get it in client -------------------------------TEMP *!!!
	// $sql = "SELECT id,cat1,cat2,area,area0,area1,area2,area3,isCompany,title,mainImg,price,startDate,numComments
	$sql = "SELECT * FROM ads WHERE active=1"; //    
} else {
  	// with cat1 names - return cat1 name   -- ads cat1= categories id
	$sql = "SELECT a.id, a.cat1, a.cat2, a.area, a.area0, a.area1, a.area2, a.area3, a.isCompany, a.title, a.mainImg, a.price, a.startDate, a.numComments, c.name FROM ads as a INNER JOIN categories as c ON a.cat1=c.id WHERE a.active=1"; 
}


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

// ======================== cars ============================
// cars
// $sql .= " INNER JOIN vehicleextradata as v ON a.id=v.adId WHERE v.vehicleMainType>-1";
$sql = "SELECT * FROM vehicleextradata WHERE vehicleMainType<10"; //

if (isset($_GET["isNew"])) { $sql .= " AND $prefix" . "isNew=" . filter_input( INPUT_GET, "isNew", FILTER_SANITIZE_URL ); } 

if (isset($_GET["priceS"])) { $sql .= " AND $prefix" . "price>=" . filter_input( INPUT_GET, "priceS", FILTER_SANITIZE_URL ); }
if (isset($_GET["priceE"])) { $sql .= " AND $prefix" . "price<=" . filter_input( INPUT_GET, "priceE", FILTER_SANITIZE_URL ); }

if (isset($_GET["drivenS"])) { $sql .= " AND $prefix" . "driven>=" . filter_input( INPUT_GET, "drivenS", FILTER_SANITIZE_URL ); }
if (isset($_GET["drivenE"])) { $sql .= " AND $prefix" . "driven<=" . filter_input( INPUT_GET, "drivenE", FILTER_SANITIZE_URL ); }

if (isset($_GET["hpS"])) { $sql .= " AND $prefix" . "hp>=" . filter_input( INPUT_GET, "hpS", FILTER_SANITIZE_URL ); }
if (isset($_GET["hpE"])) { $sql .= " AND $prefix" . "hp<=" . filter_input( INPUT_GET, "hpE", FILTER_SANITIZE_URL ); }

if (isset($_GET["fuel"])) { 	$sql .= " AND $prefix" . "fuel=" . filter_input( INPUT_GET, "fuel", FILTER_SANITIZE_URL ); }
if (isset($_GET["gear"])) { 	$sql .= " AND $prefix" . "gear=" . filter_input( INPUT_GET, "gear", FILTER_SANITIZE_URL ); }
if (isset($_GET["leasing"])) { 	$sql .= " AND $prefix" . "leasing=" . filter_input( INPUT_GET, "leasing", FILTER_SANITIZE_URL ); }
if (isset($_GET["carType"])) { 	$sql .= " AND $prefix" . "vehicle=" . filter_input( INPUT_GET, "carType", FILTER_SANITIZE_URL ); }
if (isset($_GET["drive"])) { 	$sql .= " AND $prefix" . "drive=" . filter_input( INPUT_GET, "drive", FILTER_SANITIZE_URL ); }
echo '<br>FROM AJAX..._car.js: ' . $sql . '<br>';
/*
if (isset($_GET["colors"])) { 	$color = filter_input( INPUT_GET, "colors", FILTER_SANITIZE_URL ); }
$colorsArr = explode(';', $color);
$colorSql = "color=";
for($i = 0; $i < count($colorsArr); $i++) { // (prod_name = 'WildTech 250Gb 1700' OR prod_name = 'Moto Razr') 
	if($i>0) { $colorSql .= " OR "; }
	$colorSql .= $colorsArr[$i];
}
// if(count($colorsArr)>1) { $sql .= " AND ($prefix" . $colorSql . ")"; } else { $sql .= " AND $prefix" . $colorSql; }
if(count($colorsArr)>1) { $colorSql = " AND ($prefix" . $colorSql . ")"; } else { $colorSql = " AND $prefix" . $colorSql; }
echo "<br>colorSql: $colorSql";
*/
// ======================== END cars ============================

/*
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
if ($result === false) { return null; exit;  } /* NEW */


$totalItems = mysqli_num_rows(mysqli_query($conn, $sql)); // pagination
$totalPages = $totalItems/$limit; // pagination

// TEMP POIS PÄÄLTÄ ====================================!!!!!!!!!!!!!!!!!!!!!!!!!!!
//$sql .= " LIMIT " . $start . ", " . $limit;

$result = mysqli_query($conn, $sql); 
if (mysqli_num_rows($result) > 0) 
{ 
	$tempCounter = 1;
	$arr = array();
if($totalPages > 1) { $paginationData .= showPagination($thisPage, '', '', '', '', $totalPages, $start, $page, $limit); } // pagination


			// cat == -1 --> bring cat names
	while($row = mysqli_fetch_assoc($result)) 
	{
			array_push($arr, array(
			"id"  		  => $row["id"]
			)); // car test
			// working:
			// array_push($arr, array(
			// "id"  		  => $row["id"],
			// "img"  		  => $row["mainImg"],
			// "isCompany"   => $row["isCompany"],
			// "cat1" 		  => $row["cat1"],
			// "cat2"  	  => $row["cat2"],
			// "placeName"   => $row["area2"],
			// "startDate"   => $row["startDate"],
			// "adTitle"     => $row["title"],
			// "price"  	  => $row["price"],
			// "numComments" => $row["numComments"]
			// ));
		$tempCounter++; 
	}  // while
} else {  $arr =''; } // no data was found

echo $sql;
//echo implode(' ', $arr);
/*
$response =array( );
$response["data"] = $arr;
$response["page"] =	$page;
$response["totalPages"] = ceil($totalPages);
$response["totalItems"] = $totalItems;
$response["sql"] = $sql;  //  --------------------------- debugging
echo json_encode($response); 
*/
?> 
