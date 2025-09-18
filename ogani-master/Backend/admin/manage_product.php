<?php
include '../database.php';
$result = $conn->query("SELECT * FROM products");
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
        }
        .sidebar {
            width: 250px;
            background: #343a40;
            color: white;
            padding: 20px;
            height: 100vh;
            position: fixed;
        }
        .sidebar h4 {
            text-align: center;
            margin-bottom: 20px;
        }
        .sidebar a {
            display: block;
            color: white;
            padding: 10px;
            text-decoration: none;
            margin-bottom: 10px;
            border-radius: 5px;
        }
        #btn{
            color:rgb(29, 32, 36);
        }
        #btn:hover {
            color: white;
        }
        .sidebar a:hover {
            background: #495057;
        }
        .content {
            margin-left: 250px;
            padding: 20px;
            width: 100%;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
       
           
    <h4>Admin Panel</h4>
        <a href="index.php"><i class="fas fa-home"></i> Dashboard</a>
        <a href="add-product.php"><i class="fas fa-plus"></i> Add Product</a>
        <a href="manage_product.php"><i class="fas fa-box"></i> Manage Products</a>
        <a href="received_orders.php"><i class="fas fa-box"></i> Received Orders</a>
        <a href="index.php" class="btn btn-light w-100 mt-3" id="btn"><i class="fas fa-arrow-left"></i> Back to Home</a>
    </div>

    <!-- Main Content -->
    <div class="content">
        <h2>Product Management</h2>
        <a href="add-product.php" class="btn btn-primary mb-3">Add Product</a>
        <a href="received_orders.php" class="btn btn-primary mb-3">View Received Orders</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th><th>Name</th><th>Price</th><th>Category</th><th>Stock</th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['name'] ?></td>
                    <td>₹<?= $row['price'] ?></td>
                    <td><?= $row['category'] ?></td>
                    <td><?= $row['stock'] ?></td>
                    <td>
                        <a href="edit-product.php?id=<?= $row['id'] ?>" class="btn btn-warning">Edit</a>
                        <a href="delete-product.php?id=<?= $row['id'] ?>" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

</body>
</html>
