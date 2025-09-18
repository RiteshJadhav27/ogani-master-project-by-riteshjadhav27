<?php
// admin_register.php
session_start();
include "database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $phone = trim($_POST['phone']);
    $role = 'admin'; // Default role for admin

    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>'; // Include SweetAlert2

    // Check if email already exists
    $check_sql = "SELECT * FROM users WHERE email=?";
    $stmt = $conn->prepare($check_sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // SweetAlert for Duplicate Email
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Email Already Exists!',
                text: 'Please use another email to register.'
            });
        </script>";
    } else {
        // Insert new admin
        $sql = "INSERT INTO users (name, email, password, phone, role) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $name, $email, $password, $phone, $role);

        if ($stmt->execute()) {
            // SweetAlert for Successful Registration
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Admin Registered Successfully!',
                    text: 'Redirecting to login...',
                    timer: 2000,
                    showConfirmButton: false
                }).then(() => {
                    window.location.href = './index.php';
                });
            </script>";
        } else {
            // SweetAlert for Database Error
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Registration Failed!',
                    text: 'Something went wrong. Please try again later.'
                });
            </script>";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Register</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            max-width: 400px;
            margin: auto;
            margin-top: 80px;
            padding: 20px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <h2 class="text-center">Admin Register</h2>
            <form method="post">
                <div class="mb-3">
                    <input type="text" name="name" class="form-control" placeholder="Full Name" required>
                </div>
                <div class="mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                </div>
                <div class="mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                </div>
                <div class="mb-3">
                    <input type="text" name="phone" class="form-control" placeholder="Phone">
                </div>
                <button type="submit" class="btn btn-success w-100">Register</button>
                <p class="mt-3 text-center">Already have an account? <a href="index.php">Login</a></p>
            </form>
        </div>
    </div>
</body>
</html>
