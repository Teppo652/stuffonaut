<?php
include_once('functions.php');
$thisPage = 'admin_createCodes.php';
include_once('header.php');
$conn = getDBConn();
$table = 'messages';

/*
fromUser
toUser
adId
sentDate
readDate
repliedDate
title
message
img
senderDeleted
reveiverDeleted
*/



/*
IN JS:
if adTitle clicked --> getSingleMessage(msgId)
if reply clicked --> show sendMessageForm
*/


$adId = $toUserSafeId = $adInfo = $toUserInfo = $messages = $newMsg_title = $newMsg_message = '';


//if($loggedIn == '1' && isset($_SESSION['user'])) {
//	$sessionArr = explode('#', $_SESSION['user']);
//} else {
//	// if usernot  logged in --> autoredirect to login
//	// echo "<br>Error, logged in user not found, sql:$sql"; exit;
//}


if($loggedIn == '1' && isset($_SESSION['user'])) {
	$sessionArr = explode('#', $_SESSION['user']);
} else {
	// if usernot  logged in --> autoredirect to login
	header('HTTP/1.1 302 Redirect');
	header('Location: login.php?returnto=messages'); 
	exit;
}


/* ------------------------------ post ------------------------------------- */
// if POST --> validate newMessageForm --> send message 
if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST')
{
	var_dump($_POST);
	echo '<br><br>';

  	if(isset($_POST["adId"])) { 
		$adId = test_input($_POST["ad"]);
		//	$adId = '50'; // TEST
	}

	if(isset($_POST["userSafeId"])) { 
		$toUserSafeId = test_input($_POST["u"]);
	}
}

if($adId != '') {
	// if adId in URL:
	// display ad: thumb img, title, price, link to ad
	$adInfo = 'ad thumb, title, price';
}
if($toUserSafeId != '') {
	// if userSafeId in URL:
	// show receiver users name, profileImg
	$toUserInfo = 'receiver users name, profileImg';
}

if($adId != '' || $toUserSafeId != '') {
	// show newMessageForm:
	// write message to ad owner
	// title message (img later)

	// title Send message to user XXXXX
	// if adId in URL: x Close the ad
	// if adId in URL: x notify all other interested users that this item has been sold.
	// send btn
} else {
 	// 1 show all messages
  	// get user safeId from session --> display all messages
	/*
	$sql = "SELECT a.id, a.cat1, a.cat2, a.area, a.area0, a.area1, a.area2, a.area3, a.isCompany, a.title, a.mainImg, a.img, a.price, a.startDate, a.stars, a.numClicks, a.numComments, c.name as cat1Name, c2.name as cat2Name FROM ads as a INNER JOIN categories as c ON a.cat1=c.id LEFT JOIN categories as c2 ON a.cat2=c2.id 
		WHERE a.userId=$userId AND a.active=1";
	$sql .= " AND countryGeoId=" . $countryGeoId;
	*/
	//$sql = "SELECT * FROM messages ORDER BY sentDate DESC"; //  WHERE safeId='$sessionArr[0]' LIMIT 1";

	$sql = "SELECT m.id,m.fromUser,m.sentDate,m.message,a.id as adId,a.price,a.mainImg,a.title as adTitle,a.price,a.img,a.price,u.name,u.id as uId FROM messages as m 
	INNER JOIN ads as a ON m.adId=a.id 
	INNER JOIN users as u ON u.id=a.userId 
	GROUP BY fromUser ORDER BY sentDate DESC"; //  
	$sql .= "";
	echo "<br>$sql";
	$result = mysqli_query($conn, $sql);

	// if (mysqli_num_rows($result) > 0)
	if($result) 
	{
		while($row = mysqli_fetch_assoc($result)) 
		{
			// $messages .= ' ' . $row["fromUser"];
			// $messages .= ' ' . $row["sentDate"];
			// $messages .= ' <a href="#" id="' . $row["id"] . '">' . $row["title"] . '</a>';
			// $messages .= ' ' . $row["message"];
			// $messages .= '<br>';

  // a.id,a.fromUser,a.sentDate,a.title,a.message,
			// img:  imgs/'+item.id+'_'+item.mainImg+'"> 4KDLL61.jpg
$messages .= '<span id="'.$row['uId'].'" fuid="'.$row['fromUser'].'" otherPartysName="'.$row['name'].'" price="'.$row['price'].'" im="'.$row['mainImg'].'" class="msg_msg col iCol2 m12">';
	if($row['img']) { 

	} else {

	}
$messages .= '	<span class="msg_adImg col iCol2 m4">'.'<img src="imgs/'.$row['adId'].'_'.$row['img'].'">'.'</span>';
$messages .= '	<span class="msg_adTxt col iCol2 m8">';
$messages .= '		<span class="msg_sender">'.$row['name'].'</span>';
$messages .= '		<span class="msg_date">'. displayDbDate($row['sentDate'],'short').'</span>';
$messages .= '		<span class="msg_adTitle">'.$row['adTitle'].'</span>';
$messages .= '		<span class="msg_msgTxt">'.$row['message'].'</span>';
$messages .= '		<input id="itemPriceHidden" type="hidden" value="'.$row['price'].'">';
$messages .= '		<span class="msg_deleteMsgBtn disable-select" ' . "onclick=\"return confirm('Are you sure?');\"></span>";
$messages .= '	</span>';
$messages .= '</span>';

		}
	} 
}

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

							<div id="messagesCol" class="row col m4">

								<?php if($messages != '') {
									echo $messages;
								} else {
							  		echo "You have 0 messages.";
							  	}?>
									<br><br>
									All messages<br>
									sorted by time only (later by ad)<br>
									Title sender date adImgThumbnail<br>
									pagination<br>
							</div>


							<div id="singleMessageCol" class="col m8" style="padding:0">
								<div class="innerHeader">
									<div id="otherPartysName">Senders name</div>
									<div id="adImgWrapper">
										<span class="msg_adImg" style="margin:0;float:right"></span>
										<span class="msg_adPrice">18 300 kr</span>
									</div>
								</div> 

								<div id="singleMessagePanel" style="padding:15px">
									<input id="msg_userSafeId" type="hidden">
									<span class="msg_date">2 apr 11:58</span>
									<span class="msg_message msg_other">Hej! Jag är intresserad. Har du de kvar?<br>Hälsningar<br>Dragan</span>

									<span class="msg_date msg_r">3 apr 11:09</span>
									<span class="msg_message msg_me">Hi,<br> Yes I still have them, but I have several people interested. I live in Lilla Essingen, If you are interested, would you be able to come look at them tomorrow evening? One guy is coming to see them today, but if he does not take them I can sell them to you.<br>-Ari</span>
									<!--<button id="replyBtn">Reply</button>-->
								</div> 

								<div id="writeMessagePanel" class="row XXXhidden">
										<div class="col m10">
											<label for="newMsg_message">Reply</label>
											<textarea id="newMsg_message" type="text" class="_full-width validateLength" max="2000"><?php echo  $newMsg_message; ?></textarea>
										</div>
										<div class="col m2">
											<button id="sendBtn">Send</button>
										</div>
								</div>

								<br><br><br><br>
								Report user btn<br>
								Ignore this user btn<br>
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

<style>
	select, input {
		border-radius: 4px;
	    height: 34px !important;
	    margin-right: 4px;
	}
	select, option {
		color: #5d5d5d;
	}
</style>
