<?php
include './components/header.inc.php';
?>

<?php
if (isset($_GET['food-id'])) {
    $food_id = $_GET['food-id'];
    $sql = "SELECT * FROM tbl_item WHERE id = $food_id";
    // Execute the query 
    $res = mysqli_query($conn, $sql);

    // get the value from db 
    $count = mysqli_num_rows($res);
    if ($count == 1) {
        $row = mysqli_fetch_assoc($res);
        $title = $row['title'];
        $price = $row['price'];
        $image_name = $row['image_name'];
    } else {
        echo '<p class="error notify">Not found this product</p>';
        header("Location: " . SITEURL);
    }
} else {
    echo '<p class="error notify">Not found this product</p>';
    header("Location: " . SITEURL);
}

?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search">
    <div class="container">

        <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

        <form class="order" method="post">
            <fieldset>
                <legend>Selected Food</legend>

                <div class="food-menu-img">
                    <img src='./uploader/images/menu/<?php echo $image_name ?>' alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                </div>

                <div class="food-menu-desc">
                    <h3><?php echo $title ?></h3>
                    <p class="food-price">$<?php echo $price ?></p>

                    <div class="order-label">Quantity</div>
                    <input type="number" name="qty" class="input-responsive" value="1" required>

                </div>

            </fieldset>

            <fieldset>
                <legend>Delivery Details</legend>
                <div class="order-label">Full Name</div>
                <input type="text" name="full-name" placeholder="Your name?" class="input-responsive" required>

                <div class="order-label">Phone Number</div>
                <input type="tel" name="contact" placeholder="Enter you tel" class="input-responsive" required>

                <div class="order-label">Email</div>
                <input type="email" name="email" placeholder="Enter email" class="input-responsive" required>

                <div class="order-label">Address</div>
                <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
            </fieldset>

        </form>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->

<!-- social Section Starts Here -->

<?php
include './components/social.inc.php';

include './components/footer.inc.php';
?>

<!-- handle order -->
<?php
if (isset($_POST['submit'])) {
    // $food = $_POST['title'];
    $qty = $_POST['qty'];
    $total = $price * $qty;

    $order_date = date('Y-m-d H:i:sa');
    $status = "Ordered";

    $customer_name = $_POST['full-name'];
    $customer_contact = $_POST['contact'];
    $customer_email = $_POST['email'];
    $customer_address = $_POST['address'];

    $sql2 = "INSERT INTO tbl_order (item, price, qty, total, order_date, status, customer_name, customer_tel, customer_email, customer_address) VALUES ('$title', '$price', '$qty', '$total', '$order_date', '$status', '$customer_name', '$customer_contact', '$customer_email', '$customer_address')";


    $res2 = mysqli_query($conn, $sql2);
    if ($res2 == true) {
        $_SESSION['order'] = '<div class="notify success">Ordered Successfully</div>';
        header('Location:' . SITEURL);
    } else {
        $_SESSION['order'] = '<div class="notify error">Something went wrong</div>';
        header('Location:' . SITEURL);
    }
}
?>