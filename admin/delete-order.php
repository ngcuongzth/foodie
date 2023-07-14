<?php include './components/header.inc.php';
?>
<?php
$id = $_GET['id'];
$sql = "DELETE FROM tbl_order
            WHERE id=$id
    ";

$res = mysqli_query($conn, $sql);

if ($res == TRUE) {
    $_SESSION['delete'] = "<p class='notify success'>Order Deleted Successfully</p>";
    header('location:' . SITEURL . 'admin/manage-order.php');
} else {
    // failed to delete admin 
    $_SESSION['delete'] = "<p class='notify error'>Failed To Delete Order</p>";
    header('location:' . SITEURL . 'admin/manage-order.php');
}
?>

<?php include './components/footer.inc.php' ?>
