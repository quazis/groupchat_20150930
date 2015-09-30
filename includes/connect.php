<?php

$SERVER = 'localhost';
$USER = 'root';
$PASS = '';
$DATABASE = 'p1019796_gc_1';

$conn = mysqli_connect($SERVER, $USER, $PASS, $DATABASE);

/* check connection */
if (mysqli_connect_errno()) {
    echo "<h3>Sorry there is a problem. Please try again later.</h3>";
    exit();
}
?>