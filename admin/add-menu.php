<?php
include '../admin/components/header.inc.php';
?>


<div class="main-content">
    <div class="container-center">
        <h3>Add New Food</h3>
        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }

        ?>
        <form method="POST" enctype="multipart/form-data">
            <div class="field">
                <label class="field-title" for="title">Title</label>
                <input type="text" id="title" name="title" required placeholder="Category title">
            </div>
            <div class="field">
                <label class="field-title" for="desc">Description</label>
                <textarea required name="desc" id="desc" cols="30" rows="10"></textarea>
            </div>
            <div class="field">
                <label class="field-title" for="image">Select image</label>
                <input type="file" accept="image/*" id="image" name="image">
            </div>
            <div class="field">
                <label class="field-title" for="price">Price</label>
                <input type="text" id="price" name="price" required placeholder="Price">
            </div>


            <div class="field">
                <label class="field-title" for="category_id">Category</label>
                <select class='field' name="category_id">
                    <?php
                    if (isset($_GET)) {
                        // sql 
                        $sql = "SELECT id,title FROM tbl_category WHERE active='true'";
                        $res = mysqli_query($conn, $sql);

                        $count = mysqli_num_rows($res);
                        if ($count > 0) {
                            while ($row = mysqli_fetch_assoc($res)) {
                                $id = $row['id'];
                                $title = $row['title'];
                                echo '<option name="category_id" value="' . $id . '">' . $title . '</option>';
                            }
                        }
                    }
                    ?>

                </select>
            </div>
            <div class="field">
                <label class="field-title" for="is-featured">Featured</label>
                <div class="field-wrapper">
                    <div class="field-radio">
                        <label for="is-featured">True</label>
                        <input class="input-radio" type="radio" name="featured" value="true" id="is-featured">
                    </div>
                    <div class="field-radio">
                        <label for="not-featured">False</label>
                        <input class="input-radio" type="radio" name="featured" value="false" id="not-featured">
                    </div>
                </div>

            </div>
            <div class="field">
                <label class="field-title" for="is-active">Active</label>
                <div class="field-wrapper">
                    <div class="field-radio">
                        <label for="is-active">True</label>
                        <input class="input-radio" type="radio" name="active" value="true" id="is-active">
                    </div>
                    <div class="field-radio">
                        <label for="not-active">False</label>
                        <input class="input-radio" type="radio" name="active" value="false" id="not-active">
                    </div>
                </div>

            </div>


            <button class="btn btn--add" name="submit" type="submit">
                Add To Menu
            </button>
        </form>
    </div>
</div>


<?php
include '../admin/components/footer.inc.php';
?>

<!-- handle add item to menu -->

<?php

if (isset($_POST['submit'])) {
    // get data form 
    $title = $_POST['title'];
    $desc = $_POST['desc'];
    $price = $_POST['price'];
    $category_id = $_POST['category_id'];
    $is_featured = $_POST['featured'];
    $is_active = $_POST['active'];

    $image_name = $_FILES['image']['name'];
    // nếu có file thì cho đẩy, không có thì báo lại phải thêm 
    if ($image_name) {
        // xử lý và đưa ảnh vào assets 
        $image_name = $_FILES['image']['name'];

        // auto rename image 
        $ext = end(explode('.', $image_name));

        $image_name = "Foodie_menu_" . rand(000, 999) . '.' . $ext;

        $source_path = $_FILES['image']['tmp_name'];
        $destination_path = "../uploader/images/menu/" . $image_name;

        $upload = move_uploaded_file($source_path, $destination_path);

        if ($upload == FALSE) {
            $_SESSION['upload'] = "<div class='error'>Failed to upload image</div>";
            header("Location:" . SITEURL . 'admin/add-menu.php');
            die();
        } else {
            //sql query 
            $sql = "INSERT INTO tbl_item
        SET title='$title', image_name='$image_name',description='$desc',price ='$price',category_id='$category_id' ,featured='$is_featured', active ='$is_active'";

            $res = mysqli_query($conn, $sql);
            if ($res == TRUE) {
                $_SESSION['add'] = "<p class='notify success'>Item Added Successfully</p>";
                // redirect to manage category page 
                header("Location:" . SITEURL . 'admin/manage-menu.php');
            } else {
                $_SESSION['add'] = "<p class='notify error'>Failed To Add Item</p>";
                // redirect to manage category page 
                header("Location:" . SITEURL . 'admin/manage-menu.php');
            }
        }
    } else {
        $_SESSION['upload'] = "<div class='error'>Please choose an image</div>";
        header("Location:" . SITEURL . 'admin/add-menu.php');
        die();
    }
}
?>