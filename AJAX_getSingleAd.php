<?php 
include_once('functions.php'); 
$conn = getDBConn('','noWelcomeText');

$id = $cat1 = $isCompany = '';
$arr = array();
if (isset($_GET["id"])) { $id = filter_input( INPUT_GET, "id", FILTER_SANITIZE_URL ); }
if (isset($_GET["cat1"])) { $cat1 = filter_input( INPUT_GET, "cat1", FILTER_SANITIZE_URL ); }
if (isset($_GET["isC"])) { $isCompany = filter_input( INPUT_GET, "isC", FILTER_SANITIZE_URL ); }

if (is_numeric($id)) {
	switch($cat1) {
		case '4':   // car
			$sql = "SELECT a.id,a.cat1,a.adLatLng,a.title,a.mainImg,a.img,a.texts,a.price,a.startDate,a.numComments,c.name AS cat1Name,u.name,u.phone,u.safeId,u.totActAds,e.model,e.year,e.driven,e.hp,e.fuel,e.gear,e.leasing,e.vehicleType,e.regNum
			FROM ads as a 
			INNER JOIN categories as c ON a.cat1=c.catId 
			INNER JOIN users as u ON a.userId=u.id
			INNER JOIN vehicleextradata as e ON a.id=e.adId 
			WHERE a.id=$id and a.active=1 LIMIT 1";
			break;
		case '75':  // boat  e.manufacturer,e.year,e.length,e.hp
			$sql = "SELECT a.id,a.cat1,a.adLatLng,a.title,a.mainImg,a.img,a.texts,a.price,a.startDate,a.numComments,c.name AS cat1Name,u.name,u.phone,u.safeId,u.totActAds,e.year,e.length,e.hp,m.manufacturer
			FROM ads as a 
			INNER JOIN categories as c ON a.cat1=c.catId 
			INNER JOIN users as u ON a.userId=u.id
			INNER JOIN vehicleextradata as e ON a.id=e.adId 
			INNER JOIN boatmanufacturers as m ON e.manufacturer=m.id 
			WHERE a.id=$id and a.active=1 LIMIT 1";
			//echo '<br>boat sql: ' . $sql;
			break;
		//case '89':  // caravan
		//case '93':  // moped
		//case '97':  // motorcycle
		////case '115': // machines
		////case '150': // clothes
		////case '167': // childrensClothing
		////case '278': // real estate              id:8 cat1:3150 isCompany:0

	default: 
		if($isCompany != '1') { // || $isCompany == '0') {
			$sql = "SELECT a.id,a.cat1,a.adLatLng,a.title,a.mainImg,a.img,a.texts,a.price,a.startDate,a.numComments,c.name AS cat1Name,u.name,u.phone,u.safeId,u.totActAds 
			FROM ads as a 
			INNER JOIN categories as c ON a.cat1=c.catId 
			INNER JOIN users as u ON a.userId=u.id  
			WHERE a.id=$id and a.active=1 LIMIT 1"; 

		} else {
			// with org info (if isCompany == '1') 
			$sql = "SELECT a.id,a.cat1,a.adLatLng,a.title,a.mainImg,a.img,a.texts,a.price,a.startDate,a.numComments,c.name AS cat1Name,u.name,u.phone,u.safeId,u.totActAds,o.logo,o.aboutOrganisation as orgInfo 
			FROM ads as a 
			INNER JOIN categories as c ON a.cat1=c.catId 
			INNER JOIN users as u ON a.userId=u.id 
			LEFT JOIN orginfo as o ON u.safeId=o.userSafeId 
			WHERE a.id=$id and a.active=1 LIMIT 1";
		}
		
			//echo '<br>sql: ' . $sql;
			break;
	}

	$result = mysqli_query($conn, $sql); 
	if (mysqli_num_rows($result) > 0) 
	{ 
		while($row = mysqli_fetch_assoc($result)) { $arr[] = $row; }
	} 
	echo json_encode($arr, JSON_NUMERIC_CHECK);
}
?> 
