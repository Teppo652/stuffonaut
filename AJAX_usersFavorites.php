<?php 
include_once('functions.php'); 
$conn = getDBConn('','noWelcomeText');

$id = $userSafeId = '';
if (isset($_GET["adId"])) 
{ 
	if (isset($_GET["userSafeId"])) 
	{
		$id = filter_input( INPUT_GET, "adId", FILTER_SANITIZE_URL );
		$userSafeId = filter_input( INPUT_GET, "userSafeId", FILTER_SANITIZE_URL );

		//echo '<br>ad id: ' . $id;
		//echo '<br>userSafeId: ' . $userSafeId;
		//AJAX_saveInUsersFavorites.php?adId=888&userSafeId=HUuTJf5Asc

		$favoriteQuery = getUsersFavorites($userSafeId, $id, $conn);
		//echo '<br>getUsersFavorites: ';
		//if($favoriteExists) { echo 'TRUE'; } else { echo 'FALSE'; }

		if($id != '') {
			// save in favorites if don't already exist
			if(!$favoriteQuery) {				
				// echo '<br>Trying to save in favorites';
				$fields = 'id,userSafeId';
				$values = "" . trim($id) . ",'" . $userSafeId . "'";
		    	// save in db
				$dummy = saveInDb('favorites',$fields,$values,$conn);
				// echo '<br>saved in favorites!';
			}
		} else {
			// get all users favorites
			//echo '<br>Trying to get users favorites: '. $favoriteQuery; 
			echo $favoriteQuery; // return array
		}
	}
}

function getUsersFavorites($userSafeId, $adId='', $conn) {
	// if adId has value, return true or false
	// if adId empty, return all users favorite adIds
	$res = '';
	$arr = array();

	if($adId != '') {
		// adId has value, get single result
		
		$sql = 'SELECT id FROM favorites WHERE userSafeId="' . $userSafeId . '" AND id="' . $adId . '" LIMIT 1'; 
    	//echo '<br>SQL: ' . $sql;
	} else {
		// adId has NO value, get all users favorites
		$sql = 'SELECT * FROM favorites WHERE userSafeId="' . $userSafeId . '"';
    	//echo '<br>SQL: ' . $sql;
	}
    $result = mysqli_query($conn, $sql);
    if($result)
    {
      if (mysqli_num_rows($result) > 0)
      {    
        while($row = mysqli_fetch_assoc($result))
        {        
            if($adId != '') { 
            	$res = $row['id']; 
            	if($res != '') { return true; } else { return false; }
        	} else {
        		array_push($arr, $row['id']);
        	}
        }
      }
    }
    return implode(",", $arr); // SELECT * FROM favorites WHERE userSafeId=""
    
}
/*

id userSafeId
888 LwVLqCeV8z
888 HUuTJf5Asc
888 4dSV5Uudk5
888 iQ3dz5aPue


*/
?> 