<?php
session_start();
$thisPage = 'login.php';
include_once('functions.php');
$conn = getDBConn();
?>

<!--
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>
          -Omakoti        </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta content="Listing of free events and happenings in your city" name="description" />

        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
            <script src="https://code.jquery.com/jquery-1.12.4.js"></script> 
            <script src="main.js"></script> 







<link rel="stylesheet" href="https://rawgit.com/outboxcraft/beauter/master/beauter.min.css">

<link rel="stylesheet" href="main.css">
</head>
<body>

<div class="container" style="height:unset">
<ul class="topnav" id="myTopnav2" style="color: rgba(46,62,72,.6)"> 
  <li>
    <a href="#beauter" class="brand">....</a>
  </li>
</ul>
</div>

-->
<?php
/* =================================== POST ======================================= */
// init
// users
$countryId = $langId = $isCompany = $name = $areaId = $cityId = $address = $address2 = $img = $email = $password = $phone = $userSinceDate = $active = "";
$register = $remember = $accept1 = $accept2 = '';

if (isset($_GET['register'])) {
  $register = filter_input( INPUT_GET, 'register', FILTER_SANITIZE_URL );
  $register = test_input($register);
  $thisPage .= '?register=1';
}
$returnto = ''; // redirect after login back to sending page
if (isset($_GET['returnto'])) {
  //$returnto = '&returnto=' . filter_input( INPUT_GET, 'returnto', FILTER_SANITIZE_URL );
  $returnto = filter_input( INPUT_GET, 'returnto', FILTER_SANITIZE_URL );
}


if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST')
{
	if(isset($_POST['email'])) 	  { $email = 	 test_input($_POST["email"]); } // simple_crypt( $str, $action = 'e' )
	if(isset($_POST['uPw'])) 	  { $password =  test_input($_POST["uPw"]); }
	if(isset($_POST['remember'])) { $remember =  test_input($_POST["remember"]); }
	if(isset($_POST['accept1']))  { $accept1 =   test_input($_POST["accept1"]); }
	if(isset($_POST['accept2']))  { $accept2 =   test_input($_POST["accept2"]); }
	if(isset($_POST['returnto']))  { $returnto =   test_input($_POST["returnto"]); }




    //echo "<br>Before - email: " . $email;
    //echo "<br>Before - password: " . $password;
	$scrambled_email = simple_crypt(test_input($_POST["email"]),'e');
	$scrambled_password =   simple_crypt(test_input($_POST["uPw"]),'e512');
	//echo "<br>After - email: " . strlen($email) . ' ' . $email;
	//echo "<br>After - email decrypted BACK: " . simple_crypt($email,'d');
    //echo "<br>After - password: " . strlen($password) . ' ' . $password . '<br><br>';
	//foreach($_POST as $key=>$post_data){
    //    echo "<br>You posted:" . $key . " = " . $post_data . "<br>";
    //}

	// ============================== IF USER EXISTS - SESSION REDIRECT EXIT ====================================
    // check users email and password from DB
    $userSafeId = verifyUserLoginData($scrambled_email, $scrambled_password, $conn);

	//echo "<br>Saving in session and then redirecting -  userSafeId:  $userSafeId";

	if($userSafeId != '') {
		// save in session
		$userDataArr = explode('#', $userSafeId . "###"); // fUHRwvFE9m#Tauno Testaaja
		//saveInSession($userSafeId,$userName,$pref1,$pref2,$pref3)
		saveInSession($userDataArr[0],$userDataArr[1],$userDataArr[2],$userDataArr[3],$userDataArr[4]);

		// redirect to sending page
		header('HTTP/1.1 302 Redirect');
		echo "<br>returnto: $returnto<br>";
		if($returnto != '') {
			$returnto = ''.$returnto.'.php';
			header("Location: $returnto?loggedIn=1");
		} else {
			header('Location: index.php?loggedIn=1');
		}
		exit;
	}

}
/* ========================================================================== */
include_once('header.php'); // moved from row 9
echo '<input id="phpPageName" type="hidden" value="login"> '; // moved from row 9
?>

<div class="bg">
	<div>
		<div class="content">

			<div class="row">
				<div class="col m7">
					<div  class="row iCol2">
	<!-- ======================================================================== -->
						<div class="col m12">
						<?php if($register == '1') { 
							echo '<h1 id="register_title" style="margin:0">[Skapa konto]</h1>';
						} else {
							echo '<h1 id="login_title" style="margin:0">[Logga in på Stuffonaut]</h1>';
						} ?>
							
							<b>Med ett konto på Stuffonaut kan du göra allt detta:</b><br>
							<b><span id="register_contentTitle"></span></b>
							<ul id="register_contentText"></ul>
							<?php
    							echo "<br>You posted email: " . $email;
    							echo "<br>You posted password: " . $password;
							?>
						</div>	
					</div>
				</div>
				<div class="col m5">
					<form class="row" action="<?php echo $thisPage; ?>" method="post">
							<div class="col m12">
								<div class="row _noPadding" style="background-color:#f1f1f1">
									<div class="col m12">
										<?php
											$thisPage2 = $thisPage;
											if(strpos($thisPage2,'?') != false) { $thisPage2=explode('?', $thisPage2)[0]; }

			      							if($register == '1') { echo '<b>Skapa konto <span id="rSide">eller <a href="' . $thisPage2 . '">logga in</a></span></b>'; 
			      							} else {
			      								echo '<b>Logga in <span id="rSide">eller <a href="' . $thisPage . '?register=1">skapa konto</a></span></b>';
			      							} 
			      						?>

										<p>Du behöver ett konto för att fortsätta.<br><br>
										
										<p>	
<?php
/* =============== do login check =============== */
$email_err = $password_err = $accept1_err = $accept2_err = null;

if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST')
{
	if($register == '1') {
		/* =============== REGISTER USER =============== */
		// register
		// validate email
		echo "<br>VALIDATING USER:<br>";
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { $email_err = lineErr("emailFormat"); }
	    if(strlen(validLen($email, 3, 30)) != 1) { $email_err .= lineErr("emailLength"); } 
		// ================= TODO: validate pw 1 num, 1 capital
		if(strlen(validLen($password, 6, 30)) != 1) { $password_err = lineErr("passwordLength"); }
		if($accept1 != '1,') { $accept1_err = lineErr("terms"); }
		if($accept2 != '1,') { $accept2_err = lineErr("privPolicy"); }

/* =============== CHECK IF USER ALREADY EXISTS IN DB =============== */
echo "<br>checking if user already  exists:<br>";
// check if user exists
$tempData = doesEmailExistInDB($email, $conn);
if($tempData != '') {
	// error, email already in DB
	$email_err .= '<br>Your email has been registered already.';
	echo "<br>email_err: $email_err";
}
/* =============== SAVE USER IN DB =============== */
if($email_err . $password_err . $accept1_err . $accept2_err == ''){
	// save in db
	echo '<br>SAVING NEXT'; 
	$countryId = 1;
	$langId = 1;
	createUser($countryId, $langId, $email, $password, $conn);
	echo "<br>createUser: $countryId $langId  $email  $password";
// ================= continue here	- redirect to front page or where user was

	} else {
		echo '<b style="color:red">There were errors</b><br>';
	}
} else {
	// login
	//$tempData = getUserId('teppo.testaaja68@gmail.com', 'salasana', $conn);
	$tempData = getUserId($email, $conn);
	// if($tempData == '') { echo '<br>USER NOT FOUND: ' . $tempData; }
	//echo '<br>Verifying user: ' . $email;
	//echo '<br>Verifying password: ' . $password;
	//if($remember == '1,') { echo '<br>Remember 1'; }
// ================= TODO: scramble email & password
		if($tempData != '') {
			$tempArr = explode('#', $tempData);
			$userId = $tempArr[0];
			$userName = $tempArr[1];

			echo 'Welcome back, ' . $userName;
		} else {
			 echo '<b style="color:red">Error, please check email and/or password.</b>';
		}
	} // end login
} 
// $email_err = $password_err = $accept1_err = $accept2_err = null;
?>
										<div class="col m12"> 							
											<label for="email">[E-postadress]</label>
			      							<input class="_full-width" type="text" name="email" value="tauno@jossain.com">
											<?php echo $email_err; ?>
			      						</div>
			      						<div class="col m10"> 
											<label for="uPw">[Lösenord]</label>
			      							<input class="_full-width" type="password" id="uPw" name="uPw" style="font-size:24px" value="Salasana1">
											<?php echo $password_err; ?>
											<?php /*
											if($password_err != '') { echo '<b style="color:red">' . $password_err . '</b>'; } 
			      							if($register == '1') { echo '<span style="float:left;color:gray">Minst 8 tecken</span>'; } */ ?>
			      						</div>
										<div class="col m2">
											<!--<a id="showPwToggle" style="margin-top:30px;float:left">Visa</a>-->
										</div>
<!--
<label for="email">E-postadress</label>
<label for="uPw">Lösenord</label>
<span class="checkText terms">Kom ihåg mig på denna enhet</span>
<span class="checkText terms">Jag accepterar Användarvillkoren för Stuffonaut</span>
<span class="checkText terms">Jag accepterar Personuppgiftspolicyn</span>

id="register_rememberOnThisDevice"
id="register_acceptTerms"
id="register_privacyPolicy"

-->
										<div class="col m12 inlineControls registerCheckboxes" style="left:3px;display: flex">

											<?php /*
										    <div id="remember_1" class="myCheck myCheckbox" style="border-color:#979898"></div><span id="register_rememberOnThisDevice" class="checkText terms"></span>
											*/ ?>
										    <input id="remember" name="remember" type="hidden"  value="">

										<?php
											if($register == '1') { ?>  
										    <br><br>
										    <div id="accept1_1" class="myCheck myCheckbox" style="border-color:#979898"></div><span id="register_acceptTerms" class="checkText terms"></span>
										    <input id="accept1" name="accept1" type="hidden"  value=""><?php echo $accept1_err; ?>

										    <br><br>
  											<div id="accept2_1" class="myCheck myCheckbox" style="border-color:#979898"></div><span id="register_privacyPolicy" class="checkText terms"></span>
  											<input id="accept2" name="accept2" type="hidden"  value=""><?php echo $accept2_err; ?>
  											
  										<?php } ?>
										</div>
										
										<?php
											if($register == '1') {
										 echo '<input id="registerBtn" type="submit" class="btn logInBtn" value="[Skapa konto]">';
										 //echo '<span style="float:left;color:gray">Du måste vara minst 16 år gammal för att skapa ett konto</span>';
										} else {

										 echo '<input id="loginButton" type="submit" class="btn logInBtn" value="[Logga in]">';
										 //echo '<br><a style="color:#2979cc;font-weight:600">Glömt lösenordet?</a>';
										} ?>
				      				</div>
								</div>
							</div>
							<input id="returnto" name="returnto" type="hidden" value="<?php echo $returnto; ?>">
						</form>
					
				</div>
			</div> <!-- row -->

			<footer class="row">
				
			</footer>
	

        </div>
    </div>




</div> <!-- bg -->
<?php include_once('footer.php'); ?>
<?php
/* ========================== functions =============================== 
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
*/

?>