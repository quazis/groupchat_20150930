<?php

function add_post($userid, $message){
    global $conn;
    $sql = "insert into posts (user_id, message, stamp) values ($userid, '". mysqli_real_escape_string($conn, $message). "',now())";
    $result = mysqli_query($conn, $sql);
}

function add_contact_us($userid, $message){
    global $conn;
    $sql = "insert into contact_us (user_id, message, stamp) values ($userid, '". mysqli_real_escape_string($conn, $message). "',now())";
    $result = mysqli_query($conn, $sql);
}

function add_comment($userid, $comment_userid, $message){
    global $conn;
    $sql = "insert into posts (user_id, comment_user_id, message, stamp) values ($userid, $userid, '". mysqli_real_escape_string($conn, $message). "', now())";
    $result = mysqli_query($conn, $sql);
}

function show_posts($userid){
    global $conn;
    $sql = "select * from posts where user_id = '$userid' and show_not_show = 'show' and comment_on_post_id is NULL order by stamp desc limit 10";
    $result = mysqli_query($conn, $sql);
    $posts = array();
    while($data = mysqli_fetch_object($result)){
        $posts[] = array('stamp' => $data->stamp, 'id' => $data->id, 'message' => $data->message, 'likes' => $data->likes, 'dislikes'=>$data->dislikes);
    }
    return $posts;
}

function show_users_following($user_id){
 global $conn;
 $users = array();
	$sql = "select users.id, username from users 
	        inner join following on users.id = following.user_id
                where following.follower_id='$user_id' and users.status='active'";
	$result = mysqli_query($conn, $sql);
	while ($data = mysqli_fetch_object($result)){
		$users[$data->id] = $data->username;
	}
	return $users;	
}

function show_followers($user_id){
 global $conn;
 $users = array();
	$sql = "select users.id, username from users 
	        inner join following on users.id = following.follower_id
                where following.user_id='$user_id' and users.status='active'";
	$result = mysqli_query($conn, $sql);
	while ($data = mysqli_fetch_object($result)){
		$users[$data->id] = $data->username;
	}
	return $users;	
}

function show_users_except($user_id){
        global $conn;
        
	$users = array();
	$sql = "select * from users 
		where status='active' and id != '$user_id'
		order by username";

	$result = mysqli_query($conn, $sql);

	while ($data = mysqli_fetch_object($result)){
		$users[$data->id] = $data->username;
	}
	return $users;
}

/////////////////////////////////////////////////////////////////////////////////
//ALL USERS + LATEST POST + STAMP + LIKE/DISLIKE + COMMENT
function for_03_all_users ($user_id){
        global $conn;
        
	$all_users = array();
	$sql = "select * from users 
		where status='active' and id != '$user_id'
		order by username";

	$result = mysqli_query($conn, $sql);

    while($data = mysqli_fetch_object($result)){
		$all_users[] = array('stamp' => $data->stamp,
								'id' => $data->id,
								'likes' => $data->likes,
								'dislikes' => $data->dislikes,
                                'message' => $data->message);
    }	
    return $all_users;
}
//////////////////////////////////////////////////////////////////////////////

// list all the users those I am following
function following($userid){
    global $conn;   
    $users = array();
    $sql = "select distinct user_id from following where follower_id = '$userid' and user_id in (SELECT id FROM `users` where status='active')";
    $result = mysqli_query($conn, $sql);
    while($data = mysqli_fetch_object($result)){
		array_push($users, $data->user_id);
    }	
    return $users;
}

// list all the users those follow me
function follower($userid){
    global $conn;   
    $users = array();
    $sql = "select distinct follower_id from following where user_id = '$userid' and follower_id in (SELECT id FROM `users` where status='active')";
    $result = mysqli_query($conn, $sql);
    while($data = mysqli_fetch_object($result)){
		array_push($users, $data->follower_id);
    }	
    return $users;
}

function check_count($first, $second){
    global $conn;
    
	$sql = "select count(*) from following 
			where user_id='$second' and follower_id='$first'";
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
		$sql = "delete from following 
				where user_id='$them' and follower_id='$me'
				limit 1";

		$result = mysqli_query($conn, $sql);
	}
}

function delete_post($id){
	global $conn;
	$sql = "delete from posts where id = $id";



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

function get_lastest_two_posts($userid){
    global $conn;
    $sql = "select * from posts where user_id='$userid'  and comment_on_post_id is NULL order by stamp desc limit 1";
	

    $result = mysqli_query($conn, $sql);

    $latest_posts = array();
    while($data = mysqli_fetch_object($result)){
		$latest_posts[] = array('stamp' => $data->stamp,
								'id' => $data->id,
								'likes' => $data->likes,
								'dislikes' => $data->dislikes,
                                'message' => $data->message);
    }	
    return $latest_posts;
}

function count_posts(){
    global $conn;
	$sql = "select count(*) as count from posts"; 
	$result = mysqli_query($conn, $sql);
	$count_posts = array();
	
	    while($data = mysqli_fetch_object($result)){
		$latest_posts[] = array('count' => $data->count);
    }	
    return $count_posts;
}

function all_count(){
    global $conn;
    $sql = "SELECT count(id) FROM `users` WHERE status='active' ";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_row($result);
    return $row[0];
}
//$allcount=all_count();

function follower_count($userid){
    global $conn;
    $sql = "SELECT count(*) FROM `following` where user_id = $userid and follower_id in (SELECT id FROM `users` where status='active')";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_row($result);
    return $row[0];
}
//$followercount=follower_count($userid);

function following_count($userid){
    global $conn;
    $sql = "SELECT count(*) FROM `following` where follower_id = $userid and user_id in (SELECT id FROM `users` where status='active')";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_row($result);
    return $row[0];
}
//$followingcount=following_count($userid);

function show_message_last()
{
    global $conn;
    $sql = "select a.user_id, a.message, a.stamp from posts a inner join (select user_id, Max(stamp) as MXDT from posts group by user_id) b on a.user_id=b.user_id and a.stamp=b.MXDT";
    $result = mysqli_query($conn, $sql);
    $messagelast = array();
    while($data = mysqli_fetch_object($result)){$messagelast[$data->user_id] = $data->message;}
    return $messagelast;
}

function post_for_comment($idpost) {
  global $conn;
  $sql = "select AA.id, comment_on_post_id, username, message, AA.stamp from posts AA join users BB on AA.user_id=BB.id where AA.id=$idpost";
  $result = mysqli_query($conn, $sql);
  $posts = array();
  while($data = mysqli_fetch_object($result)){
    $posts[] = array('userpost' => $data->username, 'stamp' => $data->stamp, 'message' => $data->message);  
  }
  return $posts;
}

function post_comments($idpost) {
    global $conn;
    $sql = "SELECT comment_on_post_id, user_id, username, message, a.stamp FROM `posts` a join users b on a.user_id=b.id WHERE comment_on_post_id =$idpost order by a.stamp desc limit 20";
    $result = mysqli_query($conn, $sql);
    $posts = array();
    while($data = mysqli_fetch_object($result)){
        $posts[] = array('usercomment' => $data->username, 'stamp' => $data->stamp, 'message' => $data->message);
    }
    return $posts;
}
?>
