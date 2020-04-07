<?php 
// include_once('functions.php');
// $conn = getDBConn();


include_once('functions.php'); 
$conn = getDBConn('','noWelcomeText');



// ----------------------------------------------- POST ---------------------------------------------------
// create and init POSTED variables
$formFields = 'parentCommentId,adId,userId,sellerUserId,commentText,stars,commenterName,hideProfileImg'; // commentCatId removed
$fieldsArr = explode(',', $formFields);
for($i = 0; $i < count($fieldsArr); $i++) {
	$fieldName = $fieldsArr[$i];
	$$fieldName = null;
	// get posted values
	if (isset($_GET[$fieldsArr[$i]])) { 
		$$fieldName = filter_input( INPUT_GET, $fieldsArr[$i], FILTER_SANITIZE_URL ); 
		// NEW SAFER
		// $$fieldName = filter_input( INPUT_GET, $fieldsArr[$i], FILTER_SANITIZE_URL ); 
		//$$fieldName = test_input( replaceCommas( filter_var(trim($_POST["$fieldName"]), FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_ENCODE_HIGH) ));
	} 
}
/*
INSERT INTO comments (parentCommentId,adId,userId,sellerUserId,commentCatId,dateSaved,commenterName,hideProfileImg,commentText) VALUES ('',6026,'','',0,1901151345,'safe3name',0,'safecomment3');

*/

// TEST ------------!!!!!!!!!!!!!
//echo '<br>RETURNED: ' . $validateFields = $comment . ' ' . $commentCatId . ' ' . $commenterName;
// exit; 




// ---------------------- validate ----------------------------
$err = '';

// not empty
$validateFields = 'adId,userId,commentText,stars,commenterName';
$fieldsArr = explode(',', $validateFields);
for($i = 0; $i < count($fieldsArr); $i++) {
	if ($fieldsArr[$i] == '') { $err .= '1'; }
}
if ($stars == '-1') { $err .= '1'; }

$err .= validateStrLen($commenterName,3,25);
$err .= validateStrLen($commentText,3,255);

function validateStrLen($str, $min, $max){
    $len = strlen($str);
    if($len < $min){
        return '1'; // "Field Name is too short, minimum is $min characters ($max max)";
    }
    elseif($len > $max){
        return '1'; // return "Field Name is too long, maximum is $max characters ($min min).";
    }
    return ''; // true
}

// // check that vars are digits - vikaa
// $systemErr = '';
// if(!ctype_digit("$adId")) 				{ $systemErr .= '450270 '; }
// if(!ctype_digit("$commentCatId")) 		{ $systemErr .= '450271 '; }
// if(!ctype_digit("$parentCommentId")) 	{ $systemErr .= '450272 '; }
// if(!ctype_digit("$userId")) 			{ $systemErr .= '450273 '; }
// if($systemErr != '') { echo '<br>Oh, something went wrong, cannot save comment. Error code: ' . $systemErr; $err .= '1'; }
// -------------------- prepare for saving ------------------------
// add quotes if empty
$emptyFields = 'parentCommentId,adId,userId,sellerUserId,stars';
$emptyFieldsArr = explode(',', $emptyFields);
for($i = 0; $i < count($emptyFieldsArr); $i++) {
	$fieldName = $emptyFieldsArr[$i];
	if ($$fieldName == '') { $$fieldName = '""'; }
}

$dateSaved = getCurrentDateAsYYMMDDHHMM();
$hideProfileImg = 0; // TEMP

// if comment is about seller, get seller id by adId
//$sellerUserId = null;
//if($commentCatId == '2') {
	$sellerUserId = getSellerUserIdFromAdId($adId,$conn);
//}


// ----------------------- save comment in DB ------------------------------
if($err != '') { 
	echo '<span id="errorsPanel" style="float:left;padding:15px;color:#dd5858"><h1>Error</h1><p>Oh, please check your comment</p></span>'; exit; 
} else {
	// save comment in DB

	$saveFields = "parentCommentId,adId,userId,sellerUserId,stars,dateSaved,commenterName,hideProfileImg,commentText";
    $saveValues = $parentCommentId . "," . $adId . "," . $userId . "," . $sellerUserId . "," . $stars . "," . $dateSaved . ",'" . $commenterName . "'," . $hideProfileImg . ",'" . $commentText . "'";
//echo '<br>saveValues: ' . $saveValues;

	$insert_id = saveInDb('comments',$saveFields,$saveValues,$conn);

	//echo '<br>sellerUserId: ' . $sellerUserId;
	// $result = mysqli_query($conn, $sql);
	// if ($result === false) { return null; exit; } 
	// $result = mysqli_query($conn, $sql); 

	/*

	INSERT INTO comments (parentCommentId,adId,userId,sellerUserId,commentCatId,dateSaved,commenterName,hideProfileImg,commentText) VALUES (null,6026,null,null,0,1901171023,'MynameEster2',0,'Thisisthe2ndrealcomment')

	*/

	// ------------------- get existing stars,voteSum,totVotes ---------------

	//votes: 1+2+3+4+5+5+5 +5
	//totVotes: 7
	//starsAve: 3,75

	// get current stars average
	(int)$voteSum = (int)$totVotes = ''; 
	$sql = "SELECT stars,voteSum,totVotes FROM ads WHERE id=$adId LIMIT 1";
	echo 'SQL1: $sql';
	$result = mysqli_query($conn, $sql); 
	if (mysqli_num_rows($result) > 0) 
	{ 
		while($row = mysqli_fetch_assoc($result)) {
			// $oldAverageStars = (float)$row["stars"];
			$voteSum = (int)$row["voteSum"];
			$totVotes = (int)$row["totVotes"];

		}
	}
	
	$voteSum += (int)$stars;
	$totVotes++;
	$newAverageStars = calculateNewAverage($stars, $voteSum, $totVotes);

	// update stars average
	// UPDATE ads SET numClicks=55 WHERE id=1
	$sql = "UPDATE ads SET stars=$newAverageStars,voteSum=$voteSum, totVotes=$totVotes WHERE id=$adId";
	echo 'SQL2: $sql';
	$conn->query($sql) or die("Error in updating ads: " . mysql_error());

	// ------------------- calculate  new stars average -------------------
	
	// ------------------- save new stars average ---------------

	// update num of comments & stars average in ads table 
	updateInDb('ads','numComments',getNumberOfComments($adId,$conn),' WHERE id=' . $adId,$conn);

 	$conn->close();

	//return json_encode(array($result));
	//echo implode(',', $arr);

	//$response =array( );
	//$response["data"] = $arr;
	//$response["page"] =	$page;
	//$response["totalPages"] = ceil($totalPages);
	//$response["totalItems"] = $totalItems;
	//echo json_encode($response);

	// testing
	//echo '<div class="card-box comments" style="text-align:left">';
	//echo $tableData;
	//echo '</div>';


	//echo json_encode($tableData);
 }



// calculates stars average
function calculateNewAverage($newVote, $voteSum, $totVotes) {
	return ($voteSum + $newVote) / ($totVotes+1); // no decimals - use ', 2)' for 2 decimals
}
 /*
function getAverage() {
	var sum = 0;
	for( var i = 0; i < elmt.length; i++ ){
	    sum += parseInt( elmt[i], 10 ); //don't forget to add the base
	}
	return sum/elmt.length;
}
	*/
?> 
