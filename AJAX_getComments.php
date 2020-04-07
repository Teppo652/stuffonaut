<?php 
include_once('functions.php'); 
$conn = getDBConn('','noWelcomeText');

$adId = $parentCommentId = $getCommentForm = '';
/* ====================================== get commentForm ========================================== */
if (isset($_GET["commentForm"])) 
{ 
	if (isset($_GET["adId"])) { $adId = filter_input( INPUT_GET, "adId", FILTER_SANITIZE_URL ); }
	if (isset($_GET["parentCommentId"])) { $parentCommentId = filter_input( INPUT_GET, "parentCommentId", FILTER_SANITIZE_URL ); }
	if($parentCommentId) { $parentCommentId = explode('_', $parentCommentId)[1]; }
	// return empty form only
	$getCommentForm = filter_input( INPUT_GET, "commentForm", FILTER_SANITIZE_URL ); 	
	if($getCommentForm == '1') {
		include('AJAX_commentFormHtml.php');
		echo getCommentForm($parentCommentId,$adId);
		exit; 
	}
}
/* ======================================= display comments ======================================== */

// create and init POSTED variables
//$parentCommentId = $adId = $userId = $sellerUserId = $commentCatId = $dateSaved = $comment = '';
$fields = 'id,parentCommentId,adId,userId,sellerUserId,commentCatId,dateSaved,comment';
$fieldsArr = explode(',', $fields);
for($i = 0; $i < count($fieldsArr); $i++) {
	$fieldName = $fieldsArr[$i];
	$$fieldName = '';

	// get posted values
	if (isset($_GET[$fieldsArr[$i]])) { $$fieldName = filter_input( INPUT_GET, $fieldsArr[$i], FILTER_SANITIZE_URL ); }
}
$searchCriteria = $sqlExtra = ''; 

// get posted search values



// if (isset($_GET["parentCommentId"])) { $parentCommentId = filter_input( INPUT_GET, "parentCommentId", FILTER_SANITIZE_URL ); }
// if (isset($_GET["adId"])) { $adId = filter_input( INPUT_GET, "adId", FILTER_SANITIZE_URL ); }
// if (isset($_GET["userId"])) { $userId = filter_input( INPUT_GET, "userId", FILTER_SANITIZE_URL ); }
// if (isset($_GET["sellerUserId"])) { $sellerUserId = filter_input( INPUT_GET, "sellerUserId", FILTER_SANITIZE_URL ); }
// if (isset($_GET["commentCatId"])) { $commentCatId = filter_input( INPUT_GET, "commentCatId", FILTER_SANITIZE_URL ); }
// if (isset($_GET["dateSaved"])) { $dateSaved = filter_input( INPUT_GET, "dateSaved", FILTER_SANITIZE_URL ); }
// if (isset($_GET["comment"])) { $comment = filter_input( INPUT_GET, "comment", FILTER_SANITIZE_URL ); }

// construct sql query
//if ($parentCommentId != '' && $parentCommentId != '0') { 	$sqlExtra .= ' AND parentCommentId=' . $parentCommentId; }
//if ($adId != '' && $adId != '0') { 							$sqlExtra .= ' AND adId=' . $adId; }
//if ($userId != '' && $userId != '0') { 						$sqlExtra .= ' AND userId=' . $userId; }
//if ($sellerUserId != '' && $sellerUserId != '0') { 			$sqlExtra .= ' AND sellerUserId=' . $sellerUserId; }
//if ($commentCatId != '' && $commentCatId != '0') { 			$sqlExtra .= ' AND commentCatId=' . $commentCatId; }
//if ($dateSaved != '' && $dateSaved != '0') { 				$sqlExtra .= ' AND dateSaved=' . $dateSaved; }
//if ($comment != '' && $comment != '0') { 					$sqlExtra .= ' AND comment=' . $comment; }



// --------- SQL query --------- 
$tableData = '';
$arr = [];
// $fields = 'id,cat1,cat2,area,area0,area1,area2,area3,isCompany,title,mainImg,price,startDate';
//$prefix = $cat1 == "" ? "" : "a.";


//$sql = "SELECT * FROM comments";
/*
$sql = "SELECT a.id,a.cat1,a.adLatLng,a.title,a.mainImg,a.img,a.texts,a.price,a.startDate,a.numComments,c.name AS cat1Name,u.name,u.phone,u.safeId,e.model,e.year,e.driven,e.hp,e.fuel,e.gear,e.leasing,e.vehicleType,e.regNum
			FROM ads as a 
			INNER JOIN categories as c ON a.cat1=c.id 
			INNER JOIN users as u ON a.userId=u.id
			INNER JOIN vehicleextradata as e ON a.id=e.adId 
			WHERE a.id=$id and a.active=1 LIMIT 1";
DB:
id
parentCommentId
adId
userId
sellerUserId
commentCatId
dateSaved
commenterName
hideProfileImg
commentText
*/
// //$sql = "SELECT * FROM comments WHERE adId=$adId ORDER BY parentCommentId, ASC"; // dateSaved 
// $sql = "SELECT * FROM comments WHERE adId=$adId and parentCommentId == '0' ORDER BY parentCommentId ASC";

//
$sql = "SELECT *
FROM comments WHERE adId=$adId 
ORDER BY IF(parentCommentId = 0, id, parentCommentId), parentCommentId, id";

/*

SELECT * FROM comments as A WHERE adId=1 and parentCommentId=0 
RIGHT JOIN SELECT * FROM comments as B WHERE adId=1 and  parentCommentId > 0 
ON A.id = B.parentCommentId 
ORDER BY parentCommentId,dateSaved ASC 




SELECT * FROM comments WHERE parentCommentId = NULL 
UNION 
DISTINCT SELECT * FROM comments WHERE parentCommentId > -1 ORDER BY parentCommentId,dateSaved ASC

SELECT * FROM comments WHERE parentCommentId = NULL 


TOIMIVA:
SELECT DISTINCT A.id,A.parentCommentId,A.commenterName,A.commentText,A.dateSaved
FROM comments A, comments B
WHERE A.id = B.parentCommentId OR B.parentCommentId=0
AND A.adId = 1 
ORDER BY A.parentCommentId,A.id ASC


INNER JOIN

SELECT * FROM comments as A WHERE parentCommentId = NULL 
RIGHT JOIN 
DISTINCT SELECT * FROM comments as B WHERE parentCommentId > -1 
ON A.id = B.parentCommentId 
ORDER BY parentCommentId,dateSaved ASC


RIGHT JOIN messages 
ON messages.id = myguests.id";

SELECT A.* AS Set1, B.* AS Set2, A.City 
FROM comments A, comments B 
WHERE A.id = B.parentCommentId 
*/


// $displayFields = 'c.id,c.parentCommentId,c.userId,c.commenterName,c.dateSaved,c.commentText,u.name,u.img';
// $sql = "SELECT c.id,c.parentCommentId,c.userId,c.commenterName,c.dateSaved,c.commentText,u.name,u.img 
// FROM comments as c 
// INNER JOIN users as u ON c.userId=u.id 
// WHERE adId=$adId ORDER BY dateSaved DESC";

$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) 
{ 
	while($row = mysqli_fetch_assoc($result)) { $arr[] = $row; }
echo json_encode($arr, JSON_NUMERIC_CHECK);
} else {  $arr =''; } // no data was found
exit;


/*
$result = mysqli_query($conn, $sql);
if ($result === false) { return null; exit; } 
$result = mysqli_query($conn, $sql); 
$deleteIdCounter = 0;
if (mysqli_num_rows($result) > 0) 
{ 
	$tempCounter = 1;
	$arr = array();

	
	
//	echo '<br><table class="table table-hover"><thead><tr>';
//		echo "<th>" . "Parent Comment Id" . "</th>";
//		echo "<th>" . "Ad Id"            . "</th>";
//		echo "<th>" . "User Id"          . "</th>";
//		echo "<th>" . "Seller User Id"    . "</th>";
//		echo "<th>" . "Comment Cat Id"    . "</th>";
//		echo "<th>" . "Date Saved"       . "</th>";
//		echo "<th>" . "Comment"         . "</th>";
//	echo "</tr></thead><tbody>"; 
*/

//	while($row = mysqli_fetch_assoc($result)) 
//	{	 
//		// id,dateSaved,comment userName,userImg
//			array_push($arr, array(
//			"id"  		 => $row["id"],
//			"dateSaved"  		 => $row["dateSaved"],
//			"commentText"  => $row["commentText"]


//			"cat1" 		 => $row["cat1"],
//			"cat2"  	 => $row["cat2"],
//			"placeName"  => $row["area2"],
//			"startDate"  => $row["startDate"],
//			"adTitle"    => $row["title"],
//			"price"  	 => $row["price"]


//			));
//	}  // while
//	//echo "</tbody></table>"; 
//} else {  $arr =''; } // no data was found

/*
//		$tempCounter++; 
//
//		echo "<tr>";
//					  $row["id"] 						 x
//		echo "<td>" . $row["parentCommentId"] . "</td>";
//		echo "<td>" . $row["adId"]            . "</td>"; x
//		echo "<td>" . $row["userId"]          . "</td>"; x
//		echo "<td>" . $row["sellerUserId"]    . "</td>";
//		echo "<td>" . $row["commentCatId"]    . "</td>";
//		echo "<td>" . $row["dateSaved"]		  . "</td>"; x
//		echo "<td>" . $row["comment"]         . "</td>"; x
//		echo "</tr>";
		*/
$img = 'https://www.thehealthyhomeeconomist.com/wp-content/uploads/2018/02/Sarah-with-a-cup-of-tea-100x100.jpg';

// if($row["hideProfileImg"] != 1) {
/*
$itemData = <<<EOT
				<li id="com_t$deleteIdCounter">
                    <div class="comment-meta">
                       <span class="comment-date">$row["dateSaved"]</span>
                       <span class="comment-time">9:11 am</span>    
                        <a rel="nofollow" class="comment-reply-link">Reply</a>                                    
                    </div>
                    <div class="comment-author"> 
                    	<!-- <span class="commentIcon flipX"></span> -->
                    	<a href="#"><img alt="" src="$img" height="100" width="100"></a> 
                    </div>
                    <div class="comment-content">
                    <h4>$row["userId"]</h4>
                    <p>$row["comment"]</p>
                </li>
EOT;



/*
// with image
$itemData = <<<EOT
				<li id="com_t$deleteIdCounter">
                    <div class="comment-meta">
                       <span class="comment-date">May 18th, 2018</span>
                       <span class="comment-time">9:11 am</span>    
                        <a rel="nofollow" class="comment-reply-link">Reply</a>                                    
                    </div>
                    <div class="comment-author"> 
                    	<!-- <span class="commentIcon flipX"></span> -->
                    	<a href="#"><img alt="" src="$img" height="100" width="100"></a> 
                    </div>
                    <div class="comment-content">
                    <h4>Sarah</h4>
                    <p>Cod liver oil offers a lot more than Vitamin D drops, which are an isolated vitamin with no  synergistic components. Getting this vitamin from a whole food source like cod liver oil is  preferable IMO. If you choose to give your baby cod liver oil (ONLY unheated high vitamin brands),   then you can stop with the Vitamin D drops.
                    </p>
                </li>
EOT;

$deleteIdCounter++;

// no image
$itemData2 = <<<EOT
				<li id="com_$deleteIdCounter">
                    <div class="comment-meta">
                       <span class="comment-date">May 18th, 2018</span>
                       <span class="comment-time">9:11 am</span>    
                        <a rel="nofollow" class="comment-reply-link">Reply</a>                                    
                    </div>
                    <div class="comment-author"> 
                    	<span class="commentIcon flipX"></span>
                    	<!--<a href="#"><img alt="" src="$img" height="100" width="100"></a>--> 
                    </div>
                    <div class="comment-content">
                    <h4>Sarah</h4>
                    <p>Cod liver oil offers a lot more than Vitamin D drops, which are an isolated vitamin with no  synergistic components. Getting this vitamin from a whole food source like cod liver oil is  preferable IMO. If you choose to give your baby cod liver oil (ONLY unheated high vitamin brands),   then you can stop with the Vitamin D drops.
                    </p>
                </li>
EOT;

			$tableData .= $itemData . $itemData2;
			$deleteIdCounter++;

			$tableData .= $itemData;

	}  // while
	//echo "</tbody></table>"; 
} else {  $arr =''; } // no data was found
*/

// ================================== add comment ====================================
/*
id
parentCommentId
adId
userId
sellerUserId
commentCatId
dateSaved
comment

NEW
commenterName
hideProfileImg

*/


//return json_encode(array($result));
//echo implode(',', $arr);

//$response =array( );
//$response["data"] = $arr;
//$response["page"] =	$page;
//$response["totalPages"] = ceil($totalPages);
//$response["totalItems"] = $totalItems;
//echo json_encode($response);

// testing
// echo '<div class="card-box comments" style="text-align:left">';
// echo $tableData;
// echo '</div>';


echo json_encode($tableData);
?> 
