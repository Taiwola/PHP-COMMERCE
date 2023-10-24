<?php
include('../config/conn.php');

if (isset($_POST['insert_brand'])) {
    $brand_value = $_POST['brand_title'];
    // validate the value
    $select_query = "SELECT * FROM brands WHERE brand_title = '$brand_value'";
    // get the result from sql
    $result = mysqli_query($conn, $select_query);
    // get the number of rows
    $number = mysqli_num_rows($result);

    if ($number > 0) {
        echo "<h3 style='color:red;'>$brand_value already exist</h3>";
    } else {
        $data = "INSERT INTO brands (brand_title) VALUES ('$brand_value')";
        try {
            $result = mysqli_query($conn, $data);
            echo "<h4 style='color:green;'>$brand_value has being inserted succesfully</h4>";
        } catch (mysqli_sql_exception) {
            echo "<h4 style='color:red;'>Could not update the brand</h4>";
            // echo mysqli_error($conn);
        }
    }
}
mysqli_close($conn);
?>

<h2 class="text-center">Insert Brands</h2>
<form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" class="mb-2">
    <div class="input-group w-90 mb-2">
        <span class="input-group-text bg-dark-subtle" id="basic-addon1"><i class="fa-solid fa-receipt"></i></span>
        <input type="text" class="form-control" name="brand_title" placeholder="Insert brands" aria-label="brand" aria-describedby="basic-addon1">
    </div>
    <div class="input-group w-10 mb-2 m-auto">
        <input type="submit" class="form-control bg-dark-subtle" name="insert_brand" value="Insert brands" aria-label="brand" aria-describedby="basic-addon1">
    </div>
</form>