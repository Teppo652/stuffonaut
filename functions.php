<?php
if(session_status() == PHP_SESSION_NONE){ session_start(); }

// image upload settings
$imgUpload_savePath = "imgs/"; 
$imgUpload_allowedTypes = array('jpg','png','jpeg','gif');
$imgUpload_maxFileSize = 200000; // 200000  300 kb

// getDBConnection
function getDBConn($dbName="stuffonaut", $noServerComment = '') 
{
  $currDirName = substr(getcwd(), 0, 1);      
  if($currDirName == 'C') 
  {  
      // LOCAL WAMP TEST SERVER
      //if($noServerComment == '') { echo '<br>This is test server.<br>'; }
      
      $dbName="stuffonaut";
      $username = "root"; // root
      $password = "";
      // $servername = "127.0.0.1:8080"; // 
      $servername = "localhost"; //  127.0.0.1
      //$dbname = "stuffonaut_OLD";
      
      //$servername = "localhost";
      //$username = "1029520";
      //$password = "qwerty";
      //$dbname = "1029520db2";

      //conn = new mysqli($servername, $username, $password, $dbName); // OLD
      $conn = mysqli_connect($servername, $username, $password, $dbName);
      //// not tested
      //mysql_query ('SET NAMES UTF8;');
      //mysql_query ('SET COLLATION_CONNECTION=utf8_general_ci;');
      //mysql_client_encoding($conn);// where $conn is your connection

      $conn->set_charset("utf8mb4");

      //mysql_select_db( 'exams' ); // NEW
      //mysql_select_db( 'exams' , $conn ); // NEW
      // mysql_select_db( 'stuffonaut', $conn ); // NEW
    } 
    else 
    { 
    //  echo '<br>This is AWS server.<br>'; 
      // AWS
      // default database: echo "<br>RDS_DB_NAME: " . $_SERVER['RDS_DB_NAME']; // ebdb
      //$conn = mysqli_connect($_SERVER['RDS_HOSTNAME'], $_SERVER['RDS_USERNAME'], $_SERVER['RDS_PASSWORD'], $_SERVER['RDS_DB_NAME'], $_SERVER['RDS_PORT']);

      // name cheap
      $dbName="stufssjm_stuffonaut";
      $username = "stufssjm_admin90210"; 
      $password = "kh346&hls_sdeg.AEFiu35jv5k3kjg3554h";
      // $servername = "127.0.0.1:3306"; // 
      $servername = "localhost"; //  127.0.0.1

      $conn = mysqli_connect($servername, $username, $password, $dbName);
      $conn->set_charset("utf8mb4");
    }
    /*
    Short answer - You should almost always be using the utf8mb4 charset and utf8mb4_unicode_ci collation.
    */
    $conn->set_charset("utf8mb4"); // NEW added 21 2 2017
    /*
    Note that, as of PHP 5.5.0, mysql_set_charset is deprecated, and mysqli::set_charset should be used instead: $mysqli->set_charset("utf8")

    IN MYSQL:
    https://www.toptal.com/php/a-utf-8-primer-for-php-and-mysql
    */

// Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    return null;
  } else {
    return $conn;
  }
}

// OLD -- use new with PDO prepared statements
function saveInDb($table,$fields,$values,$conn) {
  $sql = "INSERT INTO $table ($fields) VALUES ($values)";
  // $conn->query($sql) or die("Error inserting in $table : " . mysql_error());
  //echo '<br>INSERTING: ' . $sql;
  if ($conn->query($sql) === TRUE) {
      // $last_user_id = $conn->insert_id; // get id of created db record
      // echo "Record inserted successfully into table " . $table;
  } else {
    echo "Error inserting into table " . $table . " record: " . $conn->error;
    // TODO: save in logfile and show friendly error message to user 
  }
  return $conn->insert_id;
}

/*
$stmt = $db->prepare("INSERT INTO table(field1,field2,field3,field4,field5) VALUES(:field1,:field2,:field3,:field4,:field5)");
$stmt->execute(array(':field1' => $field1, ':field2' => $field2, ':field3' => $field3, ':field4' => $field4, ':field5' => $field5));
$affected_rows = $stmt->rowCount();
*/
function XXXXXsaveInDb($table,$fields,$values,$conn) {
  $sql = ""; // i - integer  d - double  s - string  b - BLOB
  switch ($table) {
    case 'users':          //$args = "siiisiissssssii";
    //echo 'FILDS: ' . $fields . '<br>';
      //$sql = $conn->prepare("INSERT INTO users ($fields) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
      //$sql = $conn->prepare("INSERT INTO users ($fields) VALUES ('%s', '%i', '%i', '%i', '%s', '%i', '%i', '%s', '%s', '%s', '%s', '%s', '%s', '%i', '%i')"); // ', '%
      $sql = printf("INSERT INTO users ($fields) VALUES ('%s', '%i', '%i', '%i', '%s', '%i', '%i', '%s', '%s', '%s', '%s', '%s', '%s', '%i', '%i');",$safeId,$countryId,$langId,$isCompany,$name,$areaId,$areaId0,$address,$address2,$img,$email,$password,$phone,$userSinceDate,$active); // ', '%

      break;
    case 'orgInfo':        //$args = "ssss";
    /*
      //$sql = $conn->prepare("INSERT INTO ads ($fields) VALUES (?, ?, ?, ?)");
      $sql = $conn->prepare("INSERT INTO ads ($fields) VALUES ('%s', '%s', '%s', '%s')");
      //$sql->bind_param("ssss", $values);
      */
      break;
    case 'ads':            //$args = "isiiiiiiiiisiissssiiiiisi";
      /*
      //$sql = $conn->prepare("INSERT INTO ads ($fields) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
      $sql = $conn->prepare("INSERT INTO ads ($fields) VALUES ('%i', '%s', '%i', '%i', '%i', '%i', '%i', '%i', '%i', '%i', '%i', '%s', '%i', '%i', '%s', '%s', '%s', '%s', '%i', '%i', '%i', '%i', '%i', '%s', '%i')");
      //$sql->bind_param("isiiiiiiiiisiissssiiiiisi", $values);
      */
      break;
    case 'comments':       $args = "iiiiiisis"; // values: ,6026,,,1,1901151336,'safename5',0,'Safecomment5'
      $sql = $conn->prepare("INSERT INTO comments ($fields) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
      echo '<br>' . "INSERT INTO comments ($fields) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
      break;
    case 'favorites':      $args = "is"; 
      $sql = $conn->prepare("INSERT INTO favorites ($fields) VALUES (?, ?)");
      echo '<br>' . "INSERT INTO favorites ($fields) VALUES (?, ?)";
      break;
    case 'categories':     $args = "iiiissisi"; 
      $sql = $conn->prepare("INSERT INTO categories ($fields) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
      break;
  }
  /*


INSERT INTO comments (parentCommentId,adId,userId,sellerUserId,commentCatId,dateSaved,commenterName,hideProfileImg,commentText) VALUES ('',6026,'','',0,1901151345,'safe3name',0,'safecomment3');


// prepare and bind
$sql = $conn->prepare("INSERT INTO MyGuests (firstname, lastname, email) VALUES (?, ?, ?)");
$sql->bind_param("sss", $firstname, $lastname, $email);
$sql->execute();
$sql->close();

$conn->close();
  */

//echo '<br>args for '.$table.': ' . $args;
//echo '<br>values for '.$table.': ' . $values;
//// qm: 10
//// num of q: 1
//echo '<br>num of fields for '.$table.': ' . count(explode(',', $fields));
//echo '<br>len of args for '.$table.': ' . strlen($args);
//echo '<br>num of values for '.$table.': ' . count(explode(',', $values));



// $sql->bind_param($args, $values);
//$sql->execute();


//$conn->query($sql) or die("Error saving in $table : " . mysql_error());
$conn->query($sql);
$conn->close();
return $conn->insert_id;
}


// $sql = "UPDATE " . $table . " SET " . $adsValues_update . " WHERE id=" . $selectedId;
function updateInDb($table,$fields,$values,$where,$conn) {
  $fieldsAndValues = generateUpdateFields($fields, $values);
  $sql = "UPDATE " . $table . " SET " . $fieldsAndValues . $where;
  $conn->query($sql) or die("Error in updating $table : " . mysql_error());
  //echo '<br>UPDATING: ' . $sql;
  //if ($conn->query($sql) === TRUE) {
  //     echo "Record updated successfully in table " . $table;
  //} else {
  //    echo "Error updating in table " . $table . " record: " . $conn->error;
  //  // TODO: save in logfile and show friendly error message to user 
  //}
}

function getSellerUserIdFromAdId($adId,$conn) {
  $sql = "SELECT userId FROM ads WHERE id=$adId LIMIT 1";
  //echo '<br>SQL: ' . $sql;
  $result = mysqli_query($conn, $sql); 
  if (mysqli_num_rows($result) > 0) 
  {
    while($row = mysqli_fetch_assoc($result)) { return $row["userId"]; }
  }
}

function getNumberOfComments($adId,$conn) {
  $sql = "SELECT count('id') as count FROM comments WHERE adId=$adId";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) 
  {
    while($row = mysqli_fetch_assoc($result)) { return $row["count"]; }
  }
}
// ("SELECT count('id') as count FROM comments WHERE adId=$adId",'count',$conn)
function getSingleValue($sql,$fieldName,$conn) {
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) 
  {
    while($row = mysqli_fetch_assoc($result)) { return $row["$fieldName"]; }
  }
}

/* constructs keys and values for SQL update */
function generateUpdateFields($fields, $values) {
  $updateFields = '';
  $fieldsArr = explode(',', $fields);
  $valuesArr = explode(',', $values);
  for($x = 0; $x < count($fieldsArr); $x++) {
      $updateFields .= $fieldsArr[$x] . "='" . $valuesArr[$x] . "', ";
  }
  return substr($updateFields, 0, -2);
}

// adds uploaded image names into ads table
//function updateImageNamesInDb($adId, $imagesArr,$conn) {
function updateImageNamesInDb($adId, $mainImg='', $imagesArr='',$conn) {
    // old - automatically saved foirst img as mainImage
    //if(count($imagesArr)>1) {
    //    $mainImg = array_shift($imagesArr); // first image is main image
    //    $img = implode(';', $imagesArr);
    //} else {
    //    $mainImg = $imagesArr[0];
    //    $img = '';
    //}

    if($mainImg == '') {
      // update all imagenames in db
      $img = implode(';', $imagesArr);
      $sql = "UPDATE ads SET img='" . $img . "' WHERE id=" . $adId;
    } else {
      // update mainImg only
      $sql = "UPDATE ads SET mainImg='" . $mainImg . "' WHERE id=" . $adId;
    }
    //echo '<br>SQL: '.$sql; // SQL: UPDATE ads SET mainImg='3.jpg' WHERE id=Error in updating image names:
    $conn->query($sql) or die("Error in updating image names: " . mysqli_error($conn)); // USE mysqli_error($conn) everywhere!!
}

function simple_crypt( $str, $action = 'e' ) {
    $secret_key = '234g7n6GsdhHDrbpwS05730w9';
    $secret_iv = 'HDrbpw234gGsd7n6GsdhS05Gs';
    $output = false;
    $encrypt_method = "AES-256-CBC";
    $key = hash( 'sha256', $secret_key );
    $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );
    if( $action == 'e' ) {
        // encrypt
        $output = base64_encode( openssl_encrypt( $str, $encrypt_method, $key, 0, $iv ) );
    }
    else if( $action == 'd' ){
        // decrypt
        $output = openssl_decrypt( base64_decode( $str ), $encrypt_method, $key, 0, $iv );
        //$output = 'decrypt gives error...';
    } else if( $action == 'e512' ) {
        $output = crypt($str,'$6$rounds=5000$234g7n6GsdhHDrbpwS0573$');
    } 
    //echo "<br>Encrypted length of $str is: " . strlen($output);
    return $output;
}

function validatePassword($pwd) {
    $errors = '';
    if (strlen($pwd) < 7) {
        $errors .= "<li>Lösenord för kort (minst 6 tecken)";
    }
    if (!preg_match("#[0-9]+#", $pwd)) {
        $errors .= "<li>Lösenord måste ha minst 1 siffra";
    }
    if (!preg_match("#[a-zA-Z]+#", $pwd)) {
        $errors .= "<li>Lösenord måste ha minst 1 bokstav";
    }     
    return $errors;
}

function replaceCommas($str) {
  while (strrpos(',', $str) != false) {
    $str = str_replace(",", "&comma;", $str);
  }
  return $str;
}

function getCurrentFileName(){
    //$pageName= window.location.pathname;
    //// alert('PAGE: ' + pagePathName.substring(pagePathName.lastIndexOf("/") + 1));
    //return pagePathName.substring(pagePathName.lastIndexOf("/") + 1);

  $url = $_SERVER['PHP_SELF'];
  $urlArr = explode('/', $url);
  return $urlArr[count($urlArr) - 1];
  //return $_SERVER['PHP_SELF'];
}

// -------------- SESSION --------------------
function saveInSession($userSafeId,$userName,$pref1,$pref2,$pref3) {
  // $_SESSION[$name] =  $data;
  //$my_array=array('cat', 'dog', 'mouse', 'bird', 'crocodile', 'wombat', 'koala', 'kangaroo');
  //$_SESSION['animals']=$my_array;
  //$locArr = array("'" . 
  //   $("#userSafeId").val() . "','" .
  //   $("#userName").val() . "','" . 
  //   $("#pref1").val() . "','" . 
  //   $("#pref2").val() . "','" . 
  //   $("#pref3").val()
  //   "'");
  /*
  $locArr = array("'" . 
      $userSafeId . "','" .
      $userName . "','" . 
      $pref1 . "','" . 
      $pref2 . "','" . 
      $pref3 .
      "'");
      array_push($userArr, $userSafeId, $userName, $pref1,  $pref2,$pref3);
  */
  //array_push($userArr, $userSafeId);
  //array_push($userArr, $userName);
  //array_push($userArr, $pref1);
  //array_push($userArr, $pref2);
  //array_push($userArr, $pref3);
  //$_SESSION['user'] = $userArr;

  //$_SESSION['user'] = $userSafeId;
  $_SESSION['user'] = "$userSafeId#$userName#$pref1#$pref2#$pref3";
}

function loadFromSession() {
  if($_SESSION['user']) {
    $sessionArr = explode('#', $_SESSION['user']);
    echo "<br>loadFromSession: ".$_SESSION['user'];
    /*
  foreach($sessionArr as $key=>$val)
  {
    switch($key) {
      //case 0: echo '<br>HERE ARE userInfoArr items';
      case 0: echo '<br><input type="text" value="'.$val.'" id="userSafeId">'; break;
      case 1: echo '<input type="text" value="'.$val.'" id="userName">'; break;
      case 2: echo '<input type="text" value="'.$val.'" id="pref1">'; break;
      case 3: echo '<input type="text" value="'.$val.'" id="pref2">'; break;
      case 4: echo '<input type="text" value="'.$val.'" id="pref3"><br>'; break;
    } 
  }
  */
} else {
  echo '<br>No session found!';
}
  //foreach($_SESSION['user'] as $key=>$val)
  //{
    // echo '<br>From session: ' . $key . ' is ' . $val;
    //echo "/* -------------- user info --------------- */";
  /*
$cars = array("Volvo", "BMW", "Toyota");
echo "I like " . $cars[0] . ", " . $cars[1] 
  */
//    $userInfoArr = $_SESSION['user'];
//    echo '<br>HERE ARE userInfoArr items';
//    echo '<br>userSafeId:<input type="text" value="a'.$userInfoArr[0].'" id="userSafeId">';
//    echo '<br>userName:<input type="text" value="b'.$userInfoArr[1].'" id="userName">';
//    echo '<input type="text" value="'.$userInfoArr[2].'" id="pref1">';
//    echo '<input type="text" value="'.$userInfoArr[3].'" id="pref2">';
//    echo '<input type="text" value="'.$userInfoArr[4].'" id="pref3">';
    
    
  //} // foreach
  return $_SESSION['user'];
}

// NEW
/*
function getUserSafeId() {
  // if user in session (is logged in) - get user safeId
  if($_SESSION['user']) {
    $sessionArr = explode('#', $_SESSION['user']);
    return $sessionArr[0]; // user safe id
  }
}
*/

function showSession() {
  if(isset($_SESSION["location"])) { echo '<br>THIS IS FROM SESSION' . $_SESSION['location']; } else {
    echo '<br>SESSION IS EMPTY';
  }
  //foreach($_SESSION['location'] as $key=>$val)
  //{
  //  echo '<br>From session: ' . $key . ' is ' . $val;
    //switch($key) 
    //  case 0: echo $val; break;
    //  case 1: echo $val; break;
    //  case 2: echo $val; break;
    //  case 3: echo $val; break;
    //  case 4: echo $val; break;
    //  case 5: echo $val); break;
    //}
  //} // foreach
}

function removeSession() {
  session_unset(); // remove all session variables
  session_destroy();  // destroy the session
}
/*
function saveLocationCookie($siteCountryCode,$langCode)
{
  // NOTE! must appear before HTML tag!
  setcookie('locationRegister', $siteCountryCode . '_' . $langCode, time() + (86400 * 90), "/"); // 86400 = 1 day
  // setcookie($cookieName, 'This is test cookie.', time() + (86400 * 90), "/"); // 86400 = 1 day
}
function getLocationCookie()
{
  if(isset($_COOKIE['locationRegister'])) { 
    $data = $_COOKIE['locationRegister']; 
    // $siteCountryCode,$langCode
      return $data; 
  } else {
    return false; 
  }
}
*/

  /*
"timeZone"
"currencyCode"
"languages"
"langCode"
"siteCountryCode"
"usersGeoLocation"
*/




function saveCookie($name,$data)
{
  // NOTE! must appear before HTML tag!
  setcookie($name, $data, time() + (86400 * 90), "/"); // 86400 = 1 day
  // setcookie($cookieName, 'This is test cookie.', time() + (86400 * 90), "/"); // 86400 = 1 day
}

function getCookie($name) {
  if(isset($_COOKIE[$name])) { 
    return $_COOKIE[$name]; 
    // $siteCountryCode,$langCode,$gender,$lookingForGender
      // return $data; 
  } else {
    return false; 
  }
}

function deleteCookie($name) {
  setcookie($name, "", time() - 3600);
  echo '<br><br><br><br>DELETING COOKIE: ' . $name . '<br>';
}

function saveTestDataCookie() {
    $siteCountryCode =  'fi';
    $langCode =         'fi';
    $geonameid =        '';
    $timeZone =         '';
    $currencyCode =     '';
    $languages =        '';
    $login =            '';
    $password =         '';

    // save test cookie 
    saveCookie('isQuickRegistered', $siteCountryCode . '_' . $langCode . '_' . $gender . '_' . $lookingForGender . '_' . $geonameid . '_' . $timeZone . '_' . $currencyCode . '_' . $languages . '_' . $login); 
}


/*
// ====================================== cookie functions ========================================
// saveCookie('quickRegister',$siteCountryCode,$langCode,$gender,$lookingForGender);
function saveCookie($cookieName,$siteCountryCode,$langCode,$gender,$lookingForGender,$login)
{
  // NOTE! must appear before HTML tag!
  setcookie($cookieName, $siteCountryCode . '_' . $langCode . '_' . $gender . '_' . $lookingForGender . '_' . $login, time() + (86400 * 90), "/"); // 86400 = 1 day
  // setcookie($cookieName, 'This is test cookie.', time() + (86400 * 90), "/"); // 86400 = 1 day
}
function getCookie()
{
  if(isset($_COOKIE['quickRegister'])) { 
    $data = $_COOKIE['quickRegister']; 
    // $siteCountryCode,$langCode,$gender,$lookingForGender
      return $data; 
  } else {
    return false; 
  }
}
// -------------- COOKIE --------------------
// 0 TEMP set cookie
//setcookie('funwithbox_siteCountryCode', 'FI', time() + (86400 * 30), "/"); // 86400 = 1 day
//setcookie('funwithbox_lang', 'FI', time() + (86400 * 30), "/"); // 86400 = 1 day

// // 1 try read from cookie: siteCode + lang 
// $frLangId = ''; // 'EN'
// $siteCountryCode = '';
// if(isset($_COOKIE['funwithbox_siteCountryCode'])) { 
//   $siteCountryCode = $_COOKIE['funwithbox_siteCountryCode']; 
//   echo "<h1>Cookie siteCountryCode: " . $siteCountryCode . "</h1>"; 
// } 
// if(isset($_COOKIE['funwithbox_lang'])) { 
//   $frLangId = $_COOKIE['funwithbox_lang'];
//   echo "<h1>Cookie frLangId: " . $frLangId . "</h1>"; 
// }
*/

// $tempAdId2, $adId, $imgUpload_savePath, $numOfImages2
/*
function renameImgFiles($tempAdId, $adId, $path, $fileNames) {
  // renameImgFiles called: tempAdId: fileNames: path: imgs/
  // BEFORE SAVE: tempAdId2:6bwr399b - savedTempImgFileNames:6bwr399b_1.jpg,
  echo "<br>renameImgFiles called: tempAdId: $tempAdId  fileNames: $fileNames  path: $path "; 
  $fileType = '';
  $fileNamesArr = explode(',', $fileNames);
  for($f=0; $f < count($fileNamesArr)-1; $f++) {
    // $imgUpload_savePath . $tempAdId . '_' . $imageCounter . '.' . $fileType;
    $fileType = explode('_', $fileNamesArr[$f])[1];
    //rename($path . $fileNamesArr[$f], $path . $adId . '_' . $f . '.' . $fileType);
    echo '<br>Renaming: ' . $fileNamesArr[$f] . ' into ' . $adId . '_' . $f . '.' . $fileType;
  }
}
*/
function generateRandomString($length = 8, $conn, $readableCode='', $dbTable='users', $dbField='safeId') {
    $chars = '23456789abcdefghijkmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ';
    // $chars = '23456789abcdefghjkmnpqrstuvwxyz'; // ABCDEFGHJKLMNPQRSTUVWXYZ';
    if($readableCode != '') {  $chars = '23456789ABCDEFGHJKLMNPQRSTUVWXYZ'; }
    $charsLen = strlen($chars);    
    do {
      $str = '';
      for ($i = 0; $i < $length; $i++) {
          $str .= $chars[rand(0, $charsLen - 1)];
      }
    } while (checkRandomStringIsUnique($str, $dbTable, $dbField, $conn) == true);
    return $str;
}

function checkRandomStringIsUnique($randomString, $dbTableName, $fieldName='safeUserId', $conn)
{
  $data = "";  
  $res = false;
  $sql = 'SELECT id FROM ' . $dbTableName  . ' WHERE ' . $fieldName . '="' . $randomString . '" LIMIT 1'; 
  $result = mysqli_query($conn, $sql);
  //echo '<br><br>checkRandomStringIsUnique SQL: ' . $sql; 
  if($result)
  {
    if (mysqli_num_rows($result) > 0)
    {    
      while($row = mysqli_fetch_assoc($result))
      {        
          $res = $row['id'];  
      }
    }
  }
  //   $conn->close();
  if($res != false) { $res = true; }
  return $res;
}





/* not in use anymore
function getExistingImages($adId, $getWhat='main', $conn) 
{
  $res = '';
  // get old images from DB
  $imgs = '';
  $nextFreeImgNumber = '';
  // $sql = "SELECT profileImage FROM datingSite_users WHERE id=" . $userId . " LIMIT 1";
  if($getWhat == 'main') {
    $sql = "SELECT mainImg FROM ads WHERE id=$adId LIMIT 1";
  } else {
    $sql = "SELECT img FROM ads WHERE id=2 LIMIT 1";
  }
  

  // $res .= '<br>sql: ' . $sql . '<br>';
  $result = mysqli_query($conn, $sql);
  // if (mysqli_num_rows($result) > 0)
  if($result)
  {
     $counter = 0;
     $template1 = '<span class="imageActive"><img src="imgs/';
     $template2 = '"></span>';
     while($row = mysqli_fetch_assoc($result))
     {
        if($getWhat == 'main') { 
          return $row["mainImg"]; exit; 
        } else {
          $imgs = $row["img"];
        }
     }
  } else {
     $nextFreeImgNumber = '1';
     $res .= '<br>No old images found in DB<br>';
  }
  // echo '<br>Found: ' . $imgs;
  // $nextFreeImgNumber = '1'; //getNextFreeImgNumberFromName($row["img"]);

  // iterate img names
  $imagesArr = explode(',', $imgs);
  for($a=0; $a<5; $a++) {
    if($a<count($imagesArr)) { 
      $res .= $template1 . $imagesArr[$a] . $template2;
    } else {
      $res .= '<span class="imageInactive"><span class="cameraIcon inactive"></span></span>';
    }
  }


  // $res .= '<input id="nextFreeImgNumber" type="text" class="hidden" value="' . $nextFreeImgNumber . '">';
  //$res .= '<br>OLD imgNames: *' . $imgs . '* (Next free: ' . $nextFreeImgNumber . ')' . '<br>';
  return $res;
} */ /* getExistingImages */


/* is this in use? */
function getNextFreeImgNumberFromName($names) {
  $tempArr = explode(',', $names);
  $numArr = array();
  $num = '';
  $highest = '';
  for($a = 0; $a < count($tempArr); $a++) 
  {

    $numArr = explode('.', $tempArr[$a]); // 123_1.jpg
    $numArr = explode('_', $numArr[0]);
    if($a == 0) 
    { 
      $highest = $numArr[1]; 
    } else {
      if((int)($numArr[1]) > (int)$highest) { $highest = $numArr[1]; }
    }
  }
  $highest = ((int)$highest)+1;
  return $highest; // next free number
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  // $data = htmlspecialchars($data);
  $data = htmlspecialchars($data, ENT_NOQUOTES, "UTF-8");
  return $data;
}

function validLen($str, $min, $max)
{
    $len = strlen($str);
    if($len < $min)
    {
        ////return " is too short, minimum is $min characters ($max max)";
        //return " is too short, the length must be between $min - $max characters.";
        return FALSE;
    }
    elseif($len > $max)
    {
        //return " is too long, the length must be between $min - $max characters.";
        return FALSE;
    }
    return TRUE;
}

function verifyUserLoginData($email, $pw, $conn)
{
    // TODO: scramble email!!!
    $sql = "SELECT safeId,name FROM users WHERE email='$email' AND password='$pw'LIMIT 1";
    echo "<br>function verifyUserLoginData: login sql: " . $sql . "<br>";
    $result = mysqli_query($conn, $sql);
    if ($result)
    {
        while($row = mysqli_fetch_assoc($result))
        {
            return $row["safeId"] . '#' . $row["name"];
        }
    }
}
function doesEmailExistInDB($email, $conn)
{
    // TODO: scramble email!!!
    $sql = "SELECT id FROM users WHERE email='$email' LIMIT 1";
    // echo "<br>sql2: " . $sql . "<br>";
    $result = mysqli_query($conn, $sql);
    if ($result)
    {
        while($row = mysqli_fetch_assoc($result))
        {
            return $row["id"];
        }
    }
}
function lineErr($id) {
    return "<div id='err_$id' class='lineErr'></div>";
}
// UUSI
function getUserId($email, $conn)
{
    // TODO: scramble email!!!
    $sql = "SELECT id FROM users WHERE email='$email' LIMIT 1";
    // echo "<br>sql2: " . $sql . "<br>";
    $result = mysqli_query($conn, $sql);
    if ($result) {  while($row = mysqli_fetch_assoc($result)) {return $row["id"]; } }
}

function createUser($countryId, $langId, $email, $password, $conn)
{
    $userSinceDate = getCurrentDateAsYYMMDDHHMM();
    $active = true;
    $fields = "countryId,langId,email,password,userSinceDate,active";
    $values = $countryId . "," . $langId . "," . $email . "," . $password . "," . $userSinceDate . "," . $active;
  
    // TODO: scramble email!!!
    $sql = "INSERT INTO users (" . $fields . ") VALUES ('" . str_replace(",","','",$values) . "')";
    // echo "<br>sql2: " . $sql . "<br>";
      //echo '<br>INSERTING: ' . $sql;
      if ($conn->query($sql) === TRUE) {
          echo "Record inserted successfully.";
      } else {
           echo "Error inserting record: " . $conn->error; 
      }
      $conn->close();
}

/*


// -------------- SESSION --------------------
function saveInSession($name, $data) {
   $_SESSION[$name] =  $data;
}

function removeSession() {
  session_unset(); // remove all session variables
  session_destroy(); // destroy the session 
}

// saveCookie('quickRegister',$siteCountryCode,$langCode,$gender,$lookingForGender);
function saveCookie($name,$data)
{
  // NOTE! must appear before HTML tag!
  setcookie($name, $data, time() + (86400 * 90), "/"); // 86400 = 1 day
  // setcookie($cookieName, 'This is test cookie.', time() + (86400 * 90), "/"); // 86400 = 1 day
}

function getCookie($name) {
  if(isset($_COOKIE[$name])) { 
    return $_COOKIE[$name]; 
    // $siteCountryCode,$langCode,$gender,$lookingForGender
      // return $data; 
  } else {
    return false; 
  }
}

function deleteCookie($name) {
  setcookie($name, "", time() - 3600);
  echo '<br><br><br><br>DELETING COOKIE: ' . $name . '<br>';
}


*/


/*
function saveCookie($name,$data)
{
  // NOTE! must appear before HTML tag!
  setcookie($name, $data, time() + (86400 * 90), "/"); // 86400 = 1 day
  // setcookie($cookieName, 'This is test cookie.', time() + (86400 * 90), "/"); // 86400 = 1 day
}

function getCookie($name) {
  if(isset($_COOKIE[$name])) { 
    return $_COOKIE[$name]; 
    // $siteCountryCode,$langCode,$gender,$lookingForGender
      // return $data; 
  } else {
    return false; 
  }
}

function deleteCookie($name) {
  setcookie($name, "", time() - 3600);
  echo '<br><br><br><br>DELETING COOKIE: ' . $name . '<br>';
}

*/



function getCurrentDateAsYYMMDDHHMM($getWhat='') 
{
  // $now = new DateTime();
  // $timestring = $now->format('ymdHi'); // 'Y-m-d H:i:s'
  $res = '';
  $now = new DateTime();
  $now->setTimezone( new \DateTimeZone( 'Europe/Helsinki' ) ); // full list: http://php.net/manual/en/timezones.php
  switch ($getWhat) {
    case 'today': $res = $now->format('ymd'); break;
    case 'todayDayNum': $res = date('w'); break;
    case 'yesterday': $res = date('ymd', strtotime('-1 day')); break;
    case 'dayBeforeYesterday': $res = date('ymd', strtotime('-2 days')); break;
    case 'last3to7Dates':      
      for($a=-3;$a>-7;$a--) { $res .= date('ymd', strtotime($a." days")) . ','; }
      $res = substr($res, 0, strlen($res)-1); break;

    case 'dateData':
      $res = date('w'); // todayDayNum,today-1,...
      for($a=0;$a>-7;$a--) { $res .= ',' . date('ymd', strtotime($a." days")); }
      break; // today to -6 days 
    case 'plus90days': $res = date('ymd', strtotime('+3 months')); break;
    default: // today with hh:mm
      $res = $now->format('ymdHi'); break; // 'Y-m-d H:i:s'      
  }
  return $res;
}

function displayDbDate($dbDateYYMMDDHHMM,$getWhat='') {
  if($dbDateYYMMDDHHMM == NULL || $dbDateYYMMDDHHMM == 0) { return '(empty)'; } 
  //echo '<br>DATE HAS ' . strlen($dbDateYYMMDDHHMM) . ' DIGITS!';
    // if no time in string 20170501
  if(strlen($dbDateYYMMDDHHMM) == 8) { $dbDateYYMMDDHHMM = $dbDateYYMMDDHHMM . '00'; }
  if(strlen($dbDateYYMMDDHHMM) == 6) { $dbDateYYMMDDHHMM = '20' . $dbDateYYMMDDHHMM . '00'; }

  //echo '<br>CHANGED TO: ' . $dbDateYYMMDDHHMM . '<br>';
  $oldDate = new DateTime();
  $oldDate = DateTime::createFromFormat('ymdHi', $dbDateYYMMDDHHMM);  
  $weekdayName = getWeekdayName($oldDate->format('w'), "fi", "short"); // w - A numeric representation of the day (0 for Sunday, 6 for Saturday)

  switch ($getWhat) {
    case 'short': $newDate = ' ' . $oldDate->format('j.m H:i'); break;
    case 'days': $newDate = ' ' . $oldDate->format('j.m'); break;
    default: $newDate = ' ' . $oldDate->format('j.m.Y H:i'); break;
  }
  //$newDate = ' ' . $oldDate->format('j.m.Y H:i');
  return $newDate;
}
/*
function getTodaysDate() {
  $now = new DateTime();
  $now->setTimezone( new \DateTimeZone( 'Europe/Helsinki' ) ); // full list: http://php.net/manual/en/timezones.php
  return $now->format('y-m-d');
}
function getTodaysDateDB() {
  $now = new DateTime();
  $now->setTimezone( new \DateTimeZone( 'Europe/Helsinki' ) ); // full list: http://php.net/manual/en/timezones.php
  return $now->format('ymd');
}
function getTodaysDateLongDB() {
  $now = new DateTime();
  $now->setTimezone( new \DateTimeZone( 'Europe/Helsinki' ) ); // full list: http://php.net/manual/en/timezones.php
  return $now->format('ymdHis');
}
*/

function getWeekdayName($dayOfTheWeekInNum, $lang, $inLongFormat) 
{  
  Switch($lang)
  {
    case "fi": 
        $weekdayNamesFull = "Sunnuntai,Maanantai,Tiistai,Keskiviikko,Torstai,Perjantai,Lauantai";
        $weekdayNamesShort = "Su,Ma,Ti,Ke,To,Pe,La";
      break;
      // http://www.omniglot.com/language/time/days.htm
  }
  
    if($inLongFormat == "") { $weekdayNames = $weekdayNamesFull; } else { $weekdayNames = $weekdayNamesShort; }
    $weekdayNamesArr = explode(',', $weekdayNames);
    return $weekdayNamesArr[$dayOfTheWeekInNum];
}


/*
// pagination usage example:
$firstText = "Alkuun";
$prevText = "Edellinen";
$nextText = "Seuraava";
$lastText = "Loppuun";
$limit = 20;
$page = 1;
if (isset($_GET['p'])) { 
  $page = filter_input( INPUT_GET, 'p', FILTER_SANITIZE_URL ); }
  $thisPage = $page;
$start=($page-1)*$limit;
$totalItems = mysqli_num_rows(mysqli_query($conn,  "SELECT * FROM " . $table));
$totalPages = $totalItems/$limit;
*/
function showPagination($thisPage, $firstText, $prevText, $nextText, $lastText, $totalPages, $start, $page, $limit)
{ 
  $totalPages = ceil($totalPages);

  // INIT
  $linksVisibleTotal = 6;
  $bigResultTreshold = 100; // display first or last button when number of pages exceeds this number
    /*
            <div class="row listingFooter pagination">
              <button>« Förra sidan</button>
              <button class="selected">1</button>
              <button>2</button>
              <button>3</button>
              <button>4</button>
              <button>5</button>
              <button>6</button>
              <button>Nästa sida »</button>
              <button>Sista sidan</button>
            </div>


    echo '<br>thisPage: ' . $thisPage;
    echo '<br>firstText: ' . $firstText;
    echo '<br>prevText: ' . $prevText;
    echo '<br>nextText: ' . $nextText;
    echo '<br>lastText: ' . $lastText;
    echo '<br>totalPages: ' . $totalPages;
    echo '<br>start: ' . $start;
    echo '<br>page: ' . $page;
    echo '<br>limit: ' . $limit;
    */

    // echo '<br>totalPages: ' . $totalPages;

      
    $firstPageNum = 1; 
    $prevPageNum = $nextPageNum = null;
    $lastPageNum = $totalPages;
    $prevPageDisabled = $nextPageDisabled = '';


    if($page > 1) { $prevPageNum = $page-1; } else { $prevPageDisabled = ' hidden'; } 
    if($page < $totalPages) { $nextPageNum = $page+1; } else { $nextPageDisabled = ' hidden'; }
    $data = '';

    // pagination before
    //$data .= 'PAGINATION:';
    //$data .= '<div class="clearfix"></div>';
    //$data .= '<div class="row">';
    //$data .= '<div class="col-md-12 col-sm-12 col-xs-12" style="text-align:left;">';
    //$data .= '<nav aria-label="Page navigation example">';
    //$data .= '<ul id="pagination" class="justify-content-end">';

    
    /*
            <ul class="pagination listingFooter pagination"> 
              <li class="page-item"><span class="page-link" id="first">Första sidan</span></li>
              <li class="page-item disabled"><a class="page-link" tabindex="-1" href="index.php?p=">« Förra sidan</a></li>
              <li class="page-item active"><span class="page-link selected" id="p1">1</span></li>
              <li class="page-item"><span class="page-link" id="p2">2</span></li>
              <li class="page-item"><span class="page-link" id="p3">3</span></li>
              <li class="page-item"><span class="page-link" id="p4">4</span></li>
              <li class="page-item"><span class="page-link" id="p5">5</span></li>
              <li class="page-item"><span class="page-link" id="p6">6</span></li>
              <li class="page-item"><a class="page-link" href="index.php?p=2">Nästa sida »</a></li>
              <li class="page-item"><span class="page-link" id="last">Sista sidan</span></li>
              </ul>
    */

    if($totalPages > 0)
    {
      //if($prevPage == null) { $prevPageDisabled = ' hidden'; }; 
      //if($nextPage == null) { $nextPageDisabled = ' hidden'; };
      // extra button for really long lists
      
      
      // page numbers
      $displayPageId = 1;
      $endDisplayPageId = $linksVisibleTotal + 1;
      $visibleLinksCounter = 0;
      $page = (int)$page;
      $totalPages = (int)ceil($totalPages);
      $linksVisibleTotal = (int)$linksVisibleTotal;
      $nextPageLink = '';
      // display 3 numbers before and 3 after the current page number
      if($page > $linksVisibleTotal) 
      { 
        if($page < ($totalPages + 1 - $linksVisibleTotal)) 
        {
          $displayPageId = $page - 3;
          $endDisplayPageId =  $page + 4;
          $linksVisibleTotal = $linksVisibleTotal + $page; 
          //echo '<br>page: ' . $page;
          //echo '<br>displayPageId: ' . $displayPageId;
          //echo '<br>linksVisibleTotal: ' . $linksVisibleTotal;
        } else {
        //echo '<br>page (' . $page . ') is not less than  linksVisibleTotal: (' . $linksVisibleTotal . ')';
      }
      } else {
        //echo '<br>page (' . $page . ') is not over linksVisibleTotal: (' . $linksVisibleTotal . ')';
      }

      //echo '<br>endDisplayPageId: ' . $endDisplayPageId;
//  echo '<br>SHOWING: ' . $page . '/' . $totalPages;
      
      //// display dots before
      //if($displayPageId > 1) {  
      //  $data .= '<li class="page-item"><span class="page-link" id="dummy">...</span></li>';
      //  break; 
      //}

      // iterate display page number links
      for($displayPageId; $displayPageId < $endDisplayPageId; $displayPageId++)
      {
        //// display dots after 
        //if($displayPageId == $linksVisibleTotal+1) {  
        //  $data .= '<li class="page-item"><span class="page-link" id="dummy">...</span></li>';
        //  break; 
        //}
        $activePage = ''; if($displayPageId == $page) { $activePage = ' selected'; }
        // if($pId == $page) { $nextPageNum = $pId; }
        // A HREF LINKS
        ////$data .= '  <li class="page-item' . $activePage . '"><a href="' . $thisPage . '?p=' . $pId . '">' . $pId . '</a></li>';
        //$data .= '<li id="p' . $pId . '" class="page-item' . $activePage . '"><a class="page-link" href="' . $thisPage . '?p=' . $pId . '">' . $pId . '</a></li>';
        // NO A HREF LINKS - USE WITH AJAX
        // $data .= '<li class="page-item' . $activePage . '"><span class="page-link" id="p' . $pId . '">' . $pId . '</span></li>';
        $data .= '<li class="page-item"><span class="page-link' . $activePage . '" page="' . $displayPageId . '">' . $displayPageId . '</span></li>';

        $visibleLinksCounter++;
      }



      // $data .= '  <li class="page-item' . $nextPageDisabled . '"><span class="page-link" href="' . $thisPage . '?p=' . $nextPage . '">' . $nextText . '</span></li>';  // NEXT
      $nextPageLink = '  <li class="page-item' . $nextPageDisabled . '"><span id="nextPage" class="page-link" page="' . $nextPageNum . '">' . 'nextPage' . '</span></li>';  // NEXT 
      if($totalPages > $bigResultTreshold) 
      { 
        $data .= $nextPageLink;
        // last -button for big results
        $data .= ' <li class="page-item' . $nextPageDisabled . '"><span id="lastPage" class="page-link" page="' . $lastPageNum . '">' . 'lastPage' . '</span></li>'; // LAST
      } else {
        // display last page as number link
        $data .= '<li class="page-item"><span class="page-link" id="dummy">...</span></li>'; // dots
        $data .= '<li class="page-item"><span class="page-link" page="' . $totalPages . '">' . $totalPages . '</span></li>';
        $data .= $nextPageLink;
      } 
    } 



    // add first and pref links before pagination - note reverse order
    $data = '  <li class="page-item' . $prevPageDisabled . '"><span  id="previousPage" class="page-link" tabindex="-1" page="' . $prevPageNum . '">' . 'prevPage' . '</span></li>' . $data; // PREV
    if($totalPages > $bigResultTreshold) { 
    // first -button for big results
    $data = ' <li class="page-item' . $prevPageDisabled . '"><span id="firstPage" class="page-link" page="' . $firstPageNum . '">' . 'firstPage' . '</span></li>' . $data; 
    } // FIRST 
    $data = '<ul class="pagination listingFooter pagination">' . $data;


    // add after pagination
    $data .= '</ul>';
    // $data .= '</nav>';
    // $data .= '</div>';
    // $data .= '</div>';

    return $data;
}


function getGeoItems($geonameId, $url1, $url2, $id, $item, $topItemText, $preSelectedId, $langId) {
    $result = '';   
    $first = true;
    $url = $url1 . $geonameId . $url2; // . $langId;
    echo '<br>getGeoItems HAKU: ' . $url . '<br><br><br>';
    // echo '<br>functions 480: langId: ' . $langId . '<br><br><br>';
    // if($string = file_get_contents($url) == false) {
    // echo '<br><h3>Connectiong to geonames url FAILED</h3>';
    // }
    $string = file_get_contents($url);
    $jsonIterator = new RecursiveIteratorIterator(
      new RecursiveArrayIterator(json_decode($string, TRUE)),
      RecursiveIteratorIterator::SELF_FIRST);
    $nextGeonameId = '';
    foreach ($jsonIterator as $key => $val) {

      if(is_array($val)) {  
        if($first) { $first = false; continue; } // start from second item - skip empty first     
        if($nextGeonameId == '') { $nextGeonameId = $val[$id]; }
        if ($preSelectedId == $val[$id]) { $selectedText = ' selected'; } else { $selectedText = ''; }
        if($val[$id] != '661882') $result .=  '<option value="' . $val[$id] . '"' . $selectedText . '>' . $val[$item] . '</option>'; // ohita ahvenanmaa
      }
    }
    if(strlen($result) > 0) { if($topItemText != '') { $result = '<option value="-1">' . $topItemText . '</option>' . $result; } }
    // echo $result;
    return $nextGeonameId . '#' . $result;
  }

// updates in categories table
function updateTotalAds($id, $conn) {
  // get current totalAds
  $totalAds = '';
  $sql = "SELECT totalAds FROM categories WHERE id=$id LIMIT 1";
  //echo '<br>sql: ' . $sql;
  $result = mysqli_query($conn, $sql); 
  // if (mysqli_num_rows($result) > 0) 
  if($result)
  { 
    while($row = mysqli_fetch_assoc($result)) { $totalAds = $row["totalAds"]; }
  } else { $totalAds = '0'; }
  // if($totalAds == '') { $totalAds = 0; }
  $totalAds = (int)$totalAds;
  $totalAds++;
  $sql = "UPDATE categories SET totalAds=$totalAds WHERE id=$id";
  $conn->query($sql) or die("Error in updating totalAds (functions.php r1091): sql: $sql error: " . mysql_error());
}

// replace certain charactrs before saving in DB
function speChars($str) {
  $str = str_replace(" ", "&nbsp;", $str); // space

  //$str = str_replace("&", "&amp;", $str); // ampersand
  //$str = str_replace(",", "&comma;", $str);
  //$str = str_replace('"', "&quot;", $str); // double quote
  //$str = str_replace("'", "&#039;", $str); // single quote
  //$str = str_replace("<", "&lt;", $str); // less than   
  //$str = str_replace(">", "&gt;", $str); // greater than

  // $vowels = array("a", "e", "i", "o", "u", "A", "E", "I", "O", "U");
  //$onlyconsonants = str_replace($vowels, "", "Hello World of PHP");
  return $str;
}
?>