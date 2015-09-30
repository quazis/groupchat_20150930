<?php
include_once('header.php');


session_start();
if($_SERVER["REQUEST_METHOD"] == "POST")
{
// username and password sent from Form
$myusername = mysqli_real_escape_string($conn,$_POST['username']); 
$mypassword = mysqli_real_escape_string($conn,$_POST['password']); 

$sql = "SELECT id FROM users WHERE username='$myusername' and password='$mypassword' and activation is null";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

$id=$row['id'];
$count=mysqli_num_rows($result);

// If result matched $myusername and $mypassword, table row must be 1 row
if($count==1)
{
	$_SESSION['userid'] = $id;
	$_SESSION['username'] = $myusername;

	header("Location: 02_welcome.php");
	
//function add_session($userid){
    //global $conn;
	$sql = "INSERT INTO sessions (user_id, stamp_login) VALUES($id, now())";
	$result = mysqli_query($conn, $sql);
	//}
}
else 
{
	$_SESSION['message']="Invalid username or password. Please try again.";
}
}
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

<div class="container-fluid" id="gc-index-container-1" align="center">
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <img src="images/groupCHAT_icon_ORANGE.png" id="groupchat-icon"></img>
    </div>
  </div>
</div>
   
<!------------------------------------------------------------------------------------->




<?php
if (isset($_SESSION['message'])){
	echo "<b id='message'>". $_SESSION['message']."</b>";
	unset($_SESSION['message']);
}
?>

<div class="container" id="gc-index-container-3" align="center">
	<div class="row" align="center">
		<div class="col-md-8 col-md-offset-2" id="gc-login">
			<div class="container-fluid">
				<form action="" method="post">
					<div class="col-md-5">
					<h4 align="left" id="label-1">Email</h4>
					<input type="text" id="login-email" name="username" placeholder="Email"/><br>
					<h4 align="left" id="label-1">Keep my email saved in</h4>
					</div>
					<div class="col-md-5">
					<h4 align="left" id="label-1">Password</h4>
					<input type="password" id="login-password" name="password" placeholder="Password"/><br>
					<h4 align="left" id="label-1">Forgotten your password?</h4>
					</div>
					<div class="col-md-2">
					<input type="submit" id="login-button" value="LOG IN" /><br >
					</form><br>
					</div>
			</div>	
		</div>
	</div>
</div>



<!------------------------------------------------------------------------------------->

<div class="container" id="gc-index-container-4">
	<div class="row">
		<div class="col-md-8 col-md-offset-2" id="create-account">
			<div class="col-md-6" align="right">
			<br><br>
				<h3>Create a free account</h3><hr>
				<h4>Groupchat is a personalized micro bloging site that helps you to share your views on different matters, make comments on current issues. TERMS: The “groupCHAT” connects societies everywhere. Any registered user can send a blog, which is a message of 160 characters or less but any racial or abusive contents will be treated as illegal activity.</h4><hr>
			</div>
<!--  ------------------------------------------------------------------------------------------------------------------
<form action="newuser.php" method="post">
<input type="text" name="email"/><br/>
<label>Enter a valid email address</label><br>

<input type="text" name="username"/><br>
<label>Choose a Username</label><br>

<input type="password" name="password"><br>
<label>Set a password</label><br><br>
<div class="posts" align="center">

<p class="para">TERMS & CONDITIONS: The “groupCHAT” connects societies everywhere. Any registered user can send a blog, which is a message of 160 characters or less but any racial and abusive contents will be treated as illegal activity. Privacy Policy is intended to limit any legal defenses or objections that you may have to a third party, including a government, request to disclose your information.<br>
<input id="policy" name="agree" type="checkbox" value="true"/><label for="policy">&nbsp I accept terms and conditions.</label></p>
</div>
<b>Please submit & check your email address</b>
<br><br><input type="submit" name="submit" value="               SUBMIT               "/>
</form>
-----------------------------------------------------------------------------------------------------------------------------------------------------   -->			
			<div class="col-md-6" align="center">
				<form action="newuser.php" method="post">
				<br>
				<h4 align="left" id="label-2">Enter a valid email address</h4>
				<input type="text" id="create-account-email" name="email" placeholder="Email"/>
				
				<h4 align="left" id="label-2">Enter your name</h4>
				<input type="text" id="create-account-email" name="username" placeholder="Name"/><br>
				<h4 align="left" id="label-2">Set your password</h4>
				<input type="password" id="create-account-email" name="password" placeholder="Password"><br>
			<div class="posts" align="center">
				<p class="para">
					<input id="policy" name="agree" type="checkbox" value="true"/><strong align="left" id="label-2" for="policy">I accept terms and conditions.</strong>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</p>
			</div>
				<input type="submit" name="submit" id="create-account-button" value="SUBMIT"/>
				</form>
			</div>	
		</div>
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


<?php
// Close db connection
mysqli_close($connection);
?>


<!--

<!DOCTYPE html>
<html>
<head>
<title>groupCHAT</title>
<meta charset="UTF-8">
<link rel="stylesheet" href="css/style.css">
</head>
<body>
<div id="container">
<div class="inner" align="center">

<br><br><br><h4>Login for existing users</h4>

<?php
if (isset($_SESSION['message'])){
	echo "<b id='message'>". $_SESSION['message']."</b>";
	unset($_SESSION['message']);
}
?>

<form action="" method="post">
<input type="text" name="username"/><br>
<label>Username</label><br>
<input type="password" name="password"/><br>
<label>Password</label><br>
<input type="submit" value="               LOGIN                "/><br >
</form><br>

<h3><a class="a" href="01_registration.php">Sign Up for new users</a></h3><br>
<strong>Lost your login details</strong><br>
<form action="" method="post">
<input type="password" name="password"/><br>
<label>Email</label><br>
<input type="submit" value="              SUBMIT              "/><br >
</form>

</div>
</div>
</body>
</html>

-->