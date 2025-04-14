<?php
session_start();
if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'student') {
    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Dashboard - CHMS</title>
    <link rel="stylesheet" href="css/student_dashboard.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            margin: 0;
        }
        .sidebar {
            width: 220px;
            background-color: #007ACC;
            color: white;
            height: 100vh;
            padding: 20px 0;
            position: fixed;
        }
        .sidebar h2 {
            text-align: center;
            margin-bottom: 30px;
        }
        .sidebar ul {
            list-style: none;
            padding: 0;
        }
        .sidebar ul li {
            padding: 15px 20px;
        }
        .sidebar ul li a {
            color: white;
            text-decoration: none;
        }
        .sidebar ul li a:hover {
            text-decoration: underline;
        }
        .main-content {
            margin-left: 240px;
            padding: 30px;
            flex-grow: 1;
            background-color: #f4f4f4;
            min-height: 100vh;
        }
        .section {
            display: none;
        }
        .section.active {
            display: block;
        }
        form {
            background: white;
            padding: 20px;
            border-radius: 10px;
            max-width: 500px;
        }
        form input, form textarea, form select, form button {
            display: block;
            width: 100%;
            padding: 10px;
            margin-top: 15px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }
        form button {
            background-color: #007ACC;
            color: white;
            border: none;
        }
        form button:hover {
            background-color: #005f99;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <h2>Student</h2>
    <ul>
        <li><a href="#" onclick="showSection('home')">Home</a></li>
        <li><a href="#" onclick="showSection('submitHealth')">Submit Health Record</a></li>
        <li><a href="#" onclick="showSection('appointment')">Book Appointment</a></li>
        <li><a href="#" onclick="showSection('notifications')">Notifications</a></li>
        <li><a href="php/logout.php">Logout</a></li>
    </ul>
</div>

<div class="main-content">
    <div id="home" class="section active">
        <h1>Welcome to CHMS Student Dashboard</h1>
        <p>Select an option from the sidebar to get started.</p>
    </div>

    <div id="submitHealth" class="section">
        <h2>Submit Health Record</h2>
        <form action="php/submit_health.php" method="POST">
            <label for="symptoms">Symptoms:</label>
            <textarea name="symptoms" id="symptoms" required></textarea>

            <label for="temperature">Body Temperature (°C):</label>
            <input type="number" name="temperature" step="0.1" required>

            <label for="date">Date:</label>
            <input type="date" name="date" required>

            <button type="submit">Submit Record</button>
        </form>
    </div>

    <div id="appointment" class="section">
        <h2>Book Appointment</h2>
        <form action="php/book_appointment.php" method="POST">
            <label for="date">Appointment Date:</label>
            <input type="date" name="date" required>

            <label for="time">Appointment Time:</label>
            <input type="time" name="time" required>

            <label for="reason">Reason:</label>
            <textarea name="reason" id="reason" required></textarea>

            <button type="submit">Book Appointment</button>
        </form>
    </div>

    <div id="notifications" class="section">
        <h2>Notifications</h2>
        <p>No new notifications.</p>
    </div>
</div>

<script>
    function showSection(id) {
        const sections = document.querySelectorAll('.section');
        sections.forEach(section => section.classList.remove('active'));
        document.getElementById(id).classList.add('active');
    }
</script>

</body>
</html>
