<?php 
    include '../admin/components/header.inc.php';
?>

<!--  Main Content Section Starts -->
<section class="main-content">
    <div class="container-center">
        <h3>Update Admin</h3>
        <?php
         if(isset($_SESSION['update'])){
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }

        $id = $_GET['id'];
        $sql = "SELECT * FROM tbl_admin WHERE id = '$id'";
        $res = mysqli_query($conn, $sql);
        if($res ==TRUE){
            $count = mysqli_num_rows($res);
            if($count==1){
                $row = mysqli_fetch_assoc($res);
                $fullname = $row['fullname'];
                $username = $row['user_name'];
                $password = $row['password'];
            }
            else{
                header("Location:".SITEURL.'admin/manage-admin.php');
            }
        }
        ?>
        <form method="POST">
            <div class="field">
                <label for="fullname">Your name</label>
                <input type="text" id="fullname"  name="fullname" placeholder="Enter your name 🌻" value="<?php echo $fullname ?>">
            </div>
            <div class="field">
                <label for="username">Username</label>
                <input type="password" name="username" id="username" placeholder="What's your username?" value="<?php echo $username ?>" disabled>
            </div>
             <div class="field">
                <label for="password">Old Password</label>
                <input type="password" id="password" name="old-password" class="password" placeholder="Enter new password">
            </div>
            <div class="field">
                <label for="password">New Password</label>
                <input type="text" id="password" name="new-password" class="password" placeholder="Enter new password">
            </div>

            <button class="btn btn--add" name="submit" type="submit">
                Update Now
            </button>
        </form>
    </div>
</section>
<!-- Main Content Section Ends -->

<!-- handle update  -->

<?php 
    if(isset($_POST['submit'])){
        $id = $_GET['id'];

        // check available user 
        $sql_check_user = "SELECT * FROM tbl_admin WHERE id= '$id'";
        $res_check_user = mysqli_query($conn, $sql_check_user);
        if(mysqli_num_rows($res_check_user) > 0){
            
            $fullname = $_POST['fullname'];
            $old_password = md5($_POST['old-password']);
            $new_password = md5($_POST['new-password']);
        
            $sql_check_password = "SELECT password FROM tbl_admin WHERE id ='$id' AND password ='$old_password'";
            $res_check_password = mysqli_query($conn, $sql_check_password);
            
            $count_check_password = mysqli_num_rows($res_check_password);
            if($count_check_password ==TRUE){
                // handle update 
                $sql_update = "UPDATE tbl_admin SET fullname ='$fullname', password ='$new_password' WHERE id='$id'";
                $res_update = mysqli_query($conn, $sql_update);
                if($res_update ==TRUE){
                      $_SESSION['update'] = "<p class='notify success'>Account Updated Successfully</p>";
                header("Location:".SITEURL.'admin/manage-admin.php');
                }
                else{
                    $_SESSION['update'] = "<p class='notify error'>Failed to update admin</p>";
                    header("Location:".SITEURL.'admin/update-admin.php?id='.$id);
                }
            }
            else{
                $_SESSION['update'] = "<p class='notify error'>Old password incorrect</p>";
                 header("Location:".SITEURL.'admin/update-admin.php?id='.$id);
            }
        }
        else{
               $_SESSION['not-found'] = "<p class='notify error'>Not Found User</p>";
            // redirect page 
            header("location:" . SITEURL . 'admin/manage-admin.php');
        }

    }

?>

