function show_caravan_options(selIdsArr,selValsArr,target) {
	var p = 'vehicle_'; // prefix

	// price
	var tail = ' '+tr['priceCurrency'];
	var selVal1 = '5000';
	var selVal2 = '300000';
	var priceData = '0,5000,' + createNums(10000,290000,'',10000,'','noHtml') + ',' + createNums(300000,500000,'',50000,'','noHtml') + ','+tr[p+'over']+' 500000';

	var priceStart = createSelect('priceStart',priceData,0,1,tr['priceStart'],tail,'','','<div class="col areaBg bgNarrow">');
	var priceEnd =     createSelect('priceEnd',priceData,1,0,tr['priceEnd'],tail,'','','<div class="col areaBg bgNarrow">');

	// ------------------------------------ manufacturers ------------------------------------
// kesken - näytä lista valitun cat2 mukaan!!!!!


	// camper (matkailuauto) - nordics (nettikaravaani)
	// 'Adria,Bürstner,Carado,Dethleffs,Hobby,Hymer,Knaus,LMC,Mercedes-Benz,Sunlight'; // popular
	var camperMakes = 'Adria,Adriatik,Aeon,Ahorn,Arca,Arto,Astro,Autark,Autoroller,Avec,Baron Cruiser,BIMOBIL,Blu Camp,Bravia,Bürstner,Cabby,Campline,Capron,Carado,Caravelair,Caretta,Carioca,Carriage,Carthago,Casa Car,Challenger,Chausson,Chevrolet Flee,Ci,Clever,Clou,Clouliner,Coachmen,Cobra,Columbia,Commer,Concorde,Crafter,Cristall,Damon,Delta,Dethleffs,Dream,Dreamer,Due Erre,Duerre Star,Duo-Line,Elddis,Elnagh,EMC,Eura Mobil,Eurohotel,Europa,Family,Fendt,FFB,Fiilis,Flair,FMC,Fortuna,Frankia,Giottiline,Globe-Traveller,Globecar,GMC,Gran Ville,Grandhotel,Granduca,Hehn,Heku,Hobby,Home-Car,Hymer,Itaca,Itineo,Iveco,Joint,Kabe,Kafi,Kapo,Karmann,Kentucky,KIP,Knaus,Kolibri,Kulkuri,La Strada,Laika,Lapcar,LMC,Mabu,Maess,Mammut,Matkaaja,Max,Mc Louis,Mercedes-Benz,Miller,Mobi Safari,Mobilvetta,Monaco,Mooveo,Morelo,Muu merkki,Münsterland,Neoplann,Niesmann,Nobel Art,Nordic,Nugget,Omavalmiste,Optimist,P.L.A,Pallas,Pegaso,Piccolo,Pilote,Poksi,Polar,Pössl,Rapido,Reimo,Rimor,Riva,Riviera,Roadcar,Roller Team,Rotec,Sea,Sharky,Sirius,SMC,Smålandia,Solifer,Southwind,Sportcamper,Sportsman,Sprite,Sterckeman,Sun Living,Sunlight,Swift,T.E.C.,Tabbert,Talento,TCMobile,Teve,Therry,Tramobil,Transhotel,Triple E,Vandura,Vario,Viva,Volkswagen,Weinsberg,Westfalia,Wilk,Wingamm,Winnebago';
	
	// caravan - nordics (nettikaravaani)
	// 'Adria,Cabby,Dethleffs,Fendt,Hobby,Hymer,Kabe,Knaus,LMC,Solifer'; // popular
	var caravanMakes = 'Abbey,ABI Award,Ace,Adria,Agent,Airstream,Aliner,Arto,Astro,Atala,Avondale,Bailey,Baltic,Beyerland,Blu Caravan,Boro,Bürstner,Cabby,Camping,Carado,Caravelair,Caretta,CD,Chateau,Ci,Ci-Sprite,Clouliner,Coachmen,Com,Combicamp,Commer,Compass,Concorde,Cristall,Delta,Dethleffs,Eccles,Elddis,Elnagh,Eriba-Nova,Eura Mobil,Euro-Wagon,Europa,Eximo,Fendt,Fiilis,Fjällvagnen,Flair,Fleetwood,Forest River,Frankia,Gruau,Gulfstream,Hobby,Home-Car,Hymer,Kabe,Kafi,Kaira,KIP,Knaus,Kulba,Lely,Life Style,LMC,Matkaaja,Max,Monza,Multivan,Muu merkki,Münsterland,Nordic,Opio,Pallas,Paul,Paula,Piccolo,Poksi,Polar,Rapid Home,Respo,Rimor,Sinetti,SMV,Smålandia,Solifer,Sprite,Starcraft,Sterckeman,Sävsjö,T at B,T.E.C.,Tabbert,Teiwi,Thomson,Travelbird,Viking,Weinsberg,Weippert,Weltbummler,Westfalia,Wilk,Wingamm,Winnebago';


	// Motor Home and Caravan - germany (https://suchen.mobile.de/fahrzeuge/search.html?vc=Motorhome)
	//var caravanMakes = 'Any,ABI,Adria,Ahorn,Airstream,Alpha,Arca,Autostar,Avento,Bavaria-Camp,Bawemo,Bela,Benimar,Beyerland,Bimobil,Bravia,Burow,Bürstner,Carado,Caravelair,Caro,Carthago,Challenger,Chateau,Chausson,Chrysler,CI International,Citroën,Clever,Coachmen,Concorde,Cristall,CS Reisemobile,Dehler,Delta,Dethleffs,DOMO,Dopfer,Due Erre,Eifelland,Elnagh,Esterel,Etrusco,Eura Mobil,Euro Liner,EVM,eXtreme,Fendt,FFB - Tabbert,Fiat,Fischer,Fleetwood,Ford,Ford / Reimo,Forster,Four-Wheel Camper,Frankia,FR-Mobil,General Motors,GiottiLine,Globecar,Globe-Traveller,Glücksmobil,Granduca,Hehn,Heku,Hobby,Holiday Rambler,Home-Car,HRZ,HYMER / ERIBA / HYMERCAR,Ilusion,Itineo,Iveco,Joint,Kabe,Karmann,Kip,Knaus,Laika,La Strada,LMC,M+M Mobile,Malibu,MAN,Mazda,McLouis,Mercedes-Benz,Miller,Mirage,Mitsubishi,Mobilvetta,Monaco,Moncayo,Morelo,Niesmann + Bischoff,Niewiadów,NobelART,Nordstar,Opel,Orangecamp,Ormocar,P.L.A.,Paul & Paula,Peugeot,Phoenix,Pilote,Pössl,Raclet,Rapido,Reimo,Reisemobile Beier,Renault,Rimor,Riva,Riviera,RMB,Roadcar,Roadtrek,Robel-Mobil,Roller Team,SEA,Seitz,Selbstbau,Six-Pac,Sloop,Sprite,Sterckeman,Sunlight,Sun Living,T@b,Tabbert,TEC,Tischer,Trigano,Triple E,TSL Landsberg/ Rockwood,VANTourer,Vario,Volkswagen,Weinsberg,Weippert,Westfalia,Wilk,Wingamm,Winnebago,Woelcke,XGO';
 	

 	var makesSelect = createHtmlRows( createSingleSelect('machineryMake',camperMakes,tr[p+'manufacturer'],''), 'singleWith3ColWidth');






 	// vehicleType
 	var selId = '2';
 	var vehicleTypeData = 'Alcoves,Cabin,Caravan,Integrated,Mobile Home,Motor Homes&comma; Other,Motor Homes/Pickup,Partly Integrated,Van,Other';
	var vehicleType = createSelect('vehicleType',vehicleTypeData,0,0,tr[p+'carType'],'',1,'','','',true);
	

	if(target == 'index') {
		// price = '<div class="col m2">' + priceStart +  priceEnd +'</div>';
		//var empty = '<div class="col m10"></div>'; // use this to have two selects on top of each other, if inline, use m12 only

		//var price = '<div class="col m2">' + priceStart +  priceEnd +'</div>';
		//showExtraSearhCriteria(div(priceStart +  priceEnd, 2) + emptyDiv(10));
		showExtraSearhCriteria(div(priceStart + makesSelect +  priceEnd + vehicleType, 4) + emptyDiv(8));

		// use this if checkboxes - styling not nice
		//showExtraSearhCriteria(div(priceStart + caravanMakesSelect +  priceEnd, 4)  + emptyDiv(8) + getRadioOrCheckSearchOptions(vehicleTypeData,'vehicleType',"c") );

	} else {
		// new
		//showExtraSearhCriteria(div(priceStart +  priceEnd, 4) + div(makesSelect + vehicleType, 4) + emptyDiv(4));
		showExtraSearhCriteria(vehicleType + makesSelect);

		// showExtraSearhCriteria(div(priceStart +  priceEnd, 4) + div(makesSelect + vehicleType, 4) +emptyDiv(4));
	}

}


