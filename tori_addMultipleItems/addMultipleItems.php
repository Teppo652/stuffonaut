<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"><!-- user-scalable=no is optional and will disable zooming and make your webpage to behave like a native app on the mobile screen. -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic">

	<link rel="stylesheet" type="text/css" href="https://rawgit.com/outboxcraft/beauter/master/beauter.min.css"/>
	<link rel="stylesheet" type="text/css" href="addMultipleItems.css"/>
</head>

<body>
<!-- =============================== content ============================ -->
<div class="container">

<h1>Add multiple items</h1>

<form>

<!-- edit panel -->
<div id="editPanel">

<!-- category -->
<div class="row">
	<div class="col m5">
      <label for="Input">Main category</label>
      <select class="_width100" id="Input">
        <option value="1">Category 1</option>
        <option value="2">Category 2</option>
        <option value="3">Category 3</option>
      </select>
    </div>
    <div class="col m5">
      <label for="Input">Subcategory</label>
      <select class="_width100" id="Input">
        <option value="1">Subcategory 1</option>
        <option value="2">Subcategory 2</option>
        <option value="3">Subcategory 3</option>
      </select>
    </div>
	<div class="col m2" style="margin-top:28px">
		<button id="newItem">Add item row</button>
	</div>
</div>

<!-- same beginning part to all -->
<div id="sameSettings" class="row">
	<div class="col m2"><textarea class="_width100" placeholder="Use same name beginning to all" id="nameBeginning">Halvalla </textarea></div>
	<div class="col m6"><textarea class="_width100" placeholder="Use same description beginning to all" id="descBeginning">Nyt saatavissa </textarea></div>
	<div class="col m1">Same price<input class="_width100" placeholder="0.00" id="priceBeginning" value="999"/></div>
	<div class="col m2">
		<button id="sameImage">Same image</button>
		<input type="hidden" id="sameImage">
	</div>
	<div class="col m1">
		<button id="updateBtn">Update</button>   
	</div>
</div>

<div class="row">
<h2 style="color:red">HUOM! poistettu rivi näkyy previewssä: undefined  - korjaa</h2>
</div>

<div class="row">
	<div class="col m2">Name</div>
	<div class="col m6">Desc</div>
	<div class="col m1">Price</div>
	<div class="col m2">Images</div>
	<div class="col m1">&nbsp;</div>
</div>
<?php
for($a=1;$a<21;$a++) /* 2 6 1 2 1 */
{
	echo "\n\n" . '<div id="row_' . $a .'" class="row">';
	echo "\n\t" . '<div class="col m2"><span style="float: left"><span><input class="_full-width" type="text" placeholder="Item name" id="name_' . $a .'" name="name_' . $a .'" value="' . 'Nimi' . $a . '"></div>';
	echo "\n\t" . '<div class="col m6"><textarea class="_width100" placeholder="Description" id="desc_' . $a .'"  name="desc_' . $a .'">' . 'Kuvaus' . $a . '</textarea></div>';
	echo "\n\t" . '<div class="col m1"><input class="_full-width" type="name" placeholder="0.00" id="price_' . $a .'"  name="price_' . $a .'" value="' . $a . '.00"> €</div>';
	echo "\n\t" . '<div class="col m2">' . '<a href="#"><img src=""></a>' . '</div>';
	//echo "\n\t" . '<div class="col m1">' . '<a href="#">Delete</a>' . '</div>';
	echo "\n\t" . '<div class="col m1">' . '<button class="iconButtonS"><span class="icon iconS deleteIcon"></span></button>' . '</div>';	
	echo "\n" . '</div>';
}
?>


<!-- same text ending to all
<div class="row">
	<div class="col m5-5 "><textarea class="_width100" placeholder="Use same ending text to all description texts" id="endingText"></textarea></div>
</div> -->
<!-- same ending part to all -->
<div class="row">
	<div class="col m1-5 "><textarea class="_width100" placeholder="Use same name ending to all" id="nameEnding"> todella halvalla!</textarea></div>
	<div class="col m2-5 "><textarea class="_width100" placeholder="Use same description ending to all" id="descEnding"> joka kotiin.</textarea></div>
</div>

</div> <!-- END edit panel -->   

<br><br><br><br><br><br><br><br><br><br><br><br>

<!-- preview panel -->
<div id="previewPanel">
	<h1>Preview items</h1>
	<div class="row">
		<div class="col m2">Name</div>
		<div class="col m6">Desc</div>
		<div class="col m1">Price</div>
		<div class="col m2">Images</div>
		<div class="col m1">&nbsp;</div>
	</div>
	<div class="row">
		<div id="previewData"></div>
		<!--<div class="col m2"></div>
		<div class="col m6"></div>
		<div class="col m1"></div>
		<div class="col m2"></div>
		<div class="col m1">&nbsp;</div>-->
	</div>


</div> <!-- END preview panel -->

  <div class="row" style="float: right">
  	<input class="button" type="reset" value="Reset">  	
  	<input class=" _primary button" id="previewBtn" value="Preview">
  	<!--<input class=" _primary button" type="submit" value="Preview">-->
  </div>

</form>











</div> <!-- END container -->
<!-- ======================== END content ======================== -->
<style>
input {
	border: 1px solid #d1d1d1;
    border-radius: 4px;
}
</style>
<!-- footer -->
<script src="https://rawgit.com/outboxcraft/beauter/master/beauter.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="addMultipleItems.js"></script>
</body>

</html>