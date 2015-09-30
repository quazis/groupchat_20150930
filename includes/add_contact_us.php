<?php
session_start();
include_once("header.php");
include_once("functions.php");

// Get the userid
$userid = $_SESSION['userid'];

// TODO truncate length to 160
$message = $_POST['message'];

add_contact_us($userid, $message);

$_SESSION['message'] = "Your message received.";

// Go back to the index page
header("Location:02_welcome.php");

?>

