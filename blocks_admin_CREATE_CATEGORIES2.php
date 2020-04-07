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





========================================0


Kaikki osastot
ASUNNOT
Asunnot
Loma-asunnot
Tontit ja maatilat
Toimistotilat

AJONEUVOT
Autot
Tarvikkeet ja varaosat
 Autostereot ja tarvikkeet,Autovaraosat,Kattotelineet ja boksit,Peräkärryt ja trailerit,Renkaat ja vanteet,Muut autotarvikkeet
Matkailuajoneuvot
 Matkailuautot,Asuntovaunut
Matkailuautojen tarvikkeet
Moto
 Moottoripyörät,Mopot,Mopoautot,Moottorikelkat,Mönkijät,Skootterit,Muut motot
Moto tarvikkeet ja varaosat
 Ajoasut&comma; kengät ja kypärät,Renkaat,Muut mototarvikkeet
Työkoneet ja kalusto
 Kuljetuskalusto,Työkoneet,Metsä ja maatalouskoneet,Maanrakennuskoneet,Muut koneet ja tarvikkeet
Veneet
 Purjeveneet,Moottoriveneet,Kumiveneet,Soutuveneet ja jollat,Kanootit ja kajakit,Vesiskootterit,Muut veneet
Venetarvikkeet ja veneily
 XXXXXXXXXXXXXXXX puuttuuko tämä?
KOTI JA ASUMINEN
Kodinkoneet
 Tiskikoneet,Jääkaapit ja pakastimet,Uunit&comma; hellat ja mikrot,Pesu- ja kuivauskoneet,Pölynimurit ja siivousvälineet,Muut kodinkoneet
Keittiötarvikkeet ja astiat
 Kahvikupit, mukit ja lasit,Ruokailuastiat ja aterimet,Tarjoiluastiat,Keittiövälineet,Säilytysastiat ja rasiat,Muut keittiötarvikkeet
Sisustus ja huonekalut
 Antiikki ja taide,Hyllyt ja säilytys,Matot ja tekstiilit,Pöydät ja tuolit,Sohvat ja nojatuolit,Sängyt ja makuuhuone,Valaisimet,Taulut,Sisustustavarat,Muu sisustus
Piha ja puutarha
 Pihakalusteet ja grillit,Leikkurit ja koneet,Kasvit ja siemenet,Ruukut, kivet ja koristeet,Muu piha ja puutarha
Vaatteet ja kengät
 Farkut,Hameet&comma; mekot ja tunikat,Housut ja shortsit,Hääpuvut,Kengät,Muut,Neuleet ja neuletakit,Paidat,Puvut ja bleiserit,Takit ja päällysvaatteet,Topit,Ulkoiluvaatteet,Ulkovaatteet,Äitiysvaatteet
Asusteet ja kellot
 Kellot ja korut,Laukut ja hatut,Muut asusteet
Lastenvaatteet
 50/56 (0-2 kuukautta),62/68 (2-6 kuukautta),74/80 (6-12 kuukautta),86/92 (1-2 vuotta),98/104 (2-4 vuotta),110/116 (4-6 vuotta),122/128 (6-8 vuotta),134/140 (8-10 vuotta),146/152 (10-12 vuotta),158/164 (12-14 vuotta),170/174 (14-16 vuotta),Yksi koko
Lastenkengät
 -19,20-21,22-23,24-25,26-27,28-29,30-31,32-33,34-35,36 +,Yksi koko
Lastentarvikkeet ja lelut
 Turvaistuimet ja kaukalot,Tuolit&comma; sängyt ja kalusteet,Rattaat ja vaunut,Lelut ja pelit,Lastenhoitovälineet,Muut lastentarvikkeet
Rakennustarvikkeet ja työkalut
 Kylpyhuoneet&comma; WC:t ja saunat,Sähkötarvikkeet,Työkalut&comma; tikkaat ja laitteet,Lämmityslaitteet ja takat,Keittiöt,Eristys ja katot,LVI ja putket,Ikkunat&comma; ovet ja lattiat,Muu rakentaminen ja remontointi

VAPAA-AIKA JA HARRASTUKSET
Urheilu ja ulkoilu
 Jääkiekko ja luistelu,Hiihto ja laskettelu,Jalkapallo,Rullaluistelu ja skeittaus,Kamppailulajit,Uinti ja sukellus,Juoksu ja lenkkeily,Golf,Kuntoilu ja fitness,Pallopelit,Ulkoilu ja retkeily,Muu urheilu ja ulkoilu
Polkupyörät ja pyöräily
 KilpapyörätMaastopyörät,Lasten pyörät,Muut pyörät,Pyörätarvikkeet ja kypärät
Musiikki ja soittimet
 Kitarat&comma; bassot ja vahvistimet,Pianot&comma; urut ja koskettimet,Rummut,Musiikki CD&comma; DVD ja äänitteet,Muu musiikki ja soittimet
Metsästys
Kalastus
Elokuvat
Kirjat ja lehdet
 Harrastekirjat,Kaunokirjallisuus,Lastenkirjat,Sarjakuvat,Oppikirjat,Lehdet,Muut kirjat ja lehdet
Lemmikkieläimet
 Kissat,Koirat,Kalat ja akvaariot,Jyrsijät,Muut eläimet,Kissojen tarvikkeet,Koirien tarvikkeet,Muut eläintarvikkeet
Hevoset ja hevosurheilu
 Satulat ja varusteet,Hevoset ja ponit,Trailerit ja kuljetus,Muut hevostarvikkeet
Matkat ja matkaliput
 Matkat,Risteilyt,Lentoliput,Hotellit,Keikat,Konsertit,Tapahtumat
Keräily
 Astiat,Rahat ja mitalit,Muu keräily
Käsityöt
Kamerat ja valokuvaus
 Kamerat,Objektiivit,Valokuvaustarvikkeet,Muu valokuvaus
Pelit
Muut harrastukset

ELEKTRONIIKKA
Puhelimet
Puhelintarvikkeet
Viihde-elektroniikka
 Televisiot,Digiboksit,Audio ja musiikkilaitteet,Kotiteatterit&comma; kankaat ja projektorit,Pelikonsolit ja pelaaminen,Muu viihde-elektroniikka
Tietokoneet ja lisälaitteet
 Tabletit,Kannettavat,Pöytäkoneet,Oheislaitteet,Komponentit,Verkkotuotteet,Tietokoneohjelmat,Muu tietotekniikka

LIIKETOIMINTA JA TYÖPAIKAT
Avoimet työpaikat
CVt ja työhakemukset
Palvelut
Maatalous
Rakentaminen
Liikkeille ja yrityksille

MUUT
Muut
*/

/*
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

/* ================================================================= */
// INSERT INTO categories (parentId,countryId,langId,name,catDesc,orderId,active) VALUES (1,1,1,'name1',null,1,true);
$table = 'categoriesNEW';


//echo "drop table $table; <br>";
// OLD
//echo "create table $table (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,parentId INT,countryId INT,langId INT,name VARCHAR(50),catDesc VARCHAR(200),orderId INT,active TINYINT UNSIGNED); <br>";
// NEW 1
//echo "create table $table (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,parentId INT,countryId INT,langId INT,name VARCHAR(50),extraId TINYINT,orderId INT,catAdTypes VARCHAR(5),totalAds INT,pricePrivate FLOAT,priceCompany FLOAT,active TINYINT UNSIGNED); <br>";

// NEW 2
echo "create table $table (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,catId INT,parentId INT,countryId INT,langId INT,name VARCHAR(50),extraId TINYINT,orderId INT,catAdTypes VARCHAR(5),totalAds INT,pricePrivate FLOAT,priceCompany FLOAT,active TINYINT UNSIGNED); <br>";

echo "INSERT INTO $table (catId,parentId,countryId,langId,name,extraId,orderId,catAdTypes,totalAds,pricePrivate,priceCompany,active) VALUES ";
//catDesc pois - extraId tilalle
//orderId:n jälkeen lisää:
//catAdTypes,totalAds,pricePrivate,priceCompany,


// NOTE!!!!!!!!!!!! orderId INT !!!!!!!!!! ----------------------- !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
$o = 0; // orderId
$cId = 0; // $cId=$cId+10;
// INSERT INTO categories
//  (null,1,1,'name1',null,1,true);


// HUOM!!!!!!!!!!!
// "ALTER TABLE `categories` ADD UNIQUE(`id`);"
$c = " ("; // $c.$cId.

$s = ",null,1,1,'";
$st = " (-1,1,1,'";
$m = "',null,"; // orderId here
//$e = ",true)," . "<br>"; // OLD
$e = ",null,0,null,null,true)," . "<br>"; // NEW

// NEW
// $st. "BOSTAD &gt;" .$m.$o.$e; $o++;

// s = (parentId,countryId,langId,
//name
// m = extraId,orderId,
// e = catAdTypes,totalAds,pricePrivate,priceCompany,active) VALUES ";
//catDesc pois - extraId tilalle
//orderId:n jälkeen lisää:
//catAdTypes,totalAds,pricePrivate,priceCompany,






// for subcategories
//  $s. --> " (" . ((int)$o)-1 . ",1,1,'"


// echo $s. "Alla kategorier" .$m.$o.$e; $o++;  // add elsewhere in code!!
/*

echo $st. "FRITID &amp; HOBBY" .$m.$o.$e; $o++;
echo $s. "Biljetter" .$m.$o.$e; $o++;
    $o = getSubCats($m,$o--,$e, "Konsert,Teater &amp; show,Presentkort,Sport,Övrigt");
echo $s. "Resor" .$m.$o.$e; $o++;

*/
echo $st. "BOSTAD &gt;" .$m.$o.$e; $o=$o+50;
/* XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX HUOM! SUOMEKSI!!!*/
echo $s. "Asunto" .$m.$o.$e; $o=$o+50;
  $o = getSubCats($m,$o--,$e, "Kerrostalo,Rivitalo,Omakotitalo,Vapaa-ajan asunto,Erillistalo,Paritalo,Luhtitalo,Puutalo-osake,Muu");
echo $s. "Loma-asunto" .$m.$o.$e; $o=$o+50;
  $o = getSubCats($m,$o--,$e, "Mökki tai huvila,Lomaosake,Lomahuoneisto");
echo $s. "Tontti" .$m.$o.$e; $o=$o+50;
  $o = getSubCats($m,$o--,$e, "Omakotitalotontti,Vapaa-ajan tontti,Rivitalotontti,Muu tontti");
echo $s. "Toimitila" .$m.$o.$e; $o=$o+50;
  $o = getSubCats($m,$o--,$e, "Liiketila,Tuotantotila,Toimistotila,Varastotila,Ravintolatila,Näyttelytila,Harrastustila,Hub-tila,Muu tila");
echo $s. "Maa- tai metsätila" .$m.$o.$e; $o=$o+50;
  $o = getSubCats($m,$o--,$e, "Maatila,Metsätila");
echo $s. "Autotalli" .$m.$o.$e; $o=$o+50;
  $o = getSubCats($m,$o--,$e, "Autopaikka,Katettu autopaikka,Autotalli,Lämmitetty autotalli");

echo $st. "JOBB &gt;" .$m.$o.$e; $o=$o+50; 
  $o = getSubCats($m,$o--,$e, "Administration,Bygg/Anläggning/Infrastruktur,Data/IT,Drift/Underhåll,Ekonomi/Finans,Försäljning/Affärsutveckling,Försvar/Säkerhet/Räddningstjänst,Forskning/R&D/Vetenskap,HR/Personal,Hotell/Restaurang/Turism/Nöje,Juridik/Rättsvetenskap,Kreativitet/Design,Kundsupport/Service,Kvalitetssäkring,Ledning/Management,Logistik/Transport,Marknad/Produkt,Projektledning,Sjukvård/Hälsa,Skribenter/publishing,Teknik/Ingenjörstjänster,Tillverkning/Produktion,Utbildning");






echo $st. "FORDON" .$m.$o.$e; $o=$o+50;
echo $s. "Bilar" .$m.$o.$e; $o=$o+50;
	$o = getSubCats($m,$o--,$e, "AlfaRomeo,AstonMartin,Audi,Austin,Bentley,BMW,Buick,Cadillac,Chevrolet,Chrysler,Citro&euml;n,Dacia,Daewoo,Dodge,Ferrari,Fiat,Ford,GMC,Honda,Hummer,Hyundai,Infiniti,Isuzu,Iveco,Jaguar,Jeep,Kia,Lada,Lamborghini,Lancia,LandRover,Lexus,Lincoln,Lotus,Maserati,Mazda,McLaren,Mercedes-Benz,Mercury,Mini,Mitsubishi,Nissan,Oldsmobile,Opel,Peugeot,Plymouth,Pontiac,Porsche,Renault,Rolls-Royce,Rover&#47;BMC,Saab,SEAT,Skoda,Smart,SsangYong,Subaru,Suzuki,Tesla,Toyota,Volkswagen,Volvo");
 
// Småbil,Sedan,Halvkombi,Kombi,Coup&eacute;,Cab,SUV,Familjebuss,Yrkesfordon (extra)
// Vit,Grå&#47;Silver,Brun,Svart,Röd&#47;Orange,Gul,Grön,Blå&#47;Lila (extra)


echo $s. "Bildelar &amp; biltillbehör" .$m.$o.$e; $o=$o+50;
	$o = getSubCats($m,$o--,$e, "Bilstereo,Däck &amp; fälg,GPS,Reservdelar,Släp,Takboxar &amp; takräcken,Övrigt");
echo $s. "Båtar" .$m.$o.$e; $o=$o+50; //  0,1,3  !!!!------------
 	$o = getSubCats($m,$o--,$e, "Motorbåt,Segelbåt,Gummi&#47;ribbåt,Jolle&#47;roddbåt,Kajak&#47;kanot,Vattenskoter,Övrigt");
echo $s. "Båtdelar &amp; tillbehör" .$m.$o.$e; $o=$o+50;
 	$o = getSubCats($m,$o--,$e, "Motor &amp; propeller,GPS &amp; navigering,Båtplats &amp; förvaring,Trailer,Övrigt");
echo $s. "Husvagnar &amp; husbilar" .$m.$o.$e; $o=$o+50; // 0,1,3 !!!! -------------------
 	$o = getSubCats($m,$o--,$e, "Husvagn,Husbil,Tillbehör");
echo $s. "Mopeder &amp; A-traktor" .$m.$o.$e; $o=$o+50;
 	$o = getSubCats($m,$o--,$e, "Mopeder,A-Traktorer,Tillbehör");
echo $s. "Motorcyklar" .$m.$o.$e; $o=$o+50;
 	$o = getSubCats($m,$o--,$e, "Cross&#47;enduro,Custom,Fyrhjuling&#47;ATV,Offroad,Scooter,Sport,Touring,Övrigt");
echo $s. "MC-delar &amp; tillbehör" .$m.$o.$e; $o=$o+50;
 	$o = getSubCats($m,$o--,$e, "Däck &amp; fälg,Reservdelar,Hjälm&#47;skydd&#47;kläder,Övrigt");
//echo $s. "Lastbil, truck &amp; entreprenad" .$m.$o.$e; $o=$o+50;
// 	$o = getSubCats($m,$o--,$e, "Entreprenad­maskiner,Lastbil &amp; buss,Truck &amp; material­hantering");
//echo $s. "Skogs- &amp; lantbruksmaskiner" .$m.$o.$e; $o=$o+50;
//$o = getSubCats($m,$o--,$e, 'Grönyte­maskiner,Lantbruks­maskiner,Skogs­maskiner');
echo $s. "Snöskotrar" .$m.$o.$e; $o=$o+50;
echo $s. "Snöskoterdelar &amp; tillbehör" .$m.$o.$e; $o=$o+50;
// moved mascus to end
echo $st. "FÖR HEMMET" .$m.$o.$e; $o=$o+50;
echo $s. "Bygg &amp; trädgård" .$m.$o.$e; $o=$o+50;
  	$o = getSubCats($m,$o--,$e, "Badrum&#47;WC&#47;bastu,Byggmaterial,Kamin &amp; värme,Kök,Trädgårds­maskiner,Trädgård &amp; uteplats,Övrigt");
echo $s. "Möbler &amp; heminredning" .$m.$o.$e; $o=$o+50;
  	$o = getSubCats($m,$o--,$e, "Antikt &amp; konst,Belysning,Bord &amp; stolar,Hemtextil &amp; prydnad,Hyllor &amp; förvaring,Mattor,Säng &amp; sovrum,Soffa&#47;fåtölj&#47;soffmöbler,TV- &amp; stereomöbler,Övrigt");
echo $s. "Husgeråd &amp; vitvaror" .$m.$o.$e; $o=$o+50;
  	$o = getSubCats($m,$o--,$e, "Diskmaskin,Kyl &amp; frys,Kökstillbehör &amp; porslin,Spis &amp; micro,Tvättmaskin &amp; torktumlare,Övrigt");
echo $s. "Verktyg" .$m.$o.$e; $o=$o+50;

echo $st. "PERSONLIGT" .$m.$o.$e; $o=$o+50;
echo $s. "Kläder &amp; skor för kvinnor" .$m.$o.$e; $o=$o+50;
 	// Dam &amp; herr,Dam,Herr (radio)
  	//$o = getSubCats($m,$o--,$e, "Brudklänningar,Byxor,Jackor &amp; ytterplagg,Jeans,Kjolar &amp; klänningar,Kostymer &amp; kavajer,Skjortor,Skor,Toppar,Tröjor,Övrigt"); // old
    $o = getSubCats($m,$o--,$e, "Klänningar,Toppar,Skjortor & Blusar,Badkläder,Stickat,Koftor & Jumpers,Hoodies & Sweatshirts,Kavajer & Västar,Jackor & Kappor,Byxor,Jeans,Kjolar,Jumpsuits,Underkläder,Sovplagg,Sportkläder,Shorts,Skor,Accessoarer,Strumpor & Tights,Mammakläder,Övrigt");
echo $s. "Kläder &amp; skor för män" .$m.$o.$e; $o=$o+50;
    $o = getSubCats($m,$o--,$e, "T-shirts & Linnen,Hoodies & Sweatshirts,Byxor,Jeans,Koftor & Tröjor,Ytterplagg,Skjortor,Kavajer & Kostymer,Accessoarer,Skor,Strumpor,Underkläder & Sovplagg,Shorts,Badkläder,Sportkläder,Övrigt");


echo $s. "Accessoarer &amp; klockor" .$m.$o.$e; $o=$o+50;
  	$o = getSubCats($m,$o--,$e, "Klockor,Smycken,Väskor,Övrigt");
echo $s. "Barnkläder &amp; skor" .$m.$o.$e; $o=$o+50;
 	//Flicka &amp; pojke,Flicka,Pojke,Unisex (radio)
  	$o = getSubCats($m,$o--,$e, "Kläder,Skor");
echo $s. "Barnartiklar &amp; leksaker" .$m.$o.$e; $o=$o+50;
  	$o = getSubCats($m,$o--,$e, "Barnmöbler,Barnvagnar &amp; tillbehör,Bilbarnstolar,Leksaker,Övrigt");

echo $st. "ELEKTRONIK" .$m.$o.$e; $o=$o+50;
//echo $s. "Datorer &amp; TV-spel" .$m.$o.$e; $o=$o+50;
//  	$o = getSubCats($m,$o--,$e, "Stationära datorer,Bärbara datorer,Surfplattor,Datortillbehör &amp; program,PC-spel &amp; onlinespel,TV-spel,Övrigt");
echo $s. "Datorer" .$m.$o.$e; $o=$o+50;
$o = getSubCats($m,$o--,$e, "Stationära datorer,Bärbara datorer,Surfplattor,Datortillbehör &amp; program,Övrigt");

echo $s. "Spel" .$m.$o.$e; $o=$o+50;
    $o = getSubCats($m,$o--,$e, "Action,Barnspel,Dansspel,Familjespel,Fighting,First person shooter,Musik,Nyttoprogram,Onlinespel,Partyspel,Pistolspel,Plattform,Pusselspel,Racing,Retro,Rollspel,Simulation,Sport,Strategi,Träning,Utbildning,Äventyr,Övrigt");



// OLD
//echo $s. "Ljud &amp; bild" .$m.$o.$e; $o=$o+50;
//  	$o = getSubCats($m,$o--,$e, "Filmer &amp; musik,Foto- &amp; videokameror,MP-spelare,Stereo &amp; surround,Video- &amp; DVD-spelare,TV &amp; projektor,Övrigt");
// NEW
echo $s. "Filmer &amp; TV-serier" .$m.$o.$e; $o=$o+50;
    $o = getSubCats($m,$o--,$e, "Anime,Action,Dokumentär,Drama,Familj & Barn,Filmboxar,Import,Komedi,Rysare,Science Fiction,Svenskt,Tecknat & Animerat,Thriller,Tv-serier,Western,Äventyr & Fantasy,Övrigt");
echo $s. "Musik" .$m.$o.$e; $o=$o+50;
    $o = getSubCats($m,$o--,$e, "Pop & Rock,Hårdrock,Svenskt,Dansband,Filmmusik,Barn,Reggae,Samlingar,Country,Jazz & Blues,Klassiskt,Soul & R&B,Hip Hop,Trance & Dance,Julmusik,Övrigt");
// Foto- &amp; videokameror


//echo $s. "Telefoner &amp; tillbehör" .$m.$o.$e; $o=$o+50;
//  	$o = getSubCats($m,$o--,$e, "Telefoner,Tillbehör");
echo $s. "Telefoner" .$m.$o.$e; $o=$o+50;
    $o = getSubCats($m,$o--,$e, "Apple,Huawei,Doogee,Oukitel,Asus,Cubot,Ulefone,Samsung,Umidigi,Blackview,OnePlus,Nokia");
echo $s. "Telefon tillbehör" .$m.$o.$e; $o=$o+50;
    $o = getSubCats($m,$o--,$e, "Mobilskal,Skärmskydd,Laddare,Kablar,Mobiltillbehör,Smartwatches,Träningsklockor,GPS & Navigation,Fast Telefoni,Övrigt");

echo $st. "FRITID &amp; HOBBY" .$m.$o.$e; $o=$o+50;
echo $s. "Biljetter" .$m.$o.$e; $o=$o+50;
  	$o = getSubCats($m,$o--,$e, "Konsert,Teater &amp; show,Presentkort,Sport,Övrigt");
echo $s. "Resor" .$m.$o.$e; $o=$o+50;
  	$o = getSubCats($m,$o--,$e, "Tåg,Charter- &amp; paketresor,Övriga resor");
echo $s. "Böcker &amp; studentlitteratur" .$m.$o.$e; $o=$o+50;
    $o = getSubCats($m,$o--,$e, "Almanackor & kalendrar,Barnböcker,Barn & Familj,Biografier & Sanna Berättelser,Datorer & IT,Deckare & Thrillers,Djur & Natur,Ekonomi & Marknadsföring,Fantasy & Science Fiction,Film & Musik,Geografi & Resor,Historia & Arkeologi,Hobby & Fritid,Hus & Hem,Juridik,Kultur,Kurslitteratur,Mat & Dryck,Naturvetenskap & Teknik,Psykologi & Pedagogik,Religion & Filosofi,Registerflikar,Samhälle & Politik,Serier & Humor,Sex & Erotik,Skönlitteratur,Språk & Uppslagsverk,Träning & Hälsa,Unga vuxna,Övrigt");

echo $s. "Cyklar" .$m.$o.$e; $o=$o+50;
  	$o = getSubCats($m,$o--,$e, "Dam,Herr,Barn,Mountainbike,Racer,Övriga cyklar,Tillbehör");

// NEW
echo $st. "DJUR" .$m.$o.$e; $o=$o+50;
echo $s. "Hund" .$m.$o.$e; $o=$o+50;
  $o = getSubCats($m,$o--,$e, "Labrador retriever,Tysk schäferhund,Golden retriever,Jämthund,Shetland sheepdog,Cocker spaniel,Bichon havanais,Staffordshire bullterrier,Chihuahua,Fransk bulldogg,Drever,Finsk lapphund,Border collie,Dansk-svensk gårdshund,Flatcoated retriever,Cavalier king charles spaniel,Mops,Rottweiler,Tax,Engelsk springer spaniel");
echo $s. "Katt" .$m.$o.$e; $o=$o+50;
  $o = getSubCats($m,$o--,$e, "Maine coon,Ragdoll,Sibirisk katt,Norsk skogkatt,Benga,Devon rex,Brittisk korthår,Cornish rex,Helig birma,Abessinier,Perser");

echo $s. "Gnagare &amp; kaniner" .$m.$o.$e; $o=$o+5;
echo $s. "Reptil" .$m.$o.$e; $o=$o+5;
echo $s. "Fågel" .$m.$o.$e; $o=$o+5;
echo $s. "Fisk" .$m.$o.$e; $o=$o+5;
echo $s. "Lantbruksdjur" .$m.$o.$e; $o=$o+5;
echo $s. "Övriga djur" .$m.$o.$e; $o=$o+5;
echo $s. "Katt- &amp; hundtillbehör" .$m.$o.$e; $o=$o+5;
echo $s. "Tillbehör" .$m.$o.$e; $o=$o+5;
//  	$o = getSubCats($m,$o--,$e, "Hund,Katt,Katt- &amp; hundtillbehör,Gnagare &amp; kaniner,Reptil,Fågel,Fisk,Lantbruksdjur,Övriga djur,Tillbehör");
/*
hund 20 most popular in sweden

Labrador retriever,Tysk schäferhund,Golden retriever,Jämthund,Shetland sheepdog,Cocker spaniel,Bichon havanais,Staffordshire bullterrier,Chihuahua,Fransk bulldogg,Drever,Finsk lapphund,Border collie,Dansk-svensk gårdshund,Flatcoated retriever,Cavalier king charles spaniel,Mops,Rottweiler,Tax,Engelsk springer spaniel


katt:

Maine coon,Ragdoll,Sibirisk katt,Norsk skogkatt,Benga,Devon rex,Brittisk korthår,Cornish rex,Helig birma,Abessinier,Perser 

*/
echo $s. "Hobby &amp; samlarprylar" .$m.$o.$e; $o=$o+50;
  	$o = getSubCats($m,$o--,$e, "Frimärken &amp; mynt,Hobbyfordon,Radiostyrt &amp; modell,Serietidningar,Symaskin &amp; textil,Historiska föremål,Övrigt");
echo $s. "Hästar &amp; ridsport" .$m.$o.$e; $o=$o+50;
  	$o = getSubCats($m,$o--,$e, "Hästar,Ponnys,Utrustning,Foder &amp; stall,Medryttare &amp; fodervärd,Släp &amp; transport,Övrigt");
echo $s. "Jakt &amp; fiske" .$m.$o.$e; $o=$o+50;
  	$o = getSubCats($m,$o--,$e, "Jakt,Fiske,Övrigt");
echo $s. "Musikutrustning" .$m.$o.$e; $o=$o+50;
  	$o = getSubCats($m,$o--,$e, "Gitarr&#47;bas&#47;förstärkare,Piano &amp; klaviatur,Dragspel,Blåsinstrument,Trummor &amp; slagverk,Studio- &amp; scenutrustning,Övrigt");
echo $s. "Sport &amp; fritid" .$m.$o.$e; $o=$o+50;
  	$o = getSubCats($m,$o--,$e, "Bollsport,Camping &amp; friluftsliv,Dyk- &amp; vattensport,Golf,Träning &amp; hälsa,Vintersport,Övrigt");

echo $st. "AFFÄRSVERKSAMHET" .$m.$o.$e; $o=$o+50;
echo $s. "Affärsöverlåtelser" .$m.$o.$e; $o=$o+50;
  	$o = getSubCats($m,$o--,$e, "Butik,Domäner &amp; sajter,Frisörsalong,Restaurang &amp; café,Övrigt");
echo $s. "Inventarier &amp; maskiner" .$m.$o.$e; $o=$o+50;
  	$o = getSubCats($m,$o--,$e, "Butik &amp; kassa,Frisör- &amp; skönhetssalong,Kontor,Industrimaskiner,Restaurang &amp; café,Varuparti &amp; konkurslager,Övrigt");
echo $s. "Lokaler &amp; fastigheter" .$m.$o.$e; $o=$o+50; //   0,1,2,3,4  !!!!!!!----------------------
  	$o = getSubCats($m,$o--,$e, "Butiker,Industri &amp; verkstad,Lager &amp; förråd,Kontor,Övrigt");
echo $s. "Tjänster" .$m.$o.$e; $o=$o+50;
  	$o = getSubCats($m,$o--,$e, "Bil &amp; motor,Catering,Data,Djuravel,Ekonomi,Flytt &amp; transport,Hantverkare,Hundvakt &amp; djurskötsel,Kosmetik &amp; hårvård,Musik &amp; underhållning,Städning,Trädgård &amp; markarbeten,Undervisning");


// ---------------- MASCUS -------------------
echo $st. "TUNGA MASKINER" .$m.$o.$e; $o=$o+50;
echo $s. "Entreprenad" .$m.$o.$e; $o=$o+50; // 1
  $o = getSubCats($m,$o--,$e, "Grävmaskiner,Lastare,Liftar,Kranar,Återvinning & sortering,Asfalteringsmaskiner,Borrutrustning,Byggmaskiner - Annat,Cementutrustning,Dumprar,Generatorer,Grävlastare,Kompressorutrustning,Marinutrustning,Olja- och gasutrustning,Pålningsutrustning,Redskap och utrustning,Reservdelar,Schaktmaskiner,Teleskoplastare,Utrustning för underjordsbrytning,Vägbyggnadsmaskiner,Vibratorplattor,Övriga");
  
echo $s. "Lantbruk" .$m.$o.$e; $o=$o+50; // 2
  $o = getSubCats($m,$o--,$e, "Traktorer,Vallskörd,Jordbearbetning,Tröskor,Mineral- och stallgödselspridare,Bevattning,Inomgårdsutrustning,Lastning och grävning,Maskiner för sådd och sättning,Maskiner för väg och snö,Olivskördningsutrustning,Potatisodlingsutrustning,Processering och lagring av skörd,Reservdelar,Självgående fälthackar,Terränghjulingar och skotrar,Tillbehör,Vagnar,Växtskyddsprutor,Vinodlings utrustning,Övriga lantbruksmaskiner");
  
echo $s. "Transportfordon" .$m.$o.$e; $o=$o+50; // 3
  $o = getSubCats($m,$o--,$e, "Lastbilar,Lätta last- och skåpbilar < 3&comma;5 ton,Dragbilar,Trailers,Släpvagnar,Brandbilar & andra samhälls service bilar,Bussar,Containrar,Elektriska fordon,Lasthantering,Lösa byggnation,Personbilar,Reservdelar,Terrängfordon,Övriga");
  
echo $s. "Materialhantering" .$m.$o.$e; $o=$o+50; // 4
  $o = getSubCats($m,$o--,$e, "Motviktstruckar,Staplare,Låglyftare,Skjutstativtruck,Specialutrustning,Containertruck,Lagerstädmaskiner,Lagerutrustning,Plocktruckar,Reservdelar,Tillbehör och komponenter,Övriga");
  
echo $s. "Grönytemaskiner" .$m.$o.$e; $o=$o+50; // 5
  $o = getSubCats($m,$o--,$e, "Gräsklippare,Sopmaskiner,Kompakttraktorer,Golf- och sport grönytemaskiner,Redskapsbärare,Häcksaxar,Kompakttraktor-tillbehör,Reservdelar,Strand-rengöringsutrustning,Tvåhjulstraktorer och kultivatorer,Utrustning för högtryckstvätt,Verktygsfraktare,Övriga grönytemaskiner");
  
echo $s. "Skogsmaskiner" .$m.$o.$e; $o=$o+50; // 6
  $o = getSubCats($m,$o--,$e, "Trähantering,Skördare,Skotare,Lunnare,Fällare-läggare,Drivare,Grävmaskiner,Kvistare,Övriga skogsmaskiner,Redskap och utrustning,Reservdelar,Sågverk,Skogstraktorer,Terminal Lastare");


// ---------------- END MASCUS -------------------

echo $s. "Efterlysningar" .$m.$o.$e; $o=$o+50; //  (tyhjä) !!!!-----------------------
echo $s. "Övrigt" .$m.$o.$e; $o=$o+50;




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