<?php
include('../config/connect.php');
include('../admin/login-check.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foodie Panel</title>
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/admin.css">

</head>

<body>
    <main class="main">
        <!-- Menu Section Starts -->
        <header>
            <div class="container-center header-section">
                <a href="index.php" class="logo">
                    <!-- <img src='./logo/logo.png' alt="logo-foodie"> -->
                    Foodie Manage
                </a>
                <nav class="navbar">
                    <ul>
                        <li>
                            <a href="index.php">Home</a>
                        </li>
                        <li>
                            <a href="manage-admin.php">Admin</a>
                        </li>
                        <li>
                            <a href="manage-category.php">Category</a>
                        </li>
                        <li>
                            <a href="manage-menu.php">Menu</a>
                        </li>
                        <li>
                            <a href="manage-order.php">Order</a>
                        </li>
                        <?php
                        if (isset($_SESSION['user'])) {
                            echo "<li>
                        <a href='logout.php'>Logout</a>
                    </li>";
                        } else {
                            echo "<li>
                        <a href='login.php'>Login</a>
                    </li>";
                        }
                        ?>
                    </ul>
                </nav>
            </div>
        </header>
        <!-- Menu Section Ends -->