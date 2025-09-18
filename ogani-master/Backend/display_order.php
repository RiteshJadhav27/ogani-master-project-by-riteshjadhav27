<?php
include 'database.php'; // Include your database connection file

header('Content-Type: application/json');

$user_id = 1; // Replace this with the logged-in user's ID (make it dynamic)

// Fetch user orders
$query = "SELECT * FROM orders WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$orders = [];

while ($row = $result->fetch_assoc()) {
    $orders[] = $row;
}

echo json_encode($orders);

$stmt->close();
$conn->close();
?>
