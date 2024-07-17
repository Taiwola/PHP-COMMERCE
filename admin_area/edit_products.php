<?php
include('../config/conn.php');

//fetch all categories
$select_category = "SELECT * FROM categories";
$category_query = mysqli_query($conn, $select_category);
$row_categories = mysqli_fetch_all($category_query, MYSQLI_ASSOC);

// fetch all brands
$select_brand = "SELECT * FROM brands";
$brand_query = mysqli_query($conn, $select_brand);
$row_brand = mysqli_fetch_all($brand_query, MYSQLI_ASSOC);


if (isset($_GET['edit_products'])) {
    $productId = $_GET['edit_products'];

    $select_query = "SELECT * FROM products WHERE product_id = $productId";
    $result = mysqli_query($conn, $select_query);
    $fetch_product = mysqli_fetch_assoc($result);

    $product_title = $fetch_product['product_title'];
    $product_description = $fetch_product['product_description'];
    $product_keywords = $fetch_product['product_keywords'];
    $product_price = $fetch_product['product_price'];
    $product_image1 = $fetch_product['product_image1'];
    $product_image2 = $fetch_product['product_image2'];
    $product_image3 = $fetch_product['product_image3'];
    $product_category = $fetch_product['category_id'];
    $product_brand = $fetch_product['brand_id'];
    $product_date = $fetch_product['date'];

    $category_query = "SELECT * FROM categories WHERE category_id = $product_category";
    $category_result = mysqli_query($conn, $category_query);
    $fetch_category = mysqli_fetch_assoc($category_result);
    $category_title = $fetch_category['category_title'];
    $category_id = $fetch_category['category_id'];


    $brand_query = "SELECT * FROM brands WHERE brand_id = $product_brand";
    $brand_result = mysqli_query($conn, $brand_query);
    $fetch_category = mysqli_fetch_assoc($brand_result);
    $brand_title = $fetch_category['brand_title'];
    $brand_id = $fetch_category['brand_id'];
}

if (isset($_POST['product_update'])) {
    try {
        $product_id = $_POST['product_id'];
        $product_title = filter_input(INPUT_POST, 'product_title', FILTER_SANITIZE_SPECIAL_CHARS);
        $product_description = filter_input(INPUT_POST, 'product_description', FILTER_SANITIZE_SPECIAL_CHARS);
        $product_keyword = filter_input(INPUT_POST, 'product_keyword', FILTER_SANITIZE_SPECIAL_CHARS);
        $product_category = filter_input(INPUT_POST, 'product_category', FILTER_SANITIZE_SPECIAL_CHARS);
        $brand_value = filter_input(INPUT_POST, 'product_brand', FILTER_SANITIZE_SPECIAL_CHARS);
        $product_price = filter_input(INPUT_POST, 'product_price', FILTER_SANITIZE_SPECIAL_CHARS);
        $product_status = true;

        if (empty($product_title) || empty($product_description) || empty($product_keyword) || empty($product_category) || empty($brand_value) || empty($product_price)) {
            echo "<script>alert('please fill all avaliable fields') </script>";
            exit();
        }

        $allowed_ext = ['png', 'jpg', 'jpeg', 'gif'];

        $product_img1 = $_FILES['product_image1']['name'];
        $product_img2 = $_FILES['product_image2']['name'];
        $product_img3 = $_FILES['product_image3']['name'];


        // accessing tmp name
        $product_img1_tmp = $_FILES['product_image1']['tmp_name'];
        $product_img2_tmp = $_FILES['product_image2']['tmp_name'];
        $product_img3_tmp = $_FILES['product_image3']['tmp_name'];

        // Get file extension
        $img1_ext = explode('.', $product_img1);
        $img1_ext = strtolower(end($img1_ext));

        $img2_ext = explode('.', $product_img2);
        $img2_ext = strtolower(end($img2_ext));

        $img3_ext = explode('.', $product_img1);
        $img3_ext = strtolower(end($img3_ext));

        if (in_array($img1_ext, $allowed_ext)) {
            $targetDir = "product_images/$product_img1";
            move_uploaded_file($product_img1_tmp, $targetDir);
        }

        if (in_array($img2_ext, $allowed_ext)) {
            $targetDir = "product_images/$product_img2";
            move_uploaded_file($product_img2_tmp, $targetDir);
        }

        if (in_array($img3_ext, $allowed_ext)) {
            $targetDir = "product_images/$product_img3";
            move_uploaded_file($product_img1_tmp, $targetDir);
        }

        $update_product = "UPDATE products SET product_title='$product_title', product_description='$product_description', product_keywords='$product_keyword', category_id=$product_category, brand_id=$product_brand, product_image1='$product_img1', product_image2='$product_img2', product_image3='$product_img3', product_price=$product_price, status='$product_status' WHERE product_id=$product_id ";
        $result_query = mysqli_query($conn, $update_product);
        if ($result_query) {
            echo "<script>alert('Successfully updated the products');</script>";
            echo "<script>window.open('./index.php', '_self');</script>";
        }
    } catch (mysqli_sql_exception) {
        echo mysqli_error($conn);
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        .img-cover {
            width: 160px;
            height: 150px;
            overflow: hidden;
            background-color: blueviolet;
        }

        .img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .btn {
            text-align: center;
        }

        .dash_display {
            background-color: grey;
            width: 85%;
            text-align: center;
            padding-block: 20px;
        }

        .logo {
            width: 7%;
            height: 7%;
            border-radius: 10%;
            object-fit: contain;
        }

        .edit_img {
            width: 100px;
            height: 100px;
        }
    </style>
</head>

<body>
    <h3 class="text-center text-success mb-4">Edit Account</h3>
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="product_id" value="<?php echo $productId ?>">
        <input type="hidden" name="product_date" value="<?php echo $product_date ?>">
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="product_title" class="form-label">Product title</label>
            <input type="text" class="form-control " name="product_title" value="<?php echo $product_title ?>">
        </div>
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="product_description" class="form-label">Product description</label>
            <input type="text" class="form-control " name="product_description" value="<?php echo $product_description ?>">
        </div>
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="product_keyword" class="form-label">Product keyword</label>
            <input type="text" class="form-control " name="product_keyword" value="<?php echo $product_keywords ?>">
        </div>
        <div class="form-outline mb-4 d-flex  w-50 m-auto">
            <input type="file" class="form-control" name="product_image1">
            <img src="./product_images/<?php echo $product_image1 ?>" alt="" class="edit_img">
        </div>
        <div class="form-outline mb-4 d-flex  w-50 m-auto">
            <input type="file" class="form-control" name="product_image2">
            <img src="./product_images/<?php echo $product_image2 ?>" alt="" class="edit_img">
        </div>
        <div class="form-outline mb-4 d-flex  w-50 m-auto">
            <input type="file" class="form-control" name="product_image3">
            <img src="./product_images/<?php echo $product_image3 ?>" alt="" class="edit_img">
        </div>
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="product_category" class="form-label">Select category</label>
            <select name="product_category" id="" class="form-select">
                <option value="<?php echo $category_id ?>"><?php echo $category_title ?></option>
                <?php foreach ($row_categories as $category) : ?>
                    <?php $category_id = $category['category_id']; ?>
                    <option value="<?php echo $category_id ?>"><?php echo $category['category_title'] ?></option>
                <?php endforeach ?>
            </select>
        </div>

        <!-- Brands -->
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="product_brand" class="form-label">Select brand</label>
            <select name="product_brand" id="" class="form-select">
                <option value="<?php echo $brand_id ?>"><?php echo $brand_title ?></option>
                <?php foreach ($row_brand as $brand) : ?>
                    <?php $brand_id = $brand['brand_id']; ?>
                    <option value="<?php echo $brand_id ?>"><?php echo $brand['brand_title'] ?></option>
                <?php endforeach ?>
            </select>
        </div>
        <div class="form-outline w-50 mb-4 m-auto">
            <label for="product_price" class="form-label">Product price</label>
            <input type="text" class="form-control" name="product_price" value="<?php echo $product_price ?>">
        </div>
        <div class="w-50 m-auto">
            <input type="submit" class="btn m-auto" name="product_update" value="Update">
        </div>
    </form>
</body>

</html>