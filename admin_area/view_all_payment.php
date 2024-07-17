<?php

$get_payment = "SELECT * FROM user_payments";
$result = mysqli_query($conn, $get_payment);
$count = mysqli_num_rows($result);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h3 class="text-success text-center">All payments</h3>

    <table class="table table-bordered mt-5">
        <?php



        echo "
            <thead>
            <tr>
                <th class='bg-info'>SL.no</th>
                <th class='bg-info'>Invoice number</th>
                <th class='bg-info'>Amount</th>
                <th class='bg-info'>payment mode</th>
                <th class='bg-info'>order date</th>
                <th class='bg-info'>Delete</th>
            </tr>
        </thead>
        <tbody>
            ";

        if ($count == 0) {
            echo "<h2 class='bg-danger text-center mt-5'>No order yet</h2>";
        } else {
            $number = 0;
            while ($row_date = mysqli_fetch_assoc($result)) {
                $payment_id = $row_date['payment_id'];
                $order_id = $row_date['order_id'];
                $payment_amount = $row_date['amount'];
                $invoice = $row_date['invoice_number'];
                $payment_date = $row_date['date'];
                $payment_mode = $row_date['payment_mode'];
                $number++;

                echo "
                <tr>
                <td class='bg-secondary text-light text-center'>$number</td>
                <td class='bg-secondary text-light text-center'>$invoice</td>
                <td class='bg-secondary text-light text-center'>$payment_amount</td>
                <td class='bg-secondary text-light text-center'>$payment_mode</td>
                <td class='bg-secondary text-light text-center'>$payment_date</td>
                <td class='bg-secondary text-light text-center'>
                <a href='index.php?delete_payment=$payment_id' class='text-light'><i class='fa-solid fa-trash'></i></a>
                </td>
            </tr>
                ";
            }
        }
        ?>
        </tbody>
    </table>
</body>

</html>