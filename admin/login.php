<?php
include '../config/connect.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
    <div class="main-content">
        <div class="container-center form-custom">
            <div class="form-modal">

                <h3>Login with Admin Account</h3>

                <form method="POST">
                    <div class="field">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" placeholder="Enter username">
                    </div>
                    <div class="field">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" class="password" placeholder="Enter password">
                    </div>

                    <button class="btn btn--add" name="submit" type="submit">
                        Login
                    </button>
                    <?php
                    if (isset($_SESSION['login'])) {
                        echo $_SESSION['login'];
                        unset($_SESSION['login']);
                        // $_SESSION['username'] = $username;
                    }
                    if (isset($_SESSION['not-login-message'])) {
                        echo $_SESSION['not-login-message'];
                        unset($_SESSION['not-login-message']);
                    }
                    ?>

                </form>
                <p class='btn  error btn-custom'>Username: admin - password: 123</p>
            </div>

        </div>
    </div>

</body>

</html>



<!-- handle login -->

<?php
if (isset($_POST['submit'])) {
    // $username = $_POST['username'];
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, md5($_POST['password']));

    $sql = "SELECT * FROM tbl_admin WHERE user_name ='$username' AND password ='$password'";
    $res = mysqli_query($conn, $sql);

    if (mysqli_num_rows($res) == 1) {

        $_SESSION['login'] = "<p class='login-message success'>Logged Successfully</p>";
        $_SESSION['user'] = $username;
        // redirect page 
        header("location:" . SITEURL . 'admin');
    } else {
        $_SESSION['login'] = "<p class='login-message error'>Username or password did'nt match</p>";
        // redirect page 
        header("location:" . SITEURL . 'admin/login.php');
    }
}

?>