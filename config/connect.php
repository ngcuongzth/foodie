<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

ob_start();
// start session
session_start();

define('SITEURL', 'http://localhost/foodie/');
define('LOCALHOST', 'localhost');
define('USERNAME', 'root');
define('PASSWORD', '');
define('DATABASE','foodie');
// create connection  

$conn = mysqli_connect(LOCALHOST, USERNAME, PASSWORD, DATABASE);


if(!$conn){
    die("Couldn't connect to database" .mysqli_connect_error());
}
else{
    $db_select = mysqli_select_db($conn, DATABASE) or die(mysqli_error($conn));
}
?>