<?php
include 'db_config.php';

$sql = "DELETE FROM cart";

if ($conn->query($sql)) {
    header("Location: cart.php");
    exit();
} else {
    echo "Error clearing cart.";
}
?>
