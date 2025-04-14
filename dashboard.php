<?php
session_start();
if (!isset($_SESSION['role'])) {
    header("Location: login.php");
    exit();
}

$role = $_SESSION['role'];

include 'header.php'; // Optional: common header
include 'sidebar.php'; // Optional: common sidebar

echo "<div class='main-content'>";
if ($role === 'student') {
    include 'student_dashboard.php';
} elseif ($role === 'health_staff') {
    include 'health_dashboard.php';
} elseif ($role === 'admin') {
    include 'admin_dashboard.php';
} else {
    echo "<p>Unauthorized access.</p>";
}
echo "</div>";

include 'footer.php'; // Optional: common footer
?>
