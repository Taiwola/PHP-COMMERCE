<?php

if (isset($_GET['delete_brand'])) {
    $id = $_GET['delete_brand'];
    $delete_brand = "DELETE FROM brands WHERE brand_id=$id";
    if ($conn->query($delete_brand) === TRUE) {
        echo "<script>alert('Brand Deleted')</script>";
        echo "<script>window.open('index.php', '_self')</script>";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
