<?php 
session_start();

include_once('header.php');
include_once('functions.php');


?>

<!DOCTYPE html>
<html>
<head>
<title>groupCHAT</title>
<meta charset="UTF-8">
<link rel="stylesheet" href="css/style.css">
</head>
<body>
<div id="container">

<div class="top_buttons" align="center">
<a href="02_welcome.php"><input type="submit" value="  Back  "></a><a href="02_welcome.php"><input type="submit" value=" Home "></a><a href="10_logout.php"><input type="submit" value="Logout"></a><br>
<a class="a2" href="03_all_users.php"> All Users</a> | <a class="a2" href="04_all_followers.php">Followers</a> | <a class="a2" href="05_all_following.php">You're Following</a> | <a class="a2" href="06_all_posts.php">All Posts</a>
</div>


<br><br>

<div class="inner" align="center">


<?php
if (isset($_SESSION['username'])){
	echo "<b>Hello! ". $_SESSION['username']." | explore through all posts</b>";
	//unset($_SESSION['username']);
}
?>

<div class="all_users" align="center">
<?php

$users = show_users_except($_SESSION['userid']);
$following = following($_SESSION['userid']);

if (count($users)){
?>
<table border='1' cellspacing='0' cellpadding='5' width='330'>
<?php
foreach ($users as $key => $value){
	echo "<tr valign='top'>\n";
		echo "<td>".$value;
	if (in_array($key,$following)){
		echo " <small>
		<a href='action.php?id=$key&do=unfollow'>unfollow</a>
		</small>";
	}else{
		echo " <small>
		<a href='action.php?id=$key&do=follow'>follow</a>
		</small>";
	}
	echo "</td>\n";
	echo "</tr>\n";
}
?>

<?php

?>
</table>
<?php
}else{
?>
<p><b>There are no users in the system!</b></p>
<?php
}
?>
</div>
<?php 
//include_once('footer.php');
?>

</div>
</div>
</body>
</html>