<?php
include_once('functions.php');
$thisPage = 'admin_createCodes.php';
include_once('header.php');
$conn = getDBConn();
$thisPage = 'myAds.php';


if($loggedIn == '1' && isset($_SESSION['user'])) {
	$sessionArr = explode('#', $_SESSION['user']);
} else {
	// if usernot  logged in --> autoredirect to login
	header('HTTP/1.1 302 Redirect');
	header('Location: login.php?returnto=myAds'); 
	exit;
}

	$allAds = '';
	$today = getCurrentDateAsYYMMDDHHMM();	
	// toimii
	// $sql = "SELECT * FROM ads ORDER BY id DESC";

	// get ad order on page - kesken
	//$sql = "SELECT id FROM ads WHERE ORDER BY endDate DESC
	// AS pageOrder,

	// get ads
	$sql = "SELECT 
	(SELECT COUNT(id) FROM messages WHERE sentDate>1904290000) AS todayNumMsgs,
	 a.id,a.mainImg,a.title,a.startDate,a.endDate,a.texts,a.numClicks,a.active, COUNT(m.id) AS numMsgs FROM ads as a
	INNER JOIN messages as m ON a.id=m.adId 
	WHERE a.endDate > $today 
	ORDER BY a.id DESC";
	echo "<br>$sql";

	$deActivateHidden = '';
	$activateHidden = '';
	$result = mysqli_query($conn, $sql);
	if($result) 
	{
		while($row = mysqli_fetch_assoc($result)) 
		{
			$allAds .= '<div class="ad" id="'.$row['id'].'">';
			$allAds .= '	<span class="adImg col m2">'.'<img src="imgs/'.$row['id'].'_'.$row['mainImg'].'">'.'</span>';
			$allAds .= '	<span class="adTxt col iCol2 m6">';
			$allAds .= '		<div class="manage_title">'.$row['title'].'</div>';
			$allAds .= '		<div class="manage_startDate">'.displayDbDate($row['startDate'],'days').' - '.displayDbDate($row['endDate'],'days').'</div>';
			$allAds .= '		<div class="manage_texts">'.$row['texts'].'</div>';
			$allAds .= '		<div class="manageAdLinks">';
			$allAds .= '			<button class="manage_editBtn">Edit</button>';
			if($row['active'] == '0') { 
				$activateHidden = ''; $deActivateHidden = ' hidden'; 
				} else { 
					$activateHidden = ' hidden'; $deActivateHidden = ''; 
			}
			$allAds .= '			<button class="manage_activateBtn'.$activateHidden.'">Activate</button>';
			$allAds .= '			<button class="manage_deactivateBtn'.$deActivateHidden.'">Deactivate</button>';
			
			$allAds .= "			<button class='manage_deleteBtn'>Delete</button>";
			////$allAds .= "			<button class='manage_deleteBtn'onclick=\"return confirm('Are you sure?');\">Delete</button>";
			//$allAds .= "			<span class='manage_deleteBtn' onclick=\"return confirm('Are you sure?');\">Delete</span>";

			$allAds .= '		</div>';
			$allAds .= '	</span>';

			$allAds .= '	<span class="stats col iCol2 m4">';

			// --------- STATS - displayed in opposite order! ---------
			// is active
			if($row['active'] == '0') { $symbol='&#10008;'; $activeStatusClass = 'notActive'; } else { $symbol='&#10004;'; $activeStatusClass = 'isActive'; }
			$allAds .= '		<span class="statItem"><div class="top">Active</div><div class="adStats_isActive num num3 '.$activeStatusClass.'">'.'<span>'.$symbol.'</span>'.'</div><div class="bottom"></div></span>'; 
			
			// on page OR Is 12th ad in category
			//$allAds .= '		<span class="statItem"><div class="top">På sida</div><div id="adStats_pageLocation" class="num num3">X</div><div class="bottom">av 23</div></span>';
			$allAds .= '		<span class="statItem"><div class="top">På sida</div><div class="adStats_pageLocation num num3">X</div><div class="bottom"></div></span>';

			// messages
			// $allAds .= '		<span class="statItem"><div class="top">Mejl</div><div id="adStats_numMessages" class="num num2">'.$row['numMsgs'].'</div><div class="bottom">'.$row['todayNumMsgs'].' idag</div></span>';
			$allAds .= '		<span class="statItem"><div class="top">Mejl</div><div class="adStats_numMessages num num2">'.$row['numMsgs'].'</div><div class="bottom"></div></span>';


			// clicks
		// $allAds .= '		<span class="statItem"><div class="top">Visningar</div><div id="adStats_clicks" class="num num1">'.$row['numClicks'].'</div><div class="bottom">X idag</div></span>';
			$allAds .= '		<span class="statItem"><div class="top">Visningar</div><div class="adStats_clicks num num1">'.$row['numClicks'].'</div><div class="bottom"></div></span>';


			$allAds .= '	</span>';

			$allAds .= '</div>';
		}
	}
  

/* ------------------------------ post ------------------------------------- */
/*






*/ 

?>
<div class="bg">
		<div class="content">
			<div id="bg5" class="row">

					<div class="innerHeader col m12">
						<a id="" class="selected">Mina annonser</a>
						<a id="">Meddelanden</a>
						<a id="">Bevakningar</a>
						<a id="">Sparade annonser</a>
						<a id="" style="float:right">Logga ut</a>
						<a id="" style="float:right">Kontoinställningar</a>
					</div>
					<div class="row iCol2">

							<div id="manage_adsList" class="row col m12">

								<?php if($allAds != '') {
									echo $allAds;
								} ?>
									<br><br>
									All allAds<br>
									pagination<br>
							</div>
							<!--
							All messages (message titles) + Reply btn + Delete btn + pagination
							SIngleMsg(in same page)

							DB:
							messages:
							toUser fromUser(opt) adId sentDate title message repliedDate 
							
							sellerResponseTimes:
							sellerUserId responseTimeHours 
							
							userActivityStats:
							userId actionId actionDate
							(actionIds: openedAd,wroteComment,repliedComment,sentMsg,openedMsg,repliedMsg)

							Send msg form + (to field comes autom.) + message + send btn
							-->





					</div>

			</div> <!-- row -->

		</div>
	</div>

<!-- hidden settings -->
<!-- <input id="currentSingleAd" type="hidden">-->

<?php include_once('footer.php'); ?>