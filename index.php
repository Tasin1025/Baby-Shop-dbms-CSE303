<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KonkaBabyShop</title>
    <link rel="stylesheet" href="index_style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&family=Baloo+Bhai&display=swap"
        rel="stylesheet">
</head>

<body>
    <header class="header">
        <div class="left">
            <div class="logo">KonkaBabyShop</div>
        </div>
        <div class="right">
            <button class="btn" onclick="location.href='login.php'">Login</button>
            <button class="btn" onclick="location.href='register.php'">Register</button>
        </div>

    </header>

    <div class="banner">
        <h1>Welcome to KonkaBabyShop!</h1>
        <p>Explore premium-quality baby products, handpicked for your little ones.</p>
        <button class="btn">Shop Now</button>
    </div>

    <!-- Featured Products Section -->
    <div class="container">
        <h2>Our Bestsellers</h2>
        <div class="product-grid">
            <?php
            // Include the database configuration file
            include 'db_config.php';

            // Fetch products from the database
            $sql = "SELECT * FROM products";
            $result = $conn->query($sql);

            // Display products dynamically
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '
                        <div class="product">
                            <img src="uploads/' . $row['image'] . '" alt="' . $row['name'] . '">
                            <h3>' . $row['name'] . '</h3>
                            <p>' . number_format($row['price'], 2) . ' Taka</p>
                        </div>
                    ';
                }
            } else {
                echo "<p>No products found!</p>";
            }

            ?>
        </div>
    </div>

    <footer>
        <p>&copy; 2025 KonkaBabyShop | All Rights Reserved</p>
    </footer>
</body>

</html>