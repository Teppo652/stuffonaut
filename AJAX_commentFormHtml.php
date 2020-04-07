<?php
function getCommentForm($parentCommentId='',$adId='') {

//if($parentCommentId != '') { $hiddenParentCommentId = '<input id="parentCommentId" type="hidden" value="' . $parentCommentId . '">'; } else { $hiddenParentCommentId = ''; }

$commentForm = <<<EOT
<li id="writeCommentForm">
<!--<div id="writeCommentForm">-->

  <div class="col m12 _noPadding">
  	<div class="col m12" style="padding:30px 20px 20px 20px">
  		<label for="comment">Write comment</label><span id="closeCommentForm" class="closeIcon" title="Close"></span>
  		<textarea class="_width100 validateLength" max="255" placeholder="Comment" id="comment" value="My comment is this"></textarea><div class="charsLeft"></div><div class="charsLeftT hidden"></div>
  	</div>

  	<div class="col m12 _noPadding" style="margin-top:-12px">
	    <div class="col m3">
	      <!--
	      <label for="commentCatId">My comment is about</label>
	      <select class="_width100" id="commentCatId">
	     	<option value="-1" selected>Select</option>
	        <option value="0">Item</option>
	        <option value="1">Price</option>
	        <option value="2">Seller</option>
	        <option value="3">Ad</option>
	        <option value="4">Other</option>
	      </select>
	      -->
	      <label for="commentCatId">Stars</label>
	      <select class="_width100" id="starsId">
	     	<option value="-1" selected>Select</option>
	        <option value="0">0 Stars</option>
	        <option value="1">1 Stars</option>
	        <option value="2">2 Stars</option>
	        <option value="3">3 Stars</option>
	        <option value="4">4 Stars</option>
	        <option value="5">5 Stars</option>
	      </select>
	    </div>
	    <div class="col m3">
	      <label for="commenterName">Name or nickname</label>
	      <input class="_full-width validateLength" max="25" id="commenterName" type="text" placeholder="Your name">
	      <span class="charsLeft hidden"></span><span class="charsLeftT hidden"></span>
	    </div>
	    <div class="col m3 hideFromView" style="margin-top:31px">
	      <!-- checkbox -->
			<div id="hideProfileImg_1" class="myCheck myCheckbox" style="clear:left"></div><span id="terms" class="checkText">Hide my profile image</span>
			<input id="hideProfileImg" type="hidden" value="">
	    </div>
	  	<div class="col m3" style="padding:24px 17px 12px 17px"> <!-- padding:24px 17px -->
	  				<!--<input class=" _primary button" type="submit" value="Submit">
	  				<input class="button" type="reset" value="Reset">-->

	  		<!--<button id="cancelComment" class="button" type="button">[Clear]</button>-->

	  		<button id="saveCommentBtn" class="_primary button" style="float:right">[Save]</button>
	  		<button id="clearCommentBtn" class="button hideFromView" title=""><span class="trashIcon">x</span></button>
	  	</div>
	  </div>
  </div>
  <input type="hidden" id="parentCommentId" value="$parentCommentId">
  <input type="hidden" id="adId" value="$adId">
  <input type="hidden" id="userId">
  <input type="hidden" id="sellerUserId">
  <input type="hidden" id="commentFormActive" value="1">


<!--</div>-->
</li>
EOT;

return $commentForm;
}

?>