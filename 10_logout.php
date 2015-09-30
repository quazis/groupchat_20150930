<?php
session_start();

function add_session($userid){
    global $conn;
	$userid = $_SESSION['userid'];
	
	$sql = "INSERT INTO sessions (user_id, stamp_logout) VALUES($userid, now())";
	$result = mysqli_query($conn, $sql);
}
if(session_destroy())
{
header("Location: index.php");

}
?>