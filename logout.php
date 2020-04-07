<?php
session_start();
$thisPage = 'logout.php';
include_once('functions.php');
include_once('header.php');
$conn = getDBConn();

removeSession(); // logs user out - removed session data

?>

<?php
/* =================================== log out ======================================= */

/* ========================================================================== */
?>

<div class="bg">
	<div>
		<div class="content">

			<div class="row">
				<div class="col m9">
					<div  class="row iCol2">
	<!-- ======================================================================== -->
						<div class="col m12">
							<h1 style="margin:0">You are now logged out</h1>
							<b>Text here</b>
						</div>	
					</div>
				</div>
				<!-- ========================================= SIDE BANNER AREA ========================================== -->
				<div class="col m3">
					<h2 id="sidePanelTitle">[Galleriet]</h2>
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
				</div><!-- END side banner area -->

			</div> <!-- row -->

			<footer class="row">
				
			</footer>
	

        </div>
    </div>




</div> <!-- bg -->
