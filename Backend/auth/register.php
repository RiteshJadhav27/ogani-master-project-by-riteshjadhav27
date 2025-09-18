<?php
session_start();
include("./database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT);
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $role = "user";

    // Check if email already exists
    $checkSql = "SELECT * FROM users WHERE email = ?";
    $checkStmt = $conn->prepare($checkSql);
    $checkStmt->bind_param("s", $email);
    $checkStmt->execute();
    $result = $checkStmt->get_result();

    // Load SweetAlert before sending output
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";

    if ($result->num_rows > 0) {
        echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Email already exists! Try logging in.'
                    }).then(() => { window.location.href = '../../register.html'; });
                });
              </script>";
        exit();
    } else {
        $sql = "INSERT INTO users (name, email, password, phone, address, role) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssss", $name, $email, $password, $phone, $address, $role);

        if ($stmt->execute()) {
            $_SESSION["user"] = $email;
            $_SESSION["role"] = $role;
            echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'Registration Successful!',
                            text: 'Redirecting to login...'
                        }).then(() => { window.location.href = '../../login.html'; });
                    });
                  </script>";
            exit();
        } else {
            echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Something went wrong. Try again later.'
                        }).then(() => { window.location.href = '../../register.html'; });
                    });
                  </script>";
            exit();
        }
    }
}
?>
