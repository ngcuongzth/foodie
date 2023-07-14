<?php include './components/header.inc.php';
?>
<?php
$id = $_GET['id'];
$sql = "DELETE FROM tbl_admin
            WHERE id=$id
    ";

$res = mysqli_query($conn, $sql);

if ($res == TRUE) {
    $_SESSION['delete'] = "<p class='notify success'>Admin Deleted Successfully</p>";
    header('location:' . SITEURL .'admin/manage-admin.php');
} else {
    // failed to delete admin 
    $_SESSION['delete'] = "<p class='notify error'>Failed To Delete Admin</p>";
    header('location:' . SITEURL .'admin/manage-admin.php');
}
?>

<?php include './components/footer.inc.php' ?>
