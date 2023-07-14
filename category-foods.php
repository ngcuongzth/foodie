<?php
include './components/header.inc.php';
?>

<?php
if (isset($_GET['category-id'])) {
    // category id is set and get the id 
    $category_id = $_GET['category-id'];
    $sql = "SELECT title FROM tbl_category WHERE id = $category_id";
    // Execute the query 
    $res = mysqli_query($conn, $sql);

    // get the value from db 
    $row = mysqli_fetch_assoc($res);
    if ($row > 0) {
        $category_title = $row['title'];
    }
}

?>


<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">


        <?php
        if (isset($category_title)) {
            echo "   <h2>Foods on <a href='#' class='text-white'>'$category_title'</a></h2>";
        } else {
            echo '   <h2>Foods on <a href="#" class="text-white">"Category"</a></h2>';
        }
        ?>
    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->

<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>
        <div class="grid-container">
            <?php
            $sql2 = "SELECT * FROM tbl_item WHERE category_id='$category_id'";
            $res2 = mysqli_query($conn, $sql2);
            $count2 = mysqli_num_rows($res2);
            if ($count2 > 0) {
                while ($row2 = mysqli_fetch_assoc($res2)) {
                    $id = $row2['id'];
                    $title = $row2['title'];
                    $price = $row2['price'];
                    $description = $row2['description'];

                    $image_name = $row2['image_name'];
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
                    } else {
                        echo '<p class="error notify">Not found product</p>';
                    }
                            ?>

            <div class="clearfix"></div>

        </div>

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