<?php

if (isset($_GET['delete_products'])) {
    $product_id = $_GET['delete_products'];
    $delete_product = "DELETE FROM products WHERE product_id='$product_id' ";
    $delete_result = mysqli_query($conn, $delete_product);

    if ($delete_result) {
        echo "<script>alert('product deleted successfully')</script>";
        echo "<script>window.open('./index.php', '_self')</script>";
    }
}
