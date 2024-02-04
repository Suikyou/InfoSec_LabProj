<?php
// Start the session if it's not already started
session_start();

// Unset all of the session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect the user to the login page
header("Location: http://localhost/phpcodes/crud_app/InfoSec/login.php");
exit;
?>
