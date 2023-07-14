<?php
include './components/header.inc.php';
?>

<?php

include './components/search-form.php';
?>



<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>


        <div class="grid-container">
            <?php
            $sql = "SELECT * FROM tbl_item WHERE active='true' AND featured='true' LIMIT 9";
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

</section>
<!-- fOOD Menu Section Ends Here -->

<!-- social Section Starts Here -->
<section class="social">
    <div class="container text-center">
        <ul>
            <li>
                <a href="#"><img src="https://img.icons8.com/fluent/50/000000/facebook-new.png" /></a>
            </li>
            <li>
                <a href="#"><img src="https://img.icons8.com/fluent/48/000000/instagram-new.png" /></a>
            </li>
            <li>
                <a href="#"><img src="https://img.icons8.com/fluent/48/000000/twitter.png" /></a>
            </li>
        </ul>
    </div>
</section>
<!-- social Section Ends Here -->

<?php
include './components/footer.inc.php';
?>