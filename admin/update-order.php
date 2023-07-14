<?php
include '../admin/components/header.inc.php';
?>

<!--  Main Content Section Starts -->
<section class="main-content">
    <div class="container-center">
        <h3>Update Order</h3>
        <?php
        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        ?>
        <?php if (isset($_GET)) {

            $id = $_GET['id'];
            $sql = "SELECT * FROM tbl_order WHERE id = '$id'";
            $res = mysqli_query($conn, $sql);

            if ($res == TRUE) {
                $count = mysqli_num_rows($res);
                // echo $count;
                if ($count == 1) {
                    $row = mysqli_fetch_assoc($res);
                    $id = $row['id'];
                    $customer_name = $row['customer_name'];
                    $customer_tel = $row['customer_tel'];
                    $customer_email = $row['customer_email'];
                    $customer_address = $row['customer_address'];
                    $item_name = $row['item'];
                    $price = $row['price'];
                    $qty = $row['qty'];
                    $status = $row['status'];
                    $order_date = $row['order_date'];
                } else {
                    $_SESSION['update'] = "<p class='notify error'>Not found this bill</p>";
                    header("Location:" . SITEURL . 'admin/manage-order.php');
                }
            }
        }
        ?>
        <form method="POST">
            <div class="field">
                <label class='field-title' for="fullname">Customer</label>
                <input type="text" id="fullname" name="fullname" placeholder="Enter your name 🌻" value="<?php echo $customer_name ?>">
            </div>
            <div class="field">
                <label class='field-title' for="tel">Tel</label>
                <input type="text" id="tel" name="tel" value="<?php echo $customer_tel ?>">
            </div>
            <div class="field">
                <label class='field-title' for="email">Email</label>
                <input type="text" id="email" name="email" value="<?php echo $customer_email ?>">
            </div>
            <div class="field">
                <label class='field-title' for="address">Address</label>
                <input type="text" id="address" name="address" value="<?php echo $customer_address ?>">
            </div>
            <div class="field">
                <label class='field-title' for="item">Item</label>
                <input type="text" disabled id="item" name="item" value="<?php echo $item_name ?>">
            </div>
            <div class="field">
                <label class='field-title' for="qty">Quality</label>
                <input type="number" id="qty" name="qty" value="<?php echo $qty ?>">
            </div>
            <div class="field">
                <label class='field-title' for="price">Price($)</label>
                <input type="number" disabled id="price" name="price" value="<?php echo $price ?>">
            </div>

            <div class="field">
                <label class='field-title' for="date">Order date</label>
                <input type="text" disabled id="date" name="date" value="<?php echo $order_date ?>">
            </div>

            <button class="btn btn--add" name="submit" type="submit">
                Update Now
            </button>
        </form>
    </div>
</section>
<!-- Main Content Section Ends -->

<!-- handle update  -->

<!-- <?php
        if (isset($_POST['submit'])) {
            // $id = $_GET['id'];
            $name = $_POST['fullname'];
            $tel = $_POST['tel'];
            $email = $_POST['email'];
            $address = $_POST['address'];
            $qty = $_POST['qty'];
            $total = $price * $qty;


            // // check available order
            $sql_check_order = "SELECT * FROM tbl_order WHERE id= '$id'";
            $res_check_order = mysqli_query($conn, $sql_check_order);
            if (mysqli_num_rows($res_check_order) == 1) {
                // handle update 
                $sql_update = "UPDATE tbl_order SET qty='$qty', total ='$total', customer_tel = '$tel', customer_email = '$email', customer_address ='$address', customer_name ='$name' WHERE id='$id'";


                $res_update = mysqli_query($conn, $sql_update);
                if ($res_update == TRUE) {
                    $_SESSION['update'] = "<p class='notify success'>Order Updated Successfully</p>";
                    header("Location:" . SITEURL . 'admin/manage-order.php');
                } else {
                    $_SESSION['update'] = "<p class='notify error'>Failed to update order</p>";
                    header("Location:" . SITEURL . 'order/update-order.php?id=' . $id);
                }
            }
        }

        ?> -->