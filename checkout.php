<?php
include 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $address = htmlspecialchars($_POST['address']);
    
    // Fetch cart items
    $sql = "SELECT * FROM cart";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Insert order into the `orders` table
        while ($row = $result->fetch_assoc()) {
            $product_name = $row['product_name'];
            $product_price = $row['product_price'];

            $insert_sql = "INSERT INTO orders (product_name, product_price, address) 
                           VALUES ('$product_name', '$product_price', '$address')";
            $conn->query($insert_sql);
        }

        // Clear the cart
        $conn->query("DELETE FROM cart");

        echo "<script>
                alert('Order placed successfully!');
                window.location.href = 'user_dashboard.php';
              </script>";
    } else {
        echo "<script>
                alert('Your cart is empty!');
                window.location.href = 'cart.php';
              </script>";
    }
}
?>