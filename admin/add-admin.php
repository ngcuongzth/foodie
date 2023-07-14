<?php
include('../admin/components/header.inc.php');
?>


<!--  Main Content Section Starts -->
<section class="main-content">
    <div class="container-center">
        <h3>Manage Admin</h3>
        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        ?>
        <form method="POST">
            <div class="field">
                <label for="fullname">Your name</label>
                <input type="text" id="fullname" name="fullname" placeholder="Enter your name 🌻">
            </div>
            <div class="field">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" placeholder="What's your username?">
            </div>
            <div class="field">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="password" placeholder="Password please!">
            </div>

            <button class="btn btn--add" name="submit" type="submit">
                Add Admin
            </button>
        </form>
    </div>
</section>
<!-- Main Content Section Ends -->


<?php
include('../admin/components/footer.inc.php');
?>


<!-- handle add admin  --->
<?php
if (isset($_POST['submit'])) {

    // get data fields
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $password = md5($_POST['password']); // password encryption with md5 algorithm

    // query and send data to database 
    $sql = "INSERT INTO tbl_admin
                SET fullname = '$fullname',
                user_name = '$username',
                password ='$password';
        ";

    $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    $message;
    if ($res === TRUE) {
        // insert data 
          $_SESSION['add'] = "<p class='notify success'>Admin Added Successfully</p>";
        // redirect page 
        header("location:" . SITEURL . 'admin/manage-admin.php');
    } else {
          $_SESSION['add'] = "<p class='notify error'>Admin Added Successfully</p>";
        header("location:" . SITEURL . 'admin/add-admin.php');
    }
} else {
    echo "not click";
}
?>