<!DOCTYPE html>
<html>
<head>
<title>groupCHAT</title>
<meta charset="UTF-8">
<link rel="stylesheet" href="css/style.css">
</head>

<body>
<div id="container" align="center">
<div class="inner"><br><br><br><br><br><br>


<?php

include_once('header.php');

if (isset($_GET['email']) && preg_match('/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/', $_GET['email']))
{
    $email = $_GET['email'];
}
if (isset($_GET['key']) && (strlen($_GET['key']) == 32))//The Activation key will always be 32 since it is MD5 Hash
{
    $key = $_GET['key'];
}
if (isset($email) && isset($key))
{
    // Update the database to set the "activation" field to null
    $query_activate_account = "UPDATE users SET activation=NULL WHERE(email ='$email' AND activation='$key') LIMIT 1";   
    $result_activate_account = mysqli_query($conn, $query_activate_account) ;

    // Print a customized message:
    if (mysqli_affected_rows($conn) == 1)//if update query was successfull
    {
    echo '<b>Your account is now active. You may now <a href="index.php"></a><b>';
    } else {
        echo '<b>Oops! Your account could not be activated. Please recheck the link or contact the system administrator.</b>';
    }

    mysqli_close($conn);

} else {
        echo '<b">Error Occurred .</b>';
}

?>
<div class="top_buttons" align="center">
<a href="index.php"><input type="submit" value="  BACK  "></a><br>
</div>
</div>
</div>
</body>
</html>