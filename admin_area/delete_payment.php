<?php

if (isset($_GET['delete_payment'])) {
    $id = $_GET['delete_payment'];
    $delete_payment = "DELETE FROM user_payments WHERE payment_id=$id";
    if ($conn->query($delete_payment) === TRUE) {
        echo "<script>alert('payment Deleted')</script>";
        echo "<script>window.open('index.php', '_self')</script>";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
