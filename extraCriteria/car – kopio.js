// ------------------------- car ---------------------------
function showCarSearchOptions(target='index') {

	var p = 'vehicle_';
	var tail = selVal = selVal1 = selVal2 = '';

	// priceStart modelStart drivenStart hpStart ,, fuelType gearType leasingType carType driveType
	// ----------------- select lists -------------------
	// price
	//tail = getTr(p+'priceCurrency'); // ' &euro;';
	selVal1 = '2000';
	selVal2 = '17500';
	//var nameS = '';
	//var nameE = '';
	// var priceData = '0,500,1 000,2 000,4 000,6 000,8 000,10 000,12 500,15 000,17 500,20 000,25 000,30 000,40 000,50 000,Yli 50 000';
	var priceData = '0,500,1000,' + createNums(2000,8000,'',2000,'','noHtml') + ',' + createNums(10000,17500,'',2500,'','noHtml') + ',20000,25000,30000,40000,50000,'+getTr(p+'over')+'50000';
	var priceStart = createSelect('priceStart',priceData,0,1,getTr(p+'priceStart'),tail,selVal1); // createSelect(id,data,start,removeFromEnd,defaultText,tail='',selectedId='') {
	var priceEnd =   createSelect('priceEnd',priceData,1,0,getTr(p+'priceEnd'),tail,selVal2);

	// year
	selVal = '1995';
	var yearStartData = yearEndData = createYearOptions(2019,1979,selVal,'','noHtml')+',70-luku,60-luku,50-luku';
	yearEndData += getTr(p+'orOlder'); // ' tai vanhempi';
	var yearStart = createSelect('yearStart',yearStartData,0,0,getTr(p+'yearStart'),'','','');	
	var yearEnd = createSelect('yearEnd',yearEndData,0,0,getTr(p+'yearEnd'),'','','','',target);

	//alert('yearEnd: '+yearEnd);
	// driven
	//var target = 'new'; // TEMP
	// tail = getTr(p+'drivenUnitOfLength'); //' km';
	selVal1 = '50000';
	selVal2 = '150000';
	// fi
	//var drivenStartData = createNums(5000,95000,'',5000,'','noHtml') + ',' + createNums(100000,190000,'',10000,'','noHtml') + ',' + createNums(200000,500000,'',50000,'','noHtml');
	//var drivenEndData = drivenStartData + ',Yli 500 000';
	// se
	// tail = getTr(p+'drivenUnitOfLength'); //' km';
	//var tail = ' mil';
	//var drivenStartData = createNums(500,9500,'',500,'','noHtml') + ',' + createNums(10000,19000,'',1000,'','noHtml') + ',' + createNums(20000,50000,'',5000,'','noHtml');
	var drivenStartData = '0,' + createNums(500,9500,'',500,'','noHtml') + ',' + createNums(10000,19000,'',1000,'','noHtml') + ',' + createNums(20000,50000,'',5000,'','noHtml') + ','+getTr(p+'over')+'50 000';
	var drivenEndData = drivenStartData; // + ',Över 50 000';

	//drivenStartData = '0,' + drivenStartData;
	var drivenStart = createSelect('drivenStart',drivenStartData,0,1,getTr(p+'drivenStart'),tail,selVal1,'','',target);
	var drivenEnd = createSelect('drivenEnd',drivenEndData,1,0,getTr(p+'drivenEnd'),tail,selVal2);

	// hp
	// tail = getTr(p+'unitOfPower'); // ' hv'; 
	selVal1 = '60';
	selVal2 = '300';
	var hpStartData = createNums(40,300,'',20,'','noHtml') + ',' + createNums(330,500,'',50,'','noHtml'); // xxxxxxxxxx
	var hpEndData = hpStartData + ','+getTr(p+'over')+'300';
	hpStartData = '0,' + hpStartData;

	var hpStart = createSelect('hpStart',hpStartData,0,0,getTr(p+'hpStart'),tail,selVal1);
	var hpEnd = createSelect('hpEnd',hpEndData,0,0,getTr(p+'hpEnd'),tail,selVal2,'','',target);

	// fuel
	var selId = '2';
	//var fuelData = 'Bensiini,Diesel,Hybridi,Kaasu,Sähkö,E85 / Flexifuel';
	var fuel = createSelect('fuel',getTr(p+'fuelData'),0,0,getTr(p+'fuel'),'','',selId,'','',true);

	// gear
	var selId = '1';
	//var gearData = 'Manuaali,Automaatti';
	var gear = createSelect('gear',getTr(p+'gearData'),0,0,getTr(p+'gear'),'','',selId,'','',true);

/*
"price" : "Hinta",
"priceStart" : "Min hinta",
"priceEnd" : "Max hinta",
"year" : "Vuosimalli",
"yearData" : ",70-luku,60-luku,50-luku",
"yearStart" : "Min vuosimalli",
"yearEnd" : "Max vuosimalli",
"driven" : "Mittarilukema",
"drivenStart" : "Min mittarilukema",
"drivenEnd" : "Max mittarilukema",
"hp" : "Hevosvoimat",
"hpStart" : "Min hevosvoimat",
"hpEnd" : "Max hevosvoimat",
"fuelType" : "Polttoaine",
"fuelTypeData" : "Bensiini,Diesel,Hybridi,Kaasu,Sähkö,E85 / Flexifuel",
"gearType" : "Vaihteisto",
"gearTypeData" : "Manuaali,Automaatti",
"leasing" : "Leasing typ (SE only)",
"leasingData" : "Visa privatleasing,Dölj privatleasing,Endast privatleasing",
"carType" : "Tyyppi",
"carTypeData" : "Porrasperä,Viistoperä,Farmari,Coupé,Avoauto,Monikäyttö,Maasturi,Tila-auto,Pakettiauto,Hyötyajoneuvo",
"driveType" : "Vetotapa (FI only)",
"driveTypeData" : "Etuveto,Takaveto,Neliveto",
"carTypesIconsData" : "Porrasperä,Viistoperä,Farmari,Coupé,Avoauto,Monikäyttö,Maasturi,Tila-auto,Hyötyajoneuvo",
"colorNames" : "Valkoinen,Harmaa / hopea,Ruskea,Musta,Punainen,Keltainen,Vihreä,Sininen",
"regNum" : "Rekisterinumero",
"xxxxxxxxxxx" : "xxxxxxxxxx",
"xxxxxxxxxxx" : "xxxxxxxxxx",
"xxxxxxxxxxx" : "xxxxxxxxxx",
"xxxxxxxxxxx" : "xxxxxxxxxx",
"xxxxxxxxxxx" : "xxxxxxxxxx",
"xxxxxxxxxxx" : "xxxxxxxxxx",
"xxxxxxxxxxx" : "xxxxxxxxxx",
*/

	// leasing (vain SE)
	var selId = '2';
	//var leasingData = 'Visa privatleasing,Dölj privatleasing,Endast privatleasing';
	var leasingType = createSelect('leasing',getTr(p+'leasingData'),0,0,getTr(p+'leasing'),'','',selId,'','',true);

	// carType (text version)  
	var selId = '2';
	//var carTypeData = 'Porrasperä,Viistoperä,Farmari,Coupé,Avoauto,Monikäyttö,Maasturi,Tila-auto,Pakettiauto,Hyötyajoneuvo';
	var carType = createSelect('vehicleType',getTr(p+'carTypeData'),0,0,getTr(p+'carType'),'',1,'','','',true);
	
	// driveType (vain FI)
	// var driveTypeData = 'Etuveto,Takaveto,Neliveto';
	var drive = createSelect('driveType',getTr(p+'driveData'),0,0,getTr(p+'drive'),'','',selId,'','',true);

	// ----------------- carType icon buttons -------------------
	// carTypeIcons buttons
 	//var carIconsData = 'Småbil,Sedan,Halvkombi,Kombi,Coupé,Cab,SUV,Familjebuss,Yrkesfordon'; // SE
 	////var carIconsData = 'Porrasperä,Viistoperä,Farmari,Coupé,Avoauto,Monikäyttö,Maasturi,Tila-auto,Hyötyajoneuvo'; // FI ------- JÄRJESTYS TARKISTA
 	//// $("#carTypesPanel").html( '<div id="carTypesPanel">'+createIconButtons(carIconsData,'','cartypes','0,3,5')+'</div>' );
 	////$("#extraSearhCriteriaPanel").html().append( '<!-- car types --><div class="col m9 _noPadding"><div id="carTypesPanel">'+createIconButtons(carIconsData,'','cartypes','0,3,5')+'</div></div>' );
 	var carButtons = '<!-- car types --><div class="col m9 _noPadding"><div id="carTypesPanel">'+createIconButtons(getTr(p+'carIconsData'),'','cartypes','0,3,5')+'</div></div>';

 	// ----------------- car colors -------------------
 	//var colorNames = 'White,Silver & Gray,Beez,Black,Red,Yellow,Green,Blue';
 	var colorCodes = 'FFF,D3D3D3,D2B48C,000,DC143C,FFD700,9ACD32,87CEFA';
 	// var colorCodes = 'fcfcfc,D3D3D3,c6af7c,535252,d35a72,efd33e,92be39,69a2dd';
 	//$("#extraSearhCriteriaPanel").html().append( '<!-- car colors --><div id="colorSelector" class="col m3 _noPadding">'+createColorSelector(colorNames,colorCodes,'0,3,5')+'</div>' );
	var carColorSelector = '<!-- car colors --><div id="colorSelector" class="col m3 _noPadding">'+createColorSelector(getTr(p+'colorNames'),colorCodes,'0,3,5')+'</div>';


	if(target == 'index') {
		// combine selects in two rows
		// first row
		var carSelects = createHtmlRows(priceStart +  yearStart);
		carSelects +=    createHtmlRows(drivenStart + hpStart);
		carSelects +=    createHtmlRows(fuel +    	  gear);
		// second row
		carSelects +=    createHtmlRows(priceEnd +    yearEnd);
		carSelects +=    createHtmlRows(drivenEnd +   hpEnd);
		carSelects +=    createHtmlRows(carType +     drive);
		showExtraSearhCriteria(carSelects + carButtons + carColorSelector);
	} else {
		// new
		var regNum = '<div class="col m12">'; 
		regNum += '<label for="regNum">[Registreringsnr]</label>';
		regNum += '<input class="_full-width validateLength" max="15" type="text" name="regNum" value="ABC-123" style="float:left;clear:left;width:110px"><br>';
		regNum += '</div>';
		var carSelects = createHtmlRows(yearEnd + drivenStart);
		carSelects +=    createHtmlRows(carType + hpEnd);
		carSelects +=    createHtmlRows(gear + fuel);
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