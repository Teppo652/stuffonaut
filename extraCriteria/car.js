/* ----------------- car make clicked --------------- */
// car make clicked
//$('.quickCategories').on('click', 'a', function () {
//	show_car_models($(this).text());
//	// showCarSearchOptions();
//});

// get car models to selected car make 
// ERROR 3: Could not load car models: SyntaxError: JSON.parse: expected property name or '}' at line 2 column 1 of the JSON data
function show_car_models(carMake) { // THIS IS NOT IN USE!
	alert('kkkkkkk show_car_models CALLED kkkkkkkkk');
	var moreToggle = '<span id="moreToggle">More '+tr['showMore']+'<span class="arrowDown"></span></span>';
	var lessToggle = '<span id="lessToggle">Less '+tr['showLess']+'<span class="arrowDown flipY"></span></span>';

	$.ajax({
	  url: "extraData/carModels.json",
	  type: "GET",
	  dataType: "json",
	  cache: true,
	  success: function (result) 
	  {

		//alert('ZZZZZZZZZZZZZZZZZ loadExtraDataFile ZZZZZZZZZZZZZZZZZZZZZZ');
		//var result = loadExtraDataFile('carModels');

	  	var quickCategories = '';
	  	$.each(result, function (key,item) {
	  		if(key == carMake) {
	  			var modelsArr = item.split(',');
   				for(var i = 0; i <modelsArr.length; i++) {   					
					quickCategories += '<a id="carMod_' + i + '">' + modelsArr[i] + '</a>';
	  			}
	  			$("#cat2Links").html(quickCategories + moreToggle);

	  			alert('How are car makes and models saved in DB?');
	  			return; 
	  		}
	    });
	  },
	  error: function (xhr, status, errorThrown) { 
		  alert('ERROR 3: Could not load car models: ' + errorThrown); 
		  alert('ERROR 4: Could not load car models: ' + xhr.responseText); 
		}
	});
}

/* WIll not work because of promise thing...
function loadExtraDataFile(file) {
	$.ajax({
	  url: "extraData/carModels.json", //url: "extraData/"+file+".json",
	  type: "GET",
	  dataType: "json",
	  cache: true,
	  success: function (result) 
	  {
	  	return result; 
	  },
	  error: function (xhr, status, errorThrown) { 
		  alert('ERROR 3: Could not load file '+file+': ' + errorThrown); 
		  alert('ERROR 4: Could not load file '+file+': ' + xhr.responseText); 
		}
	});
}
*/

// ------------------------- car ---------------------------
// different numbers for different currencies / miles/km etc...
function getCarNumbers(name,p) { // p=prefix
	//// var lang = $("#langCode").val();
	//var country = ($("#usersGeoLocation").val()).split(",");
	//country = country[2];
	//alert('getNumbers - name:'+name);
	//alert('getNumbers - country:'+country);
	switch(name) {
		case 'price': // EUR Kr...
			return '0,500,1000,' + createNums(2000,8000,'',2000,'','noHtml') + ',' + createNums(10000,17500,'',2500,'','noHtml') + ',20000,25000,30000,40000,50000,'+tr[p+'over']+'50000'; 		
		/*	switch(country) {
				case '2635167': // uk  £500  £10,000  £500,000   https://www.pistonheads.com/
					return '0,500,1000,1500,' + createNums(2000,19000,'',1000,'','noHtml') + ',' + createNums(20000,150000,'',5000,'','noHtml') + ',' + createNums(175000,250000,'',25000,'','noHtml') + ',500000,1000000,2000000,'+tr[p+'over']+'500000'; 
					break;
				case '2661886': // sweden
				case '3144096': // norway   http://finn.no
					return '0,5000,' + createNums(10000,290000,'',10000,'','noHtml') + ','+ createNums(300000,500000,'',50000,'','noHtml') + ','+tr[p+'over']+'500000'; 
					break;
				default: // EUR
					return '0,500,1000,' + createNums(2000,8000,'',2000,'','noHtml') + ',' + createNums(10000,17500,'',2500,'','noHtml') + ',20000,25000,30000,40000,50000,'+tr[p+'over']+'50000'; 
					break;
			} */
		case 'year':
			return createYearOptions(thisYear,1949,selVal,'','noHtml'); break;
		case 'driven': // km mil...
			return '0,' + createNums(500,9500,'',500,'','noHtml') + ',' + createNums(10000,19000,'',1000,'','noHtml') + ',' + createNums(20000,50000,'',5000,'','noHtml') + ','+tr[p+'over']+'50 000';
			break;
		case 'hp':
			return createNums(40,300,'',20,'','noHtml') + ',' + createNums(330,500,'',50,'','noHtml'); break;
			break;
	}
}


// TODO move so it is available for all extra options (car,bike,etc..)
function show_car_options(selIdsArr,selValsArr,target) {
	var p = 'vehicle_'; // prefix
	var tail = '';
	var tail = selVal = selVal1 = selVal2 = ''; // remove when not needed
	var selIdsArr;
	var selValsArr;
	// get data values from saved search if exists
	//if(savedSearchData !='') {
	//	var fieldsArr = savedSearchData.split('&');
	//	var i; var row= name = '';
	//	for(i = 0; i<fieldsArr.length; i++) {
	//	 	 selIdsArr.push(fieldsArr[i].split('=')[0]);
	//		selValsArr.push(fieldsArr[i].split('=')[1]);
	//	}
	//alert('selIdsArr:'+selIdsArr.join());
	//alert('selValsArr:'+selValsArr.join());
	//}

	//// get extraData from DB or savedSearch cookie if exists - used in new.php and index.php
    ////if ($("#extraData_selIds").val() != '') {  selIdsArr = $("#extraData_selIds").val().split('#'); alert('xxxxxxxxx found a xxxxx'+$("#extraData_selIds").val()); } else {  selIdsArr = ''; }
    ////if ($("#extraData_selVal").val() != '') { selValsArr = $("#extraData_selVal").val().split('#'); alert('xxxxxxxxx found b xxxxx'+$("#extraData_selVal").val()); } else { selValsArr = ''; }
    //if ($("#extraData_selIds").length) {  selIdsArr = $("#extraData_selIds").val().split('#'); alert('xxxxxxxxx found a xxxxx'+$("#extraData_selIds").val()); } else {  selIdsArr = ''; }
    //if ($("#extraData_selVal").length) { selValsArr = $("#extraData_selVal").val().split('#'); alert('xxxxxxxxx found b xxxxx'+$("#extraData_selVal").val()); } else { selValsArr = ''; }
    

    //if ($("#extraData_selIds").length) { alert('xxxxxxxxxxx car.js selIds:'+$("#extraData_selIds").val(); }
	//if ($("#extraData_selVal").length) { alert('xxxxxxxxxxx car.js selVal:'+$("#extraData_selVal").val(); }

	// price test
	//if() { selVal1 = }

	var selRegNum = '';
	var selColor = '';
 	var colorCodes = 'FFF,D3D3D3,D2B48C,000,DC143C,FFD700,9ACD32,87CEFA';
 	var colorCodesLight = '255,255,255;211,211,211;210,180,140;0,0,0;220,20,60;255,215,0;154,205,50;135,206,250';
/* 	
val 255,255,255
har 211,211,211
rus 210,180,140
mus 0,0,0
pun 220,20,60
kel 255,215,0
vih 154,205,50
sin 135,206,250
*/
if(target == 'index') {
	selVal1 = '';							  
	selVal2 = '';
	tail = ' '+tr['priceCurrency']; // $("#currencyCode").val(); priceCurrency
	//var nameS = '';
	//var nameE = '';
	// var priceData = '0,500,1 000,2 000,4 000,6 000,8 000,10 000,12 500,15 000,17 500,20 000,25 000,30 000,40 000,50 000,Yli 50 000';
	//var priceData = '0,500,1000,' + createNums(2000,8000,'',2000,'','noHtml') + ',' + createNums(10000,17500,'',2500,'','noHtml') + ',20000,25000,30000,40000,50000,'+tr[p+'over']+'50000';
	var priceData = getCarNumbers('price',p); // 
	var priceStart = createSelect('priceStart',priceData,0,1,tr['priceStart'],tail,getSelVal('priceS',selIdsArr,selValsArr)); // createSelect(id,data,start,removeFromEnd,defaultText,tail='',selectedId='') {
	var priceEnd =   createSelect('priceEnd',priceData,1,0,tr['priceEnd'],tail,getSelVal('priceE',selIdsArr,selValsArr));

	tail = '';
	// year
	selVal = '';
	//var yearStartData = yearEndData = createYearOptions(2019,1979,selVal,'','noHtml')+',70-luku,60-luku,50-luku';
	//yearEndData += tr[p+'orOlder'); // ' tai vanhempi';
	var yearStartData = yearEndData = getCarNumbers('year',p);
	yearEndData += tr[p+'orOlder']; // ' tai vanhempi';
	var yearStart = createSelect('yearStart',yearStartData,0,0,tr[p+'yearStart'],'',getSelVal('yearS',selIdsArr,selValsArr),'');
	var yearEnd = createSelect('yearEnd',yearEndData,0,0,tr[p+'yearEnd'],'',getSelVal('yearE',selIdsArr,selValsArr),'','',target);

	
	// driven
	//var target = 'new'; // TEMP
	// tail = tr[p+'drivenUnitOfLength'); //' km';
	selVal1 = '';
	selVal2 = '';
	tail = ' '+tr[p+'drivenUnitOfLength']; //' mil';
	// fi
	//var drivenStartData = createNums(5000,95000,'',5000,'','noHtml') + ',' + createNums(100000,190000,'',10000,'','noHtml') + ',' + createNums(200000,500000,'',50000,'','noHtml');
	//var drivenEndData = drivenStartData + ',Yli 500 000';
	// se
	// tail = tr[p+'drivenUnitOfLength'); //' km';
	//var tail = ' mil';
	////var drivenStartData = createNums(500,9500,'',500,'','noHtml') + ',' + createNums(10000,19000,'',1000,'','noHtml') + ',' + createNums(20000,50000,'',5000,'','noHtml');
	//var drivenStartData = drivenEndData = '0,' + createNums(500,9500,'',500,'','noHtml') + ',' + createNums(10000,19000,'',1000,'','noHtml') + ',' + createNums(20000,50000,'',5000,'','noHtml') + ','+tr[p+'over')+'50 000';
	//var drivenEndData = drivenStartData; // + ',Över 50 000';
	var drivenStartData = drivenEndData = getCarNumbers('driven',p);
	//drivenStartData = '0,' + drivenStartData;
	var drivenStart = createSelect('drivenStart',drivenStartData,0,1,tr[p+'drivenStart'],tail,getSelVal('drivenS',selIdsArr,selValsArr),'','',target);
	var drivenEnd = createSelect('drivenEnd',drivenEndData,1,0,tr[p+'drivenEnd'],tail,getSelVal('drivenE',selIdsArr,selValsArr));



	// hp
	tail = tr[p+'unitOfPower']; // ' hv'; 
	selVal1 = '';
	selVal2 = '';
	//var hpStartData = createNums(40,300,'',20,'','noHtml') + ',' + createNums(330,500,'',50,'','noHtml');
	var hpStartData = getCarNumbers('hp',p);
	var hpEndData = hpStartData + ','+tr[p+'over']+'300';
	hpStartData = '0,' + hpStartData;
	var hpStart = createSelect('hpStart',hpStartData,0,0,tr[p+'hpStart'],tail,getSelVal('hpS',selIdsArr,selValsArr));
	var hpEnd = createSelect('hpEnd',hpEndData,0,0,tr[p+'hpEnd'],tail,getSelVal('hpE',selIdsArr,selValsArr),'','',target);

// fuel
	var selId = '';
	//var fuelData = 'Bensiini,Diesel,Hybridi,Kaasu,Sähkö,E85 / Flexifuel';
	//alert('****** car.js CREATING- '+p+'fuel:'+tr[p+'fuel'));
	alert('zzzzzzzzzzzzzz fuelData:'+getSelVal('fuel',selIdsArr,selValsArr));
	var fuel = createSelect('fuel',tr[p+'fuelData'],0,0,tr[p+'fuel'],'','',parseInt(getSelVal('fuel',selIdsArr,selValsArr)),'','',true);
	// fuel = hpEnd;

// gear
	var selId = ''; alert('gear val: '+getSelVal('gear',selIdsArr,selValsArr));
	var gear = createSelect('gear',tr[p+'gearData'],0,0,tr[p+'gear'],'','',parseInt(getSelVal('gear',selIdsArr,selValsArr)),'','',true);

	// leasing (vain SE)
	//var selId = '2';
	//var leasing = createSelect('leasing',tr[p+'leasingData'],0,0,tr[p+'leasing'],'','',selId,'','',true);

	// carType (text version)  
	var selId = '';
	//var carTypeData = 'Porrasperä,Viistoperä,Farmari,Coupé,Avoauto,Monikäyttö,Maasturi,Tila-auto,Pakettiauto,Hyötyajoneuvo';
	var carType = createSelect('vehicleType',tr[p+'carTypeData'],0,0,tr[p+'carType'],'',parseInt(getSelVal('carType',selIdsArr,selValsArr)),'','','',true);
	
// driveType (vain FI)
	// var driveTypeData = 'Etuveto,Takaveto,Neliveto';
	var drive = createSelect('drive',tr[p+'driveData'],0,0,tr[p+'drive'],'','',parseInt(getSelVal('drive',selIdsArr,selValsArr)),'','',true);

	// ----------------- carType icon buttons -------------------
	// carTypeIcons buttons   
 	//var carIconsData = 'Småbil,Sedan,Halvkombi,Kombi,Coupé,Cab,SUV,Familjebuss,Yrkesfordon'; // SE
 	////var carIconsData = 'Porrasperä,Viistoperä,Farmari,Coupé,Avoauto,Monikäyttö,Maasturi,Tila-auto,Hyötyajoneuvo'; // FI ------- JÄRJESTYS TARKISTA
 	//// $("#carTypesPanel").html( '<div id="carTypesPanel">'+createIconButtons(carIconsData,'','cartypes','0,3,5')+'</div>' );
 	////$("#extraSearhCriteriaPanel").html().append( '<!-- car types --><div class="col m9 _noPadding"><div id="carTypesPanel">'+createIconButtons(carIconsData,'','cartypes','0,3,5')+'</div></div>' );
 	var carButtons = '<!-- car types --><div class="col m9 _noPadding"><div id="carTypesPanel">'+createIconButtons(tr[p+'carIconsData'],'','cartypes',getSelVal('carType',selIdsArr,selValsArr),'noSeprator')+'</div></div>'; // 0,3,5
 	// var selId = getSelVal('drive',selIdsArr,selValsArr);
 	// if(selId != '') { $("#extraSearhCriteriaPanel #c"+selId).addClass("selected"); } // #extraSearhCriteriaPanel #c3
 	//$("#extraSearhCriteriaPanel #c"+getSelVal('drive',selIdsArr,selValsArr)).addClass("selected");

 	// ----------------- car colors -------------------
 	//var colorNames = 'White,Silver & Gray,Beez,Black,Red,Yellow,Green,Blue';
 	//var colorCodes = 'FFF,D3D3D3,D2B48C,000,DC143C,FFD700,9ACD32,87CEFA';
 	//// var colorCodes = 'fcfcfc,D3D3D3,c6af7c,535252,d35a72,efd33e,92be39,69a2dd';
 	//$("#extraSearhCriteriaPanel").html().append( '<!-- car colors --><div id="colorSelector" class="col m3 _noPadding">'+createColorSelector(colorNames,colorCodes,'0,3,5')+'</div>' );
	selId = '';
	//if( $("#phpPageName").val() == 'new') { selId='0,4,6'; }    
	var colorToggle = '<div id="colorToggle" title="Select color" class="showColorsIcon disable-select"></div>'; 
	//var hideColorsBtn = '<div id="hideColorWheel" title="Hide colors" class="hideColorWheelIcon"></div>'; // <span class="hideColorsIcon"></span>
	var carColorSelector = '<!-- car colors --><div class="_noPadding"><div id="colorSelector" class="col m3 _noPadding hidden">'+createColorSelector(tr[p+'colorNames'],colorCodes,colorCodesLight,getSelVal('colors',selIdsArr,selValsArr))+'</div>' + colorToggle+'</div>';
	// col m3 
} else {
	// new.php
	//year,driven,carType,hp,gear,fuel,accessory (accessory is list)
	var year = createSelect('year',getCarNumbers('year',p),0,0,tr[p+'year'],'',getSelVal('year',selIdsArr,selValsArr),'');
	var driven = createSelect('driven',getCarNumbers('driven',p),0,1,tr[p+'driven'],' '+tr[p+'drivenUnitOfLength'],getSelVal('driven',selIdsArr,selValsArr),'','',target);
	var carType = createSelect('vehicleType',tr[p+'carTypeData'],0,0,tr[p+'carType'],'','',parseInt(getSelVal('vehicleType',selIdsArr,selValsArr)),'','',true);
	var hp = createSelect('hp','0,' + getCarNumbers('hp',p),0,0,tr[p+'hp'],tr[p+'unitOfPower'],getSelVal('hp',selIdsArr,selValsArr));
  	var gear = createSelect('gear',tr[p+'gearData'],0,0,tr[p+'gear'],'','',parseInt(getSelVal('gear',selIdsArr,selValsArr)),'','',true);
	var fuel = createSelect('fuel',tr[p+'fuelData'],0,0,tr[p+'fuel'],'','',parseInt(getSelVal('fuel',selIdsArr,selValsArr)),'','',true);

	selRegNum = getSelVal('regNum',selIdsArr,selValsArr);
	selColor = getSelVal('color',selIdsArr,selValsArr);
	//var selColor = '';
	//selectedColors = getSelVal('color',selIdsArr,selValsArr);
	// alert('color 1:'+color);

	// accessory checkboxes - shown only in new and showAd - not a search crieteria (FI only exists currently in translations)
	var selectedIds = getSelVal('accessory',selIdsArr,selValsArr);
	if(selectedIds != '') { handleAccessoryToggle(); } /* NEW */
	var accessory = createCheckLists(tr[p+'carAccessoryData'],'accessory',selectedIds,tr[p+'carAccessory']);
	//var accessory = getRadioOrCheckSearchOptions(accessoryData,'accessory',"c");
}



	if(target == 'index') {
		// combine selects in two rows
		// first row
		var carSelects = createHtmlRows(priceStart +  yearStart);
		carSelects +=    createHtmlRows(drivenStart + hpStart);
		carSelects +=    createHtmlRows(fuel +    	  gear);
		// second row
		carSelects +=    createHtmlRows(priceEnd +    yearEnd);
		carSelects +=    createHtmlRows(drivenEnd +   hpEnd);
		carSelects +=    createHtmlRows(drive); // leasing (SE only currently)
		showExtraSearhCriteria(carSelects + carButtons + carColorSelector); // NOTE carType is same as carButtons, used in new.php
	} else {
		// new		
		var regNum = '<div class="col m3">';
		regNum += '<label for="regNum">'+tr[p+'regNum']+'</label>'; 
		regNum += '<input class="_full-width validateLength" max="15" type="text" name="regNum" value="'+selRegNum+'" style="float:left;clear:left;width:110px"><br>';
		regNum += '</div>';

		//var colorSelector2 = '<!-- car colors --><div id="colorSelector" class="col m9 _noPadding">'+createColorSelector(tr[p+'colorNames'],colorCodes,selColor)+'</div>';
		var carColorSelector = '<!-- car colors --><div class="_noPadding"><div id="colorSelector" class="_noPadding">'+createColorSelector(tr[p+'colorNames'],colorCodes,colorCodesLight,getSelVal('colors',selIdsArr,selValsArr))+'</div>' + colorToggle+'</div>'; // hidden,  col m3  removed
	
		var carSelects = '<div class="col m12 _noPadding">' + createHtmlRows(year + driven);
		carSelects +=    createHtmlRows(carType + hp);
		carSelects +=    createHtmlRows(gear + fuel) + '</div>';
		// showExtraSearhCriteria(regNum + colorSelector2 + carSelects + accessory); // + carTypeButtons + carColorSelector);
		// temporarily accessory is not in use
		showExtraSearhCriteria(regNum + carColorSelector + carSelects);
	}

} // END showCarSearchOptions

// moved to showExtraCriteria.js
// // iterates saved extra field values
// // checks if id is in idsArr, returns value if is
// function getSelVal(field,selIdsArr,selValsArr) {
// 	if(selIdsArr == '') { return ''; }
// 	var idx = selIdsArr.indexOf(field);
// 	if(idx != -1) { return selValsArr[idx]; }	
// 	return '';
// }

/*
function getCarExtraSearchCriteria() {
	var searchData2 = '';

//	var modelS = modelE= drivenS = drivenE = hpS = hpE= fuel = gear = leasing = carType = drive = accessory = colors = '';			
//	modelS = getVal('modelStart');
//	modelE = getVal('modelEnd');
//	drivenS = getVal('drivenStart');
//	drivenE = getVal('drivenEnd');
//	hpS = getVal('hpStart');
//	hpE = getVal('hpEnd');
//
//	fuel = getVal('fuel');
//	gear = getVal('gear');
//	leasing = getVal('leasing');
//	//carType = getVal('carType'); // select
//	carType = getSelectedCarTypeIcons(); // icon buttons
//	drive = getVal('drive');
//	accessory = getVal('accessory');
//	colors = getSelectedCarColors();


	// gets selected extra criteria values for save searches
	// construct url data
	var val = fieldName = '';
	var urlArr = 'modelS,modelE,drivenS,drivenE,hpS,hpE,fuel,gear,leasing,carType,drive,accessory,colors'.split(',');	
	for(i = 0; i<urlArr.length; i++) {
		if(urlArr[i].substr(-1,1) == 'S') { urlArr[i] += 'tart'; }
		if(urlArr[i].substr(-1,1) == 'E') { urlArr[i] += 'nd'; }
		switch(urlArr[i]) {
			case 'carType': val = getSelectedCarTypeIcons(); break; // icon buttons - car
			case 'colors': val = getSelectedCarColors(); break; // car
			default: val = getVal(urlArr[i]); break;
		}
		searchData2 += (val != '' ? '&'+urlArr[i]+'='+val : ''); // NEW searchData2:&fuel=3&gear=1&drive=2&drive=2		
	}


//	searchData2 += (modelS 	!= '' ? 	'&modelS='+modelS : '');
//	searchData2 += (modelE 	!= '' ? 	'&modelE='+modelE : '');
//	searchData2 += (drivenS != '' ? 	'&drivenS='+drivenS : '');
//	searchData2 += (drivenE != '' ? 	'&drivenE='+drivenE : '');
//	searchData2 += (hpS  	!= '' ? 	'&hpS='+hpS  : '');
//	searchData2 += (hpE 	!= '' ? 	'&hpE='+hpE : '');
//	searchData2 += (fuel 	!= '' ? 	'&fuel='+fuel : '');
//	searchData2 += (gear 	!= '' ? 	'&gear='+gear : '');
//	searchData2 += (leasing != '' ? 	'&leasing='+leasing : '');
//	searchData2 += (carType != '' ? 	'&carType='+carType : '');
//	searchData2 += (drive 	!= '' ? 	'&drive='+drive : '');
//    searchData2 += (accessory 	!= '' ? 	'&accessory='+accessory : '');
//	searchData2 += (colors 	!= '' ? 	'&colors='+colors : '');

	//alert('car NEW searchData2:'+searchData2);
	// searchData += searchData2;
	return searchData2;
}
*/

// car colors
function createColorSelector(colorNames,colorCodes,colorCodesLight,selectedIds='') {
	var res = isSelected = extraStyle = '';
	var namesArr = colorNames.split(',');
	var codesArr = colorCodes.split(',');
	var codesLightArr = colorCodesLight.split(';');
	var selsArr = selectedIds.split('');
	var extraComma = selectedIds!='' ? ',' : '';
	var i;
	var end = codesArr.length;
	for(i = 0; i<end; i++) {
		if(selectedIds != '') {
			if(selsArr.indexOf(i+"") != -1) {  // ennen oli: &colors=color_0;color_2;color_4;color_6 --> 0246
				isSelected = ' selectedWhiteMark';
				// isSelected = i < 2 ? ' selectedBlackMark' : ' selectedWhiteMark'; // old
			} else { 
				isSelected = ''; 
			};
		}
		extraStyle = i==0 ? 'border:solid 1px #bababa;' : ''; // height:53px;
		// res += '<span id="color_'+i+'" title="'+namesArr[i]+'" class="carColor'+isSelected+'" style="background-color:#'+codesArr[i]+'"></span>'; // radial-gradient(circle, rgba(255,255,255,0.6), red 70%);
		// radial
		//res += '<span id="color_'+i+'" title="'+namesArr[i]+'" class="carColor'+isSelected+'" style="'+extraStyle+'background-image: radial-gradient(circle, rgba('+codesLightArr[i]+',0.001), #'+codesArr[i]+' 99%)"></span>';
	 	  res += '<span id="color_'+i+'" title="'+namesArr[i]+'" class="carColor'+isSelected+'" style="'+extraStyle+'background-image: linear-gradient(#'+codesArr[i]+' 20%, rgba('+codesLightArr[i]+',0.2) 75%,rgba('+codesLightArr[i]+',0.2) 99%, #'+codesArr[i]+')"></span>';

	 	// top to bottom   background-image: linear-gradient(red, yellow);	 	
	 	//res += '<span id="color_'+i+'" title="'+namesArr[i]+'" class="carColor'+isSelected+'" style="'+extraStyle+'background-image: linear-gradient(#'+codesArr[i]+', rgba('+codesLightArr[i]+',0.001), #'+codesArr[i]+')"></span>';
	}	// new <span id="color_4" title="Punainen" class="carColor" style="background-image: linear-gradient(#DC143C, rgba(220,20,60,0.2) 65%,rgba(220,20,60,0.2) 65%, #DC143C)"></span>
	res += '<input id="color" name="color" type="hidden" value="'+selsArr.join(',')+extraComma+'">';
	return res;
}
/*
// color clicked
// $(document).off('click', '#selector_id').on('click', 
//$("#extraSearhCriteriaPanel").on("click", ".carColor", function(){	
function colorClicked(id){
	// THIS IS CALLED TWO TIMES????
	//var id = $(this).attr("id").split('_')[1];
	id = id.split('_')[1];
	alert('color clicked id:'+id);
	// hide & show check mark
    if($(this).hasClass("selectedBlackMark") || $(this).hasClass("selectedWhiteMark") ) {    	
    	$(this).removeClass("selectedBlackMark"); // remove selection
    	$(this).removeClass("selectedWhiteMark"); 
    } else {    	
    	if(id == '0' || id == '1') { $(this).addClass("selectedBlackMark"); } else { $(this).addClass("selectedWhiteMark"); } // set selected
    }
    if( $("#phpPageName").val() == 'new') { // on new -page only one can be selected
    	$(this).siblings().removeClass("selectedBlackMark"); 
    	$(this).siblings().removeClass("selectedWhiteMark"); 
    } 
    
    // handle color value(s)
	var oldVal = $(this).parent().children("input").val();
	//alert('color clicked oldVal:'+oldVal);
	var valArr = oldVal.split(",");
	if($("#phpPageName").val() == 'new') {
		if(id == oldVal) { id=''; } // remove value 
		$(this).parent().children("input").val(id); // only one selection allowed
	} else {	
		alert('multiple values allowed oldVal:'+oldVal);
		alert('includes id:'+id+'  check result:'+oldVal.split(",").includes(id));
		// multiple values allowed
		if(!oldVal.split(",").includes(id)) {
			$(this).parent().children("input").val(oldVal + id  + ','); 
		} else {			
			valArr.splice(valArr.indexOf(id), 1);
			$(this).parent().children("input").val(valArr.join(','));
		}
	}
//});
}
*/
function getSelectedCarColors() {
	var colorsArr = [];
	$('#colorSelector').children().each(function(){
	   if($(this).hasClass('selectedBlackMark') || $(this).hasClass('selectedWhiteMark')) { colorsArr.push($(this).attr('id').split('_')[1]); } // new
	});
	return colorsArr.join(''); // NOTE no separator - max 10 values: 0123456789
}
function getSelectedCarTypeIcons() { // carTypesPanel
	var carTypesArr = [];
	$('#carTypesPanel').children().each(function(){
	   if($(this).hasClass('selected')) { carTypesArr.push($(this).attr('id').substr(1,1)); }
	});
	return carTypesArr.join(''); // NOTE no separator - max 10 values: 0123456789
}

// accessoryToggle clicked - hide / show
/*
$("#extraSearhCriteriaPanel").on("click", "#accessoryToggle", function(e){
	e.preventDefault();
	handleAccessoryToggle();
});
function handleAccessoryToggle() {
	if($(this).children().hasClass("plusIcon")) {
		$("#accessoryPanel").removeClass("hidden");
		$(this).children().removeClass("plusIcon");
		$(this).children().addClass("minusIcon");
	} else {
		$("#accessoryPanel").addClass("hidden");
		$(this).children().removeClass("minusIcon");
		$(this).children().addClass("plusIcon");
	}
}
*/



/*
function showCarSearchOptions(target='index') {
	// alert('car.js 4 - showCarSearchOptions CALLED -  pageName: '+target);
	// priceStart modelStart drivenStart hpStart ,, fuelType gearType leasingType carType driveType
	// ----------------- select lists -------------------
	// price
	var tail = ' &euro;';
	var selVal1 = '2000';
	var selVal2 = '17500';
	//var nameS = '';
	//var nameE = '';
	// var priceData = '0,500,1 000,2 000,4 000,6 000,8 000,10 000,12 500,15 000,17 500,20 000,25 000,30 000,40 000,50 000,Yli 50 000';
	var priceData = '0,500,1000,' + createNums(2000,8000,'',2000,'','noHtml') + ',' + createNums(10000,17500,'',2500,'','noHtml') + ',20000,25000,30000,40000,50000,Yli 50000';
	var priceStart = createSelect('priceStart',priceData,0,1,'Min hinta',tail,selVal1); // createSelect(id,data,start,removeFromEnd,defaultText,tail='',selectedId='') {
	var priceEnd =   createSelect('priceEnd',priceData,1,0,'Max hinta',tail,selVal2);

	// year
	var selVal = '1995';
	var yearStartData = yearEndData = createYearOptions(2019,1979,selVal)+',70-luku,60-luku,50-luku'; // XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX HERE
	yearEndData += ' tai vanhempi';
	var yearStart = createSelect('yearStart',yearStartData,0,0,'Min vuosimalli','','','');	
	var yearEnd = createSelect('yearEnd',yearEndData,0,0,'Max vuosimalli','','','','',target);
	//             createSelect(id,data,start,removeFromEnd,defaultText,tail='',selectedVal='',selectedId='',tag='',target='index',saveNumeric=false) {
	
	// driven
	//var target = 'new'; // TEMP
	var tail = ' km';
	var selVal1 = '50000';
	var selVal2 = '150000';
	// fi
	//var drivenStartData = createNums(5000,95000,'',5000,'','noHtml') + ',' + createNums(100000,190000,'',10000,'','noHtml') + ',' + createNums(200000,500000,'',50000,'','noHtml');
	//var drivenEndData = drivenStartData + ',Yli 500 000';
	// se
	var tail = ' mil';
	//var drivenStartData = createNums(500,9500,'',500,'','noHtml') + ',' + createNums(10000,19000,'',1000,'','noHtml') + ',' + createNums(20000,50000,'',5000,'','noHtml');
	var drivenStartData = '0,' + createNums(500,9500,'',500,'','noHtml') + ',' + createNums(10000,19000,'',1000,'','noHtml') + ',' + createNums(20000,50000,'',5000,'','noHtml') + ',Över 50 000';
	var drivenEndData = drivenStartData; // + ',Över 50 000';

	//drivenStartData = '0,' + drivenStartData;
	var drivenStart = createSelect('drivenStart',drivenStartData,0,1,'Min mittarilukema',tail,selVal1,'','',target);
	var drivenEnd = createSelect('drivenEnd',drivenEndData,1,0,'Max mittarilukema',tail,selVal2);

	// hp
	tail = ' hv';
	var selVal1 = '60';
	var selVal2 = '300';
	var hpStartData = createNums(40,300,'',20,'','noHtml') + ',' + createNums(330,500,'',50,'','noHtml'); // xxxxxxxxxx
	var hpEndData = hpStartData + ',Yli 300';
	hpStartData = '0,' + hpStartData;
// createSelect(id,data,start,removeFromEnd,defaultText,tail='',selectedVal='',selectedId='',tag='',target='index',saveNumeric=false) {
	var hpStart = createSelect('hpStart',hpStartData,0,0,'Min hevosvoimat',tail,selVal1);
	var hpEnd = createSelect('hpEnd',hpEndData,0,0,'Max hevosvoimat',tail,selVal2,'','',target);

	// fuel
	var selId = '2';
	var fuelData = 'Bensiini,Diesel,Hybridi,Kaasu,Sähkö,E85 / Flexifuel';
	var fuelType = createSelect('fuel',fuelData,0,0,'Polttoaine','','',selId,'','',true);

	// gear
	var selId = '1';
	var gearData = 'Manuaali,Automaatti';
	var gearType = createSelect('gear',gearData,0,0,'Vaihteisto','','',selId,'','',true);

	// leasing (vain SE)
	var selId = '2';
	var leasingData = 'Visa privatleasing,Dölj privatleasing,Endast privatleasing';
	var leasingType = createSelect('leasing',leasingData,0,0,'Leasing typ','','',selId,'','',true);



	// carTypes (text version)  
	var selId = '2';
	var carData = 'Porrasperä,Viistoperä,Farmari,Coupé,Avoauto,Monikäyttö,Maasturi,Tila-auto,Pakettiauto,Hyötyajoneuvo';
	var carType = createSelect('vehicleType',carData,0,0,'Tyyppi','',1,'','','',true);
	
	// driveType (vain FI)
	var driveData = 'Etuveto,Takaveto,Neliveto';
	var driveType = createSelect('driveType',driveData,0,0,'Vetotapa','','',selId,'','',true);


	// ----------------- carType icon buttons -------------------
	// carType icon buttons
 	var carTypesData = 'Småbil,Sedan,Halvkombi,Kombi,Coupé,Cab,SUV,Familjebuss,Yrkesfordon'; // SE
 	//var carTypesData = 'Porrasperä,Viistoperä,Farmari,Coupé,Avoauto,Monikäyttö,Maasturi,Tila-auto,Pakettiauto,Hyötyajoneuvo'; // FI ------- JÄRJESTYS TARKISTA
 	// $("#carTypesPanel").html( '<div id="carTypesPanel">'+createIconButtons(carTypesData,'','cartypes','0,3,5')+'</div>' );
 	//$("#extraSearhCriteriaPanel").html().append( '<!-- car types --><div class="col m9 _noPadding"><div id="carTypesPanel">'+createIconButtons(carTypesData,'','cartypes','0,3,5')+'</div></div>' );
 	var carTypeButtons = '<!-- car types --><div class="col m9 _noPadding"><div id="carTypesPanel">'+createIconButtons(carTypesData,'','cartypes','0,3,5')+'</div></div>';

 	// ----------------- car colors -------------------
 	var colorNames = 'White,Silver & Gray,Beez,Black,Red,Yellow,Green,Blue';
 	var colorCodes = 'FFF,D3D3D3,D2B48C,000,DC143C,FFD700,9ACD32,87CEFA';
 	// var colorCodes = 'fcfcfc,D3D3D3,c6af7c,535252,d35a72,efd33e,92be39,69a2dd';
 	//$("#extraSearhCriteriaPanel").html().append( '<!-- car colors --><div id="colorSelector" class="col m3 _noPadding">'+createColorSelector(colorNames,colorCodes,'0,3,5')+'</div>' );
	var carColorSelector = '<!-- car colors --><div id="colorSelector" class="col m3 _noPadding">'+createColorSelector(colorNames,colorCodes,'0,3,5')+'</div>';





	if(target == 'index') {
		alert('populating index');
		// combine selects in two rows
		// first row
		var carSelects = createHtmlRows(priceStart +  yearStart);
		carSelects +=    createHtmlRows(drivenStart + hpStart);
		carSelects +=    createHtmlRows(fuelType +    gearType);
		// second row
		carSelects +=    createHtmlRows(priceEnd +    yearEnd);
		carSelects +=    createHtmlRows(drivenEnd +   hpEnd);
		carSelects +=    createHtmlRows(carType +    driveType);
		showExtraSearhCriteria(carSelects + carTypeButtons + carColorSelector);
	} else {
		alert('populating new');
		// new
		var regNum = '<div class="col m12">'; 
		regNum += '<label for="regNum">[Registreringsnr]</label>';
		regNum += '<input class="_full-width validateLength" max="15" type="text" name="regNum" value="ABC-123" style="float:left;clear:left;width:110px"><br>';
		regNum += '</div>';
		var carSelects = createHtmlRows(yearEnd + drivenStart);
		carSelects +=    createHtmlRows(carType + hpEnd);
		carSelects +=    createHtmlRows(gearType + fuelType);
		showExtraSearhCriteria(regNum + carSelects); // + carTypeButtons + carColorSelector);
	}

} // END showCarSearchOptions

// car colors
function createColorSelector(colorNames,colorCodes,selectedIds='0,4,6') {
	var res = isSelected = '';
	var namesArr = colorNames.split(',');	
	var codesArr = colorCodes.split(',');
	var selsArr = selectedIds.split(',');
	var i;
	var end = codesArr.length;
	//alert(selectedIds);
	for(i = 0; i<end; i++) {
		if(selsArr.indexOf(i+"") != -1) {
			isSelected = ' selectedWhiteMark';
			isSelected = i < 2 ? ' selectedBlackMark' : ' selectedWhiteMark';
		} else { 
			isSelected = ''; 
		};
		res += '<span id="'+i+'" title="'+namesArr[i]+'" class="carColor'+isSelected+'" style="background-color:#'+codesArr[i]+'"></span>';
	}
	return res;
}
*/