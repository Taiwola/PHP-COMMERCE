<?php echo
include('../config/conn.php');
include('../functions/common.php');

@session_start();

if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
}


// getting total price and item

$ip = getIPAddress();
$total = 0;
$invoice_number = mt_rand();
$status = 'pending';

$cart_query = "SELECT * FROM cart_details WHERE ip_address='$ip'";
$result_cart_price = mysqli_query($conn, $cart_query);
$count = mysqli_num_rows($result_cart_price);

while ($row_price = mysqli_fetch_assoc($result_cart_price)) {
    $product_id = $row_price['product_id'];

    $product_query = "SELECT * FROM products WHERE product_id=$product_id";
    $product_result = mysqli_query($conn, $product_query);

    while ($row_Product_price = mysqli_fetch_assoc($product_result)) {
        $product_price = array($row_Product_price['product_price']);
        $product_sum = array_sum($product_price);
        $total += $product_sum;
    }
}

// getting quantity from cart

$get_cart = "SELECT * FROM cart_details";
$run_cart = mysqli_query($conn, $get_cart);
$get_item_quantity = mysqli_fetch_assoc($run_cart);
$quantity = $get_item_quantity['quantity'];

if ($quantity == 0) {
    $quantity = 1;
    $subtotal = $total;
} else {
    $quantity = $quantity;
    $subtotal = $total * $quantity;
}

$insert_orders = "INSERT INTO user_orders (user_id, amount, invoice_number, total_products, order_status)
VALUES ($user_id, $subtotal, $invoice_number, $count, '$status')";

$result_query = mysqli_query($conn, $insert_orders);

if ($result_query) {
    echo "<script>alert('order submitted succesfully')</script>";
    echo "<script>window.open('profile.php', '_self')</script>";
} else {
    echo "<script>alert('orders failed to submit')</script>";
    echo "<script>window.open('checkout.php', '_self')</script>";
}


// order pending
$insert_pending_orders = "INSERT INTO orders_pending (user_id, invoice_number, product_id, quantity, order_status)
VALUES ($user_id,  $invoice_number, $product_id, $quantity, '$status')";
$pending_query = mysqli_query($conn, $insert_pending_orders);


// delete items from cart
$empty_cart = "DELETE FROM cart_details WHERE ip_address='$ip'";
$empty_result = mysqli_query($conn, $empty_cart);
