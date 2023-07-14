<?php
include '../admin/components/header.inc.php';
?>


<div class="main-content">
    <div class="container-center">
        <h3>Add Category</h3>
        <?php
        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }

        $id = $_GET['id'];
        $sql = "SELECT * FROM tbl_item WHERE id = '$id'";
        $res = mysqli_query($conn, $sql);

        if ($res == TRUE) {
            $count = mysqli_num_rows($res);
            if ($count == 1) {
                $row = mysqli_fetch_assoc($res);
                $title = $row['title'];
                $image_name = $row['image_name'];
                $is_featured = $row['featured'];
                $is_active = $row['active'];
                $description = $row['description'];
            } else {
                header("Location:" . SITEURL . 'admin/manage-menu.php');
            }
        }
        ?>
        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        ?>
        <form method="POST" enctype="multipart/form-data">
            <div class="field">
                <label class="field-title" for="title">Title</label>
                <input type="text" id="title" name="title" placeholder="Item title" value='<?php echo $title; ?>'>
            </div>
            <div class="field">
                <label class="field-title" for="image">Current image</label>
                <img class="img-table" src="../uploader/images/menu/<?php echo $image_name ?>"
                    alt="<?php echo $image_name ?>">
            </div>
            <div class="field">
                <label class="field-title" for="image">Select new image</label>
                <input type="file" accept="image/*" id="image" name="image">
            </div>
            <div class="field">
                <label class="field-title" for="desc">Description</label>
                <textarea required name="desc" id="desc" cols="30" rows="10"><?php echo $description ?>
                </textarea>
            </div>

            <div class="field">
                <label class="field-title" for="is-featured">Featured</label>
                <div class="field-wrapper">
                    <div class="field-radio">
                        <label for="is-featured">True</label>
                        <input class="input-radio" type="radio" name="featured" value=<?php echo $is_featured ?> <?php if ($is_featured == 'true') {
                                echo "checked";
                            } ?> id="is-featured">
                    </div>
                    <div class="field-radio">
                        <label for="not-featured">False</label>
                        <input class="input-radio" type="radio" name="featured" value=<?php echo $is_active ?> <?php if ($is_featured == 'false') {
                                echo "checked";
                            } ?> id="not-featured">
                    </div>
                </div>

            </div>

            <div class="field">
                <label class="field-title" for="is-active">Active</label>
                <div class="field-wrapper">
                    <div class="field-radio">
                        <label for="is-active">True</label>
                        <input class="input-radio" type="radio" name="active"
                            value="<?php echo $is_active ?>" <?php if ($is_active == 'true') {
                                   echo "checked";
                               } ?> id="is-active">
                    </div>
                    <div class="field-radio">
                        <label for="not-active">False</label>
                        <input class="input-radio" type="radio" name="active"
                            value="<?php echo $is_active ?>" <?php if ($is_active == 'false') {
                                   echo "checked";
                               } ?> id="not-active">
                    </div>
                </div>

            </div>


            <button class="btn btn--add" name="submit" type="submit">
                Update Menu
            </button>
        </form>
    </div>
</div>


<?php
include '../admin/components/footer.inc.php';
?>

<!-- handle update  -->

<?php
$id = $_GET['id'];
$old_image_name = $_GET['image_name'];

// check available images 
$sql_check_category = "SELECT * FROM tbl_item WHERE id= '$id' AND image_name ='$old_image_name'";
$res_check_category = mysqli_query($conn, $sql_check_category);

if (mysqli_num_rows($res_check_category) > 0) {


    // nếu new image được upload 
    if (isset($_POST['submit'])) {
        // thực hiện lấy thông tin form đẩy lên 
        $title = $_POST['title'];
        $image_name = $_FILES['image']['name'];
        $is_featured = $_POST['featured'];
        $is_active = $_POST['active'];
        $description = $_POST['desc'];



        // thực hiện kiểm tra: 
        // image có được làm mới không 

        // kiểm tra có file đẩy lên không 
        if ($image_name != "") {
            // xóa file cũ 
            $path = "../uploader/images/menu/" . $old_image_name;
            $remove = unlink($path);
            if ($remove == FALSE) {
                $_SESSION['remove'] = "<p class='notify error'>Failed To Remove File</p>";
                header('Location:' . SITEURL . 'admin/manage-menu.php');
                die();
            }
            // 
            // lưu file mới 

            $ext = end(explode('.', $image_name));
            $image_name = "Foodie_menu_" . rand(000, 999) . '.' . $ext;
            $source_path = $_FILES['image']['tmp_name'];
            $destination_path = "../uploader/images/menu/" . $image_name;
            $upload = move_uploaded_file($source_path, $destination_path);
            if ($upload == FALSE) {
                $_SESSION['upload'] = "<div class='error'>Failed to upload image</div>";
                header("Location:" . SITEURL . 'admin/manage-menu.php');
                die();
            }
            // sql
            $sql_update = "UPDATE tbl_item SET title ='$title', image_name='$image_name', featured='$is_featured', active ='$is_active' , description ='$description' WHERE id='$id'";
        } else {
            $sql_update = "UPDATE tbl_item SET title ='$title', featured='$is_featured', active ='$is_active', description ='$description' WHERE id='$id'";
        }

        // excute update
        $res_update = mysqli_query($conn, $sql_update);
        if ($res_update == TRUE) {
            $_SESSION['update'] = "<p class='notify success'>Item Updated Successfully</p>";
            header("Location:" . SITEURL . 'admin/manage-menu.php');
        } else {
            $_SESSION['update'] = "<p class='notify error'>Failed to update item</p>";
            header("Location:" . SITEURL . 'admin/update-menu.php?id=' . $id . '&image_name=' . $old_image_name);
        }
    }
} else {
    $_SESSION['not-found'] = "<p class='notify error'>Not Found Item</p>";
    // redirect page 
    header("location:" . SITEURL . 'admin/manage-menu.php');
}

?>