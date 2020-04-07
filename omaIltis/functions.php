<?php

function getDBConn($noServerComment = '') 
{
	$currDirName = substr(getcwd(), 0, 1);			
	if($currDirName == 'C') 
  {  
      // LOCAL WAMP TEST SERVER
      if($noServerComment == '') { echo '<br>This is test server.<br>'; }
      
      $username = "root"; // root
      $password = "";
      // $servername = "127.0.0.1:8080"; // 
      $servername = "localhost"; //  127.0.0.1
      $dbname = "exams";
      
      //$servername = "localhost";
      //$username = "1029520";
      //$password = "qwerty";
      //$dbname = "1029520db2";
      $conn = new mysqli($servername, $username, $password, $dbname);
      $conn->set_charset("utf8"); // NEW added 21 2 2017
      
      //mysql_select_db( 'exams' ); // NEW
      //mysql_select_db( 'exams' , $conn ); // NEW
    } 
    else 
    { 
      echo '<br>This is AWS server.<br>'; 
      // AWS
      // default database: echo "<br>RDS_DB_NAME: " . $_SERVER['RDS_DB_NAME']; // ebdb
	    $conn = mysqli_connect($_SERVER['RDS_HOSTNAME'], $_SERVER['RDS_USERNAME'], $_SERVER['RDS_PASSWORD'], $_SERVER['RDS_DB_NAME'], $_SERVER['RDS_PORT']);
      $conn->set_charset("utf8"); // NEW added 21 2 2017
    }

// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
		return null;
	} else {
		return $conn;
	}
}

function getSimpleDroplist($controlName='', $selectedId='', $options, $singleName) 
{
    $data = '';
    // $data .= "\n<div class='form-group row'>\n\t";
    // $data .= "<label for='$controlName' class='col-4 col-form-label pull-right'>$label</label>";
    // $data .= "\n\t\t<div class='col-3'>";
    $data .= "\n\t\t\t<select id='$controlName' name='$controlName' class='form-control custom-select mt-3'>";
    // $data .= "\n\t\t\t\t<option selected='' value='-1'>$selectText</option>";

    $optionsArr = explode(',', $options);
    if($singleName == '')
    {
      // return droplist
      $isSelected = '';        
      for($a=0;$a<count($optionsArr);$a++)
      {
        $data .= '\n\t\t\t\t<option value="' . $a . '">' . $optionsArr[$a] . '</option>';
      }
      $data .= "\n\t\t\t</select>";
      $data .= "\n\t\t</div>";     
      $data .= "\n</div>";
      return $data;

    } else {

      // return single name
      for($a=0;$a<count($optionsArr);$a++)
      {
        if($a == $selectedId) { return $a . ' ' . $optionsArr[$a]; }
      }
    }
}

function getActiveIcon($active)
{
  if(htmlentities($active) == '1') 
  {
    return '<div class="activeSelector activeSelectorOn"></div>'; 
    } else { 
    return '<div class="activeSelector activeSelectorOff"></div>'; 
  }
}





function getSearchTimes($searchtimes, $searchtimesValues) {
  //echo '<br><br><br><br><br><br><br><br><br><br><br>';
    $searchtimesArr = array();
     $sValuesArr = explode(',', $searchtimesValues);
     $sArr = explode(',', $searchtimes);
    for($a=0;$a<count($sValuesArr);$a++) { 
          $searchtimesArr[ $sValuesArr[$a] ] = $sArr[$a];
          //echo '<br>' . $sValuesArr[$a] . ' - ' . $sArr[$a];
    }
    return $searchtimesArr;
}

function getCurrentDateAsYYMMDDHHMM($format='ymdHi') 
{
  // $now = new DateTime();
  // $timestring = $now->format('ymdHi'); // 'Y-m-d H:i:s'

  $now = new DateTime();
  $now->setTimezone( new \DateTimeZone( 'Europe/Helsinki' ) ); // full list: http://php.net/manual/en/timezones.php
  if($format != '') {
    $timestring = $now->format($format);
  } else {
    $timestring = $now->format('ymdHi'); // 'Y-m-d H:i:s'
  }
  return $timestring;
}

function displayDate($dbDateYYMMDDHHMM, $format = '')
{

  if($dbDateYYMMDDHHMM == NULL) { return ''; } 
  $endDate = '';
  
  if ($format == "twoDates") { 
    $dateArr = explode('#', $dbDateYYMMDDHHMM); // 1806211000#1806211440
    $startDate = $dateArr[0]; 
    $endDate = $dateArr[1]; 
  } else {
    //echo '<br>DATE HAS ' . strlen($dbDateYYMMDDHHMM) . ' DIGITS!';
      // if no time in string 20170501
    if(strlen($dbDateYYMMDDHHMM) == 8) { $dbDateYYMMDDHHMM = $dbDateYYMMDDHHMM . '00'; }
    if(strlen($dbDateYYMMDDHHMM) == 6) { $dbDateYYMMDDHHMM = '20' . $dbDateYYMMDDHHMM . '00'; }

    //echo '<br>CHANGED TO: ' . $dbDateYYMMDDHHMM . '<br>';
    $oldDate = new DateTime();
    $oldDate = DateTime::createFromFormat('ymdHi', $dbDateYYMMDDHHMM);  
    $weekdayName = getWeekdayName($oldDate->format('w'), "fi", "short"); // w - A numeric representation of the day (0 for Sunday, 6 for Saturday)

    // today
    // $today = getCurrentDateAsYYMMDDHHMM('ymd');
    // if(substr($dbDateYYMMDDHHMM, 0, 6) == $today) { $weekdayName = 'Today'; }
    // $weekdayName = 'Today';
  }

  if($format == "") 
  {
    // $oldDate->format('D d.m.Y H:i'); // 24 hour format (Wed 14.11.2016 20:02)  Y
    $newDate = $weekdayName . '&nbsp;' . $oldDate->format('d.m.') . '&nbsp;klo&nbsp;' . $oldDate->format('H:i'); // 24 hour format (Keskiviikko 14.11.2016 20:02)
  } 
  elseif ($format == "24long") 
  {
    //$newDate = $oldDate->format('F jS Y H:i'); // 24 hour format with month name (November 11th 2016 20:04)
    $newDate = $oldDate->format('F j'); // 24 hour format with month name (November 11th 2016 20:04) - with smaller th text
    $newDate .= '<sup>' . $oldDate->format('S') . '</sup>'; 
    $newDate .= $oldDate->format(' Y H:i'); 
  } 
  elseif ($format == "24short") 
  {
    //$newDate = $oldDate->format('M jS Y H:i'); // 24 hour format with month name (November 11th 2016 20:04)
    $newDate = $oldDate->format('M j'); // 24 hour format with month name (November 11th 2016 20:04) - with smaller th text
    $newDate .= '<sup>' . $oldDate->format('S') . '</sup>'; 
    $newDate .= $oldDate->format(' Y H:i'); 
  }
  elseif ($format == "dayAndTime") 
  {
    $newDate = getWeekdayName($oldDate->format('w'), 'fi', 's'); // short weekdayname in finnish
    $newDate .= ' ' . $oldDate->format('H:i'); 
  } 
  elseif ($format == "DateAndTime") 
  {
    $newDate = ' ' . $oldDate->format('j.m.Y H:i'); // -------------------------------JATKA
  } 
  elseif ($format == "DateOnly") 
  {
    $newDate = ' ' . $oldDate->format('j.m.Y'); 
  } 
  elseif ($format == "time-only") 
  {
    $newDate = $oldDate->format('H:i'); // 24 hour format with month name (November 11th 2016 20:04) - with smaller th text    
  } 
  elseif ($format == "weekday") 
  {
    $newDate = getWeekdayName($oldDate->format('w'), 'fi', 's'); // short weekdayname in finnish
    $newDate .= ' ' . $oldDate->format('H:i'); // 24 hour format with month name (November 11th 2016 20:04) - with smaller th text    
  } 
  elseif ($format == "custom") 
  {
    //$newDate = $oldDate->format('M jS Y H:i'); // 24 hour format with month name (November 11th 2016 20:04)
    $newDate = $oldDate->format('M j'); // 24 hour format with month name (November 11th 2016 20:04) - with smaller th text
    $newDate .= '<sup>' . $oldDate->format('S') . '</sup>'; 
    $newDate .= $oldDate->format(' Y H:i'); 
    // $newDate .= ' GMT ' . $oldDate->format('O');         
    /*month name in local locale language http://stackoverflow.com/questions/13845554/php-date-get-name-of-the-months-in-local-language*/   
  }
  elseif ($format == "twoDates")
  {
      $temp1 = $startDate;
      $temp2 = $endDate;
      $newDate = ''; // new

      $oldDate = new DateTime();
      $oldDate = DateTime::createFromFormat('ymdHi', $startDate);
      $newDate = getWeekdayName($oldDate->format('w'), 'fi', 's') . ' '; // short weekdayname in finnish - new2
      // $newDate .= $oldDate->format('d.m.'); // day - old
      $newDate .= $oldDate->format('d. ') . getMonthName($oldDate->format('w'), 'fi', ''); // new2


      $newDate .= ' ' . $oldDate->format('Y'); // year - NEW

      $startDayOnly = $oldDate->format('d.'); // day only - special
      // $startMoNameOnly = $oldDate->format('M'); // February
      $startMoNameOnly = getMonthName($oldDate->format('w'), 'fi', '');
      $startTime = $oldDate->format('H:i'); // time

      $oldDate2 = new DateTime();
      $oldDate2 = DateTime::createFromFormat('ymdHi', $endDate);
      $endDate = $oldDate2->format('d.m.'); // day
      $endDayOnly = $oldDate2->format('d.'); // day only - special
      $endTime = $oldDate2->format('H:i'); // time

    // starts and ends in same date
    if(substr($temp1, 0, 6) == substr($temp2, 0, 6)) {
      // $newDate = $startDayOnly . ' ' . $startMoNameOnly;
      $newDate .= '</td><td>' . $startTime; 
    } else {   
      // $newDate .= '-' . $endDate . '</td><td>' . $startTime; 
      $newDate = $startDayOnly . '-' . $endDayOnly . ' ' . $startMoNameOnly . '</td><td>' . $startTime; 
      //$newDate = $startDayOnly . '-';
    }
    $newDate .= ' - ' . $endTime;    

  }
  else 
  {
    $newDate = $oldDate->format('M m. Y h:i A'); // 12 hour format with month name 
  }
  return $newDate;
}

function showEndDate($startDate, $endDate) {
    $startDatePart = substr($startDate, 0, 6);
    $endDatePart = substr($endDate, 0, 6);
    $endHours = substr($endDate, 6, 2);
    $endMins = substr($endDate, 8, 2);
    if($startDatePart == $endDatePart) {
        return ' - ' . $endHours . ':' . $endMins;
    } else {
        return ' - ' . displayDate($endDate);   
    }
}

function getCurrentYearYY() 
{
  $now = new DateTime();
  $now->setTimezone( new \DateTimeZone( 'Europe/Helsinki' ) ); // full list: http://php.net/manual/en/timezones.php
  return $now->format('y'); // 'Y-m-d H:i:s'
}

function getDateDifference($date, $today='') {
  if($today == '') { $today = getTodaysDateDB(); }
  $todayYr = (int)('20' . substr($today, 0, 2));
  $todayMo = (int)substr($today, 2, 2);
  $todayDay = (int)substr($today, 4, 2);

  $earlierYr  = (int)('20' . substr($date, 0, 2));
  $earlierMo  = (int)substr($date, 2, 2);
  $earlierDay = (int)substr($date, 4, 2);

  $date1=date_create("$todayYr-$todayMo-$todayDay");
  $date2=date_create("$earlierYr-$earlierMo-$earlierDay");

  $diffTemp=date_diff($date1,$date2);
  return  $diffTemp->format("%r%a"); // %r = prints a minus sign if the difference is negative, or nothing if it is positive

  // $diff = (((int)getTodaysDateDB())-((int)$row["userSinceDate"])); 
  // return $today . ' - ' . $earlier  . ' = ' . $diff;
}

function getTodaysDateDB($getWhat='') {
  $now = new DateTime();
  $now->setTimezone( new \DateTimeZone( 'Europe/Helsinki' ) ); // full list: http://php.net/manual/en/timezones.php
  if($getWhat=='full') {
    return  $now->format('ymdhi');// TODO check that number are two digit!
  } else if($getWhat=='scrambled') {
    return  $now->format('iyhsdsm');// TODO check that number are two digit!
  } else {
    return $now->format('ymd');
    }
}

function getWeekdayName($dayOfTheWeekInNum, $lang, $inLongFormat="") 
{  
  Switch($lang)
  {
    case "fi": 
        $weekdayNamesFull = "Sunnuntai,Maanantai,Tiistai,Keskiviikko,Torstai,Perjantai,Lauantai,Sunnuntai";
        $weekdayNamesShort = "Su,Ma,Ti,Ke,To,Pe,La,Su";
      break;
      // http://www.omniglot.com/language/time/days.htm
  }
  
    if($inLongFormat == "") { $weekdayNames = $weekdayNamesFull; } else { $weekdayNames = $weekdayNamesShort; }
    if($dayOfTheWeekInNum == "") {
      return explode(',', $weekdayNames);
    } else {
      $weekdayNamesArr = explode(',', $weekdayNames);
      return $weekdayNamesArr[$dayOfTheWeekInNum];
    }
}

function getMonthName($num, $lang='sv', $format='long', $ending='') 
{  
  // Switch($lang)
  // {
  //   case "fi": 
  //       $namesFull = ",Tammi,Helmi,Maalis,Huhti,Touko,Kesä,Heinä,Elo,Syys,Loka,Marras,Joulu";
  //       $namesShort = ",Tam,Hel,Maa,Huh,Tou,Kes,Hei,Elo,Syys,Lok,Mar,Jou";
  //     break;
  //     // http://www.omniglot.com/language/time/days.htm
  // }
    Switch($lang)
    {
      case "fi": return explode(',', ",Tammikuu,Helmikuu,Maaliskuu,Huhtikuu,Toukokuu,Kesäkuu,Heinäkuu,Elokuu,Syyskuu,Lokakuu,Marraskuu,Joulukuu,")[$num];  break;
      case "sv": return explode(',', ",januari,februari,mars,april,maj,juni,juli,augusti,september,oktober,november,december,")[$num];  break;
      case "en": return explode(',', ",January,February,March,April,May,June,July,August,September,October,November,December,")[$num];  break;
    }
    /*
    $names = '';
    if($format == "long") { $names = $namesFull; } // else { $names = $namesShort; }
    $namesArr = explode(',', $names);
    $res = $namesArr[$num];
    switch ($ending) {
      case 'uussa': $res .= 'kuussa'; break;       
      case'kuuta': $res .= 'kuuta' ;break;
      default: $res .= 'kuu'; break;
    }
    return $res;
    */
}


/*
// pagination init
$firstText = "Alkuun";
$prevText = "Edellinen";
$nextText = "Seuraava";
$lastText = "Loppuun";
$limit = 20;
$page = 1;
if (isset($_GET['p'])) { 
  $page = filter_input( INPUT_GET, 'p', FILTER_SANITIZE_URL ); }
  $thisPage = $page;
$start=($page-1)*$limit;
$totalItems = mysqli_num_rows(mysqli_query($conn,  "SELECT * FROM " . $table));
$totalPages = $totalItems/$limit;
*/
function showPagination($thisPage, $firstText, $prevText, $nextText, $lastText, $totalPages, $start, $page, $limit)
{ 
    if($totalPages < 2) { return ''; }
    $prevPage = null; 
    $nextPage = null; 
    if($page > 1) { $prevPage = $page-1; }  
    if($page < $totalPages) { $nextPage = $page+1; }

    $data = '';

    // pagination before
    $data .= '<div class="clearfix"></div>';
    $data .= '<div class="row">';
    $data .= '<div class="col-md-12 col-sm-12 col-xs-12" style="text-align:left;">';
    $data .= '<nav aria-label="Page navigation example">';
    $data .= '<ul class="pagination justify-content-end">';
/*
 <div class="clearfix"></div>
         <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12" style="text-align:left;">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-end">

                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1"> Previous</a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item active"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#"> Next</a>
                                </li>

                            </ul>
                        </nav>
                    </div>
                </div>
*/
    if($totalPages > 0)
    {
      $prevPageDisabled = ''; 
      $nextPageDisabled = ''; 
      if($prevPage == null) { $prevPageDisabled = ' disabled'; }; 
      if($nextPage == null) { $nextPageDisabled = ' disabled'; };   

  //    $data .= '<ul class="pagination">';
      // extra button for really long lists
      if($totalPages > 20) { $data .= ' <li class="page-item' . $prevPageDisabled . '"><a class="page-link" href="' . $thisPage . '&p=1">' . $firstText . '</a></li>'; } // FIRST
      $data .= '  <li class="page-item' . $prevPageDisabled . '"><a class="page-link" tabindex="-1" href="' . $thisPage . '?p=' . $prevPage . '">' . $prevText . '</a></li>'; // PREV
      // page numbers
      $displayPageLinks=5;
      for($pId=1; $pId < $totalPages+1; $pId++)
      {
        $activePage = ''; if($pId == $page) { $activePage = ' active'; }
        // A HREF LINKS
        ////$data .= '  <li class="page-item' . $activePage . '"><a href="' . $thisPage . '?p=' . $pId . '">' . $pId . '</a></li>';
        $data .= '<li id="p' . $pId . '" class="page-item' . $activePage . '"><a class="page-link" href="' . $thisPage . '&p=' . $pId . '">' . $pId . '</a></li>';
        // NO A HREF LINKS - USE WITH AJAX
        // $data .= '<li class="page-item' . $activePage . '"><span class="page-link" id="p' . $pId . '">' . $pId . '</span></li>';

        switch ($pId) {
          case '20': case '40': case '60': case '80': case '100': 
            $data .= '</ul><br><ul class="pagination justify-content-end">';
            break;
        }
        // if($pId == $displayPageLinks) { 
        //   $data .= '<li class="page-item"><a class="page-link">...</a></li>';
        //   return; 
        // }
      }
      $data .= '  <li class="page-item' . $nextPageDisabled . '"><a class="page-link" href="' . $thisPage . '&p=' . $nextPage . '">' . $nextText . '</a></li>';  // NEXT
      // extra button for really long lists
      if($totalPages > 20) { $data .= ' <li class="page-item' . $nextPageDisabled . '"><a class="page-link" href="' . $thisPage . '?p=' . ceil($totalPages) . '">' . $lastText . '</a></li>'; } // LAST
  //    $data .= '</ul>';
    }

    // pagination after
    $data .= '</ul>';
    $data .= '</nav>';
    $data .= '</div>';
    $data .= '</div>';

    return $data;
   
}

/*
$eventTypes = 'Valitse tapahtuman tyyppi,Kaikki,Musiikki/konsertit,Teatterit,Yökerhot/baarit,Elokuvat,Tanssi,Museot,Festivaalit,Taide/kirjallisuus,Liikunta/urheilu,Lapset/nuoret,Eläimet,Markkinat/kirpputorit/myyjäiset,Luennot,Hyvinvointi,Avajaiset,Muut,Valitse Tapahtuman tyyppi';
*/
function getDroplist($controlName, $options, $selectedId='', $icon='', $styleWidth='col-6')
{
    $options = explode(',', $options); 
    $selectText = array_shift($options); // take first item  
    $label = array_shift($options); // take second item
    $errText = array_pop($options); // take last item     

    $optionsArr = $options;
    if($selectedId == '') { $selectedId = -1; }

/*
    if($controlName == 'city') {
    echo '<br>optionsArr: ' . implode(',', $options) . '<br>';
    echo '<br>selectText: ' . $selectText . '<br>';
    echo '<br>label: ' . $label . '<br>';
    echo '<br>errText: ' . $errText . '<br>';   
    }
*/

    $data = "\n<div class='form-group row'>\n\t";
    if($icon != '') { $icon = "<i class='fa fa-$icon fa-2x'></i> "; } else { $icon = ''; }
    // icon not used now
    //$data .= "<label for='$controlName' class='col-form-label $styleWidth'>$label</label>";
    $data .= "\n\t\t<div class='$styleWidth'>";
    $data .= "\n\t\t\t<select id='$controlName' name='$controlName' class='form-control custom-select mt-3'>";

    $isSelected = '';    
    //if($controlName == 'city') {
    //  $data .= getCities($selectedId); // TODO: does not mark selected city on postback!!!!!!!+
    //  $data .= "<option value='99999'>Muu paikkakunta...</option>";
    //} else {
    $data .= "\n\t\t\t\t<option selected='' value='-1'>$selectText</option>"; // $selectText
      for($a=0; $a < (count($optionsArr))-1; $a++)
      {
          if ($selectedId == $a) { $isSelected = " selected=''"; } else { $isSelected = ''; }
          if($controlName == 'city') { $optionsArr[$a] = explode('_', $optionsArr[$a])[0]; }
          $data .= "\n\t\t\t\t<option value='$a' " . $isSelected . ">" . $optionsArr[$a] . "</option>";
      }      
      // last item
      if ($selectedId == '99999') { $specialIsSelected = " selected=''"; } else { $specialIsSelected = ''; }
      $data .= "\n\t\t\t\t<option value='99999' " . $specialIsSelected . ">" . $optionsArr[count($optionsArr)-1] . "</option>";
    //}

    $data .= "\n\t\t\t</select>";
    if($errText != '') { $data .= '<span id="' . $controlName . 'Err" class="error">' . $errText . '</span>'; }
    $data .= "\n\t</div>";
    $data .= "</div>";
    // $data .= '<div class="error">' . $errText . '</div>';
    return $data;
}

function getSearchDates($plusDays='') {
  $today = new DateTime();
  $today->setTimezone( new \DateTimeZone( 'Europe/Helsinki' ) ); // full list: http://php.net/manual/en/// timezones.php
  // $today = $now->format('ymdHi');
  if($plusDays !='') { return date('ymd', strtotime($today. ' + ' . $plusDays . ' days')); } else {
    return date('ymd');
  }
}

function getRestOfYearMonths() {
  $resVals = '';
  $res = '';  
  $today = getTodaysDateDB(); 
  $todayYr = (int)('20' . substr($today, 0, 2));
  $todayMo = (int)(substr($today, 2, 2));  
  // $todayDay = (int)substr($today, 4, 2);

  // $now = new DateTime();
  // $now->setTimezone( new \DateTimeZone( 'Europe/Helsinki' ) ); // full list: http://php.net/manual/en/// timezones.php
  // $today = $now->format('ymdHi'); 
  // // $todayMo = $now->format('m');
  // // // $todayMo = (int)(substr($today, 2, 2))+1;   

  for($a=$todayMo;$a<13;$a++) {
    // $date1=date_create("$todayYr-$a-$todayDay");
    $resVals .= $a . ',';
    $res .= getMonthName($a, 'fi', '','uussa') . ',';
  }
  $resVals = substr($resVals, 0, (strlen($resVals))-1); // remove last ,
  $res = substr($res, 0, (strlen($res))-1); // remove last ,
  return $resVals . '#' . $res;
}

function getDateDroplist($controlDateName, $selectedId, $selectText, $Cssclass='Minput')
{
// 'Now,1,2,3,4,5'
  $result = "";    
  $selectedText = '';
  if($Cssclass=='hidden') { $disabled = ' disabled'; } else { $disabled = ''; }
  // $result .= "<i class='fa fa-clock fa-2x'></i> "; // test
  $result .= '<select' . $disabled . ' id="' . $controlDateName . '" name="' . $controlDateName . '" class="form-controlNarrow ' . $Cssclass . '">'; 
  if($selectText != '') { $result .= '  <option value="-1">' . $selectText . '</option>'; }
  switch ($controlDateName) {
    case 'startDate': case 'endDate':
      $start = 1; $end = 32;
      for($a=$start; $a < $end; $a++)
      {
        if($selectedId == makeTwoDigit($a)) { $selectedText = " selected"; } else { $selectedText = ''; }
        $result .= '  <option' . $selectedText . ' value="' . makeTwoDigit($a) . '">' . $a . '</option>';
      }
        break;    
    case 'startMonth': case 'endMonth':
      $start = 1; $end = 13;
      $months = ',Tammi,Helmi,Maalis,Huhti,Touko,Kesä,Heinä,Elo,Syys,Loka,Marras,Joulu';
      $monthsArr = explode(',', $months);
      for($a=$start; $a < $end; $a++)
      {
        if($selectedId == makeTwoDigit($a)) { $selectedText = " selected"; } else { $selectedText = ''; } 
        $result .= '  <option' . $selectedText . ' value="' . makeTwoDigit($a) . '">' . $monthsArr[$a] . 'kuu</option>';
      }
        break;
    case 'startYear': case 'endYear':
      $start = getCurrentYearYY(); $end = (getCurrentYearYY())+3;
      for($a=$start; $a < $end; $a++)
      {
        if($selectedId == makeTwoDigit($a)) { $selectedText = " selected"; } else { $selectedText = ''; }
        $result .= '  <option' . $selectedText . ' value="' . makeTwoDigit($a) . '">20' . $a . '</option>';
      }
        break;
    case 'weekdayXXXXXXXXX': // not in use
      $start = getCurrentYearYY(); $end = (getCurrentYearYY())+3;
      $weekdayNamesArr = getWeekdayName('', 'fi');
      $result .= '  <option' . $selectedText . ' value="-1">' . '--- Valitse ---' . '</option>';
      for($a=1; $a < 8; $a++)
      {
        if($selectedId == makeTwoDigit($a)) { $selectedText = " selected"; } else { $selectedText = ''; } 
        $result .= '  <option' . $selectedText . ' value="' . $a . '">' . $weekdayNamesArr[$a] . '</option>';
      }
        break;
        /*
      case 'recurringTimespan':
        $result .= '  <option' . $selectedText . ' value="1">' . 'Viikko' . '</option>';
        $result .= '  <option' . $selectedText . ' value="2">' . 'Toinenviikko' . '</option>';
        $result .= '  <option' . $selectedText . ' value="3">' . 'Kuukausi' . '</option>';
        $result .= '  <option' . $selectedText . ' value="4">' . 'Vuosi' . '</option>';
        break;
        */
    case 'recurringTimes':
      for($a=0; $a < 11; $a++)
      {
        if($selectedId == makeTwoDigit($a)) { $selectedText = " selected"; } else { $selectedText = ''; } 
        $result .= '  <option' . $selectedText . ' value="' . $a . '">' . $a . '</option>';
      }
        break;
  }
  $result .= '</select>';
  return $result;
}

function getTimeDroplist($controlHoursName, $controlMinsName, $selectedHoursId, $selectedMinsId, $Cssclass='Minput')
{
  // ----------- hours -----------
  $result = "";    
  $selectedText = '';
  $result .= '<select name="' . $controlHoursName . '" class="form-controlNarrow ' . $Cssclass . '">';
  // $result .= '  <option value="-1">' . $anyTimeText1 . '</option>';  
  for($a=0; $a < 24; $a++)
  {
    if($selectedHoursId == makeTwoDigit($a)) { $selectedText = " selected"; } else { $selectedText = ''; }
    if(strlen($a) == 1) { $extra = '0'; } else { $extra = ''; }
    $result .= '  <option ' . $selectedText . ' value="' . makeTwoDigit($a) . '">' . $extra .  $a . '</option>';
  }
  $result .= '</select>';
  
  // ----------- mins -----------
  $dataString = '00,15,30,45';
  $dataArr = explode(',', $dataString); 
  $selectedText = '';
  $result .= '<select name="' . $controlMinsName . '" class="form-controlNarrow ' . $Cssclass . '">';
  // $result .= '  <option value="-1">' . $anyTimeText2 . '</option>';
  for($a=0; $a < sizeof($dataArr); $a++)
  {
    // echo $selectedMinsId . ' vs ' . makeTwoDigit($a) . ',';
    if($selectedMinsId == $dataArr[$a]) { $selectedText = " selected"; } else { $selectedText = ''; } 
    $result .= '  <option ' . $selectedText . ' value="' . $dataArr[$a] . '">' . $dataArr[$a] . '</option>';
  }
  $result .= '</select>';
  return $result;
}

function getDateSearchCriteria($selectedTime) 
{
  $selectedStartDate = getTodaysDateDB() . '0000';
  $selectedEndDate = $sql = '';
  switch ($selectedTime) 
  {
      case 'today':  
          $sql .= ' AND startDate >= "' . getTodaysDateDB() . '0000' . '"';
          $sql .= ' AND endDate <= "' . getTodaysDateDB() . '2359' . '"'; break;
      case 'todayPlus1': 
          $sql .= ' AND startDate >= "' .getSearchDates(1) . '0000' . '"';
          $sql .= ' AND endDate <= "' . getSearchDates(1) . '2359' . '"';break; 
      case 'todayPlus2':  
          $sql .= ' AND startDate >= "' .getSearchDates(2) . '0000' . '"';
          $sql .= ' AND endDate <= "' . getSearchDates(2) . '2359' . '"';break; 
      case 'nextWeekend': 
          $sql .= ' AND startDate >= "' . date('ymd', strtotime('next saturday')) . '0000"';
          $sql .= ' AND endDate <= "' . date('ymd', strtotime('next sunday')) . '2359"';break;
      case 'thisWeek': 
          $sql .= ' AND startDate >= "' . date('ymd', strtotime('last monday')) . '0000"';
          $sql .= ' AND endDate <= "' . date('ymd', strtotime('next sunday')) . '2359"';break;
      case 'thisWeekPlus1': 
          $sql .= ' AND startDate >= "' . date('ymd', strtotime('last monday + 7 days')) . '0000"';
          $sql .= ' AND endDate <= "' . date('ymd', strtotime('next sunday + 7 days')) . '2359"';break;
      case 'nextYear':
          $yr = (int)(substr(getTodaysDateDB(), 0, 2))+1;
          $sql .= ' AND startDate >= "' . $yr . '01010000"'; 
          $sql .= ' AND endDate <= "' . $yr . '12312359"'; break; 
      default:
          if($selectedTime == -1) { return; break; }
          // by month number
          $yr = substr(getTodaysDateDB(), 0, 2);
          $mo = makeTwoDigit($selectedTime);
          $sql .= ' AND startDate >= "' . $yr . $mo . '010000"'; // first day on month
          $sql .= ' AND endDate <= "' . $yr . $mo . '312359"'; // last day of month
          break;
  }
  return $sql;
} 

function makeTwoDigit($a) {
    if(strlen($a) == 1) { return '0' . $a; } else { return $a; }
}

function generateCode($len) {
  $res = '';
  /* // number only
  $min=0;
  $max=9;
  for($a=0;$a<$len;$a++) {
    $res .= mt_rand($min,$max);
  } */
  $today = getTodaysDateDB();
  $string = substr(str_shuffle(str_repeat($today . "A2B3C4D5E6F7G8H9JKMNPRSTUVWXYZ", 5)), 0, $len);
  // $number = rand(100000,999999);
  // echo $string.'-'.$number;
  
  return $string;
}

function getIdByCode($where, $whereVal, $conn) {
  $sql = "SELECT id FROM free_events WHERE $where='$whereVal' LIMIT 1";
  echo '<br>SQL8: ' . $sql . '<br>';
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0)
  {
    while($row = mysqli_fetch_assoc($result))
    {
      return $row["id"];
    }
  } else { return false; } // not found
}

function simple_crypt( $string, $action = 'e' ) {
    // you may change these values to your own
    $secret_key = 'my_simple_secret_key';
    $secret_iv = 'my_simple_secret_iv';
 
    $output = false;
    $encrypt_method = "AES-256-CBC";
    $key = hash( 'sha256', $secret_key );
    $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );
 
    if( $action == 'e' ) {
        $output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
    }
    else if( $action == 'd' ){
        $output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
    }
    echo '<br>Encrypted string length is: ' . strlen($output);
    return $output;
}
// ====================================== cookie functions ========================================
// saveCookie('quickRegister',$siteCountryCode,$langCode,$gender,$lookingForGender);
function saveCookie($cookieName,$siteCountryCode,$langCode,$gender,$lookingForGender,$login)
{
  // NOTE! must appear before HTML tag!
  setcookie($cookieName, $siteCountryCode . '_' . $langCode . '_' . $gender . '_' . $lookingForGender . '_' . $login, time() + (86400 * 90), "/"); // 86400 = 1 day
  // setcookie($cookieName, 'This is test cookie.', time() + (86400 * 90), "/"); // 86400 = 1 day
}
function getCookie()
{
  if(isset($_COOKIE['quickRegister'])) { 
    $data = $_COOKIE['quickRegister']; 
    // $siteCountryCode,$langCode,$gender,$lookingForGender
      return $data; 
  } else {
    return false; 
  }
}
// -------------- COOKIE --------------------
// 0 TEMP set cookie
//setcookie('funwithbox_siteCountryCode', 'FI', time() + (86400 * 30), "/"); // 86400 = 1 day
//setcookie('funwithbox_lang', 'FI', time() + (86400 * 30), "/"); // 86400 = 1 day

// // 1 try read from cookie: siteCode + lang 
// $frLangId = ''; // 'EN'
// $siteCountryCode = '';
// if(isset($_COOKIE['funwithbox_siteCountryCode'])) { 
//   $siteCountryCode = $_COOKIE['funwithbox_siteCountryCode']; 
//   echo "<h1>Cookie siteCountryCode: " . $siteCountryCode . "</h1>"; 
// } 
// if(isset($_COOKIE['funwithbox_lang'])) { 
//   $frLangId = $_COOKIE['funwithbox_lang'];
//   echo "<h1>Cookie frLangId: " . $frLangId . "</h1>"; 
// }



// ===================================== validation functions =====================================
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function validLen($str, $min, $max)
{
    $len = strlen($str);
    if($len < $min)
    {
        return " is too short, minimum is $min characters ($max max)";
    }
    elseif($len > $max)
    {
        return " is too long, maximum is $max characters ($min min).";
    }
    return TRUE;
}

function validateNotEmpty($compulsoryFields, $allValues)
{
  $fieldsArr = (explode(",",$compulsoryFields));
  $valuesArr = (explode("#",$allValues));
  $err = '';
  $arrLength = count($fieldsArr);
  for($a = 0; $a < $arrLength; $a++) 
  {
    if($valuesArr[$a] == '') { $err .= $fieldsArr[$a] . '#'; }
  }
  $res = substr($err, 0, (strlen($err))-2); // remove last #
  return $res;
}

/* sanitize user input for saving in DB */
function sanitize($str, $type='')
{
  /* https://www.tutorialrepublic.com/php-tutorial/php-filters.php */
  switch ($type) {
    case 'int': return filter_var($str, FILTER_VALIDATE_INT); break;
    case 'email': return filter_var($str, FILTER_SANITIZE_EMAIL); break;
    case 'url': return filter_var($str, FILTER_SANITIZE_URL); break;   
    default: return filter_var($str, FILTER_SANITIZE_STRING); break;
  }
  
}

// in footer
function getLanguages($controlName, $icon='', $langId, $siteCountryCode, $selectedId='',$label,$selectText) {
    $allowedItems = 'en,fi,sv,no,dk';
    $allowedItemsArr = explode(",",$allowedItems);
    $skipItems= 'cu';
    $skipItemsArr = explode(",",$skipItems);

    $preSelectedId = '';
    $selectedText = '';
    $result = '';   
    $first = true;
    $url = 'allLanguageNames.json';
    $string = file_get_contents($url);
    $jsonIterator = new RecursiveIteratorIterator(
      new RecursiveArrayIterator(json_decode($string, TRUE)),
      RecursiveIteratorIterator::SELF_FIRST);

    // $data .= '<option value="-1">--- Select language ---</option>';
    $code = '';
    $data = "\n<div class='form-group row'>\n\t";
    if($icon != '') { $icon = "<i class='fa fa-$icon fa-2x'></i> "; } else { $icon = ''; }
    // icon not used now
    $data .= "<label for='$controlName' class='col-4 col-form-label pull-right'>$label</label>";
    $data .= "\n\t\t<div class='col-3'>";
    $data .= "\n\t\t\t<select id='$controlName' name='$controlName' class='form-control custom-select mt-3'>";
    $data .= "\n\t\t\t\t<option selected='' value='-1'>$selectText</option>";
    // iterate
      // $optionsArr = $options;
      $isSelected = '';

    foreach ($jsonIterator as $key => $value) 
    {
      $isActive = ''; // TEMP
      $item = '';
      //  <option value="AU" data-icon="./img/AU.png">Australia</option>
      //if(strlen($key) == 2) { $allLangs .= '<option value="' . $key . '">'; } 
      if(strlen($key) == 2) { $code = $key; $item = '<option value="' . $key . '">' . ' '; } 
      // if(strlen($key) == 3) { if($value == 'active') { $isActive = '2'; }} // TEMP
      // if(strlen($key) == 4) { if($value == 'active') { $isActive = '2'; }} // TEMP
      if (is_array($value)) {
          foreach ($value as $key => $val) {
            $item .= trim($val) . ' / ';
          }
      }
      if($allowedItems != '') {
        if(in_array($code, $allowedItemsArr)) {
          $item = substr($item, 0,-2) . '</option>';
          $data .= $item;
        }
      } else {
        //// all languages except some
        //if(!in_array($code, $skipItemsArr)) {
          $item = substr($item, 0,-2) . '</option>';
          $data .= $item;
        //}
      }
      /*
        // TEST
        $item = substr($item, 0,-2);
        if(in_array($code, $allowedLangsArr)) $item .= ' **********';
        if( $isActive != '')  $item .= ' -------------';
        $allLangs .= $item  . '</option>';
      */
    } // foreach
    $data .= "\n\t\t\t</select>";
    $data .= "\n\t</div>";
    $data .= "</div>";
    return $data;
}
// ================================= location functions ===============================


// country and lang list
function getJSONList($controlName, $icon='', $langId, $siteCountryCode, $selectedId='')
{
//   echo "<h1>getJSONList controlName: " . $controlName . "</h1>";
//   echo "<h1>getJSONList icon: " . $icon. "</h1>";
//   echo "<h1>getJSONList langId: " . $langId. "</h1>";
//   echo "<h1>getJSONList siteCountryCode: " . $siteCountryCode. "</h1>";
//   echo "<h1>getJSONList selectedId: " . $selectedId. "</h1>";
  $data = "";
  /*
<div class="form-group row">
  <label for="countryOfLiving" class="col-4 col-form-label">Location</label>
    <div class="col-8">
      <select id="countryOfLiving" name="countryOfLiving" class="form-control custom-select mt-3">
        <option selected="" value="-1">Please select</option>
        <option value="1">Brussels</option>
        <option value="2" selected="">Nice</option>
        <option value="3">London</option>
      </select>
  </div></div>
  */
  $options = explode(',', 'Valitse,Valitse maa,'); 
  $selectText = array_shift($options); // take first item
  $label = array_shift($options); // take second item
  $errText = array_pop($options); // take last item

    $data = "\n<div class='form-group row'>\n\t";
    if($icon != '') { $icon = "<i class='fa fa-$icon fa-2x'></i> "; } else { $icon = ''; }
    // icon not used now
    $data .= "<label for='$controlName' class='col-4 col-form-label'>$label</label>";
    $data .= "\n\t\t<div class='col-8'>";
    $data .= "\n\t\t\t<select id='$controlName' name='$controlName' class='form-control custom-select mt-3'>";
    $data .= "\n\t\t\t\t<option selected='' value='-1'>$selectText</option>";
    // iterate
      $optionsArr = $options;
      $isSelected = '';
      // for($a=1; $a < count($optionsArr); $a++)
      // {
      //   if ($selectedId == $a) { $isSelected = " selected=''"; } else { $isSelected = ''; }
      //   $data .= "\n\t\t\t\t<option value='$a'$isSelected>" . $optionsArr[$a] . "</option>";
      // }
    // --------------------------------- NEW ---------------------------------------

  if($controlName =='siteLanguage')
  {
    $allowedItems = 'en,fi,sv,no,dk';
    $allowedItemsArr = explode(",",$allowedItems);
    $preSelectedId = '';
    $selectedText = '';
    $result = '';   
    $first = true;
    $url = 'allLanguageNames.json';
    $string = file_get_contents($url);
    $jsonIterator = new RecursiveIteratorIterator(
      new RecursiveArrayIterator(json_decode($string, TRUE)),
      RecursiveIteratorIterator::SELF_FIRST);

    // $data .= '<option value="-1">--- Select language ---</option>';
    $code = '';

    foreach ($jsonIterator as $key => $value) 
    {
      $isActive = ''; // TEMP
      $item = '';
      //  <option value="AU" data-icon="./img/AU.png">Australia</option>
      //if(strlen($key) == 2) { $allLangs .= '<option value="' . $key . '">'; } 
      if(strlen($key) == 2) { $code = $key; $item = '<option value="' . $key . '">' . ' '; } 
      // if(strlen($key) == 3) { if($value == 'active') { $isActive = '2'; }} // TEMP
      // if(strlen($key) == 4) { if($value == 'active') { $isActive = '2'; }} // TEMP
      if (is_array($value)) {
          foreach ($value as $key => $val) {
            $item .= trim($val) . ' / ';
          }
      }
      if(in_array($code, $allowedItemsArr)) {
        $item = substr($item, 0,-2) . '</option>';
        $data .= $item;
      }
      /*
        // TEST
        $item = substr($item, 0,-2);
        if(in_array($code, $allowedLangsArr)) $item .= ' **********';
        if( $isActive != '')  $item .= ' -------------';
        $allLangs .= $item  . '</option>';
      */
    } // foreach
  } // IF $controlName =='languages'    

  if($controlName == "countryOfLiving")
  {
    $topItemText = ''; 
    $nextGeonameId = '6255148'; // europe
    // $nextGeonameId = '660013'; // finland

    // $lang = 'fi';
    $preSelectedId = '';
    // $data = '';
    $url1 = 'http://api.geonames.org/childrenJSON?q=a&geonameId=';
    $url2 = '&maxRows=100&username=adssite8578578&lang=' . $langId;
    $counter=1;
    // do {
    //{
       $data .= getGeoItems($nextGeonameId, $url1, $url2, 'geonameId', 'name', $topItemText, $preSelectedId, $langId); // $lang
      // $nextGeonameId = explode("#",$data)[0];
      // $geoData = explode("#",$data)[1];
      // if(strlen($geoData)>2) { echo '<br><br>KIERROS ' . $counter . ':<br>' . $geoData; }
      // $counter++;   
    //}
    //} while(strlen($nextGeonameId) > 0);

  }// IF $controlName =='countryOfLiving'





    // --------------------------- END ITERATE -------------------------------------
    $data .= "\n\t\t\t</select>";
    $data .= "\n\t</div>";
    $data .= "</div>";
    return $data . '<br>' . $url1 . $nextGeonameId  . $url2;
}

function getGeoItems($geonameId, $url1, $url2, $id, $item, $topItemText, $preSelectedId, $langId) {
    $result = '';   
    $first = true;
    $url = $url1 . $geonameId . $url2; // . $langId;
    echo '<br>getGeoItems HAKU: ' . $url . '<br><br><br>';
    // echo '<br>functions 480: langId: ' . $langId . '<br><br><br>';
    // if($string = file_get_contents($url) == false) {
    // echo '<br><h3>Connectiong to geonames url FAILED</h3>';
    // }
    $string = file_get_contents($url);
    $jsonIterator = new RecursiveIteratorIterator(
      new RecursiveArrayIterator(json_decode($string, TRUE)),
      RecursiveIteratorIterator::SELF_FIRST);
    $nextGeonameId = '';
    foreach ($jsonIterator as $key => $val) {

      if(is_array($val)) {  
        if($first) { $first = false; continue; } // start from second item - skip empty first     
        if($nextGeonameId == '') { $nextGeonameId = $val[$id]; }
        if ($preSelectedId == $val[$id]) { $selectedText = ' selected'; } else { $selectedText = ''; }
        if($val[$id] != '661882') $result .=  '<option value="' . $val[$id] . '"' . $selectedText . '>' . $val[$item] . '</option>'; // ohita ahvenanmaa
      }
    }
    if(strlen($result) > 0) { if($topItemText != '') { $result = '<option value="-1">' . $topItemText . '</option>' . $result; } }
    // echo $result;
    return $nextGeonameId . '#' . $result;
  }


?>