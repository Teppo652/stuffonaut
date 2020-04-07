<?php 
session_start();

// BEFORE LAUNCH
$tempScreen = <<<EOT
  <div style="text-align: center;margin-top:200px">
  	<img src="img/logos/logoReceipt.PNG"><br>
  	<h1>In just a few days we will be opening... we have great freebies coming!!</h1>
  </div>
EOT;

$testing = '';
if (isset($_GET["t"]))
{
  
  $testing = filter_input( INPUT_GET, 't', FILTER_SANITIZE_URL );
  if($testing != '6523440') { echo $tempScreen; exit; }
} else { echo $tempScreen; exit; }

/* -------------------------------------------------------------  */
$thisPage = 'index.php';
include_once('header.php'); 


// read id from url
$adId = "";
if (isset($_GET["id"]) && strlen($_GET["id"]) > 0)
{
  $adId = filter_input( INPUT_GET, 'id', FILTER_SANITIZE_URL );
  echo "<input id='selectedAd' type='hidden' value='$adId'>";
}

// reset location (=use users current location)
// ?loc=reset
$resetLocation = "";
if (isset($_GET["loc"]) && strlen($_GET["loc"]) > 0)
{
  $resetLocation = filter_input( INPUT_GET, 'loc', FILTER_SANITIZE_URL );
  echo "<input id='resetLocation' type='hidden' value='1'>";
}

$loadingListItem = <<<EOT
								<div class="item placeholderItem">
									<div class="imgPanel gr"></div>
									<div class="textPanel" style="margin-top:12px">
										<span class="highlight gr"></span>
										<span class="text gr"><span class="location gr"></span></span>
										<span class="time gr"></span>
										<span class="title gr"></span>
										<span class="price gr"></span>
									</div>
								</div>
EOT;

?>

<!-- =========================================================================================================== -->
<!-- ===================================== display single ad -page ============================================= -->
<!-- =========================================================================================================== -->
<div class="bg2"> <!-- DEFAULT hidden -->
	<div class="content">
				<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->
				<div id="allUsersAdsPage" class="row _noPadding hidden">
					<div class="col m12">
						<div id="allUsersAdsNavi" class="row m3" style="float:right;text-align:right">
							<a id="backToSingleAdPageBtn">Back to xxxxxxxx's ads</a>
							<a id="moveToNextUsersAdBtn" style="margin-left:20px">Nästa xxxxxx'c annons »</a>
							<a id="backToSearchResultsBtn">Sökningen</a>
						</div>
					</div>
					<div class="col m9 _noPadding" style="min-height:600px !important">
						<div  class="row iCol2">	
							<div class="row XXXXlistingBody"> 			
								<!--<span class="areaLoader areaLoaderTable"></span>-->
								<div id="ajaxTable2">
									<span id="pageLoader2" class="pageLoader"><span class="pageLoaderImg"></span></span>
									<!-- listing with gray areas - replace with data items -->
								<?php for ($x = 0; $x < 3; $x++) { echo $loadingListItem; } ?>
								</div>
							<!--
								<div class="item">
									<div class="imgPanel">
										<img src="img/home2.jpg">
									</div>
									<div class="textPanel">
										<span class="highlight">butik</span> 
										<span class="text"><a>Möbler & heminredning x</a>, <a class="location">Kungsholmen</a></span>
										<span class="time">Idag 09:06</span>
										<a class="title">Hay - soffbord</a>
										<div class="price">1500 kr</div>
									</div>
								</div>
							--!
									<!-- ============================================= -->
							</div>
							<div id="paginationPanel2" class="row"></div> 
						</div>
					</div> <!-- END ad listing -->

					<!-- ========================================= SIDE BANNER AREA ========================================== -->
					<div class="col m3">
						side banner area 
					</div><!-- END side banner area 

			


						</div>
					</div>-->
				</div>

				<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->
				<div id="singleAdPage" class="row _noPadding hidden">
					<div class="col m12">
						<div class="row m7" style="float:left;text-align:left;">
							<!-- breadcrumbs -->
							<a class="breadcrumbValue10"></a>
							<span class="breadcrumbIcon11 breadcrumb hidden"></span><a class="breadcrumbValue11"></a>
							<span class="breadcrumbIcon12 breadcrumb hidden"></span><a class="breadcrumbValue12"></a>
							<span class="breadcrumbIcon13 breadcrumb hidden"></span><a class="breadcrumbValue13"></a>
						</div>
						<!-- navigate to front page (virtual) or move to next ad -->
						<div id="singleAdNavi" class="row m3" style="float:right;text-align:right">
							<a id="backToSearchResultsBtn">Sökningen</a>
							<a id="moveToNextAdBtn" style="margin-left:20px">Nästa annons »</a>
						</div>
					</div>

					<div class="col m9 _noPadding">
						<div  class="row iCol2">					
<!-- ===== todo change ===== --><form id="sendMessageForm" class="row">
								<div class="col m12 _noPadding">
									<!-- ============= map area ============= -->
									<div id="mapPanel" class="hidden" style="height:400px">
									    <div id="map" style="height:100%"></div>
									    <span id="mapLatLng" class="hidden"></span>
									</div>
									<!-- ============= image area ============= -->
									<div class="itemImgs">
										<span id="prevImg" class="arrowIcon flip disable-select">x</span> <!-- move to previous image -icon -->
										<div id="slideshow" title="Click to view in full screen">
											<!-- secondary images 
										    <img id="1" src="img/item1.jpg" alt="" style="position:absolute;display:none" class="activeImg" />
										    <img id="2" src="img/item2.jpg" alt="" style="position:absolute;display:none" />
										    <img id="3" src="img/home3.jpg" alt="" style="position:absolute;display:none" />
										    <img id="4" src="img/home4.jpg" alt="" style="position:absolute;display:none" />
										    <img id="5" src="img/home5.jpg" alt="" style="position:absolute;display:none" />
										    <img id="6" src="img/home6.jpg" alt="" style="position:absolute;display:none" />
										    <img id="7" src="img/home7.jpg" alt="" style="position:absolute;display:none" />
										    <img id="8" src="img/home8.jpg" alt="" style="position:absolute;display:none" /> -->
										</div> 
										<span id="nextImg" class="arrowIcon disable-select">x</span> <!-- move to next image -icon -->
									</div>
									<div id="dots">
										<!-- small dots control 
										<span id="dot1" class="dot activeDot"></span>
										<span id="dot2" class="dot"></span>
										<span id="dot3" class="dot"></span>
										<span id="dot4" class="dot"></span>
										<span id="dot5" class="dot"></span>
										<span id="dot6" class="dot"></span>
										<span id="dot7" class="dot"></span>
										<span id="dot8" class="dot"></span> -->
										<!-- image slides controls -->
										<span class="autoplayControls" style="float:right">
											<span id="stop" class="hidden"><span class="stopIcon disable-select"></span></span>
											<span id="play"><span class="playIcon disable-select"></span></span>
										</span>
										<!--<span id="imageOfImagesNumber">1 av 6</span>-->
									</div>									
									<div id="modalImage" class="modal">
										<!-- main image -->
									  	<img id="img01" class="modal-content" alt="" title="Click to close full screen">
									</div>
								</div>
								<div class="col m12 _noPadding">
									<h1 style="margin:0"><span id="singleAd-title"></span><span style="float:right"><span id="singleAd-price"></span> kr</span></h1>
								</div>

								<div class="col m12">
									Säljes av: 
									<a class="seller"><span id="singleAd-name"></span></a> 
									<span id="singleAd-startDate"></span><!-- 6 oktober 20:05 -->
									<span class="location_blue_icon">x</span><a href="#" id="showItemMap" class="sellerLocation">Visa på karta</a> (Ekerö)
									<span class="cameraIcon inlineIcon">x</span><a href="#" id="hideItemMap" class="sellerLocation">Visa bilder</a>
								</div>
<!--
<span id="singleAd-cat1"></span>
<span id="singleAd-cat1Nam"></span>
-->
								<div class="col m12 _noPadding" style="margin: 0 0 -40px 0">
									<div class="row" style="padding-right:0">
										<div class="col m3-5" style="width:65%;padding: 0 0 15px 15px"> <!-- m3-5  --> <!-- ex itemDesc -->
											<div id="extraAttributesPanel">
											<!-- this is generated in showAd 
											
												<div class="attrTitleRow">
													<span id="modelYear">Modellår:</span>
													<span id="xxxx">Växellåda:</span>
													<span id="xxxx">Miltal:</span>
												</div>
												<div class="attrValueRow">
													<span id="modelYearVal">2002</span>
													<span id="xxxx">Automat</span>
													<span id="xxxx">21 000 - 21 499</span>
												</div>


												<div class="attrTitleRow">
													<span id="xxxx">Tillverkningsår:</span>
													<span id="xxxx">Bränsle:</span>
													<span id="xxxx">Bränsle:</span>
												</div>
												<div class="attrValueRow">
													<span id="xxxx">2002</span>
													<span id="xxxx">555</span>
													<span id="xxxx">7777</span>
												</div>

											-->
											</div> <!-- END extraAttributesPanel -->

<!-- 
	asunnot:
LAND: 
Spanien

MÅNADSAVGIFT
3 310 kr

PRIS/M²
59 306 kr

VÅNING
2 av 3

BYGGÅR
1936
---
autot FI:
Ajoneuvotyyppi:	-	
Vuosimalli:	-	

Mittarilukema:	-		
Vaihteisto:		
Polttoaine:	-	
Rekisterinumero:	-	

Ilmoitus jätetty:	9 tammikuuta 08:41
Ilmoitustyyppi:	Myydään

Ajoneuvovero:	-
Polttoainekulut:	-	

-->

											<span id="singleAd-texts" class="itemDesc"></span> <!-- long description text -->

											<!-- instructions about selling -->
											<span class="instructions">
												<b>Stuffonaut tips för trygg affär</b>
												<p>Betala av säkerhetsskäl aldrig in pengar på privata bankkonton! Använd Stuffonautpaketet. Läs hur tjänsten fungerar. <a>Fler tips</a></p>
											</span>
											<span class="aboutOrg"></span>
										</div>

										<!-- company logo -->
										<div id="orgLogo" class="col" style="width:35%;" style="border:solid 1px red">
											<!-- <img src="imgs/company_logo.png"> -->
										</div>
										<!-- buttons -->
										<div class="col wideButtons" style="width:35%;"> <!-- m2-5  -->
											<button id="showPhoneNumber" class="highlighted">
												<span class="phoneIcon">x</span>
												<span id="phone"></span> <!-- 076 - visa numret -->
											</button>
											<!-- 
											<button id="showEmail" class="highlighted">
												<span class="chat-bubbleWhiteIcon">x</span>
												<span id="email"></span> -->
											</button> <!-- send email -->
										<!-- send message -->
											<button id="sendTheMessage" class="highlighted">
												<span class="chat-bubbleWhiteIcon">x</span>
												<span id="sendMessageBtn">Send message</span> 
												<!-- chat-bubbleWhiteIcon -->
											</button>


											<button id="saveInFavorites">
												<span class="heartIcon">x</span>
											</button>
											<button id="editAd">
												<span class="penIcon">x</span>
											</button>
											<button id="useShipping">
												<span class="truckIcon">x</span>
											</button>
											<div class="plainLinks">
												<button id="contract" class="leftLink">
													<span class="documentIcon">x</span>
												</button>
												<button id="reportAd" class="rightLink">
													<span class="warningIcon">x</span>
												</button>
											</div>
											<!-- new --->
											<a id="usersOtherAds" class="hidden">
												See seller's other <span id="numUsersOtherAds"></span> ads
											</a>
											<!--
												
<span id="viewAd_saveInFavorites_text">[Spara]</span>											
<span id="viewAd_editAd_text">[Ta bort,ändra, förnya]</span>
<span id="viewAd_useShipping_text">[Skicka med Stuffonaut paketet]</span>
<span id="viewAd_contract_text">[Köpekontrakt]</span>
<span id="viewAd_reportAd_text">[Anmäl]</span>
-->
											
											<div id="loginPopup" class="hidden"> 
												<span class="arrow-up-border"></span>
												<span class="arrow-up-border arrow-up"></span>
												<div class="popupContent">
													<span class="title">Spara annons</span><br>
													<p>Logga in för att spara annonsen</p>
													<button id="loginPopupBtn" class="popupLoginBtn highlighted">Logga in</button>
													<button id="cancelPopupBtn" class="">Stäng</button>
												</div>
											</div>
										</div>
										<!--
										<div id="loginPopup" class="modalbox-modal ">
											<div class="modalbox-modal-content">
												<span class="-close" id="modalbox-close">✖</span>
												<p>Here lies your modal!</p>
											</div>
										</div>

										-->
										<span id="singleAd-safeId" class="hidden">[safeId]</span>
								</div>

<!--
<input id="showPhoneNumber_popup_text">
Logga in för att se numret.

<input id="showEmail_popup_text">
Du behover logga in för att kunna skicka meddelande<br>
Har du inget Stuffonaut konto? Skaffa det <här>.

<input id="saveInFavorites_popup_text">
Spara annons
Logga in för att spara annonsen

<input id="editAd_popup_text">
Du behover logga in för att kunna ta bort, ändra eller förnya ennonsen. 
-->							
							</form>
							
						</div>
					</div>
					<!-- ================ end single ad ================ -->

					<!-- ================== comments ================== -->
					<!--
					$("#comments_thereAre").text(tr[p+'thereAre']);
					$("#comments_comments").text(tr[p+'comments']);
					$("#showCommentsBtn").text(tr['showCommentsBtn']);
					$("#hideCommentsBtn").text(tr['hideCommentsBtn']);
					$("#writeFirstCommentBtn").text(tr[p+'writeFirstCommentBtn']);
					$("#commentsTitle").text(tr[p+'commentsTitle']);

					$("#writeCommentBtn").text(tr[p+'writeCommentBtn']);
					$("#comments_fillAllFields").text(tr['fillAllFields']); 
					$("#comments_commentOrNameTooLong").text(tr[p+'commentOrNameTooLong']);
					$("#comments_errCouldNotSaveComment").text(tr[p+'errCouldNotSaveComment']); 



					-->
					<div id="commentsPanel" class="col m12" style="margin:10px">
						<div class="row col" style="padding:0">
							<span id="comments_thereAre">[Det finns]</span> <span id="totalNumComments">12</span> <span id="comments_comments">[kommentarer]</span><br>
							<span id="showHideComments">
								<button id="showCommentsBtn" class="highlighted hidden">[Visa kommentarer]</button>
								<button id="hideCommentsBtn" class="highlighted hidden">[Dölj kommentarer]</button>
								<button id="writeFirstCommentBtn" class="highlighted hidden">[Skriv första kommentar]</button> <!-- show if 0 comments -->
							</span>
							<div id="commentsPanelContent" class="hidden">
								<h2 id="commentsTitle">[Kommentarer]</h2>
								<ul id="ajaxComments"></ul>	
								<button id="writeCommentBtn" class="highlighted hidden">[Skriv kommentar]</button>
								<ul id="writeCommentPanel"></ul>
								<div id="writeCommentPanelEnd"></div
							</div>
						</div>
					</div>
					<!-- ================== end comments ================== -->
				</div>


	</div>
</div> <!-- END display single ad -page -->


<!-- =========================================================================================================== -->
<!-- ============================================== index page ================================================= -->
<!-- =========================================================================================================== -->
<div class="bg2">
	<div>
		<!-- was here <div id="frontPage" class="content"> --> 
		<!-- saved searches -->
		<button id="closeSavedSearchesPanelBtn" class="hidden"><span class="closeIcon2"></span></button>
		<div id="savedSearchesPanel" class="row hidden">
		</div>

		<?php if(strlen($userSafeId)>6) { ?>
		<div id="settingsPanel" class="row hidden">
			<!--
			<h2>My settings</h2>

			<b>Start category</b>
			<p>Set the category you wish to see next time you come to this website. You can always change it here.</p>
			-->
			<ul id="myMainCats" class="quickCategories"></ul>
			<input id="userSetMainCat" type="hidden" value=""> <!-- TODO put this to work, nothing yet done... -->

			<b>Categories</b>
			<p>Here you can hide the main categories you never need and wish NOT to see them. You can always set them back visible here.</p>
			<ul id="catSettings" class="quickCategories"></ul>


			<button id="closeSettingsPanelBtn" class="hidden"><span class="closeIcon2"></span></button>
			<button id="saveUserSettings" class="topnav btn hidden">Save changes</button>

			<input id="userHiddenCats" type="hidden" value="">
		</div>
		<?php } ?>
		<div id="frontPage" class="content">
<?php
/*
if(!isset($_SESSION["location"])) {
// $_SESSION["favanimal"] = "cat";
} else {
	echo '<br>FROM SESSION: ' . $_SESSION["location"];
}
echo '<br>FROM SESSION: ' . showSession();
*/

// $userLocationRegistered = '';
// $siteCountryCode = '';
// $langId = '';
?>			
			<div id="area0Row" style="display:block" class="row"> 
				<!-- hidden by default -->
				<div id="langAndcontinentPanel" class="col m6 iCol hidden">
					<div class="row searchRow">
						<div class="col m1">
							<span class="languageIcon"></span>
						</div>
						<div class="col m4 areaBg noLeftMargin" style="left:3px">
							<select id="languageSelector" class="area" style="width:185px"></select> <!-- language -->
						</div>
						<div class="col m1">
							<a id="userSetDefaultLocation" href="index.php?loc=reset" title="Use my current location"><span class="pinIcon disable-select"></span></a>
							<span class="locationIcon disable-select"></span>
						</div>
						<div class="col m6 areaBg noLeftMargin" style="left:90px;width:185px">
							<select id="continent" class="area" style="width:185px"></select> <!-- continent -->
							<span class="areaLoader disable-select"></span>
						</div>
					</div>
				</div>
				<!-- hidden by default -->
				<div id="countryAndAreaPanel" class="col m6 iCol hidden">
					<div class="row searchRow">
						<div class="col m5 areaBg">
							<select id="country" class="area"></select> <!-- country -->
							<span class="areaLoader disable-select"></span>
						</div>
						<div class="col m5 areaBg" style="left:-32px">
							<select id="area" class="area"></select> <!-- county -->
							<span class="areaLoader disable-select"></span>
						</div>
						<div class="col m1"><!--<button id="changeLocationOpenBtn">-->
							<button id="changeLocationCloseBtn" title="Hide" style="border:none !important;">
								<span class="hideIcon disable-select"></span> <!-- close language & location settings panel -->
							</button>
						</div>
					</div>
				</div> <!-- end language & location settings panel (hidden by default) -->
			</div>
			
			<!-- FOR DEBUGGING 
			<div class="col m12" style="float:right;text-align:right">
				<?php
					// if(isset($_SESSION['user'])) {
					//   echo 'You are logged in: ' . loadFromSession();
					// } else {
					//   echo 'NOT logged in';
					// }
				?>
			</div>-->

			<div id="searchPanel" class="row">
				<div id="searchL" class="col m6 iCol">

					<div class="row searchRow">
						<div class="col m6" style="padding:10px 0">
							<input id="searchText_placeholder" type="text" placeholder="Sök...">
						</div>
						<div class="col m6 cat1Bg" style="padding:10px 0">
							<select id="cat1" class="cat1Special"></select> <!-- category 1 -->
							<span class="areaLoader disable-select"></span>
		<!-- users settings 
		<a id="openSettingsPanelBtn" title="My settings"><span class="settingsIcon"></span></a> -->
						</div>
					</div>
				</div>
				<div id="searchR" class="col m6 iCol">
					<div class="row areaRow">
						<div id="area0Panel" class="col m5 areaBg"> <!-- col m5 areaBg -->
							<select id="area0" class="area"></select>  <!-- county 2 -->
							<span class="areaLoader disable-select"></span>
						</div>
						<div id="area1Panel" class="col m5 areaBg" style="margin-left: -17px !important">
							<select id="area1" class="area"></select> <!-- city or area -->
							<span class="areaLoader disable-select"></span>
						</div>
						<div id="searchBtnPanel" class="col m2" style="height:60px"><!-- <?php /* echo'Найти'; */ ?> -->
							<button id="searchBtn"><span class="searchIcon">x</span></button> <!-- search button -->
							<!-- upper right round globe button - open language & location settings panel -->
							<a id="changeLocationOpenBtn" title="open location settings">
								<span class="globeIcon"></a>
							</button>
						</div>
					</div>
				</div>

				<!-- ad type: For sale, For rent,exchange, Wanted to buy, Wanted to rent -->
				<!-- this changes according to selected category -->
				<div class="col m6 adTypes">
					<div id="adType_0" class="myRadio myRadiobutton-selected"></div><span id="adType_0_text" class="checkText gr"></span>
					<div id="adType_1" class="myRadio myRadiobutton"></div><span id="adType_1_text" class="checkText gr"></span>
					<div id="adType_2" class="myRadio myRadiobutton"></div><span id="adType_2_text" class="checkText gr"></span>
					<div id="adType_3" class="myRadio myRadiobutton"></div><span id="adType_3_text" class="checkText gr"></span>
					<div id="adType_4" class="myRadio myRadiobutton"></div><span id="adType_4_text" class="checkText gr"></span>
				</div><input id="adType" type="hidden" value="0">
				<!--<span id="extraSearhCriteriaRadios"></span>-->

				<!-- the below area select lists are shown only when a country has more than 4 levels of areas -->
				<div id="areas23" class="col m6 iCol" style="height:20px"> <!-- <div class="row searchRow quickCategories"> -->
					<div class="row areaRow" style="margin-top:-50px">
						<div id="area2Bg" class="col m5 areaBg hidden"> <!-- hidden   style="margin-top:-38px;margin-left:15px !important" -->
							<select id="area2" class="area"></select> <!-- suburb - used only in a few countries like Germany -->
							<span class="areaLoader disable-select"></span>
						</div>
						<div id="area3Bg" class="col m5 areaBg hidden"> <!-- hidden margin-top:-65px;margin-left:238px !important -->
							<select id="area3" class="area"></select> <!-- suburb 2 - used only in a few countries like Germany -->
							<span class="areaLoader disable-select"></span>
						</div>
						<div class="col m1"></div>
					</div>
				</div>

				<!-- extra searh criteria -->
				<div id="extraSearhCriteriaPanel" class="col m12 hidden"></div>
			<!--
				<div class="col m12 _noPadding">
					<!-- car types 
					<div class="col m9 _noPadding">
						<div id="carTypesPanel"></div>
					</div>
					<!-- car colors 
					<div id="colorSelector" class="col m3 _noPadding">
						<!-- 
						<span id="FFFFFF" title="White" style="background-color:#FFFFFF"></span>
						<span id="D3D3D3" title="LightGrey" style="background-color:#D3D3D3"></span>
						<span id="D2B48C" title="Tan" style="background-color:#D2B48C"></span>
						<span id="000000" title="Black" style="background-color:#000000"></span>
						<span id="DC143C" title="Crimson " style="background-color:#DC143C"></span>
						<span id="FFD700" title="Gold" style="background-color:#FFD700"></span>
						<span id="9ACD32" title="YellowGreen" style="background-color:#9ACD32"></span>
						<span id="87CEFA" title="LightSkyBlue" style="background-color:#87CEFA"></span>		
					 				
					</div>
				</div>
			
				<div id="machineryGroupsPanel" class="col m10 hidden"></div>
				<div id="machineryMakesPanel" class="col m2 hidden"></div>
			-->



				<hr style="float:left;margin: -5px 0">
				<div id="cat2Links" class="col m12 quickCategories gr2">  <!-- category 2 link list -->
					<span class="areaLoader areaLoaderLinks disable-select"></span>
				</div>
				<hr style="float:left;margin: -5px 0">
			</div> <!-- end searchPanel -->

			<div style="clear:left"></div>

			<div id="ajaxListing" style="" class="row">
				<!-- ====================================== MAIN CONTENT ==================================== -->


				<!-- ============== ad listing ============== -->
				<div id="listingPanel" class="col m9">
					<div  class="row iCol2" style="padding-top: 0;margin-top: -13px"> <!-- style is NEW -->				
						<div class="row listingHead iCol2">
							<div class="col m9" style="margin-left:-10px;height:53px;">
								<b>
								</b>
								<!-- <b><?php echo 'Welcome '.($user['is_logged_in'] ? $user['first_name'] : 'Guest').'!'; ?></b> -->
								<!--<h2 id="pageTitle" class="gr" style="margin:0"><span id="selectedCat1Name">[selectedCat1Name]</span> i <span id="selectedAreaName">[selectedAreaName]</span> — <span id="numOfItems">[numOfItems]</span> <span id="ads">[annonser]</span></h2>-->

								<!-- selectedAreaName -->
								<h2 id="pageTitle" class="gr"><span id="selectedCat1Name" class="gr gr6"></span> <span id="in"></span> <span id="selectedAreaName"></span> — <span id="numOfItems">0</span> <span id="ads"></span></h2>
							</div>
							<div id="saveSearchPanel" class="col m3 hidden" style="padding:14px 0 0 0">
								<!--<button id="saveSearch" class="b6 tableStyle" style="border:none"><span class="heartBtnIcon">x</span> [Skapa bevakning]</button>-->
								<span class="heartBtnIcon">x</span>
								<span id="saveSearch" class="b6 tableStyle gr"></span>
							</div>
							<div class="col m7 iCol2">
								<span class="buttons advertiserTypes"><!--
									<button id="advertiserType_all" class="left b1 selected">[Alla annonser]</button>
									<button id="advertiserType_private" class="middle">[Privat]</button>
									<button id="advertiserType_company" class="right b3">[Företag]</button>-->
									<button id="advertiserType_all" class="left b1 selected gr2"></button>
									<button id="advertiserType_private" class="middle gr2"></button>
									<button id="advertiserType_company" class="right b3 gr2"></button>
								</span>
								<input id="advertiserType" type="hidden" value="all">
							</div>
							<div class="col m5 iCol2 sortBy">
								<button class="b6 tableStyle" title="Change listing style"><span class="cardsIcon">x</span></button>
								<!--<button id="sortBy_price" class="right b5">[Billigast]</button>								
								<button id="sortBy_time" class="left b4 selected">[Senaste]</button>-->
								<button id="sortBy_price" class="right b5 gr3"></button>								
								<button id="sortBy_time" class="left b4 gr3 selected"></button>
								<input id="sortBy" type="hidden" value="time">
							</div>
							<input id="tableStyle" type="hidden" value="list">

							<div style="clear:left"></div>
							<hr>
							<div style="clear:left"></div>

							<div class="col m12 breadcrumbs" style="height:50px"> 
								<!-- Förstasidan - FORDON - Motorcyklar - Sport -->
								<!--               breadcrumb1 breadcrumb2  breadcrumb3 -->
								<a class="breadcrumbValue0"></a>
								<span class="breadcrumbIcon1 breadcrumb hidden"></span><a class="breadcrumbValue1"></a>
								<span class="breadcrumbIcon2 breadcrumb hidden"></span><a class="breadcrumbValue2"></a>
								<span class="breadcrumbIcon3 breadcrumb hidden"></span><a class="breadcrumbValue3"></a>
								<span class="breadcrumbIcon4 breadcrumb hidden"></span><a class="breadcrumbValue4"></a>
							</div>
							
							<div style="clear:left"></div>
							<!--
							<hr>
							<div style="clear:left"></div>
							-->
							<div style="clear:left"></div>
						</div>
						<div class="row listingBody"> 			
							<span class="areaLoader areaLoaderTable disable-select"></span>
							<div id="ajaxTable"></div>	

							<!-- listing with gray areas - replace with data items -->
							<?php for ($x = 0; $x < 7; $x++) { echo $loadingListItem; } ?>
							<div class="item">
								<div class="imgPanel">
									<img src="img/home2.jpg">
								</div>
								<div class="textPanel">
									<span class="highlight">butik</span> 
									<span class="text"><a>Möbler & heminredning x</a>, <a class="location">Kungsholmen</a></span>
									<span class="time">Idag 09:06</span>
									<a class="title">Hay - soffbord</a>
									<div class="price">1500 kr</div>
								</div>
							</div>
<!-- ============================================= -->

							<!-- item -->
							<!-- 
							<div class="item">
								<div class="imgPanel">
									<span class="noImageIcon"></span>
								</div>
								<div class="textPanel">
									<span class="highlight">butik</span>
									<span class="text"><a>Möbler & heminredning x</a>, <a class="location">Kungsholmen</a></span>
									<span class="time">Idag 09:06</span>
									<a class="title">Hay - soffbord</a>
									<div class="price">1500 kr</div>
								</div>
							</div>
							<div class="item">
								<div class="imgPanel">
									<img src="img/home2.jpg">
								</div>
								<div class="textPanel">
									<span class="highlight">butik</span> 
									<span class="text"><a>Möbler & heminredning x</a>, <a class="location">Kungsholmen</a></span>
									<span class="time">Idag 09:06</span>
									<a class="title">Hay - soffbord</a>
									<div class="price">1500 kr</div>
								</div>
							</div>
						-->
							<div class="item">
								<div class="imgPanel">
									<img src="img/home7.jpg">
								</div>
								<div class="textPanel">
									<span class="highlight">butik</span>
									<span class="text"><a>Möbler & heminredning x</a>, <a class="location">Kungsholmen</a></span>
									<span class="time">Idag 09:06</span>
									<a class="title">Hay - soffbord</a>
									<div class="price">1500 kr 
										<span class="averageGrade" title="Average item grade 3.2 stars">
										<span class="gStar"></span>
										<span class="gStar"></span>
										<span class="gStar"></span>
										<span class="gStar_e"></span>
										<span class="gStar_e"></span>
									</span>
									<!--<span class="priceFeeling" title="Viewer verdict: Overpriced">Overpriced</span>-->
									</div>
									<span class="priceColorScale" title="Viewer verdict: Overpriced"><span class="priceScalePointer"></span></span><span class="priceVerdictVotes"><span class="userIcon"></span>52</span>
									<!-- price vote -->
									<span class="priceVotePanel">
										<span class="priceVote_-2 priceVote"></span>
										<span class="priceVote_-1 priceVote"></span>
										<span class="priceVote_0 priceVote"></span>
										<span class="priceVote_1 priceVote"></span>
										<span class="priceVote_2 priceVote"></span>
									</span> Move this to single product!!

									<div class="infoPanel">
										<div class="infoItem" title="Viewed 1231 times">
											<div class="infoIcon viewedIcon"></div>
											<div class="infoText">1231</div>
										</div>
										<div class="infoItem" title="Published 1 day ago">
											<div class="infoIcon calendarIcon2"></div>
											<div class="infoText">1 day</div>
										</div>
										<div class="infoItem" title="231 comments">
											<div class="infoIcon comments_icon"></div>
											<div class="infoText">231</div>
										</div>
										<div class="infoItem" title="3 comments today">
											<div class="infoIcon newComments_icon"></div>
											<div class="star_icon"></div>
											<div class="infoText">3 new</div>
										</div>
										<div class="infoItem" title="Seller has received 155 messages concerning this item">
											<div class="infoIcon envelopeIcon2"></div>
											<div class="arrow"></div>
											<div class="infoText">155</div>
										</div>
										<div class="infoItem" title="Seller has 3 unanswered messages concerning this item">
											<div class="infoIcon envelopeIcon2"></div>
											<div class="arrow arrowLeft"></div>
											<div class="infoText" style="color:red">3</div>
										</div>
										<div class="infoItem" title="Seller has answered to 97%  messages">
											<div class="infoIcon envelopeIcon2"></div>
											<div class="arrow arrowLeft"></div>
											<div class="percent"></div>
											<div class="infoText">97%</div>
										</div>
										<div class="infoItem" title="Seller answers in average in 3 hours">
											<div class="infoIcon envelopeIcon2"></div>
											<div class="arrow arrowLeft"></div>
											<div class="clock"></div>
											<div class="infoText">3 h</div>
										</div>
										<div class="infoItem" title="The seller has currently 23 items on sale. In total the seller has had 132 items on sale.">
											<div class="infoIcon shopping-cartIcon"></div>
											<div class="infoText">23/132</div>
										</div>
										<div class="infoItem" title="The seller has been a member for 514 days">
											<div class="infoIcon userIcon3"></div>
											<div class="infoText">514 d</div>
										</div>

									</div>
								</div>
							</div>
<!-- ============================================= -->							
						</div>

						<div id="paginationPanel" class="row"></div> 
					</div>
					<!-- moved to footer
					<span id="pageLoader" class="hidden pageLoader">
						<span id="pageLoaderImg"></span>
					</span> -->
				</div> <!-- END ad listing -->

				<!-- ========================================= SIDE BANNER AREA ========================================== -->
				<aside id="sidePanel" class="col m3">
					<h2 id="sidePanelTitle_text">[Galleriet]</h2>
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
				</aside><!-- END side banner area -->

			</div> <!-- row -->

			<!-- hidden settings -->
			<input id="phpPageName" type="hidden" value="index"> <!-- name of current PHP page -->
			<input id="currentPage" type="hidden" value="1"> <!-- pagination -->

			<br>selIds: <input id="extraData_selIds" type="text">
			<br>selVal: <input id="extraData_selVal" type="text">
<?php include_once('footer.php'); ?>