<?php
session_start();
include './Backend/database.php'; // Include database connection


if (!isset($_SESSION["user"])) {
    echo "<script>alert('Please log in to view your orders.'); window.location.href='login.php';</script>";
    exit();
}

$user_email = $_SESSION['user']; // Now using the correct session key


// Fetch user orders
$sql = "SELECT * FROM orders WHERE email = ? ORDER BY order_date DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user_email);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders</title>
    <style>
        /* my_orders.css */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 20px;
}

.container {
    max-width: 90%;
    margin: auto;
    background: white;
    padding: 20px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
}

h2 {
    text-align: center;
    margin-bottom: 20px;
}

table {
    width: 100%;
    border-collapse: collapse;
    background: white;
}

thead {
    background: #333;
    color: white;
}

th, td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

tr:hover {
    background-color: #f1f1f1;
}

.no-orders {
    text-align: center;
    font-size: 18px;
    color: #777;
    margin-top: 20px;
}

/* Status Colors */
.pending { color: orange; }
.completed { color: green; font-weight: bold; }
.cancelled { color: red; font-weight: bold; }

    </style>
</head>
<body>

    <h2>My Orders</h2>

    <?php if ($result->num_rows > 0): ?>
        <table border="1">
            <tr>
                <th>Order ID</th>
                <th>Order Details</th>
                <th>Total Amount</th>
                <th>Status</th>
                <th>Order Date</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td>#<?php echo $row["order_id"]; ?></td>
                    <td><?php echo htmlspecialchars($row["order_details"]); ?></td>
                    <td>₹<?php echo $row["total_amount"]; ?></td>
                    <td><?php echo $row["status"]; ?></td>
                    <td><?php echo $row["order_date"]; ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>You have not placed any orders yet.</p>
    <?php endif; ?>

</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
