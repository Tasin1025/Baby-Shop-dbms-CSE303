<?php
include 'db_config.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "DELETE FROM cart WHERE id = $id";

    if ($conn->query($sql)) {
        header("Location: cart.php");
        exit();
    } else {
        echo "Error deleting item.";
    }
}
?>
