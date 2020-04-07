			<span id="pageLoader" class="hidden pageLoader">
				<span class="pageLoaderImg"></span>
			</span> 
			

        </div>
    </div>
  </div>
			<footer class="row">
				<div id="infoModal" class="modal" style="display:none"></div>
				<!--
				<div style="float:left">
					<small>&copy; Copyright 2019, Angry Group, Ltd. All Rights Reserved</small>
				</div>

				<div style="float:left">
					<a href="terms.php" target="_blank" style="text-align:center">Användarvillkor och personuppgiftshantering</a>
				</div>

				<div style="float:right"><small
					Icons made by <a href="https://www.flaticon.com/authors/smashicons" title="Smashicons">Smashicons</a> from <a href="https://www.flaticon.com/" 			    title="Flaticon">www.flaticon.com</a> is licensed by <a href="http://creativecommons.org/licenses/by/3.0/" title="Creative Commons BY 3.0" target="_blank">CC 3.0 BY</a>
				</small></div>
				</div>
				-->
				<br>
				<div class="row">
					<!-- left -->
					<div class="col m3 _noPadding">
						Contact
					</div>
					<!-- middle -->
					<div class="col m6 _noPadding">
						<small>
							<span style="text-align:center">
								<!--
							<a href="termsOfService.php" target="_blank">Användarvillkor</a> och <a href="privacyPolicy.php" target="_blank">personuppgiftshantering</a><span><br>-->

							<a href="termsOfService.php" target="_blank" class="termsOfService">[termsOfService]</a>
							<span class="terms_and">[and]</span>
							<a href="privacyPolicy.php" target="_blank" class="privacyPolicy">[privacyPolicy]</a><br>

							&copy; Copyright 2019, Angry Group, Ltd. All Rights Reserved<br>
							Icons made by <a href="https://www.flaticon.com/authors/smashicons" title="Smashicons">Smashicons</a> from <a href="https://www.flaticon.com/" 			    title="Flaticon">www.flaticon.com</a> is licensed by <a href="http://creativecommons.org/licenses/by/3.0/" title="Creative Commons BY 3.0" target="_blank">CC 3.0 BY</a>
							<br>
							Vectors graphics designed by <a href="https://www.freepik.com">Freepik</a>
						</small>
					</div>

					<!-- right -->
					<div class="col m3 _noPadding">
						<script type="text/javascript"> //<![CDATA[
						  var tlJsHost = ((window.location.protocol == "https:") ? "https://secure.trust-provider.com/" : "http://www.trustlogo.com/");
						  document.write(unescape("%3Cscript src='" + tlJsHost + "trustlogo/javascript/trustlogo.js' type='text/javascript'%3E%3C/script%3E"));
						//]]></script>
						<script language="JavaScript" type="text/javascript">
						  TrustLogo("https://www.positivessl.com/images/seals/positivessl_trust_seal_md_167x42.png", "POSDV", "none");
						</script>
					</div>
				</div>


			</footer>

		    <?php
		    /* ----------- login & logout -----------
			$loggedIn='';
			if (isset($_GET['loggedIn']))
			{
			  $loggedIn = filter_input( INPUT_GET, 'loggedIn', FILTER_SANITIZE_URL );
			  if($loggedIn == '1') {  } 
			}

		    if($action == 'login' && isset($_SESSION['user'])) {
		    	// is logged in
		    	 echo '<br>isLoggedIn<span id="isLoggedIn">1</span>'; //  infoText_loggedIn_text
		    } else if($action == 'logout') {
		    	// is logged out 
		    	 echo '<br>isLoggedOut<span id="isLoggedOut">1</span>'; // infoText_loggedOut_text
		    } 
		    */
		    ?>



			<!-- ------------------- HIDDEN FIELDS ------------------- -->

			<!-- often needed values -->
			<input id="isDebug" type="hidden" value="1">
			<br><input id="cat1_text" type="hidden">
			<?php if(getCurrentFileName() == 'index.php') { ?>
				<br>cat2:<input type="hidden" id="cat2">
			<?php } ?>
			<br>cat2_text:<input type="hidden" id="cat2_text">

			<br>currentSingleAd:<input id="currentSingleAd" type="text">
			<!--
			<br><div id="todayDayNum" class="hidden"><?php echo getCurrentDateAsYYMMDDHHMM('todayDayNum'); ?></div>
			<br><div id="today" class="hidden"><?php echo getCurrentDateAsYYMMDDHHMM('today'); ?></div>
			<br><div id="yesterday" class="hidden"><?php echo getCurrentDateAsYYMMDDHHMM('yesterday'); ?></div>
			<br><div id="dayBeforeYesterday" class="hidden"><?php echo getCurrentDateAsYYMMDDHHMM('dayBeforeYesterday'); ?></div>
			<br><div id="last3to7Dates" class="hidden"><?php echo getCurrentDateAsYYMMDDHHMM('last3to7Dates'); ?></div>
			-->
			
			<br><div id="dateData" class="hidden"><?php echo getCurrentDateAsYYMMDDHHMM('dateData'); ?></div>

			
			

		<!-- ================== translations ================== -->
		<div class="hidden">
			<!-- ------------- header ------------- -->
			<br><span id="infoText_loggedIn_text">You are logged in</span>
			<br><span id="infoText_loggedOut_text">You are logged out</span>
			<!-- ------------- index page ------------- -->
			<!-- frequently needed translations - set once from translation file -->
			<!--<input id="headerTitleAllAds" type="text" value="Alla annonser"> comes from translation json -->
			<br><span id="select_allCategories_text">[Alla kategorier]</span>

			<br>[Alla områden]:<span id="select_allAreas_text">[Alla områden]</span>
			<br><span id="select_text">[Välj...]</span> <!-- first item in areas selects -->
			<!-- Alla kategorier i Stockholm — 5798 annonser -->
			<br><span id="selectedCat1Name_text">[Alla kategorier i]</span>
			<!-- extra criteria -->
			
			<br>translations:<input type="text" id="translations"></input>




			<!-- breadcrumbs 
			<br><span id="breadcrumbs_allAds_text">[Alla annonser]</span>-->
			<br><span id="breadcrumbs_allAdsShort_text">[Alla]</span>
			<br><span id="breadcrumbs_numberOfAds_text">[annonser]</span>
			<!-- pagination 
			<br><span id="firstPage_text">[Första sidan</span>
  			<br><span id="previousPage_text">[« Förra sidan</span>
  			<br><span id="nextPage_text">[Nästa sida »</span>
  			<br><span id="lastPage_text">[Sista sidan"</span>
  			-->
			<!-- ------------- single ad page ------------- -->
			<br><span id="viewAd_showPhone_text">[Visa telefon]</span>
			<br><span id="viewAd_showEmail_text">[Visa epost]</span>

			<br><span id="viewAd_saveInFavorites_text">[Spara]</span>
			<br><span id="viewAd_editAd_text">[Ta bort,ändra, förnya]</span>
			<br><span id="viewAd_useShipping_text">[Skicka med Stuffonaut paketet]</span>
			<br><span id="viewAd_contract_text">[Köpekontrakt]</span>
			<br><span id="viewAd_reportAd_text">[Anmäl]</span>
			<!-- ------------- new page ------------- -->
			<br><span id="error_isCompulsory_text">*[Obligatorisk]*</span>
			<br><span id="charsLeft_text">*[Tecken kvar]</span>
			
			<!-- -------------- users favorite ads -----------  -->
			<br>users favorites:<span id="usersFavoriteAds"></span>
		</div>
			<!-- -------------- login & logout - moved to header -------------- -->
			
			<br>userSafeId:<span id="userSafeId" class="XXXXhidden"><?php echo $userSafeId; ?></span>
<?php
		/* ================== hidden values ================== */

				

				

				/* -------------- user info --------------- 
				this is now echoed from php
				echo 'userSafeId: <input type="text" style="width:150px" id="userSafeId">';
				echo 'userName: <input type="text" style="width:150px" id="userName">';
				echo ' <input type="text" style="width:150px" id="pref1">';
				echo ' <input type="text" style="width:150px" id="pref2">';
				echo ' <input type="text" style="width:150px" id="pref3">';
				*/
			
				/* -------------- users location --------------- */
			echo '<span class="XXXhidden">';
			   // echo ' <input type="text" style="width:150px" id="geonameid2" value="660013">'; // Finland
			   /* the following are determined automatically by user's lng lat location on earth */
			   echo ' <input type="text" style="width:150px" name="timeZone" id="timeZone">'; /* user's countrys timezone */
			   echo ' <input type="text" style="width:150px" name="currencyCode" id="currencyCode">'; /* user's countrys currrency */
			   echo ' <input type="text" style="width:150px" name="languages" id="languages">'; /* official languages in user's country */
			   echo ' <input type="text" style="width:150px" name="langCode" id="langCode">'; /* default language in user's country */
			   /*  value="sv" */

			   echo ' <input type="text" style="width:150px" name="siteCountryCode" id="siteCountryCode">'; /* users country code */
			   echo ' <input type="text" style="width:150px" name="usersGeoLocation" id="usersGeoLocation">'; /* users location as geoLocation ids */
   				/*  value="6295630,6255148,2661886,2673722,2696046," */

			   echo ' <input type="text" style="width:150px" id="cookieExists">'; /* flag */
			   /* -------------- site settings --------------- */
			   /* next is in which language versions exist of this website */
			   echo ' <input type="text" style="width:150px" id="siteLangs" value="sv,fi,en">'; /* website's language 
			   versions available */ 
			echo '</span>';

			/* test data
			value="Sweden/Stockholm"  	
			value="SEK"  				
			value="sv-SE,se,sma,fi-SE"  
			value="sv-SE"  				
			value="SE"  				
			*/

				echo '<span id="uAds"></span>';

			// ERRORS
			// ads:   (f:Kävlinge Kommun, pg:3337385G0:2673723G1:2701094)','','',' cat: Kläder & skor (150) Baby's laying pillow Makuutyyny vauvalle place:Kävlinge Kommun, pg:3337385G0:2673723G1:2701094',6012,1
			// antaa errorin


			// ============================= ADMIN - generate test data ===================================
			$createTestData = false;
			if($createTestData) 
			{
				if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST')
				{
					/* test data post and saving */
					$sql1 = $sql2 = '';
					$conn = getDBConn();
					if(isset($_POST["testData1"])) { $sql1 = test_input(replaceCommas($_POST["testData1"])); }
					if(isset($_POST["testData2"])) { $sql2 = test_input(replaceCommas($_POST["testData2"])); }
					if($sql1 != '') { 
						if ($conn->query($sql1) === TRUE) {
						    echo "<br>testData1 inserted successfully";
						} else {
						  echo "<br>Error inserting testData1: " . $conn->error;
						}
					}
					if($sql2 != '') { 
						if ($conn->query($sql2) === TRUE) {
						    echo "<br>testData1 inserted successfully";
						} else {
						  echo "<br>Error inserting testData1: " . $conn->error;
						}
					}
				}
					/* form for creating test data */
				echo '<form action="index.php" method="post">';
				echo '<br><input id="testData1" name="testData1" type="text" style="width:150px">'; /* DELETE WHEN IN PRODUCTION */
				echo '<br><input id="testData2" name="testData2" type="text" style="width:150px">'; /* DELETE WHEN IN PRODUCTION */
				echo '<br><input id="testData3" name="testData3" type="text" style="width:150px">'; /* DELETE WHEN IN PRODUCTION */
				echo '<input type="submit" class="btn" value="Generate test data" style="color:#fff;background-color:#ffd871;"></form>';
			}
			// ======================================== END test data ======================================
?>
	<!--</div>-->
<!--</div>-->
<!--</div>--> <!-- bg -->


<!-- ========================= scripts ================================ 
<script src="https://code.jquery.com/jquery-1.12.4.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js"></script> --> <!-- for image upload -->
<!-- OFFLINE VERSIONS --> <!-- -->
<script src="../offline/jquery-1.12.4.js"></script> 
<script src="../offline/jquery.form.min.js"></script> <!-- for image upload -->

<?php if(getCurrentFileName() == 'new2.php') { ?>
	<script src="functions/imageUpload_functions.js"></script>
	<script src="main.js"></script>
<?php /* } else if(getCurrentFileName() == 'xxxxxxxxxxxxxxxxlogin.php') { ?>
	<script src="functions/translations_functions.js"></script>
	<script src="main.js"></script> */ ?>

<!-- NEW -->
<?php } else if(getCurrentFileName() == 'XXXXmessages.php') { ?>

?>
<!-- END NEW -->

			<?php /*}*/ ?>

<?php } else { 
		if(getCurrentFileName() == 'index.php' || getCurrentFileName() == 'messages.php') { ?>

	<!--<script src="functions/listing_functions.js"></script>
	<script src="functions/showAd_functions.js"></script>--> 
		<?php } ?>

	<!--<script src="functions/usersSettings.js"></script>-->
	<script src="functions/cookie_functions.js"></script>
	<script src="functions/category_functions.js"></script>
	<script src="functions/locations_functions.js"></script>
	<script src="functions/search_functions.js"></script> 
	<script src="functions/listing_functions.js"></script>
	<script src="functions/comment_functions.js"></script>
	<script src="functions/showAd_functions.js"></script> 
	<script src="functions/createAd_functions.js"></script>
	<script src="functions/form_functions.js"></script>
	<script src="functions/validation_functions.js"></script>
	<script src="functions/translations_functions.js"></script>
	<script src="functions/showExtraCriteria.js"></script>
	<script src="functions/message_functions.js"></script>
	<!-- <script src="admin_testDataGenerator.js"></script>--> <!-- REMOVE!!!!! -->
	<script src="main.js"></script>
	<!-- Google Places -->
	<!--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDi6cKFOSPieKZdvfiZUOTE6iURGxgCqgk&libraries=places&callback=initMap&language=fi"></script> -->
	
	<!-- ================================================================================================== -->
	<!-- ============================================= NEEDED ============================================= -->
	<!-- ================================================================================================== -->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDi6cKFOSPieKZdvfiZUOTE6iURGxgCqgk&libraries=places&language=fi"></script> 
	
	<!--  add &language;=fr  in needed -->
	<!-- ================================================================================================== -->
	<!-- ================================================================================================== -->
	<!-- ================================================================================================== -->
<?php }  ?>


<?php if(getCurrentFileName() == 'new2.php') { ?>
	<script src="functions/createAd_functions.js"></script>
<?php } else if(getCurrentFileName() == 'payment.php' || getCurrentFileName() == 'joinUs.php') { ?>
    <script src="https://rawgit.com/outboxcraft/beauter/master/beauter.min.js"></script>  <!-- beauter js -->
<?php } ?>

<?php
/*
<?php 	switch (getCurrentFileName()) {
		case 'new2.php': ?>

	<script src="functions/imageUpload_functions.js"></script>
	<script src="main.js"></script>

<?php 	break; 
		case 'login.php': ?>
	<script src="functions/translations_functions.js"></script>

<?php 	break;
		case 'index.php': ?>

	<!--<script src="functions/listing_functions.js"></script>
	<script src="functions/showAd_functions.js"></script>--> 
		<?php break; 
			} // switch  ?>

	<script src="functions/cookie_functions.js"></script>
	<script src="functions/category_functions.js"></script>
	<script src="functions/locations_functions.js"></script>
	<script src="functions/search_functions.js"></script> 
	<script src="functions/listing_functions.js"></script> 
	<script src="functions/showAd_functions.js"></script> 
	<script src="functions/createAd_functions.js"></script>
	<script src="functions/form_functions.js"></script>
	<script src="functions/validation_functions.js"></script>
	<script src="functions/translations_functions.js"></script>
	<script src="main.js"></script>
	<!-- Google Places - Execute AFTER pageload -->
	<!--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDi6cKFOSPieKZdvfiZUOTE6iURGxgCqgk&libraries=places&callback=initMap&language=fi"></script> -->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDi6cKFOSPieKZdvfiZUOTE6iURGxgCqgk&libraries=places&language=fi"></script> <!--  add &language;=fr  in needed -->
<?php } ?>

*/