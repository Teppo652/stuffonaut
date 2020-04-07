
/* ==================================== TIMER - REMOVE FROM PRODUCTION SITE ==================================== */
function addZero(x,n) {
  while (x.toString().length < n) {
    x = "0" + x;
  }
  return x;
}

function getElapsedTime() {
  var d = new Date();
  var h = addZero(d.getHours(), 2);
  var m = addZero(d.getMinutes(), 2);
  var s = addZero(d.getSeconds(), 2);
  var ms = addZero(d.getMilliseconds(), 3);
  return h + ":" + m + ":" + s + ":" + ms;
}
/* ================================================= END TIMER  ================================================ */










/* ============ settings ============ */
//var siteLangs = 'sv,fi,en';
//var defaultLang = 'sv';
//var siteLangs = 'sv,fi,en';
//var langId = 1;
//initMap(); //test
// $(document).ready(function(){





function getTestCatsNew() {
    setTimeout(function () {
        ////alert('VIDEO HAS STOPPED');
        //var testCats = generateTestCategories('').join(" ");
		//alert('testCats: '+testCats);
		//$("#testData3").val(testCats);

	var dataArr = [];
    $('#cat1 option').each(function(){
    	// $('#cat1 option:selected').prev( "option:disabled" ).text()
	    if(this.value < 500 && this.value > -1) {
	      dataArr.push( this.value +'#'+ this.text );      
	    }
	    $("#testData3").val(dataArr.join(";"));
    });
    // alert(data);
    }, 4000);
    // return dataArr;
    

    // 2 generate test data
//	generateTestdata('2673722'); // area  2673722 Stockholms län
	// generateTestdata(''); // 
}
function justGetTheCats() {
	var dataArr = [];
    $('#cat1 option').each(function(){
    	// $('#cat1 option:selected').prev( "option:disabled" ).text()
	    if(this.value < 500 && this.value > -1) {
	      dataArr.push( this.value +'#'+ this.text );      
	    }
    });
    return dataArr;
}









/* ======================================== ACTUAL BEGINNG ========================================== */


$(function() {


// TEMP
//$("#langCode").val("sv");
//$("#usersGeoLocation").val("6295630,6255148,2661886,2673722,2696046,");

// --------- gloabal vars ---------
window.tr = null; // translations data

var dat = new Date();
window.thisYear = parseInt(dat.getFullYear());

// local file system
// var funcPath = '/UUSI/common/SITES/montaSaittia/stuffonaut/functions/';
// server file system
var funcPath = 'functions/';
// --------------------------------

//// GENERATE TEST DATA
//////alert('Creating test data, please wait 5 secs after clicking button in bottom of screen');
////// 1 get all categories
//getTestCatsNew('2673723');
////// 2 generate test data
//generateTestdata('2673723');
//
//// generateTestDataNew(area)

// var p = 'vehicle_';
// alert('INIT car.js CREATING- '+p+'fuel:'+getTr(p+'fuel'));
// alert('INIT car.js CREATING- fuelData:'+getTr(p+'fuelData'));


// checks if internet is working
if (typeof jQuery == 'undefined') {
    alert('Your internet is down!');
}



	//al('main.js LOADED');
/* ===================================== init ============================================ */

//// page fade in test
//// $('body').fadeIn(5000);
//setTimeout(function() { $("body").fadeIn(2000); }, 1000);
////$(selector).fadeOut('slow', function() {
////    // will be called when the element finishes fading out
////});


// set frequently needed translations - make sure translations are loaded first!!!!	
// clear select list: $('#xxxxxx').html('');  

/* ============ init page ============ */
// if(isBrowserIE()) { alert('Unfortunately this site does not support Internet Explorer.'); exit; } // IE not supported

//// check webstorage is supported
//if (typeof(Storage) !== "undefined") {
//  // Code for localStorage/sessionStorage.
//} else {
//  alert(" Sorry! No Web Storage support ");
//}

// alert('Current file name is: ' + $("#phpPageName").val());
// 
// 
// if($("#phpPageName").val() == 'new') {
// 	alert('getTranslations');
// 	getTranslations();
// }

// --------------------------------- use session if available -----------------------------------------
/*
if($("#phpPageName").val() != 'login') {
	session('load');
	al('reading JS session');
}
*/


// DELETE THIS
// // login page - update translations - err msgs!
// if($("#phpPageName").val() == 'login') {
// 	//setTimeout(function() {
// 		alert('login page get error translations');
//         getTranslations();
//     //}, 3000);
// }


if($("#phpPageName").val() != 'new2') {
		// session('check');
		//session('load');
	//alert('XXXXXXXXXXXXX: timeZone: *' + $("#timeZone").val() + '*');

	//updateSingleBreadcrumb(0, 'TEST22'); // test
	//$(".breadcrumbValue0").html('TEST');

	// $("h2").css("display","none");

/*
====================================================================================================
====================================================================================================
======================================== COOKIE ====================================================
====================================================================================================
====================================================================================================
*/

	// delete cookies
	//setCookie('savedSearchesTxt', '', -1); // 365 days
	//setCookie('savedSearchesData', '', -1); // 365 days


	// try read cookie - working
	var cookieVal = '';
	// if use my location is not clicked
	if($("#resetLocation").val() != '1') {
		cookieVal = returnCookie('location'); // TEMP -------- TEST WITHOUT COOKIE ---------
	}
// TEMP DISABLE COOKIE
//var cookieVal = null;
	al('try read cookie - returned *' +cookieVal+ '*');
	if(cookieVal != null && cookieVal != '') {
		  					//  if($("#cookieExists").val() != '1') {}
		$("#cookieExists").val('1');
		// bypass user location checking
		returnCookieData(cookieVal);
		al('COOKIE FOUND:'+cookieVal); 
		mainInit();
	} else {
		al('NO COOKIE FOUND');
		// normal site init
	//if($("#timeZone").val() == '') 
	//{ 

		// TEMPORARY WHILE OFFLINE!!
		// //getTranslations();
		// getAllLanguageNames();									
		// getTranslations();
		// //useGeolocation();
//alert("TEMP TAKEN OFF: useGeolocation(), initMap(), footer: hardcoded location values, footer:  googleapis.com!")
// put these 2 back on
		// XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
		// XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
useGeolocation(); // THIS STARTS AREAS!!!!!! - temp put offline
		// XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
		// XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
		//alert('initMap called (JS r17)'); 
initMap(); // THIS IS NEEDED for getting users location
		// XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
		// XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX

		// promise test
		//initMap().then( getTranslations() )
		//.then( getCategories(langId, "", "cat1") )
		//.then( initBreadcrumbs() )
		//.catch(function(error){
		//    // Handle error
		//    alert('promise error');
		//});

		//useGeolocation().done( 
		//	getTranslations() 
		//	).done( 
		//	getCategories(langId, "", "cat1")
		//	).done( 
		//	initBreadcrumbs()
		//	);

		//// var sessionExists = session('load');
		//// alert('sessionExists: ' + sessionExists);
		//// if(typeof sessionExists === "undefined") { alert('initMap called (JS r17)'); initMap();  } else { alert('Session FOUND!'); }
		
		//initMap();
		//useGeolocation();
		// getTranslations(); - will be called after languages select has been populated
		// init categories
	//	alert('LANG IS:'+$("#langCode").val());
	//	getCategories(langId, "", "cat1"); // populate categories select - page init
		// TODO: init title texts
	 	// initBreadcrumbs(); // shows localised texts

	 	//$("#numOfItems").html('0'); // zero items found as default
//
	 	//// url has ad id - show ad
	 	//if( $("#selectedAd").val() != null) {
	 	//	//alert('Showing single ad:'+$("#selectedAd").val());
	 	//	getSingleAd($("#selectedAd").val());
	 	//}
	} // else	 
	// $("#numOfItems").html('0'); // zero items found as default - placed in index html code
	usersFavorites('getAll'); // get all users favorite ads ids in hidden field
	// url has ad id - show single ad
	if( $("#selectedAd").val() != null) { getSingleAd($("#selectedAd").val()); }

	al(' = = = = = = usersGeoLocation:'+$("#usersGeoLocation").val());
}

async function mainInit() {
    //alert('279  = = = = = == = usersGeoLocation:'+$("#usersGeoLocation").val());
	populateAllAreaSelects( $("#usersGeoLocation").val() ); // areas list
	//alertal('mainInit: usersGeoLocation:'+$("#usersGeoLocation").val());

	getAllLanguageNames(); // TODO: set active language
	getTranslations(); // put lang joka tuli cookiesta
	// alert('FINISHED PAGELOAD');
    $(".listingBody .placeholderItem").remove();
	al('main init FINISHED');

	al(' - - - - - getCategories() - main.js ROW 284');
//	getCategories("", "cat1"); /* NEW NEW NEW */

	// does not work here...
	//alert('first listing load');
	//updateListing('1'); // first listing load
}



/* ============ category 1 or 2 changed ============ */
// cat1 changed
$('#cat1').on('change', function() {
	cat1Selected();
});
// cat2 changed
$('#cat2').on('change', function() {
	cat2 = $('#cat2 option:selected').val();
	if(cat2 != '' || cat2 != '-1') {  
		if($("#advertiserType").val() != "company") {
			var adPrice = $('#cat2 option:selected').attr("prpPrice");
		} else {
			var adPrice = $('#cat2 option:selected').attr("prcPrice");
		}
		if (typeof adPrice != 'undefined' && adPrice != '0') {
  			$("#adPrice").text(adPrice + ' ' + tr['priceCurrency']);
  			$("#tempAdPrice").val(adPrice + ' ' + tr['priceCurrency']);
  			$("#adPricePanel").removeClass("disabled3");
  		}
	}
	al('cat2 changed');
//	cat1Selected();
});
// if(cat2 != '' && cat2 == '-1') { adPrice = $('#cat1 option:selected').attr("prpPrice");

function cat1Selected(cat1='') {
	$("#extraSearhCriteriaPanel").html(''); // empty extraSearhCriteriaPanel - NEW

	if(cat1 == '') { cat1 = $('#cat1 option:selected').val(); }

  	if(cat1 == '' || cat1 == '-1') { 
  		$('#saveSearchPanel').addClass("hidden");
  		$("#adPrice").text('');
  		$("#tempAdPrice").val('');
  		$("#adPricePanel").addClass("disabled3");
  	} else { 
  		$('#saveSearchPanel').removeClass("hidden");
  		// ---------------------- new ----------------------
  		if( $("#phpPageName").val() == 'new') {
  			// update shown ad price (prpPrice,prcPrice)
  			var adPrice = '';
  			// private person ad price
  			if($("#advertiserType").val() != "company") {
  				adPrice = $('#cat1 option:selected').attr("prpPrice");
  			} else {
  				adPrice = $('#cat1 option:selected').attr("prcPrice");
  				// remove entered person name
  				$("#nameCol #name2").val('removed'); // NOT WORKING!!!
  			}
  				// private person price
  				//alert('----------- getting private person price -----------------');
				//adPrice = $('#cat1 option:selected').attr("prpPrice");
				if(adPrice!= '-1') { 
					//adPrice = adPrice == '0' ? tr['defaultPrivatePersonAdPrice'] : adPrice;		
					if (typeof adPrice == 'undefined' || adPrice == '0') { adPrice = tr['defaultPrivatePersonAdPrice']; }
  					$("#adPrice").text(adPrice + ' ' + tr['priceCurrency']);
  					$("#tempAdPrice").val(adPrice + ' ' + tr['priceCurrency']);
  					$("#adPricePanel").removeClass("disabled3");
  				} else {
  					// special case - if -1 (bostad) only children prices are shown
  					$("#adPrice").text('');
  					$("#tempAdPrice").text('');
  					$("#adPricePanel").addClass("disabled3");
  				} 
  			// } else {
  			// 	// company ad price
  			// 	adPrice = $('#cat1 option:selected').attr("prcPrice");
			// 	adPrice = adPrice == '0' ? tr['defaultCompanyAdPrice'] : adPrice;
  			// 	$("#adPrice").text(adPrice + ' ' + tr['priceCurrency']);
  			// 	$("#tempAdPrice").val(adPrice + ' ' + tr['priceCurrency']);
  			// 	$("#adPricePanel").removeClass("disabled3");
  			// 	// remove entered person name
  			// 	$("#nameCol #name2").val('removed'); // NOT WORKING!!!
  			// }
  		}
  	}
  	
  	if(cat1 == '4') { $("#cat2Links").addClass("columns"); } // cars - show columns
	switch (cat1) {
		// case '1': bostad
		// case '2': jobb
		case '3':
		case '121':
		case '149':
		case '176':
		case '196':
		case '263': updateCat1LinksUsingDroplist(cat1); break; // update with cat1 links
		default:
			updateCat2(); // update with cat2 links
			buttonBlinking('start');
		break;
	}
};

// category 2 link clicked   STARTING Categories cat2Links:
// =========================== quickCategories clicked ==========================
$('#cat2Links').on('click', 'a', function () {
	quickCatClicked($(this));
});

function quickCatClicked(elem,cat1='',level='') {
   if(cat1 == '') { cat1 = $('#cat1 option:selected').val(); }
   var selCat2LinkId = elem.attr("id").split("_")[1];
   var selCat2Name = elem.text();
   if(level == '') { level = elem.attr("id").split("_")[0]; }
   al('quickCatClicked -  selCat2LinkId:'+selCat2LinkId);
   switch(level) {
   	case 'cat0':  al('cat 0 clicked');  
   		$('#cat1').val(selCat2LinkId); // set cat1 value selected
   		updateCat1LinksUsingDroplist(selCat2LinkId); // in category_functions.js
   		break;
   	case 'cat1': al('cat 1 clicked');  
   		getCategories(selCat2LinkId, 'cat2Links', 'links', 'defaultCats', '2');
   		updateSingleBreadcrumb('2', selCat2Name);
   		break; // quicklink (cat1_) clicked
   	case 'cat2': al('cat2 clicked');  
   		getCategories(selCat2LinkId, 'cat2Links', 'links', 'defaultCats', '3');
   		updateSingleBreadcrumb('3', selCat2Name);
   		break;
   	case 'cat3': al('cat3 clicked');  
   		getCategories(selCat2LinkId, 'cat2Links', 'links', 'defaultCats', '4');
   		updateSingleBreadcrumb('4', selCat2Name);
   		break;
   } // switch

/*   TEMP PUT AWAY */
   //alert('HHHHHHHHH cat2Links click CALLED');
   //if(level == 'cat1')
   if(level == 'cat0' || level == 'cat1') {
   		// quicklink (cat1_) clicked
    	// if is quick link --> behave as cat1 was changed

   	al('You just clicked: '+selCat2LinkId); // ------------ vattenskoter palaa tänne?
		// if quicklink (FORDON,JOBB) clicked - Show cat1 choices in quicklinks
		// $('#cat1').val(selCat2LinkId).attr("isParent"));
		$('#cat1').val(selCat2LinkId); // set cat1 value selected
	//  getCategories(parentId, target, returnType='select', adTypes='defaultCats') {
	// 	getCategories(selCat2LinkId, "cat2Links", "cat1links", ''); // gets all now = error
		// updateCat1Links(selCat2LinkId); // in category_functions.js - ERROR
		updateCat1LinksUsingDroplist(selCat2LinkId); // in category_functions.js
updateSingleBreadcrumb('3', selCat2Name); // TEST now - moved to updateCategories
		
		// TODO put updateSingleBreadcrumb( here!!
   } else if(level == 'cat3') {
   	al(' LEVEL 3 link clicked');
   		updateSingleBreadcrumb('4', selCat2Name); // TEST
   } else {
   		// cat 2 link klicked (not quicklink)
		$("#cat2Links").children().removeClass("selected");
    	elem.addClass("selected");
    	var selCat2Name = elem.text();
    	$('#cat1').val(selCat2LinkId); // set cat1 value selected --------- TEST!!!!!!!!!!
	    $("#cat2").val(selCat2LinkId); // put id in hidden field


		al('CAT2 CLICKED cat1:'+cat1+'  cat2:'+selCat2LinkId+'  cat2 name:'+selCat2Name);

		// update breadcrumb 3 level: cat2 name
		updateSingleBreadcrumb('3', selCat2Name); // $('#selectedCat1Name').html(catName);

		// getCategories(val, "cat2Links", "links", $('#cat1 option:selected').attr("adTypes")); break;
	al('******************** getCategories main.js466');
getCategories(selCat2LinkId, 'cat2Links', 'links', 'defaultCats', '2'); /* NEW quickCatClicked */
	    //// select same category in cat1 select list
	    //$("#cat1").removeAttr('selected');
		

		// if has cat3 level listings, display them (car,phone)
		// selCat2LinkId
		//switch(cat1) {
		//	case '4':   show_car_models(selCat2Name); break;
		//	case '115': alert("load machinery cat3");  	break;
		//	case '122': alert("load phone cat3"); 	 	break;
		//	case '278': alert("load realEstate cat3"); 	break;
		//}
	} // if
////	updateListing(); // OLI
	// updateBreadcrumbs();
////	updatePageTitle_category(); // OLI
};
/* ===================================== user (category) settings  =================================== */
// user settings clicked - show user selected cats
$('#openSettingsPanelBtn').click(function(e) {
	e.preventDefault();
	if($("#userSafeId").text().length<1) { alert('Please login to edit your settings'); return; } 

	$("#frontPage").addClass("hidden");
	al('hiding frontPage IS TEMP disabled in main.js r 424');
	$("#settingsPanel,#closeSettingsPanelBtn,#saveUserSettings").removeClass("hidden");
	$("#openSettingsPanelBtn").addClass("hidden");
	
	// show user selected cats
	if($("#catSettings").children().length == 0) {
		al('******************** getCategories main.js498');
		getCategories('-1','catSettings','catSettings','','',''); // user settings clicked
	}

});

// site style button clicked
$('#styleBtn').click(function(e) {
	e.preventDefault();
	var elem = $(".siteStyles");
	if( $(elem).hasClass("hidden") ) {
		$(elem).removeClass("hidden");
	} else {
		$(elem).addClass("hidden");
	}
});
$('.siteStyle').click(function(e) {
	e.preventDefault();
	$(this).addClass("selected");
	var id = $(this).attr("id");
	alert('SITE STYLE SELECTED: '+id);
	$(".siteStyles").addClass("hidden");
});

// single cat clicked - set visible(green) or hidden(red)
$("#catSettings").on("click", "a", function(e){
	e.preventDefault();
	var inputElem = $("#userHiddenCats");
	var id = $(this).attr("id").split('_')[1];
	var oldVal = inputElem.val();
	var valArr = oldVal.split(",");
	if(!oldVal.split(",").includes(id)) {
		inputElem.val(oldVal + id  + ',');
	} else {			
		valArr.splice(valArr.indexOf(id), 1);
		inputElem.val(valArr.join(','));
	}
	// set styles for selection 
	if ($(this).hasClass("userHidden")) { 
		$(this).removeClass("userHidden"); // show
		$(this).children().addClass("visibleCat");
		$(this).children().removeClass("hiddenCat");
	} else {
		$(this).addClass("userHidden"); // hide
		$(this).children().removeClass("visibleCat");
		$(this).children().addClass("hiddenCat");
	}
	
});
// save or close clicked
$("#saveUserSettings").click(function(e) {
	e.preventDefault();
	al('Hiding settings panel IS TEMP disabled in userSettings.js r 58 - until saving in DB works');
	//$("#settingsPanel,#closeSettingsPanelBtn,#saveUserSettings").addClass("hidden");
	//$("#openSettingsPanelBtn").removeClass("hidden");
	//$("#frontPage").removeClass("hidden");
});
$("#closeSettingsPanelBtn").click(function(e) {
	e.preventDefault();
	al('Hiding settings panel IS TEMP disabled in userSettings.js r 58 - until saving in DB works');
	//$("#settingsPanel,#closeSettingsPanelBtn,#saveUserSettings").addClass("hidden");
	//$("#openSettingsPanelBtn").removeClass("hidden");
	//$("#frontPage").removeClass("hidden");
});

// save changes clicked
$('#saveUserSettings').click(function(e) {  /* ----------------------------- here ------------------------------- */
	e.preventDefault();
	al(' 5 save changes clicked');
	var startCat1 = -1;
	var startCat2 = -1;
	var hiddenCats = -1;

	var userSafeId = $("#userSafeId").text();
	if(userSafeId.length>5) { 
		al('saving saveUserSettings, userId:'+userSafeId+'  hiddenCats:'+$("#userHiddenCats").val());
		hiddenCats = $("#userHiddenCats").val();
		// usersSettings(userSafeId,startCat1,startCat2,hiddenCats,'save');
	} else {
		alert('2 you must be logged in to save settings'); 
	}
});

function usersSettings(userSafeId,startCat1,startCat2,hiddenCats,action='') { 
	$.ajax({
	      url: "AJAX_updateUserSettings.php",
	      type: "GET",
	      data: {
	      	uId: userSafeId,
	      	cat1: cat1,
	      	cat2: cat2,
	      	hCats: userHiddenCats,
	      	act: action
	      	},
	      dataType: 'text',
	      success: function (jsonResult) {
			//$("#ajaxComments").html(jsonResult);
		  },	
		  error: function (xhr, status, errorThrown) { 
		    // alert('ERROR 1: Could not save comment: ' + errorThrown); 
		    // alert('ERROR 2: Could not save comment: ' + xhr.responseText); 
		    alert('ERROR 3: Could not update clicks: ' + status);
		  }, complete: function () {
	        // pageLoader('hide');
		  } 	  
	    }); // END ajax
}



/* --------------------------- END user settings -------------------------------------- */

/* ============ language  ============ */
// language changed
$('#languageSelector').on('change', function() {
	// alert('language selected');
	getTranslations();
al('588  = = = = = == = usersGeoLocation:'+$("#usersGeoLocation").val());
	populateAllAreaSelects($("#usersGeoLocation").val());
	al('******************** getCategories main.js597');
	getCategories("", "cat1"); // lang changed
	// clearBreadcrumbs(); 
	updateBreadcrumbs();
	// alert('language changed 2');

	// new
    clearSelect("country"); 
    getAreas($( "#continent" ).val(), 'country'); // language changed
});

/* ============ area select list clicks ============ */
/* area select list clicked, clear old values and update child select list contents */	
$( "#continent" ).change(function() { clearSelect("country"); hide32(); getAreas($( "#continent" ).val(), 'country'); });
$( "#country" ).change(function()   { clearSelect("area"); 	  hide32(); getAreas($( "#country" ).val(),   'area');    });
$( "#area" ).change(function()      { clearSelect("area0");   hide32(); getAreas($( "#area" ).val(),      'area0');   });
$( "#area0" ).change(function()     { clearSelect("area1");   hide32(); getAreas($( "#area0" ).val(),     'area1');   });
$( "#area1" ).change(function()     { clearSelect("area2");   hide32(); getAreas($( "#area1" ).val(),     'area2');   });
$( "#area2" ).change(function()     { clearSelect("area3");   			getAreas($( "#area2" ).val(),     'area3');   });


function hide32() {
	$("#area2").parent().addClass('hidden');
	$("#area3").parent().addClass('hidden');
}


/* ============ search form sorting buttons ============ */
// radiobutton clicked in index page
// radio text clicked
$("#searchPanel").on("click", ".checkText", function(e){
	//alert('main.jss 550 - radio checkText clicked');
	updateRadioStyles($(this).prev(".myRadiobutton"));
	updateListing();
});
// radio btn clicked
$("#searchPanel").on("click", ".myRadiobutton", function(e){
	//alert('main.jss 556 - Radio clicked');
	updateRadioStyles($(this));


//		//alert('RADIO CLICKED:'+$(this).next(".checkText").html();
//	alert('RADIO 11 CLICKED:'+$(this).next('span').text());
//	//var selRadioName = $("#extraSearhCriteriaPanel .myRadiobutton-selected") "
//	updateSingleBreadcrumb(3, 'GENDER');


	updateListing();
});
//TEST   extraSearhCriteriaPanel
// radiobutton clicked in new page	
$("#newAd").on("click", ".myRadiobutton", function(e){
	updateRadioStyles($(this));
});
// gender radiobutton clicked on new page
//$("#newAd .genders").on("click", ".myRadiobutton", function(e){
//	alert('show extra.js 375 - gender clicked');
//	updateRadioStyles($(this));
//});

// all / private / company -button clicked
$(".advertiserTypes").children().click(function() {
	updateAdvertiserTypeBtnStyles($(this));		
});
// price / time -button clicked 
$(".sortBy").children().click(function() {
	updatePriceTimeBtnStyles($(this));
	updateListing();
});
// search button 
$("#searchBtn").click(function() { 
	updateListing();
});
// place ad -button clicked
$("#topLinkPlaceAd").click(function(){
	pageLoader('show');
 	window.location.href = "new.php"; // redirect
});

// ---------------------- bostad or job clicked in header line ------------------
$("#headerTitles").on("click", ".dynamic", function(e){
  e.preventDefault();
  var id = $(this).attr("id").split("_")[1];
  al('headerTitles .dynamic clicked:'+id);
  //cat1Selected($(this).attr("id").split("_")[1]);
  quickCatClicked($(this),id,'cat0'); // TEST
});
//$("#headerCat_30").click(function(e) {
//  e.preventDefault();
//  alert('headerCat_30clicked');
// });

// --------------------- loggedInAsUser btn clicked -----------------------



// toplink_loggedInAs (username) clicked - open or close links
$("#toplink_loggedInAs").click(function(e){
    e.preventDefault();
	if($("#loggedInAsPopup").hasClass("hidden")) {
		$("#loggedInAsPopup").removeClass("hidden");
	} else {
		// $("#loggedInAsPopup").addClass("hidden");
	}
});
// toplink_loggedInAs (username) lost focus - close
$("div").focusout(function(){
  // $("#loggedInAsPopup").addClass("hidden");
});

// sorting buttons clicked ------ is this double?????
$("#advertiserType_all, #advertiserType_private, #advertiserType_company, #sortBy_time, #sortBy_price").click(function(){
	updateListing(); 
});

/* -------------- color clicks ---------------- */
// color clicked
$("#extraSearhCriteriaPanel").on("click", ".carColor", function(){	
	// THIS IS CALLED TWO TIMES????
	var id = $(this).attr("id"); //.split('_')[1];
	//alert('color clicked Full id:'+id);
	id = id.split('_')[1];
	// NEW
	//if($(this).hasClass("selectedBlackMark") ) {    	
    //	$(this).removeClass("selectedBlackMark"); // remove selection
    //} else {
    //	$(this).addClass("selectedBlackMark"); // set selected
    //}
    // OLD
	// alert('color clicked id:'+id);
	// hide & show check mark
    if($(this).hasClass("selectedBlackMark") || $(this).hasClass("selectedWhiteMark") ) {    	
    	$(this).removeClass("selectedBlackMark"); // remove selection
    	$(this).removeClass("selectedWhiteMark"); 
    } else {    	
    	//if(id == '0' || id == '1') { $(this).addClass("selectedBlackMark"); } else { $(this).addClass("selectedWhiteMark"); } // set selected , 0,1 are special
    	if(id == '3') { $(this).addClass("selectedWhiteMark"); } else { $(this).addClass("selectedBlackMark"); } // set selected - black is special
    }
    if( $("#phpPageName").val() == 'new') { // on new -page only one can be selected
    	$(this).siblings().removeClass("selectedBlackMark"); 
    	$(this).siblings().removeClass("selectedWhiteMark"); // OLD
    } 
 
    // handle color value(s)
	var oldVal = $(this).parent().children("input").val();
	//alert('color clicked oldVal:'+oldVal);
	var valArr = oldVal.split(",");
	if($("#phpPageName").val() == 'new') {
		if(id == oldVal) { id=''; } // remove value 
		$(this).parent().children("input").val(id); // only one selection allowed
	} else {	
		al('multiple values allowed oldVal:'+oldVal);
		// alert('includes id:'+id+'  check result:'+oldVal.split(",").includes(id));
		// multiple values allowed
		if(!oldVal.split(",").includes(id)) {
			$(this).parent().children("input").val(oldVal + id  + ','); 
		} else {			
			valArr.splice(valArr.indexOf(id), 1);
			$(this).parent().children("input").val(valArr.join(','));
		}
	}
});

/* -------------- extraSearhCriteria - clearSelsBtn clicked ---------------- */
$("#extraSearhCriteriaPanel").on("click", ".goBackIcon", function(e){
	e.preventDefault();
	al('goBackIcon clicked');
});


/* -------------- phone clicks ---------------- */
// /* phoneManufacturer selected */
// //$("#phoneManufacturer").
// $("#extraSearhCriteriaPanel").on("change", "#phoneManufacturer option:selected", function(e){
// 	alert('phoneManufacturer selected: '); // + $('#phoneManufacturer option:selected').val() );
// 	//updateListing('1','',$(this).children("input").val()); // make search
// 	/*
// if(cat1Val != -1 && cat1Val != null) { return cat1Val; }
// 	} else {
// 		var cat2Val =  $('#cat2 option:selected').val(); /
// 		$( "#country" ).change(function()
// 	*/
// });


/* --------------- saved searches --------------- */
// item in saved search list clicked
$("#savedSearchesPanel").on("click", ".savedSearch", function(e){
	$("#frontPage").removeClass("hidden");
	$("#savedSearchesPanel").addClass("hidden");
	$("#closeSavedSearchesPanelBtn").addClass("hidden");

	//alert('saved search clicked - DATA: '+ $(this).children("input").val());
	updateListing('1','',$(this).children("input").val()); // make search
});
$("#saveSearch").click(function() { initSavedSearches('save'); }); // save search -icon clicked
$("#toplink_savedSearches").click(function() { initSavedSearches('get'); }); // saved searches top button clicked

function initSavedSearches(action) {
	// $("#savedSearchesPanel").removeClass("hidden")

	$.getScript('functions/savedSearches_functions.js', function() { 
		if(action == 'get') { 
			if($("#savedSearchesPanel").hasClass("hidden")) {
				getSavedSearches(); 
			} else {
				closeSavedSearchesPanel(); // if savedSearchesPanel already shown - do nothing and hide it
			}
		} else { 
			saveSearchSettings();
			//if(getSavedSearches('getValForCat1')!='') { saveSearchSettings(); } else { alert('You already have a saved search in this criteria, please delete it first'); getSavedSearches(); }
		}
	}, true);
}
$("#closeSavedSearchesPanelBtn").click(function() {
  	closeSavedSearchesPanel();
});

// listing style -icon button clicked
$(".tableStyle").click(function() { 
	var elem = $("#tableStyle");
	//$("#tableStyle").val( $(this).children().hasClass("cardsIcon") ? 'cards' : 'list' );
	if(elem.val() == 'list') { elem.val('cards'); } else { elem.val('list'); }
	// updateListing('1'); // temp put aside
});

// checkbox clicked - update styles

// handle checkbox clicks
$("#extraSearhCriteriaPanel").on("click", ".myCheck", function(e){
	handleCheckboxClicks();
});
$("#extraSearhCriteriaPanel").on("click", ".myCheck", function(e){
	handleCheckboxClicks();
});

// handle checkbox clicks
function handleCheckboxClicks() {
	var id = $(this).attr("id").split('_')[1];
	var inputElem = $("#"+$(this).attr("id").split('_')[0] );
	var oldVal = inputElem.val();
	var valArr = oldVal.split(",");
	if(!oldVal.split(",").includes(id)) {
		inputElem.val(oldVal + id  + ',');
	} else {			
		valArr.splice(valArr.indexOf(id), 1);
		inputElem.val(valArr.join(','));
	}
	// set styles for selection
	if ($(this).hasClass("myCheckbox")) { 
		$(this).removeClass("myCheckbox"); 
		$(this).addClass("myCheckbox-selected"); 
	} else { 
		$(this).removeClass("myCheckbox-selected"); 
		$(this).addClass("myCheckbox"); 
	}
}


// ad in listing clicked 
//$("#ajaxTable").on("click", "a", function(e){
//	e.preventDefault();
//	alert('1 individual ad clicked 2');
//	$("#ajaxTable").addClass("hidden");
//	$("#displaySingleAd").removeClass("hidden");
//	getSingleAd('20'); // todo - put real id here
//}); // not wokring
/*
$(document).on("click",".clickableRow",function() {
        window.document.location = $(this).attr("href");
  });
  */


// --------------  ad listing clicks --------------
// ad in listing clicked anywhere
$("#ajaxTable").on("click", ".item", function(e){
	adClicked($(this));
});
$("#ajaxTable2").on("click", ".item", function(e){
	adClicked($(this));
});

function adClicked(elem) {
	var id = elem.attr("id");
	//alert('this id:'+id);
	//alert('this cat1:'+$(this).attr("cat1"));
	// $(this).attr("id")
	$("#currentSingleAd").val(id); 
	// $("#singleAdPage").attr("id").val($(this).attr("id")); /* NEW */
	$("#singleAdPage").attr("adId", id);  /* NEW */

	// getSingleAd(id,elem.attr("cat1")); // working
	getSingleAd(id,elem.attr("cat1"),elem.attr("isCompany"));

	updateClick(id); // todo: save only unique clicks

	// update user hidden ad clicks
	var uAdsArr = $("#uAds").html();
	//if(uAdsArr.length > 0) {
		//alert('uAdsArr:'+uAdsArr);
		uAdsArr = uAdsArr.split(",");
		//alert('uAdsArr.indexOf(id):'+uAdsArr.indexOf(id));
		if(uAdsArr.indexOf(id) < 0) {
			uAdsArr.push(id);
			$("#uAds").html(uAdsArr.join(','));

			// update ads current click num on screen
			var numOfClicks = parseInt(elem.children(".numOfClicksTag").children(".numOfClicks").html());
			numOfClicks++;
			elem.children(".numOfClicksTag").children(".numOfClicks").html(numOfClicks);
		}
	//} else { $("#uAds").html(id); }
}

function updateClick(id) {
	$.ajax({
	      url: "AJAX_updateClick.php",
	      type: "GET",
	      data: { id: id },
	      dataType: 'text',
	      success: function (jsonResult) {
			//$("#ajaxComments").html(jsonResult);
		  },	
		  error: function (xhr, status, errorThrown) { 
		    // alert('ERROR 1: Could not save comment: ' + errorThrown); 
		    // alert('ERROR 2: Could not save comment: ' + xhr.responseText); 
		    alert('ERROR 3: Could not update clicks: ' + status);
		  }, complete: function () {
	        // pageLoader('hide');
		  } 	  
	    }); // END ajax
}
/*
function updateTotalAds(id) {
	$.ajax({
	      url: "AJAX_updateTotalAds.php",
	      type: "GET",
	      data: { id: id },
	      dataType: 'text',
	      success: function (jsonResult) {
			//$("#ajaxComments").html(jsonResult);
		  },	
		  error: function (xhr, status, errorThrown) { 
		    // alert('ERROR 1: Could not save comment: ' + errorThrown); 
		    // alert('ERROR 2: Could not save comment: ' + xhr.responseText); 
		    alert('ERROR 3: Could not update totalAds: ' + status);
		  }, complete: function () {
	        // pageLoader('hide');
		  } 	  
	    }); // END ajax
}
*/
// category name clicked in listing
$("#ajaxTable").on("click", ".cat", function(e){
	e.stopImmediatePropagation();
	// al('cat in ad clicked, id:' + $(this).attr("id") ); // ------------------------------------------------- implement this!
});
// location name clicked in listing
$("#ajaxTable").on("click", ".location", function(e){
	e.stopImmediatePropagation();
	// al('location in ad clicked, id:' + $(this).attr("id") );// ---------------------------------------------- implement this!
});


//  pagination clicked 
$("#paginationPanel").on("click", "li.page-item", function(){
	var id = $(this).children().first().attr("id");
	updateListing(id);
	$("#currentPage").val(id);
});
/* =============================  single item page -clicks ===================================== */
// SHould these be in showAd_functions -file?


// ---------- virtual page navigation buttons -----------
// back to search results button clicked
$("#singleAdNavi").on("click","#backToSearchResultsBtn",function(){
	switchDisplayPageTo('frontPage');
});
$("#singleAdNavi").on("click","#moveToNextAdBtn",function(){ 
    // display next ad in listing
    var currAdId = $("#currentSingleAd").val();
    var nextId = $("#"+currAdId).next(".item").attr("id");
	if (typeof(nextId) != "undefined") { getSingleAd(nextId); }
})

// -------- big button list clicks --------
$(".wideButtons").on("click", "button,a", function(e){
	alert('You clicked wideButtons');
	e.preventDefault();
	var isLoggedIn = true;

	$(this).addClass("selectedWideBtn");
	$(this).siblings().removeClass("selectedWideBtn");
	var id = $(this).attr("id");
	switch(id) {
		case 'showPhoneNumber': if(!isLoggedIn) { showLoginPopup(id, '-246px'); } else { getSingleValue('phone','phone'); } break;
		
		case 'sendTheMessage': if(!isLoggedIn) { showLoginPopup(id, '-298px'); } else { alert('NOW send the message'); } break;
		
		case 'showEmail': 		if(!isLoggedIn) { showLoginPopup(id, '-195px'); } else { getSingleValue('email','email'); } break;
		case 'saveInFavorites': if(!isLoggedIn) { showLoginPopup(id, '-143px'); } else { usersFavorites('save'); } break;
		case 'editAd': 			if(!isLoggedIn) { showLoginPopup(id, '-93px'); } else { } break;
		case 'useShipping': 	if(!isLoggedIn) { showLoginPopup(id, '-42px'); } else { } break;
		case 'contract': 		break;
		case 'reportAd': 		break;
		case 'usersOtherAds':   $("#allUsersAdsPage").removeClass("hidden");
								switchDisplayPageTo('allUsersAds');
								pageLoader('show');
								updateAllUsersAdsListing();
			break;
	}

});

// move to showAd_functions
function showLoginPopup(id, yTop) {
	$("#loginPopup").css("top", yTop);
	// $("#loginPopup").removeClass("hidden");
	unhide('loginPopup');
	$("#loginPopup").focus();
}
// hide login popup
$("#loginPopup").on('blur click',function(){
	// $("#loginPopup").addClass("hidden");
	hide('loginPopup');
});
$("#loginPopupBtn").click(function() {
	alert('loginPopupBtn clicked');
});

/* =============================  all users ads page -clicks ===================================== */
$("#allUsersAdsPage").on("click", "#backToSingleAdPageBtn", function(){
	switchDisplayPageTo('singleAd');
});
// --------------- comments panel - listing ---------------

// show comments list button
$("#commentsPanel").on("click", "#showCommentsBtn", function(){
	showComments();
	hide('showCommentsBtn');
});
$("#commentsPanel").on("click", "#writeFirstCommentBtn", function(){
	writeComment();
	hide('writeFirstCommentBtn');
}); 

function showComments() {
	if($("#ajaxComments").html() == '') {
		if(!commentFormActive()) {
			pageLoader('show');
			alert('getting COMMENTS');
		    getComments();
		}
	}
	unhide('commentsPanelContent,hideCommentsBtn,writeCommentBtn');
	// scroll to top of comments
	$('html, body').animate({ scrollTop: $("#commentsPanel").offset().top }, 1000);
}

// hide comments list button
$("#commentsPanel").on("click", "#hideCommentsBtn", function(){
    //$("#commentsPanelContent").addClass("hidden");
	//$("#hideCommentsBtn").addClass("hidden");
	//$("#showCommentsBtn").removeClass("hidden");
	hide('commentsPanelContent,hideCommentsBtn');
	unhide('showCommentsBtn');
});
// --------------- comments panel - write comment  ---------------
// reply link clicked - show comment form
$("#commentsPanel").on("click", ".comment-reply-link", function(){
	if(commentFormActive()) {
		// notify user if there's data in open comment form and cancel
		if(($("#writeCommentForm #comment").val() + $("#writeCommentForm #commenterName").val()).length>0) {
			alert(tr['comments_pleaseSaveOrCancelTheOpenCommentForm']);			
		} else {
			closeCommentForm();
			writeComment($(this));
		}
	} else {
			closeCommentForm();
			writeComment($(this));
	}
	// if(!commentFormActive()) {
		// writeComment( $(this).parent().parent().attr("id") );
	//	writeComment($(this),commentText,commenterName);
	// }
});
// write comment clicked - show comment form
$("#commentsPanelContent").on("click", "#writeCommentBtn", function(){
	writeComment(); // get this commetns id
	hide('writeCommentBtn');
});
// save comment clicked
$("#commentsPanelContent").on("click", "#saveCommentBtn", function(e){
	e.preventDefault();
	saveComment();
});
// clear form button clicked
$("#commentsPanelContent").on("click", "#clearCommentBtn", function(e){
	e.preventDefault();
	clearCommentForm();
});
// close form clicked
$("#commentsPanelContent").on("click", "#closeCommentForm", function(e){
	closeCommentForm();
	unhide('writeCommentBtn');
});








// TODO use everywhere!
function hide(elements) {
	elArr = elements.split(',');
	var i;
	for(i = 0; i <elArr.length; i++) {
   		$("#"+elArr[i]).addClass("hidden");
   	}
}
function unhide(elements) {
	elArr = elements.split(',');
	var i = 0;
	for(var i = 0; i <elArr.length; i++) {
   		$("#"+elArr[i]).removeClass("hidden");
   	}
}
//// phone number -button clicked
//$(".wideButtons").on("click", "#showPhoneNumber", function(){
//	
//	getSingleValue('phone','phone');
//}); 
// email -button clicked
// $(".wideButtons").on("click", "#showEmail", function(){
// 	alert('showEmail clicked');
// 	getSingleValue('email','singleAd-email');
// });
// save in favorites clicked
// $(".wideButtons").on("click", "#saveInFavorites", function(){
// 	saveInFavorites();
// });

// ------------------ login status --------------------
showLoginStatus();
// display login info modal for 5 seconds
function showLoginStatus() {
	var isLoggedIn = $("#isLoggedIn").html();
	if(isLoggedIn != null) {
		var infoText = '';
		switch(isLoggedIn) {
			case '0': 
				$("#toplink_login").parent().removeClass("hidden"); // You are logged in
				$("#toplink_logout").parent().addClass("hidden"); // You are logged out
				//showInfoText('You have logged out, welcome back');
				infoText = $("#infoText_loggedOut_text").html();	
				// infoText = tr['infoText_loggedOut_text']; - try new ?
				break;
			case '1': 
				$("#toplink_login").parent().addClass("hidden");
				$("#toplink_logout").parent().removeClass("hidden");
				//showInfoText('Welcome, you are now logged in'); // / echo 'Welcome back, ' . $userName;
				infoText = $("#infoText_loggedIn_text").html();
				break;
		}
		showInfoText(infoText);
	}
}
function showInfoText(infoText) {
	$('#infoModal').html(infoText);
	$('#infoModal').css("display","block");
	setTimeout(function() { $("#infoModal").fadeOut(5000); }, 2000);
};
// ------------------ map --------------------
// show map, hide images
//$(".seller").on("click", ".sellerLocation", function() {
$( "#showItemMap" ).click(function() {
	showMap();
});
function showMap() {
	initAdMap();
	//$(".itemImgs").addClass("hidden"); // hide images   $('body').fadeIn(1000);
	$(".itemImgs").fadeOut(1000, function() {
		// $(".itemImgs").addClass("hidden");
		$("#mapPanel").removeClass("hidden"); // show map   $("#infoModal").fadeOut(3000);
	});
	// $("#mapPanel").removeClass("hidden"); // show map   $("#infoModal").fadeOut(3000);
/*
	$(".itemImgs").addClass("hidden");
	//$(".itemImgs").fadeOut(3000, function() {
    	// will be called when the element finishes fading out
    	$("#mapPanel").fadeIn(2000);
	//});

	// $(".itemImgs").fadeOut(3000);
	// $("#mapPanel").fadeIn(2000);
*/	
}
// hide map, show images
$( "#hideItemMap" ).click(function() {
	$("#mapPanel").addClass("hidden"); // hide map
	//$(".itemImgs").removeClass("hidden"); // show images
	$(".itemImgs").fadeIn(1000);
});

var map;
function initAdMap() {
  coords = $("#mapLatLng").html().split(";"); // lat: 59.32068 lng:17.9909
  mapLat = parseFloat(coords[0]);
  mapLng = parseFloat(coords[1]);
  map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: mapLat, lng: mapLng},
    zoom: 14
  });
  var circle = new google.maps.Circle({
    strokeColor: '#FF0000',
    strokeOpacity: 0.8,
    strokeWeight: 2,
    fillColor: '#FF0000',
    fillOpacity: 0.35,
    map: map,
    center: {lat: mapLat, lng: mapLng},
    radius: 800
  });
}

// --------------  image clicks --------------
// single ad image clicked - zoom in full screen
$("#slideshow").on("click", "img", function() {
	$('#modalImage').css("display","block");
    document.getElementById("img01").src = this.src;
});
// full screen image clicked - close
$(".modal-content").click(function() {
	$('#modalImage').css("display","none");
});

$(".itemImgs").on("click", "#prevImg", function(){ moveSlide('prev'); });
$(".itemImgs").on("click", "#nextImg", function(){ moveSlide('next'); });

// keyboard clicks
$(document).keydown(function(event){    
    var key = event.which;                
    switch(key) {
      case 37: moveSlide('prev'); break; // arrow left - show next image
      case 39: moveSlide('next'); break; // arrow right - show prev image
      case 27: // escape
      //case 8: switchDisplayPageTo('index'); pageLoader("hide"); break; // backspace - close single ad and return to index page 
      //case 32: // spaceBar
      //case 13: getSingleAd($("#ajaxTable .selectedItem").attr("id")); pageLoader("show"); break; // enter - open selected ad

      case 40: getListingItemId('next'); break; // arrow down - set next item selected
      case 38: getListingItemId('prev'); break; // arrow up - set prev item selected

      /*
      	var currAdId = $("#currentSingleAd").val();
    	var nextId = $("#"+currAdId).next(".item").attr("id");
		if (typeof(nextId) != "undefined") { getSingleAd(nextId); }
Up: 38
Down: 40
Right: 39
Left: 37
Esc: 27
SpaceBar: 32
      */
    }   
  })




// sets current image item deselected and 
// selects next item in listing
// returns next listing item id
function getListingItemId(direction) {
	var currentItemId = $("#ajaxTable .selectedItem").attr("id");	
	if(direction == "next") {
		var moveToItemId = $("#"+currentItemId).next(".item").attr("id");		
	} else {
		var moveToItemId = $("#"+currentItemId).prev(".item").attr("id");
	}
	if (typeof(moveToItemId) == "undefined") { return; }
	$("#"+currentItemId).removeClass("selectedItem");
	$("#"+moveToItemId).addClass("selectedItem");
	return moveToItemId;
}	

// dot clicked - change image
$("#dots").on("click", ".dot", function() {
	$(".dot").removeClass("activeDot");
	$(this).addClass("activeDot");
	var id = $(this).attr("id");
	id = id.substring(3, id.length);
	$("div#slideshow IMG.activeImg").css("display","none");
	$("div#slideshow IMG.activeImg").removeClass("activeImg");
	$("#"+id).addClass("activeImg");
	$("#"+id).css("display", "inline");
});
// slideshow play and stop
var playing = null;
$(".autoplayControls").on("click", "#play", function() {
	playing = setInterval( 'moveSlide("next");', 2000 ); // 2 secs
	$(this).addClass("hidden");
	$("#stop").removeClass("hidden");
});
$(".autoplayControls").on("click", "#stop", function() {
	clearInterval(playing);
	$(this).addClass("hidden");
	$("#play").removeClass("hidden");
});

/* =============================  new page -clicks ===================================== */
// toggle text & password in pw input
$(".eyeButton").click(function(e){
	if($(this).next().next().attr("type") == 'text') {
		$(this).next().next().prop('type', 'password');
	} else {
		$(this).next().next().prop('type', 'text');
	}
});

////$("#saveButton").click(function(e){
//$('#saveButton').on('click', function(e) {
	//e.preventDefault();
	//$(window).scrollTop(0, 0); // scroll window to top
	//if(isFormValid() == true) {
	//	$('#newAd').submit(); // PHP submit form
	//}
//});









/* ---------- checkbox events and styles -------------- */
$(".myCheck").click(function(e){
	var id = $(this).attr("id").split('_')[1];
	var oldVal = $(this).parent().children("input").val();
	var valArr = oldVal.split(",");
//	if( $(this).parent().attr("id") == 'colorSelector') { oldVal = ''; }
		//$(this).parent().children().removeClass("selectedBlackMark selectedWhiteMark"); }
	if(!oldVal.split(",").includes(id)) {
		//if( $("#phpPageName").val() == 'new') { alert('CHECK TEST parent id:'+$(this).parent().attr("id")); }
		//if( $("#phpPageName").val() == 'new' && $(this).parent().attr("id") == 'color' ) { $(this).siblings().removeClass("myCheckbox-selected"); } // in new page only one color can be selected
		$(this).parent().children("input").val(oldVal + id  + ','); 
	} else {			
		valArr.splice(valArr.indexOf(id), 1);
		$(this).parent().children("input").val(valArr.join(','));
	}

	//handleCheckValues($(this));
	handleCheckStyles($(this));
//	alert('parent to this is:'+$(this).parent().attr("id"));
//	if( $(this).parent().attr("id") != 'colorSelector') {
//		handleCheckStyles($(this));
//	}
	/*
	// set styles for selection
	if ($(this).hasClass("myCheckbox")) { 
		$(this).removeClass("myCheckbox"); 
		$(this).addClass("myCheckbox-selected"); 
	} else { 
		$(this).removeClass("myCheckbox-selected"); 
		$(this).addClass("myCheckbox"); 
	}
	*/
});
/*
function handleCheckValues(elem,multipleOk='1') {
	alert('handleCheckValues');
	var id = elem.attr("id").split('_')[1];
	var oldVal = elem.parent().children("input").val();
	var valArr = oldVal.split(",");
	if(multipleOk == '0') { elem.parent().children("input").val(id); return;}
//	if( $(this).parent().attr("id") == 'colorSelector') { oldVal = ''; }
		//$(this).parent().children().removeClass("selectedBlackMark selectedWhiteMark"); }
	if(!oldVal.split(",").includes(id)) {
		//if( $("#phpPageName").val() == 'new') { alert('CHECK TEST parent id:'+$(this).parent().attr("id")); }
		//if( $("#phpPageName").val() == 'new' && $(this).parent().attr("id") == 'color' ) { $(this).siblings().removeClass("myCheckbox-selected"); } // in new page only one color can be selected
		elem.parent().children("input").val(oldVal + id  + ','); 
	} else {			
		valArr.splice(valArr.indexOf(id), 1);
		elem.parent().children("input").val(valArr.join(','));
	}
}
*/
/* dynamically created checkbox in write comment */
$("#writeCommentPanel").on("click", ".myCheck", function(e) {
	// alert('myCheck hide profile image');
	// handleCheckClick($(this));
	var val = '';
	if($(this).hasClass("myCheckbox")) {
		val = '';
	} else {
		val = $(this).attr("id").split('_')[1];
	}
	$(this).parent().children("input").val();
	handleCheckStyles($(this));
});
function handleCheckStyles(elem) {
	// set styles for selection
	if (elem.hasClass("myCheckbox")) { 
		elem.removeClass("myCheckbox"); 
		elem.addClass("myCheckbox-selected"); 
	} else { 
		elem.removeClass("myCheckbox-selected"); 
		elem.addClass("myCheckbox"); 
	}
}
/* maybe gives error */
/*
function handleCheckClick(elem) {
	var id = elem.attr("id").split('_')[1];
	var oldVal = elem.parent().children("input").val();
	var valArr = oldVal.split(",");
	if(!oldVal.split(",").includes(id)) {
		elem.parent().children("input").val(oldVal + id  + ','); 
	} else {			
		valArr.splice(valArr.indexOf(id), 1);
		elem.parent().children("input").val(valArr.join(','));
	}
	// set styles for selection
	if (elem.hasClass("myCheckbox")) { 
		elem.removeClass("myCheckbox"); 
		elem.addClass("myCheckbox-selected"); 
	} else { 
		elem.removeClass("myCheckbox-selected"); 
		elem.addClass("myCheckbox"); 
	}
}
*/
/* ---------- style fixes -------------- */
// pagination styles
$(".pagination span").first().addClass("firstPaginationItem");
$(".pagination span").last().addClass("lastPaginationItem");

}); /* ========================================= End doc ready ======================================== */



/* ======================== validation =========================== */
// init - textarea & input length validation - creates validation counters
//$("textarea.validateLength").after('<div class="charsLeft"></div>' + '<div class="charsLeftT hidden">' + $("#charsLeftText").val() + '</div>');
//$("input.validateLength").after('<span class="charsLeft hidden"></span>' + '<span class="charsLeftT hidden">' + $("#charsLeftText").val() + '</span>');

/*

<div class="charsLeft"></div><div class="charsLeftT hidden"></div>
*/
// init -  textarea & input length validation
if($("#phpPageName").val() != 'login') {
	// place character counters in inputs & textareas 
	// <div class="charsLeft" style="margin-top:-10px"></div><div class="charsLeftT hidden"></div>
	// init - textarea & input length validation - creates validation counters    <span class="textWidthIcon"></span>
	
	// tr gave error
	//$("textarea.validateLength").after('<div class="charCounter hidden"><div class="charsLeft"></div>' + '<div class="charsLeftT">' + tr['charsLeft'] + '</div><span class="textWidthIcon"></span></div>');
	//$("input.validateLength").after('<span class="charCounter hidden"><span class="charsLeft"></span>' + '<span class="charsLeftT">' + tr['charsLeft'] + '</span><span class="textWidthIcon"></span></span>');
	$("textarea.validateLength").after('<div class="charCounter hidden"><div class="charsLeft"></div>' + '<div class="charsLeftT">' + 'charsLeft' + '</div><span class="textWidthIcon"></span></div>');
	$("input.validateLength").after('<span class="charCounter hidden"><span class="charsLeft"></span>' + '<span class="charsLeftT">' + 'charsLeft' + '</span><span class="textWidthIcon"></span></span>');
}
// <span class="textWidthIcon hidden"></span>


// textarea & input length validation  - Example: <textarea class="validateLength" max="2000" id="a"></textarea>
// $(".validateLength").keyup(function() {
$("#writeCommentPanel, #newAd, #writeMessagePanel").on("keyup", ".validateLength", function(e) {
	// alert('form keyup');
	var max = parseInt($(this).attr('max'));
	var now = parseInt($(this).val().length); 
	var left = max-now;
	//var leftLabel = $(this).next('.charsLeft');
	var leftLabel = $(this).next().children().first('.charsLeft');
	$(leftLabel).html(left);
	if($(this).is("textarea")) {
		$(this).next().removeClass("hidden");
	}
	/*
	if($(this).is("textarea")) {
		$(this).next().removeClass("hidden");
		//$(leftLabel).next('.charCounter').children().removeClass("hidden");
		//$(leftLabel).next().children().removeClass("hidden");

		//$(leftLabel).next('.charsLeftT').removeClass("hidden");
		//$(leftLabel).next('.textWidthIcon').removeClass("hidden");

	} */ /* textarea counter hidden until typing */

	if(parseInt(left) < 0) { 
		$(leftLabel).css("color","#c32525"); 
		$(this).css("background-color","#ffe3e3");
		//// if(leftLabel).hasClass("hidden") { $(leftLabel).removeClass("hidden"); $(leftLabel).next().removeClass("hidden"); }
		//$(leftLabel).removeClass("hidden"); /* input counter hidden until validation failed */
		$(this).next().removeClass("hidden");
		$(leftLabel).next(".charsLeftT").removeClass("hidden"); /* input counter hidden until validation failed */
	} else { 
		$(leftLabel).css("color","#888"); 
		$(this).css("background-color","inherit");
	}		
});
/*

.charsLeft, .charsLeftT {
    float: right !important;
    margin-top: -20px;    
}
.charsLeftT { 
    margin-right: 4px;
}

.err {
    background-color: #d86060;
    top: 2px;
    position: relative;
    color: #fff;
    padding: 4px 8px;
    border-radius: 3px;
    width: 100%;
    float: left;
    border-bottom-left-radius: 0;
    border-bottom-right-radius: 0;
}
.errHighlight {
    border: solid 4px #d86060 !important;
}
*/
/* =================== paymentPanel =================== */
// hide err msg when code edited
$(".paymentPanel").on("click", "#code", function(e){
		if(!$("#errPanel").hasClass("hidden")) { $("#errorsPanel").addClass("hidden"); }
});














/* =================== common helper functions =================== */

// shows and hides loader image animation 
function pageLoader(action) {
	if(action == 'show') {
		$("#pageLoader").removeClass("hidden");
	} else {
		$("#pageLoader").addClass("hidden");
	}
}
// takes date as YYMMDDHHMM and displays in friendly format
function displayDbDate(dbDateYYMMDDHHMM) {
	var dbDate = String(dbDateYYMMDDHHMM);
	//if(dbDateYYMMDDHHMM == null || dbDateYYMMDDHHMM == 0 || dbDateYYMMDDHHMM.length != 10) { alert('Somethings wrong with date: '+dbDateYYMMDDHHMM); return ''; }  	
 	var yy = dbDate.substr(0, 2);  // var res = str.slice(1, 5);
 	yy =+ '20';
 	var mm = dbDate.substr(2, 2);  // .slice is not a function
 	var dd = dbDate.substr(4, 2); 
 	var hh = dbDate.substr(6, 2); 
 	var mm = dbDate.substr(8, 2); 

 	// remove leading zeros - certain browsers give error
	dd = dd.slice(0,1).indexOf("0") != -1 ? dd.substr(1, 1) : dd;
	mm = mm.slice(0,1).indexOf("0") != -1 ? mm.substr(1, 1) : mm;
	
	// https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Date/toLocaleString
  	var displayDate = new Date(Date.UTC(yy,mm,dd,hh,mm));
  	var options = { weekday: 'short', month: 'numeric', day: 'numeric'};
  	return displayDate.toLocaleString('fi',options);
}

/*
not tested - maybe not
function tempGetCurrDate() {
	var currentDate = new Date(),
      day = currentDate.getDate(),
      month = currentDate.getMonth() + 1,
      year = getFullYear(),
      hour = currentDate.currentDate()
      min = currentDate.getMinutes(),
	  sec = currentDate.getSeconds();
   return hour + '' + min +''+ sec;
}
*/

// session('save');
// session('load');
// session('check');
function session(action) {
	if(webStorageSupported() == false) { return; } else { alert('session CALLED: ' + action); }
	var data = null;
	// put hidden fields data into session
	if(action == 'save') {
		data = [];
		data.push($("#geonameid2").val(),
				  $("#timeZone").val(),
				  $("#currencyCode").val(),
				  $("#languages").val(),
				  $("#langCode").val(),
				  $("#siteCountryCode").val() );
		al(data);
		//$.post("AJAX_saveSession.php", {data: data}, function(result){
/*
		var data = ["'" + 
      	$("#geonameid2").val() + "','" +
      	$("#timeZone").val() + "','" + 
      	$("#currencyCode").val() + "','" + 
      	$("#languages").val() + "','" + 
      	$("#langCode").val() + "','" + 
      	$("#siteCountryCode").val() + 
      	"'"];
*/
      		// Saving into session: '660013','Finland/Helsinki','','fi-FI,sv-FI,smn','fi-FI','FI'
      	//	alert('Saving into session: ' + "'" + 
      	//	$("#geonameid2").val() + "','" +
      	//	$("#timeZone").val() + "','" + 
      	//	$("#currencyCode").val() + "','" + 
      	//	$("#languages").val() + "','" + 
      	//	$("#langCode").val() + "','" + 
      	//	$("#siteCountryCode").val() + 
      	//	"'" );
    	// $.post("AJAX_saveSession.php", {data: data}, function(){}); // PHP
    	localStorage.setItem("location", data); // JS
    } else if(action == 'load') {
    	alert('Loading from session: ');
    	// action == load
    	//$.post("AJAX_loadFromSession.php", {}, function(result){  // PHP
    		result = localStorage.getItem("location", data); // JS
    		if(!result) { return null; }
	    	// put data into hidden fields
	    	alert('REading JS session: ' + result);
	   		$.each(result, function (key,val) {
	  		  alert('reading from session: ' + key + '=' + val);
	  		  switch(key) {
	  		    case 0: $("#geonameid2 ").val(val); break;
	  		    case 1: $("#timeZone;").val(val); break;
	  		    case 2: $("#currencyCode").val(val); break;
	  		    case 3: $("#languages").val(val); break;
	  		    case 4: $("#langCode").val(val); break;
	  		    case 5: $("#siteCountryCode").val(val); break;
	  		   }
	  		})
	  	//	}); // foreach
	  	//	alert('Reading from session: ' + "'" + 
      	//	$("#geonameid2").val() + "','" +
      	//	$("#timeZone").val() + "','" + 
      	//	$("#currencyCode").val() + "','" + 
      	//	$("#languages").val() + "','" + 
      	//	$("#langCode").val() + "','" + 
      	//	$("#siteCountryCode").val() + 
      	//	"'" );
	  	
    	// }); // END $.post
    } else {
    	// action=check
    	$.post("AJAX_loadFromSession.php", {}, function(result){
	    	alert('CHECKING JS session: ' + result);
	    	if(result) {return true; } else { return false; }
	    }); // END $.post
    }

}

function getVal(id) {
	var str = $("#"+id).val();
	if(typeof str === 'undefined' ) { str = '';}
	if(str == '-1' ) { str = '';}
	return str;
	// return $("#"+id).val();
}

// set getScript globally cache: true
$.ajaxSetup({
  cache: true
});

function webStorageSupported() {
	if (typeof(Storage) !== "undefined") {
  		return true; // Code for localStorage/sessionStorage.
	} else {
		alert('Seems like your device does not support Web Storage, your location could not be saved.'); 
		return false; 
	}
}


//function getCurrentFileName(){
//    var pagePathName= window.location.pathname;
//    // alert('PAGE: ' + pagePathName.substring(pagePathName.lastIndexOf("/") + 1));
//    return pagePathName.substring(pagePathName.lastIndexOf("/") + 1);
//}
// debugging helper
function al(msg) {
	if($("#isDebug").val()) { 
		console.log(msg); 
	}	    	
}

/*
function isBrowserIE() 
{
    var ua = window.navigator.userAgent;
    var msie = ua.indexOf("MSIE ");
    if (msie > 0) { return true; }  // If Internet Explorer
    return false;
}
*/
function showPage() {
    $('body').fadeIn(1000);
    //setTimeout(function() { $("body").fadeIn(2000); }, 1000);
}

function getTodaysDate() {
	var d = new Date();
	var yy = ''+d.getFullYear(); // Get the year as a four digit number (yyyy)
	yy = yy.substr(2, 2);
	var mm = d.getMonth(); // Get the month as a number (0-11)
	mm++;
	var dd = d.getDate(); // Get the day as a number (1-31)
	return yy+''+mm+''+dd;
}
