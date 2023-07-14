<?php include 'components/header.inc.php' ?>

<?php


if(isset($_GET['id']) && isset($_GET['image_name'])){
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    if($image_name !=""){
        // remove image file 
        $path = "../uploader/images/menu/".$image_name;
        $remove = unlink($path);

        if($remove == FALSE){
            $_SESSION['remove'] = "<p class='notify error'>Failed To Remove File</p>";
            header('Location:'.SITEURL.'admin/manage-menu.php');
            die();
        }
    }
    $sql = "DELETE FROM tbl_item
                WHERE id=$id
        ";
    
    $res = mysqli_query($conn, $sql);
    
    if ($res == TRUE) {
        $_SESSION['delete'] = "<p class='notify success'>Item Deleted Successfully</p>";
        header('location:' . SITEURL . 'admin/manage-menu.php');
    } else {
        // failed to delete admin 
        $_SESSION['delete'] = "<p class='notify error'>Failed To Delete Item</p>";
        header('location:' . SITEURL . 'admin/manage-menu.php');
    }
}
?>

<?php include 'components/footer.inc.php' ?>
