<?php
include('../config/conn.php');
@session_start();


if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];

    $get_order = "SELECT * FROM user_orders WHERE order_id = $order_id";
    $run_order = mysqli_query($conn, $get_order);
    $order_run = mysqli_fetch_assoc($run_order);
    $amount = $order_run['amount'];
    $invoice_no = $order_run['invoice_number'];
}



if (isset($_POST['confirm_payment'])) {
    $invoice_numb = $_POST['invoice_number'];
    $amount_due = $_POST['amount'];
    $payment_mode = $_POST['payment_mode'];

    $insert_query = "INSERT INTO user_payments (order_id, invoice_number, amount, payment_mode) VALUES ($order_id, $invoice_numb, $amount_due, '$payment_mode')";
    $result = mysqli_query($conn, $insert_query);
    if ($result) {
        echo "<script>alert('Payment Confirmed Successfully')</script>";
        header("Location: profile.php?my_orders");
    } else {
        echo "<script>alert('Error Occurred! Please Try Again Later...')</script>";
        header("Location: profile.php?my_orders");
    }

    $update_order = "UPDATE user_orders SET order_status = 'confirmed' WHERE order_id = $order_id";
    $result_order = mysqli_query($conn, $update_order);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Payment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body class="bg-secondary">
    <div class="container my-5">
        <h1 class="text-center text-light">Confirm Payment</h1>
        <form action="" method="POST">
            <div class="form-outline my-4 text-center w-50 m-auto">
                <input type="text" class="form-control w-50 m-auto" name="invoice_number" value="<?php echo $invoice_no ?>">
            </div>

            <div class="form-outline my-4 text-center w-50 m-auto">
                <label for="" class="text-light">Amount</label>
                <input type="text" class="form-control w-50 m-auto" name="amount" value="<?php echo $amount ?>">
            </div>

            <div class="form-outline my-4 text-center w-50 m-auto">
                <select name="payment_mode" class="form-select w-50 m-auto">
                    <option>Select payment mode </option>
                    <option>UPI</option>
                    <option>NetBanking</option>
                    <option>Paypal</option>
                    <option>cash on delivery</option>
                    <option>payoffline</option>
                </select>
            </div>
            <div class="form-outline my-4 text-center m-auto w-50">
                <input type="submit" class="bg-info py-2 px-3 border-0" value="Confirm" name="confirm_payment">
            </div>
        </form>
    </div>
</body>

</html>