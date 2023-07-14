

<?php 

include '../config/connect.php';
// destroy the session

session_destroy();

// redirect to login page 
header('Location:'.SITEURL.'admin/login.php');

?>