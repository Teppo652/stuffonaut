<?php
/* paypal buy now buttons */
include_once('functions.php');
$thisPage = 'joinUs.php';
include_once('header.php');
$conn = getDBConn();
$code = $selTab = '1'; // temp



$criteria = 'Physically disabled_Have long term disease_Racially disadvantaged_Easily age discriminated (over 50, under 20)_Unemployed for more than 6 months_Very low income (below poverty line)_Homeless_Gender disadvantaged (women, other gender)_Sufferers of violence, bodily abuse, substance abuse_Are pregnanat/on motherleave_Suffer from recent loss of a close person_Health threatning obese_Have criminal record_Is currently imprisoned_Other_None';
$position = 'Representative,Translator,Area manager,Country manager,Open application';

$criteriaArr = explode('_', $criteria);
$positionArr = explode(',', $position);
/* ============================ post ============================ */

if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST')
{
	var_dump($_POST);
	echo '<br><br>';

  	if(isset($_POST["adId"])) { 
		$adId = test_input($_POST["adId"]);
	}
}// else { echo '<br>Something went wrong. Can not load page.'; exit; }

?>
<div class="bg">
		<div class="content">

			<div class="row">
				<div class="col m9">
					<div class="paymentPanel" class="row iCol2" style="text-align: left;">

						<h1>Join Us!</h1>

						<p id="paymentPageTopText"><b>
<!-- Important note: We hire only disadvantaged people. Healthy young white people have high chance of getting work, our mission is to hire people solely from the other groups.-->
	
Stuffonaut is a different employer.<br>
We especially encourage persons to apply who are; or are under the threath of having to any of the conditions mentioned in the following list:<br>

	
	<?php
	/*
	$next = "<ul style='width=50%;float:left'>";
	echo "<div style='clear:left'>" . $next;
	for($i=0; $i<count($criteriaArr); $i++) { 
		echo "<li>- $criteriaArr[$i]";
		if((int)$i==count($criteriaArr)+1) { echo "</ul>$next"; } 
	} */
	?>
	<!--</ul></div>-->

</b><br><br><br> 





						</p><br><br>


<!-- --------------------- TAB LINKS ----------------------- -->
<div class="tab">
  <button class="tablinks<?php if($selTab == '1') { echo ' active'; } ?>" style="display: block;" onclick="opentab('tab1')">Suitability</button>
  <button class="tablinks" onclick="opentab('tab2')">Open positions</button>
  <button class="tablinks" onclick="opentab('tab3')">Apply</button>
</div>






<!-- --------------------- TAB CONTENTS ----------------------- -->

<!-- 1 -->
<div id="tab1" class="tabcontent" style="display: <?php if($selTab == '1') { echo 'block'; } else { echo 'none'; } ?>;" >

Are you a suitable candidate for us?<br><br>

We are looking to hire people who fulfill one or several of the following criteria:
<ul>
	<?php 
	for($i=0; $i<count($criteriaArr); $i++) { echo "<li>$criteriaArr[$i]"; } 
	?>
</ul>

Any condition criteria used in application must be proven with documentation and a contact reference.<br>
</div>


<!-- 2 -->
<div id="tab2" class="tabcontent">
  
</div>



<!-- 3 -->
<div id="tab3" class="tabcontent">	
	<form>
		<div class="row">

			<div class="row m12">

				<h2>Application</h2>
				<div class="progressbar _box">
				  <div class="-bar _primary" style="width:33%">
				  	<div class="-label">Step 1/3</div>
				  </div>
				</div>

			</div>

			<div class="col m6">
				<label for="position">Position</label>
				<select id="position" class="_width100"> 
				<?php
				for($i=0;$i<count($positionArr); $i++) { 
				 	echo "<option value='" . $i . "'>$positionArr[$i]</option>";
				 } 
				 ?>
				</select>
			</div>
			<div class="col m6">
				<label for="languageSelector">Mother tongue</label>
				<select id="languageSelector" class="_width100">
					<!--<option value="en">English (English)</option><option value="fi">Suomi (Finnish)</option><option value="sv" selected="">Svenska (Swedish)</option>-->
				</select>
			</div>
		</div>

		<div class="row">
    		<div class="col m6">
				<label for="criteria">Criteria</label>
				<select id="criteria" class="_width100"> 
				<?php
				for($i=0;$i<count($criteriaArr); $i++) { 
				 	echo "<option value='" . $i . "'>$criteriaArr[$i]</option>";
				 } 
				 ?>
				</select>
			</div>
			<div id="selectedCriterias" class="col m6" style="margin-top: 30px;">
				<button class="_round _success">Crit 1</button>
				<button class="_round _success">Crit 2</button>
				<button class="_round _success">Crit 3</button> 
			</div>
		</div>

		<div class="row">
    		<div class="col m12">
				<label for="introduction">Introduction</label>
				<textarea id="introduction" name="introduction"></textarea>
			</div>
		</div>

	</form>

</div>





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

<?php include_once('footer.php'); ?>
<style>
#selectedCriterias {

}
.selCrit {
	padding: 10px 20px;
	background-color: blue;
	margin: 3px 12px;
}

</style>
