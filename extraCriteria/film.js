function show_film_options(selIdsArr,selValsArr,target) {
	var p = 'film_'; // prefix
	var thisYear = '20'+$("#dateData").html().split(',')[1].substr(0,2);

var aspectRatioData = 'Classic TV 4:3 (1.33:1),Widescreen 16:9 (1.78:1),Widescreen 1.85:1,Widescreen 2.39:1 (2.35:1 / 2.40:1)';
var dvd_regionData = '1 - U.S.&comma; U.S. Territories&comma; Canada&comma; Bermuda,2 - Japan&comma; Europe&comma; South Africa&comma; The Middle East&comma; Egypt,3 - Southeast Asia&comma; East Asia&comma; Hong Kong,4 - Australia&comma; New Zealand&comma; Pacific Islands&comma; Central America&comma; South America&comma; The Caribbean,5 - Eastern Europe&comma; Baltic States&comma; Russia&comma; Central South Asia&comma; Indian subcontinent&comma; Africa&comma; North Korea&comma; Mongolia,6 - China';
var bluray_regionData = 'A/1: North America&comma; Central America&comma; South America&comma; Japan&comma; North Korea&comma; South Korea&comma; Taiwan&comma; Hong Kong&comma;  Southeast Asia,B/2: Europe&comma; Greenland&comma; French territories&comma; Middle East&comma; Africa&comma; Australia&comma;  New Zealand,C/3: India&comma; Nepal&comma; Mainland China&comma; Russia&comma; Central & South Asia';
var mediaData = 'Stream,DVD,Blu-ray,4K Ultra HD,3D Blu-ray,VHS';

	// language
	var language = createSelect('lang',tr['book_langData'],0,0,tr['lang'],'','','','','',true); // TODO make langData!!

	// subtitles 
	var subtitles = createSelect('subtitles',tr['book_langData'],0,0,tr[p+'subtitles'],'','','','','',true);

	// age limit
	var ageLimitData = '6,7,8,19,12,14,16,18'; // v. 
	var ageLimitStart = createSelect('ageStart',ageLimitData,0,0,tr['min']+' '+tr['ageLimit'],' '+tr['year_short'],'','','','',true);
	var ageLimitEnd = createSelect('ageEnd',ageLimitData,0,0,tr['min']+' '+tr['ageLimit'],' '+tr['year_short'],'','','','',true);

	// production year
	var yearData = createYearOptions(thisYear,1974,'','','noHtml');
	var yearStart = createSelect('yearStart',yearData,0,0,tr['min']+' '+tr['prodYear'],'',getSelVal('yearS',selIdsArr,selValsArr),'','','',true);
	var yearEnd = createSelect('yearEnd',yearData,0,0,tr['max']+' '+tr['prodYear'],'',getSelVal('yearE',selIdsArr,selValsArr),'','','',true);

	var image = createSelect('image',aspectRatioData,0,0,tr[p+'aspectRatio'],'','','','','',true);

	// region DVD
	var regionDVD = createSelect('regionDVD',dvd_regionData,0,0,tr[p+'region'],'','','','','',true);

	// region Bly-ray
	var regionBluray = createSelect('regionBluray',bluray_regionData,0,0,tr[p+'region'],'','','','','',true);

	// media
	var media = createSelect('media',tr[p+'mediaData'],0,0,tr[p+'media'],'','','','','',true);

	var category = createSelect('category',tr[p+'categoryData'],0,0,tr['category'],'','','','','',true);

	// genre
	var genre = createSelect('genre',tr[p+'genreData'],0,0,tr['genre'],'','','','','',true);

	var specialEditionCheck = getRadioOrCheckSearchOptions(tr[p+'specialEdition'],'specialEdition',"c"); // + emptyDiv(6)
	var extraMaterialCheck = getRadioOrCheckSearchOptions(tr[p+'extraMaterial'],'extraMaterial',"c"); // + emptyDiv(6)
	var seasonCheck = getRadioOrCheckSearchOptions(tr[p+'season'],'season',"c"); // + emptyDiv(6)
	var boxCheck = getRadioOrCheckSearchOptions(tr[p+'box'],'box',"c"); // + emptyDiv(6)







	//if(target == 'index') {
		// var selects = createHtmlRows(category + media + language + subtitles + prodYear + ageLimit + image + regionDVD + regionBluray);
		var selects = createHtmlRows(language + subtitles + ageLimitStart + ageLimitEnd + yearStart + yearEnd + image + regionDVD + regionBluray + media + category + genre);
		showExtraSearhCriteria(selects + specialEditionCheck + extraMaterialCheck + boxCheck);
	//} else {
		// new
		//showExtraSearhCriteria(div(priceStart + makesSelect +  priceEnd + vehicleType, 4) + emptyDiv(8));
	//}
}