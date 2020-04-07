<?php
/*
DELETE FROM ads;
INSERT INTO ads (userId,countryId,langId,cat1,cat2,area1,area2,isCompany,adType,title,mainImg,img,texts,price,createdDate,startDate,endDate,isEnhanced,adPassword,active) VALUES  
 (1,1,1,1,1,1,1,false,0,'Title 1','1.jpg','4.jpg','Ad text here',25,1811190851,1811190851,1812290851,false,'pw1',1)
,(2,1,1,1,1,1,1,false,0,'Title 2','2.jpg','4.jpg','Ad text here',25,1811190852,1811190852,1812290852,false,'pw2',2)
,(3,1,1,1,1,1,1,false,0,'Title 3','3.jpg','4.jpg','Ad text here',25,1811190853,1811190853,1812290853,false,'pw3',3)
,(4,1,1,1,1,1,1,false,0,'Title 4','4.jpg','4.jpg','Ad text here',25,1811190854,1811190854,1812290854,false,'pw4',4)
,(5,1,1,1,1,1,1,false,0,'Title 5','5.jpg','4.jpg','Ad text here',25,1811190855,1811190855,1812290855,false,'pw5',5);
============================================================================================
create table categories (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,parentId INT,countryId INT,langId INT,name VARCHAR(50),catDesc VARCHAR(200),orderId TINYINT UNSIGNED,active TINYINT UNSIGNED);

SE:
INSERT INTO categories (parentId,countryId,langId,name,catDesc,orderId,active) VALUES (1,1,1,'name1',null,1,true);
INSERT INTO categories (parentId,countryId,langId,name,catDesc,orderId,active) VALUES (2,1,1,'name2',null,2,true);
INSERT INTO categories (parentId,countryId,langId,name,catDesc,orderId,active) VALUES (3,1,1,'name3',null,3,true);
INSERT INTO categories (parentId,countryId,langId,name,catDesc,orderId,active) VALUES (4,1,1,'name4',null,4,true);
INSERT INTO categories (parentId,countryId,langId,name,catDesc,orderId,active) VALUES (5,1,1,'name5',null,5,true);

SLASH = &#47;

Categories:


HUOM! Default näytettävät adTypes: 0,3 ellei muuta mainittu kategiraun nimen perässä

SE:

INSERT INTO categories
Alla kategorier
BOSTAD &gt;
JOBB &gt;


FORDON
Bilar
 AlfaRomeo,AstonMartin,Audi,Austin,Bentley,BMW,Buick,Cadillac,Chevrolet,Chrysler,Citroën,Dacia,Daewoo,Dodge,Ferrari,Fiat,Ford,GMC,Honda,Hummer,Hyundai,Infiniti,Isuzu,Iveco,Jaguar,Jeep,Kia,Lada,Lamborghini,Lancia,LandRover,Lexus,Lincoln,Lotus,Maserati,Mazda,McLaren,Mercedes-Benz,Mercury,Mini,Mitsubishi,Nissan,Oldsmobile,Opel,Peugeot,Plymouth,Pontiac,Porsche,Renault,Rolls-Royce,Rover&#47;BMC,Saab,SEAT,Skoda,Smart,SsangYong,Subaru,Suzuki,Tesla,Toyota,Volkswagen,Volvo

 Småbil,Sedan,Halvkombi,Kombi,Coupé,Cab,SUV,Familjebuss,Yrkesfordon (extra)

 Vit,Grå&#47;Silver,Brun,Svart,Röd&#47;Orange,Gul,Grön,Blå&#47;Lila (extra)

Bildelar & biltillbehör
 Bilstereo,Däck & fälg,GPS,Reservdelar,Släp,Takboxar & takräcken,Övrigt
Båtar 0,1,3  !!!!
 Motorbåt,Segelbåt,Gummi&#47;ribbåt,Jolle&#47;roddbåt,Kajak&#47;kanot,Vattenskoter,Övrigt
Båtdelar & tillbehör
 Motor & propeller,GPS & navigering,Båtplats & förvaring,Trailer,Övrigt
Husvagnar & husbilar 0,1,3 !!!!
 Husvagn,Husbil,Tillbehör 
Mopeder & A-traktor
 Mopeder,A-Traktorer,Tillbehör
Motorcyklar
 Cross&#47;enduro,Custom,Fyrhjuling&#47;ATV,Offroad,Scooter,Sport,Touring,Övrigt 
MC-delar & tillbehör
 Däck & fälg,Reservdelar,Hjälm&#47;skydd&#47;kläder,Övrigt
Lastbil, truck & entreprenad
 Entreprenad­maskiner,Lastbil & buss,Truck & material­hantering
Skogs- & lantbruksmaskiner
 Grönyte­maskiner,Lantbruks­maskiner,Skogs­maskiner 
Snöskotrar
Snöskoterdelar & tillbehör

FÖR HEMMET
Bygg & trädgård
 Badrum&#47;WC&#47;bastu,Byggmaterial,Kamin & värme,Kök,Trädgårds­maskiner,Trädgård & uteplats,Övrigt 
Möbler & heminredning
 Antikt & konst,Belysning,Bord & stolar,Hemtextil & prydnad,Hyllor & förvaring,Mattor,Säng & sovrum,Soffa&#47;fåtölj&#47;soffmöbler,TV- & stereomöbler,Övrigt 
Husgeråd & vitvaror
 Diskmaskin,Kyl & frys,Kökstillbehör & porslin,Spis & micro,Tvättmaskin & torktumlare,Övrigt 
Verktyg
PERSONLIGT
Kläder & skor
 Dam & herr,Dam,Herr (radio)
 Brudklänningar,Byxor,Jackor & ytterplagg,Jeans,Kjolar & klänningar,Kostymer & kavajer,Skjortor,Skor,Toppar,Tröjor,Övrigt 
Accessoarer & klockor
 Klockor,Smycken,Väskor,Övrigt 
Barnkläder & skor
 Flicka & pojke,Flicka,Pojke,Unisex (radio)
 Kläder,Skor
Barnartiklar & leksaker
 Barnmöbler,Barnvagnar & tillbehör,Bilbarnstolar,Leksaker,Övrigt
ELEKTRONIK
Datorer & TV-spel
 Stationära datorer,Bärbara datorer,Surfplattor,Datortillbehör & program,PC-spel & onlinespel,TV-spel,Övrigt
Ljud & bild
 Filmer & musik,Foto- & videokameror,MP-spelare,Stereo & surround,Video- & DVD-spelare,TV & projektor,Övrigt
Telefoner & tillbehör
 Telefoner,Tillbehör
FRITID & HOBBY
Biljetter
 Konsert,Teater & show,Presentkort,Sport,Övrigt
Resor
 Tåg,Charter- & paketresor,Övriga resor
Böcker & studentlitteratur
Cyklar
 Dam,Herr,Barn,Mountainbike,Racer,Övriga cyklar,Tillbehör
Djur
 Hund,Katt,Katt- & hundtillbehör,Gnagare & kaniner,Reptil,Fågel,Fisk,Lantbruksdjur,Övriga djur,Tillbehör
Hobby & samlarprylar
 Frimärken & mynt,Hobbyfordon,Radiostyrt & modell,Serietidningar,Symaskin & textil,Historiska föremål,Övrigt
Hästar & ridsport
 Hästar,Ponnys,Utrustning,Foder & stall,Medryttare & fodervärd,Släp & transport,Övrigt
Jakt & fiske
 Jakt,Fiske,Övrigt
Musikutrustning
 Gitarr&#47;bas&#47;förstärkare,Piano & klaviatur,Dragspel,Blåsinstrument,Trummor & slagverk,Studio- & scenutrustning,Övrigt
Sport & fritid
 Bollsport,Camping & friluftsliv,Dyk- & vattensport,Golf,Träning & hälsa,Vintersport,Övrigt
AFFÄRSVERKSAMHET
Affärsöverlåtelser
 Butik,Domäner & sajter,Frisörsalong,Restaurang & café,Övrigt
Inventarier & maskiner
 Butik & kassa,Frisör- & skönhetssalong,Kontor,Industrimaskiner,Restaurang & café,Varuparti & konkurslager,Övrigt
Lokaler & fastigheter  0,1,2,3,4
 Butiker,Industri & verkstad,Lager & förråd,Kontor,Övrigt 
Tjänster
 Bil & motor,Catering,Data,Djuravel,Ekonomi,Flytt & transport,Hantverkare,Hundvakt & djurskötsel,Kosmetik & hårvård,Musik & underhållning,Städning,Trädgård & markarbeten,Undervisning
Efterlysningar (tyhjä)
Övright
*/

/* ================================================================= */
// INSERT INTO categories (parentId,countryId,langId,name,catDesc,orderId,active) VALUES (1,1,1,'name1',null,1,true);



echo "drop table categoriesTEST; <br>";
echo "create table categories (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,parentId INT,countryId INT,langId INT,name VARCHAR(50),catDesc VARCHAR(200),orderId INT,active TINYINT UNSIGNED); <br>";
echo "INSERT INTO categories (parentId,countryId,langId,name,catDesc,orderId,active) VALUES ";


// NOTE!!!!!!!!!!!! orderId INT !!!!!!!!!! ----------------------- !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
$o = 0; // orderId

// INSERT INTO categories
//  (null,1,1,'name1',null,1,true);

$topParent = null; 
$s = " (null,1,1,'";
$st = " (-1,1,1,'";
$m = "',null,"; // orderId here
$e = ",true)," . "<br>";

// for subcategories
//  $s. --> " (" . ((int)$o)-1 . ",1,1,'"


// echo $s. "Alla kategorier" .$m.$o.$e; $o++;  // add elsewhere in code!!

echo $st. "BOSTAD &gt;" .$m.$o.$e; $o++; 
echo $st. "JOBB &gt;" .$m.$o.$e; $o++; 

echo $st. "FORDON" .$m.$o.$e; $o++; $topParent=$o; 
echo " ($topParent,1,1,'" . "Bilar" .$m.$o.$e; $o++;
	$o = getSubCats($m,$o--,$e, "AlfaRomeo,AstonMartin,Audi,Austin,Bentley,BMW,Buick,Cadillac,Chevrolet,Chrysler,Citro&euml;n,Dacia,Daewoo,Dodge,Ferrari,Fiat,Ford,GMC,Honda,Hummer,Hyundai,Infiniti,Isuzu,Iveco,Jaguar,Jeep,Kia,Lada,Lamborghini,Lancia,LandRover,Lexus,Lincoln,Lotus,Maserati,Mazda,McLaren,Mercedes-Benz,Mercury,Mini,Mitsubishi,Nissan,Oldsmobile,Opel,Peugeot,Plymouth,Pontiac,Porsche,Renault,Rolls-Royce,Rover&#47;BMC,Saab,SEAT,Skoda,Smart,SsangYong,Subaru,Suzuki,Tesla,Toyota,Volkswagen,Volvo");
 
// Småbil,Sedan,Halvkombi,Kombi,Coup&eacute;,Cab,SUV,Familjebuss,Yrkesfordon (extra)
// Vit,Grå&#47;Silver,Brun,Svart,Röd&#47;Orange,Gul,Grön,Blå&#47;Lila (extra)


echo " ($topParent,1,1,'" . "Bildelar &amp; biltillbehör" .$m.$o.$e; $o++;
	$o = getSubCats($m,$o--,$e, "Bilstereo,Däck &amp; fälg,GPS,Reservdelar,Släp,Takboxar &amp; takräcken,Övrigt");
echo " ($topParent,1,1,'" . "Båtar" .$m.$o.$e; $o++; //  0,1,3  !!!!------------
 	$o = getSubCats($m,$o--,$e, "Motorbåt,Segelbåt,Gummi&#47;ribbåt,Jolle&#47;roddbåt,Kajak&#47;kanot,Vattenskoter,Övrigt");
echo " ($topParent,1,1,'" . "Båtdelar &amp; tillbehör" .$m.$o.$e; $o++;
 	$o = getSubCats($m,$o--,$e, "Motor &amp; propeller,GPS &amp; navigering,Båtplats &amp; förvaring,Trailer,Övrigt");
echo " ($topParent,1,1,'" . "Husvagnar &amp; husbilar" .$m.$o.$e; $o++; // 0,1,3 !!!! -------------------
 	$o = getSubCats($m,$o--,$e, "Husvagn,Husbil,Tillbehör");
echo " ($topParent,1,1,'" . "Mopeder &amp; A-traktor" .$m.$o.$e; $o++;
 	$o = getSubCats($m,$o--,$e, "Mopeder,A-Traktorer,Tillbehör");
echo " ($topParent,1,1,'" . "Motorcyklar" .$m.$o.$e; $o++;
 	$o = getSubCats($m,$o--,$e, "Cross&#47;enduro,Custom,Fyrhjuling&#47;ATV,Offroad,Scooter,Sport,Touring,Övrigt");
echo " ($topParent,1,1,'" . "MC-delar &amp; tillbehör" .$m.$o.$e; $o++;
 	$o = getSubCats($m,$o--,$e, "Däck &amp; fälg,Reservdelar,Hjälm&#47;skydd&#47;kläder,Övrigt");
echo " ($topParent,1,1,'" . "Lastbil, truck &amp; entreprenad" .$m.$o.$e; $o++;
 	$o = getSubCats($m,$o--,$e, "Entreprenad­maskiner,Lastbil &amp; buss,Truck &amp; material­hantering");
echo " ($topParent,1,1,'" . "Skogs- &amp; lantbruksmaskiner" .$m.$o.$e; $o++;
$o = getSubCats($m,$o--,$e, 'Grönyte­maskiner,Lantbruks­maskiner,Skogs­maskiner');
echo " ($topParent,1,1,'" . "Snöskotrar" .$m.$o.$e; $o++;
echo " ($topParent,1,1,'" . "Snöskoterdelar &amp; tillbehör" .$m.$o.$e; $o++;


echo $st. "FÖR HEMMET" .$m.$o.$e; $o++; $topParent=$o; 
echo " ($o,1,1,'" . "Bygg &amp; trädgård" .$m.$o.$e; $o++;
  	$o = getSubCats($m,$o--,$e, "Badrum&#47;WC&#47;bastu,Byggmaterial,Kamin &amp; värme,Kök,Trädgårds­maskiner,Trädgård &amp; uteplats,Övrigt");
echo " ($topParent,1,1,'" . "Möbler &amp; heminredning" .$m.$o.$e; $o++;
  	$o = getSubCats($m,$o--,$e, "Antikt &amp; konst,Belysning,Bord &amp; stolar,Hemtextil &amp; prydnad,Hyllor &amp; förvaring,Mattor,Säng &amp; sovrum,Soffa&#47;fåtölj&#47;soffmöbler,TV- &amp; stereomöbler,Övrigt");
echo " ($topParent,1,1,'" . "Husgeråd &amp; vitvaror" .$m.$o.$e; $o++;
  	$o = getSubCats($m,$o--,$e, "Diskmaskin,Kyl &amp; frys,Kökstillbehör &amp; porslin,Spis &amp; micro,Tvättmaskin &amp; torktumlare,Övrigt");
echo " ($topParent,1,1,'" . "Verktyg" .$m.$o.$e; $o++;

echo $st. "PERSONLIGT" .$m.$o.$e; $o++; $topParent=$o;
echo " ($topParent,1,1,'" . "Kläder &amp; skor" .$m.$o.$e; $o++;
 	// Dam &amp; herr,Dam,Herr (radio)
  	$o = getSubCats($m,$o--,$e, "Brudklänningar,Byxor,Jackor &amp; ytterplagg,Jeans,Kjolar &amp; klänningar,Kostymer &amp; kavajer,Skjortor,Skor,Toppar,Tröjor,Övrigt");
echo " ($topParent,1,1,'" . "Accessoarer &amp; klockor" .$m.$o.$e; $o++;
  	$o = getSubCats($m,$o--,$e, "Klockor,Smycken,Väskor,Övrigt");
echo " ($topParent,1,1,'" . "Barnkläder &amp; skor" .$m.$o.$e; $o++;
 	//Flicka &amp; pojke,Flicka,Pojke,Unisex (radio)
  	$o = getSubCats($m,$o--,$e, "Kläder,Skor");
echo " ($topParent,1,1,'" . "Barnartiklar &amp; leksaker" .$m.$o.$e; $o++;
  	$o = getSubCats($m,$o--,$e, "Barnmöbler,Barnvagnar &amp; tillbehör,Bilbarnstolar,Leksaker,Övrigt");

echo $st. "ELEKTRONIK" .$m.$o.$e; $o++; $topParent=$o;
echo " ($topParent,1,1,'" . "Datorer &amp; TV-spel" .$m.$o.$e; $o++;
  	$o = getSubCats($m,$o--,$e, "Stationära datorer,Bärbara datorer,Surfplattor,Datortillbehör &amp; program,PC-spel &amp; onlinespel,TV-spel,Övrigt");
echo " ($topParent,1,1,'" . "Ljud &amp; bild" .$m.$o.$e; $o++;
  	$o = getSubCats($m,$o--,$e, "Filmer &amp; musik,Foto- &amp; videokameror,MP-spelare,Stereo &amp; surround,Video- &amp; DVD-spelare,TV &amp; projektor,Övrigt");
echo " ($topParent,1,1,'" . "Telefoner &amp; tillbehör" .$m.$o.$e; $o++;
  	$o = getSubCats($m,$o--,$e, "Telefoner,Tillbehör");

echo $st. "FRITID &amp; HOBBY" .$m.$o.$e; $o++; $topParent=$o;
echo " ($topParent,1,1,'" . "Biljetter" .$m.$o.$e; $o++;
  	$o = getSubCats($m,$o--,$e, "Konsert,Teater &amp; show,Presentkort,Sport,Övrigt");
echo " ($topParent,1,1,'" . "Resor" .$m.$o.$e; $o++;
  	$o = getSubCats($m,$o--,$e, "Tåg,Charter- &amp; paketresor,Övriga resor");
echo " ($topParent,1,1,'" . "Böcker &amp; studentlitteratur" .$m.$o.$e; $o++;
echo " ($topParent,1,1,'" . "Cyklar" .$m.$o.$e; $o++;
  	$o = getSubCats($m,$o--,$e, "Dam,Herr,Barn,Mountainbike,Racer,Övriga cyklar,Tillbehör");
echo " ($topParent,1,1,'" . "Djur" .$m.$o.$e; $o++;
  	$o = getSubCats($m,$o--,$e, "Hund,Katt,Katt- &amp; hundtillbehör,Gnagare &amp; kaniner,Reptil,Fågel,Fisk,Lantbruksdjur,Övriga djur,Tillbehör");
echo " ($topParent,1,1,'" . "Hobby &amp; samlarprylar" .$m.$o.$e; $o++;
  	$o = getSubCats($m,$o--,$e, "Frimärken &amp; mynt,Hobbyfordon,Radiostyrt &amp; modell,Serietidningar,Symaskin &amp; textil,Historiska föremål,Övrigt");
echo " ($topParent,1,1,'" . "Hästar &amp; ridsport" .$m.$o.$e; $o++;
  	$o = getSubCats($m,$o--,$e, "Hästar,Ponnys,Utrustning,Foder &amp; stall,Medryttare &amp; fodervärd,Släp &amp; transport,Övrigt");
echo " ($topParent,1,1,'" . "Jakt &amp; fiske" .$m.$o.$e; $o++;
  	$o = getSubCats($m,$o--,$e, "Jakt,Fiske,Övrigt");
echo " ($topParent,1,1,'" . "Musikutrustning" .$m.$o.$e; $o++;
  	$o = getSubCats($m,$o--,$e, "Gitarr&#47;bas&#47;förstärkare,Piano &amp; klaviatur,Dragspel,Blåsinstrument,Trummor &amp; slagverk,Studio- &amp; scenutrustning,Övrigt");
echo " ($topParent,1,1,'" . "Sport &amp; fritid" .$m.$o.$e; $o++;
  	$o = getSubCats($m,$o--,$e, "Bollsport,Camping &amp; friluftsliv,Dyk- &amp; vattensport,Golf,Träning &amp; hälsa,Vintersport,Övrigt");

echo $st. "AFFÄRSVERKSAMHET" .$m.$o.$e; $o++; $topParent=$o;
echo " ($topParent,1,1,'" . "Affärsöverlåtelser" .$m.$o.$e; $o++;
  	$o = getSubCats($m,$o--,$e, "Butik,Domäner &amp; sajter,Frisörsalong,Restaurang &amp; café,Övrigt");
echo " ($topParent,1,1,'" . "Inventarier &amp; maskiner" .$m.$o.$e; $o++;
  	$o = getSubCats($m,$o--,$e, "Butik &amp; kassa,Frisör- &amp; skönhetssalong,Kontor,Industrimaskiner,Restaurang &amp; café,Varuparti &amp; konkurslager,Övrigt");
echo " ($topParent,1,1,'" . "Lokaler &amp; fastigheter" .$m.$o.$e; $o++; //   0,1,2,3,4  !!!!!!!----------------------
  	$o = getSubCats($m,$o--,$e, "Butiker,Industri &amp; verkstad,Lager &amp; förråd,Kontor,Övrigt");
echo " ($topParent,1,1,'" . "Tjänster" .$m.$o.$e; $o++;
  	$o = getSubCats($m,$o--,$e, "Bil &amp; motor,Catering,Data,Djuravel,Ekonomi,Flytt &amp; transport,Hantverkare,Hundvakt &amp; djurskötsel,Kosmetik &amp; hårvård,Musik &amp; underhållning,Städning,Trädgård &amp; markarbeten,Undervisning");
  	/* --------- */
echo " ($topParent,1,1,'" . "Efterlysningar" .$m.$o.$e; $o++; //  (tyhjä) !!!!-----------------------
echo " ($topParent,1,1,'" . "Övright" .$m.$o.$e; $o++;




function getSubCats($m, $o, $e, $subCats) {
	$subCatsArr = explode(',',$subCats);
	$localOrderId = 0;
	$parentId = $o;
	for($i=0; $i<count($subCatsArr); $i++) {
		echo " (" . $parentId . ",1,1,'" . $subCatsArr[$i] . $m . $localOrderId . $e;
		$localOrderId++;
	}
	$o = (int)$o + (int)count($subCatsArr);
	return $o; 
}

?>