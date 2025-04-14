<?php
session_start();
include 'php/db_connect.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $query = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // If you're storing plain text passwords (not recommended), use this:
        // if ($password === $user['password']) {

        // If you're using hashed passwords (recommended), use this:
        if (password_verify($password, $user['password'])) {
            // Set session values
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'];

            // Redirect based on role
            if ($user['role'] === 'student') {
                header("Location: ../php/submit_health.php");
                exit();
            } elseif ($user['role'] === 'health_staff') {
                header("Location: ../php/health_staff_dashboard.php");
                exit();
            } elseif ($user['role'] === 'admin') {
                header("Location: ../php/admin_dashboard.php");
                exit();
            } else {
                echo "<p style='color:red;'>Unknown role. Please contact admin.</p>";
            }
        } else {
            echo "<p style='color:red;'>Incorrect password.</p>";
        }
    } else {
        echo "<p style='color:red;'>User not found with that email.</p>";
    }

    $stmt->close();
    $conn->close();
}
?>
