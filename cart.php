<!-- <?php
include 'db_config.php';

// Handle item deletion from the cart
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $conn->prepare("DELETE FROM cart WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: cart.php");
        exit();
    } else {
        echo "Error deleting item.";
    }
    $stmt->close();
}

// Handle clearing the cart
if (isset($_GET['action']) && $_GET['action'] === 'clear') {
    $sql = "DELETE FROM cart";

    if ($conn->query($sql)) {
        header("Location: cart.php");
        exit();
    } else {
        echo "Error clearing cart.";
    }
}

// Handle checkout process
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['address'])) {
    $address = htmlspecialchars($_POST['address']);

    // Fetch cart items
    $sql = "SELECT * FROM cart";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $stmt = $conn->prepare("INSERT INTO orders (product_name, product_price, address) VALUES (?, ?, ?)");

        // Process each item in the cart
        while ($row = $result->fetch_assoc()) {
            $product_name = $row['product_name'];
            $product_price = $row['product_price'];

            $stmt->bind_param("sds", $product_name, $product_price, $address);
            $stmt->execute();
        }
        $stmt->close();

        // Clear the cart after placing the order
        $conn->query("DELETE FROM cart");

        echo "<script>
                alert('Order placed successfully!');
                window.location.href = 'index.php';
              </script>";
    } else {
        echo "<script>
                alert('Your cart is empty!');
                window.location.href = 'cart.php';
              </script>";
    }
}
?> -->


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart - KonkaBabyShop</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&family=Baloo+Bhai&display=swap"
        rel="stylesheet">
    <style>
    /* General Reset */
    body {
        margin: 0;
        padding: 0;
        font-family: 'Poppins', sans-serif;
        color: #444;
        background: url('bg.jpg') no-repeat center center fixed;
        background-size: cover;
    }

    /* Header Styles */
    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px 40px;
        background: rgba(255, 255, 255, 0.9);
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    }

    .left div {
        font-family: 'Baloo Bhai', cursive;
        font-size: 24px;
        color: #ff6384;
        margin-top: 10px;
        text-align: center;
    }

    .navbar {
        list-style: none;
        display: flex;
        gap: 20px;
    }

    .navbar li {
        display: inline-block;
    }

    .navbar a {
        text-decoration: none;
        color: #555;
        font-weight: 600;
        padding: 10px 20px;
        border-radius: 5px;
    }

    .navbar a:hover,
    .navbar a.active {
        background: #ff6384;
        color: white;
    }

    .btn {
        background-color: #ff6384;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        font-weight: 600;
    }

    .btn:hover {
        background-color: #e05770;
    }

    /* Cart Container Styles */
    .cart-container {
        max-width: 800px;
        margin: 50px auto;
        padding: 50px;
        background: white;
        box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
    }

    .cart-container h2 {
        font-size: 28px;
        color: #333;
        margin-bottom: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    th,
    td {
        text-align: left;
        padding: 10px;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #f4f4f4;
        font-size: 18px;
        font-weight: 600;
    }

    td {
        font-size: 16px;
    }

    .total-row {
        font-weight: bold;
        color: #ff6384;
    }

    .address-box {
        margin: 20px 0;
    }

    .address-box input {
        width: 100%;
        padding: 10px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .address-box input:focus {
        border-color: #ff6384;
        outline: none;
    }

    .btn-danger {
        background-color: #dc3545;
    }

    .btn-danger:hover {
        background-color: #a71d2a;
    }
    </style>
</head>

<body>
    <!-- Header -->
    <header class="header">
        <div class="left">
            <div>KonkaBabyShop</div>
        </div>
        <div class="mid">
            <ul class="navbar">
                <li><a href="user_dashboard.php" class="active">Home</a></li>
                <li><a href="user_dashboard.php#about">About Us</a></li>
                <li><a href="user_dashboard.php#products">Product List</a></li>
                <li><a href="user_dashboard.php#contact">Contact Us</a></li>
                <li><a href="cart.php">View Cart 🛒</a></li>
            </ul>
        </div>
        <div class="right">
            <a href="logout.php" class="btn">Logout</a>
        </div>
    </header>

    <!-- Cart Section -->
    <div class="cart-container">
        <h2>Your Cart</h2>
        <form method="POST" action="checkout.php">
            <table>
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Price (Taka)</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include 'db_config.php';

                    $total = 0;

                    // Fetch cart products
                    $sql = "SELECT * FROM cart";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $total += $row['product_price'];
                            echo '
                                <tr>
                                    <td>' . htmlspecialchars($row['product_name'], ENT_QUOTES) . '</td>
                                    <td>' . number_format($row['product_price'], 2) . '</td>
                                    <td>
                                       <a href="delete_cart_item.php?id=' . $row['id'] . '" class="btn btn-danger">Delete</a>

                                    </td>
                                </tr>
                            ';
                        }
                        echo '
                            <tr class="total-row">
                                <td>Total</td>
                                <td>' . number_format($total, 2) . ' Taka</td>
                                <td></td>
                            </tr>
                        ';
                    } else {
                        echo "<tr><td colspan='3'>Your cart is empty!</td></tr>";
                    }
                    ?>
                </tbody>
            </table>

            <!-- Address Field -->
            <div class="address-box">
                <label for="address">Delivery Address:</label>
                <input type="text" id="address" name="address" placeholder="Enter your address" required>
            </div>

            <!-- Buttons -->
            <div>
                <button type="submit" class="btn">Checkout</button>
                <a href="clear_cart.php" class="btn btn-danger">Clear Cart</a>
            </div>
        </form>
    </div>
</body>

</html>