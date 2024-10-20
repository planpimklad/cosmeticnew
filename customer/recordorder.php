<?php
session_start();
include("connectdb.php"); // Ensure this file contains correct DB credentials

// Initialize total to avoid undefined variable warnings
$total = 0;

// Calculate the total amount for the order
if (isset($_SESSION['sid']) && count($_SESSION['sid']) > 0) {
    foreach ($_SESSION['sid'] as $pid) {
        $sum[$pid] = $_SESSION['sprice'][$pid] * $_SESSION['sitem'][$pid];
        $total += $sum[$pid];
    }

    // Insert the new order into the 'orders' table
    $sql = "INSERT INTO `orders` (total, order_date, status) VALUES ('$total', CURRENT_TIMESTAMP, '0')";
    if (mysqli_query($conn, $sql)) {
        // Get the last inserted order ID
        $order_id = mysqli_insert_id($conn);

        // Insert each product into 'orders_detail' table
        foreach ($_SESSION['sid'] as $pid) {
            $product_id = $_SESSION['sid'][$pid];
            $quantity = $_SESSION['sitem'][$pid];

            // Insert order details
            $sql2 = "INSERT INTO orders_detail (order_id, product_id, quantity) VALUES ('$order_id', '$product_id', '$quantity')";
            if (!mysqli_query($conn, $sql2)) {
                die("Error inserting order detail: " . mysqli_error($conn));
            }
        }

        // Redirect to the cosclear.php page after successful order placement
        header("Location: cosclear.php");
        exit();
    } else {
        die("Error inserting order: " . mysqli_error($conn));
    }
} else {
    echo "No products in the cart.";
}

mysqli_close($conn);
?>
