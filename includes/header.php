<?php

$conn = mysqli_connect("localhost", "appseeco_user" , "Labc_123", "appseeco_groupchat") or die("Error " . mysqli_error($link));

//$SERVER = 'localhost';
//$USER = 'root';
//$PASS = '';
//$DATABASE = 'p1019796_gc_1';
//$conn = mysqli_connect($SERVER, $USER, $PASS, $DATABASE);

/* check connection */
if (mysqli_connect_errno()) {
    echo "<h3>Sorry there is a problem. Please try again later.</h3>";
    exit();
}
?>