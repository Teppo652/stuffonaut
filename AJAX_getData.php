<?php 
include_once('functions.php'); 
$conn = getDBConn('','noWelcomeText');

$name = $id = $sql = '';
$arr = array();
if (isset($_GET["name"])) 
{ 
	$name = filter_input( INPUT_GET, "name", FILTER_SANITIZE_URL );
	if (isset($_GET["id"])) { $id = filter_input( INPUT_GET, "id", FILTER_SANITIZE_URL ); }
	switch ($name) {
		case 'boat': 
			if($id != '') {
				$sql = "SELECT manufacturer FROM boatmanufacturers WHERE id=$id LIMIT 1"; return$sql;
			} else {
				$sql = "SELECT id,manufacturer FROM boatmanufacturers WHERE active=1 ORDER BY orderId ASC";
			}
			break;
	}

	$result = mysqli_query($conn, $sql);
	$tempRes = '';
	if (mysqli_num_rows($result) > 0) 
	{
	  while($row = mysqli_fetch_assoc($result)) {
	  	if($id != '') { return $row['manufacturer']; exit; }
	  	/*
		array_push($arr, array(
			"id" => $row['manufacturer']
			));
		*/
		//$tempRes .= '<option id="'.$id.'">'.$row['manufacturer'].'</option>';
		$tempRes .= $row['manufacturer'];
	  } // while
	} else {  $arr =''; } // no data was found
	// echo json_encode($arr); // implode(",", $arr); //  json_encode($arr); //
	echo $tempRes;
}

// return implode(",", $arr); // SELECT * FROM favorites WHERE userSafeId=""
 
/*
boatManufacturers data: <br />
<b>Warning</b>:  mysqli_num_rows() expects parameter 1 to be mysqli_result, boolean given in <b>AJAX_getData.php</b> on line <b>23</b><br />
<br />
<b>Warning</b>:  implode(): Invalid arguments passed in <b>AJAX_getData.php</b> on line <b>32</b><br />
<h1>DATA: </h1> 
*/
?> 