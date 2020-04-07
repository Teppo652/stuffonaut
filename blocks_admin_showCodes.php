<?php
include_once('functions.php');
$thisPage = 'admin_showCodes.php';
include_once('header.php');
$conn = getDBConn();
$table = 'codes';

// ----------------------- TESTING ------------------------:
$countryGeoId = '2661886';

// TODO check that user is admin or is allowed to access this page

// INIT
$typeId = $userSafeId = $startDate = $expiryDate = $maxUsesPerUser = $numOfCodes = $userSafeIdArr = $searchTerm = '';
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
								<h1 id="codesPageTitle" style="margin:-25px 0 0 0;text-align:left">Show codes</h1>
							</div>
							<div class="row col m6" style="text-align:right">
							  		<a href="admin_createCodes.php" class="button">Create codes</a>
							  		<!--<a href="admin_showCodes.php" class="_primary button" selected>Show codes</a>-->
							</div>

							<div class="row" class="col m12" style="clear:left;float:left">
							<!-- end inner header -->

<?php			
/* =================================== POST=========================================== */
if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST') {
	//$allPostedVals = '';
	$formFields = "typeId,searchTerm,countryGeoId,userSafeId,startDay,startMonth,startYear,endDay,endMonth,endYear";
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
$types = '<option value="9999" selected>--- All ---</option>' . $types;
?>


								<!-- ----------------- Show codes ------------------------- --> 
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
				                		<div class="col m3"> <!-- search -->
											<label for="searchTerm">Search by code</label>
				                			<input id="searchTerm" name="searchTerm" class="_full-width" value="<?php echo $searchTerm; ?>" style="float: left;clear:left;width:140px;border-radius:4px !important;height:34px !important">
				                		</div>
				                		<div class="col m1"> <!-- btn -->
				                			<input id="updateBtn" class=" _primary button" type="submit" value="Show" style="float:right !important;margin-top:25px;height: 36px !important">
				                		</div>
				                	</div>
								</div>
								<div class="col m12" style="float:left;clear:left"> <!-- listing -->
				<?php
				/*

				X used codes only (from codeUsed table)
				List codes:
				type code dateUsed adId

				*/
				if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST') {
						if($searchTerm == '') {
						$sql = "SELECT * FROM $table WHERE countryGeoId=$countryGeoId";
						if($typeId != '' && $typeId != '9999') { $sql .= " AND typeId=$typeId";}
						$sql .= " ORDER BY id";
					} else {
						// search by searchTerm
						$sql = "SELECT * FROM $table WHERE countryGeoId=$countryGeoId AND code LIKE '" . $searchTerm . "'"; 
					}
					echo  "SQL:$sql";

					$result = mysqli_query($conn, $sql); 
					if (mysqli_num_rows($result) > 0) 
					{ 

						echo "<table><thead><tr>";
						echo "<td>Id</td>";
						//echo "<td>Type</td>";
						echo "<td>Code</td>";
						//echo "<td>dateUsed</td>";
						//echo "<td>adId</td>";
						echo "<td>Star tDate</td>";
						echo "<td>Expiry Date</td>";
						echo "<td>Times Used</td>";
						echo "<td>TotMax Uses</td>";
						echo "<td>maxUses PerUser</td>";
						echo "<td>Active</td>";
						echo "</tr></thead><tbody>";
						while($row = mysqli_fetch_assoc($result)) 
						{
							echo "<tr><td>" . $row["id"] . '</td>';
							//echo "<td>" . $typesArr[ $row["typeId"] ] . '</td>';
							echo "<td>" . $row["code"] . '</td>';
							//echo "<td>" . $row["userSafeId"] . '</td>';
							//7echo "<td>" . $row["dateUsed"] . '</td>';
							//7echo "<td>" . $row["adId"] . '</td>';
						if($row["startDate"]  != 0) { echo "<td>" . $row["startDate"] . '</td>'; } else { echo "<td></td>";}
						if($row["expiryDate"] != 0) { echo "<td>" . $row["expiryDate"] . '</td>'; } else { echo "<td></td>";}
						if($row["timesUsed"]  != 0) { echo "<td>" . $row["timesUsed"] . '</td>'; } else { echo "<td></td>";}
						if($row["totMaxUses"] != 0) { echo "<td>" . $row["totMaxUses"] . '</td>'; } else { echo "<td></td>";}
						if($row["maxUsesPerUser"] != 0) { echo "<td>" . $row["maxUsesPerUser"] . '</td>'; } else { echo "<td></td>";}
						if($row["isActive"] != 0) { echo "<td>" . $row["isActive"]	 . '</td></tr>'; } else { echo "<td></td>";}
						}
						echo "</tr></tbody><table>";
					} else { echo "<br><b>Found 0 items</b>"; }


				} else { 
					// NOT A POST - GET TOTAL NUMBERS
					// page load
					//$sql = "SELECT * FROM $table WHERE countryGeoId=$countryGeoId";
					//$sql = "SELECT DISTINCT countryGeoId FROM $table"; // SELECT COUNT (DISTINCT Country)
					//$sql = "SELECT countryGeoId,(COUNT( DISTINCT countryGeoId) as tot) FROM $table";
					//$sql = "SELECT countryGeoId,COUNT( DISTINCT countryGeoId) as tot FROM $table";

					// working
					//$sql = "SELECT countryGeoId,COUNT(countryGeoId) as tot FROM $table";
					/////$sql = "SELECT DISTINCT typeId,countryGeoId,COUNT(countryGeoId) as tot FROM $table";
					//$sql .= " GROUP BY countryGeoId";

					$sql = "SELECT countryGeoId,typeId,COUNT(countryGeoId) as tot FROM codes GROUP BY countryGeoId,typeId";
					//$sql .= " ORDER BY id";
					// echo  "SQL:$sql<br><br>";";
					echo  'Number of codes in each country:<br><table>';

					$result = mysqli_query($conn, $sql); 
					if (mysqli_num_rows($result) > 0) 
					{ 
						while($row = mysqli_fetch_assoc($result)) 
						{
							echo "<tr><td>" . getCountryName($row["countryGeoId"]) . '</td><td>' . $typesArr[ $row["typeId"] ]. '</td><td>' . $row["tot"] . "</td></tr>";
						}
					}
					echo  "</table>";
				}

				?>
							<!-- start inner footer -->	
						</div> <!-- listing -->

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


function getCountryName($countryGeoId) {
	switch ($countryGeoId) {
		case '660013': return 'Finland'; break;
		case '2661886': return 'Sweden'; break;
	}
}
?>
<style>
	select {
		border-radius: 4px;
	    height: 34px !important;
	}
	select, option {
		color: #5d5d5d;
	}
	#userIdToggle {
		float: right;
	    height: 22px;
	    padding: 4px 12px;
	    font-size: 11px;
	}
	th, td {
		padding: 1px 15px;
	}
</style>