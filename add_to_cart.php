<?php
include 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_name = htmlspecialchars($_POST['product_name']);
    $product_price = htmlspecialchars($_POST['product_price']);

    // Insert the product into the cart table
    $sql = "INSERT INTO cart (product_name, product_price) VALUES ('$product_name', '$product_price')";
    if ($conn->query($sql)) {
        header("Location: user_dashboard.php");
        exit();
    } else {
        echo "<script>alert('Error adding product to cart.');</script>";
    }
}
?>