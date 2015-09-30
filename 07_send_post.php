<?php 
session_start();

include_once('header.php');

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
<a href="02_welcome.php"><input type="submit" value="  Back  "></a><a href="02_welcome.php"><input type="submit" value=" Home "></a><a href="10_logout.php"><input type="submit" value="Logout"></a>
</div>

<br><br>

<div class="inner" align="center">


<?php
if (isset($_SESSION['username'])){
	echo "<h4>Hello! ". $_SESSION['username'].", It's great!!!</h4>";
	//unset($_SESSION['username']);
}
?>


<br><br><form method='post' action='add.php'>
<b>Send a post [160 characters]</b>
<textarea name='message' rows='7' cols='40' ></textarea>
<input type='submit' value='     SUBMIT     '/>
</form>

</div>
</div>
</body>
</html>