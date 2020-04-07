<?php
session_start();




// check if user in session (is logged in)
if (!isset($_SESSION['user_id'])) {
 	// setcookie here

 	// set user_id in session
	if (!isset($_SESSION['user_id'])) {

		 // if login form was submitted with a username for login
		 if (isset($_POST['username'])) {
			// Try and log the user in
			$username = mysql_real_escape_string(trim($_REQUEST['username']));
			$password = mysql_real_escape_string(trim($_REQUEST['password']));

			 // Look up the user
    		$query = sprintf("SELECT user_id, username FROM users " .
                " WHERE username = '%s' AND " .
                "       password = '%s';",
            $username, crypt($password, $username));

			 $results = mysql_query($query);
			if (mysql_num_rows($results) == 1) {
				 $result = mysql_fetch_array($results);
				 $user_id = $result['user_id'];
				 // No more setcookie
				 $_SESSION['user_id'] = $user_id;
				 $_SESSION['username'] = $username;
				 header("Location: show_user.php");
			 } else {
				 // If user not found, issue an error
				 $error_message = "Your username/password combination was invalid.";
			 }
		 }
	}
} else {
	// user is logged in
	// hide login fields from form
	// show Log out -link
}