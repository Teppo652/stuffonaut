function show_book_options(selIdsArr,selValsArr,target) {
	var p = 'book_'; // prefix

	// category
	var category = createSelect('category',tr[p+'category'],0,0,tr[p+'category'],'','','','','',true);

	// language - 20 most common
	var language = createSelect('language',tr[p+'language'],0,0,tr[p+'language'],'','','','','',true);

//	Äänikirjat  (+kieli + category)
// X Kirjat muilla kielillä


	//if(target == 'index') {
		var selects = createHtmlRows(category +  language);
		showExtraSearhCriteria(selects);
	//} else {
		// new
		//showExtraSearhCriteria(div(priceStart + makesSelect +  priceEnd + vehicleType, 4) + emptyDiv(8));
	//}
}