<?php
session_start();
include("./database.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>User Login</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <?php
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
                
                if ($row["role"] === "admin") {
                    echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Login Successful!',
                            text: 'Redirecting to admin panel...',
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => {
                            window.location.href = '../admin/dashboard.php';
                        });
                    </script>";
                } else {
                    echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Login Successful!',
                            text: 'Redirecting to homepage...',
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => {
                            window.location.href = '../../homepage.html';
                        });
                    </script>";
                }
                exit();
            } else {
                echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Invalid Password!',
                        text: 'Please check your password and try again.'
                    });
                </script>";
            }
        } else {
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'User Not Found!',
                    text: 'No account exists with this email.'
                });
            </script>";
        }
    }
    ?>
</body>
</html>
