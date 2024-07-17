<?php

if (isset($_GET['edit_brand'])) {
    $brand_id = $_GET['edit_brand'];
    $select_brand = "SELECT * FROM brands WHERE brand_id=$brand_id";
    $result_query = mysqli_query($conn, $select_brand);
    $fetch_result = mysqli_fetch_assoc($result_query);

    $brand_title = $fetch_result['brand_title'];

    if (isset($_POST['brand_update'])) {
        $brand_title = $_POST['brand_title'];
        $brand_id = $_GET['edit_brand'];


        $update_brand = "UPDATE brands SET brand_title='$brand_title' WHERE brand_id=$brand_id";
        $update_query = mysqli_query($conn, $update_brand);

        if ($update_query) {
            echo "<script>alert('Successfully updated the brand');</script>";
            echo "<script>window.open('./index.php', '_self');</script>";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h3 class="text-center text-success">Edit brand</h3>
    <form action="" method="post">
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="brand_title" class="form-label">Brand title</label>
            <input type="text" class="form-control " name="brand_title" value="<?php echo $brand_title ?>">
        </div>
        <div class="w-50 m-auto">
            <input type="submit" class="btn m-auto" name="brand_update" value="Update">
        </div>
    </form>
</body>

</html>