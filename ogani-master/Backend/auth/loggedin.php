<?php
session_start();
header("Content-Type: application/json");

$response = ["stat" => false];

if (isset($_SESSION["user"])) {
    include("./database.php");

    $email = $_SESSION["user"]; // Email is stored in session
    $sql = "SELECT name, email FROM users WHERE email=?"; // Fetch both name and email
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        $response = [
            "stat" => true,
            "user" => [
                "name" => $row["name"],
                "email" => $row["email"] // Include email in response
            ]
        ];
    }
}

echo json_encode($response);
?>
