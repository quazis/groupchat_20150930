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

$error = array();//Declare An Array to store any error message  
if (empty($_POST['username'])) {//if no name has been supplied 
        $error[] = 'Please Enter a name ';//add to array "error"
    } else {
        $name = $_POST['username'];//else assign it a variable
    }
if (empty($_POST['password'])) {//if no name has been supplied 
        $error[] = 'Please Enter a password ';//add to array "error"
    } else {
        $Password = $_POST['password'];//else assign it a variable
    }
if (empty($_POST['email'])) {//if no email has been supplied 
        $error[] = 'Please Enter a proper email address';//add to array "error"
    } else {
           if (preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $_POST['email'])) {
                   //regular expression for email validation
              $Email = $_POST['email'];
           } else {
             $error[] = 'Your Email Address is invalid  ';
           }
    }

$query_verify = "SELECT * FROM users  WHERE email ='$Email' Or username = '$name'";
$result_verify = mysqli_query($conn, $query_verify);
if (mysqli_num_rows($result_verify) > 0)
{
   $error[] = 'This email or user name is already registered';   //add to array "error"
}

// Create a unique  activation code:
$activation = md5(uniqid(rand(), true));

if (empty($error))
{ //send to Database if there's no error '
   $query_insert_user = "INSERT INTO `users` ( `username`, `email`, `password`, `activation`) VALUES ( '$name', '$Email', '$Password', '$activation')";
   $result_insert_user = mysqli_query($conn, $query_insert_user);  

$subject = 'Activation for groupCHAT';
$message = " To activate your account, please click on this link:\n\n";
$message .= 'http://getongo.co.uk/activate.php?email=' . urlencode($Email) . "&key=$activation";
$headers = 'From: info.quazi@gmail.com' . "\r\n" . 'Reply-To: info.quazi@gmail.com' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
mail($Email, $subject, $message, $headers);
   echo '</br>';
   echo '</br>';
   echo 'You have been successfully registered.';
   echo '</br></br>';
   echo '&nbsp &nbsp User Name: ' .$name ;
   echo '</br>';
   echo '&nbsp &nbsp Email: ' .$Email ;
   echo '</br></br>';
   echo 'A message has been send to your email address, check your mail box and click the link to activate your account.';
} else {
   echo $error[0];
   echo '</br>';
   echo $error[1];
   echo '</br>';
   echo $error[2];
   echo '</br>';
   echo $error[3];
   echo '</br>';
   echo $error[4];
}

mysqli_close($conn);//Close the DB Connection
// End of the main Submit conditional.

?>

<div class="top_buttons" align="center">
<a href="index.php"><input type="submit" value="  BACK  "></a><br>
</div>

</div>
</div>
</body>
</html>