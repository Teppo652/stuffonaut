function show_bike_options(selIdsArr,selValsArr,target) {
	var p = 'bike_'; // prefix
	var tail = selVal = selVal1 = selVal2 = '';

 	// type
	var bikeType = createSelect('type',tr[p+'typeData'],0,0,tr[p+'type'],'','','','','',true);

 	// category
	var category = createSelect('category',tr[p+'categoryData'],0,0,tr[p+'category'],'','','','','',true);

	// manufacturer
	var manufacturerData = 'Conway,Cube,DARTMOOR,FOCUS,Ghost,GT Bicycles,HAIBIKE,Kona,Marin,Mondraker,NS Bikes,ORBEA,Santa Cruz,Serious,VOTEC,Winora';
	var manufacturer = createSelect('manufacturer',manufacturerData,0,0,tr[p+'manufacturer'],'','','','','',true);
/*

energy
reach
travel
gears
material
materialData
gender
genderData
color
*/
	var frameSizeData = createNums(31,67,'',1,'','noHtml'); // 31-67
	var frameSize = createSelect('frameSize',frameSizeData,0,0,tr[p+'frameSize'],'','','','','',true);

	var wheelSizeData = 'Fatbike,26,27.5+,27.5,29+,29';
	var wheelSize = createSelect('wheelSize',wheelSizeData,0,0,tr[p+'wheelSize'],'','','','','',true);

	// (e-bikes only)
	tail = ' '+tr[p+'energyUnit'];
	var energyData = createNums(250,520,'',10,'','noHtml'); // 250-504
	var energyStart = createSelect('energyStart',energyData,0,0,tr[p+'energyStart'],tail);
	var energyEnd = createSelect('energyEnd',energyData,0,0,tr[p+'energyEnd'],tail);

	
	// (e-bikes only)
	// reach - not in use


/*
(mountain bikes only)
travelStart 100-140
travelEnd
travel

gearStart  7-22
gearEnd
gear

colorData:
black,brown,beige,gray,white,blue,petrol,turquoise,green,olive,yellow,orange,red,pink,purple,gold,silver,colorful,transparent


*/












	//if(target == 'index') {
		//showExtraSearhCriteria(div(vehicleType + manufacturer + type + width + height + rim, 6) + emptyDiv(6));

		// first row
		var selects = createHtmlRows(bikeType + category);
		selects +=    createHtmlRows(energyStart + energyEnd);
		selects +=    createHtmlRows(manufacturer);

		showExtraSearhCriteria(selects);
	//} else {
		// new
		//showExtraSearhCriteria(div(priceStart + makesSelect +  priceEnd + vehicleType, 4) + emptyDiv(8));
	//}






	// showExtraSearhCriteria(div(priceStart +  priceEnd, 2) + emptyDiv(10));

}