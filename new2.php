<?php
$thisPage = 'new2.php';
include_once('functions.php');
include_once('header.php');
$conn = getDBConn();
/* ============================================== post ================================================= */

$adId = $userSafeId = "";
if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST')
{
  	if(isset($_POST["adId"])) { 
		$adId = test_input($_POST["adId"]); 
	}
  	if(isset($_POST["sId"])) { 
		$userSafeId = test_input($_POST["sId"]); 
	}
} else { 
	echo 'Something went wrong. Can not upload images.';
	exit; 
}
//$adId = '1'; // TESTING

/*
// update
updateInDb('ads',$adFields, $adsValues," WHERE id=$selectedId",$conn);
*/

?>
<!-- ============================================== create new ad -form ================================================= -->
<div class="bg">
		<div class="content">

			<div class="row">
				<div class="col m9">
					<div  class="row iCol2">

						<h1 id="addNewPageTitle" style="margin:0">Bilder</h1>

		                <!-- profile image upload form -->
		                <form method="post" id="uploadForm" name="uploadForm" enctype="multipart/form-data" action="AJAX_profileImgUpload.php?adId=<?php echo $adId; ?>">  <!-- onsubmit="return validateImgUpload()"> -->
		                	<!-- new look -->
		                	<!-- images - first image is shown in listing -->
							<div class="col m12" style="margin-left:17px">
								<!--
								<label id="imagesTitle" for="image">Bilder</label>
								<div style="clear:left"></div>
								<span class="image"><span class="cameraIcon"></span><b>Välj bild</b></span>
								<span style="width:40px;height:40px;float:left"></span>
								
								<span class="imageInactive"><span class="cameraIcon inactive"></span></span>
								<span class="imageInactive"><span class="cameraIcon inactive"></span></span>
								<span class="imageInactive"><span class="cameraIcon inactive"></span></span>
								<span class="imageInactive"><span class="cameraIcon inactive"></span></span>
								<span class="imageInactive"><span class="cameraIcon inactive"></span></span>
								-->
		<!--<input id="images" name="images" type="hidden">-->
							<!--	<div id="extraImagesText" class="hidden" style="color:#989898">Extrabilder ingår för företag</div>
							</div>-->



		                	<!-- old look -->
		                    <!--<div class="row" style="padding:0">-->
		                        <div id="imagesPanel" class="col m12 _noPadding">
		                            <b id="profileImageSubtitle">Bilder</b>
		                            <input id="userProfileImage" type="hidden" value=""> 
		                            <p id="profileImageText">Max 6 bilder (max 200 kb, jpg/png/jpeg/gif) </p>

		                            <label class="fileContainer">
		                                <!--<button id="addImagesBtn">Add images</button>-->
		                                <button id="addImagesBtn"><span class="uploadIcon"></span>Add images</button>
		                                <input type="file" name="images[]" id="images" multiple >
		                            </label><button id="deleteImagesBtn" class="hidden">Remove images</button>

		                            <!--<input type="file" name="images[]" id="images" multiple >-->
		                            <!--<input id="uploadProfileImageBtn" class="xxx" type="submit" name="submit" value="Tallenna kuva"/> -->
		                            
		                            <!--<div id="uploadStatus"></div>-->
		                            <!--<div id="uploadStatus"><img class="rotate" src="img/loading-process.png"/></div>-->
		                        </div> 
		                        <div class="col m12 _noPadding">
		                            <span id="imagesPreview"><!--
		                            	<span class="imageInactive"><span class="cameraIcon inactive"></span></span>
		                            	<span class="imageInactive"><span class="cameraIcon inactive"></span></span>
										<span class="imageInactive"><span class="cameraIcon inactive"></span></span>
										<span class="imageInactive"><span class="cameraIcon inactive"></span></span>
										<span class="imageInactive"><span class="cameraIcon inactive"></span></span>
										<span class="imageInactive"><span class="cameraIcon inactive"></span></span>-->
										<span class="imageInactive"><span class="cameraIcon inactive"></span></span>
		                            	<span class="imageInactive"><span class="cameraIcon inactive"></span></span>
										<span class="imageInactive"><span class="cameraIcon inactive"></span></span>
										<span class="imageInactive"><span class="cameraIcon inactive"></span></span>
										<span class="imageInactive"><span class="cameraIcon inactive"></span></span>
										<span class="imageInactive"><span class="cameraIcon inactive"></span></span>
		                        	</span>

		                            <div id="uploadStatus"></div>
		                            <span class="imgUploadingIcon hidden"></span>
		                        </div> 
		                    </div>
		                </form>
<?php
$nextPageForm = <<<EOT
						<form class="row" action="payment.php" method="post">
							<input type="hidden" name="adId" value="$adId">
							<input type="hidden" name="sId" value="$userSafeId">

							<div class="col m12" style="margin-left:15px">
								 <input type="submit" id="saveButton"								 
EOT;

$confirmContinue = ''; // ' onclick="return confirm(\'Are you sure you are finished with uploading images?\');" ';
/*
on continue click:
mainImgName.val == '' then show confirm msg
*/
$nextPageForm2 = <<<EOT
 value="Continue to payment">
							</div>
						</form>
EOT;


echo $nextPageForm . $confirmContinue . $nextPageForm2;
echo "<br>adId: $adId";
echo "<br>userSafeId: $userSafeId";

?>







					</div>
				</div> <!-- END single ad -->

				<!-- ========================================= SIDE BANNER AREA ========================================== -->				
				<div class="col m3">
					<h2>Right side</h2>
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

		</div>
	</div>

<!-- hidden settings -->
<input id="phpPageName" type="hidden" value="new2"> 
<!-- <input id="currentSingleAd" type="hidden">-->

<?php include_once('footer.php'); ?>