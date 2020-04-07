<?php
/* paypal buy now buttons */
include_once('functions.php');
$thisPage = 'payment.php';
include_once('header.php');
$conn = getDBConn();

/* ============================ post ============================ */
$adId = $mainImgName = $countryGeoId = $amount = $code = $codeExists = $codeUsed = $useCode = $userSafeId = "";
if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST')
{
	var_dump($_POST);
	echo '<br><br>';

  	if(isset($_POST["adId"])) { 
		$adId = test_input($_POST["adId"]);
		//	$adId = '50'; // TEST

		// get currency & price from ads table
		$arr = getAdPrice($adId,$conn);
		if($arr == '') { echo "<br>Something went wrong (error code 835), please contact customer service."; exit; }
		$countryGeoId = explode('#',$arr)[0];
		$amount = explode('#',$arr)[1];
	}
	if(isset($_POST["sId"])) { 
		$userSafeId = test_input($_POST["sId"]);
	} else {
		echo "<br>NO USER SAFE ID FOUND";
	}
	
	$codeUsed = '';
	if(isset($_POST["codeUsed"])) { $codeUsed = test_input($_POST["codeUsed"]); }

	if(isset($_POST["code"])) { 
		$code = test_input($_POST["code"]);
		if(isset($_POST["useCode"])) { $useCode = test_input($_POST["useCode"]); }

		//echo "<br>CODE VALIDATION - checking code: *$code* - " . "SELECT id FROM codes WHERE code=$code LIMIT 1";
		// ---------------- validate code ----------------
		// check code exists
		if(getCodeType($code,$conn) != '') {
			//echo "<br>codeExists";
			$codeExists = '1';
			if($useCode == '1') {
				// finalise code use
				$isCompany = getUserType($userSafeId,$conn); // get user type
				// mark code used - or show type error
				$err = validateCodeTypeAgainstUserType($codeExists,$isCompany,$code,$conn);
				if($err != '') { echo $err; exit; }

				// check the codes typeId
				echo "<br>AA The userSafeId:$userSafeId";
				echo "<br>AA code: $code";
				echo "<br>AA adId: $adId";
				echo "<br>AA isCompany: $isCompany";

				// save code & userId in codeused
			// NEXT updateCodeUsed();

				// mark ad paid - and ready for inspection
			}
		} else {
			echo "<br>DEBUG: code does not exist";
			$codeExists = '2'; // failed
		}
		
	}
}// else { echo '<br>Something went wrong. Can not init payment process.'; exit; }



// set currency 
switch ($countryGeoId) {
	case '2661886': $currency_code = "SEK";  break; // Sweden
	default: $currency_code = "EUR"; break;
}

// if($currency_code == '') { echo '<br>Something went wrong with getting the currency.'; exit; }
// if($amount == '') { echo '<br>Something went wrong with getting the amount.'; exit; }


// ----------------------- TESTING ------------------------:
$countryGeoId = '2661886';
$amount = 2.95;
$currency_code = 'SEK';



?>
<div class="bg">
		<div class="content">

			<div class="row">
				<div class="col m9">
					<div class="paymentPanel" class="row iCol2">

						<h1 id="paymentPageTitle" style="margin:0;text-align:left">[Payment]</h1>

					<!-- CODE WAS USED -->
					<?php if($codeUsed == '1') { ?>
					<br>CODE WAS USED, thank you.<br>Your ad will be published after checking, usually this occurs within 1-12 hours.
					<?php exit; } ?>


						<p id="paymentPageTopText">[We accept PayPal&trade;, click Buy now -button to make the payment]</p><br><br>


<!-- --------------------- TAB LINKS ----------------------- -->
<div class="tab">
  <button class="tablinks" style="display: block;" onclick="opentab('tab1')">PayPal</button>
  <?php if($countryGeoId == '2661886') { ?> <button class="tablinks" onclick="opentab('tab2')">Swish</button> <?php } ?><!--sweden-->
  <?php if($countryGeoId == '660013') { ?> <button class="tablinks" onclick="opentab('tab3')">MobilePay</button> <?php } ?><!--finland-->

  <button class="tablinks" onclick="opentab('tab999')">I have code</button>
</div>






<!-- --------------------- TAB CONTENTS ----------------------- -->

<!-- swish -->
<?php if($countryGeoId == '2661886') { ?> 
<div id="tab2" class="tabcontent">
  <div class="swishLogo"></div>
  <div id="swishNumber" class="oneTimePayment oneRowPaymentText">
  	Payee: <b id="swishNumber" style="float:unset !important;">123 456 78 90</b><br>
  	<span>Message: Usercode, first- and lastname.</span> <i>For example John Doe AX8UE5Y</i>
  </div> 
</div>
<?php } ?>

<!-- mobilePay -->
<?php if($countryGeoId == '660013') { ?> 
<div id="tab3" class="tabcontent">
  <div class="oneTimePayment oneRowPaymentText">To pay with MobilePay use number:  <b style="float:unset !important;">123 456 78 90</b></div> 
</div>
<?php } ?>

<!-- code -->
<div id="tab999" class="tabcontent" style="display: <?php if($code != '') { echo 'block'; } else { echo 'none'; } ?>;" >
	<div class="row col m12">
		<form id="codeForm" method="post" action="<?php echo $thisPage; ?>">
			<input type="hidden" name="adId" value="<?php echo $adId; ?>">
			<input type="hidden" name="sId" value="<?php echo $userSafeId; ?>">


			<span id="codeEyeButton" class="eyeButton">x</span>
			<label for="code">Code</label>
			<input id="code" type="text" name="code" class="bigInput _width100" value="<?php echo $code; ?>" />
			<!-- IN ORDUCTION: autocomplete="off" -->
			<!-- placeholder="A1X5B2Y6C3" -->

			<!-- tooltip -->
			<?php if($codeExists == '1') { ?> 
				<div class="tooltip -tooltip-left">?
				  <span class="tooltiptext">This only checks if your code can be used to pay your ad. Using the code to pay will be done in next step. </span>
				</div>
			<?php } ?>


			<!-- USE CODE BTN displayed -->
			<?php if($codeExists == '1') { ?> 
				
				<input id="useCodeBtn" class="bigInput _primary button" type="submit" value="Use code">
				<!--<input id="checkCodeBtn" class="bigInput _primary button" type="submit" value="Check code">-->
				<div class="col m12">
					<!--<p>Code OK<br><br>Explain code type here.</p>-->
					<div class="alert _success">Your code can be used for payment, click &quot;Use code&quot; to pay with it.</div>
				</div>
				
				<!-- if code accepted 
				 if code exists, display Use code -btn
				 mark code used -->
				<input name="useCode" type="hidden" value="1">
				<input name="codeUsed" type="hidden" value="1">
				<!--
				<br>code: <?php echo $code; ?>
				<br>adId: <?php echo $adId; ?>
				<br>userSafeId: <?php echo $userSafeId; ?>
				-->
			<?php } else { ?>

				<input id="checkCodeBtn" class="bigInput _primary button" type="submit" value="Check code">
				<?php if($codeExists == '2') { ?>
					<!-- code rejected 
					<div id="XXXerrorsPanel" class="row" style="display:table-cell">-->
						<div id="errPanel" class="col m12"> 
							<p>
								<div class="alert">We are sorry, your code is not valid, please check it and try again.</div> 
							</p>
						</div>
					<!--</div>-->
				<?php } ?>
			<?php } ?>
			<!-- <input class=" _primary button" type="submit" value="Check code"> -->
		</form>
	</div>
</div>

<!-- payPal -->
<div id="tab1" class="tabcontent" style="display: <?php if($code != '') { echo 'none'; } else { echo 'block'; } ?>;" >
		<!-- ========================================= payPal ========================================= -->	
		<div id="oneTimePayment">
			<span id="oneTimePaymentText">[Single ad in selected category]</span><br>
			<?php echo $amount . ' ' . $currency_code; ?><br>
			<br>
			<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
			<input type="hidden" name="cmd" value="_xclick">
			<input type="hidden" name="business" value="adpayments.EU@gmail.com">
			<input type="hidden" name="lc" value="US">
			<input type="hidden" name="item_name" value="Single ad">
			<input type="hidden" name="item_number" value="singleAd_<?php echo $adId; ?>">
			<input type="hidden" name="amount" value="<?php echo $amount; ?>">
			<input type="hidden" name="currency_code" value="<?php echo $currency_code; ?>">
			<input type="hidden" name="button_subtype" value="services">
			<input type="hidden" name="no_note" value="0">
			<input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynowCC_LG.gif:NonHostedGuest">
			<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!" style="border:none !important">
			<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
			</form>
		</div>


		<br><br><br>

		<h1 id="otherPaymentOptionsTitle">[Other payment options]</h1>
		<table id="paymentOptions"><tr><td>

		<span class="campaign"></span><br>
		<span id="camp30days">[
		30 days<br>
		unlimited ads 1.95 €]</span>
		<br>
		<small>(regular 9.95 €)</small><br>
		<br>
		<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
		<input type="hidden" name="cmd" value="_xclick">
		<input type="hidden" name="business" value="adpayments.EU@gmail.com">
		<input type="hidden" name="lc" value="US">
		<input type="hidden" name="item_name" value="CAMPAIGN - 30 days unlimited ads">
		<input type="hidden" name="item_number" value="camp30days_<?php echo $adId; ?>">
		<input type="hidden" name="amount" value="1.95">
		<input type="hidden" name="currency_code" value="EUR">
		<input type="hidden" name="button_subtype" value="services">
		<input type="hidden" name="no_note" value="0">
		<input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynowCC_LG.gif:NonHostedGuest">
		<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!" style="border:none !important">
		<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
		</form>

		</td><td>

		<span class="campaign"></span><br>
		<span id="camp90days">[
		3 months (90 days)<br>
		unlimited ads 4.95 €<br>
		<small>(regular 19.95 €)</small>]</span>
		<br>
		<br>
		<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
		<input type="hidden" name="cmd" value="_xclick">
		<input type="hidden" name="business" value="adpayments.EU@gmail.com">
		<input type="hidden" name="lc" value="US">
		<input type="hidden" name="item_name" value="CAMPAIGN - 3 months (90 days) unlimited ads">
		<input type="hidden" name="item_number" value="camp90days_<?php echo $adId; ?>">
		<input type="hidden" name="amount" value="4.95">
		<input type="hidden" name="currency_code" value="EUR">
		<input type="hidden" name="button_subtype" value="services">
		<input type="hidden" name="no_note" value="0">
		<input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynowCC_LG.gif:NonHostedGuest">
		<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!" style="border:none !important">
		<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
		</form>

		</td>
		<!--
		<tr><td>
		Single ad<br>
		2.95 €<br>
		<br>
		<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
		<input type="hidden" name="cmd" value="_xclick">
		<input type="hidden" name="business" value="adpayments.EU@gmail.com">
		<input type="hidden" name="lc" value="US">
		<input type="hidden" name="item_name" value="Single ad">
		<input type="hidden" name="item_number" value="singleAd_<?php echo $adId; ?>">
		<input type="hidden" name="amount" value="2.95">
		<input type="hidden" name="currency_code" value="EUR">
		<input type="hidden" name="button_subtype" value="services">
		<input type="hidden" name="no_note" value="0">
		<input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynowCC_LG.gif:NonHostedGuest">
		<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!" style="border:none !important">
		<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
		</form>
		</td><td>
		-->

		<td>


		<span id="30days">[
		30 days unlimited<br>
		ads 9.95 €]</span>
		<br>
		<br>
		<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
		<input type="hidden" name="cmd" value="_xclick">
		<input type="hidden" name="business" value="adpayments.EU@gmail.com">
		<input type="hidden" name="lc" value="US">
		<input type="hidden" name="item_name" value="0 days unlimited ads">
		<input type="hidden" name="item_number" value="30days_<?php echo $adId; ?>">
		<input type="hidden" name="amount" value="9.95">
		<input type="hidden" name="currency_code" value="EUR">
		<input type="hidden" name="button_subtype" value="services">
		<input type="hidden" name="no_note" value="0">
		<input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynowCC_LG.gif:NonHostedGuest">
		<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!" style="border:none !important">
		<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
		</form>

		</td><td>

		<span id="90days">[
		3 months (90 days)<br>
		unlimited ads 19.95 €]</span>
		<br>
		<br>
		<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
		<input type="hidden" name="cmd" value="_xclick">
		<input type="hidden" name="business" value="adpayments.EU@gmail.com">
		<input type="hidden" name="lc" value="US">
		<input type="hidden" name="item_name" value="3 months (90 days) unlimited ads">
		<input type="hidden" name="item_number" value="3months_<?php echo $adId; ?>">
		<input type="hidden" name="amount" value="19.95">
		<input type="hidden" name="currency_code" value="EUR">
		<input type="hidden" name="button_subtype" value="services">
		<input type="hidden" name="no_note" value="0">
		<input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynowCC_LG.gif:NonHostedGuest">
		<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!" style="border:none !important">
		<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
		</form>

		</td></tr></table>

	</div> <!-- ========================================= END payPal ========================================= -->




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
<input id="phpPageName" type="hidden" value="payment"> 
<!-- <input id="currentSingleAd" type="hidden">-->

<?php include_once('footer.php'); ?>


<?php
/*
CAMPAIGN 30 days email:

https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business=adpayments%2eEU%40gmail%2ecom&lc=US&item_name=CAMPAIGN%20%2d%2030%20days%20unlimited%20ads&item_number=camp30days&amount=1%2e95&currency_code=EUR&button_subtype=services&no_note=0&bn=PP%2dBuyNowBF%3abtn_buynowCC_LG%2egif%3aNonHostedGuest

CAMPAIGN 90 days email:
https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business=adpayments%2eEU%40gmail%2ecom&lc=US&item_name=CAMPAIGN%20%2d%203%20months%20%2890%20days%29%20unlimited%20ads&item_number=camp90days&amount=4%2e95&currency_code=EUR&button_subtype=services&no_note=0&bn=PP%2dBuyNowBF%3abtn_buynowCC_LG%2egif%3aNonHostedGuest

single ad email:
https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business=adpayments%2eEU%40gmail%2ecom&lc=US&item_name=Single%20ad&item_number=singleAd&amount=2%2e95&currency_code=EUR&button_subtype=services&no_note=0&bn=PP%2dBuyNowBF%3abtn_buynowCC_LG%2egif%3aNonHostedGuest

30 days email:
https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business=adpayments%2eEU%40gmail%2ecom&lc=US&item_name=0%20days%20unlimited%20ads&item_number=30days&amount=9%2e95&currency_code=EUR&button_subtype=services&no_note=0&bn=PP%2dBuyNowBF%3abtn_buynowCC_LG%2egif%3aNonHostedGuest

3 months 90 days email:
https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business=adpayments%2eEU%40gmail%2ecom&lc=US&item_name=3%20months%20%2890%20days%29%20unlimited%20ads&item_number=3months&amount=19%2e95&currency_code=EUR&button_subtype=services&no_note=0&bn=PP%2dBuyNowBF%3abtn_buynowCC_LG%2egif%3aNonHostedGuest 
*/



/* ================================= functions ============================================ */
function getAdPrice($adId,$conn) {
	$adPriceRes = mysqli_query($conn, "SELECT countryGeoId,price FROM ads WHERE id=$adId LIMIT 1");
	if (mysqli_num_rows($adPriceRes) > 0) { 
		while($row = mysqli_fetch_assoc($adPriceRes)) { 
			//$countryGeoId = $row["countryGeoId"];
			//$amount = $row["price"];
			return  $row["countryGeoId"].'#'.$row["price"];
			//if($countryGeoId != '') { echo "<br>countryGeoId (frm DB): $countryGeoId"; }
			//if($amount != '') { echo "<br>AdPrice (frm DB): $amount"; }
			////if($code != '') { echo "<br>code: $code"; } else { echo '<br> code is empty';}
		}
	} else {
		return ''; // error
	}
}

function getCodeType($code,$conn) {
	$res = mysqli_query($conn, "SELECT typeId FROM codes WHERE code='$code' LIMIT 1");
	if ($res) { 
		while($row = mysqli_fetch_assoc($res)) { 
			return $row["typeId"];
		}
	}
	return '';
}

function getUserType($userSafeId,$conn) {
	$isCompanyRes = mysqli_query($conn, "SELECT isCompany FROM users WHERE safeId='$userSafeId' LIMIT 1");
	if (mysqli_num_rows($isCompanyRes) > 0) { 
		while($row = mysqli_fetch_assoc($isCompanyRes)) { 
			return $row["isCompany"];
		}
	}
	return '';
}
function validateCodeTypeAgainstUserType($codeExists,$isCompany,$code,$conn) {
	$err = '';
	switch ($codeExists) {
		case '0': // multi use private
		case '2': // single use private
			if($isCompany == '1') { 
				$err .= "<br>Error, your code can be used only for a company ad."; 
			} else {
				if($codeExists == '0') { updateMultiUseCodeNumber($code,$conn); }
				if($codeExists == '2') { setSingleUseCodeInActive($code,$conn); }
			}
			 break; 
		case '1': // multi use company
		case '3': // single use company
			if($isCompany == '1') {
				$err .= "<br>Error, your code can be used only for a private person ad."; 
			} else {
				if($codeExists == '1') { updateMultiUseCodeNumber($code,$conn); }
				if($codeExists == '3') { setSingleUseCodeInActive($code,$conn); }
			}
			break; 
	}
	return $err;
}

function setSingleUseCodeInActive($code,$conn) {
	// set code isActive=0
	$sql = "UPDATE codes SET isActive=0 WHERE code='$code'";
	echo 'setSingleUseCodeInActive SQL: $sql';
	$conn->query($sql) or die("Error in using code: " . mysql_error());
}

function updateMultiUseCodeNumber($code,$conn) {
	// get existing numbers
	$arr = getCodeUsageNumbers($code,$conn);
	$timesUsed = (int)(explode('#',$arr)[0]);
	$totMaxUses = (int)(explode('#',$arr)[1]);

	if($timesUsed >= $totMaxUses) { echo "We are sorry, the code usage has reached it's limit."; exit; }
	$timesUsed++;
	updateCodeUsageNumbers($code,$timesUsed,$conn);
}

function getCodeUsageNumbers($code,$conn) {
		$res = mysqli_query($conn, "SELECT timesUsed,totMaxUses FROM codes WHERE code='$code' LIMIT 1");
		if ($res) { 
			while($row = mysqli_fetch_assoc($res)) { 
				return $row["timesUsed"].'#'.$row["totMaxUses"];
			}
		}
		return '';
}

function updateCodeUsageNumbers($code,$timesUsed,$conn) {
	$sql = "UPDATE codes SET timesUsed=$timesUsed WHERE code='$code'";
	echo 'updateCodeUsageNumbers SQL: $sql';
	$conn->query($sql) or die("Error in using code: " . mysql_error());
}
?>

