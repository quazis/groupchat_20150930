<?php
session_start();
include_once("header.php");

function add_post($userid, $message){
    global $conn;
    $sql = "insert into posts (user_id, message, stamp) values ($userid, '". mysqli_real_escape_string($conn, $message). "',now())";
    $result = mysqli_query($conn, $sql);
}

// Get the userid
$userid = $_SESSION['userid'];

// TODO truncate length to 160
$message = $_POST['message'];

add_post($userid, $message);

$_SESSION['message'] = "Your post successfully added.";

// Go back to the index page
header("Location:02_welcome.php");

?>

