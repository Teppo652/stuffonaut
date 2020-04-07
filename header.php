<?php include_once('functions.php'); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title> </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta name="keywords" content="Stuffonaut, stuff, Online shopping, Automotive, Phones, Accessories, Computers, Electronics, Fashion, Beauty, Health, Home, Garden, Toys, Sports" />
        <meta name="description" content="Online shopping for new and used electronics, fashion, phone accessories, computer, electronics, toys, home & garden, home appliances, tools" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- <link rel="shortcut icon" href="../assets/images/favicon.ico">
        <link rel="icon" href="http://example.com/favicon.png">-->
        <!-- favicon -->
        <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
        <link rel="manifest" href="site.webmanifest">
        
    <!-- fonts -->
    <link href="https://fonts.googleapis.com/css?family=Kreon|Molengo" rel="stylesheet"> -->

		<!-- beauter styles 
		<link rel="stylesheet" href="https://rawgit.com/outboxcraft/beauter/master/beauter.min.css">  -->
    <link rel="stylesheet" href="beauter.min.css"> 
		<!-- styles -->
		<link rel="stylesheet" href="main.css" type="text/css">

    <!-- ======================= STYLES ======================= -->
    <!-- overriding site styles -->
    <!-- <link rel="stylesheet" href="fi.css"> -->
    <!-- <link rel="stylesheet" href="ru.css"> -->
    <!-- <link rel="stylesheet" href="light.css"> -->
    
    <!-- logo font -->
    <link href="https://fonts.googleapis.com/css?family=Baloo+Chettan" rel="stylesheet">

    <!-- logo test - css in end of css file 
    <link href="https://fonts.googleapis.com/css?family=Baloo+Chettan|Baumans|Cinzel+Decorative:700|IM+Fell+French+Canon+SC|Michroma|Rum+Raisin" rel="stylesheet"> -->
    
</head>
<body> <!-- style="display:none"> <!-- fade in test -->
<!-- nav -->
<!-- nav -->
<div class="container">
<ul class="topnav gr4" id="headerTitles" style="color: rgba(46,62,72,.6)"> <!-- font color  myTopnav2 -->
  <!-- shobbist 
  <li>
    <span id="brandLogo"></span>
    <a id="toplink_siteName" href="index.php" title="stuffonaut.com" class="brand logo1">Sho<span id="letter">bb</span>ist<small id="com">.com</small></a>
  </li>-->
  <!-- stuffonaut -->
  <li id="brandImgs">
    <span id="dog"></span>
    <span id="sofa"></span>
    <span id="mobilephone"></span>
    <span id="teddy"></span>
    <span id="bike"></span>
<!-- temp logo pois -->
    <span id="brandLogo" class="stuffonaut"></span>
    <a id="toplink_siteName" href="index.php" title="stuffonaut.com" class="brand logo1">Stuff <span id="space8"></span>naut<small id="com">.com</small></a>
    <span id="beta">Beta</span>
  </li>

<?php 
$thisPage = getCurrentFileName(); // == 'index.php' || getCurrentFileName() == 'messages.php') {

  // --------------------login & logout --------------------------
  //removeSession(); // logs user out - removed session data
  $loggedIn = '0';
  $userName = $userSafeId = '';
  //if (isset($_GET['loggedIn']))
  if(isset($_SESSION['user']))
  {
    $loggedIn = '1';
    //echo '<br>Session:'.$_SESSION['user'];
    if (isset($_GET['loggedIn'])) {
      $loggedIn = filter_input( INPUT_GET, 'loggedIn', FILTER_SANITIZE_URL );
    }
    $userSafeId = explode('#', $_SESSION['user'])[0];
    $userName = explode('#', $_SESSION['user'])[1];
    if($loggedIn == '0') { 
      removeSession();  // remove session data
    } 
      // echo '<br>NEXT: ' . loadFromSession(); what is this?
    
  } //else { $_SESSION['user'] = null; /* removeSession(); */ } // remove session data 
  // else { echo '<li class="secondaryBtn"><a href="#">No loggedIn set</a></li>'; }

    // echo '<span id="isLoggedIn">isLoggedIn:'.$loggedIn.'</span>'; 
/*

            <?php
            
// check if user is logged in
//if(isset($_SESSION['user'])) {
//  echo '<br>You are logged in: ' . loadFromSession();
//} else {
//  echo '<br>NOT logged in';
//}
            ?>

*/


  if($loggedIn == '1') {
    // -------------------------- is logged in    log out --------------------------
    //echo '<li class="secondaryBtn"><span class="logoutIcon"></span><a id="toplink_logout" class="gr" href="index.php?loggedIn=0"></a></li>';
    // old working
    //echo '<li class="secondaryBtn gr"><span class="logoutIcon"></span><a id="toplink_logout" class="Xgr" href="index.php?loggedIn=0">[[Log out]]</a> Logged in as '.$userName.'</li>';

    // log out - moved inside loggedInAs -splash
    /*
    echo '<li class="secondaryBtn gr"><span class="logoutIcon"></span><a id="toplink_logout" class="Xgr" href="index.php?loggedIn=0">[[Log out]]</a></li>'; */
    
    // logged in as
    echo '<li class="secondaryBtn"><span class="loggedInAsIcon"></span><a id="toplink_loggedInAs" style="Xgr" href="#">'.$userName.'</a></li>';
    // logged in actions
        echo '<div id="loggedInAsPopup" class="hidden">';
        echo '  <span class="arrow-up-border"></span>';
        echo '  <span class="arrow-up-border arrow-up"></span>';
        echo '  <div class="popupContent">';
        echo '    <a href="#" class="popupLoginBtn highlighted">Bevakningar</a>';
        echo '    <a href="#" class="popupLoginBtn highlighted">Sparade annonser</a>';
        echo '    <a href="messages.php" class="popupLoginBtn highlighted">Meddelanden</a>';
        echo '    <a href="myAds.php" class="popupLoginBtn highlighted">Mina annonser</a>';
        
        echo '    <a href="#" id="openSettingsPanelBtn" class="popupLoginBtn highlighted">Category settings</a>';
        //echo '<a id="openSettingsPanelBtn" title="My settings"><span class="settingsIcon"></span></a>'; // users settings

        // site style
        echo '    <a href="#" id="styleBtn" class="popupLoginBtn highlighted">Site style</a>';
        echo '  <div class="popupContent siteStyles hidden">';
          echo '    <a href="#" class="popupLoginBtn highlighted siteStyle"><img src="img/home2.jpg">Classic</a>';
          echo '    <a href="#" class="popupLoginBtn highlighted siteStyle"><img src="img/home2.jpg">Regular</a>';
          echo '    <a href="#" class="popupLoginBtn highlighted siteStyle"><img src="img/home2.jpg">Light</a>';
        echo '  </div>';

        echo '    <a href="index.php?loggedIn=0" id="toplink_logout" class="popupLoginBtn highlighted">Logout</a>';

        echo '  </div>';
        echo '</div>';
/*
    echo <<<EOT
    <div id="loginPopup" class="loggedInAsPopup" class="hidden"> 
      <span class="arrow-up-border"></span>
      <span class="arrow-up-border arrow-up"></span>
      <div class="popupContent">
        <button id="myAds.php" class="popupLoginBtn highlighted">Mina annonser</button>
        <button id="messages.php" class="popupLoginBtn highlighted">Meddelanden</button>
        <button id="#" class="popupLoginBtn highlighted">Bevakningar</button>
        <button id="#" class="popupLoginBtn highlighted">Sparade annonser</button>

      </div>
    </div>
EOT;
*/

    
  } else if($thisPage != 'new.php' && $thisPage != 'new2.php' && $thisPage != 'new3.php') { // } if($loggedIn == '0' && $thisPage != 'login.php') {
    // -------------------------- is not logged in    log in --------------------------
    echo '<li class="secondaryBtn gr"><span class="userIcon"></span><a id="toplink_login" class="Xgr" href="login.php" target="_blank">[Log in]</a></li>';
  }

  // echo 'THIS PAGE:' . $thisPage; // new.php
  // if($thisPage != 'login.php') { 
  if($thisPage == 'index.php') { 
    ?>
  <!-- ------------------------- index -page ---------------------------- -->
  <!-- all ads IS THIS NEEDED?
  <li class="gr"><a id="toplink_allAds" class="Xgr" href="index.php" >[All ads]</a></li> -->
    <?php 
  } ?>


  <!-- is not logged in    log in
  <li class="secondaryBtn"><span class="userIcon"></span><a id="toplink_login" class="gr" href="login.php" target="_blank">[Log in]</a></li>
  <!-- is logged in    log out
  <li class="secondaryBtn"><span class="logoutIcon"></span><a id="toplink_logout" class="gr" href="index.php?loggedIn=0"></a></li>
-->
    <?php 
  if($thisPage == 'index.php') { 

    if($loggedIn == '1') {
    // saved searches
    echo '<li class="secondaryBtn gr gr5"><span class="heartIcon2"></span><a id="toplink_savedSearches" class="xgr"></a></li>';
    } else {
      // show dummy
      // saved searches - dummy
      echo '<li class="secondaryBtn gr"><span class="heartIcon2"></span><a id="toplink_savedSearches" disabled class="xgr"></a></li>';
    }
  ?>
  <!-- not in use yet
  <li class="secondaryBtn"><span class="chat-bubbleIcon"></span><a id="toplink_messages" href="#">[Meddelanden]</a></li>
  <li class="secondaryBtn"><span class="headphonesIcon"></span><a id="toplink_customerService" href="#">[Kundservice]</a></li> 
  -->
  <!-- place ad -->
  <li class="secondaryBtn gr"><a href="new.php" target="_blank" id="toplink_placeAd" class="btn xgr">[[place ad]]</a></li>

  <!-- ------------------------- new -page ---------------------------- -->
<?php } else { 
  //<!-- is not logged in    log in-->
  //<li class="secondaryBtn"><span class="userIcon"></span><a id="toplink_login" class="gr" //href="login.php" target="_blank"></a></li>
  //<!-- is logged in    log out-->
  //<li class="secondaryBtn hidden"><span class="logoutIcon"></span><a id="toplink_logout" class="gr" href="index.php?loggedIn=0"></a></li>
 } ?>

  <!--<a id="hamburger" href="javascript:void(0);" onclick="topnav('myTopnav2')">☰</a>-->

</ul>
</div>
