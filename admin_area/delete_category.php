<?php

if (isset($_GET['delete_category'])) {
    $id = $_GET['delete_category'];
    $delete_category = "DELETE FROM categories WHERE category_id=$id";
    if ($conn->query($delete_category) === TRUE) {
        echo "<script>alert('Category Deleted')</script>";
        echo "<script>window.open('index.php', '_self')</script>";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
