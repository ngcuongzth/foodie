<?php include 'components/header.inc.php' ?>


<!-- Main Content Section Starts -->
<section class="main-content">
    <div class="container-center">
        <h3>Manage Admin</h3>
        
        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if(isset($_SESSION['delete'])){
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }
        if(isset($_SESSION['update'])){
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        if(isset($_SESSION['not-found'])){
            echo $_SESSION['not-found'];
            unset($_SESSION['not-found']);
        }
        ?>

        <a href="add-admin.php" class="btn btn--add">
            Add Admin
        </a>
        <table class="tbl-full">
            <tr>
                <th>ID</th>
                <th>Full name.</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>

            <?php
            $sql = "SELECT * FROM tbl_admin";
            $res = mysqli_query($conn, $sql);
            if ($res == TRUE) {
                // count rows
                $rows = mysqli_num_rows($res);
                if ($rows > 0) {
                    // have data 
                    while ($row = mysqli_fetch_assoc($res)) {
                        $fullname = $row['fullname'];
                        $username = $row['user_name'];
                        $id = $row['id'];
                        ?>
                        <tr>
                            <td>
                                <?php echo $id ?>.
                            </td>
                            <td>
                                <?php echo $fullname ?>
                            </td>
                            <td>
                                <?php echo $username ?>
                            </td>
                            <td>
                                <a href="<?php echo SITEURL;?>admin/update-admin.php?id=<?php echo $id ?>" class="btn btn--primary">
                                    Update Admin
                                </a>
                                <a href="<?php echo SITEURL;?>admin/delete-admin.php?id=<?php echo $id ?>" class="btn btn--secondary">
                                    Delete Admin
                                </a>
                            </td>
                        </tr>
                    <?php
                    }

                } else {
                    // no data
                }
            }
            ?>
        </table>
    </div>
</section>
<!-- Main Content Section Ends -->

<?php include 'components/footer.inc.php' ?>