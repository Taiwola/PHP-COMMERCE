<?php
include('./includes/header.php');
$search_product = getSearch();
?>



<div class="row me-0">
    <div class="col-md-10">
        <!-- products -->
        <div class="row">
            <?php
            // Check if $unique_categories is an array or object before using foreach
            if (is_array($search_product) || is_object($search_product)) {
                foreach ($search_product as $product) {
                    generateProductCard($product);
                }
            } else {
                echo "<h1 class='text-center text-danger'>No result for this search</h1>";
            }
            ?>
        </div>



    </div>
    <div class="col-md-2 bg-secondary  p-0">
        <!-- side nav -->
        <ul class="navbar-nav me-auto text-center">
            <!-- brand to be displaed -->
            <li class="nav-item nav-list bg-info-subtle mb-1">
                <a href="#" class="nav-link">
                    <h4>Delivery Brands</h4>
                </a>
            </li>
            <?php foreach ($row_brand as $brand) : ?>
                <?php generateBrandListItem($brand) ?>
            <?php endforeach; ?>
        </ul>

        <ul class="navbar-nav me-auto text-center">
            <!-- categories to be displaed -->
            <li class="nav-item nav-list bg-info-subtle mb-1">
                <a href="#" class="nav-link">
                    <h4>Categories</h4>
                </a>
            </li>
            <?php foreach ($row_category as $category) : ?>
                <?php generateCategoryListItem($category) ?>
            <?php endforeach ?>
        </ul>
    </div>
</div>


<?php
include('./includes/footer.php');
