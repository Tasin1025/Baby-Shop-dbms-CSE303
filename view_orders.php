<?php
// Include database configuration
include 'db_config.php';

// Fetch orders from the database
$sql = "SELECT * FROM orders";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Orders - Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <style>
    /* Table Styling */
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 30px;
        box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
    }

    th,
    td {
        padding: 15px;
        text-align: left;
        font-size: 16px;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #ff6384;
        color: white;
        font-weight: bold;
        text-transform: uppercase;
    }

    tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    tr:hover {
        background-color: #ff6384;
        color: white;
    }

    /* Container Styling */
    .container {
        max-width: 1100px;
        margin: 50px auto;
        padding: 20px;
        background: white;
        box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
    }

    h1 {
        font-size: 28px;
        color: #333;
        margin-bottom: 30px;
        text-align: center;
    }

    /* Scrollable Table */
    .table-wrapper {
        overflow-x: auto;
        max-width: 100%;
    }
    </style>
</head>

<body>
    <header class="header">
        <!-- Left Section for Logo -->
        <div class="left">
            <div>KonkaBabyShop</div>
        </div>

        <!-- Middle Section for Navigation -->
        <div class="mid">
            <ul class="navbar">
                <li><a href="index.php">Home</a></li>
                <li><a href="view_orders.php" class="active">View Orders</a></li>
            </ul>
        </div>

        <!-- Right Section for Logout -->
        <div class="right">
            <a href="logout.php" class="btn">Logout</a>
        </div>
    </header>

    <!-- Main Content Section -->
    <div class="container">
        <h1>View Orders</h1>

        <!-- Orders Table Wrapper -->
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Product Name</th>
                        <th>Product Price (Taka)</th>
                        <th>Delivery Address</th>
                        <th>Order Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Check if there are any orders
                    if ($result->num_rows > 0) {
                        // Output data of each order
                        while ($row = $result->fetch_assoc()) {
                            echo '
                            <tr>
                                <td>' . $row['id'] . '</td>
                                <td>' . htmlspecialchars($row['product_name'], ENT_QUOTES) . '</td>
                                <td>' . number_format($row['product_price'], 2) . '</td>
                                <td>' . htmlspecialchars($row['address'], ENT_QUOTES) . '</td>
                                <td>' . $row['order_date'] . '</td>
                            </tr>
                            ';
                        }
                    } else {
                        echo "<tr><td colspan='5' style='text-align:center;'>No orders found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>