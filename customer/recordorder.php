<?php
session_start();  // Start session
include("connectdb.php");  // Include database connection

// Initialize total sum variable
$total = 0;

// Calculate the total price for the order
if (isset($_SESSION['sid'])) {
    foreach ($_SESSION['sid'] as $index => $pid) {
        // Calculate sum per product
        $sum[$pid] = $_SESSION['sprice'][$pid] * $_SESSION['sitem'][$pid];
        // Accumulate total
        $total += $sum[$pid];
    }
    
    // Insert into `orders` table
    $sql = "INSERT INTO `orders` (`id`, `total`, `order_date`, `status`) VALUES (NULL, '$total', CURRENT_TIMESTAMP, '0');";
    
    // Check if the query was successful
    if (mysqli_query($conn, $sql)) {
        // Get the last inserted order ID
        $order_id = mysqli_insert_id($conn);
        
        // Insert order details
        foreach ($_SESSION['sid'] as $index => $pid) {
            $item_quantity = $_SESSION['sitem'][$pid];  // Quantity of the item
            $sql2 = "INSERT INTO `orders_detail` (`id`, `order_id`, `product_id`, `quantity`) VALUES (NULL, '$order_id', '$pid', '$item_quantity');";
            
            // Execute query and check if successful
            if (!mysqli_query($conn, $sql2)) {
                echo "Error inserting order details: " . mysqli_error($conn);
            }
        }
        
        // Redirect to cosclear.php after successful order
        header("Location: cosclear.php");
        exit();  // Ensure no further code is executed after redirect
    } else {
        // Display error if order insertion failed
        echo "Error inserting order: " . mysqli_error($conn);
    }
} else {
    echo "No items in the cart to process.";
}

// Close the connection
mysqli_close($conn);
?>
