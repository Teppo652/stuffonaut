function show_game_options(selIdsArr,selValsArr,target) {
	var p = 'game_'; // prefix
	var thisYear = '20'+$("#dateData").html().split(',')[1].substr(0,2);

	// language
	var device = createSelect('device',tr[p+'deviceData'],0,0,tr[p+'device'],'','','','','',true);

// x Expansion pack

	// age limit
	var ageLimitData = '3,7,12,16,18'; // createNums(0,19,'',1,'','noHtml'); // v. 
	var ageLimit = createSelect('ageLimit',ageLimitData,0,0,tr['ageLimit'],' '+tr['year_short'],'','','','',true);

	// production year
	var yearData = createYearOptions(thisYear,1974,'','','noHtml');
	var yearStart = createSelect('yearStart',yearData,0,0,tr['min']+' '+tr['prodYear'],'',getSelVal('yearS',selIdsArr,selValsArr),'','','',true);
	var yearEnd = createSelect('yearEnd',yearData,0,0,tr['max']+' '+tr['prodYear'],'',getSelVal('yearE',selIdsArr,selValsArr),'','','',true);

	// genre
	var genreData = '';
	var genre = createSelect('genre',tr[p+'genreData'],0,0,tr['genre'],'','','','','',true);

	// language
	var language = createSelect('lang',tr['book_langData'],0,0,tr['lang'],'','','','','',true); // TODO make langData!!

	//if(target == 'index') {
		var selects = createHtmlRows(device + genre + yearStart + yearEnd + language + ageLimit);
		showExtraSearhCriteria(selects + clearSelsBtn()); //  
	//} else {
		// new
		//showExtraSearhCriteria(div(priceStart + makesSelect +  priceEnd + vehicleType, 4) + emptyDiv(8));
	//}
}