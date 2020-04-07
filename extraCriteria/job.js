function show_job_options(selIdsArr,selValsArr,target) {
	var p = 'job_'; // prefix


var category = 'JOB cat';
var type = 'ZZZZZZZZZZZZZZZZZZ';
 	// category
 	var category = createSelect('category',tr[p+'categoryData'],0,0,tr[p+'category'],'',1,'','','',true);
	

 	// type
 	var type = createSelect('type',tr[p+'typeData'],0,0,tr[p+'type'],'',1,'','','',true);
	

	$("#extraSearhCriteriaPanel").html(category + type);
	$("#extraSearhCriteriaPanel").removeClass("hidden");


	if(target == 'index') {
		
	} else {
		// new

	}

}




/*
-------------------------------------------------- job translations ------------------------------------------------------
Source: monster 
fi se no dk de es uk fr 
it nl cz (Czech Republic)
ee  lv lt ru


fi
"job_category" : "Tehtäväalue",
"job_categoryData" : "Asennus&comma; korjaus ja rakennus,Asiakaspalvelu,Hallinto- ja toimistotehtävät,Henkilöstöhallinto ja rekrytointi,IT,Johtotehtävät ja konsultointi,Laki,Logistiikka,Markkinointi,Myynti,Sosiaali- ja terveyspalvelut,Taloushallinto,Tekniikka,Teollisuus ja tuotanto",
"job_type" : "Työsuhteen muoto",
"job_typeData" : "Vakituinen,Määräaikainen,Projekti,Harjoittelija,Kausittainen,Kokopäiväinen,Osa-aikainen,Tuntityö",
"today" : "Tänään",
"yesterday" : "Eilen",

se
"job_category" : "Jobbkategori",
"job_categoryData" : "Administration,Bygg/Anläggning/Infrastruktur,Data/IT,Drift/Underhåll,Ekonomi/Finans,Försäljning/Affärsutveckling,Försvar/Säkerhet/Räddningstjänst,Forskning/R&D/Vetenskap,HR/Personal,Hotell/Restaurang/Turism/Nöje,Juridik/Rättsvetenskap,Kreativitet/Design,Kundsupport/Service,Kvalitetssäkring,Ledning/Management,Logistik/Transport,Marknad/Produkt,Projektledning,Sjukvård/Hälsa,Skribenter/publishing,Teknik/Ingenjörstjänster,Tillverkning/Produktion,Utbildning",
"job_type" : "Jobbtyp",
"job_typeData" : "Tillsvidare,Visstid,Vikariat,Projekt kontrakt,Examensjobb praktik trainee,Säsongsarbete,Heltid,Deltid,Timanställd",
"today" : "Idag",
"yesterday" : "Igår",

no
"job_category" : "Job kategori",
"job_categoryData" : "Administrasjon og kontor,Byggebransjen og håndverkere,Forskning og utvikling,HR og rekruttering,Ingeniør-yrker,Installasjon og reparasjon,IT og programvareutvikling,Juridisk,Kreativ og design,Kundestøtte og -behandling,Ledelse,Logistikk og transport,Markedsføring og produktledelse,Medisin og helse,Olje og energi,Produksjon,Prosjektledelse,Regnskap og finans,Salg og franchise,Serverings- og vertstjenester,Utdanning og opplæring",
"job_type" : "Jobtype",
"job_typeData" : "Fast ansatt,Vikar,Kontrakt,Prosjekt,Trainee Praksis,Sesongarbeid,Heltid,Deltid,Timebasert
"today" : "I dag",
"yesterday" : "I går",


dk
"job_category" : "Job kategori",
"job_categoryData" : "Administration,Byggeri/Håndværk,Detailhandel,Finans/Regnskab,Forskning/Videnskap,Hotel/Restaurang,Ingeniør,Installation/Reparation,IT/Software,Journalistik,Juridik,Kreativ funktion/Design,Kundservice,Kvalitetssikring,Ledelse/Management,Logistik/Transport,Markedsføring,Personale/HR,Produktion/Drift,Projektledelse,Salg,Sikkerhed/Overvågning,Telekommunikation",
"job_type" : "Jobtype",
"job_typeData" : "Fastansat,Tidsbegrænset Projekt,Praktikant,Sæsonarbejde,Fuldtid,Deltid,Timeansat",
"today" : "I dag",
"yesterday" : "I går",

de 
"job_category" : "Berufsfeld",
"job_categoryData" : "Accounting,Administration,Architektur und Design,Ausbildung,Automobil,Bauwesen,Bildung und Soziales,Consulting,Controlling,Dienstleistung,Einkauf,Einzelhandel,Finanzwesen,Forschung,Gastronomie und Tourismus,Gesundheitswesen,Handel und Einzelhandel,Handwerk,Immobilien,Industrie und Produktion,Ingenieurwesen,IT,Kultur,Kundenbetreuung,Landwirtschaft,Logistik,Management,Marketing,Medien,Naturwissenschaft und Forschung,Personalwesen,Produktion,Projektmanagement,Qualitätswesen,Recht,Sachbearbeitung,Sicherheit,Steuerwesen,Technik,Teilzeit,Tourismus,Tourismus und Gastronomie,Transport und Logistik,Umwelt,Versicherung,Vertrieb",
"job_type" : "Vertragsart",
"job_typeData" : "Festanstellung,Freie Mitarbeit,Dienstvertrag,Praktikum,Vollzeit,Teilzeit,Befristet,Student,Berufsausbildung,Diplomarbeit",
"today" : "Heute",
"yesterday" : "Gestern",

es
"job_category" : "Profeción",
"job_categoryData" : "Administración/Oficina,Atención al Cliente y Call Center,Compras&comma; Logística y Distribución,Construcción/Oficios,Contabilidad/Finanzas,Calidad/Seguridad en el Trabajo,Creatividad/Diseño/Arquitectura,Edición/Redacción/Periodismo,Educación y Formación,Gestión Estratégica y de Negocio,Gestión de Proyectos,Hostelería/Restauración,IT/Desarrollo de Software,Ingeniería,Instalación/Reparación,Investigación y Desarrollo Científico,Legal,Marketing y Producto,Producción/Operaciones,Recursos Humanos,Servicios Médicos/Sanidad,Servicios de Seguridad,Ventas/Desarrollo de Negocio",
"job_type" : "Tipo de contrato",
"job_typeData" : "Indefinido,Temporal,Becario,Temporal,Jornada completa,Media jornada,Por horas",
"today" : "Hoy",
"yesterday" : "Ayer",

uk 
"job_category" : "Job category",
"job_categoryData" : "Accounting,Administration,Agriculture,Architecture,Banking,Charity,Communications,Construction,Creative,Customer Service,Editorial,Education,Engineering,Environmental,Finance,Healthcare,Hospitality,Human Resources,Insurance,IT,Legal,Leisure,Maintenance,Management And Executive,Manufacturing,Marketing,Mechanical,Operations And Logistics,Part Time,Project Management,Public Sector,QA,Retail,Sales,Science,Security,Social Work,Sport,Support,Training,Travel,Web",
"job_type" : "Job Type",
"job_typeData" : "Full Time,Contract,Part Time,Placement Student,Temp,Other",
"today" : "Today", 
"yesterday" : "Yesterday",

fr 
"job_category" : "Catégorie",
"job_categoryData" : "Administratif,Architecture,Assurance,BTP et Construction,Cadres et Direction,Commerce et Artisanat, Commercial et Vendeur,Comptabilité et Audit,Distribution et Grande Distribution,Edition et Presse,Energie,Environnement et Développement durable,Finance,Formation,Hôtellerie,Immobilier,Industrie,Informatique et Technologie de l’information,Ingénierie,Internet et Multimédia,Juridique,Logistique,Loisirs,Maintenance et Réparation,Marketing et Communication,Production,Publicité,Qualité,R et D et Science,Ressources Humaines,Restauration,Santé et Médical,Sécurité,Service à la personne,Service client,Stratégie et Business Intelligence,Télécom,Temps partiel,Territorial,Tourisme,Transport",
"job_type" : "Type de contrat",
"job_typeData" : "Interim ou CDD ou mission,CDI,Stage,Apprentissage,Alternance,Autres,Indépendant,Freelance,Saisonnier,Journalier,Titulaire de la fonction publique,Temps Partiel,Temps Plein",
"today" : "Aujourd'hui",
"yesterday" : "Hier",

it
"job_category" : "Aree professionali",
"job_categoryData" : "Abbigliamento,Acquisti,Amministrazione,Architettura,Assicurazioni,Assistenza Clienti,Banca,Commerciale,Comunicazione,Consulente,Contabilità,Controllo Qualità,Distribuzione,Edilizia,Energia e Green,Formazione,Industria,Informatica,Ingegnera,Ingegneria,Legale,Logistica,Manager,Manutenzione,Marketing,Ricerca,Risorse Umane,Sanità,Segreteria,Servizi alla Persona,Turismo",
"job_type" : "Contratto",
"job_typeData" : "Tempo indeterminato,Tempo determinato P.IVA,Stagista,Seasonal,Full-Time,Part-Time,A giornata",
"today" : "Oggi",
"yesterday" : "Ieri",

nl
"job_category" : "Categorie",
"job_categoryData" : "Administratie,Beveiliging,Bouw,Consultancy,Engineering,Finance,Gezondheidszorg,Horeca,Human Resources,ICT,Juridisch,Klantenservice,Logistiek,Management,Marketing,Media,Onderwijs,Onderzoek,Overheid,Productie,Projectmanagement,Sales,Techniek,Toerisme,Training/Onderwijs,Verkoop,Verzekeringen",
"job_type" : "Dienstverband",
"job_typeData" : "Onbeperkte duur,Beperkte duur,Student Stagiair,Freelance,Voltijds,Deeltijds,Per Diem",
"today" : "Vandaag",
"yesterday" : "Gisteren",


cz (Czech Republic)
"job_category" : "Kategorie",
"job_categoryData" : "Administrativa,IT,Produkt,Nakup,Finance,Obchod,HR,Zdravotnictví,Dělnické profese",
"job_type" : "Typ pracovního poměru",
"job_typeData" : "Trvalý pracovní poměr,Na dobu určitou,Praxe,Sezónní,Plný úvazek,Částečný úvazek,DPP DPČ",
"today" : "Dnes",
"yesterday" : "Včera",

ee 
"job_category" : "Vali valdkond",
"job_categoryData" : "Administratiivtöö,Avalik sektor,Avalikud suhted,Ehitus,Kinnisvara,Elektroonika,Energeetika,Elekter,Finants,Haridus,Hotellindus,Infotehnoloogia,Juhtimine,Kaubandus,Keskkonnakaitse,Kindlustus,Kolmas sektor,Korrakaitse,Kultuur,Kunst,Logistika,Meedia,Meelelahutus,MTÜ-d,Müük,Pangandus,Personalijuhtimine,Praktika,Päästeteenistus,Põllumajandus,Raamatupidamine,Reklaam,Sotsiaaltöö,Sport,Teadus,Teenindus,Tehnika,Telekommunikatsioonid,Tervishoid,Toitlustamine,Tootmine,Transport,Turism,Turundus,Töö vabatahtlikele,Töötlemine,Õigusabi",
"job_type" : "
"job_typeData" : "
"today" : "Täna",
"yesterday" : "Eile",

LV
"job_category" : "Kategoriju",
"job_categoryData" : "Administratīvais darbs,Aizsardzība,Apdrošināšana,Asistēšana,Bankas,Brīvprātīgo darbs,Būvniecība,Cilvēkresursi,Drošība,Elektroenerģija,Elektronika,Enerģētika,Farmācija,Finanses,Glābšanas dienesti,Grāmatvedība,Iepirkumi,Informācijas tehnoloģijas,Izglītība,Izklaide,Jurisprudence,Kokapstrāde,Kultūra,Kvalitātes kontrole,Kvalitātes vadība,Lauksaimniecība,Loģistika,Medicīna,Mediji,Mežsaimniecība,Māksla,Mārketings,Nekustamais īpašums,Pakalpojumi,Piegāde,Prakse,Pārdošana,Ražošana,Reklāma,Rūpniecība,Sabiedriskās attiecības,Sezonālais darbs,Sociālā aprūpe,Sports,Tehniskās zinātnes,Telekomunikācijas,Tieslietas,Tirdzniecība,Transports,Tūrisms,Vadība,Valsts pārvalde,Vides zinātne,Viesnīcas,Zinātne,Ēdināšan",
"job_type" : "
"job_typeData" : "
"today" : "Šodien",
"yesterday" : "Vakar",

LT
"job_category" : "Darbo sritis",
"job_categoryData" : "Darbo sritis,Praktika,Sezoninis darbas,Administravimas / Sekretoriavimas,Apsauga / Gelbėjimo paslaugos,Bankai / Draudimas,Elektronika / Telekomunikacijos,Energetika,Farmacija,Finansai / Apskaita,Gamyba / Pramonė,Informacinės technologijos,Inžinerija,Klientų aptarnavimas / Paslaugos,Kokybės vadyba / kokybės kontrolė,Kultūra / Menas / Pramogos / Sportas,Miškininkystė / medienos apdirbimas,Organizavimas / Valdymas,Pardavimai,Prekyba / pirkimai / tiekimas,Rinkodara / Reklama,Savanoriškas darbas,Statyba / Nekilnojamas turtas,Sveikatos apsauga / Socialinė rūpyba,Teisė,Transportas / Logistika,Turizmas / viešbučiai / viešasis maitinimas,Valstybinis ir viešasis administravimas,Švietimas / Mokslas / Mokymai,Žemės ūkis / Aplinkos inžinerija,Žiniasklaida / Viešieji ryšiai,Žmogiškieji ištekliai
"job_type" : "
"job_typeData" : "
"today" : "
"yesterday" : "

ru
"job_category" : "Выберите категорию",
"job_categoryData" : "Практика,Kультура / искусство / развлечения / спорт,Mаркетинг / реклама,Oбразование / наука,Oрганизация / управление,Tорговля / снабжение / закупки,Tранспорт / логистика,Tуризм / гостиницы / общественное питание,Административная работа,Банковское дело / страхование,Безопасность / спасательные службы,Государственная служба,Здравоохранение / соц. обеспечение,Информационные технологии,Лесное хозяйство / Деревообработка,Медиа / связи с общественностью,Право / юридическая помощь,Продажи,Промышленность / производство,Работа для волонтёров,Сезонные работы,Сельское хозяйство / энвироника,Строительство / недвижимость,Сфера обслуживания,Техническая сфера,Управление кадрами,Фармация,Финансы / бухгалтерское дело,Электроника / телекоммуникации,Энергетика / электроснабжение
"job_type" : "
"job_typeData" : "
"today" : "
"yesterday" : "

XX
"job_category" : "
"job_categoryData" : "
"job_type" : "
"job_typeData" : "
"today" : "
"yesterday" : "

*/