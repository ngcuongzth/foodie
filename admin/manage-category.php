<?php include 'components/header.inc.php' ?>

<section class="main-content">
    <div class="container-center">
        <h3>Manage Category</h3>
        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }
        if (isset($_SESSION['remove'])) {
            echo $_SESSION['remove'];
            unset($_SESSION['remove']);
        }
        if (isset($_SESSION['not-found'])) {
            echo $_SESSION['not-found'];
            unset($_SESSION['not-found']);
        }
        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        ?>
        <a href="add-category.php" class="btn btn--add">
            Add Category
        </a>
        <table class="tbl-full">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>

            <?php
            $sql = "SELECT * FROM tbl_category";
            $res = mysqli_query($conn, $sql);
            $count  = mysqli_num_rows($res);
            if ($count > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $image_name = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                    $title = $row['title'];

            ?>
                    <tr>
                        <td><?php echo $id ?>.</td>
                        <td><?php echo $title ?></td>
                        <td>
                            <?php
                            if ($image_name != "") {
                            ?>
                                <img class='img-table' src="<?php echo "../uploader/images/category/" . $image_name; ?>" alt="<?php echo $image_name ?>" />
                            <?php
                            } else {
                                echo "<p class='notify error'>Not found image</p>";
                            }
                            ?>
                        </td>
                        <td><?php echo $featured ?></td>
                        <td><?php echo $active ?></td>
                        <td>
                            <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id ?>&image_name=<?php echo $image_name ?>" class="btn btn--primary">
                                Update
                            </a>
                            <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id ?>&image_name=<?php echo $image_name ?>" class="btn btn--secondary">
                                Delete
                            </a>
                        </td>
                    </tr>
            <?php
                }
            } else {
                echo "<p class='notify error'>Not found category data.</p>";
            }
            ?>
        </table>
    </div>
</section>
<!-- Main Content Section Ends -->

<?php include 'components/footer.inc.php' ?>