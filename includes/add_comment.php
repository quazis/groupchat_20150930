<?php
session_start();
include_once("header.php");

// Get the userid
//$comment_user_id = $_SESSION['userid'];
$userid = $_SESSION['userid'];

// TODO truncate length to 160
$message = $_POST['message'];
$idc = $_POST['idcomment'];  //Id of the post where the user wants to comment

global $conn;
$sql = "insert into posts (user_id, comment_user_id, comment_on_post_id, message, stamp) values ($userid, $userid, $idc, '". mysqli_real_escape_string($conn, $message). "', now())";
$result = mysqli_query($conn, $sql);

$_SESSION['message'] = "Your comment successfully added.";

// Go back to the index page
header("Location: post_comment.php?id=" .$idc. "");

?>

