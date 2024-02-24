<?php
// Start the session
session_start();

// Unset all of the session variables
$_SESSION = array();

// Unset all session variables
session_unset();

// Destroy the session
session_destroy();

// Redirect the user to the login page
header("Location: login_signup.php");
exit();
