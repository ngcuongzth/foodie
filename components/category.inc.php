<!--  -->


<!-- CAtegories Section Starts Here -->
<section class="categories">
    <div class="container">
        <h2 class="text-center">Explore Foods</h2>

        <?php
        $sql = "SELECT * FROM tbl_category WHERE active='true' AND featured='true' LIMIT 6";
        $res = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);

        if ($count > 0) {
            echo "<div class='grid-container'>";
            while ($row = mysqli_fetch_assoc($res)) {
                $id = $row['id'];
                $title = $row['title'];
                $image_name = $row['image_name'];
        ?>
                <a href='<?php echo SITEURL . 'category-foods.php' . '?category-id=' . "$id"  ?>' .>
                    <img src="<?php echo 'uploader/images/category/' . $image_name ?> " alt="Pizza" class="img-ratio img-curve">
                    <h3 class="img-title"><?php echo $title ?></h3>
                </a>
            <?php
            }
            ?>
        <?php echo "</div>";
        } else {
            echo "<div class='notify error'>Category empty</div>";
        }
        ?>

        <div class="clearfix"></div>
    </div>
</section>
<!-- Categories Section Ends Here -->