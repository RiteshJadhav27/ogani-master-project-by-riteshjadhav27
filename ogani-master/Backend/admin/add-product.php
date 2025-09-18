<?php
include '../database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $stock = $_POST['stock'];

    // Image Upload Handling
    $image = $_FILES['image']['name'];
    $target = "../img/uploads/" . basename($image); // Upload path

    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        $sql = "INSERT INTO products (name, description, price, category, stock, image) VALUES ('$name', '$description', '$price', '$category', '$stock', '$image')";

        if ($conn->query($sql)) {
            header("Location: admin-dashboard.php");
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "Error uploading image!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Product</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body {
            display: flex;
            height: 100vh;
            background-color: #f8f9fa;
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
        .main-content {
            margin-left: 270px;
            width: calc(100% - 270px);
            padding: 20px;
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <h4>Admin Panel</h4>
    <a href="admin-dashboard.php"><i class="fas fa-home"></i> Dashboard</a>
    <a href="add-product.php"><i class="fas fa-plus"></i> Add Product</a>
    <a href="manage_product.php"><i class="fas fa-box"></i> Manage Products</a>
    <a href="received_orders.php"><i class="fas fa-shopping-cart"></i> Received Orders</a>
    <a href="index.php" class="btn btn-light w-100 mt-3" id="btn"><i class="fas fa-arrow-left"></i> Back to Home</a>
</div>

<!-- Main Content -->
<div class="main-content">
    <h2>Add Product</h2>
    <form method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label>Name:</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Description:</label>
            <textarea name="description" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label>Price:</label>
            <input type="number" name="price" step="0.01" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Category:</label>
            <input type="text" name="category" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Stock:</label>
            <input type="number" name="stock" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Upload Image:</label>
            <input type="file" name="image" class="form-control" accept="image/*" required>
        </div>
        <button type="submit" class="btn btn-success">Add Product</button>
    </form>
</div>

</body>
</html>
