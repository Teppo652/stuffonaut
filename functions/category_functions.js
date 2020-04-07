

//// category value and name helper functions
//function getCat1ParentCatName() {
//	alert('TRYING TO READ getCat1ParentCatName');
//	var cat1ParentCatName = $('#cat1 option:selected').prev( "option:disabled" ).text(); // needed for breadcrumbs
//	$("#cat1_text").val(cat1ParentCatName); // put into hidden field
//
//	alert('TRIED TO READ getCat1ParentCatName: ' + cat1ParentCatName);
//	return cat1ParentCatName;
//}
function getCatVal(num) {   // =============================================== TODO: make shorter!!!! this might work above
	/*
		if (typeof $('#cat"+num+" option:selected').val() === "undefined") { return null; } 
		var catVal = $('#cat"+num+" option:selected').val(); 
		if(catVal != -1 && catVal != null) { alert('cat1 val = '+ catVal); return catVal; }
	*/
	if(num == 1) {
		//if($('#cat1 option:selected').val() == null) { alert('empty result'); return null; }
		if (typeof $('#cat1 option:selected').val() === "undefined") { return null; } // WORKS
		var cat1Val = $('#cat1 option:selected').val(); // new 
		if(cat1Val != -1 && cat1Val != null) { return cat1Val; }
	} else {
		var cat2Val =  $('#cat2 option:selected').val(); // returns value if we are on new -page
		//alert('WELL23: cat2Val:' + cat2Val);
		//alert('WELL23: crap, its null: ' + $("#cat2").val() );
		if (typeof cat2Val === "undefined") { 
			return $("#cat2").text(); // we are on index -page - lets return hidden value ----------- THIS IS NEW !!!!!!!
		} else {
			if(cat2Val != -1 && cat2Val != null) { return cat2Val; } // we are on new -page
		}
	}
	
}

// returns selected category name
function getCatName(num) {
	if(num == 1) {
		var cat1Name =  $('#cat1 option:selected').text();
		if(cat1Name != null) { return cat1Name; }		 
	} else {
		var cat2Name =  $('#cat2 option:selected').text();
		if(cat2Name != null) { return cat2Name; }	
	}
}


// ----------------- testdata categories --------------------
function generateTestCategories(parentId='') {
	var langId = 'sv'; 
	var returnType = 'text';
	var arr=[];
	$.ajax({
	  url: "AJAX_getCategories.php",
	  type: "GET",
	  data: { 
		  "l": langId,
		"pId": parentId,
		  "t": returnType
	  },
	  dataType: "json",
	  cache: true,
	  success: function (result) 
	  {
	  	// alert(result);
	  	$.each(result, function (index,item) {
	  		arr.push(item.id + '#' + item.name);
	  	}) // each
	  }
// 	  }).fail(function(xhr, status, error) {
//       var errorMessage = xhr.status + ': ' + xhr.statusText
//       alert('Error in getting text categories - ' + errorMessage);
//   	  }); // success
	}); // ajax
	return arr;
}

/* ===================== index & new - get categories =======================*/
      // getCategories(selCat2LinkId, 'cat2Links', 'links', 'defaultCats', '2','',eId); /* NEW */
function getCategories(parentId, target, returnType='select', adTypes='defaultCats', linksLevel='1', moreClicked='') {
	console.log('STARTING Categories '+target+': '+getElapsedTime());
	
// AJAX_getCategories.php?l=1&c=2661886&pId=-1&eId=&t=select


	//alert('mmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmm');
	//alert('parentId:'+parentId+'  target:'+target+'  returnType:'+returnType+'  adTypes:'+adTypes+'  linksLevel:'+linksLevel+'  moreClicked:'+moreClicked);
	// parentId:1  target:cat2Links  returnType:links  adTypes:defaultCats  linksLevel:1  moreClicked

	console.log('getCategories - parentId:'+parentId);
	console.log('getCategories - target:'+target);
	console.log('getCategories - returnType:'+returnType);
	console.log('getCategories - adTypes:'+adTypes);
	console.log('getCategories - linksLevel:'+linksLevel);
	console.log('getCategories - moreClicked:'+moreClicked);

// alert('NOW populating: ' + target + ' with returnType:' + returnType);
//if($("#phpPageName").val() == 'new') return; // end execution if not index page
langId = $('#languageSelector option:selected').val();
if(!langId) langId = $("#langCode").val();

// langId = 'sv'; /* TEMPORARILY SET ALWAYS TO SWEDISH */

//var langId = $("#langCode").val();
//alert("languageSelector: *" + $('#languageSelector option:selected').val() + '*'); // HERE!!!!!
//alert("langCode: *" + $("#langCode").val() + '*');
//alert('STARTING TO getCategories - lang:*'+ langId + '*');
//alert(" - - - - - - countryId: *" + $('#geonameid').val(value) + '*'); // not set yet
// alert('PARENT CAT NAME: ' + $('#cat1 option:selected').prev( "option:disabled" ).text() );


data='', firstOptionText = isDisabled='', itemAttr='', hasPrices='', countryId='', eId='', plusSign='', isBold='', getAdPrices=''; 
selectedCat1 = $("#selectedCat1").val(), selectedCat2 = $("#selectedCat2").val(),
eId = $('#cat1 option:selected').attr("eId"), /* NEW */
//selectedCat1 = getCatName(1), selectedCat2 = getCatName(2),
cat2Links=$("#cat2Links"), arr=[], pageName = $("#phpPageName").val(), target = $("#" + target), 
headerTitles = quickCategories = isSelected='', headerTitleCounter = 0;

if(pageName == 'new') { moreClicked = '1'; getAdPrices='1'; } // show all car models in new page


countryId = $("#usersGeoLocation").val().split(',')[2];
al('getCategories - - - countryId:'+countryId);
// if(countryId == '') { return false; } /* NEW */
//alert('getCategories parentId:'+parentId);
//alert('getCategories returnType:'+returnType);

al("AJAX_getCategories.php?l=" + langId + "&c=" + countryId + "&pId=" + parentId + "&eId=" + eId + "&t=" + returnType);
//alert('CAT FUNC: langId:'+langId+' parentId:'+parentId+' eId:'+eId+' returnType:'+returnType+' getAdPrices:'+getAdPrices+' moreClicked:'+moreClicked);

//alert('UU category: parentId:'+parentId+'  returnType:'+returnType+'  getAdPrices:'+getAdPrices);
$.ajax({
  url: "../AJAX_getCategories.php", //?l=" + langId + "&pId=" + parentId + "&t=" + returnType,
  type: "GET",
  data: {
	  "c": countryId,
	  "l": langId,
	"pId": parentId,
	"eId": eId,
	  "t": returnType,
	  "pr": getAdPrices,
	  "m": moreClicked
  },
  dataType: "json",
  cache: true,
  success: function (result) 
  {
  	al('CATEGORIES RESULT: '+result);
  	// alert('target: '); --------------------------------??????????? is this causing undefined?
  	//alert('CALLING getCategories 3  langId:'+langId);
  	//alert('CALLING getCategories 3  parentId:'+parentId);
  	//alert('CALLING getCategories 3  eId:'+eId);
  	//alert('CALLING getCategories 3  returnType:'+returnType);
  	//alert('CALLING getCategories 3  getAdPrices:'+ getAdPrices);
  	//alert('CALLING getCategories 3  moreClicked:'+moreClicked);
  	//alert('xxxxx getCategories result: '+result);
  	$(target).empty(); // clear old data

  // ----------------------- populate extra searh criteria panel ---------------------------
	var extraId = $('#cat1 option:selected').attr("eId");

	$("#extraSearhCriteriaPanel").html('');
	var path = 'extraCriteria/';
	// get extraData from DB or savedSearch cookie if exists - used in new.php and index.php
    if ($("#extraData_selIds").length) {  selIdsArr = $("#extraData_selIds").val().split('#'); } else {  selIdsArr = ''; }
    if ($("#extraData_selVal").length) { selValsArr = $("#extraData_selVal").val().split('#'); } else { selValsArr = ''; }

	if(extraId) {
		alert('extraId: '+extraId);
		switch(extraId) {
				case '1': alert("realEstate"); 			$.getScript(path+'realEstate.js', 			function() { show_realEstate_options(selIdsArr,selValsArr,pageName); }, true); break;
				case '2': alert("job"); 				$.getScript(path+'job.js', 					function() { show_job_options(selIdsArr,selValsArr,pageName); }, false); break;
				case '3': alert("car"); 				$.getScript(path+'car.js', 					function() { show_car_options(selIdsArr,selValsArr,pageName); }, false); break;
				case '4': alert("tire"); 				$.getScript(path+'tire.js', 				function() { show_tire_options(selIdsArr,selValsArr,pageName); }, false); break;
				case '5': alert("boat"); 				$.getScript(path+'boat.js', 				function() { show_boat_options(selIdsArr,selValsArr,pageName); }, true); break;
				case '6': alert("caravan"); 			$.getScript(path+'caravan.js', 				function() { show_caravan_options(selIdsArr,selValsArr,pageName); }, true); break;
				case '7': alert("moped"); 				$.getScript(path+'moped.js', 				function() { show_moped_options(selIdsArr,selValsArr,pageName); }, true); break;
				case '8': alert("motorcycle"); 			$.getScript(path+'motorcycle.js', 			function() { show_motorcycle_options(selIdsArr,selValsArr,pageName); }, true); break;
				case '9': alert("machinery"); 			$.getScript(path+'machinery.js', 			function() { show_machinery_options(selIdsArr,selValsArr,pageName); }, true); break;
			//case '12': alert("trolley"); 			$.getScript(path+'trolley.js', 				function() { show_trolley_options(selIdsArr,selValsArr,pageName); }, true); break;
			//case '13': alert("bike"); 				$.getScript(path+'bike.js', 				function() { show_bike_options(selIdsArr,selValsArr,pageName); }, false); break;
			// EI LAITETTU CAT1 DROPLISTIIN!! - case '14': alert("snowboard"); 			$.getScript(path+'snowboard.js', 			function() { show_snowboard_options(selIdsArr,selValsArr,pageName); }, true); break;
			// EI LAITETTU CAT1 DROPLISTIIN!! - case '15': alert("skis"); 				$.getScript(path+'skis.js', 				function() { show_skis_options(selIdsArr,selValsArr,pageName); }, true); break;
			//case '16': alert("phone"); 				$.getScript(path+'phone.js', 				function() { show_phone_options(selIdsArr,selValsArr,pageName); }, true); break;
		case '17': alert("book"); 				$.getScript(path+'book.js', 				function() { show_book_options(selIdsArr,selValsArr,pageName); }, true); break;
		case '18': alert("game"); 				$.getScript(path+'game.js', 				function() { show_game_options(selIdsArr,selValsArr,pageName); }, true); break;
		case '19': alert("film"); 				$.getScript(path+'film.js', 				function() { show_film_options(selIdsArr,selValsArr,pageName); }, true); break;
		case '20': alert("music"); 				$.getScript(path+'music.js', 				function() { show_music_options(selIdsArr,selValsArr,pageName); }, true); break;
			case '10': alert("clothes"); 			showRadioSearchOptions('Dam & herr,Dam,Herr','gender'); break; // clothes
			case '11': alert("childrensClothing"); 	showExtraSearhCriteria(getRadioOrCheckSearchOptions('Flicka & pojke,Flicka,Pojke,Unisex','childrenGender',"r") + emptyDiv(6)); break; // childrensClothing
		}
	}

	if (result.length == 0) { 
		if(pageName == 'new' && parentId != '') { $(target).empty(); } // concerns cat2 select
		// put number of cat2 choices in hidden field
  		$("#cat2NumOfOptions").val('0');
		return;
	}
  	// new page - after cat1 is selected
  	if(pageName == 'new' && parentId != '') { 
  		target = $("#cat2"), returnType = 'select'; // return select list result instead of links
  		updateAdTypes(adTypes);

  		$('#eId').val($('#cat1 option:selected').attr("eId")); // put eId in hidden formfield
  	} else { $('#eId').val(''); }
  	/* The first part below is done only on first pageLoad and language change has occured 
  	   - ie. in most cases only once if languge is not changed */
  	if(returnType == 'select') 
  	{
  		// --------------------------- populate select list  -----------------------------------
  		// is sel2 in new -page: select_text		else    select_allCats_text 
  		firstOptionText = pageName == 'index' ? 'select_allCategories_text' : 'select_text'; 
// arr.push('<option adtypes="01234" value="-1">OLD ' + $("#"+firstOptionText).text() + '</option>');
//arr.push('<option adtypes="01234" value="-1">' + tr['select_allCategories'] + '</option>');
arr.push('<option adtypes="01234" value="-1">' + 'All categories' + '</option>');
		//alert('98: PUTTING: ' + $("#"+firstOptionText).text() );
		//arr.push( $('<option/>').val('-1').attr().text($(this).text()));
		if(parentId != -1) { // needed only on new -page - update cat2 select list only when cat1 is selected
			$.each(result, function (index,item) {
				item.id > 2 && item.parentId == -1 ? arr.push("<option disabled/>") : null; /* put empty line above title */
				// --------------------------- populate cat2 link list -----------------------------------
				// create cat2 links (index page) after quicklink cat1 selection
				if(item.parentId == -1) { 
					quickCategories += '<a id="cat0_' + item.id + '">' + item.name + '</a>';
					// put in header headerTitles: BOSTAD30  JOBB100 FORDON200
					//headerTitles += headerTitleCounter < 3 ? '<li><a id="headerCat_' + item.id + '" class="dynamic" href="#">' + item.name + '</a></li>' : ''; /* add first 3 names to headerTitles */
			    	if(item.id == '30' || item.id == '100' || item.id == '200') { headerTitles += '<li><a id="headerCat_' + item.id + '" class="dynamic" href="#">' + item.name + '</a></li>'; }
			    	item.name = item.name.toUpperCase(); // title in capitals
			    	//headerTitleCounter++;  
			    }
				// allow disabled in new -page
			 	//if(pageName == 'new') { 
			 	isDisabled = item.parentId == -1 ? ' disabled ' : ''; //} // set title level options disabled so user can not select them
		       	
		       	itemAttr = item.catAdTypes != '' ? ' adTypes="' + item.catAdTypes + '"' : ''; // put adTypes attribute to option

		       	// in new page when loading existing ad from database
		    	selectedCat1 != '' ? isSelected = item.id == selectedCat1 ? ' selected ' : '' : null; // from database - set cat1 selection
		    	if(pageName == 'new' && target.attr("id") == 'cat2') { 
		    		selectedCat2 != '' ? isSelected = item.id == selectedCat2 ? ' selected ' : '' : null; // from database - set cat2 selection
		    	}
		       	//arr.push('<option' + isSelected + itemAttr + ' value="' + item.id + '"' + isDisabled + '>' + item.name + '</option>');
		       	//arr.push('<option' + isSelected + itemAttr + ' value="' + item.id + '"' + isDisabled + '>' + item.name + ' (' + item.id + ')'+'</option>');
		       	// new with extraId
		       	eId = item.eId != null ? ' eId="' + item.eId + '"' : '';
				plusSign = item.eId != null ? '&hellip;' : ''; // plus sign after categories that have extra selections

		       	hasPrices = item.prp != null ? ' prpPrice="' + item.prp + '"' : ''; // price to private person price
		       	hasPrices += item.prc != null ? ' prcPrice="' + item.prc + '"' : ''; // price to company
		       	isBold = item.eId != null ? ' class="isBold"' : '';
		       	
		       	//arr.push('<option' + isSelected + itemAttr + ' value="' + item.id + '"' + eId + isDisabled + '>' + item.name + ' (' + item.id + ')'+'</option>');
		       	// temp with items with eId are in BOLD
		       	//arr.push('<option' + isSelected + itemAttr + ' value="' + item.id + '"' + eId + hasPrices + isBold + isDisabled + '>' + item.name + ' (' + item.id + ')'+ plusSign + '</option>');
		       	// without id
		       	arr.push('<option' + isSelected + itemAttr + ' value="' + item.id + '"' + eId + hasPrices + isBold+ isDisabled + '>' + item.name +'</option>');
		       	

		       	// arr.push('<option' + isSelected + itemAttr + ' value="' + item.id + '" pId="' + item.parentId + '"' + isDisabled + '>' + item.name + ' (' + item.id + ')'+'</option>');
		       	
		       	// with (id) 
			});	// each
		}

		if(pageName == 'index') // front page
		{
			// $("#headerTitles .dynamic").remove(); // clear first 3 header links
			// get num of dynamic links:
			//alert('num of dynamic links:'+$("#headerTitles .dynamic").size() );
			if($("#headerTitles .dynamic").size() == 0) {
				$("#headerTitles").append(headerTitles); // place first 3 header links
			}
			// create cat2 links
			al('GETTING CAT2 LINKS A');
			if(cat2Links.children().length < 2) {
				cat2Links.html(quickCategories);
////				listingLoader('hide');
//				$(".areaLoaderLinks").addClass("hidden");
				al('ooooooooo first update listing ooooooooo');
				//alert('*****************cat_func.js 212***********************');
				updateListing('1'); // first update listing
			}
			// put first item in categories
			//arr.push('<option adtypes="01234" value="-1">' + $("#select_allCategories_text").text() + '</option>');
			//arr.unshift('<option adtypes="01234" value="-1">NEW ' + $("#select_allCategories_text").text() + '</option>');
		}
		$(target).html(arr.join('')); // display category data
		alert('TARGET: '+ $(target));
		alert('arr: '+arr.join(''));
		if(pageName == 'new' && selectedCat1 != '' && $('#cat2 option:selected').val() == null) updateCat2(); // populate cat select list 
		$("#cat1 .title").css("background-color","#f1f1f1"); // set all title level options background color

	} else if(pageName == 'index') {
// --------------------------- populate cat2 link list -----------------------------------
		// if quickLinks generated links


		if(linksLevel=='2') { linksLevel='3'; }
		if(eId == '3') { linksLevel='3'; } // car hack
		//switch (parentId) {
		//	case '1':
		//	case '2':
		//	case '3':
		//	case '4': // car
		//	case '121':
		//	case '149':
		//	case '176':
		//	case '196':
		//	case '263': linksLevel='3'; break;
		//}

		
		if(returnType == 'catSettings') {
			$.each(result, function (index,item) {
				arr.push('<a id="cat' + linksLevel + '_' + item.id + '" class="disable-select">' + item.name + '<span class="visibleCat disable-select"></span></a>'); 
			});
			//alert('POPULATING userCatSettingsList:'+arr.join(''));
			//$("#catSettingsList").append().html(arr.join(''));
			$(target).append().html(arr.join(''));
			return;
		}

		//alert('oooooooooooooooo populating cat2 link list');
		$.each(result, function (index,item) {
	       // arr.push('<a id="cat2_' + item.id + '">' + item.name + '</a>');
// zzzzzzzzz HERE comes level3 cat1
	       //arr.push('<a id="cat' + linksLevel + '_' + item.id + '">' + item.name + '</a>');
	       arr.push('<a id="cat' + linksLevel + '_' + item.id + '">' + item.name + '<p>, ' + item.num + '</p></a>'); // num
		});
		$(target).html(arr.join(''));
// if loading car models add more & less icons
		//if(parentId == '4') {
		if(eId == '3') {
			var moreToggle = '<span id="moreToggle">'+tr['showMore']+'<span class="arrowDown"></span></span>';
			var lessToggle = '<span id="lessToggle" class="hidden">'+tr['showLess']+'<span class="arrowDown flipY"></span></span>';
			$("#cat2Links").append(moreToggle + lessToggle); // $( ".inner" ).append( "<p>Test</p>" );
		}
		updateAdTypes(adTypes);
	}
// ----------------------- populate extra searh criteria panel ---------------------------

	/*
realEstate
job
car
tire
boat
caravan
moped
motorcycle
machinery
clothes
childrensClothing
trolley
bike
snowboard
skis
phone
book
game
film
		
		//switch(parentId) {
		switch(extraId) {
			case '2':   alert("job"); 		$.getScript(path+'job.js', 			function() { show_job_options(selIdsArr,selValsArr,pageName); }, false); break;
			case '4':   alert("car"); 		$.getScript(path+'car.js', 			function() { show_car_options(selIdsArr,selValsArr,pageName); }, false); break;
		case '67': 		alert("tire"); 		$.getScript(path+'tire.js', 		function() { show_tire_options(selIdsArr,selValsArr,pageName); }, false); break;
			case '75':  alert("boat"); 		$.getScript(path+'boat.js', 		function() { show_boat_options(selIdsArr,selValsArr,pageName); }, true); break;
			case '89':  alert("caravan"); 	$.getScript(path+'caravan.js', 		function() { show_caravan_options(selIdsArr,selValsArr,pageName); }, true); break;
			case '93':  alert("moped"); 	$.getScript(path+'moped.js', 		function() { show_moped_options(selIdsArr,selValsArr,pageName); }, true); break;
			case '97':  alert("motorcycle"); $.getScript(path+'motorcycle.js', 	function() { show_motorcycle_options(selIdsArr,selValsArr,pageName); }, true); break;
			case '115': alert("machinery"); $.getScript(path+'machinery.js', 	function() { show_machinery_options(selIdsArr,selValsArr,pageName); }, true); break;
			//case '150': showRadioSearchOptions('Dam & herr,Dam,Herr','gender'); break; // clothes
			case '150': alert("clothes"); showExtraSearhCriteria(getRadioOrCheckSearchOptions('Dam & herr,Dam,Herr','gender',"r") + emptyDiv(6)); break; // clothes
			//case '167': showRadioSearchOptions('Flicka & pojke,Flicka,Pojke,Unisex','childrenGender'); break; // childrensClothing
			case '167': alert("childrensClothing"); showExtraSearhCriteria(getRadioOrCheckSearchOptions('Flicka & pojke,Flicka,Pojke,Unisex','childrenGender',"r") + emptyDiv(6)); break; // childrensClothing
	case '170':  alert("trolley"); 	$.getScript(path+'trolley.js', 		function() { show_trolley_options(selIdsArr,selValsArr,pageName); }, true); break;
			case '255': alert("bike");		$.getScript(path+'bike.js', 		function() { show_bike_options(selIdsArr,selValsArr,pageName); }, false); 
				//$.getScript(path+'snowboard.js', function() { show_snowboard_options(pageName); }, false);
				//$.getScript(path+'skis.js', function() { show_ski_options(pageName); }, false); 
			break; // skis     193
			case '122':  alert("phone"); 	$.getScript(path+'phone.js', 		function() { show_phone_options(selIdsArr,selValsArr,pageName); }, true); break;
			
			case '207':  alert("book"); 	$.getScript(path+'book.js', 		function() { show_book_options(selIdsArr,selValsArr,pageName); }, true); break;
			case '177':  alert("game"); 	$.getScript(path+'game.js', 		function() { show_game_options(selIdsArr,selValsArr,pageName); }, true); break;
			case '185':  alert("film"); 	$.getScript(path+'film.js', 		function() { show_film_options(selIdsArr,selValsArr,pageName); }, true); break;

			case '278': alert("realEstate"); $.getScript(path+'realEstate.js', 	function() { show_realEstate_options(selIdsArr,selValsArr,pageName); }, true); break;
			// Changed in cats: id 115 Skogs- & lantbruksmaskiner --> Tunga maskiner
		}
	}

*/
	$(target).parent().children("span").addClass("hidden"); // hide loader dots

	if(pageName == 'index') {
		//alert('BEFORE updatePageTitle_category');
		updatePageTitle_category();
		updateBreadcrumbs();
	}

	// put number of cat2 choices in hidden field (earlier set if 0)
	
	al('7777 cat2NumOfOptions: '+$("#cat2 option").size());
  	$("#cat2NumOfOptions").val($("#cat2 option").size());

  //},
  /* XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX */
  /* XXXXXXXXXXXXXXXX 25.4.2019 },async: false, --> },async: true, XXXXXXXXXXXXXXXXXXXXX */
  /* XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX */
  /* XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX */
  },async: true, /* ---------------- make this applied only in first time categories loading! -- TEST speeds with and without this*/
  // complete: function ()
  always: function ()
  	{	     
  		al('code block 999: result.len:'+result.length); 	
  		if(target == 'cat1') {
  		updateListing(); // on page init
  			//alert('NOW CALLING updatePageTitle_category');
  			//updatePageTitle_category(); /* NEW */

  			// $('select option:first-child').attr("text", "x-x-x-x-x");
  		}


  		//alert('BEFORE updatePageTitle_category'); // ------------------ THIS CODE IS NEVER REACHED! ------------------------
	//if(pageName == 'index') {
	//	updatePageTitle_category();
	//	updateBreadcrumbs();
	//}
		// updatePageTitle('cat');
		////updateBreadCrumbs();
		//$("#breadcrumb2").html(cat1Name); 
	 	//$("#breadcrumbIcon2,#breadcrumb2").removeClass("hidden");
//
	 	//if($("#cat2_text").val() != '') { $("#breadcrumb3").html($("#cat2_text").val()); }
	 	//$("#breadcrumbIcon3,#breadcrumb3").removeClass("hidden");
	 	////if($("#pageLoader").hasClass("hidden")) { pageLoader('hide'); }
	 	console.log('FINISHED Categories '+target+': '+getElapsedTime());
  	},
	error: function (xhr, status, errorThrown) { 
	  alert('ERROR 3: Could not load categories (getCategories): ' + errorThrown); 
	  alert('ERROR 4: Could not load categories (getCategories): ' + xhr.responseText); 
	}
//});
  }).fail(function(xhr, status, error) {
      var errorMessage = xhr.status + ': ' + xhr.statusText
      alert('Error 5 - ' + errorMessage);
  });
};
	
	//buttonBlinking('stop');



//function useExtraCriteria() {
//	$.getScript('functions/showExtraCriteria.js', function() {}, true); // true is for caching
//}    

function updateCat2() {
	getCategories($('#cat1 option:selected').val(), "cat2Links", "links", $('#cat1 option:selected').attr("adTypes"));
	$('#cat2Links').removeClass("gr2");
}

/* =================================== extra search criteria fields============================================== */







/* ------------- extra criteria functions --------------- */
// moved to js files


//// add comma between thousands in select list
//$("#priceStart").digits();
//$.fn.digits = function(){ 
//    return this.each(function(){ 
//        $(this).text( $(this).text().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") ); 
//    })
//}

// 150 clothes - showRadioSearchOptions('Dam & herr,Dam,Herr','gender')
// 167 childrensClothing - showRadioSearchOptions('Flicka & pojke,Flicka,Pojke,Unisex','childrenGender');
function showRadioSearchOptions(texts,name) {
	alert('getting radios');
	var textsArr = texts.split(",");
	var isSelected = '';
	var i;
	var res = '<div class="col m6 '+name+'s" style="margin-left:7px">';
	for (i=0; i<textsArr.length; i++ ) {
		//myRadio myRadiobutton-selected
		if(i==0) { isSelected = '-selected'; } else { isSelected = ''; }
		res += '<div id="'+name+'_'+i+'" class="myRadio myRadiobutton'+isSelected+'"></div><span id="'+name+'_'+i+'_text" class="checkText">'+textsArr[i]+'</span>';
	}
	res += '</div>';
	res += '<input id="'+name+'" type="hidden" value="0">';
	//alert('hip');
//	useExtraCriteria();
	//showExtraSearhCriteria(res + emptyDiv(6));
	data = res; // + emptyDiv(6);

	$("#extraSearhCriteriaPanel").html(data);
	$("#extraSearhCriteriaPanel").removeClass("hidden");
}
// not working
function removeSpace(str) {
	// return str.replace(/\s+/g,'');
	//return str.replace(/\s+/g,'');
	
	// replace all dashes by a colon: str.replace( /-/g, ":" )
	return str.replace( / /g, " " );
}

// function addSpace(str) {
// 	if(str.length>3) { 
// 		var arr = str.split();
// 		var last3 = str.slice(str.length-3,3);
//  		return str + ' ' + last3;
// 	}
// 	return str;
// }
// ------------------ page title and breadcrumb functions  ---------------------
// breadcrumbs helper functions
	// // 1 level breadcrumb
	
	// // 2 level breadcrumb
	// var area1Val = getAreaSelection('area01'); 
	// // show area1 text if it is selected - if not show area0 text
	// if(area1Val != -1 && area1Val != null) {
	// 	updateBreadcrumb('2', getAreaSelection('area1','text')); // show area1 name in breadcrumbs
	// } else {
	// 	updateBreadcrumb('2', getAreaSelection('area0','text')); // show area0 name in breadcrumbs
	// }
	// //var area0Text = getAreaSelection('area0','text'); 
	// //if(area0Text == null) { alert('Crap! area0Text is empty!'); }
	// //alert('area0Text: ' + area0Text);
	// //updateBreadcrumb('1', area0Text); // Front page
	// //// updateBreadcrumb('1', $("#select_allCategories_text").val()); // All categories
function updateBreadcrumbs() {
	// collect cat1 and cat2 selections and category names
	var cat1Val = cat2Val = cat1Name = cat2Name = ''; 
	cat1Val =  getCatVal(1);
	cat2Val =  getCatVal(2);
	cat1Name = getCatName(1);
	cat2Name = getCatName(2);
	
	if(!cat1Val || cat1Val == -1) {
		clearBreadcrumbs(1);
		////updateSingleBreadcrumb(0, $("#breadcrumbs_allAds_text").text());
		//updateSingleBreadcrumb(0, tr['breadcrumbs_allAds']); 
		updateSingleBreadcrumb(0, 'All Ads'); 
	} else {
		// clear level 2 & 3 breadcrumbs
		clearBreadcrumbs(2);
		// 0 level: All -text
		//updateSingleBreadcrumb(0, $("#breadcrumbs_allAdsShort_text").text());
		updateSingleBreadcrumb(0, tr['breadcrumbs_allAdsShort']);
		// 1 level: copy cat1 parent cat name into breadcrumb
		//updateSingleBreadcrumb(1, $('#cat1 option:selected').prev( "option:disabled" ).text()); // .prevAll('tr.cep').first();
		updateSingleBreadcrumb(1, capitalizeFirstLetter($('#cat1 option:selected').prevAll( "option:disabled" ).first().text()));
		// 2 level: put cat1 name
		updateSingleBreadcrumb(2, cat1Name);
	}
}
function updateSingleBreadcrumb(level, texts) {
	al(' updating SingleBreadcrumb level:'+level);
	// updateSingleBreadcrumb('4', selCat2Name);
	if(texts != null && texts != '') {
		$(".breadcrumbValue"+level).html(texts);
		$(".breadcrumbIcon"+level).removeClass("hidden");
	}
}
function clearBreadcrumbs(startLevel=2) {  
	startLevel = parseInt(startLevel);
	for(level=startLevel; level<5; level++) {
		$(".breadcrumbValue"+level).html(' ');
		$(".breadcrumbIcon"+level).addClass("hidden");		
	}
}
// ================== single ad breadcrumbs =========================
function updateAdBreadcrumbs() {
	// #singleAdPage
	//copy to show ad
	//.item .cat = category
	//.item .location = location
	var currAdId = $("#currentSingleAd").val();
    //        var nextId = $("#"+currAdId)

	var cat = $("#ajaxTable #"+currAdId+" .cat").text();
	var loc = $("#ajaxTable #"+currAdId+" .text .location").text();
	//alert('-- loc:'+loc);
	$(".breadcrumbValue"+11).html(cat);
	$(".breadcrumbValue"+12).html(loc);
}
function clearAdBreadcrumbs() {  
	$(".breadcrumbValue"+11).html(' ');
	$(".breadcrumbValue"+12).html(' ');
}


function capitalizeFirstLetter(string) 
{
  return string.charAt(0).toUpperCase() + string.slice(1).toLowerCase();
}

function updatePageTitle_category() {
	//alert('FUNCTION updatePageTitle_category');
	var catName = '';
	var cat1Name = getCatName(1);
	//var cat2Name = getCatName(2);
	//if (cat2Name != null && cat2Name != -1) {
	//	catName = '22 '+ cat2Name;
	//} else 
	if (cat1Name != null && cat1Name != -1) {
		catName = cat1Name;
	} else {
		// alert('select_allCategories_text: ' + $("#select_allCategories_text").text() );
		// catName = 'All - ' + $("#select_allCategories_text").text(); // All categories text 
		catName = 'All - ' + tr['select_allCategories']; // new way
	}
	// if(cat1Name==null) { catName = $("#select_allCategories_text").text(); }
	$('#selectedCat1Name').html(catName);
	// total number of ads
	//$('#ads').html( $('#breadcrumbs_numberOfAds_text').html() ); // OLD
	//$("#ads").html(tr['breadcrumbs_numberOfAds']); // the new way
	$("#ads").html('numberOfAds');
}

// quicklink (FORDON,JOBB etc) clicked - Show cat1 choices in quicklinks
function updateCat1LinksUsingDroplist(selCat1LinkId) {
	alert('sssssssss updateCat1Links USING droplist');
	var arr = [];
	// copy cat1links from cat select list - from parent until next DISABLED option
	var parentFound = false;
	$("#cat1 > option").each(function() {
	    // alert(this.text + ' ' + this.value);
	    if(this.value == selCat1LinkId) { parentFound = true; return true; }
	    if(parentFound == true) { 
	    	if($(this).attr("disabled") == 'disabled') { return false; }
	    	arr.push('<a id="cat-1_' + this.value + '">' + this.text + '</a>');
		}
	});
	$("#cat2Links").html(arr.join(''));
	updateAdTypes('defaultCats');
	// updateAdTypes(adTypes);
	// alert('zzzzzzzz cat1link_ids'+arr.join(''));
}