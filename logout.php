<?php
// Initialize the session
session_start();
 
// Unset all of the session variables
$_SESSION = array();
 
// Destroy the session.
session_destroy();
 
if (isset($_GET['type'])) {
    if ($_GET['type'] == 1) {
        header("location: admin/login.php");
        exit;
    }
}
// Redirect to login page
header("location: login.php");
exit;
?>