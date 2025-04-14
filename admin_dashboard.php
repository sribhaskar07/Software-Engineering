<?php
session_start();
if ($_SESSION['role'] !== 'admin') {
    echo "Access denied.";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <style>
        .dashboard-section {
            background-color: #f9f9f9;
            border: 1px solid #ccc;
            border-radius: 12px;
            padding: 20px;
            margin: 15px 0;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            transition: box-shadow 0.3s ease;
        }

        .dashboard-section:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .dashboard-section h3 {
            margin-top: 0;
            color: #333;
        }

        .dashboard-section a {
            display: inline-block;
            margin-top: 10px;
            padding: 8px 12px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 6px;
            transition: background-color 0.3s ease;
        }

        .dashboard-section a:hover {
            background-color: #0056b3;
        }

        h2 {
            margin-top: 0;
            color: #222;
        }
    </style>
</head>
<body>

<h2>Admin Dashboard</h2>

<div class="dashboard-section">
    <h3>User Management</h3>
    <a href="manage_users.php">Manage Users</a>
</div>

<div class="dashboard-section">
    <h3>Appointments</h3>
    <a href="admin_appointments.php">View All Appointments</a>
</div>

<div class="dashboard-section">
    <h3>Health Records</h3>
    <a href="admin_health_records.php">View Health Records</a>
</div>

<div class="dashboard-section">
    <h3>Notifications / Announcements (XSS Demo)</h3>
    <a href="admin_announcements.php">Post Announcement</a>
</div>

</body>
</html>
