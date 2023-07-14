<?php include 'components/header.inc.php' ?>



<section class="main-content">
    <div class="container-center">
        <h3>Manage Order</h3>
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
        <table class="tbl-full">
            <tr>
                <th>ID Order</th>
                <th>Customer name</th>
                <th>Item Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Customer tel</th>
                <th>Customer email</th>
                <th>Customer address</th>
                <th>Status</th>

            </tr>

            <?php
            $sql = "SELECT * FROM tbl_order";
            $res = mysqli_query($conn, $sql);
            $count  = mysqli_num_rows($res);
            if ($count > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $customer_name = $row['customer_name'];
                    $customer_tel = $row['customer_tel'];
                    $customer_email = $row['customer_email'];
                    $customer_address = $row['customer_address'];
                    $item_name = $row['item'];
                    $price = $row['price'];
                    $total = $row['total'];
                    $qty = $row['qty'];
                    $status = $row['status'];
            ?>
                    <tr>
                        <td><?php echo $id ?>.</td>
                        <td><?php echo $customer_name ?></td>
                        <td><?php echo $item_name ?></td>
                        <td><?php echo $price ?></td>
                        <td><?php echo $qty ?></td>
                        <td>$<?php echo $total ?></td>
                        <td><?php echo $customer_tel ?></td>
                        <td><?php echo $customer_email ?></td>
                        <td><?php echo $customer_address ?></td>

                        <td>
                            <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id ?>" class="btn btn--primary">
                                Update
                            </a>
                            <a href="<?php echo SITEURL; ?>admin/delete-order.php?id=<?php echo $id ?>" class="btn btn--secondary">
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