<?php
include '../database.php';

$id = $_GET['id'];
$sql = "DELETE FROM products WHERE id=$id";

if ($conn->query($sql)) {
    header("Location: admin-dashboard.php");
} else {
    echo "Error: " . $conn->error;
}
?>
