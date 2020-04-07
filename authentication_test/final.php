<?php
session_start();


// new.php page:

/*


init:
hidden login form (addClass hidden)
show ad form (removeClass hidden)
show login button (removeClass hidden)
hidden logout button (addClass hidden)


if ad form was submitted (post)
	if form PHP valid: 
	 	if not logged in:
	 	 	save in session (is now logged in)
	 	 	save cookie (if remember on this device was selected)
	 	save user
	 	save company info
	 	save ad
	else (form not PHP valid)
		show validation errors
else // ----------------- no ad form was submitted -----------------
	if login form was submitted (post)
		if login form valid
			login_user()
			hide login button, show logout button, show userName
	 	else (login form not valid)
	 		show validation errors
	else (no login form was submitted)
		if has loggedIn cookie
			check user exists
			hide login button, show logout button, show userName
		else
			if has userName cookie - get user name for login form - - - - - - - - - - - - is this needed???
		
			----------------- if nothing has been done -----------------------
			if user is in session (is logged in)
				hide login button, show logout button, show userName
				if editAd id was submitted (post)
					show existing ad
					hide save button
					show save changes button
			
			if logout form was submitted (post)
				log user out
				redirect to index.php


--------- jQuery: ---------
if login button is clicked (jQuery)
			show login form
			hide ad form


function login_user($userName,$pw) {
	if(userExists($username,$password)) {
		//user found
		save in session()
	} else { // (no user found)
		show whole ad form
		show login button
	}
}
function userExists($username,$password) {
	// Look up the user
    $query = sprintf("SELECT user_id, username FROM users " .
                     " WHERE username = '%s' AND " .
                     "       password = '%s';",
                     $username, crypt($password, $username));
    $results = mysql_query($query);

    if (mysql_num_rows($results) == 1) {
      $result = mysql_fetch_array($results);
      $user_id = $result['user_id'];
      setcookie('user_id', $user_id);
      setcookie('username', $result['username']);
      return true;
      //exit();
    } else {
      // If user not found, issue an error 
      showError("Your username/password combination was invalid.");
      return false;
    }
}
function showError($str) {
	echo $str;
}

function save in session($username,$user_id='') {
	$_SESSION['username'] = $username;
	if($user_id != '') { $_SESSION['user_id'] = $user_id; }
}
function getCookie($name) {
	if (!isset($_COOKIE[$name])) { return $_COOKIE[$name]; }
	return NULL; 
}
function save in cookie($username,$user_id='') {
	setcookie('user_id', $user_id);
 	setcookie('username', $username');
}
-------------------------------------------------
if login button clicked (POST):
check if has cookie - get user name
hide form, show only login fields (with user name already in place)


*/
-----------------------------------------------------------------------------------
// check if user has cookie
if (isset($_COOKIE['user_id'])) {
	$username = mysql_real_escape_string(trim($_COOKIE['user_id']));
}

-----------------------------

// If the user is logged in, the user_id cookie will be set
if (!isset($_COOKIE['user_id'])) {
 // See if a login form was submitted with a username for login
 if (isset($_REQUEST['username'])) {
 // Try and log the user in
 $username = mysql_real_escape_string(trim($_REQUEST['username']));
 $password = mysql_real_escape_string(trim($_REQUEST['password']));
 // Look up the user
 // If user not found, issue an error
 } 




?>



 
 