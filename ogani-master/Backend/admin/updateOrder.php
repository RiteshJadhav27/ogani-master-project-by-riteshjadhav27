<?php
include '../database.php'; // Include database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $order_id = $_POST['order_id'];
    $status = $_POST['status'];

    // Update the order status in the database
    $query = "UPDATE orders SET status = ? WHERE order_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $status, $order_id);

    if ($stmt->execute()) {
        echo "<script>alert('Order status updated successfully!'); window.location.href='received_orders.php';</script>";
    } else {
        echo "<script>alert('Failed to update order status.'); window.location.href='received_orders.php';</script>";
    }

    $stmt->close();
}

$conn->close();
?>
