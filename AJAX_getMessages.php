<?php 
include_once('functions.php'); 
$conn = getDBConn('','noWelcomeText');
$table = 'messages';

$fuid = ''; // = fromUser
$myUserId = '2'; // TEMP!!! -----------------------------
$userSafeId  = '';

//if (isset($_GET["uId"])) { 
//    $userSafeId = filter_input( INPUT_GET, "uId", FILTER_SANITIZE_URL ); 

if (isset($_GET["fuid"])) { 
    $fuid = filter_input( INPUT_GET, "fuid", FILTER_SANITIZE_URL ); 

    // get messages
    //$sql = "SELECT * FROM $table WHERE userSafeId = $userSafeId ORDER BY sentDate ASC";
    $sql = "SELECT fromUser,toUser,sentDate,message FROM $table WHERE fromUser = $fuid OR toUser = $fuid ORDER BY sentDate ASC"; //  LIMIT 1
//echo $sql; exit;

    $result = mysqli_query($conn, $sql);

    if ($result === false) { 
        echo null; exit; 
    } else {

       $arr = [];
        if (mysqli_num_rows($result) > 0) 
        { 
            while($row = mysqli_fetch_assoc($result)) { $arr[] = $row; }
            echo json_encode($arr, JSON_NUMERIC_CHECK);
        } else {  $arr =''; } // no data was found
        exit;

    } // result
} else {
    echo '<br>Something went wrong, could not get your messages.'; exit;
}
/* ===================== post ================= 
$fields = 'id,fromUser,toUser,title,message';
$fieldsArr = explode(',', $fields);
for($i = 0; $i < count($fieldsArr); $i++) {
	$fieldName = $fieldsArr[$i];
	$$fieldName = '';

	// get posted values
	if (isset($_GET[$fieldsArr[$i]])) { $$fieldName = filter_input( INPUT_GET, $fieldsArr[$i], FILTER_SANITIZE_URL ); }
}
*/


// echo json_encode($tableData);
?> 
