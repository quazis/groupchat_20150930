<?php
session_start();

include_once('header.php');
include_once('functions.php');
$userid = $_SESSION['userid'];
$id = $_GET['id'];
$username = $_SESSION['username'];
?>

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
<a href="02_welcome.php"><input type="submit" value=" Home "></a><a href="09_contact_us.php"><input type="submit" value="Contact Us"></a>&nbsp<a href="10_logout.php"><input type="submit" value="    Logout    "></a> </div>
<div class="inner" align="center">
<?php
if (isset($_SESSION['username'])){
echo 'Hello '. $username. '';
}

echo '<div style="border-width: 2px; border-style: solid; border-color: rgba(0, 0, 0, 0.7); " class="posts" align="left">';

$posts = post_for_comment($id);
if (count($posts)){
    foreach ($posts as $key => $list){
	echo $list['userpost'] . "&nbsp&nbsp&nbsp" . "<small>" . $list['stamp'] . "<br>" .$list['message']. "</small>";
      }
    }
?>
</div>
<?php
echo '<div style="border-width: 2px; border-style: solid; border-color: rgba(0, 0, 0, 0.7); " class="posts" align="left">';
echo '<small>comments: - - -<br></small>';
$posts = post_comments($id);
if (count($posts)){
    foreach ($posts as $key => $list){
	echo $list['usercomment'] . "&nbsp&nbsp&nbsp" . "<small>" . $list['stamp'] . "<br>" .$list['message']. "</small><br>";
      }
    }
?>
</div>
<small>Send a comment [160 characters]</small>
<form method='post' action='add_comment.php'>
<textarea name='message' rows='4' cols='45' ></textarea>
<input type='hidden' name='idcomment' value = "<?php echo $id;?>">
<input type='submit' value='     SUBMIT     '/>
</form>
</div>
</div>
</body>
</html>