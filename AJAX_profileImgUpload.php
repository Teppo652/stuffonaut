<?php
include_once('functions.php');
$conn = getDBConn();
$data = array();

// get the id of just saved ad - TODO: change into safeID!!!!!!!!!!
if (isset($_GET["adId"])) { 
    $adId = filter_input( INPUT_GET, "adId", FILTER_SANITIZE_URL ); 
} else {
    echo '<br>Something went wrong.'; exit;
}

//$adId = '1'; // TESTING

$images_arr = array();
$imageCounter = 1;
$err = null;
$saveFileName = $saveFileName = '';
$allImgDbNamesArr = array();
foreach($_FILES['images']['name'] as $key=>$val){
    $size       = $_FILES['images']['size'][$key];
    $type       = $_FILES['images']['type'][$key];
    
    // file upload path
    $fileName = basename($_FILES['images']['name'][$key]);
    $pathAndName = $imgUpload_savePath . $fileName;
    
    
    $fileType = pathinfo($pathAndName,PATHINFO_EXTENSION);
    //$saveFileName = $adId . '_' . $imageCounter . '.' . $fileType; // rename images in filesystem as 555_1.jpg
    $saveDbName = $imageCounter . '.' . $fileType; // name images in DB as 1.jpg
    $pathAndName = $imgUpload_savePath . $adId . '_' . $imageCounter . '.' . $fileType; // rename images in filesystem as 555_1.jpg
    if(in_array($fileType, $imgUpload_allowedTypes)) { 
        if($size < $imgUpload_maxFileSize) {
            if(move_uploaded_file($_FILES['images']['tmp_name'][$key], $pathAndName)) {
                // save image in filesystem
                $images_arr[] = $pathAndName;
                array_push($allImgDbNamesArr, $saveDbName); 
            }
        } else {
        // filesize exceeds the allowed size
            $err .= "<li class='imageInactive uploadErr'>$fileName <br>(size: " . (int)$size/1000 . " kb) exceeds the allowed filesize <br>(" . (int)$imgUpload_maxFileSize/1000 . " kb)";
        }
    
    } else {
        // filetype is not within allowed types
        $err .= "<li class='imageInactive uploadErr'>We are sorry,<br>$fileName <br>has a filetype that is not allowed.<br>Allowed types are: <br>." . implode($imgUpload_allowedTypes, ' .');
    } // if in array $allowedTypes
    $imageCounter++;
}

// show errors
if($err) {
    // all images were not valid, no images uploaded
    echo "<p class='error'>$err</p>";
} else {
    // show uploaded images
    if(!empty($images_arr)){
        updateImageNamesInDb($adId, '', $allImgDbNamesArr,$conn); 
        $counter = 0;
        $isMainImage = $isHidden = '';
        foreach($images_arr as $image_src){
            if($counter == 0) { 
                $isMainImage = ' isMainImage'; 
                $isHidden = ''; 
            } else { 
                $isMainImage = ''; 
                $isHidden = ' hidden'; 
            }
            //echo '<span class="imageInactive"><img src="' . $image_src . '" alt=""></span>';
            echo '<span class="imageInactive'.$isMainImage.'"><img src="' . $image_src . '" alt=""></span><span class="mainImageIcon'.$isHidden.'"></span>';
            $counter++;
        }
        //echo "<div style='clear:left;float:left'>" . "<br>Thank you!<br>Your ad has been submitted, it will be visible after it has been checked.<br>" .  "<a class='button' href='blocket_index.php?id=$adId'>View your ad</a>";    
    }

} 

/*
----------------------------
<?php
// https://www.codexworld.com/upload-multiple-images-using-jquery-ajax-php/ 

if(isset($_POST['submit'])){
    // File upload configuration
    $targetDir = "uploads/";
    $allowTypes = array('jpg','png','jpeg','gif');
    
    $images_arr = array();
    foreach($_FILES['images']['name'] as $key=>$val){
        $image_name = $_FILES['images']['name'][$key];
        $tmp_name   = $_FILES['images']['tmp_name'][$key];
        $size       = $_FILES['images']['size'][$key];
        $type       = $_FILES['images']['type'][$key];
        $error      = $_FILES['images']['error'][$key];
        
        // File upload path
        $fileName = basename($_FILES['images']['name'][$key]);
        $targetFilePath = $targetDir . $fileName;
        
        // Check whether file type is valid
        $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
        if(in_array($fileType, $allowTypes)){    
            // Store images on the server
            if(move_uploaded_file($_FILES['images']['tmp_name'][$key],$targetFilePath)){
                $images_arr[] = $targetFilePath;
            }
        }
    }
    
    // Generate gallery view of the images
    if(!empty($images_arr)){ ?>
        <ul>
        <?php foreach($images_arr as $image_src){ ?>
            <li><img src="<?php echo $image_src; ?>" alt=""></li>
        <?php } ?>
        </ul>
<?php }
}

// =================================== functions ======================================== 
function saveImgName() {
$conn = getDBConn('noWelcomeText');
$table = "free_events";
$existingImgNames = '';
$imgNames = '';
$userId = '13'; // REMOVE!

// read old imagenames and add new ones into it (if not over limited number images)

if (isset($_GET['imgNames'])) 
{
  $imgNames = filter_input( INPUT_GET, 'imgNames', FILTER_SANITIZE_URL );
  $imgNames = removeDummies($imgNames);
    // save old and new images in DB
    $sql = "UPDATE $table SET images='" . $imgNames . "' WHERE id=" . $userId;
    //echo '<br>sql: ' . $sql . '<br>';
    if ($conn->query($sql) === TRUE) 
    {
            echo "Record updated successfully.";
        } else {
            echo "Error updating record: " . $conn->error; 
        }
        $conn->close();
    } //else { echo '<br>Err: imgNames not set'; }
}
?>




------------------------------




<?php
include_once('blocks_functions.php');
$conn = getDBConn();
$data = array();

// get the id of just saved ad
if (isset($_GET["adId"])) { 
    $adId = filter_input( INPUT_GET, "adId", FILTER_SANITIZE_URL ); 
} else {
    echo '<br>Something went wrong.'; exit;
}

$images_arr = array();
$imageCounter = 1;
$err = null;
$saveFileName = $saveFileName = '';
$allImgDbNamesArr = array();
foreach($_FILES['images']['name'] as $key=>$val){
    $size       = $_FILES['images']['size'][$key];
    $type       = $_FILES['images']['type'][$key];
    
    // file upload path
    $fileName = basename($_FILES['images']['name'][$key]);
    $pathAndName = $imgUpload_savePath . $fileName;
    
    
    $fileType = pathinfo($pathAndName,PATHINFO_EXTENSION);
    //$saveFileName = $adId . '_' . $imageCounter . '.' . $fileType; // rename images in filesystem as 555_1.jpg
    $saveDbName = $imageCounter . '.' . $fileType; // name images in DB as 1.jpg
    $pathAndName = $imgUpload_savePath . $adId . '_' . $imageCounter . '.' . $fileType; // rename images in filesystem as 555_1.jpg
    if(in_array($fileType, $imgUpload_allowedTypes)) { 
        if($size < $imgUpload_maxFileSize) {
            if(move_uploaded_file($_FILES['images']['tmp_name'][$key], $pathAndName)) {
                // save image in filesystem
                $images_arr[] = $pathAndName;
                array_push($allImgDbNamesArr, $saveDbName); 
            }
        } else {
        // filesize exceeds the allowed size
            $err .= "<li class='imageInactive uploadErr'>$fileName <br>(size: " . (int)$size/1000 . " kb) exceeds the allowed filesize <br>(" . (int)$imgUpload_maxFileSize/1000 . " kb)";
        }
    
    } else {
        // filetype is not within allowed types
        $err .= "<li class='imageInactive uploadErr'>$fileName <br>is not allowed filetype.<br>Allowed types are: <br>." . implode($imgUpload_allowedTypes, ' .');
    } // if in array $allowedTypes
    $imageCounter++;
}

// show errors
if($err) {
    // all images were not valid, no images uploaded
    echo "<p class='error'>$err</p>";
} else {
    // show uploaded images
    if(!empty($images_arr)){
        updateImageNamesInDb($adId, $allImgDbNamesArr,$conn); 
        foreach($images_arr as $image_src){
            echo '<span class="imageInactive"><img src="' . $image_src . '" alt=""></span>';
        }
        echo "<div style='clear:left;float:left'>" . "<br>Thank you!<br>Your ad has been submitted, it will be visible after it has been checked.<br>" .  "<a class='button' href='blocket_index.php?id=$adId'>View your ad</a>";    
    }

} 
?>

*/
?>