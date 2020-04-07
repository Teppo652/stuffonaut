<?php
include_once('functions.php');
$thisPage = 'admin_showCodes.php';
include_once('header.php');


?>
<div class="bg">
		<div class="content">
			<div class="row">
				<div class="col m12">
					<div class="row iCol2" style="background-color:#fff;border: solid 1px #d5d4d4;padding:10px;border-radius:3px">

						<form method="post" action="<?php echo $thisPage; ?>" style="text-align:left">
							<div class="row col m6" style="margin-top:-10px">
								<h1 id="codesPageTitle" style="margin:-25px 0 0 0;text-align:left">Marketing material</h1>
							</div>
							<div class="row col m6" style="text-align:right">

							</div>

							<div class="row" class="col m12" style="clear:left;float:left">
							<!-- end inner header -->

<?php			
/* =================================== POST=========================================== */
if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST') {
	//$allPostedVals = '';
	$formFields = "country";
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


?>


								<!-- ----------------- Show codes ------------------------- -->
							  	<div class="col m12">
									<div id="createCodePanel">
										<div class="col m3"> <!-- country -->
											<label for="country">Country</label>
											<select id="country" name="countryGeoId" class="area" style="margin-top:0px">
												<option value="0">Sweden</option>
												<option value="1">Finland</option>
											</select>
				                		</div>

										<div class="col m5"> <!-- type -->
											<label for="typeId">Type</label>
				                			<select id="typeId" name="typeId" class="_full-width" style="width:380px">
												<option value="1">To person email to blocket user</option>
												<option value="1">To company email to blocket user</option>
												<option value="0">To person email</option>
												<option value="1">To company email</option>
											</select>
				                		</div>
				                		<div class="col m3"> <!-- code -->
											<label for="searchTerm">Code</label>
				                			<input id="searchTerm" name="searchTerm" class="_full-width" value="" style="float: left;clear:left;width:140px;border-radius:4px !important;height:34px !important">
				                		</div>
				                		<div class="col m1"> <!-- btn -->
				                			<input id="updateBtn" class=" _primary button" type="submit" value="Show" style="float:right !important;margin-top:25px;height: 36px !important">
				                		</div>
				                	</div>
								</div>

								

								<div id="material">
									<div class="col m12">
										<!-- title -->
										<label for="subject">Subject</label>
										<input id="subject"class="autocopy"  type="text" style="width: 100%" value="Otsikko tähän">
									</div>
									<div class="col m12">
										<label for="message">Message</label>
										<textarea id="message" class="autocopy" style="text-align:left !important;width:100%;min-height:100px;">
												Hei!
												Kiitos kun olet asiakkaamme. Lahjoitamme nyt kaikille ilmaisen 3 kk jäsenyyden www.stuffonaut.com -palveluun.

												Mikä on Stuffonaut?

										</textarea>
								</div>
								</div>
								<div class="col m12" style="float:left;clear:left"> <!-- listing -->
				

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

<style>
	select {
		border-radius: 4px;
	    height: 34px !important;
	}
	select, option {
		color: #5d5d5d;
	}
	#subject, #message {
		background-color: #ffff9a;
	}
</style>
<script>
$(document).ready(function(){
	
	// copiableRow clicked
    $("#material").on("click", ".autocopy", function(e){
        var str = $(this).val();
        navigator.clipboard.writeText(str);   
        /* https://stackoverflow.com/questions/400212/how-do-i-copy-to-the-clipboard-in-javascript */ 
        // change bg color
        $(this).css("background-color","gray");
    });

});	
</script>