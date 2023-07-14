<?php
include './components/header.inc.php';
?>
<?php
if (isset($_SESSION['order'])) {
    echo $_SESSION['order'];
    unset($_SESSION['order']);
}
?>
<?php

include './components/search-form.php';
?>

<?php include './components/category.inc.php' ?>

<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Featured</h2>
        <div class="grid-container">
            <?php
            $sql = "SELECT * FROM tbl_item WHERE active='true' AND featured='true' LIMIT 6";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);

            if ($count > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $description = $row['description'];

                    $image_name = $row['image_name'];
            ?>
                    <div class="food-menu-box">
                        <div class="food-menu-img">
                            <img src="<?php echo 'uploader/images/menu/' . $image_name ?> " alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                        </div>

                        <div class="food-menu-desc">
                            <h4><?php echo $title ?></h4>
                            <p class="food-price"><?php echo '$' . $price ?></p>
                            <p class="food-detail">
                                <?php echo substr($description, 0, 100) . '...' ?>
                            </p>
                            <br>

                            <a href="<?php echo SITEURL; ?>order.php?food-id=<?php echo $id ?>" class="btn btn-primary">Order Now</a>
                        </div>
                    </div> <?php
                        }
                    }
                            ?>
        </div>

        <div class="clearfix"></div>



    </div>

    <p class="text-center">
        <a href="foods.php">See All Foods</a>
    </p>
</section>
<!-- fOOD Menu Section Ends Here -->



<?php
include './components/social.inc.php';
?>

<?php
include './components/footer.inc.php';
?>