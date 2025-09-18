<?php
include '../database.php';

// Fetch summary data
$totalProducts = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS count FROM products"))['count'];
$totalOrders = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS count FROM orders"))['count'];
$totalUsers = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS count FROM users WHERE role='customer'"))['count'];

// Fetch recent orders
$recentOrders = mysqli_query($conn, "SELECT * FROM orders ORDER BY order_id DESC LIMIT 5");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body {
            display: flex;
            min-height: 100vh;
            background: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }
        .sidebar .profile {
            margin-bottom: 20px;
        }
        .sidebar .profile i {
            font-size: 50px;
            color: #f8f9fa;
        }
        .sidebar {
            width: 250px;
            background-color: #343a40;
            color: white;
            padding-top: 20px;
            position: fixed;
            height: 100vh;
            text-align: center;
        }
        
        .sidebar h3 {
            font-size: 20px;
            margin-top: 10px;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 16px;
            text-align: left;
            font-size: 18px;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
        .content {
            margin-left: 250px;
            padding: 30px;
            width: 100%;
        }
        .dashboard-cards {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }
        .card {
            flex: 1;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: 0.3s ease-in-out;
            min-width: 250px;
        }
        .card i {
            font-size: 40px;
            margin-bottom: 10px;
            color:#28a745;
        }
        .card h4 {
            font-size: 18px;
            margin-bottom: 10px;
            color: #333;
        }
        .card p {
            font-size: 22px;
            font-weight: bold;
            color:#28a745;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0px 6px 15px rgba(0, 0, 0, 0.2);
        }
        .recent-orders {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        .recent-orders h3 {
            margin-bottom: 15px;
            color: #343a40;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        thead {
            background: #28a745;
            color: white;
        }
        tbody tr:hover {
            background: #f1f1f1;
        }
        .status {
            font-weight: bold;
            padding: 5px 10px;
            border-radius: 5px;
        }
        .status.Pending { background: #ffc107; color: black; }
        .status.Confirm { background: #17a2b8; color: white; }
        .status.Shipped { background: #007bff; color: white; }
        .status['Out for Delivery'] { background: #fd7e14; color: white; }
        .status.Delivered { background: #28a745; color: white; }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="profile">
            <i class="fas fa-user-circle"></i>
            <h3>Admin Panel</h3>
        </div>
        <a href="index.php"><i class="fas fa-home"></i> Dashboard</a>
        <a href="./add-product.php"><i class="fas fa-plus"></i> Add Product</a>
        <a href="manage_product.php"><i class="fas fa-box"></i> Manage Products</a>
        <a href="received_orders.php"><i class="fas fa-shopping-cart"></i> Received Orders</a>
        <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>

    <!-- Main Content -->
    <div class="content">
        <h2>Welcome, Admin!</h2>
        <p>Manage Organic Fruitmart from here.</p>

        <!-- Dashboard Summary Cards -->
        <div class="dashboard-cards">
            <div class="card">
                <i class="fas fa-box"></i>
                <h4>Total Products</h4>
                <p><?php echo $totalProducts; ?></p>
            </div>
            <div class="card">
                <i class="fas fa-shopping-cart"></i>
                <h4>Total Orders</h4>
                <p><?php echo $totalOrders; ?></p>
            </div>
            <div class="card">
                <i class="fas fa-users"></i>
                <h4>Total Customers</h4>
                <p>100+</p>
            </div>
        </div>

        <!-- Recent Orders -->
        <div class="recent-orders">
            <h3>Recent Orders</h3>
            <table>
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Customer</th>
                        <th>Total</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($recentOrders)) { ?>
                    <tr>
                        <td><?php echo $row['order_id']; ?></td>
                        <td><?php echo $row['username']; ?></td>
                        <td>₹<?php echo $row['total_amount']; ?></td>
                        <td><span class="status <?php echo $row['status']; ?>"><?php echo $row['status']; ?></span></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
