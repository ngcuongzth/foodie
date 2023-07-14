<?php include 'components/header.inc.php' ?>

<div class="main-content">
    <div class="container-center">
        <h3>Add Category</h3>
        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        ?>
        <form method="POST" enctype="multipart/form-data">
            <div class="field">
                <label class="field-title" for="title">Title</label>
                <input type="text" id="title" name="title" placeholder="Category title">
            </div>
            <div class="field">
                <label class="field-title" for="image">Select image</label>
                <input type="file"  accept="image/*" id="image" name="image">
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
                Add Category
            </button>
        </form>
    </div>
</div>

<?php include 'components/footer.inc.php' ?>


<!-- handle add category -->

<?php

if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $is_featured = $_POST['featured'];
    $is_active = $_POST['active'];

    if(isset($_FILES['image'])){
        if(isset($_FILES['image']['name'])){
            // upload image 
            $image_name=$_FILES['image']['name'];
    
            // auto rename image 
            $ext = end(explode('.', $image_name));
    
            $image_name = "Foodie_category_".rand(000,999).'.'.$ext;
    
            $source_path = $_FILES['image']['tmp_name'];
            $destination_path = "../uploader/images/category/".$image_name;
    
            $upload = move_uploaded_file($source_path, $destination_path);
    
            if($upload == FALSE){
                $_SESSION['upload'] = "<div class='error'>Failed to upload image</div>";
                header("Location:".SITEURL.'admin/add-category.php');
                die();
            }
        }
        else{
            $image_name ="";
        }
        $sql = "INSERT INTO tbl_category 
        SET title='$title', image_name='$image_name', featured='$is_featured', active ='$is_active'";
    
        $res = mysqli_query($conn, $sql);
        if ($res == TRUE) {
            $_SESSION['add'] = "<p class='notify success'>Category Added Successfully</p>";
            // redirect to manage category page 
            header("Location:" . SITEURL . 'admin/manage-category.php');
        } else {
            $_SESSION['add'] = "<p class='notify error'>Failed To Add Category</p>";
            // redirect to manage category page 
            header("Location:" . SITEURL . 'admin/add-category.php');
        }
    }
    else{
          $_SESSION['add'] = "<p class='notify error'>Please choose a image</p>";
            // redirect to manage category page 
            header("Location:" . SITEURL . 'admin/add-category.php');
    }

}

?>