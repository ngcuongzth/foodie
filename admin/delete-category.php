<?php include 'components/header.inc.php' ?>

<?php


if(isset($_GET['id']) && isset($_GET['image_name'])){
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    if($image_name !=""){
        // remove image file 
        $path = "../uploader/images/category/".$image_name;
        $remove = unlink($path);

        if($remove == FALSE){
            $_SESSION['remove'] = "<p class='notify error'>Failed To Remove File</p>";
            header('Location:'.SITEURL.'admin/manage-category.php');
            die();
        }
    }
    $sql = "DELETE FROM tbl_category
                WHERE id=$id
        ";
    
    $res = mysqli_query($conn, $sql);
    
    if ($res == TRUE) {
        $_SESSION['delete'] = "<p class='notify success'>Category Deleted Successfully</p>";
        header('location:' . SITEURL . 'admin/manage-category.php');
    } else {
        // failed to delete admin 
        $_SESSION['delete'] = "<p class='notify error'>Failed To Delete Category</p>";
        header('location:' . SITEURL . 'admin/manage-category.php');
    }
}
?>

<?php include 'components/footer.inc.php' ?>
