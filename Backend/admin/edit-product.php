<?php
include '../database.php';

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM products WHERE id=$id");
$product = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $stock = $_POST['stock'];

    $sql = "UPDATE products SET name='$name', description='$description', price='$price', category='$category', stock='$stock' WHERE id=$id";
    if ($conn->query($sql)) {
        header("Location: admin-dashboard.php");
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Product</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Product</h2>
        <form method="post">
            <div class="mb-3">
                <label>Name:</label>
                <input type="text" name="name" value="<?= $product['name'] ?>" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Description:</label>
                <textarea name="description" class="form-control"><?= $product['description'] ?></textarea>
            </div>
            <div class="mb-3">
                <label>Price:</label>
                <input type="number" name="price" value="<?= $product['price'] ?>" step="0.01" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Category:</label>
                <input type="text" name="category" value="<?= $product['category'] ?>" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Stock:</label>
                <input type="number" name="stock" value="<?= $product['stock'] ?>" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Product</button>
        </form>
    </div>
</body>
</html>
