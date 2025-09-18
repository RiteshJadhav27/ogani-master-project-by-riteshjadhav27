<?php
session_start();
include("../database.php"); // Include database connection

// Check if the admin is logged in
if (!isset($_SESSION["user"]) || $_SESSION["role"] !== "admin") {
    echo json_encode(["success" => false, "message" => "Unauthorized access!"]);
    exit();
}

// Check if order ID is provided
if (!isset($_POST["order_id"])) {
    echo json_encode(["success" => false, "message" => "Order ID is required!"]);
    exit();
}

$order_id = intval($_POST["order_id"]); // Ensure it's an integer

// Delete order from the database
$sql = "DELETE FROM orders WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $order_id);

if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "Order deleted successfully!"]);
} else {
    echo json_encode(["success" => false, "message" => "Failed to delete order!"]);
}

$stmt->close();
$conn->close();
?>
