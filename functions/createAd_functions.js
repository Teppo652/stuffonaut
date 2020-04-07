/* ============================= new2 page (img upload) clicks ===================================== */
//("#uploadForm").click(function() {
	//alert('uploadForm clicked 1');
//);



// #imagesPreview .imageInactive
//$("#imagesPreview").children().click(function() {
$('#imagesPreview').on('click', '.imageInactive', function () {
	alert('imagesPreview clicked');
	// remove old selection
	$('#imagesPreview .isMainImage').removeClass("isMainImage");
	$('#imagesPreview .mainImageIcon').addClass("hidden");

	// put mainImgName in hidden field
	//var x = $(this).attr("id");
	//alert(x);
	var mainImgName = $(this).children().first().attr("src").split('_')[1];
	$("#mainImgName").val(mainImgName);

	// add selection
	$(this).addClass("isMainImage");
	//$(this).parent().children().append('<span class="mainImageIcon"></span>');
	$(this).next('.mainImageIcon').removeClass("hidden"); // .after().append('<span class="mainImageIcon"></span>');
});



//$("#imagesPreview .imageInactive").click(function() {
//	//alert('imagesPreview .imageInactive clicked 3');
//});

//$("#imagesPanel .imageInactive").click(function() {
//	alert('img clicked:'+$(this).attr("class"));
//
//	alert('img clicked par:'+$(this).parent().attr("class"));
//	$(this).css("border","solid 16px #377dc5");
//});
/* ============================= new page clicks ===================================== */
$("#advertiserType_private").click(function() {
	if($("#name2").hasClass("hidden")) {
		$("#name2,#price").removeClass("hidden");
		$("#name").val('');
		$("#companyName2,#orgNumberPanel,#priceInclVat,#aboutOrganisationPanel,#extraImagesText").addClass("hidden");
	}
	$("#adPrice").text('');
});
$("#advertiserType_company").click(function() {
	if($("#companyName2").hasClass("hidden")) {
		$("#name2,#price").addClass("hidden");
		$("#name").val('');
		$("#companyName2,#orgNumberPanel,#priceInclVat,#aboutOrganisationPanel,#extraImagesText").removeClass("hidden");
	}
	$("#adPrice").text('');
});

// new-page   /*areaToggleIcon-->.toggleBtnSPlusIcon*/
$("#areaToggle").click(function(e) {
	e.preventDefault();
	if($(this).children().hasClass("plusIcon")) {
		$("#countryPanel").removeClass("hidden");
		$(this).children().removeClass("plusIcon");
		$(this).children().addClass("minusIcon");
	} else {
		$("#countryPanel").addClass("hidden");
		$(this).children().removeClass("minusIcon");
		$(this).children().addClass("plusIcon");
	}
	/*
	if($("#areaToggleIcon").hasClass("plusIcon")) {
		$("#countryPanel").removeClass("hidden");
		$("#areaToggleIcon").removeClass("plusIcon");
		$("#areaToggleIcon").addClass("minusIcon");
	} else {
		$("#countryPanel").addClass("hidden");
		$("#areaToggleIcon").removeClass("minusIcon");
		$("#areaToggleIcon").addClass("plusIcon");
	}*/
});

// hide & show price according to selected adType
$(".adTypes").children().click(function(e) {
	if($(this).attr("id").split('_')[1] != '0') { 
		$("#pricePanel").addClass("hidden"); // hide price
	} else {
		$("#pricePanel").removeClass("hidden"); // showhide price
	}

});
/*
$('form').one('submit', function(e) {
    e.preventDefault();
    // do your things ...

    // and when you done:
    $(this).submit();
});
*/
//$("#saveButton").click(function(e) {
//$('form#adForm').submit(function(e){
//	if($("#tempAdId2").val() != '' {
//		e.preventDefault();
//		// before saving: copies tempAdId (created when images were uploaded) from imageUpload form into tempAdId2 in adForm
//		$("#tempAdId2").val($("#tempAdId").val());
//		$("#savedTempImgFileNames2").val($("#savedTempImgFileNames").val());
//	
//		alert('before save - tempAdId2:' + $("#tempAdId").val() + ' - savedTempImgFileNames:' + $("#savedTempImgFileNames").val());
//		$('form#adForm').submit(); // continue submitting form
//	}
//});


/* ========================= new -page -  display PHP validation errors ========================== */
$(function() {
	//if($("#errFieldNames").val() != '') {
	if (typeof $("#errFieldNames").val() != 'undefined') {
		alert( $("#errFieldNames").val() );
		showValidationErrors($("#errFieldNames").val());

		//var arr = $("#errFieldNames").val().split(",");
		//var i = 0;
		//for(var i = 0; i <arr.length; i++) {
	   	//	$("#"+arr[i]).addClass("hidden");
	   	//}
	}
});

