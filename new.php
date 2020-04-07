<?php
session_start();
$thisPage = 'new.php';
include_once('functions.php');
include_once('header.php');
$conn = getDBConn();
$todaysDate = getCurrentDateAsYYMMDDHHMM();


/* DB NOTE: email, password fields must be varchar(100) in DB!! */


/*
TODO BEFORE PRODUCTION
To prevent leaking your password, here's what your php.ini file should look like in production: do both display_errors = Off and log_errors = On. 
*/
/* =================================== init page ======================================= */
// include_once('functions/php/init.php');
$last_user_id = '';

// ------------- define fields ------------- 
// users db table
$userFields = "safeId,countryId,langId,isCompany,name,areaId,areaId0,address,address2,img,email,password,phone,userSinceDate,active";
// ads db table
//$adFields = "userId,countryId,langId,cat1,cat2,area1,area2,isCompany,adType,title,mainImg,img,texts,price,createdDate,startDate,endDate,isEnhanced,active";             
$adFields = "userId,adCode,countryGeoId,langId,cat1,cat2,area,area0,area1,area2,area3,adLatLng,isCompany,adType,title,mainImg,img,texts,price,createdDate,startDate,endDate,isEnhanced,adPassword,adPrice,numComments,active";
// 
// orgInfo  db table  - orgNumber VARCHAR(25),aboutOrganisation VARCHAR(255),logo CHAR(13));
$orgInfoFields = "userSafeId,orgNumber,aboutOrganisation,logo";

// form fields
$formFields = "isCompany,name,orgNumber,email,emailAgain,phone,hidePhoneNumber,country,area,area0,area1,area2,area3,adLatLng,postalCode,cat1,cat2,adType,title,texts,price,aboutOrganisation,logo,img,adPassword,acceptTerms,adLatLng,timeZone,usersGeoLocation,eId,tempAdPrice,cat2NumOfOptions";

			
//$extraFields = 'year,driven,carType,hpEnd,gear,fuel'; // car
$extraFields = 'countryGeoId,adId,vehicleMainType,isNew,make,model,year,driven,hp,fuel,gear,leasing,vehicleType,drive,color,class,motorMake,length,width,depth,weight,material,propulsion,isSharing,mooringAvailable,locationCountry,locationArea,locationArea0,locationArea1,locationArea2,locationArea3,portName,persons,manufacturer,regNum,machineryHours,accessory,gender'; // vehicles

// logged in user
$disp_name = $disp_email = $disp_emailAgain = $disp_phone = $disp_postalCode = $disp_price = $disp_adPassword = $disp_orgNumber = $disp_aboutOrganisation = $disp_logo = '';

// define variables
$allFields = $userFields . "," . $adFields . ",area,area0,area3," . $orgInfoFields . "," . $formFields;  
$allFieldsArr = explode(',', $allFields);
for($i = 0; $i < count($allFieldsArr); $i++) {
	$fieldName = $allFieldsArr[$i];
	$$fieldName = '';
}
// // form fields
// $fieldsArr = explode(',', $formFields);
// for($i = 0; $i < count($fieldsArr); $i++) {
// 	$fieldName = $fieldsArr[$i];
// 	$$fieldName = '';
// }

// validation
$allErrors = '';


/* ======================== logged in user ======================= */
if($loggedIn == '1' && isset($_SESSION['user'])) {
	// --------------- read user data ---------------
	$sessionArr = explode('#', $_SESSION['user']);
	$sql = "SELECT * FROM users WHERE safeId='$sessionArr[0]' LIMIT 1";
	$result = mysqli_query($conn, $sql);
	//if ($result === false) { echo "<br>Error, logged in user not found."; exit;  }
	if ($result === false) { echo "<br>Error, logged in user not found, sql:$sql"; exit;  } // REMOVE
	if (mysqli_num_rows($result) > 0)
	{
		while($row = mysqli_fetch_assoc($result))
		{
			$fieldsArr = explode(',', $userFields); // emailAgain
			for($i = 0; $i < count($fieldsArr); $i++) {
				$fieldName = $fieldsArr[$i];
				if(isset($row["$fieldName"])) { $$fieldName = $row["$fieldName"]; }
				if($fieldsArr[$i] == 'email') { $$fieldName = $emailAgain = simple_crypt($$fieldName,'d'); } // decrypt email sha256
			}
			//echo "<h1>isCompany:$isCompany</h1>";
			/*
			if($loggedIn == '1') {
				// populate user information in form
				
				$orgNumber
				$aboutOrganisation
				$logo
			}*/
		}
		// $userSafeId = $safeId;
	} else { echo "0 results a"; }
	// ------------ read organisation data ------------
	if($isCompany == '1') {
		$sql = "SELECT * FROM orgInfo WHERE userSafeId=$userSafeId LIMIT 1";
		$result = mysqli_query($conn, $sql);
		if (mysqli_num_rows($result) > 0)
		{
			while($row = mysqli_fetch_assoc($result))
			{
				$fieldsArr = explode(',', $orgInfoFields);
				for($i = 0; $i < count($fieldsArr); $i++) {
					$fieldName = $fieldsArr[$i];
					if(isset($row["$fieldName"])) { $$fieldName = $row["$fieldName"]; }
				}
			}
		}
	}
}
/* ======================== TEST DATA ============================ */

$name = 'Tauno Testaaja';
$email = $emailAgain = 'tauno@jossain.com';
$phone = '12345678';
$postalCode = '90210';
$title = 'Otsikko';
$price = '249.00';
$adPassword = 'Salasana1';
$texts = 'This is ad conetnt text';
$orgNumber = '98765432';
$aboutOrganisation = 'Desc about organisation here';
$acceptTerms = '1,';
// $logo = 'logo1.jpg';

/* =================================== EDIT AD ======================================= */
// include_once('functions/php/editAd.php');

// read adId from url
$selectedId = "";
if (isset($_GET['id']))
{
  $selectedId = filter_input( INPUT_GET, 'id', FILTER_SANITIZE_URL );
  if (!is_numeric($selectedId)) { echo "<br>No ad could be found."; exit; }
  //echo "<h1>id $selectedId</h1>";

  	// ---------------  read ad data ---------------
	$sql = "SELECT * FROM ads WHERE id=$selectedId LIMIT 1";
	$result = mysqli_query($conn, $sql);
	if ($result === false) { echo "<br>No ad found."; exit; }
	if (mysqli_num_rows($result) > 0)
	{
		while($row = mysqli_fetch_assoc($result))
		{
			$fieldsArr = explode(',', 'id,'.$adFields);
			for($i = 0; $i < count($fieldsArr); $i++) {
				$fieldName = $fieldsArr[$i];		
				echo "$fieldName: " . $row["$fieldName"] . "<br>";
				if(isset($row["$fieldName"])) { $$fieldName = $row["$fieldName"]; }
			}
		}
	}

	// --------------- read extra data ---------------
	$sql = "SELECT * FROM vehicleextradata WHERE adId=$id LIMIT 1";
	$result = mysqli_query($conn, $sql);
	$selIdsArr = [];
	$selValsArr = [];
	if (mysqli_num_rows($result) > 0)
	{
		while($row = mysqli_fetch_assoc($result))
		{
			$fieldsArr = explode(',', $extraFields);
			for($i = 0; $i < count($fieldsArr); $i++) {
				if(isset($row["$fieldsArr[$i]"])) {
					 $selIdsArr[] = $fieldsArr[$i]; 
					$selValsArr[] = $row["$fieldsArr[$i]"];
				}
			}
		}
		// put extra fields & values from DB into hidden vars for JS
		echo "<br>selIds:<input id='extraData_selIds' type='text' value='" . implode("#", $selIdsArr) . "'>"; 
		echo "<br>selVal:<input id='extraData_selVal' type='text' value='" . implode("#",$selValsArr) . "'>";
		$userSafeId = $safeId;
	}

	// --------------- read user data ---------------
	$sql = "SELECT * FROM users WHERE id=$userId LIMIT 1";
	$result = mysqli_query($conn, $sql);
	if ($result === false) { echo "<br>No user found."; exit;  }
	if (mysqli_num_rows($result) > 0)
	{
		while($row = mysqli_fetch_assoc($result))
		{
			$fieldsArr = explode(',', $userFields);
			for($i = 0; $i < count($fieldsArr); $i++) {
				$fieldName = $fieldsArr[$i];	
				if(isset($row["$fieldName"])) { $$fieldName = $row["$fieldName"]; }
				if($fieldsArr[$i] == 'email') { $$fieldName = simple_crypt($$fieldName,'d'); } // decrypt email sha256
			}
		}
		$userSafeId = $safeId;
	} else { echo "0 results b"; }
	echo "<br>";

	// --------------- read orgInfo data ---------------
	// orgInfo data   userSafeId,orgNumber,aboutOrganisation,logo
	if($isCompany == 1) {
		$sql = "SELECT * FROM orgInfo WHERE userSafeId=$userSafeId LIMIT 1";
		$result = mysqli_query($conn, $sql);
		if (mysqli_num_rows($result) > 0)
		{
			while($row = mysqli_fetch_assoc($result))
			{
				$fieldsArr = explode(',', $orgInfoFields);
				for($i = 0; $i < count($fieldsArr); $i++) {
					$fieldName = $fieldsArr[$i];		
					echo "$fieldName: " . $row["$fieldName"] . "<br>";
					if(isset($row["$fieldName"])) { $$fieldName = $row["$fieldName"]; }
				}
			}
		}
	}
}

/* =================================== POST  ======================================= */
// include_once('functions/php/getPostedFormValues.php');

if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST')
{
	echo '<h2>ALL POST: ' . var_dump($_POST) . '</h2><br><br>';

	// get posted values
	$selectedId = $_POST["selectedId"]; 
	$fieldsArr = explode(',', $formFields . "," . $extraFields . ",langId,regNum,portName");
	for($i = 0; $i < count($fieldsArr); $i++) {
		$fieldName = $fieldsArr[$i];
		// if($fieldsArr[$i] == 'accessory') { echo "<h1>accessory: ".$_POST["accessory"]."</h1>";}
		if(isset($_POST["$fieldName"])) {
			$$fieldName = test_input( replaceCommas( filter_var(trim($_POST["$fieldName"]), FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_ENCODE_HIGH) ));
			if($$fieldName == -1) { $$fieldName = NULL;} // { $$fieldName = 'NULL';} // no -1 in DB			
		} else { 
			//$$fieldName = ''; // a!"#¤%&/()=?``^*ö -- a!&#34;#&#194;&#164;%&/()=?``^*&#195;&#182;
			//$$fieldName = 'NULL'; // 0 worked  "''" worked
			$$fieldName = '';
		}
	}
	//if($isCompany == 'company') { $isCompany = '1'; } else { $isCompany = '0'; } /*new*/
	//echo "<h1>isCompany: $isCompany</h1>";
	//$portName = '';
	//$regNum = '';
// ============================================================================================================

	// save users area from usersGeoLocation            country,area,area0,area1,area2,area3
	//echo '<br>R4544 usersGeoLocation:'.$usersGeoLocation;
	$areasArr = explode(',', $usersGeoLocation); // continent,country,area,area0,area1,area2,area3
	$areaId = $areasArr[3]; // for user db table only
	$areaId0 = $areasArr[4]; // for user db table only
	//echo "<h3>usersGeoLocation: $usersGeoLocation</h3>"; // TODO add field into ads?
	//echo "<h3>areaId: $areaId</h3>";
	//echo "<h3>areaId0: $areaId0</h3>";
//adLatLng,timeZone,usersGeoLocation
/*
adLatLng
langId
timeZone
usersGeoLocation
*/

	//echo '<br>tempAdId2: ' . $tempAdId2;
	//echo '<br>savedTempImgFileNames2: ' . $savedTempImgFileNames2;
	// reference to uploaded images in filesystem

	// TEST IMG RENAMING
	//renameImgFiles($tempAdId2, '7', $imgUpload_savePath, $savedTempImgFileNames2);

// ----------------------
/*
echo "<h3>vehicle Extra Dat information</h3>";
       
echo "<table><tr><td><table>";
echo "<tr><td>countryGeoId: </td><td>" . $countryGeoId ."</td></tr>";
echo "<tr><td>adId: </td><td>" . $adId ."</td></tr>";
echo "<tr><td>vehicleMainType: </td><td>" . $vehicleMainType ."</td></tr>";
echo "<tr><td>isNew: </td><td>" . $isNew ."</td></tr>";
echo "<tr><td>make: </td><td>" . $make ."</td></tr>";
echo "<tr><td>model: </td><td>" . $model ."</td></tr>";
echo "<tr><td>year: </td><td>" . $year ."</td></tr>";
echo "<tr><td>driven: </td><td>" . $driven ."</td></tr>";
echo "<tr><td>hp: </td><td>" . $hp ."</td></tr>";
echo "<tr><td> </td><td> </td></tr>";

echo "</table></td><td><table>";

echo "<tr><td>fuel: </td><td>" . $fuel ."</td></tr>";
echo "<tr><td>gear: </td><td>" . $gear ."</td></tr>";
echo "<tr><td>leasing: </td><td>" . $leasing ."</td></tr>";
echo "<tr><td>vehicleType (carType): </td><td>" . $vehicleType ."</td></tr>";
echo "<tr><td>drive: </td><td>" . $drive ."</td></tr>";
echo "<tr><td>color: </td><td>" . $color ."</td></tr>";
echo "<tr><td>class: </td><td>" . $class ."</td></tr>";
echo "<tr><td>motorMake: </td><td>" . $motorMake ."</td></tr>";
echo "<tr><td>length: </td><td>" . $length ."</td></tr>";
echo "<tr><td> </td><td> </td></tr>";

echo "</table></td><td><table>";

echo "<tr><td>width: </td><td>" . $width ."</td></tr>";
echo "<tr><td>depth: </td><td>" . $depth ."</td></tr>";
echo "<tr><td>weight: </td><td>" . $weight ."</td></tr>";
echo "<tr><td>material: </td><td>" . $material ."</td></tr>";
echo "<tr><td>propulsion: </td><td>" . $propulsion ."</td></tr>";
echo "<tr><td>isSharing: </td><td>" . $isSharing ."</td></tr>";
echo "<tr><td>mooringAvailable: </td><td>" . $mooringAvailable ."</td></tr>";
echo "<tr><td>locationCountry: </td><td>" . $locationCountry ."</td></tr>";
echo "<tr><td>locationArea: </td><td>" . $locationArea ."</td></tr>";
echo "<tr><td> </td><td> </td></tr>";

echo "</table></td><td><table>";

echo "<tr><td>locationArea0: </td><td>" . $locationArea0 ."</td></tr>";
echo "<tr><td>locationArea1: </td><td>" . $locationArea1 ."</td></tr>";
echo "<tr><td>locationArea2: </td><td>" . $locationArea2 ."</td></tr>";
echo "<tr><td>locationArea3: </td><td>" . $locationArea3 ."</td></tr>";
echo "<tr><td>portName: </td><td>" . $portName ."</td></tr>";
echo "<tr><td>persons: </td><td>" . $persons ."</td></tr>";
echo "<tr><td>manufacturer: </td><td>" . $manufacturer ."</td></tr>";
echo "<tr><td>regNum: </td><td>" . $regNum ."</td></tr>";
echo "<tr><td>machineryHours: </td><td>" . $machineryHours ."</td></tr>";

echo "</table></td></tr>";

echo "<tr><td>accessory: </td><td colspan='3'>" . $accessory ."</td></tr>";
*/
//echo "<tr><td>"; //<table>";

/*        
		    echo "<tr><td>" . "countryGeoId: " .              "</td><td>" . $countryGeoId .             "</td></tr>";
		    echo "<tr><td>" . "Ad Id: " .              "</td><td>" . $adId .             "</td></tr>";
		    echo "<tr><td>" . "Vehicle Main Type: " .   "</td><td>" . $vehicleMainType .  "</td></tr>";
		    echo "<tr><td>" . "Is New: " .             "</td><td>" . $isNew .            "</td></tr>";
		    echo "<tr><td>" . "Make: " .              "</td><td>" . $make .             "</td></tr>";
		    echo "<tr><td>" . "Model: " .             "</td><td>" . $model .            "</td></tr>";
		    echo "<tr><td>" . "Year: " .              "</td><td>" . $year .             "</td></tr>";
		    echo "<tr><td>" . "Driven: " .            "</td><td>" . $driven .           "</td></tr>";
		    echo "<tr><td>" . "Hp: " .                "</td><td>" . $hp .               "</td></tr>";
		    echo "<tr><td>" . "Fuel: " .              "</td><td>" . $fuel .             "</td></tr>";
		    echo "<tr><td>" . "Gear: " .              "</td><td>" . $gear .             "</td></tr>";
		    echo "<tr><td>" . "Leasing: " .           "</td><td>" . $leasing .          "</td></tr>";
		    echo "<tr><td>" . "Vehicle Type: " .       "</td><td>" . $vehicleType .      "</td></tr>";
		    echo "<tr><td>" . "Drive: " .             "</td><td>" . $drive .            "</td></tr>";
		    echo "<tr><td>" . "Color: " .             "</td><td>" . $color .            "</td></tr>";
		    echo "<tr><td>" . "Class: " .             "</td><td>" . $class .            "</td></tr>";
		    echo "<tr><td>" . "Motor Make: " .         "</td><td>" . $motorMake .        "</td></tr>";
		    echo "<tr><td>" . "Length: " .            "</td><td>" . $length .           "</td></tr>";
		    echo "<tr><td>" . "Width: " .             "</td><td>" . $width .            "</td></tr>";
		    echo "<tr><td>" . "Depth: " .             "</td><td>" . $depth .            "</td></tr>";
		    echo "<tr><td>" . "Weight: " .            "</td><td>" . $weight .           "</td></tr>";
		    echo "<tr><td>" . "Material: " .          "</td><td>" . $material .         "</td></tr>";
		    echo "<tr><td>" . "Propulsion: " .        "</td><td>" . $propulsion .       "</td></tr>";
		    echo "<tr><td>" . "Is Sharing: " .         "</td><td>" . $isSharing .        "</td></tr>";
		    echo "<tr><td>" . "Mooring Available: " .  "</td><td>" . $mooringAvailable . "</td></tr>";
		    echo "<tr><td>" . "Location Country: " .   "</td><td>" . $locationCountry .  "</td></tr>";
		    echo "<tr><td>" . "Location Area: " .      "</td><td>" . $locationArea .     "</td></tr>";
		    echo "<tr><td>" . "Location Area0: " .     "</td><td>" . $locationArea0 .    "</td></tr>";
		    echo "<tr><td>" . "Location Area1: " .     "</td><td>" . $locationArea1 .    "</td></tr>";
		    echo "<tr><td>" . "Location Area2: " .     "</td><td>" . $locationArea2 .    "</td></tr>";
		    echo "<tr><td>" . "Location Area3: " .     "</td><td>" . $locationArea3 .    "</td></tr>";
		    echo "<tr><td>" . "Port Name: " .          "</td><td>" . $portName .         "</td></tr>";
		    echo "<tr><td>" . "Persons: " .           "</td><td>" . $persons .          "</td></tr>";
		    echo "<tr><td>" . "Manufacturer: " .      "</td><td>" . $manufacturer .     "</td></tr>";
		    echo "<tr><td>" . "Reg Num: " .            "</td><td>" . $regNum .           "</td></tr>";
		    echo "<tr><td>" . "Machinery Hours: " .    "</td><td>" . $machineryHours .   "</td></tr>";		    
		  	echo "</table>";
*/
// ------------------------
/*
working
	// get values from optional fields
	$fieldsArr = explode(',', 'area,area0,area1,area2,area3,cat2');
	for($i = 0; $i < count($fieldsArr); $i++) {
		$fieldName = $fieldsArr[$i];
		if(isset($_POST["$fieldName"])) { $fieldName = test_input($_POST["$fieldName"]); }
	}
*/


	// --------------- validate fields ---------------	
// include_once('functions/php/validation.php');
	$errFieldNames = array(); // list of fieldnames that have error
	//echo "<h1>cat1: *$cat1*</h1>";


	if($cat1 == '') { $allErrors .= '<li>Select category 1'; array_push($errFieldNames,"cat1"); }
	if($cat2 == '' && $cat2NumOfOptions > 0) {  
		if ($adType != '3' && $adType != '4') {
			$allErrors .= '<li>Select category 2'; array_push($errFieldNames,"cat2"); 
		}
	}
	if($isCompany == '1' && $orgNumber == '') { $allErrors .= '<li>Enter organisation number'; array_push($errFieldNames,"orgNumber"); }

if($loggedIn == '0') {
	if($postalCode == '') { $allErrors .= '<li>Enter postalCode'; array_push($errFieldNames,"postalCode"); }
	if($email != $emailAgain) { $allErrors .= '<li>Email and email-again fields do not match'; array_push($errFieldNames,"emailAgain"); }
	if(!filter_var($email, FILTER_VALIDATE_EMAIL)) { $allErrors .= '<li>Check email'; array_push($errFieldNames,"email"); }
	$allErrors .= validatePassword($adPassword);
}
	if($adType == 0 && strlen($price) < 1) { $allErrors .= '<li>Check price'; array_push($errFieldNames,"price"); } // applies to For sale -ads only

	// Bostad - Select category 2
	if($tempAdPrice == '') { $allErrors .= '<li>tempAdPrice is empty'; array_push($errFieldNames,"tempAdPrice"); }

	if(strlen($price) > 0) { if(!preg_match('/^(0|[1-9]\d*)(\.\d{2})?$/', $price)) { $allErrors .= '<li>Check price (example 100.00)'; array_push($errFieldNames,"price"); }}

	// optional fields: logo, aboutOrganisation

	// --------------- validate for not empty ---------------
	$fieldsArr = explode(',', 'name,email,emailAgain,phone,adPassword,title,texts,price');
	//for($i = 0; $i < count($fieldsArr); $i++) {
		//if($fieldsArr[$i] == 'name') { echo "<h1>name: $allErrors</h1>"; }
		//if($fieldsArr[$i] == 'price' && adType != '1') { continue; } // skip price check if adType other than sell
	if($loggedIn == '0') {
		if($name == '') { 		$allErrors .= "<li>Check " . ucfirst($fieldsArr[0]); array_push($errFieldNames, $fieldsArr[0]); }
		if($email == '') { 		$allErrors .= "<li>Check " . ucfirst($fieldsArr[1]); array_push($errFieldNames, $fieldsArr[1]); }
		if($emailAgain == '') { $allErrors .= "<li>Check " . ucfirst($fieldsArr[2]); array_push($errFieldNames, $fieldsArr[2]); }
		if($phone == '') { 		$allErrors .= "<li>Check " . ucfirst($fieldsArr[3]); array_push($errFieldNames, $fieldsArr[3]); }
		if($adPassword == '') { $allErrors .= "<li>Check " . ucfirst($fieldsArr[4]); array_push($errFieldNames, $fieldsArr[4]); }
	}

		if($title == '') { 		$allErrors .= "<li>Check " . ucfirst($fieldsArr[5]); array_push($errFieldNames, $fieldsArr[5]); }
		if($texts == '') { 		$allErrors .= "<li>Check " . ucfirst($fieldsArr[6]); array_push($errFieldNames, $fieldsArr[6]); }
		if($price == '') { 		$allErrors .= "<li>Check " . ucfirst($fieldsArr[7]); array_push($errFieldNames, $fieldsArr[7]); }

		// had code error
		//if($fieldsArr[$i] == '') {  // MAJOR ERROR - THIS checks the content of field name! not value
		//	$allErrors .= "Check " . ucfirst($fieldsArr[$i]); 
		//	 array_push($errFieldNames, $fieldsArr[$i]);
		//}
	//}
echo "<h1>allErrors: $allErrors</h1>";
	// --------------- validate max lengths ---------------

/* XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX */
/* XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX */
/* XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX */
/* XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX KORJAA VIRHEELLINEN VALIDATION KOODI ALLA !!!XXXXXXXXXXXXXXXXXXXXXXXXXX */
/* XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX */
/* XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX */
/* XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX */
	// todo: add orgNumber, aboutOrganisation, logo validation
	$lengthFields = 'title,texts,price,aboutOrganisation,logo,img';
	if($loggedIn == '0') { $lengthFields = 'name,orgNumber,email,phone,' . $lengthFields . ',adPassword'; }
	$fieldsArr = explode(',', $lengthFields);
	for($i = 0; $i < count($fieldsArr); $i++) {
		$maxLen = null;
		switch ($fieldsArr[$i]) {
			//case 'orgNumber': $maxLen = ???; break;
			case 'texts': $maxLen = 2000; break;
			case 'price': $maxLen = 10; break;
			case 'aboutOrganisation': $maxLen = 255; break;
			//case 'logo': $maxLen = ??; break;
			case 'img': $maxLen = 255; break;
			default: $maxLen = 50; break; // name,email,phone,title,adPassword
		}
		if(strlen($fieldsArr[$i]) > $maxLen) { 
// MAJOR ERROR - THIS checks the length of field name! not value
			$allErrors .= "<li>" .  ucfirst($fieldsArr[$i]) . " can be max $maxLen characters long";
			array_push($errFieldNames, $fieldsArr[$i]); 
		}
	} 

	if($acceptTerms != '1,') { 
		$allErrors .= '<li>You need to accept Stuffonaut terms to post an ad.'; 
		array_push($errFieldNames, 'acceptTerms');
	}

	// --------------- display validation results --------------------

	if($allErrors != '') {
		// put fieldnames with errors in hidden field
		echo "<input id='errFieldNames' type='hidden' value='" . implode(',', $errFieldNames) . "'>";
	} else {
		// ------------------------------------------------------------------------------------------------------------
		// MOVE INTO FUNCTION --> functions.php
		// --------------- save DB ---------------

		// temp data
		// $userId = '787'; 

		//echo "<h1>2 isCompany:$isCompany</h1>";

		
		$countryId = $country; 
	 	$countryGeoId = $country;

		// --------- users db table ---------
	 	//$userFields = "safeId,countryId,langId,isCompany,name,areaId,areaId0,address,address2,img,email,password,phone,userSinceDate,active";
	 	// $areaId = $area1; // country 
	 	// $area = '';
	 	// $area0 = '';
	 	// $area1 = '';
	 	// $area2 = '';
	 	// TODO: muuta  cityId --> areaId0	
	 	$password= $adPassword;
	 	//$areaId0 = '';
	 	switch ($langId) {
	 		case 'en': $langId = 0; break; // langId number in DB
	 		case 'fi': $langId = 1; break;
	 		case 'sv': $langId = 2; break;
	 	}

	 	if($selectedId == "") {			
	 		$userSinceDate = $todaysDate; 
	 	}

	 	// replace commas etc
	 	//$name = speChars($name);
		//$address = speChars($address);
		//$adress2 = speChars($address2);
		//$email = speChars($email);
		//$pssword = speChars($password);
		//$phone = speChars($phone);

	 	$email = simple_crypt($email); // sha256
	 	$password = simple_crypt($password, 'e512'); // sha512
	 	$safeId = generateRandomString(10, $conn);
	 	if($isCompany == 'company') { $isCompany = '1'; } else { $isCompany = '0'; }

	    //$values = $countryId . "," . $langId . "," . $isCompany . "," . $name . "," . $areaId . "," . $areaId0 . "," . $address . "," . $address2 . "," . $img . "," . $email . "," . $password . "," . $phone . "," . $userSinceDate . "," . $active;
	    // this is not in use!
	 //   $userValues = "'" . str_replace(",","','", "$safeId,$countryId,$langId,$isCompany,$name,$areaId,$areaId0,$address,$address2,$img,$email,$password,$phone,$userSinceDate,$active") . "'";

	    // save user in db
		if($selectedId != "")
		{   
// TODO : siirrä omalle sivulle - profile.php?
// TEE login / register sivut (jatka pseudokoodia jonka aiemmin teit)
			// update user

			// create where sql part
			/*
			$sqlWhere = '';
			$whereFieldsArr = explode(',', $userFields);
			for($i = 0; $i < count($whereFieldsArr); $i++) {
				$fieldName = $allFieldsArr[$i];
				$$fieldName = '';
			}*/

//			// $stmt = $this->mysqli->prepare("UPDATE datadump SET content=? WHERE id=?");
//			$stmt = $conn->prepare("UPDATE users SET (name=?,email=?) WHERE id=?");
//			$stmt->bind_param("ss", $name,$email);
//			$stmt->execute();
//			$stmt->close();
//			echo '<br>UPDATED user ID:'.$userId.'<br>';
/*
$stmt = $pdo->prepare("UPDATE myTable SET name = :name WHERE id = :id");
$stmt->execute([':name' => 'David', ':id' => $_SESSION['id']]);
$stmt = null;
*/

		} else {
			// OLD
		    //$insert_id = saveInDb('users',$userFields,$userValues,$conn);
			//INSERT INTO bloc1sers (safeId,countryId,langId,isCompany,name,areaId,areaId0,address,address2,img,email,password,phone,userSinceDate,active) VALUES ('NPq3MPYzk9',NULL,NULL,NULL,'Toyota myyj&#195;&#164;',NULL,NULL,NULL,NULL,'NULL','ektYd214eXFhTktFM1M3WVB6SkswbW9yc2htNEllWXRGMUdySjlSN1l5Zz0=','$6$rounds=5000$234g7n6GsdhHDrbp$9YzOjYDefppNLdjvqHARVkqHs/NXJsE6Fk36Rr0GW.xTLXQhLiwPgTM0YiDEyvH3E/lOQvEi9nsH9qNSuoglt.','12345678',NULL,NULL);

		/*
			// $sql = printf("INSERT INTO users (".$userFields.") VALUES ('%s',%i,%i,%i,'%s',%i,%i,'%s','%s','%s','%s','%s','%s',%i,%i);",$safeId,$countryId,$langId,$isCompany,$name,$areaId,$areaId0,$address,$address2,$img,$email,$password,$phone,$userSinceDate,$active);
		    $sql = printf("INSERT INTO users (".$userFields.") VALUES ('%s',%s,%s,%s,'%s',%s,%s,'%s','%s','%s','%s','%s','%s',%s,%s)",$safeId,$countryId,$langId,$isCompany,$name,$areaId,$areaId0,$address,$address2,$img,$email,$password,$phone,$userSinceDate,$active);
		    //// echo 'save user in db: ' . $sql . '<br>';
		    ////$conn->query($sql) or die("Error in saving in users");
		    ////$conn->query($sql) or die("Error saving in users: " . mysqli_error($this->db_link)); 
		    $conn->query($sql) or die(mysqli_error($conn));
		    //// mysqli_query($this->db_link, $query) or die(mysqli_error($this->db_link)); 
		    //if (!mysqli_query($conn, $sql)) { printf("Errormessage: %s\n", mysqli_error($conn)); }
		*/
		    //echo '<br>Before save user - isCompany:'.$isCompany.'<br>';

		    // save user
		    $stmt = $conn->prepare("INSERT INTO users ( safeId,countryId,langId,isCompany,name,areaId,areaId0,address,address2,img,email,password,phone,userSinceDate,active) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
			$stmt->bind_param("siiisiissssssii", $safeId,$countryId,$langId,$isCompany,$name,$areaId,$areaId0,$address,$address2,$img,$email,$password,$phone,$userSinceDate,$active);
			$stmt->execute();
			$stmt->close();

		    $userId = $conn->insert_id; //  works but why
		    // $insert_id = $conn->lastInsertId();
		    echo '<br>Inserted into users. ID:'.$userId.'<br>';
			
		    // put user data in session
		    saveInSession($safeId,$name,'pref1','pref2','pref3');
		}
		$userSafeId = $safeId;

		// --------- orgInfo db table ---------
		if($isCompany == '1') {
			//$userSafeId = $safeId;

			$orgNumber = speChars($orgNumber);
			$aboutOrganisation = speChars($aboutOrganisation);
			//$orgInfoValues = "'" . str_replace(",","','", "$userSafeId,$orgNumber,$aboutOrganisation,$logo") . "'";
			if($selectedId != "") {

			} else {
				// save orgInfo
			    //$dummy = saveInDb('orgInfo ',$orgInfoFields,$orgInfoValues,$conn);
			    // 2nd try
				$stmt = $conn->prepare("INSERT INTO orgInfo ($orgInfoFields) VALUES (?,?,?,?)");
				$stmt->bind_param("ssss", $userSafeId,$orgNumber,$aboutOrganisation,$logo);
				$stmt->execute();
				$stmt->close();
			}
		}

		// --------- ads db table ---------
		//$userId = $insert_id;
// if($cat2 == -1) { $cat2 = null; }
		// check areas for -1 value
		$fieldName = '';
		for($a=0; $a<4; $a++) {
			$fieldName = "area" . $a;
			if($$fieldName == -1) { $$fieldName = null; } 
		}
		// these are separate fields as in future user can select ad visibility startDate and endDate
	    $createdDate = $startDate = $endDate = $todaysDate; 

	    $endDate = getCurrentDateAsYYMMDDHHMM('plus90days') . '2359';  
	    // get ad price from DB
	    $companyAdPrice ='';
		$adPriceRes = mysqli_query($conn, "SELECT price FROM categories WHERE id=$cat1 LIMIT 1"); 
		if($adPriceRes) {
			if (mysqli_num_rows($adPriceRes) > 0) { while($row = mysqli_fetch_assoc($adPriceRes)) { $adPrice = $row["price"]; }}
		}
		if($adPrice == '') {
			// default adPrices for countries (must also be set in categories DB table)
			switch ($countryGeoId) {
				case '660013':  $adPrice = 2.90;   $companyAdPrice = 8.90; break; // Finland
				case '2661886': $adPrice = 30; $companyAdPrice = 90; break; // Sverige
			}
			if($isCompany == 1) { $adPrice = $companyAdPrice; }
		}

		$active = '1'; // SET 0 in production site

		//$table = 'ads';
		//$adsFields = "userId,countryId,langId,cat1,cat2,area1,area2,isCompany,adType,title,mainImg,img,texts,price,createdDate,startDate,endDate,isEnhanced,active";
		//$values = $userId . "," . $countryId . "," . $langId . "," . $cat1 . "," . $cat2 . "," . $area1 . "," . $area2 . "," . $isCompany . "," . $adType . "," . $title . "," . $mainImg . "," . $img . "," . $texts . "," . $price . "," . $createdDate . "," . $startDate . "," . $endDate . "," . $isEnhanced . "," . $active;
		// $adsValues = "$userId,$countryId,$langId,$cat1,$cat2,$area1,$area2,$isCompany,$adType,$title,$mainImg,$img,$texts,$price,$createdDate,$startDate,$endDate,$isEnhanced,$adPassword,$numComments,$active";
		$adsValues = "$userId,$adCode,$countryGeoId,$langId,$cat1,$cat2,$area,$area0,$area1,$area2,$area3,$adLatLng,$isCompany,$adType,$title,$mainImg,$img,$texts,$price,$createdDate,$startDate,$endDate,$isEnhanced,$adPassword,$adPrice,$numComments,$active";

		$adPassword = null; // do not save pw in ads table, it is already in users
		// update or save ad
		if($selectedId != "")
		{
		  	// update ad
			$data = "cat1=?,cat2=?,adType=?,title=?,texts=?,price=?,adPassword=?,adPrice=?,active=?";
			$stmt = $conn->prepare("UPDATE ads SET $data WHERE id=?"); // ,$adPrice d=float
			$stmt->bind_param('iiissisdii',$cat1,$cat2,$adType,$title,$texts,$price,$adPassword,$adPrice,$active, $selectedId);
     		$stmt->execute();
			$stmt->close();
			echo '<br>UPDATED ad ID:'.$userId.'<br>';

		} else {
			// save ad
			/*
			$vowels = array("a", "e", "i", "o", "u", "A", "E", "I", "O", "U");
			$onlyconsonants = str_replace($vowels, "", "Hello World of PHP");
			*/
			$title = str_replace(",", "&comma;", $title);
			$texts = str_replace(",", "&comma;", $texts);
			$adPassword = str_replace(",", "&comma;", $adPassword);
			$adCode = generateRandomString(6, $conn, 'readable');
/*		
			$adsValues_save = "'" . str_replace(",","','", "$userId,$adCode,$countryGeoId,$langId,$cat1,$cat2,$area,$area0,$area1,$area2,$area3,$adLatLng,$isCompany,$adType,$title,$mainImg,$img,$texts,$price,$createdDate,$startDate,$endDate,$isEnhanced,$adPassword,$adPrice,$numComments,$active") . "'";
			$insert_id = saveInDb('ads',$adFields,$adsValues_save,$conn);
*/
			// use $adId = $insert_id; with this
// jatka tästä - jokin sanoinsta ilm. varattu sana!
			// 2nd try

			$stmt2 = $conn->prepare("INSERT INTO ads ($adFields) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
			$stmt2->bind_param("isiiiiiiiiisiissssiiiiisiii", $userId,$adCode,$countryGeoId,$langId,$cat1,$cat2,$area,$area0,$area1,$area2,$area3,$adLatLng,$isCompany,$adType,$title,$mainImg,$img,$texts,$price,$createdDate,$startDate,$endDate,$isEnhanced,$adPassword,$adPrice,$numComments,$active);
			$stmt2->execute(); // 26 kpl, mutta arvoja 24 kpl???   
		$adId = $conn->insert_id; // new - Works!
			$stmt2->close();


			// update totalAds in categories table
			if($cat2 == '') {
				updateTotalAds($cat1, $conn); // new
			} else {
				updateTotalAds($cat2, $conn); // orig
			}
			// TODO if no user was saved - update total ads in users table

			// ------------------------------- save extra fields -------------------------
// TODO: check if catId is one with extrafields
	//$adId = $insert_id; // CHANGE THIS IF YOU CHANGE INSERT CODE!!!!
	//$adId = $conn->insert_id; // use with 2nd try method-uusin
			//$adId = $conn->lastInsertId(); // $insert_id; // WAS WRONG - saves user id

		/*
			$hasExtraData = $fieldname = "";
			$extraFieldsArr = explode(',', $extraFields);
			for($i = 0; $i < count($extraFieldsArr); $i++) {
				$hasExtraData .= $extraFieldsArr[$i];
				//if($extraFieldsArr[$i] == null) { $fieldname = ''   }
			}
			if(trim($hasExtraData) == '' && $selectedId != "") { 
				// delete extra fields row

			} else {
		*/


			echo "<h1>saved adId: $adId</h1>";

			if($eId != '') {
				//echo "<h1>eId: $eId</h1>"; //toimii
				// specific vehicle settings
				$vehicleMainType = $cat1;
				//car
				//tire
				//boat
				//caravan
				//moped
				//motorcycle
				//machinery
				//clothes
				//childrensClothing
				//bike
				//skis
				//realEstate


				// year,driven,carType,hpEnd,gear,fuel
				//$extraFieldsValues = "$year,$driven,$carType,$hpEnd,$gear,$fuel";
				//$extraFieldsValues = "$countryGeoId,$adId,$vehicleMainType,$isNew,$make,$model,$year,$driven,$hp,$fuel,$gear,$leasing,$vehicleType,$drive,$color,$class,$motorMake,$length,$width,$depth,$weight,$material,$propulsion,$isSharing,$mooringAvailable,$locationCountry,$locationArea,$locationArea0,$locationArea1,$locationArea2,$locationArea3,$portName,$persons,$manufacturer,$regNum,$machineryHours";
				if($selectedId != "")
				{
				  	// update extra fields
				  	// update ad
					$data = "vehicleMainType=?,isNew=?,make=?,model=?,year=?,driven=?,hp=?,fuel=?,gear=?,leasing=?,vehicleType=?,drive=?,color=?,class=?,motorMake=?,length=?,width=?,depth=?,weight=?,material=?,propulsion=?,isSharing=?,mooringAvailable=?,locationCountry=?,locationArea=?,locationArea0=?,locationArea1=?,locationArea2=?,locationArea3=?,portName=?,persons=?,manufacturer=?,regNum=?,machineryHours=?,accessory=?";
					$stmt = $conn->prepare("UPDATE vehicleextradata SET $data WHERE id=?");
					$stmt->bind_param("iiiiiiiiiiiiiiiiiiiiiiiiiiiiisiisis", $vehicleMainType,$isNew,$make,$model,$year,$driven,$hp,$fuel,$gear,$leasing,$vehicleType,$drive,$color,$class,$motorMake,$length,$width,$depth,$weight,$material,$propulsion,$isSharing,$mooringAvailable,$locationCountry,$locationArea,$locationArea0,$locationArea1,$locationArea2,$locationArea3,$portName,$persons,$manufacturer,$regNum,$machineryHours,$accessory, $selectedId);
					echo '<br>UPDATED extra fields<br>';
				  	//echo "<br><br>extraFieldsValues: " . $extraFieldsValues . "<br><br>";
				  	//updateInDb('vehicleextradata',$extraFields, $extraFieldsValues," WHERE adId=$selectedId",$conn);
				} else {
					// save extra fields

					/*
					//$extraFieldsValues_save = "'" . str_replace(",","','", "$year,$driven,$carType,$hpEnd,$gear,$fuel") . "'";
					
					//$extraFieldsValues_save = "'" . str_replace(",","','", "$countryGeoId,$adId,$vehicleMainType,$isNew,$make,$model,$year,$driven,$hp,$fuel,$gear,$leasing,$vehicleType,$drive,$color,$class,$motorMake,$length,$width,$depth,$weight,$material,$propulsion,$isSharing,$mooringAvailable,$locationCountry,$locationArea,$locationArea0,$locationArea1,$locationArea2,$locationArea3,$portName,$persons,$manufacturer,$regNum,$machineryHours") . "'";
					$extraFieldsValues_save = "$countryGeoId,$adId,$vehicleMainType,$isNew,$make,$model,$year,$driven,$hp,$fuel,$gear,$leasing,$vehicleType,$drive,$color,$class,$motorMake,$length,$width,$depth,$weight,$material,$propulsion,$isSharing,$mooringAvailable,$locationCountry,$locationArea,$locationArea0,$locationArea1,$locationArea2,$locationArea3,'$portName',$persons,$manufacturer,'$regNum',$machineryHours,'$accessory'";
					$dummy = saveInDb('vehicleextradata',$extraFields, $extraFieldsValues_save,$conn);
					*/
					// 2nd try
					$stmt = $conn->prepare("INSERT INTO vehicleextradata ($extraFields) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
					$stmt->bind_param("iiiiiiiiiiiiiiiiiiiiiiiiiiiiiiisiisisi", $countryGeoId,$adId,$vehicleMainType,$isNew,$make,$model,$year,$driven,$hp,$fuel,$gear,$leasing,$vehicleType,$drive,$color,$class,$motorMake,$length,$width,$depth,$weight,$material,$propulsion,$isSharing,$mooringAvailable,$locationCountry,$locationArea,$locationArea0,$locationArea1,$locationArea2,$locationArea3,$portName,$persons,$manufacturer,$regNum,$machineryHours,$accessory,$gender); // new - gender added as last
					echo '<br>SAVED extra fields<br>';
				}
     			$stmt->execute();
				$stmt->close();
			}
			// ----------------------------------------------------------------------------

			// was insert_id - is it working now?   CHANGED new --> new3
$nextPageForm = <<<EOT
						<form class="row" action="new3.php" method="post">
							<input type="hidden" name="adId" value="$adId">
							<input type="hidden" name="sId" value="$userSafeId">
							<div class="col m7" style="float:right;margin-right:15px">
								 <input type="submit" id="saveButton" class="primaryButton" value="Continue to uploading images">
							</div>
						</form>
EOT;
			// was insert_id - is it working now?
			if($adId) {
				// add logo btn
				//echo "<a href="uploadLogo.php" target="_blank" id="xxxxx">Upload company logo (opens in new tab)</a>";
$uploadLogoForm = <<<EOT
				<form class="row" action="uploadLogo.php" method="post">
					<input type="hidden" name="adId" value="$adId">
					<input type="hidden" name="sId" value="$userSafeId">
					<div class="col m7" style="float:right;margin-right:15px">
						 <input type="submit" class="primaryButton" value="Upload company logo (opens in new tab)">
					</div>
				</form>
EOT;
				if($isCompany == '1') { echo "<br><br>" . $uploadLogoForm; }

				echo "<br><br>";
				echo "A public quick code to see your ad is: <b>$adCode</b>, you can share it to your friends.<br>";
				echo $nextPageForm;
				exit();
			}
			// rename uploaded image names
			// echo '<h1>' . $savedTempImgFileNames2 . '</h1>';


			// renameImgFiles($tempAdId2, $adId, $imgUpload_savePath, $savedTempImgFileNames2); 
		}  

		// TODO:
		// save company info into separate companies -table 

		$conn->close();
	} // if no errors
}
/* ======================================================================================================================= */
?>








<!-- ============================================== create new ad -form ================================================= -->
<div class="bg">
		<div class="content">

			<div class="row">
				<div class="col m9">
					<div  class="row iCol2">
<!-- ======================================================================================= -->


                		<!-- place new ad -form -->
						<form id="newAd" class="row" action="<?php echo $thisPage; ?>" method="post" accept-charset="utf-8">
							<!-- hidden fields -->
							<input type="hidden" name="selectedId" value="<?php echo $selectedId; ?>">
							<input type="hidden" id="adLatLng" name="adLatLng" value="<?php echo $adLatLng; ?>">
							<input type="hidden" id="langId2" name="langId" value="<?php echo $langId; ?>">
							<input type="hidden" id="timeZone2" name="timeZone" value="<?php echo $timeZone; ?>">
							<input type="hidden" id="usersGeoLocation2" name="usersGeoLocation" value="<?php echo $usersGeoLocation; ?>">
							<input type="hidden" id="eId" name="eId" value="<?php echo $eId; ?>">
							<input type="hidden" id="cat2NumOfOptions" name="cat2NumOfOptions" value="<?php echo $cat2NumOfOptions; ?>">

							<div class="col m12" style="margin: 0 0 -15px 15px"> 

								<h1 id="addNewPageTitle_text" style="margin:0"></h1>
		                	<!--tempAdId2:<input id="tempAdId2" name="tempAdId2" type="text" value="<?php echo $tempAdId2; ?>">
		                	<br>savedTempImgFileNames2:<input id="savedTempImgFileNames2" name="savedTempImgFileNames2" type="text" value="<?php echo $savedTempImgFileNames2; ?>">-->
								<p id="addNewPageText_text" style="text-align:left;float:left"></p>
							</div>	

							<!-- all form validation errors -->	
							<?php 
							//if($allErrors != '') {
							//	echo '<div class="row"><div class="col m12">';
							//	echo '<ul style="color:red;text-align:left"><b>Errors</b>' . $allErrors . '</ul>';
							//	echo '</div></div>';
							//} 
							?>
						


							<div class="col m5">								
								<div class="row _noPadding">

									<?php if (strtoupper($_SERVER['REQUEST_METHOD']) != 'POST' && $loggedIn == '0') { ?>
									<a id="loginButton3_text" style="margin-bottom:15px" href="login.php?returnto=new"></a>
								<?php } ?>

									<!-- show JS validation error -->
									<div id="errorsPanel" class="row hidden">
										<div class="col m12">
											<h1><span id="error_titleA_text">[Det finns]</span>
												<span id="numberOfErrors">[X]</span>
												<span id="error_titleB_text">[fel i din annons]</span>
											</h1>
											<p><span id="error_text1_text">[Kontrollera fälten med röd text och ändra det som är felaktigt.]</span><br>
											   <span id="error_text2_text">[Klicka sedan på Lägg in annonsen igen.]</span></p>
										</div>
									</div>

									<!-- show PHP validation error -->
									<?php 
										if($allErrors != '') { 
											$errCount = count(explode('<li>', $allErrors))-1;

									?>
									<div id="errorsPanel" class="row">
										<div class="col m12">											
											<h1>Det finns <?php echo $errCount; ?> fel i din annons</h1>
											<p>Kontrollera fälten med röd text och ändra det som är felaktigt.<br><br>
											Klicka sedan på Lägg in annonsen igen.<p>									
											<?php echo '<ul style="">' . $allErrors . '</ul>'; ?>
										</div>
									</div>
									<?php } ?>

									<!-- pie test  https://medium.com/@pppped/how-to-code-a-responsive-circular-percentage-chart-with-svg-and-css-3632f8cd7705 -->
<!--
<svg viewBox="0 0 36 36" class="circular-chart">
  <path class="circle"
    d="M18 2.0845
      a 15.9155 15.9155 0 0 1 0 31.831
      a 15.9155 15.9155 0 0 1 0 -31.831"
    fill="none"
    stroke="#0A67C7";
    stroke-width="1";
    stroke-dasharray="90, 100"
  />
</svg>
<span class="percentage">90%</span>
-->
							<?php // if($loggedIn != '1') { ?>
									<!-- type of ad: private person or company  -->
									<div class="col m12 inlineControls" style="left:3px">
									<?php if($loggedIn == '0') { ?>
									    <div id="advertiserType_private" class="myRadio myRadiobutton<?php if($isCompany != 'company') { echo '-selected'; } ?>"></div>
									    <span class="checkText">[Privatperson]</span>							

									    <div id="advertiserType_company" class="myRadio myRadiobutton<?php if($isCompany == 'company') { echo '-selected'; } ?>"></div>
									    <span class="checkText">[Företag]</span>
									<?php } ?>
									    <input id="advertiserType" name="isCompany" type="hidden"  value="<?php if($isCompany == 'company') { echo 'company'; } else { echo 'private'; } ?>">
									</div><!-- changed 0 into private -->
									
									<div id="nameCol" class="col m12">
										<!-- private person name -->	
										<label id="name2" for="name">[Namn]</label>
										<!-- company name -->
										<label id="companyName2" for="companyName" class="hidden">[Företagsnamn]</label>
										<?php if($loggedIn == '0') { ?>
		      								<input id="name" class="_full-width validateLength" max="50" type="text" name="name" value="<?php echo $name; ?>">
		      							<?php } else {  echo "<div class='loggedInData'>$name</div>"; } ?>
									</div>

									<!-- xxxxxxxxxx -->							
									<div class="col m12 hidden" id="orgNumberPanel">
										<label for="orgNumber">[Organisationsnummer]</label>
		      							<?php if($loggedIn == '0') { ?>
		      								<input class="_full-width validateLength" max="25" type="text" name="orgNumber" value="<?php echo $orgNumber; ?>">
		      							<?php } else { echo "<div class='loggedInData'>$orgNumber</div>"; } ?>
									</div>

									<!-- email -->
									<div class="col m12">
										<?php /* $email = simple_crypt($email,'d'); */ ?>
										<label for="email">[E-post]</label>
		      							<?php if($loggedIn == '0') { ?>
		      								<input class="_full-width validateLength" max="150" type="email" id=="email" name="email" value="<?php echo $email; ?>">
		      							<?php } else { echo "<div class='loggedInData'>$email</div>"; } ?>
									</div>

									<!-- email again -->
									<?php if($loggedIn == '0') { ?>
									<div class="col m12">							
										<label for="emailAgain">[Upprepa E-post]</label>
		      							<input class="_full-width validateLength" max="150" type="email" id="emailAgain" name="emailAgain" value="<?php echo $emailAgain; ?>">
									</div>
		      						<?php } ?>
							<?php // } ?>
								</div>
							</div>
							<div class="col m7"></div>

						<?php // if($loggedIn != '1') { ?>
							<div class="col m12">
								<div class="row _noPadding">
									<!-- phone -->
									<div class="col m5" style="padding:0 15px">
										<label for="phone">[Telefon]</label>
		      							<?php if($loggedIn == '0') { ?>
		      								<input class="_full-width validateLength" max="50" type="text" name="phone" value="<?php echo $phone; ?>" style="margin-left:-16px;width: 280px">
		      							<?php } else { echo "<div class='loggedInData'>$phone</div>"; } ?>
									</div>
									<?php /*
									<!-- hide phone checkbox -->
									<div class="col m7" style="padding:38px 15px 0 15px" class="hidden">
										<div id="hidePhoneNumber_1" class="myCheck myCheckbox"></div><span class="checkText">[Dölj i annonsen]</span>
								    	<input id="hidePhoneNumber" name="hidePhoneNumber" type="hidden" value="">						
									</div> */ ?>
									<input id="hidePhoneNumber" name="hidePhoneNumber" type="hidden" value=""><!-- dummy -->
								</div>
							</div>

							<!-- continent & country (hidden by default) -->
							<span id="countryPanel" class="hidden">
								<div class="col m12 droplistBg">
									<label for="continent">[Continent]</label>
									<select id="continent" name="continent" class="droplist"></select>
								</div>
								<div class="col m12 droplistBg">
									<label for="country">[Country]</label>
									<select id="country" name="country" class="droplist"></select>
								</div>
							</span>
<!--
							<div class="col m12 droplistBg">
								<label for="area">Area 1</label>
								<select id="area" name="area" class="droplist"></select>
							</div>
----------------- -->
							<!-- county -->
							<div class="col m12">
								<div class="row _noPadding">
									<div class="col m5 droplistBg" style="padding:0 15px;left:19px">
										<label for="area">[Län]</label>
										<select id="area" name="area" class="droplist"></select>
									</div>
									<!-- plus / minus button for selecting continent & country -->
									<div class="col m7" style="padding:0">
										<span id="areaToggle" class="toggleBtnS plusIcon"></span>
									<!--
										<button id="areaToggle" class="toggleBtnS">
											<span class="plusIcon"></span>
										</button>


										SVG plus and muinus buttons

										<div id="map_zoom" style="position: absolute; z-index: 1; top: 48px; left: 4px;"><svg height="84" version="1.1" width="40" xmlns="http://www.w3.org/2000/svg" style="overflow: hidden; position: relative; top: -0.421875px;"><desc style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Created with RaphaÃ«l 2.1.0</desc><defs style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></defs><path fill="#f7f7f7" stroke="#636363" d="M2.158,0.263H7.8420000000000005C8.892000000000001,0.263,9.737,1.108,9.737,2.158V7.8420000000000005C9.737,8.892000000000001,8.892,9.737,7.8420000000000005,9.737H2.1580000000000004C1.1080000000000003,9.737,0.26300000000000034,8.892,0.26300000000000034,7.8420000000000005V2.1580000000000004C0.26300000000000034,1.1080000000000003,1.1080000000000003,0.26300000000000034,2.1580000000000004,0.26300000000000034Z" stroke-width="0.25" stroke-opacity="1" fill-opacity="0.8" transform="matrix(4,0,0,4,0,0)" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); stroke-opacity: 1; fill-opacity: 0.8; cursor: pointer;"></path><path fill="#636363" stroke="#000000" d="M4.8,1.5C4.689,1.5,4.6,1.589,4.6,1.7V4.7H1.6999999999999997C1.5889999999999997,4.7,1.4999999999999998,4.8340000000000005,1.4999999999999998,5C1.4999999999999998,5.166,1.5889999999999997,5.3,1.6999999999999997,5.3H4.6V8.3C4.6,8.411000000000001,4.689,8.5,4.8,8.5H5C5.111,8.5,5.2,8.411,5.2,8.3V5.300000000000001H8.3C8.411000000000001,5.300000000000001,8.5,5.166,8.5,5.000000000000001C8.5,4.8340000000000005,8.411,4.700000000000001,8.3,4.700000000000001H5.200000000000001V1.700000000000001C5.200000000000001,1.589000000000001,5.111000000000001,1.500000000000001,5.000000000000001,1.500000000000001Z" stroke-width="0" stroke-opacity="0" fill-opacity="1" opacity="1" transform="matrix(4,0,0,4,0,0)" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); stroke-opacity: 0; fill-opacity: 1; opacity: 1; cursor: pointer;"></path><path fill="#f7f7f7" stroke="#636363" d="M2.158,0.263H7.8420000000000005C8.892000000000001,0.263,9.737,1.108,9.737,2.158V7.8420000000000005C9.737,8.892000000000001,8.892,9.737,7.8420000000000005,9.737H2.1580000000000004C1.1080000000000003,9.737,0.26300000000000034,8.892,0.26300000000000034,7.8420000000000005V2.1580000000000004C0.26300000000000034,1.1080000000000003,1.1080000000000003,0.26300000000000034,2.1580000000000004,0.26300000000000034Z" stroke-width="0.25" stroke-opacity="1" fill-opacity="0.8" transform="matrix(4,0,0,4,0,44)" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); stroke-opacity: 1; fill-opacity: 0.8; cursor: pointer;"></path><path fill="#636363" stroke="#000000" d="M1.8,4.7H8.4C8.511000000000001,4.7,8.6,4.8340000000000005,8.6,5C8.6,5.166,8.511,5.3,8.4,5.3H1.8000000000000007C1.6890000000000007,5.3,1.6000000000000008,5.1659999999999995,1.6000000000000008,5C1.6000000000000008,4.834,1.6890000000000007,4.7,1.8000000000000007,4.7" stroke-width="0" stroke-opacity="0" fill-opacity="1" opacity="1" transform="matrix(4,0,0,4,0,44)" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); stroke-opacity: 0; fill-opacity: 1; opacity: 1; cursor: pointer;"></path></svg></div>

									-->
									</div>
								</div>
							</div>

							<!-- county or city -->
							<div class="col m12 droplistBg">
								<label for="area0">[Kommun eller stad]</label>
								<select id="area0" name="area0" class="droplist"></select>
							</div>

							<!-- area 1 -->
							<div class="col m12 droplistBg">
								<label for="area1">[Område]</label>
								<select id="area1" name="area1" class="droplist"></select>
							</div>

							<!-- area 2 -->
							<div class="col m12 droplistBg">
								<label for="area2">[Område 2]</label>
								<select id="area2" name="area2" class="droplist"></select>
							</div>

							<!-- postal code -->
							<div class="col m3 _noPadding" style="clear:left;margin:0 0 7px 35px">
								<label for="postalCode">[Postnummer]</label>
								<input class="_full-width validateLength" max="10" type="text" id="postalCode" name="postalCode" value="<?php echo $postalCode; ?>" style="width:280px">
							</div><div class="col m7"></div>
							<span style="clear:left;float:left"></span>

							<!-- category 1 
							<div class="col m12 droplistBg">
								<label for="cat1">[Kategori]</label>
								<select id="cat1" name="cat1" class="droplist"></select>
								<input id="selectedCat1" type="hidden" value="<?php echo $cat1; ?>">
							</div> -->
						<?php // } ?>
<!-- pricing info -->
							<div class="col m12">
								<div class="row _noPadding" style="margin-left:-15px">
									<!-- category 1  -->
									<div class="col m5 droplistBg" style="padding:0 15px">
										<label for="cat1">[Kategori]</label>
										<select id="cat1" name="cat1" class="droplist"></select>
										<input id="selectedCat1" type="hidden" value="<?php echo $cat1; ?>" style="margin-left:-16px;width:280px">
									</div>
									<!-- pricing info -->

									<div id="adPricePanel" class="col m7<?php if($tempAdPrice == '') { echo ' disabled3'; } ?>">
										<label for="adPrice">Price for your ad:</label>
								    	<span id="adPrice"><?php echo $tempAdPrice; ?></span>			
									</div>
									<input id="tempAdPrice" name="tempAdPrice" type="hidden" value="<?php echo $tempAdPrice; ?>">
								</div>
							</div>



							<!-- category 2 -->
							<div class="col m12 droplistBg">
								<label for="cat2">[Kategori 2]</label>
								<select id="cat2" name="cat2" class="droplist"></select>
								<input id="selectedCat2" type="hidden" value="<?php echo $cat2; ?>">
							</div> 

							<!-- ad type: For sale, For rent,exchange, Wanted to buy, Wanted to rent -->
							<div class="col m12 adTypes inlineControls">
							    <div id="adType_0" class="myRadio myRadiobutton-selected"></div><span id="adType_0_text" class="checkText">[Säljes]</span>
							    <div id="adType_1" class="myRadio myRadiobutton"></div><span id="adType_1_text" class="checkText">[Uthyres]</span>
							    <div id="adType_2" class="myRadio myRadiobutton"></div><span id="adType_2_text" class="checkText">[Bytes]</span>
							    <div id="adType_3" class="myRadio myRadiobutton"></div><span id="adType_3_text" class="checkText">[Köpes]</span>
							    <div id="adType_4" class="myRadio myRadiobutton"></div><span id="adType_4_text" class="checkText">[Önskar hyra]</span>
							</div>
							<input id="adType" name="adType" type="hidden"  value="0">

							<!-- extra searh criteria -->
							<div id="extraSearhCriteriaPanel" class="col m12 hidden" style="margin:20px 0 -2px 24px"></div>

							<!-- ad texts -->
							<div class="col m12">
								<div class="row _noPadding">
									<div class="col m9">
										<!-- ad title -->
										<label for="title">[Rubrik]</label>
										<p id="titleExtra_text"></p>
				      					<input class="_full-width validateLength" max="50" type="text" id="title" name="title" value="<?php echo $title; ?>">
				      					<!-- ad text -->
				      					<label for="text" style="margin-top:10px">[Text]</label>
				      					<textarea id="text" name="texts" class="_full-width validateLength" max="2000" style="min-height:190px"><?php echo $texts; ?></textarea>
									</div>
									<div class="col m3"></div>
								</div>
							</div>

							<!-- price -->
							<div id="pricePanel" class="col m12">
								<div class="row _noPadding">
									<div class="col m3" style="height:100px">
										<label id="price" for="price">[Pris]</label> <!-- price for private person ad -->
										<label id="priceInclVat" for="price" class="hidden">[Pris inkl moms]</label> <!-- price for company ad -->
				      					<input class="_full-width validateLength" max="10" type="text" name="price" value="<?php echo $price; ?>" placeholder="0.00"><span id="currency" class="currency">kr</span>
				      				</div>
									<div class="col m3" style="height:100px">
										<span id="priceTail">/ month</span>
									</div>
									<div class="col m6"></div>
								</div>
							</div>
						<?php // if($loggedIn != '1') { ?>
							<!-- shown when user is company -->
							<div id="aboutOrganisationPanel" class="col m12 hidden">
								<div class="row _noPadding">
									<!-- about organisation text -->
									<div class="col m9">
				      					<label for="aboutOrganisation">[Om företaget]</label>
				      					<textarea id="aboutOrganisation" name="aboutOrganisation" class="_full-width validateLength" max="255" style="min-height:190px"><?php echo $aboutOrganisation; ?></textarea>
									</div>
									<!-- company logo - not in use yet
									<div class="col m3" style="margin-left:0">
										<label for="logo">[Logotyp]</label>
										<div style="clear:left"></div>
										<span id="logo" class="image"><span class="cameraIcon"></span><b>Logo</b></span>
										<span style="width:40px;height:40px;float:left"></span>
										<input name="logo" type="hidden">
									</div>
									-->
									<input name="logo" type="hidden">
								</div>
							</div>

							<!-- password -->
							<div class="col m5">
								<div class="row _noPadding">
									<div id="passwordCol" class="col m12">
										<?php if($loggedIn == '0') { ?>
											<span class="eyeButton">x</span>
											<label for="adPassword">[Välj lösenord]</label>
		      								<input class="_full-width validateLength" max="50" type="password" id="adPassword" name="adPassword" value="<?php echo $adPassword;?>">
		      							<?php } ?>
									</div>
								</div>
								<div class="col m7"></div>
							</div>
						<?php // } ?>

							<!-- terms checkbox -->
							<div id="acceptTerms1Panel" class="col m12" style="margin-left:15px">
								<label for="acceptTerms1">[Godkänn villkor och övrigt]</label>
								<div id="acceptTerms_1" class="myCheck myCheckbox<?php if($acceptTerms == '1,') { echo "-selected"; } ?>" style="clear:left"></div><!--<a href="terms.php" target="_blank" id="terms" class="checkText">[Ja, jag godkänner Stuffonaut...]</a>-->
									<span class="terms_yesIAccept checkText">[Yes I accept]</span><a href="termsOfService.php" target="_blank" class="termsOfService checkText" style="margin-left:-17px">[termsOfService]</a><span class="terms_and checkText" style="margin-left:-17px">[and]</span><a href="privacyPolicy.php" target="_blank" class="privacyPolicy checkText" style="margin-left:-17px">[privacyPolicy]</a>
								 <input id="acceptTerms" name="acceptTerms" type="hidden" value="<?php echo $acceptTerms; ?>">
							</div>

							<!-- save button -->
							<div class="col m12" style="margin-left:15px">
								 <input type="submit" id="saveButton" value="[Lägg in annons]">
								 <!-- <button type="submit" id="saveButton" value="[Lägg in annons]"></button> -->
							</div>


						</form> 

					</div>
				</div> <!-- END single ad -->

				<!-- ========================================= SIDE BANNER AREA ========================================== -->				
				<div class="col m3">
					<h2 id="sidePanelTitle_text">[Right side]</h2>
					<div class="gallery">
						<div class="galleryCard">
							<div class="cardImg"><img src="img/home2.jpg"></div>
							<div class="text">This is an ad that has a lot of lines of text so w can test it.</div>
							<div class="price">490kr</div>
						</div>
						<div class="galleryCard">
							<div class="cardImg"><img src="img/home2.jpg"></div>
							<div class="text">This is an ad that has a lot of lines of text so w can test it.</div>
							<div class="price">490kr</div>
						</div>
					</div>
				</div>
			</div> <!-- row -->

			<!-- hidden settings -->
			<input id="phpPageName" type="hidden" value="new"> 
			<!--<input id="currentSingleAd" type="hidden">-->
<!--
        </div>
</div>--> <!-- bg -->


<!-- NEXT LINES NEEDED FOR GEOLOCATION TO INIT!!! -->
<!-- Google Places - Execute AFTER pageload  
            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDi6cKFOSPieKZdvfiZUOTE6iURGxgCqgk&libraries=places&callback=initMap&language=fi"></script> <!--  add &language;=fr  in needed -->
<!--<script>-->

<?php include_once('footer.php'); ?>

<script>
$(function() {
	$("#title").click(function() {
		/* for new.php form */		
		$('#timeZone2').val( $('#timeZone').val() );
		$('#langId2').val( $('#langCode').val() );
		$("#usersGeoLocation2").val( $("#usersGeoLocation").val() ); // kopioi tästä areat new POSTISSA
	});
});
</script>