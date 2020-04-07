<?php
include_once('functions.php');
$thisPage = 'admin_createCodes.php';
include_once('header.php');
$conn = getDBConn();
$table = 'codes';

?>
<div class="bg">
		<div class="content">
			<div class="row">
				<div class="col m12">
					<div class="row iCol2" style="background-color:#fff;border: solid 1px #d5d4d4;padding:10px;border-radius:3px">

							<div class="row col m6" style="margin-top:-10px">
								<h1 id="codesPageTitle" style="margin:-25px 0 0 0;text-align:left">Todo</h1>
							</div>


			                
								<div class="col m4" style="clear:left;float:left;text-align:left">
<!-- ====== Before launch ================================================ -->	
									<b>Before launch</b><br>
								<ul>
									<li>
										<ul><li>new.php, img upload, use code, pay
											<li>new.php: if validation error, cat 2 loses selection
											<li>fix price:   / month part visibility
									<li>myAds.php: stats, deactivate, reactivate,delete
									<li>
									<li>ERROR in listing_functions.js row 133 (tr weekday names)
									<li>ERROR in category_functions.js row 614 
									<li>ERROR in category_functions.js row 540
									<li>MOVED: updateListing('1'); // first update listing 
									<li>Test new -page
										<ul><li>Private ad
											<ul><li>adTypes are missing (default adType)
												<li>add image
												<li>limit num of images to 6 (companies:15)
												<li>adTypes are missing (default adType)
											</ul>
										</ul>
										<ul><li>Company ad
											<ul><li>todo 1
											</ul>
										</ul>
										<li> in new page:<ul>
											<li>When birds selected, cat2 includes old data
											<li>Put big moon image in login page
											</ul>
									<li>Grading<ul>
										<li>Grade price  (very expensive,expensive,average,cheap,very cheap) -price (red to green scale)
										<li>Grade item/product quality (not the ad!) = boxes (very poor,poor,average,good,excellent) -quality
										<li>Bought/sold users: Grade buyer/seller trustworthyness = stars
										<li>Bought/sold users: Grade buyer/Seller reponsivity (kilpikonna-jänis)
										</ul>
										<li>Make login work
												<ul><li>Log out
												</ul>
										<li>Make cookies work
												<ul><li>Uses cookies only if Remember me is selected! (or not de-selected)
												</ul>
										<li>Open Ad by A PUBLIC CODE (from new -page)
										<li>Extra criteria cars
											<ul><li>search fields in index page
												<li>get correct search results
												<li>display in single product
												<li>in new page
											</ul>
										<li>extra criteria apartments
											<ul><li>search fields in index page
												<li>get correct search results
												<li>display in single product
												<li>in new page
											</ul>
										<li>job.js: jatka: monster/MonsterKopioidutTiedot.php
										<li>Pay with code (users)
											<ul><li>set code used
											</ul>
										<li>Company logo
											<ul><li>upload
											</ul>
										<li>Rename all files, remove blocket/blocks from them
										<li>Make Report error -page
											<ul><li>Put link to this page in footer
											</ul>
										<li>Laita extra criteria droplisteihin: 1. read into array (name#id), 2. sort by name, 3. put into select  (tämä mahdollistaa uusien rivien lisäyksen keskelle listaa myöhemmin!)

									</ul>
				                </div>
								<div class="col m4" style="float:left;text-align:left">
<!-- ====== After launch ================================================ -->	
									<b>After launch</b><br>
									<ul>
										<li>Print (PDF) receipt: get user addr fields into it - receipt.php
										<li>Print (PDF) invoice
										<li>Add,edit,show banner advertisement + payment (advertisers) - MVP!!
										<li>Forgot password
										<li>The rest of extra criteria groups
										<li>Hide user selected categories
											<ul><li>Start with user selected default category
												<li>Set default category
												<li>Edit default category
												<li>Hide user selected categories
												<li>Edit hidden categories
											</ul>
										<li>New -page: Search game image
										<li>New -page: Search movie image
										<li>New -page: Search music record image
										<li>Saved searches: edit + delete
										<li>Make tablet/mobile layouts
										<li>new -page: Validate ad title for  'Säljes,Köpes'
									</ul>
				                </div>
<!-- ====== Sometime in future ================================================ -->				                
								<div class="col m4" style="float:left;text-align:left">
									<b>Sometime in future</b><br>
									<ul>
										<li>Messages
											<ul>
												<li>All messages (message titles) + Reply btn + Delete btn + pagination
												SIngleMsg(in same page)
												<!--
												DB:
												messages:
												toUser fromUser(opt) adId sentDate title message repliedDate 
												
												sellerResponseTimes:
												sellerUserId responseTimeHours 
												
												userActivityStats:
												userId actionId actionDate
												(actionIds: openedAd,wroteComment,repliedComment,sentMsg,openedMsg,repliedMsg)
												-->
												<li>Send msg form + (to field comes autom.) + message + send btn
												<li> THIS MAKES POSSIBLE: Seller stats:
												<li><ul>
													<li>Seller answers to x% messages in y hours!!!
													<li>
													</ul>
												<li>Later: Ban sender
											</ul>
									</ul>
									<br>
<!-- ====== Marketing ================================================ -->	
									<b>Marketing</b><br>
									<ul>
										<li>Buy logo from freelancers.com
										<li>Make FB page - launch competition
										<li>Make LinkedIn page - launch competition
										<li>Plan & start Classic mail campaign where distributors earn from each paid customer (and from their future purchases)
										<li>Write GOOD pressrelease where you attack directly to blocket,tori etc, with what's wrong with them!! + what you offer more.
										<li>Send press release to small local nespapers where they can offer FREE CODE to their readers!
										<li>Send email (with FREE codes) to sellers of:
											<ul>
												<li>Apartments (free 6 mo)
												<li>Cars (free 3 mo)
												<li>Bikes (free 3 mo)
												<li>Local ice hockey leagues (free 6 mo)
												<li>other hobby clubs (free 6 mo)
											</ul>
									</ul><br>
<!-- ====== Marketing ================================================ -->	
									<b>Manual</b><br>
									<ul>
										<li>Setting prices
											<ul>
												<li>When setting price to a cat2 -category (for example Bostad in Sweden),set pricePrivate and priceCompany to -1 !!! (Otherwise customer pays cat1 price if cat2 is not selected) 
											</ul>





					</div>
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
