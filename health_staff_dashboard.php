<?php
session_start();

// Restrict access to health staff only
if (!isset($_SESSION['user_email']) || $_SESSION['user_role'] !== 'health_staff') {
    header("Location: ../login.html");
    exit();
}

// Include DB config
require_once("db_config.php");

// Fetch appointments
$appointments = $conn->query("SELECT * FROM appointments");

// Fetch health records
$records = $conn->query("SELECT * FROM health_records");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Health Staff Dashboard</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f8fb;
        }

        .sidebar {
            width: 220px;
            height: 100vh;
            background-color: #2c3e50;
            position: fixed;
            color: white;
            padding: 20px;
        }

        .sidebar h2 {
            font-size: 24px;
            margin-bottom: 30px;
        }

        .sidebar a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 10px;
        }

        .sidebar a:hover {
            background-color: #1abc9c;
        }

        .logout {
            background-color: #e74c3c;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 6px;
            margin-top: 20px;
            display: inline-block;
            text-align: center;
        }

        .content {
            margin-left: 240px;
            padding: 30px;
        }

        h1, h2 {
            color: #2c3e50;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #1abc9c;
            color: white;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <h2>Health Staff</h2>
    <a href="#appointments">📅 Appointments</a>
    <a href="#records">📝 Health Records</a>
    <a class="logout" href="logout.php">Logout</a>
</div>

<div class="content">
    <h1>Welcome, Health Staff!</h1>

    <h2 id="appointments">📅 Booked Appointments</h2>
    <table>
        <tr>
            <th>Student Email</th>
            <th>Date</th>
            <th>Time</th>
            <th>Reason</th>
        </tr>
        <?php while ($row = $appointments->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['email'] ?? 'N/A') ?></td>
                <td><?= htmlspecialchars($row['appointment_date'] ?? 'N/A') ?></td>
                <td><?= htmlspecialchars($row['appointment_time'] ?? 'N/A') ?></td>
                <td><?= htmlspecialchars($row['reason'] ?? 'N/A') ?></td>
            </tr>
        <?php endwhile; ?>
    </table>

    <h2 id="records">📝 Health Records</h2>
    <table>
        <tr>
            <th>Student Email</th>
            <th>Symptoms</th>
            <th>Temperature (°C)</th>
            <th>Date</th>
        </tr>
        <?php while ($row = $records->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['email'] ?? 'N/A') ?></td>
                <td><?= htmlspecialchars($row['symptoms'] ?? 'N/A') ?></td>
                <td><?= htmlspecialchars($row['temperature'] ?? 'N/A') ?></td>
                <td><?= htmlspecialchars($row['record_date'] ?? 'N/A') ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
</div>

</body>
</html>
