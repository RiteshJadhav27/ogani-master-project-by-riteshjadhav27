<?php
session_start();
include("database.php");

$alertMessage = ""; // Variable to store alert message

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE email=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        if (password_verify($password, $row["password"])) {
            $_SESSION["user"] = $row["email"];
            $_SESSION["role"] = $row["role"];

            // Store success alert message
            $alertMessage = "
                Swal.fire({
                    icon: 'success',
                    title: 'Login Successful!',
                    text: 'Redirecting to dashboard...',
                    timer: 2000,
                    showConfirmButton: false
                }).then(() => {
                    window.location.href = './admin/index.php';
                });
            ";
        } else {
            // Store error alert message for wrong password
            $alertMessage = "
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid Password!',
                    text: 'Please check your password and try again.'
                });
            ";
        }
    } else {
        // Store error alert message for user not found
        $alertMessage = "
            Swal.fire({
                icon: 'warning',
                title: 'Admin Not Found!',
                text: 'Please check your email or register first.'
            });
        ";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Login</title>
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
            background: #fff;
            border-radius: 10px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card">
        <h2 class="text-center">Admin Login</h2>
        <form method="post">
            <div class="mb-3">
                <input type="email" name="email" class="form-control" placeholder="Email" required>
            </div>
            <div class="mb-3">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
            <p class="mt-3 text-center">Don't have an account? <a href="admin_register.php">Register</a></p>
        </form>
    </div>
</div>

<!-- Display SweetAlert2 message after page loads -->
<?php if (!empty($alertMessage)) : ?>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        <?php echo $alertMessage; ?>
    });
</script>
<?php endif; ?>

</body>
</html>
