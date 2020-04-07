<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Text cleaner</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta content="Listing of free events and happenings in your city" name="description" />
        <!-- <meta content="xxx" name="author" /> -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- <link rel="shortcut icon" href="../assets/images/favicon.ico">-->
            <script src="https://code.jquery.com/jquery-1.12.4.js"></script> 

<!-- beauter styles -->
<link rel="stylesheet" href="https://rawgit.com/outboxcraft/beauter/master/beauter.min.css">
<!-- custom styles 
<link rel="stylesheet" href="main.css">-->
<style>
    .topnav {
        color: #fff;
        background-color: teal;
    }
    .container {
        background-color: #0ebbbb;
        padding: 30px 20px;
    }
    textarea {
        width: 100%;
        min-height: 150px;
    }
    button {
        background-color: #333;
        color: #fff;
    }
    ul {
        list-style: none;
    }
    a {
        color: #000;
        text-decoration: underline;
    }
    input:hover {
        cursor: pointer;
    }
</style>
<script>
$(document).ready(function(){
/* ===================================================== */
    $("#data").click(function() { 
        var d = document.getElementById("rawData").value;

        d = d.replace(/(?:\r\n|\r|\n)/g, '#');
        var dArr = d.split("#");
                // d = '0. ' + d;
        // var d = $('#rawData').text();
        //alert(d);


        var isTest = '1'; //'1';
        var levelText = ''; 



        var level = '';
        
        var counter = 0;
        var parentId0 = null;
        var parentId1 = null;
        var parentId2 = null;
        var parentId3 = null;
        var countryId = '222'; //'c';  
        var langId = '222'; //'l';
        var orderId0 = 0; 
        var orderId1 = 0; 
        var orderId2 = 0; 
        var orderId3 = 0; 

        var lastParentId1 = null;
        var lastParentId2 = null;
        var lastParentId3 = null;

        var lastLevel = 0;

        var catAdTypes = '';
        var totalAds = '0';

        var lastId = '';
        var dataArr = new Array(500);
        alert('There are ' + dArr.length + ' lines in raw data');
        for(a=0; a < dArr.length; a++) {
            if(dArr[a].substr(0, 1) == ' ')   { level = 1; } // alert('LEVEL 1 FOUND: ' + dArr[a] + '   LAST ID:'+lastId); }
            if(dArr[a].substr(0, 2) == '  ')  { level = 2; } // alert('LEVEL 2 FOUND: ' + dArr[a] + '   LAST ID:'+lastId); }
            if(dArr[a].substr(0, 3) == '   ') { level = 3; } // alert('LEVEL 3 FOUND: ' + dArr[a] + '   LAST ID:'+lastId); }

            /*
Elektronikk og hvitevarer
Data
 Bærbar PC,Datatilbehør,Kalkulatorer,Programvare,Skjermer,Stasjonær PC,Tablet og lesebrett
Foto og video

Elämet
 Koirat
  Mäyräkoira,Ajokoira,Kultainen
 Kissat
  Ragdoll,Siamese
 Jyrsijät
  Päiväjyrsijät
   Marsu,Orava
  Yöjyrsijät
   Siili,Kettu
 Matelijat
  Käärme,Salmanteri
Autot
 Uudet
  Merkki1,Merkki2,Merkki3
 Käytetyt
  Merkki4,Merkki5,Merkki6

            */

            // remove space in beginning
            dArr[a] = dArr[a].trim();
            //if(dArr[a].substr(0, 1) == ' ') { dArr[a] = dArr[a].substr(1, dArr[a].length-1); }

            // INSERT INTO categories (catId,parentId,countryId,langId,name,catDesc,orderId,active) VALUES (1,1,1,'name1',null,1,true),;
            parentId0 = null;
            parentId1 = null;
            parentId2 = null;
            parentId3 = null;

/*

 
 id,parentId,countryId,langId,name,catDesc,orderId,catAdTypes,totalAds,active
(id,parentId,countryId,langId,name,catDesc,orderId,active)
level0 (0,null,c,l,'Elämet',null,0,true),
 level1 (1,0,c,l,'Koirat',null,0,true),
  level2 (2,1,c,l,'Mäyräkoira',null,0,true),
  level2 (3,1,c,l,'Ajokoira',null,1,true),
  level2 (4,1,c,l,'Kultainen',null,2,true),
 level1 (5,4,c,l,'Kissat',null,0,true),
  level2 (6,5,c,l,'Ragdoll',null,0,true),
  level2 (7,5,c,l,'Siamese',null,1,true),
 level1 (8,7,c,l,'Jyrsijät',null,0,true),
  level2 (9,8,c,l,'Päiväjyrsijät',null,0,true),
   level3 (10,9,c,l,'Marsu',null,0,true),
   level3 (11,9,c,l,'Orava',null,1,true),
  level2 (12,11,c,l,'Yöjyrsijät',null,0,true),
   level3 (13,12,c,l,'Siili',null,0,true),
   level3 (14,12,c,l,'Kettu',null,1,true),
 level1 (15,14,c,l,'Matelijat',null,0,true),
  level2 (16,15,c,l,'Käärme',null,0,true),
  level2 (17,15,c,l,'Salmanteri',null,1,true),

*/

            switch(level) {
              case 1:
                parentId1 = lastId;
                lastLevel = 0;
                if(lastLevel > 1) { parentId1 = $("#lastParentId1").val(); } 
                var childCatArr = dArr[a].split(","); // (null,,,'',null,2,true),
                orderId2 = 0;
                //lastParentId1 = parentId1;
                for(c=0; c < childCatArr.length; c++) {
                if(isTest == 1) { levelText = '-  level1 '; }
                dataArr[counter] = '(' + levelText + counter + ',' + parentId1 + ',' + countryId + ',' + langId + ',\''+childCatArr[c]+'\',null,' + c + ',\'\',0,true),'; // catAdTypes totalAds



                  orderId2++;
                  lastId = counter;
                  lastParentId1 = lastId;
                  $("#lastParentId2").val(counter);
                  counter++;
                }
                break;
              case 2:
                parentId2 = lastId;
                lastLevel = 1;
                if(lastLevel > 1) { parentId2 = $("#lastParentId2").val(); } 
                var childCatArr = dArr[a].split(","); // (null,,,'',null,2,true),
                orderId3 = 0;
                for(c=0; c < childCatArr.length; c++) {
                if(isTest == 1) { levelText = '-- level2 '; }
                dataArr[counter] = '(' + levelText + counter + ',' + parentId2 + ',' + countryId + ',' + langId + ',\''+childCatArr[c]+'\',null,' + c + ',\'\',0,true),';
                  orderId3++;
                  lastId = counter;
                  lastParentId2 = lastId;
                  $("#lastParentId3").val(counter);
                  counter++;
                }
                break;
              case 3:
                parentId3 = lastId;
                lastLevel = 2;
                var childCatArr = dArr[a].split(","); // (null,,,'',null,2,true),
                orderId4 = 0;
                for(c=0; c < childCatArr.length; c++) {
                if(isTest == 1) { levelText = '---level3 '; }
                dataArr[counter] = '(' + levelText + counter + ',' + parentId3 + ',' + countryId + ',' + langId + ',\''+childCatArr[c]+'\',null,' + c + ',\'\',0,true),';
                  orderId4++;
                  lastId = counter;
                  counter++;
                }
                break;
              default: // level 0
                if(isTest == 1) { levelText = '   level0 '; }
                dataArr[counter] = '(' + levelText + counter + ',null,' + countryId + ',' + langId + ',\''+dArr[a]+'\',null,' + orderId0 + ',\'\',0,true),';
                orderId0++;
                lastId = counter;
                $("#lastParentId1").val(counter);
                counter++;
                break;
            }




            if(parentId1 == null) { /*
              dataArr[counter] = 'level0 (' + parentId1 + ',' + countryId + ',' + langId + ',\''+dArr[a]+'\',null,' + orderId1 + ',true),';
              orderId1++;
              counter++; */
            } else {
              // iterate children cats 
              /* var childCatArr = dArr[a].split(";"); // (null,,,'',null,2,true),
              orderId2 = 0;
              for(c=0; c < childCatArr.length; c++) {
                dataArr[counter] = 'level1 (' + parentId1 + ',' + countryId + ',' + langId + ',\''+childCatArr[c]+'\',null,' + orderId2 + ',true),';
                orderId2++;
                counter++;
              } */
            }
            //lastId = a;
        }
        // put results to textarea
        //document.getElementById("rawData").value = res;
        
        // hide textarea and button
        ////$("#rawData").css("display","none");
        //$("#lynda").css("display","none");


        document.getElementById("rawData").value ='(catId,parentId,countryId,langId,name,catDesc,orderId,catAdTypes,totalAds,active)\n' + dataArr.join('\n');

        ////$("#result").html(res2);
        //$("#result").html(res2Arr.join(""));


        // generate link page
        // res3
        // put link page data in textarea
        //document.getElementById("rawData").value = res3;

    }); // convert clicked

    /*

Antikviteter og kunst
 Andre antikviteter;Antikke møbler;Keramikk, porselen og glass;Kunst;Sølvtøy og bestikk
Dyr og utstyr
 Akvarier;Andre dyr;Annet dyreutstyr;Bur;Fisker;Fôrverter, avl og stallplasser;Fugler;Hester;Heste- og rideutstyr;Hunder;Hundeutstyr;Katter;Katteutstyr


    */


    /* ================= functions ================== */
    function isLetter(str) {
        return str.length === 1 && str.match(/[a-z]/i);
    }
/* ===================================================== */
}); // doc ready
</script>
</head>
<body>
<div class="container">
<ul class="topnav" id="myTopnav2">
  <li>
    <a href="#" class="brand">Text cleaner</a>
  </li>
</ul>
</div>

<div class="container">
            <div class="row _noPadding">
    <h3>Takes list of categories in multiple levels and creates BD insert rows</h3>
    <p>Example:<br>
      cat1<br>
       cat1A;cat2B<br>
    </p>
<textarea id="rawData"></textarea><br>
<button id="data">Convert</button>
<br>
<div id="result"></div>


<br><br><hr><br>
1:<label id="lastParentId1" type="text"><br>
2:<label id="lastParentId2" type="text"><br>
3:<label id="lastParentId3" type="text"><br>




<?php
/*
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

// ======================== norja =======================================
https://www.finn.no/bap/forsale/search.html?category=0.93
Kategori

Antikviteter og kunst
 Andre antikviteter;Antikke møbler;Keramikk, porselen og glass;Kunst;Sølvtøy og bestikk
Dyr og utstyr
 Akvarier;Andre dyr;Annet dyreutstyr;Bur;Fisker;Fôrverter, avl og stallplasser;Fugler;Hester;Heste- og rideutstyr;Hunder;Hundeutstyr;Katter;Katteutstyr

Elektronikk og hvitevarer
 Data
  Bærbar PC;Datatilbehør;Kalkulatorer;Programvare;Skjermer;Stasjonær PC;Tablet og lesebrett
 Foto og video
  Annet fotoutstyr;Fotovesker og -bager;Hybridkamera;Kompaktkameraer;Objektiver;Systemkameraer;Videokameraer
 Husholdningsapparater
  Andre apparater;Blender;Brødriste;Kaffemaskin;Kjøkkenmaskin og foodprosessor;Miksere;Strykejern;Støvsuger;Vaffel- og toastjern;Vannkoker
 Hvitevarer
  Andre hvitevarer;Frysere;Innbyggingsovner;Kjøleskap;Komfyrer;Mikrobølgeovner;Oppvaskmaskiner;Platetopper;Tørketromler;Vaskemaskiner;Ventilatorer
 Lyd og bilde
  Bluray-spillere;Digital-TV og mediabokser;DVD-spillere;Forsterkere og receivere;Hjemmekinoanlegg;Hodetelefoner;Høyttalere;Kabler og tilbehør;MP3 og bærbar lyd;PA-utstyr;Projektor og lerret;Radio;Stereo;TV;Videospillere
 Spill og konsoll
  Spill;Spillkonsoller;Tilbehør
 Telefoner og tilbehør
  Andre telefoner;Mobiltelefoner;Telefontilbehør
 Annet

Foreldre og barn
 Barneklær
  Baby;Gutt;Jente;Unisex
 Barnemøbler
  Bord;Oppbevaring;Senger;Stellebord;Stoler;Annet
 Barneseter
 Barnesko
  Baby;Gutt;Jente;Unisex 
 Barnevogner
 Leker
  Andre leker;Babyleker;Bamser, dukker og figurer;Biler og baner;Lego og byggeklosser;Tegne- og formingsutstyr;Uteleker
 Mammaklær
 Utstyr og sikkerhet
 Annet

Fritid, hobby og underholdning
 Billetter og reiser
  Flybilletter;Idrettsarrangementer;Konsertbilletter;Pakkereiser;Teaterbilletter;Togbilletter;Annet
 Brettspill og bordspill
  Andre spill;Bordspill;Brettspill;Hage- og parkspill;Puslespill
 Bøker og blader
  Blader og magasiner;Faglitteratur;Fakta og dokumentar;Kokebøker;Oppslagsverk;Skjønnlitteratur;Tegneserier;Øvrige bøker og verk
 Håndarbeid
  Garn;Keramikk;Maling og maleutstyr;Perler og smykkestener;Scrapbooking;Stoff;Symaskiner;Sy- og strikkeutstyr;Tresløyd;Vev
 Mat og drikke
 Modellbyggesett og modeller
 Musikkinstrumenter
  Andre strengeinstrumenter;Bassgitarer;Gitarer;Keyboard/synth;Lydutstyr;Messinginstrumenter;Orgler;Piano/flygel;Slagverk;Strykeinstrumenter;Treblåsere;Trekkspill;Øvrige instrumenter
 Musikk og film
  Blu-ray;CD;DVD;Kassetter;LP/EP;VHS
 RC-utstyr
  Bil;Båt;Drone;Fly;Helikopter;Modelljernbaner
 Samleobjekter
  Andre samlinger;Frimerker;Leker;Militæreffekter;Mynter og sedler;Pins;Postkort;Samlefigurer;Samlekort;Skilt og plakater
 Annet

Hage, oppussing og hus
 Alarm og sikkerhet
 Baderomsinnredning
  Badekar;Baderomsmøbler;Badstuer;Blandebatterier;Dusjkabinett og -vegger;Servanter;Steamdusje;Tilbehør;Toaletter
 Byggevarer og oppussing
  Andre byggevarer;Byggesett;Dører;Gulv;Tapet og maling;Trapper;Vinduer
 Garasje
 Hage og uteområder
  Annet hageutstyr;Beplantning og tilbehør;Gressklippere;Grill;Hagemøbler;Hageredskap;Markiser og parasoller;Partytelt;Snørydding;Svømmebasseng og spabad;
 Hytteutstyr
 Kjøkkeninnredning
 Oppvarming og ventilasjon
  Aircondition og vifter;Elektriske ovner;Ovner;Peis;Varmepumper;Ved og brensel
 Verktøy
 Annet

Klær, kosmetikk og tilbehør
 Briller og linser
  Briller;Linser;Solbriller
 Dameklær
  Brudekjoler;Bukser;Bunader;Gensere;Jakker;Kjoler;Luer, skjerf og votter;Skjorter;Skjørt;Topper;T-skjorter;Undertøy;Ytterklær;Annet
 Herreklær
  Bukser;Bunader;Dresser;Gensere;Luer, skjerf og votter;Skjorter;Smokinger;T-skjorter;Undertøy;Ytterklær;Annet
 Hud-, hår- og kroppspleie
 Klokker og ur
 Kosmetikk
 Kostyme
 Sko
  Damesko;Herresko
 Smykker og oppbevaring
  Andre smykker;Armbånd;Halskjeder;Ringer;Smykkeskrin og oppbevaring;Ørepynt
 Vesker og bager
 Annet

Møbler og interiør
 Belysning
  Andre lamper;Bordlamper;Stålamper;Taklamper;Vegglamper
 Bord og stoler
  Andre bord og stoler;Kjøkkenbord;Kontorstoler;Salongbord;Skrivebord;Spisestuer;Stoler og krakker
 Dekorasjon og pyntegjenstander
  Andre pyntgjenstander;Bilder og rammer;Fat;Lysestaker;Speil;Vaser
 Garderobe og skap
  Garderober;Seksjoner;Skap
 Hyller og kommoder
  Hyller;Kommoder;Nattbord;Skjenk;TV-møbler
 Kjøkkenutstyr og serviser
 Senger og madrasser
  Madrasser;Rammemadrasser;Senger
 Sofaer og lenestoler
  Hjørnesofaer;Lenestoler;Puffer;Sofagrupper;Sovesofaer;2-seter;3-seter
 Tepper og tekstiler
  Andre tekstiler;Duker;Gardiner;Puter;Tepper
 Annet

Næringsvirksomhet
 Butikk og varehandel
  Annet butikkutstyr;Betalingsutstyr;Butikkbelysning;Butikkinnredning;Lagerutstyr;Sikkerhet og overvåkning;Vareparti og konkursbo
 Container og brakker
  Annet anleggsutstyr;Brakker;Containere;Mannskapsvogner
 Helse og behandling
  Annet utstyr;Førstehjelpsutstyr;Hjelpemidler;Hud- og kroppspleie;Utstyr og inventar
 Kontorutstyr og innredning
  Innredning;Kopimaskiner;Printere;Rekvisita
 Landbruk
 Last og transport
 Maskinutstyr og reservedeler
 Resirkulering og returavfall
 Scene
 Storkjøkken og restaurant
  Annet utstyr;Innredning;Kjøkkenutstyr;Kjøl og frys;Koke- og stekeprodukter;Oppvask
 Verksted, bygg og anlegg
  Annet utstyr;Byggtørkere;Kompressor;Lagerhall;Lys;Maskiner og utstyr;Maskinutleie;Stillas og reoler;Treforedling;Verkstedsutstyr;Verktøy
 Webdomener og gullnummer
 Annet

Sport og friluftsliv
 Annen sport
 Ballsport
  Annen ballsport;Bandy;Basketball;Fotball;Håndball;Tennis;Volleyball
 Ekstremsport
  Fallskjermhopping;Kiting;Klatring;Skate- og longboard
 Golf
 GPS og pulsklokker
 Jakt, fiske og friluftsliv
  Annet fiskeutstyr;Annet jaktutstyr;Annet turutstyr;Fiskeklær;Fiskestenger;Jaktklær;Kano;Kikkerter og optikk;Ryggsekker;Sneller, fluer og kroker;Soveposer;Teiner og garn;Telt;Våpen
 Kosttilskudd
 Skisport
  Alpint;Annet skiutstyr;Langrenn;Snowboard;Telemark
 Skøytesport
  Skøyter til barn;Skøyter til voksne;Skøyteutstyr
 Sportsklær og sko
  Barneklær;Dameklær;Herreklær;Sko;Unisex
 Sportsskyting
  Luftvåpen;Paintball;Pistol;Softgun
 Startnummer
 Supporterutstyr
 Sykkelsport
  Sykler;Utstyr
 Treningsapparater og -utstyr
  Ellipsemaskiner;Romaskiner;Stepmaskiner;Styrkeapparater;Tredemøller;Treningssykler;Treningsutstyr
 Vannsport
  Annet utstyr;Dykking;Padling;Seiling;Surfing;Windsurf

Utstyr til bil, båt og MC
 ATV-deler
 Bildeler
  Annet biltilbehør;Bildeler;Bilseter;Bilstereo;Dekk og felger;GPS;Styling;Takstativ og boks
 Båtdeler
  Annet båtutstyr;Elektronikk;Fortøyningsutstyr;Interiør og eksteriør;Motordeler;Navigasjon;Seilbåtutstyr;Sikkerhet;Strøm og VVS;Styring og vinsj
 Caravandeler
 MC-deler
  MC-deler;MC-klær;MC-tilbehør
 Tilhengere
  ATV- og MC-hengere;Biltransporthengere;Båt- og opplagshengere;Hestehengere;Maskinhengere;Skaphengere;Termohengere;Tilhengertilbehør;Tipphengere;Varehengere
 Annet


// ======================== ranska =======================================
https://www.leboncoin.fr/annonces/offres/centre/

EMPLOI
Offres d'emploi

VEHICULES
Voitures
Motos
Caravaning
Utilitaires
Equipement Auto
Equipement Moto
Equipement Caravaning
Nautisme
Equipement Nautisme
IMMOBILIER
Ventes immobilières
Locations
Colocations
Bureaux & Commerces

VACANCES
Locations & Gîtes
Chambres d'hôtes
Campings
Hôtels
Hébergements insolites

MAISON
Ameublement
Electroménager
Arts de la table
Décoration
Linge de maison
Bricolage
Jardinage
Vêtements
Chaussures
Accessoires & Bagagerie
Montres & Bijoux
Equipement bébé
Vêtements bébé
MULTIMEDIA
Informatique
Consoles & Jeux vidéo
Image & Son
Téléphonie

LOISIRS
DVD / Films
CD / Musique
Livres
Animaux
Vélos
Sports & Hobbies
Instruments de musique
Collection
Jeux & Jouets
Vins & Gastronomie

MATERIEL PROFESSIONNEL
Matériel Agricole
Transport - Manutention
BTP - Chantier Gros-oeuvre
Outillage - Matériaux 2nd-oeuvre
Équipements Industriels
Restauration - Hôtellerie
Fournitures de Bureau
Commerces & Marchés
Matériel Médical
SERVICES
Prestations de services
Billetterie
Evénements
Cours particuliers
Covoiturage
AUTRES
Autres



*/

function getSubCats($m, $o, $e, $subCats) {
	$subCatsArr = explode(',',$subCats);
	$localOrderId = 0;
	$parentId = $o;
	for($i=0; $i<count($subCatsArr); $i++) {
		echo " (" . $parentId . ",1,1,'" . $subCatsArr[$i] . $m . $localOrderId . $e; // toimiva
		$localOrderId++;
	}
	$o = (int)$o + (int)count($subCatsArr);
	return $o; 
}
?>