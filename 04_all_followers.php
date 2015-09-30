<?php 
session_start();

include_once('header.php');
//include_once('login.php');
//include("activate.php");
//include_once('connect.php');
include_once('functions.php');
//include_once('action.php');
//include_once('activate.php');
//include_once('add.php');
//include_once('add_comment.php');
//include_once('add_contact_us.php');
//include_once('lock.php');

$userid = $_SESSION['userid'];

$allcount=all_count();
$followercount=follower_count($userid);
$followingcount=following_count($userid);

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
<a class="a2" href="03_all_users.php"> All Users <?php echo "(" .$allcount. ")"; ?> </a> | <a class="a2" href="04_all_followers.php">Followers <?php echo "(" .$followercount. ")"; ?> </a> | <a class="a2" href="05_all_following.php">You're Following <?php echo "(" .$followingcount. ")"; ?> </a>
</div>


<br><br>

<div class="inner" align="center">


<?php
if (isset($_SESSION['username'])){
	echo "<b>Hello! ". $_SESSION['username']." | find out your followers</b>";
	//unset($_SESSION['username']);
}
?>

<div class="all_users" align="center">
<?php
$folnonfol = ''; 
$users = show_followers($_SESSION['userid']);
$following = following($_SESSION['userid']);
$follower = follower($_SESSION['userid']);

if (count($users)){
?>
<table border="1" cellspacing="0" cellpadding="5" width="330">
<?php
foreach ($users as $key => $value){
	echo '<tr valign="top">';
		echo '<td>'.$value;

        if (in_array($key,$follower))
        { $folnonfol = '| following you';
        } else { $folnonfol = '';  //This user is not following you
        }

	if (in_array($key,$following)){
		echo ' <small><a href="action.php?id=' .$key. '&do=unfollow">unfollow</a>&nbsp' .$folnonfol. '</small>';
	}else{
		echo ' <small><a href="action.php?id=' .$key. '&do=follow">follow</a>&nbsp' .$folnonfol. '</small>';
	}
	echo '</td>';
	echo '</tr>';
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