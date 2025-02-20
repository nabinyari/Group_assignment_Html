<?php
// Database connection
$servername = "localhost"; 
$username = "root";
$password = ""; 
$dbname = "mpn";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if(!$conn)
{
    die("Filed to connect ". mysqli_connect_error());
}
?>