<?php include 'components/header.inc.php' ?>
<!-- Main Content Section Starts -->
<section class="main-content">
    <div class="container-center">
        <h3>DASHBOARD</h3>

        <?php
        if (isset($_SESSION['login'])) {
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }
        ?>

        <?php
        $sql = 'SELECT * FROM tbl_category';
        $res = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);

        $sql2 = 'SELECT * FROM tbl_item';
        $res2 = mysqli_query($conn, $sql2);
        $count2 = mysqli_num_rows($res2);

        $sql3 = 'SELECT * FROM tbl_order';
        $res3 = mysqli_query($conn, $sql3);
        $count3 = mysqli_num_rows($res3);

        $sql4 = 'SELECT SUM(total) AS total FROM tbl_order';
        $res4 = mysqli_query($conn, $sql4);
        $row = mysqli_fetch_assoc($res4);
        $totalSum = $row['total'];
        ?>
        <div class="group">
            <div class="content-col">
                <h4><?php echo $count ?></h4>
                <p>Categories</p>
            </div>
            <div class="content-col">
                <h4><?php echo $count2 ?></h4>
                <p>Foods</p>
            </div>
            <div class="content-col">
                <h4><?php echo $count3 ?></h4>
                <p>Total Orders</p>
            </div>
            <div class="content-col">
                <h4>$<?php echo $totalSum ?></h4>
                <p>Revenue Generated</p>
            </div>
        </div>
    </div>
</section>
<!-- Main Content Section Ends -->

<?php include 'components/footer.inc.php' ?>