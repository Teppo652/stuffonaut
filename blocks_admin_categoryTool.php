<?php
include_once('functions.php');
$thisPage = 'categoryTool.php';
include_once('header.php');
$conn = getDBConn();
$table = "categories_test";
$table = "categories";

$parentCat = '';
/*
drop table categories_NEW;
create table categories_NEW (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,parentId INT,countryId INT,langId INT,name VARCHAR(50),catDesc VARCHAR(200),orderId TINYINT UNSIGNED,active TINYINT UNSIGNED);


*/
// ******TEMP ******
$lang = 'sv';

$formFields = "parentCat,lang,placeAfterCat,data";
$formFieldsArr = explode(',', $formFields);

$saveFields = 'id,parentId,countryId,langId,name,extraId,orderId,catAdTypes,totalAds,active';

// init save fields
$fieldName = '';
$saveFieldsArr = explode(',', $saveFields);
for($i = 0; $i < count($saveFieldsArr); $i++) { $fieldName = $saveFieldsArr[$i]; $$fieldName = ''; }
$res = $data = '';

/*
Category tool 1.0

$fieldName = $allFieldsArr[$i];
	$$fieldName = '';

lang drop

Listing of current categories (in this lang)

ParentCategory (jos level > 0) drop (päivittyy aina kun 
textarea

save btn - saves and updates listing
-----------------------------------------------------------------------------------
*/
$parentCats = '';
$lang = '1';

$options = '';
// get all categories from DB
	//$sql = "SELECT * FROM $table WHERE lang=$lang ORDER BY id";
	$sql = "SELECT * FROM $table ORDER BY orderId";
	//echo '<br>sql: ' . $sql;
	$result = mysqli_query($conn, $sql); 
	//if (mysqli_num_rows($result) > 0) 
	if(mysqli_query($conn, $sql))
	{ 
		/*
id:1
parentId:
countryId:1
langId:1
name:A
extraId:
orderId:
catAdTypes:
totalAds:0
active:1
		*/
		while($row = mysqli_fetch_assoc($result)) { 
			$options .= '<option value="' . $row["id"] . '">' . $row["name"] . '</option>';
			//	$res .= '<li>';
			//	$res .= "id: " . $row["id"];
			//	$res .= " parentId: " . $row["parentId"];
			//	$res .= " name: " . $row["name"];

				/*
			for($i = 0; $i < count($saveFieldsArr); $i++) {
				//$res .= "<li>$saveFieldsArr[$i]:" . $row["$saveFieldsArr[$i]"] . '</li>';
				switch ($fieldName) {
					case 'id': $id = $row["$fieldName"]; break; // parent id
					case 'catId': $catId = $row["$fieldName"]; break; // largest value from DB
					case 'parentId': $parentCats .= '<option value="' . $id . '">' . $row["$fieldName"] . '</option>'; break;
					default:
						$res .= "$fieldName: " . $row["$fieldName"];
						break;
				} // switch
			} // for
				*/
			//$res .= '<li>$row["id"] $row["parentId"] $row["name"]';
			//$res .= " $id $parentId $name";
		} // while
	
		
		$catId = -1; // no cats in this lang
	} else { $res = '<br>No categories exists yet.'; }
	$allCats = $res;

/* ============================== POST =================================== */
$res = 'A;B;C;D;E;F;G';
if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST')
{
	echo '<h2>ALL POSTED: ' . var_dump($_POST) . '</h2><br><br>';
	// get posted data	
	for($i = 0; $i < count($formFieldsArr); $i++) {
		//echo "<br>TRYING TO READ POSTED - " . $formFieldsArr[$i]; 

		$fieldName = $formFieldsArr[$i];
		if(isset($_POST["$fieldName"])) { 
			$$fieldName = $_POST["$fieldName"]; 
			//echo "POSTED - $fieldName: " . $_POST["$fieldName"] . "<br>";
		} else { $$fieldName = ''; }
		
	}

	//echo '<h2>DATA: ' . $data . '</h2>';
	/*
	naisten vaatteet se:
	id	parentId	countryId	langId	name	extraId	orderId	catAdTypes	totalAds	active
// (150,1,1,'Kläder & skor',10,orderId,0,1),



INSERT INTO categories (parentId,countryId,langId,name,extraId,orderId,catAdTypes,totalAds,active) VALUES 
(150,1,1,'Klänningar',10,0,null,0,1),
(150,1,1,'Toppar',10,2,null,0,1),
(150,1,1,'Skjortor & Blusar',10,4,null,0,1),
(150,1,1,'Badkläder',10,6,null,0,1),
(150,1,1,'Stickat',10,8,null,0,1),
(150,1,1,'Koftor & Jumpers',10,10,null,0,1),
(150,1,1,'Hoodies & Sweatshirts',10,12,null,0,1),
(150,1,1,'Kavajer & Västar',10,14,null,0,1),
(150,1,1,'Jackor & Kappor',10,16,null,0,1),
(150,1,1,'Byxor',10,18,null,0,1),
(150,1,1,'Jeans',10,20,null,0,1),
(150,1,1,'Kjolar',10,22,null,0,1),
(150,1,1,'Jumpsuits',10,24,null,0,1),
(150,1,1,'Underkläder',10,26,null,0,1),
(150,1,1,'Sovplagg',10,28,null,0,1),
(150,1,1,'Sportkläder',10,30,null,0,1),
(150,1,1,'Shorts',10,32,null,0,1),
(150,1,1,'Skor',10,34,null,0,1),
(150,1,1,'Accessoarer',10,36,null,0,1),
(150,1,1,'Strumpor & Tights',10,38,null,0,1),
(150,1,1,'Mammakläder',10,40,null,0,1),
(150,1,1,'Övrigt',10,42,null,0,1);



	*/

		$saveFieldsArr = explode(',',$saveFields);
		$subCatsArr = explode(';',$data);
		$res = 'INSERT INTO '.$table.' (id,parentId,countryId,langId,name,extraId,orderId,catAdTypes,totalAds,active) VALUES ';
		$localOrderId = 0;
		// itearate new subcategories           (1,,countryId,sv,',,,,0,1),
		//echo  "<br>subCats: $data";
		//echo  "<br>subCatsArr leng:".count($subCatsArr);

		for($i=0; $i<count($subCatsArr); $i++) {	
			$catId++;
			if($parentCat == -1) { $parentCat = "null"; }
			$parentId = $parentCat; // "null";

			$countryId = '1';
			$langId = '1'; // $lang;
			$name = trim($subCatsArr[$i]);
			$extraId = "null";
			//$orderId = "null";
			if($orderId != '-1') { 
				$currOrderId = $id = $newOrderId = '';
				// GET
				// 	$sql = "UPDATE ads SET stars=$newAverageStars WHERE id=$adId";
				$sql = "SELECT id,orderId FROM $table WHERE orderId=>$orderId ORDER By orderId LIMIT 1";
				echo "<br>GET: $sql";
				//$result = mysqli_query($conn, $sql); 
				//if (mysqli_num_rows($result) > 0){ while($row = mysqli_fetch_assoc($result)) { 
				//	$id = $row["id"]; 
				//	$currOrderId = $row["orderId"]; 
				//} } 

				// UPDATE
				$newOrderId = (int)$currOrderId;
				$newOrderId += 1;
				$sql = "UPDATE $table SET orderId=$newOrderId WHERE id=$id";
				echo "<br>UPDATE: $sql";
				//$conn->query($sql) or die("Error in updating $table : " . mysql_error());

			} // increase other children with >= orderId by one
			$catAdTypes = "null";
			$totalAds = '0';
			$active = '1'; // (1,,1,1,'A',,,,0,1)
/*
d,parentId,countryId,langId,name,orderId,catAdTypes,totalAds,active) VALUES 
(100054,NULL,1,1,'Lägenheter',1,'',0134,1),

(1,,1,1,'A',,,,0,1),
*/
			$res .= "($catId,$parentId,$countryId,$langId,'$name',$extraId,$orderId,$catAdTypes,$totalAds,$active),"; // . "<br>";
			//$res .= "($name),";
			// (,parentId,countryId,,',,,,0,1),

		} // for
		$truncate = "TRUNCATE TABLE $table; ";
		$res = $truncate . substr($res, 0, strlen($res)-1) . ';'; // remove last
	
	// save in DB
	//'(catId,parentId,countryId,langId,name,catDesc,orderId,catAdTypes,totalAds,active)\n'
	//$data .= "(" . $catId . "," . $parentId . $countryId . "," . ",1,1,'" . $subCatsArr[$i] . $m . $localOrderId . $e;


	//$sql = "UPDATE $table SET totalAds=$totalAds WHERE id=$id";
	//$conn->query($sql) or die("Error in updating totalAds : " . mysql_error());
} // POST



?>
<div class="bg">
		<div class="content">

			<div class="row">
				<div class="col m9">
					<div  class="row iCol2">

						<h1>Category tool 1.0</h1>


		                <div class="row">
						    <div class="col m12">
						    	<p>TODO: catId increased by 20 in every row!</p>
						    	<?php echo $allCats; ?>
						    </div>
						</div>

		                <!-- profile image upload form -->
		                <form method="post" action="<?php echo $thisPage; ?>">

		                	<div class="row">
							    <div class="col m6">
							    	<label for="parentCat">Parent category</label>
		                			<select id="parentCat" name="parentCat" class="_full-width">
		                				<option value="-1">--- Select ---</option>
		                				<?php echo $options; ?>
		                			</select>
							    </div>
							    <div class="col m6">
							    	<label for="placeAfterCat">Place after category</label>
		                			<select id="placeAfterCat" name="placeAfterCat" class="_full-width">
		                				<option value="-1">--- Select ---</option>
		                				<?php echo $options; ?>
		                			</select>
							    	<!--
							      	<label for="lang">Language</label>
		                			<select id="lang" name="lang" class="_full-width"></select>
		                			-->
							    </div>
							</div>

							<div class="col m12">
								<label for="data">Add categories (separate with ENTER or ; )</label>
								<textarea id="data" name="data" class="_width100" style="height: 200px" placeholder="Category 1;Category 2;Category 3"><?php echo $res; ?></textarea>
							</div>

							<input class=" _primary button" type="submit" value="Save">
		                	<div class="col m12">
		                		<label for="listing">All categories</label>
		                		<ul id="listing"><?php echo $res; ?></ul>
		                	</div>

		                </form>
					</div>
				</div> 

				<!-- ================== SIDE AREA ================== -->				
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

<?php 
include_once('footer.php');
?>
<script>
$(function() {
	getAllLanguageNames();
});

function getAllLanguageNames() { 
    // 'en_US', 'en', 'pt_BR', 'pt', 'es_ES', 'es'
    $("#lang").html();
    //siteLangs = 'sv,fi,en'; // HUOM!!!! SET IN main.js!!!
    siteLangs = $("#siteLangs").val();
    //alert('siteLangs:'+siteLangs); // $('#languageSelector option:selected').val($("#langCode").val());
    //alert('nyt langCode:'+$("#langCode").val());
    arr = [], siteLangsArr = siteLangs.split(','), style = isSelected = '';
    defaultLang = $("#langCode").val();
    $numCounter = 0;
    $.ajax({
      url: "allLanguageNames.json",
      type: "GET",
      dataType: "text",
      cache: true,
      success: function (result) {
        $.each(JSON.parse(result), function (key,item) {
            // style = siteLangsArr.indexOf(key) != -1 ? ' style="background-color:#0A67C7;color:#fff" ' : ' disabled '; // set style to siteLangs
            isSelected = key == defaultLang ? ' selected ' : ''; // set default language as selected
            // arr.push('<option value="' + key + '"' + style + isSelected + '>' + item.native + ' (' + item.name +  ')</option>');
            
            // list all languages
            // $("#languageSelector").append('<option value="' + key + '"' + style + isSelected + '>' + item.native + ' (' + item.name +  ')</option>');
            // list only languages in use
            //siteLangsArr.indexOf(key) != -1 ? $("#languageSelector").append('<option value="' + key + '"' + style + isSelected + '>' + item.native + ' (' + item.name +  ')</option>') : null;
            siteLangsArr.indexOf(key) != -1 ? $("#lang").append('<option value="' + key + '"' + style + isSelected + '>' + item.native + ' (' + item.name +  ')</option>') : null;


        });
      },
      error: function (xhr, status, errorThrown) { 
        alert('ERROR: Could not fetch ajax data: ' + errorThrown); 
        alert('ERROR: Could not fetch ajax data: ' + xhr.responseText); 
      }
    });
    //$("#languageSelector").html();
    //$("#languageSelector").html(arr.join(''));
    //alert('getTranslations CALLED!');
    //getTranslations();
    //$('#languageSelector option:selected').val($("#langCode").val()); // set selected language
}

</script>