/* ---------- machinery group clicks ------------ */
// machinery group clicked
/*
$('#searchPanel').on('click', '.machineryGroup', function () {
	var id = $(this).children(".machineryIcon ").attr("id");
	// alert('machinery group clicked id:'+id);
	$("#"+id).css("background-color","#fff");
});
*/

function show_machinery_options(selIdsArr,selValsArr,target) {
	var p = 'vehicle_'; // prefix
	//var t = JSON.parse( $("#translations").val() );

 	// ----------------- heavyMachinery icon buttons -------------------
 	//var machineryGroups = 'Agriculture,Transportation,Construction,Material Handling,Forestry,Groundcare'; // EN
 	//var machineryGroups = 'Lantbruk,Transport- fordon,Entreprenad,Material- hantering,Skogs- maskiner,Grönyte- maskiner,xx,xx';
 	//var machineryGroups = 'Maatalous,Kuljetus- kalusto,Maarakennus,Materiaalin- käsittely,Metsäkoneet,Ympäristö- koneet';

 	var machineryGroups =  tr[p+'machineryData'];
 	var machineryIcons = 'tractor,trailer,excavator,forklift,loader,roadSweeper'; // logs,miniTractor,  // same for all langs
 	var machineryGroupsData = createIconButtons(machineryGroups,machineryIcons,'machineryGroups','3');

 	
	/* 	
	Agriculture			tractorIcon		
	Transportation		trailerIcon
	Construction		excavatorIcon
	Material Handling 	forkliftIcon
	Forestry			loaderIcon2 loaderIcon logsIcon
	Groundcare			miniTractorIcon  roadSweeperIcon
	--
	Building construction craneIcon craneIcon2
	Road Construction  	roadRollerIcon (jyrä)
	*/

// ----------------- machinery makes ------------------- left

 	var machineryMakes = 'AB,AGM,Annaburger,Baastrup,Bailey,Bala,Benzberg,Bergmann,Bigab,Brantner,Brent,Brimont,Chieftain,CLAAS,Deutz-Fahr,Dinapolis,Egebjerg,EOS,E-Z Trail,Fleming,Fliegl,Fortschritt,Fortuna,Foss-Eik,Gilibert,Gisebo,Hapert,Hawe,Herborg,Herbst,Hilken,Humbaur,Ifor Williams,Indespension,J&M,JF,John Deere,Joskin,JPM,Junkkari,Kaweco,Keenan,Kipa,Krampe,Krone,Kröger,Legrand,MAC,Marshall,Marston,Meijer,Mengele,Metal-Fach,Metsjö,Mi,Mowi,Multiva,Muut,Möre,Navtek,NC,New Holland,Nokian,Nolan,Oehler,Palms,Palmse,Peecon,Præstbro,Pronar,Pöttinger,Reisch,Richard Western,RMH,Rolland,Rudolph,Rysky,Seko,Solus,Spragelse,Strautmann,Stronga,Taarup,Tempo,Tim,Tinaz,Trioliet,Tuhti,UNVERFERTH,Weckman,Veenhuis,Welger,Velsa,Wernsmann,Vestas,Western,VGM,Vicon,VM,Vreten';
 	var machineryMakesSelect = createHtmlRows( createSingleSelect('machineryMake',machineryMakes,tr[p+'manufacturer'],''), 'singleWith3ColWidth');
	

// ----------------- machinery year made ------------------- right right
	// machineryYearMade
	var selVal = '';
	var machineryStartData = machineryEndData = createYearOptions(2019,1979,selVal,'noHtml'); // TODO +' tai vanhempi';
	var yearMadeStart = createSelect('modelStart',machineryStartData,0,0,tr[p+'yearStart'],'','','','<div class="col areaBg bgNarrow" style="float:right">');	
	var yearMadeEnd = createSelect('modelEnd',machineryEndData,0,0,tr[p+'yearEnd'],'','','','<div class="col areaBg bgNarrow" style="float:right">'); 

/*
	<div class="col m2 _noPadding" style="margin-right:-7px">

<div class="col areaBg bgNarrow">

// foat right
<div class="col areaBg bgNarrow">
<div class="col areaBg bgNarrow">
*/

	var machineryGroupsButtons = '<div id="machineryGroupsPanel" class="col m8">'+machineryGroupsData+'</div>';
	var machineryMakesAndYears = '<div id="machineryMakesPanel" class="col m4">'+ machineryMakesSelect + yearMadeStart +  yearMadeEnd +'</div>';

	// show on page
	$("#extraSearhCriteriaPanel").html(machineryGroupsButtons + machineryMakesAndYears);
	$("#extraSearhCriteriaPanel").removeClass("hidden");


} // END machinery


// EN machinery subgroups
/*
0 Construction
1 Agriculture
2 Transportation
3 Material Handling
4 Groundcare
5 Forestry

load from file data/machinery_en.json

brands:
load from file data/machinery_brands.json (save for all languages)

---------------

Maskiner och tunga fordon:
Lantbruk
Transportfordon
Entreprenad
Materialhantering
Skogsmaskiner
Grönytemaskiner

*/






/*
createMachineryGroupIconButtons(machineryGroups,'3')
//machineryData +=  '<span class="machineryIcon selected tractorIcon">x</span>';
machineryData +=  '<div class="machineryGroup"> <span id="0" class="machineryIcon tractorIcon"></span>	   <span class="machineryText">Agriculture</span> </div>';
machineryData +=  '<div class="machineryGroup"> <span id="1" class="machineryIcon trailerIcon selected">x</span>	   <span class="machineryText">Agriculture</span> </div>';
machineryData +=  '<div class="machineryGroup"> <span id="2" class="machineryIcon excavatorIcon">x</span>   <span class="machineryText">Agriculture</span> </div>';
machineryData +=  '<div class="machineryGroup"> <span id="3" class="machineryIcon forkliftIcon">x</span>	   <span class="machineryText">Agriculture</span> </div>';
 machineryData += '<div class="machineryGroup"> <span id="4" class="machineryIcon loaderIcon">x</span>	   <span class="machineryText">Agriculture</span> </div>';
 machineryData += '<div class="machineryGroup"> <span id="5" class="machineryIcon logsIcon">x</span>		   <span class="machineryText">Agriculture</span> </div>';
machineryData +=  '<div class="machineryGroup"> <span id="6" class="machineryIcon miniTractorIcon">x</span> <span class="machineryText">Agriculture</span> </div>';
 machineryData += '<div class="machineryGroup"> <span id="7" class="machineryIcon roadSweeperIcon">x</span> <span class="machineryText">Agriculture</span> </div>';

*/
