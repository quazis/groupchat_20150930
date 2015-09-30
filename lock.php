<?php
include('connect.php');
session_start();
$user_check = $_SESSION['username'];
$sql = "select username from users where username='$user_check' ";
$ses_sql = mysqli_query($conn, $sql);

$row = mysqli_fetch_array($ses_sql, MYSQLI_ASSOC);

$login_session=$row['username'];

if(!isset($login_session))
{
header("Location: index.php");
}
?>