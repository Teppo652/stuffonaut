<?php 
include('blocks_functions.php');
// if (session_status() == PHP_SESSION_NONE) { session_start(); }
// $err = '';
// $siteCountryCode = 'EN';
// $langCode = 'EN';
// require_once('dating_functions.php'); 
// $conn = getDBConn('noWelcomeText');

// img reornanize test
/*


	 // with reorganize arrows
	 echo '<li id="1"><img src="uploads/test1.jpg" class="thumbnailImg" alt=""></li>';
	 echo '<li id="2"><img src="uploads/test2.jpg" class="thumbnailImg" alt=""></li>';
	 echo '<li id="3"><img src="uploads/test3.jpg" class="thumbnailImg" alt=""></li>';
	 echo '<li id="4"><img src="uploads/test4.jpg" class="thumbnailImg" alt=""></li>';
	 echo '<li id="5"><img src="uploads/test5.jpg" class="thumbnailImg" alt=""></li>';
	    	

*/

// include('../../../includes/dataFunctions.php');
// // require_once('dating_functions.php');
// include('dating_functions.php');
// //include('../../../includes/functions.php');
$conn = getDBConn('noWelcomeText');

//$userId = "1"; // TEMP




if (isset($_GET['userId']))
{
  	$userId = filter_input( INPUT_GET, 'userId', FILTER_SANITIZE_URL );
  	if (isset($_GET['images']))
	{
	  $images = filter_input( INPUT_GET, 'images', FILTER_SANITIZE_URL ); 
	}
}

// get old images from DB
$existingImgNames = '';
$nextFreeImgNumber = '';
// $sql = "SELECT profileImage FROM datingSite_users WHERE id=" . $userId . " LIMIT 1";
$sql = "SELECT profileImage FROM datingSite_users";

echo '<br>sql: ' . $sql . '<br>';
$result = mysqli_query($conn, $sql);
// if (mysqli_num_rows($result) > 0)
if($result)
{
   echo '<br>Found image';
   while($row = mysqli_fetch_assoc($result))
   {
      $existingImgNames =  $row["profileImage"];
      echo '<br>Found: ' . $existingImgNames;
      $nextFreeImgNumber = getNextFreeImgNumberFromName($row["profileImage"]);
   }
} else {
	$nextFreeImgNumber = '1';
   echo '<br>No old images found in DB<br>';
}
echo '<input id="nextFreeImgNumber" type="text" class="hidden" value="' . $nextFreeImgNumber . '">';
echo '<br>OLD imgNames: ' . $existingImgNames . ' (Next free: ' . $nextFreeImgNumber . ')' . '<br>';
// if($existingImgNames != '') { $imgNames = $existingImgNames . ',' . $imgNames; }
/*
<ul class="sortable-list">            
<li id="123_1.jpg"><img src="uploads/t_123_1.jpg" class="thumbnailImg" alt=""></li>
</ul>
*/






// save in DB - OLD
/*
$images = "";
if($userId != "")
{
	if($images != "")
	{
      $sql = "UPDATE funwithbox_users SET images='" . $images . "' WHERE id=" . $userId;
      echo '<br>UPDATING updateFieldsWithValues: ' . $updateFieldsWithValues . '<br>';
      if ($conn->query($sql) === TRUE) {
          echo "Record updated successfully.";
      } else {
          echo "Error updating record: " . $conn->error;
      }
      $conn->close();
    }
    // auto forward to next page
}
*/


?>
<!DOCTYPE html>
<html>
<head>
    <title>Test</title>
    <meta charset="utf-8" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/i18n/jquery-ui-i18n.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/3.51/jquery.form.js"></script>

    <style src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"></style>
    <style src="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css"></style>


	<script type="text/javascript">

	
	$(document).ready(function(){

		// upload image(s)
		/* http://www.codexworld.com/upload-multiple-images-using-jquery-ajax-php/ */
		$('#images').on('change',function(){
			$('#multiple_upload_form').ajaxForm({
				//display the uploaded images
				target:'#images_preview',
				beforeSubmit:function(e){
					$('.uploading').removeClass('hidden');
				},
				success:function(e){
					$('.uploading').addClass('hidden'); 
					$('#multiple_upload_form').addClass('hidden');
					//$('#images2').removeClass('hidden');

					// $( '<input type="file" name="images[]" id="images2" multiple="">' ).appendTo( $( "#multiple_upload_form" ) );


					/* $('#images').addClass('hidden'); */
					
					$('#images_preview ul').addClass('sortable-list');

				},
				error:function(e){
				}
			}).submit();
		});

		// save imageNames into DB   - allImgs
		$('#save').on('click',function(e){
			e.preventDefault();
			// alert('saving img names'); // /* ?> onclick="return confirm('Confirm quotation?');" < ?php */
			var imgNames = $('#allImgs').val(); // '1,2,3,4,5'; // AJAX_saveImageNames.php?imgNames=44,45&pUId=1
			var nextFreeImgNumber = $('#nextFreeImgNumber').val();
			alert('saving images: ' + imgNames);
			$.ajax({
			      url: "AJAX_saveImageNames.php?imgNames=" + '' + imgNames + '&nextFreeImgNumber=' + nextFreeImgNumber,
			      type: "post",
			      data: { 
					imgNames
			      },
			      success: function (data) {
					alert('AJAX returned: ' + data);
			  		// $( "#saveStatus" ).html(data);
			      },
			      error: function (xhr, status, errorThrown) { 
					alert('err in saving');
			        alert('ERROR: ' + errorThrown); 
			        alert('ERROR: ' + xhr.responseText); 
			      }
			    });
		}); // on click 

		/*
		$('#save').on('click',function(e){
			e.preventDefault();
			alert('saving img names'); 
			var imgNames = '1,2,3,4,5';
			$.ajax({
			  type: "GET",
			  url: "AJAX_saveImageNames.php?names=" + imgNames + '&pUId=1'
			  },
				success:function(e){
					alert('saved');
				},
				error:function(e){
					alert('err in saving');
				})
		});
		*/

			/*
			$('#multiple_upload_form').ajaxForm({
				//display the uploaded images
				target:'#images_preview',
				beforeSubmit:function(e){
					$('.uploading').removeClass('hidden');
				},
				success:function(e){
					$('.uploading').addClass('hidden'); 
					$('#multiple_upload_form').addClass('hidden');
					//$('#images2').removeClass('hidden');

					// $( '<input type="file" name="images[]" id="images2" multiple="">' ).appendTo( $( "#multiple_upload_form" ) );


					
					
					$('#images_preview ul').addClass('sortable-list');

				},
				error:function(e){
				}
			}).submit();
		*/

		/*
		$('.sortable-list').sortable({
					  connectWith: '.sortable-list',
					  update: function(event, ui) {
					    var changedList = this.id;
					    var order = $(this).sortable('toArray');
					    var positions = order.join(';');

					    alert({
					      id: changedList,
					      positions: positions
					    });
					  }
					});
		*/

	}); // doc ready


/*
	          $("#container_image").PictureCut({
                  InputOfImageDirectory       : "image",
                  PluginFolderOnServer        : "/jquery.picture.cut/",
                  FolderOnServer              : "/uploads/",
                  EnableCrop                  : true,
                  CropWindowStyle             : "Bootstrap"
              });
*/
	</script>
	<style>
		.thumbnails {
			position: relative;
		}
		.thumbnailImg {
			display: block;
			 max-width:230px;
			 max-height:230px;
			 width: auto;
			 height: auto;

		    border: solid 1px lightgray;
		    padding: 8px;
		    border-radius: 4px;
		}
		.thumbnailImg:hover {
		    border: solid 1px gray;
		}
		img.selectedImg:hover {
		    border: solid 2px green; 
		}
		img.selectedImg {
		    border: solid 2px red;
			/*
			width: 230px;
			border: solid 1px red;
			height: 32px;
			position: fixed;
			background-color: red;
			*/
			/*
			width: 270px;
		    border: solid 2px red;
		    height: 32px;
		    position: fixed;
		    background-color: red;
		    padding-left: -20px;
		    padding: 7px;
		    text-align: center;
		    text-transform: uppercase;
		    text-decoration: none;
    		*/
		}
		@media screen and (max-width: 600px) { 
			li { float: left; }
		}
		.btn { background-color: default; } /* WARNING */
		.activeDelButton { background-color: red !important; }

		.previewAllImages { border: solid 1px red; }
	</style>
</head>
<body class="container">


<?php

$userId = '123';

?>
<!--
	<div id="container_image"></div>        
    <div class="row">		
-->
    <br><br><br>
    	TODO:
    	<br>-save imagenames to DB
    	<br>-get number of current user images
    	<br>-check image filetype
    	<br>-check image size
    	<br>-delete user delted images FROM DB!
	    <br>-enable changing order of images
	    <br>-check if image already exists? ei coi koska nimet erit
    	<br><br>	
		<form method="post" name="multiple_upload_form" id="multiple_upload_form" enctype="multipart/form-data" action="AJAX_upload.php?uId=<?php echo $userId; ?>">
			<input type="hidden" name="image_form_submit" value="1"/>
			<label>Upload images (max 10)</label>
			<input type="file" name="images[]" id="images" multiple >
			<div class="uploading">
				<label>&nbsp;</label>
				<img class="uploading hidden" src="uploading.gif" alt="uploading......"/>
			</div>
		</form>
    </div>
    <button id="deleteImgs" class="btn"><i class="fa fa-trash"> Delete selected OLD</i></button><!-- new -->
	<button id="save" class="btn" onclick="return confirm('Are you sure?');"><i class="fa fa-save"> Save images</i></button>
	<!--<div class="gallery-bg"><div class="gallery">-->
		<div id="images_preview"> </div><!-- class="fotorama" -->
	<!--</div></div>-->

	<!-- UUSI TEST - SHOW OLD IMAGES FROM DB
	<button id="deleteImgs" class="btn"><i class="fa fa-trash"> Delete selected OLD</i></button>--><!-- new -->
	<ul id="previewAllImages" class="sortable-list">    
	<?php
		$existingImgNamesArr = explode(',', $existingImgNames);
		if($existingImgNames != '') {
			for($a = 0; $a < count($existingImgNamesArr); $a++) {
	    		// echo '<li id="' . $existingImgNamesArr[$a] . '"><img src="uploads/' . $existingImgNamesArr[$a] . '" class="thumbnailImg" alt=""></li>';
	    		// with reorganize arrows
	    		echo '<li id="' . $existingImgNamesArr[$a] . '"><img src="uploads/' . $existingImgNamesArr[$a] . '" class="thumbnailImg" alt=""></li>';
	    	}
    	}
	?>        
		<!--<li id="123_1.jpg"><img src="uploads/t_123_1.jpg" class="thumbnailImg" alt=""></li>-->
	</ul>

	
	
	<?php

	
	// upload images
	/*
    $images_arr = array();
    // if($_FILES['images'])
	if (!empty($_FILES['images']))
    {
    	//echo '<div class="thumbnails"><ul class="sortable-list">';    	 
	 // foreach($_FILES['images']['name'] as $key=>$val){
	    foreach($_FILES['images']['name'] as $key => $value){
	        //upload and stored images
	        $target_dir = "uploads/";
	        $target_file = $target_dir.$_FILES['images']['name'][$key];

	        // Get the extension
			$ext = strtolower(pathinfo($_FILES["images"]["name"][$name], PATHINFO_EXTENSION));
			// check extension and upload
			if( in_array( $ext, array('jpg', 'jpeg', 'png', 'gif', 'bmp'))) 
			{
		        if(move_uploaded_file($_FILES['images']['tmp_name'][$key],$target_file)){
		            // $images_arr[] = $target_file;
		        	echo '<li><a href="#"><img src="<?php echo $targetPath; ?>" alt="" /></a></li>';
		        }
		    } else { echo '<br>Some file(s) are of right file type. Allowed types are: jpg, jpeg, png, gif and bmp.'; }
	    }
	    //echo '</ul></div>';

		// show images
		/*
		echo '<br><br><br><br><br><br><br><div class="thumbnails"><ul>';
		if(!empty($images_arr)){ 
	    foreach($images_arr as $image_src){ ?>
	     
	           <!--   <li> -->

	                <!-- <img src="<?php echo $image_src; ?>" alt="">
	                <img src="<?php echo $image_src; ?>" alt=""> -->
	                <li><a href="#"><img src="<?php echo $image_src; ?>" alt="" /></a></li>
	            
	         <!--   </li> -->         
		<?php }
		} 
		echo '</ul></div>';
		*/
//	} // not empty
?>
</div>
<style>

.thumbnails {
  background: #333;
  width: 900px;
  margin: 0 auto;
  overflow: auto;
}
.uploading {
	width:  38px;
	height: 38px;
}
.hidden {
	display: none;
}
ul {
  list-style-type: none;
}
 
li img {
  float: left;
  margin: 10px;
  border: 5px solid #fff;
 
  -webkit-transition: box-shadow 0.5s ease;
  -moz-transition: box-shadow 0.5s ease;
  -o-transition: box-shadow 0.5s ease;
  -ms-transition: box-shadow 0.5s ease;
  transition: box-shadow 0.5s ease;
}
 
li img:hover {
  -webkit-box-shadow: 0px 0px 7px rgba(255,255,255,0.9);
  box-shadow: 0px 0px 7px rgba(255,255,255,0.9);
}
</style>



<style>
.gallery-bg {width: 610px;background-color: #F9D735;border-radius:4px;}
	#gallery{padding: 10px;text-align:center;font-weight: bold;color: #C0C0C0;background-color: #F0E8E0;overflow:auto;border-top-left-radius:4px;border-top-right-radius:4px;}
	#gallery img{padding: 20px;}
	#uploadFormLayer{padding: 10px;}
	.btnUpload {background-color: #3FA849;padding:5px 20px;border: #3FA849 1px solid;color: #FFFFFF;border-radius:4px;}
	.inputFile {padding: 4px;background-color: #FFFFFF;border-radius:4px;}
	.txt-subtitle {font-size:1.2em;}
</style>

</body>
</html>
<?php
// ------------------------------- function ---------------------------------------

/*
// moved to functions
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
*/ 
?>