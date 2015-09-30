<?php
session_start();
include_once('header.php');
include_once('functions.php');
$userid = $_SESSION['userid'];
$allcount=all_count();
$followercount=follower_count($userid);
$followingcount=following_count($userid);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>| groupCHAT</title>
<link rel="shortcut icon" type="image/ico" href="images/_ico_gc_icon_title.ico">

<!-- Bootstrap -->
<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/gc_style.css" rel="stylesheet" type="text/css">

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	
</head>
<body>
<!------------------------------------------------------------------------------------->
<nav class="navbar-fixed-top" id="gc-navbar-fixed-top">
  <div class="container-fluid"> 
    <!-- Brand and toggle get grouped for better mobile display -->
	<div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" id="collapse-button-for-mobile" data-toggle="collapse" data-target="#defaultNavbar1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>

      <a href="index.php"><img src="images/gc_icon_navbar.png" id="gc-icon-navbar"></img></a>		
	</div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="defaultNavbar1">
     
		<ul class="nav navbar-nav navbar-right">
			<li><a class="a2" href="07_send_post.php" id="gc-active"> [SEND A POST] </a></li>
			<li><a class="a2" href="03_all_users.php" id="gc-active"> All Users <?php echo "[" .$allcount. "]"; ?></a></li>
			<li><a class="a2" href="04_all_followers.php" id="gc-active">Followers <?php echo "[" .$followercount. "]"; ?></a></li>
			<li><a class="a2" href="05_all_following.php" id="gc-active">Following <?php echo "[" .$followingcount. "]"; ?></a></li>
			<li class="dropdown"><a href="#" class="dropdown-toggle" id="gc-dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">My Account<span class="caret"></span></a>
			  <ul class="dropdown-menu" role="menu" id="gc-dropdown-menu">
				<li><a href="#">History</a></li>
				<li class="divider"></li>
				<li><a href="#">Edit Profile</a></li>
				<li class="divider"></li>
				<li><a href="#">Contact Us</a></li>
				<li class="divider"></li>
				<li><a href="10_logout.php">Log Out</a></li>
			  </ul>
			</li>
		</ul>	  
    </div>
    <!-- /.navbar-collapse --> 
  </div>
  <!-- /.container-fluid --> 
</nav>
   
<!--------------------------------------------------------------------------------------------------------------------->
<div class="container-fluid" id="gc-welcome-container-fluid" align="center">
	<div class="row">
		<!------------------------------------------------------------------------------------->
		<div class="col-md-3" id="gc-welcome-r1-c1">
		
			<?php
if (isset($_SESSION['username'])){
echo "<h3>Welcome back <strong>". strtoupper($_SESSION['username'])."</strong>!</h3><hr>";
//unset($_SESSION['username']);
}
if (isset($_SESSION['message'])){
echo "<b id='message'>". $_SESSION['message']."</b><br>";
unset($_SESSION['message']);
}
?>

			<br>
			<img id="profile-pic" src="images/_myPIC_color.png" alt=""><hr><h4 align="left">Present Location: London, United Kingdom<br>Education: St Patrick's College, London<br>Born: Dhaka, Bangladesh<br>Interest: Playing Chess, Current Affairs, Artificial Intelligence, Robotic Technology, Travelling and Bird watching</h4><hr>
			
		</div>
		<!------------------------------------------------------------------------------------->		
		<div class="col-md-5" id="gc-welcome-r1-c2">
			<div class="posts" align="center">



<br>

<h3 id="label-post">Your Latest Posts | Read The Comments</h3><hr>

<div class="posts" align="center">

<?php
$posts = show_posts($_SESSION['userid']);

if (count($posts)){
?>

<table cellspacing='0' cellpadding='1' width='400'>	
<?php
foreach ($posts as $key => $list){
		//echo "<tr valign='top'>";
		echo $list['message']. "&nbsp<a href= 'post_comment.php?id=" .$list['id']. "'> more </a><br>" . "<small>" . $list['stamp']. "
		&nbsp &nbsp&nbsp&nbsp LIKED<strong> [" . $list['likes'] . "] </strong>&nbsp | &nbsp<strong> [" . $list['dislikes'] . "] </strong>DISLIKED &nbsp &nbsp &nbsp<a href= 'action.php?id=" . $list['id'] . "&do=delete'><img src='images/delete.png' style='width:50px;height:13px' alt='Delete'></a><hr></small>";
		   		
	}
?>
</table>
<br>

<?php
}else{
?>
<p><b>You have not posted any message yet.</b></p>
<?php
}
?>
</div>



<h3 id="label-post">Posts | You're Following | Make Comments</h3><hr>

<div class="posts" align="center">

<?php
$users = show_users_following($_SESSION['userid']);

if (count($users)){
?>

<?php
// $key holds the user_id

foreach ($users as $key => $value){
	echo "<b>".$value."</b> : ";
	$latest_posts = get_lastest_two_posts($key);
?>
<table border='0' cellspacing='0' width='315' align="center">	
<?php
foreach ($latest_posts as $key => $list){
		//echo "<tr valign='top'>";
		echo $list['message'] . "&nbsp<a href= 'post_comment.php?id=" .$list['id']. "'> more </a><br>" . "<small>" . $list['stamp'] . " &nbsp&nbsp<a href='action.php?id=" . $list['id'] . "&do=like' > <img src='images/like.png' alt='Like' style='width:25px;height:20px' /></a>&nbsp" . $list['likes'] . "&nbsp |&nbsp " . $list['dislikes']. "<a href='action.php?id=" . $list['id'] . "&do=dislike' > <img src='images/dislike.png' alt='Like' style='width:25px;height:20px' /></a>&nbsp comment<a href='post_comment.php?id=" .$list['id']. "' >&nbsp <img src='images/comment.png' style='width:20px;height:25px' alt='Comment'></a><hr></small>";  
		
	}
?>
	</table>
	<br>
<?php
}
?>

<?php
}else{
?>
<p><b>You&apos;re not following anyone yet.</b></p>
<?php
}
?>

</div>
</div>
		</div>
		<!------------------------------------------------------------------------------------->
		<div class="col-md-3" id="gc-welcome-r1-c1">
					<iframe id="iframe-welcome" src="http://www.youtube.com/embed/XGSy3_Czz8k?autoplay=1">
</iframe>
		
		<h3>Latest Events</h3><hr><h4 align="left">Rugby World Cup 2015: England can beat Australia - Guscott</h4><img id="latest-event" src="images/008.jpg" alt=""><hr>


			
		</div>
		<!------------------------------------------------------------------------------------->	
	</div>
</div>

<!------------------------------------------------------------------------------------->
  
<div class="container-fluid" id="gc-index-container-5" align="center">  
  <div class="navbar-fixed-bottom" id="gc-navbar-fixed-bottom" align="center">
      <p>Copyright &copy; 2015 &middot; All Rights Reserved &middot;<a href="http://yourwebsite.com/" id="footer-groupchat">groupCHAT</a></p>
  </div>
</div>

<!------------------------------------------------------------------------------------->

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="js/jquery-1.11.2.min.js"></script>

<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="js/bootstrap.js"></script>

</body>
</html>


<!-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->

<!--
<!DOCTYPE html>
<html>
<head>
<title>groupCHAT</title>
<meta charset="UTF-8">
<link rel="stylesheet" href="css/style.css">
</head>
<body>
<div id="container" align="center">

<div class="top_buttons" align="center">
<a href="09_contact_us.php"><input type="submit" value="Contact Us"></a>&nbsp<a href="10_logout.php"><input type="submit" value="    Logout    "></a>
</div>

<a class="a2" href="03_all_users.php"> All Users <?php echo "(" .$allcount. ")"; ?> </a> | <a class="a2" href="04_all_followers.php">Followers <?php echo "(" .$followercount. ")"; ?> </a> | <a class="a2" href="05_all_following.php">You're Following <?php echo "(" .$followingcount. ")"; ?> </a><br>


<div class="inner" align="center">

<?php
if (isset($_SESSION['username'])){
echo "<h3>Welcome back ". $_SESSION['username']."</h3>";
//unset($_SESSION['username']);
}
if (isset($_SESSION['message'])){
echo "<b id='message'>". $_SESSION['message']."</b><br>";
unset($_SESSION['message']);
}
?>

<a href="07_send_post.php"><input type="submit" value="   SEND A NEW POST   "></a><br>

<strong>Your Latest Posts | Read The Comments</strong>

<div style="border-width: 2px; border-style: solid; border-color: rgba(0, 0, 0, 0.7); " class="posts" align="left">

<?php
$posts = show_posts($_SESSION['userid']);

if (count($posts)){
?>

<table border='1' cellspacing='0' cellpadding='1' width='315'>	
<?php
foreach ($posts as $key => $list){
		//echo "<tr valign='top'>";
		echo $list['message']. "&nbsp<a href= 'post_comment.php?id=" .$list['id']. "'> more </a><br>" . "<small>" . $list['stamp']. "
		&nbsp &nbsp&nbsp&nbsp<img src='images/like.png' alt='Like' style='width:17px;height:14px' />[" . $list['likes'] . "] &nbsp | &nbsp [" . $list['dislikes'] . "]<img src='images/dislike.png' alt='Like' style='width:17px;height:14px'/><a href= 'action.php?id=" . $list['id'] . "&do=delete'>&nbsp &nbsp &nbsp<img src='images/delete.png' style='width:50px;height:13px' alt='Delete'></a><br><hr> </small>";
		   		
	}
?>
</table>
<br>

<?php
}else{
?>
<p><b>You have not posted any message yet.</b></p>
<?php
}
?>
</div>



<strong>Posts | You're Following | Make Comments</strong>

<div style="border-width: 2px; border-style: solid; border-color: rgba(0, 0, 0, 0.7); " class="posts" align="left">

<?php
$users = show_users_following($_SESSION['userid']);

if (count($users)){
?>

<?php
// $key holds the user_id

foreach ($users as $key => $value){
	echo "<b>".$value."</b> : ";
	$latest_posts = get_lastest_two_posts($key);
?>
<table border='1' cellspacing='0' width='315'>	
<?php
foreach ($latest_posts as $key => $list){
		//echo "<tr valign='top'>";
		echo $list['message'] . "&nbsp<a href= 'post_comment.php?id=" .$list['id']. "'> more </a><br>" . "<small>" . $list['stamp'] . " &nbsp&nbsp<a href='action.php?id=" . $list['id'] . "&do=like' > <img src='images/like.png' alt='Like' style='width:25px;height:20px' /></a>&nbsp" . $list['likes'] . "&nbsp |&nbsp " . $list['dislikes']. "<a href='action.php?id=" . $list['id'] . "&do=dislike' > <img src='images/dislike.png' alt='Like' style='width:25px;height:20px' /></a>&nbsp comment<a href='post_comment.php?id=" .$list['id']. "' >&nbsp <img src='images/comment.png' style='width:20px;height:25px' alt='Comment'></a></small>";  
		
	}
?>
	</table>
	<br>
<?php
}
?>

<?php
}else{
?>
<p><b>You&apos;re not following anyone yet.</b></p>
<?php
}
?>

</div>

</div>
</div>
</body>
</html>
-->