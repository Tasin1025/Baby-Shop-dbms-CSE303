<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart - KonkaBabyShop</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&family=Baloo+Bhai&display=swap">
    <style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f4f4f9;
        margin: 0;
        padding: 0;
    }

    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: #007BFF;
        padding: 15px 30px;
        color: #fff;
    }

    .navbar {
        list-style: none;
        display: flex;
        padding: 0;
    }

    .navbar li {
        margin: 0 10px;
    }

    .navbar a {
        color: #fff;
        text-decoration: none;
    }

    .navbar a.active {
        font-weight: bold;
    }

    .cart-container {
        width: 80%;
        margin: 30px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    th,
    td {
        text-align: left;
        padding: 15px;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #f4f4f4;
    }

    .total-row {
        font-weight: bold;
        background-color: #f9f9f9;
    }

    .btn {
        display: inline-block;
        padding: 10px 20px;
        background-color: #007BFF;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        text-decoration: none;
        text-align: center;
    }

    .btn:hover {
        background-color: #0056b3;
    }

    .btn-danger {
        background-color: #dc3545;
    }

    .btn-danger:hover {
        background-color: #a71d2a;
    }

    .address-box {
        margin: 20px 0;
    }

    .address-box input {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
    }
    </style>
</head>

<body>
    <?php
    include 'db_config.php';

    // Handle item deletion
    if (isset($_GET['delete_id'])) {
        $id = intval($_GET['delete_id']);
        $conn->query("DELETE FROM cart WHERE id = $id");
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }

    // Handle cart clearing
    if (isset($_GET['clear_cart'])) {
        $conn->query("DELETE FROM cart");
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }

    // Handle checkout
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['address'])) {
        $address = htmlspecialchars($_POST['address']);
        $result = $conn->query("SELECT * FROM cart");

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $product_name = $row['product_name'];
                $product_price = $row['product_price'];
                $conn->query("INSERT INTO orders (product_name, product_price, address) VALUES ('$product_name', '$product_price', '$address')");
            }
            $conn->query("DELETE FROM cart");
            echo "<script>alert('Order placed successfully!'); window.location.href = 'index.php';</script>";
        } else {
            echo "<script>alert('Your cart is empty!'); window.location.href = 'cart.php';</script>";
        }
    }
    ?>

    <header class="header">
        <div>KonkaBabyShop</div>
        <ul class="navbar">
            <li><a href="index.php" class="active">Home</a></li>
            <li><a href="index.php#about">About Us</a></li>
            <li><a href="index.php#products">Product List</a></li>
            <li><a href="index.php#contact">Contact Us</a></li>
            <li><a href="cart.php">View Cart 🛒</a></li>
        </ul>
        <a href="logout.php" class="btn">Logout</a>
    </header>

    <div class="cart-container">
        <h2>Your Cart</h2>
        <form method="POST" action="">
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
                    $total = 0;
                    $result = $conn->query("SELECT * FROM cart");

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $total += $row['product_price'];
                            echo "<tr>
                                <td>" . htmlspecialchars($row['product_name'], ENT_QUOTES) . "</td>
                                <td>" . number_format($row['product_price'], 2) . "</td>
                                <td><a href='?delete_id=" . $row['id'] . "' class='btn btn-danger'>Delete</a></td>
                            </tr>";
                        }
                        echo "<tr class='total-row'>
                                <td>Total</td>
                                <td>" . number_format($total, 2) . " Taka</td>
                                <td></td>
                            </tr>";
                    } else {
                        echo "<tr><td colspan='3'>Your cart is empty!</td></tr>";
                    }
                    ?>
                </tbody>
            </table>

            <div class="address-box">
                <label for="address">Delivery Address:</label>
                <input type="text" id="address" name="address" placeholder="Enter your address" required>
            </div>

            <div>
                <button type="submit" class="btn">Checkout</button>
                <a href="?clear_cart=true" class="btn btn-danger">Clear Cart</a>
            </div>
        </form>
    </div>
</body>

</html>