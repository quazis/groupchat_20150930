<?php
session_start();
include_once("header.php");

$id = $_GET['id'];
$do = $_GET['do'];

function check_count($first, $second){
    global $conn;
	$sql = "select count(*) from following where user_id='$second' and follower_id='$first'";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_row($result);
	return $row[0];
}

function follow_user($me,$them){
global $conn;
	$count = check_count($me,$them);
	if ($count == 0){
		$sql = "insert into following (stamp, user_id, follower_id) values (now(), $them, $me)";
		$result = mysqli_query($conn, $sql);
	}
}

function unfollow_user($me,$them){
global $conn;
	$count = check_count($me,$them);
	if ($count != 0){
		$sql = "delete from following where user_id='$them' and follower_id='$me' limit 1";
		$result = mysqli_query($conn, $sql);
	}
}

function delete_post($id){
	global $conn;
	$sql = "update posts set show_not_show = 2 where id = $id";
        // 1 means show  - and 2 means not show
	$result = mysqli_query($conn, $sql);
	return $result;
}

function like_post($post_id){
    global $conn;
    $sql = "update posts set likes = likes + 1 where id = $post_id";   
    $result = mysqli_query($conn, $sql);  
}

function dislike_post($post_id){
    global $conn;
     $sql = "update posts set dislikes = dislikes +1 where id = $post_id";           
    $result = mysqli_query($conn, $sql);  
}



switch ($do){
	case "follow":
		follow_user($_SESSION['userid'],$id);
		$msg = "You have followed a user!";
	break;

	case "unfollow":	
		unfollow_user($_SESSION['userid'],$id);
		$msg = "You have unfollowed a user!";
	break;
	
	case "like":
		like_post($id);
		$msg = "You have liked a post!";
	break;

	case "dislike":
		dislike_post($id);
		$msg = "You have disliked a post!";
	break;
	
	case "delete":
		delete_post($id); 
		$msg = "You have deleted that post!";
	break;

}


$_SESSION['message'] = $msg;
header('Location: /02_welcome.php');
?>