<?php
include('../config/conn.php');

if (isset($_POST['insert_cat'])) {
    $category_value = $_POST['cat_title'];
    // validate the value
    $select_query = "SELECT * FROM categories WHERE category_title = '$category_value'";
    // get the result from sql
    $result = mysqli_query($conn, $select_query);
    // get the number of rows
    $number = mysqli_num_rows($result);

    if ($number > 0) {
        echo "<h3 style='color:red;'>$category_value already exist</h3>";
    } else {
        $data = "INSERT INTO categories (category_title) VALUES ('$category_value')";
        try {
            $result = mysqli_query($conn, $data);
            echo "<h4 style='color:green;'>$category_value has being inserted succesfully</h4>";
        } catch (mysqli_sql_exception) {
            echo "<h4 style='color:red;'>could not update the categories</h4>";
        }
    }
}
mysqli_close($conn);
?>

<h2 class="text-center">Insert categories</h2>
<form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" class="mb-2">
    <div class="input-group w-90 mb-2">
        <span class="input-group-text bg-dark-subtle" id="basic-addon1"><i class="fa-solid fa-receipt"></i></span>
        <input type="text" class="form-control" name="cat_title" placeholder="Insert categories" aria-label="categories" aria-describedby="basic-addon1">
    </div>
    <div class="input-group w-10 mb-2 m-auto">
        <input type="submit" class="form-control bg-dark-subtle" name="insert_cat" value="Insert categories" aria-label="categories" aria-describedby="basic-addon1">
    </div>
</form>