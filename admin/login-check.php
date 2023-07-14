<?php 

if(!isset($_SESSION['user']))
{
    // not login 
    $_SESSION['not-login-message'] = "<div class='login-message error'>Please login to access Admin Panel</div></div>" ;
    header('Location:' .SITEURL .'admin/login.php');
}

?>
