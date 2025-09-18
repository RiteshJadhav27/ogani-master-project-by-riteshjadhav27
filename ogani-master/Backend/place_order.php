<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'database.php'; // Include database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['first_name'] . ' ' . $_POST['last_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $address = mysqli_real_escape_string($conn, $_POST['address'] . ', ' . ($_POST['apartment'] ?? '') . ', ' . $_POST['city'] . ', ' . $_POST['state'] . ', ' . $_POST['zipcode']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $order_notes = mysqli_real_escape_string($conn, $_POST['order_notes'] ?? '');
    $total_amount = mysqli_real_escape_string($conn, $_POST['total_amount']);
    $status = "Pending"; // Default status

    // Get order details (Product Name + Quantity)
    $order_details = mysqli_real_escape_string($conn, $_POST['order_details']);

    // Insert order into 'orders' table
    $sql = "INSERT INTO orders (username, email, address, phone, order_details, total_amount, order_notes, status) 
            VALUES ('$username', '$email', '$address', '$phone', '$order_details', '$total_amount', '$order_notes', '$status')";

    if (mysqli_query($conn, $sql)) {
        echo json_encode(["success" => true, "message" => "Order placed successfully!"]);
    } else {
        echo json_encode(["success" => false, "message" => "Error placing order: " . mysqli_error($conn)]);
    }

    mysqli_close($conn);
} else {
    echo json_encode(["success" => false, "message" => "Invalid request"]);
}
ini_set("log_errors", 1);
ini_set("error_log", "error_log.txt");

?>
