<?php
include_once('functions.php');
$thisPage = 'admin_createCodes.php';
include_once('header.php');
$conn = getDBConn();
$table = 'codes';

// ----------------------- TESTING ------------------------:
$countryGeoId = '2661886';

// TODO check that user is admin or is allowed to access this page

// INIT
$typeId = $userSafeId = $startDate = $expiryDate = $maxUsesPerUser = $numOfCodes = $userSafeIdArr = '';
$types = 'A Multi use - private - Any category,B Multi use - company - Any category,C Single use - private - Any category
,D Single use - company - Any category,E Multi use - company - Vehicles category';
$typesArr = explode(',',$types);
$types = '';
$action = '';

$timesUsed = NULL;
$totMaxUses = NULL;
$isActive = 1;


?>
<div class="bg">
		<div class="content">
			<div class="row">
				<div class="col m12">
					<div class="row iCol2" style="background-color:#fff;border: solid 1px #d5d4d4;padding:10px;border-radius:3px">

						<form method="post" action="<?php echo $thisPage; ?>" style="text-align:left">
							<div class="row col m6" style="margin-top:-10px">
								<h1 id="codesPageTitle" style="margin:-25px 0 0 0;text-align:left">Create codes</h1>
							</div>
							<div class="row col m6" style="text-align:right">
							  		<!--<a href="admin_createCodes.php" class="_primary button" selected>Create codes</a>-->
							  		<a href="admin_showCodes.php" class="button">Show codes</a>
							</div>

							<div class="row" class="col m12" style="clear:left;float:left">
							<!-- end inner header -->

<?php	
/* =================================== POST=========================================== */
if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST') {
	//$allPostedVals = '';
	$formFields = "typeId,countryGeoId,maxUsesPerUser,numOfCodes,userSafeId,startDay,startMonth,startYear,endDay,endMonth,endYear";
	$formFieldsArr = explode(',', $formFields);
	for($i = 0; $i < count($formFieldsArr); $i++) {
		//echo "<br>TRYING TO READ POSTED - " . $formFieldsArr[$i]; 

		$fieldName = $formFieldsArr[$i];
		if(isset($_POST["$fieldName"])) { 
			$$fieldName = $_POST["$fieldName"];
			//$allPostedVals .= $_POST["$fieldName"] . ' ';
			//echo "POSTED - $fieldName: " . $_POST["$fieldName"] . "<br>";
		} else { $$fieldName = ''; }
		
	}

	// Validate
	$err = '';
	if($typeId == '-1') { $err .= '<br>Select Type'; }

	
	if($userSafeId != '' && $maxUsesPerUser !='' && $typeId == '2') {
		$err .= '<br>Max uses per user  for Single use -type cannot be more than 1';		
	}
	if($userSafeId != '' && $maxUsesPerUser !='' && $typeId == '3') {
		$err .= '<br>Max uses per user  for Single use -type cannot be more than 1';	
	}

	// switch(codeType) {
	// 	case '0': break; // multiUse_private_anyCategory
	// 	case '1': break; // multiUse_company_anyCategory
	// 	case '2': break; // singleUse_private_anyCategory
	// 	case '3': break; // singleUse_company_anyCategory
	// 	case '4': break; // multiUse_company_vehiclesCategory
	// }

	// type: -1
	// maxUsesPerUser: 
	// userId: 

	// validate start dates

	if($startDay . $startMonth . $startYear != '') {
		if($startDay == '') { $err .= '<br>Select start Day'; }
		if($startMonth == '') { $err .= '<br>Select start Month'; }
		if($startYear == '') { $err .= '<br>Select start Year'; }
		$startDate = $startYear . $startMonth . $startDay;
	}
	// validate expiry dates
		if($endDay . $endMonth . $endYear != '') {
		if($endDay == '') { $err .= '<br>Select end Day'; }
		if($endMonth == '') { $err .= '<br>Select end Month'; }
		if($endYear == '') { $err .= '<br>Select end Year'; }
		$expiryDate = $endYear . $endMonth . $endDay;
	}
	
	// ------------------ save in DB ------------------------- 
	if($err == '') {

	if($userSafeId != '') {
		if(strpos($userSafeId, ",")) {

			$userSafeIdArr = explode(',', $userSafeId);
			$numOfCodes = (int)(count($userSafeIdArr));
		}
	}

	echo "<br>Saved code(s): "; 

	// iterate x times
	$numOfCodes = (int)$numOfCodes;
		for($a=0; $a<$numOfCodes; $a++) {
			if($userSafeId != '' && count($userSafeIdArr) > 1) { $userSafeId = $userSafeIdArr[$a]; }
			// generate code
			$code = generateRandomString(10, $conn, 'allCapitals', $table, 'code');

			$saveFields = "countryGeoId,typeId,code,userSafeId,startDate,expiryDate,timesUsed,totMaxUses,maxUsesPerUser,isActive";
	    	//$saveValues = $countryGeoId . "," . $typeId . ",'" . $code . "'," . $userId . "," . $startDate . "," . $expiryDate . "," . $timesUsed . "," . $totMaxUses . "," . $maxUsesPerUser . "," . $isActive;

	    	$saveValues = "'" .$countryGeoId . "','" . $typeId . "','" . $code . "','" . $userSafeId . "','" . $startDate . "','" . $expiryDate . "','" . $timesUsed . "','" . $totMaxUses . "','" . $maxUsesPerUser . "','" . $isActive . "'";

			// echo '<br>saveValues: ' . $saveValues;

			$insert_id = saveInDb($table,$saveFields,$saveValues,$conn);
			echo " $code";
		}
	} else { // err == ''
		echo '<div style="color:red">Errors:<br>' . $err . '</div>';

	}
} // if post

// init types
$isSelected = '';
for($i=0; $i<count($typesArr); $i++) {
	if((int)$typeId == $i) { $isSelected = ' selected'; } else { $isSelected = ''; }
	//if($typeId == '' && $i == 0) { 
	//	$types .= '<option value="-1" selected>--- Select ---</option>';
	//} else if($i == 0){ $types .= '<option value="-1">--- Select ---</option>'; }
	$types .= '<option value="' . $i . '"'.$isSelected.'>' . $typesArr[$i] . '</option>';
}

?>


								<!-- ----------------- create codes ------------------------- --> 
							<!--
							  	<div class="col m6">
								<div id="createCodePanel">
									
									<div class="col m6"> <!-- country 
										<label for="country">Country</label>
										<select id="country" name="countryGeoId" class="area" style="margin-top:0px"></select>
			                		</div>

									<div class="col m6"> <!-- type 
										<label for="typeId">Type</label>
			                			<select id="typeId" name="typeId" class="_full-width" style="width:420px"><?php echo $types; ?></select>
			                		</div>
			                -->
			                	<div class="col m12">
									<div id="createCodePanel">
										<div class="col m3"> <!-- country -->
											<label for="country">Country</label>
											<select id="country" name="countryGeoId" class="area" style="margin-top:0px"></select>
				                		</div>

										<div class="col m5"> <!-- type -->
											<label for="typeId">Type</label>
				                			<select id="typeId" name="typeId" class="_full-width" style="width:380px"><?php echo $types; ?></select>
				                		</div>
				                		<div class="col m3"> <!-- numOfCodes -->
			                				<label for="numOfCodes">Number of codes</label><br>
											<input type="text" id="numOfCodes" name="numOfCodes" class="_full-width" value="<?php echo $maxUsesPerUser; ?>" value="<?php echo $numOfCodes; ?>" style="float: left;clear:left;width:60px;border-radius:4px !important;height:34px !important"> 
											<button id="moreBtn" class="button" style="width:40px;padding:4px 8px;font-size:25px;height:37px">&plus;</button>
				                		</div>
				                		<div class="col m1"> <!-- btn -->
				                			<input id="createBtn" class=" _primary button" type="submit" value="Create" style="float:right !important;margin-top:25px;height: 36px !important">
				                		</div>
				                	</div>
								</div>
								<!--<div class="col m12" style="float:left;clear:left;height:1px;margin-top:-30px"></div>-->
			                		<div id="morePanel" class="col m12 hidden"  style="float:left;clear:left;margin:-50px 0 0 15px">
				                		<div class="col m3 iCol"> <!-- startDate -->
											<label for="startDay">Start date</label>
											<!-- day -->
				                			<select id="startDay" name="startDay" class="" style="clear:left;width:54px">
				                				<option value="">dd</option><?php echo getDateSelector('days',$startDay); ?></select> 
											<!-- month -->
				                			<select id="startMonth" name="startMonth" class="" style="width:54px">
				                				<option value="">mo</option><?php echo getDateSelector('months',$startMonth); ?></select> 
											<!-- year -->
				                			<select id="startYear" name="startYear" class="" style="width:70px">
				                				<option value="">yyyy</option><?php echo getDateSelector('years',$startYear); ?></select> 
				                		</div>

				                		<div class="col m3 iCol"> <!-- expiryDate -->
				                			<label for="endDay">Expiry date</label>
											<!-- day -->
				                			<select id="endDay" name="endDay" class="" style="clear:left;width:54px">
				                				<option value="">dd</option><?php echo getDateSelector('days',$endDay); ?></select> 
											<!-- month -->
				                			<select id="endMonth" name="endMonth" class="" style="width:54px">
				                				<option value="">mm</option><?php echo getDateSelector('months',$endMonth); ?></select> 
											<!-- year -->
				                			<select id="endYear" name="endYear" class="" style="width:70px">
				                				<option value="">yyyy</option><?php echo getDateSelector('years',$endYear); ?></select> 
				                		</div>

				                		<div class="col m4"> <!-- Define user - userSafeId -->
				                			<button id="userIdToggle" style="margin-top:25px">Define user</button>
				                			<span id="userSafeIdPanel" class="hidden" style="float:left">
												<label for="userSafeId">User ID</label>
					                			<textarea id="userSafeId" name="userSafeId" class="_width100" style="height:200px" placeholder="userSafeId1,userSafeId2,userSafeId 3"><?php echo $userSafeId; ?></textarea>
					                		</span>
				                		</div>

				                		<div class="col m2"> <!-- maxUsesPerUser -->
				                			<label for="maxUsesPerUser">Max uses per user</label><br>
											<input type="text" id="maxUsesPerUser" name="maxUsesPerUser" class="_full-width" style="float: left;clear:left;width:60px" value="<?php echo $maxUsesPerUser; ?>"> 
										</div>
				                	</div>
								</div>







							<!-- start inner footer -->	
							</div>

						</form>
					</div>
				</div>
			</div> <!-- row -->

		</div>
	</div>

<!-- hidden settings -->
<!-- <input id="currentSingleAd" type="hidden">-->

<?php include_once('footer.php'); ?>

<?php
/* ========================= functions ============================== */



function getDateSelector($getWhat,$selVal='') {
	$yr = $mo = $d = $isSelected = '';
	$years = $months = $days = '';
	for($d=1; $d<32; $d++) {
		if(strlen($d)<2) { $d = '0'.$d; }
		if($getWhat == 'days' && $selVal == $d) { $isSelected = ' selected'; } else { $isSelected = ''; }
		$days .= '<option value="'.$d.'"'.$isSelected.'>'.$d.'</option>'; 
	}
	for($mo=1; $mo<13; $mo++) {
		if(strlen($mo)<2) { $mo = '0'.$mo; }
		if($getWhat == 'months' && $selVal == $mo) { $isSelected = ' selected'; } else { $isSelected = ''; }
		$months .= '<option value="'.$mo.'"'.$isSelected.'>'.$mo.'</option>';
	}
	for($yr=19; $yr<22; $yr++) {
		if($getWhat == 'years' && $selVal == $yr) { $isSelected = ' selected'; } else { $isSelected = ''; }
		$years .= '<option value="'.$yr.'"'.$isSelected.'>20'.$yr.'</option>';
	}
	switch ($getWhat) {
		case 'years': return $years; break;
		case 'months': return $months; break;
		case 'days': return $days; break;
	}
}

?>
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
<script>
	$("#moreBtn").click(function(e){
	  	e.preventDefault();
		if($("#morePanel").hasClass("hidden")) {
			$("#morePanel").removeClass("hidden");
		} else {
			$("#morePanel").addClass("hidden");
		}
	});
	$("#userIdToggle").click(function(e){
	  	e.preventDefault();
		if($("#userSafeIdPanel").hasClass("hidden")) {
			$("#userSafeIdPanel").removeClass("hidden");
		} else {
			$("#userSafeIdPanel").addClass("hidden");
		}
	});
</script>
