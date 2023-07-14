<?php
include './components/header.inc.php';
?>



<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">
        <h2>Foods on Your Search <a href="#" class="text-white">"<?php echo $_POST['search'] ?>"</a></h2>
    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->



<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <!-- <div class="grid-container"> -->
        <?php
        $search = $_POST['search'];
        $search = mysqli_real_escape_string($conn, $_POST['search']);
        $sql = "SELECT * FROM tbl_item WHERE title LIKE '%$search%' OR description LIKE '%$search%'";

        $res = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);
        if ($count > 0) {
            echo '  <div class="grid-container">';
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

                        <a href="order.php" class="btn btn-primary">Order Now</a>
                    </div>
                </div> <?php
                    }
                    echo '</div>';
                } else {
                    echo '<p class="error notify">No Results Found</p>';
                }
                        ?>

        <!-- </div> -->


        <div class="clearfix"></div>



    </div>

</section>
<!-- fOOD Menu Section Ends Here -->


<?php

include './components/social.inc.php';
include './components/footer.inc.php';
?>