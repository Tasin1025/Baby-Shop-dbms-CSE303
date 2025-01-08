<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KonkaBabyShop</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&family=Baloo+Bhai&display=swap"
        rel="stylesheet">
</head>

<body>
    <!-- Header -->
    <header class="header">
        <!-- Left Section for Logo -->
        <div class="left">
            <div>KonkaBabyShop</div>
        </div>

        <!-- Middle Section for Navigation -->
        <div class="mid">
            <ul class="navbar">
                <li><a href="#home" class="active">Home</a></li>
                <li><a href="#about">About Us</a></li>
                <li><a href="#products">Product List</a></li>
                <li><a href="#contact">Contact Us</a></li>
                <li><a href="cart.php">View Cart 🛒</a></li>
            </ul>
        </div>

        <!-- Right Section for Buttons -->
        <div class="right">
            <a href="logout.php" class="btn">Logout</a>
        </div>
    </header>

    <!-- About Us Section -->
    <div id="about" class="container">
        <h1>Welcome to KonkaBabyShop!</h1>
        <p>Your one-stop shop for exclusive baby products.</p>
        <h2>About Us</h2>
        <div class="about-card">
            <p>
                At KonkaBabyShop, we believe in providing top-quality products for your little ones.
                Our store is dedicated to offering a wide range of baby essentials that are safe, reliable, and
                affordable.
            </p>
        </div>
    </div>

    <!-- Products Section -->
    <div id="products" class="container">
        <h2>Our Bestsellers</h2>
        <div class="product-grid">
            <?php
            include 'db_config.php';

            // Fetch products from the database
            $sql = "SELECT * FROM products";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '
                        <div class="product">
                            <img src="uploads/' . $row['image'] . '" alt="' . htmlspecialchars($row['name'], ENT_QUOTES) . '">
                            <h3>' . htmlspecialchars($row['name'], ENT_QUOTES) . '</h3>
                            <p>' . number_format($row['price'], 2) . ' Taka</p>
                            <form method="POST" action="add_to_cart.php">
                                <input type="hidden" name="product_name" value="' . htmlspecialchars($row['name'], ENT_QUOTES) . '">
                                <input type="hidden" name="product_price" value="' . $row['price'] . '">
                                <button type="submit" class="btn">Add to Cart</button>
                            </form>
                        </div>
                    ';
                }
            } else {
                echo "<p>No products found!</p>";
            }
            ?>
        </div>
    </div>

    <!-- Contact Us Section -->
    <div id="contact" class="container">
        <h2>Contact Us</h2>
        <form action="noaction.php" method="POST">
            <div class="form-group">
                <input type="text" name="name" placeholder="Enter your name" required>
            </div>
            <div class="form-group">
                <input type="email" name="email" placeholder="Enter your Email ID" required>
            </div>
            <div class="form-group">
                <input type="text" name="phone" placeholder="Enter your Phone Number" required>
            </div>
            <div class="form-group">
                <textarea name="message" placeholder="Enter your Message" required></textarea>
            </div>
            <button type="submit" class="btn">Submit</button>
        </form>
    </div>
</body>

</html>