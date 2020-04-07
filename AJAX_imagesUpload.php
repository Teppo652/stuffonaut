<?php
/* https://www.codexworld.com/upload-multiple-images-using-jquery-ajax-php/ */

	$images_arr = array();
    foreach($_FILES['images']['name'] as $key=>$val){
        //display images without stored
        $extra_info = getimagesize($_FILES['images']['tmp_name'][$key]);
        $images_arr[] = "data:" . $extra_info["mime"] . ";base64," . base64_encode(file_get_contents($_FILES['images']['tmp_name'][$key]));
    }

    // sleep(3); // pause x seconds

    // Generate gallery view of the images
    $counter = 0;
    // $template1 = '<span class="imageActive"><img src="blocksUploaded/';
    $template1 = '<span class="imageActive"><img src="';
    $templateFiller = '<label for="image">Bilder</label><div style="clear:left"></div><span class="image"><span class="cameraIcon"></span><b>Välj bild</b></span><span style="width:40px;height:40px;float:left"></span>';
    $template2 = '"></span>';
    if(!empty($images_arr)){ 

        /* first image only */
        /* echo '<img src="' . $images_arr[0] . '" alt="">';  */ 
        

        /* multiple images */
        echo $templateFiller;
        foreach($images_arr as $image_src)
        { 
            /* <li><img src="<?php echo $image_src; ?>" alt=""></li> */
            echo $template1 . $image_src . $template2;
        } 
        // empty photo icons
        for($a=0; $a<5; $a++) {
            echo '<span class="imageInactive"><span class="cameraIcon inactive"></span></span>';
        }

    }
?>

<?php
/* =================================== functions ======================================== */
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