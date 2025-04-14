<?php
session_start();
include 'db_connect.php';

// Check if user is logged in and has the student role
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
    echo "<p style='color:red; text-align:center;'>User session not found. Please log in again.</p>";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Submit Health Record - CHMS</title>
    <link rel="stylesheet" type="text/css" href="../css/student_dashboard.css">
    <style>
        .form-container {
            margin-left: 260px;
            padding: 20px;
        }
        .form-container h2 {
            margin-bottom: 20px;
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            font-weight: bold;
            display: block;
        }
        .form-group input, .form-group textarea {
            width: 100%;
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 14px;
        }
        .form-group textarea {
            resize: vertical;
        }
        .submit-btn {
            padding: 10px 20px;
            background-color: #007ACC;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }
        .submit-btn:hover {
            background-color: #005f99;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>Student</h2>
        <a href="../dashboard_student.php">Home</a>
        <a href="submit_health.php">Submit Health Record</a>
        <a href="#">Book Appointment</a>
        <a href="#">Notifications</a>
        <a href="../logout.php">Logout</a>
    </div>

    <div class="form-container">
        <h2>Submit Your Health Record</h2>
        <form method="POST" action="">
            <div class="form-group">
                <label for="symptoms">Symptoms</label>
                <input type="text" name="symptoms" id="symptoms" required>
            </div>
            <div class="form-group">
                <label for="temperature">Body Temperature (°C)</label>
                <input type="number" step="0.1" name="temperature" id="temperature" required>
            </div>
            <div class="form-group">
                <label for="notes">Additional Notes</label>
                <textarea name="notes" id="notes" rows="4" placeholder="Optional..."></textarea>
            </div>
            <button type="submit" class="submit-btn">Submit</button>
        </form>
        <br>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $student_id = $_SESSION['user_id'];
            $symptoms = $_POST['symptoms'] ?? '';
            $temperature = $_POST['temperature'] ?? '';
            $notes = $_POST['notes'] ?? '';

            $query = "INSERT INTO health_records (user_id, symptoms, temperature, notes, submitted_at)
                      VALUES (?, ?, ?, ?, NOW())";

            $stmt = $conn->prepare($query);
            $stmt->bind_param("isss", $student_id, $symptoms, $temperature, $notes);

            if ($stmt->execute()) {
                echo "<p style='color:green;'>Health record submitted successfully.</p>";
            } else {
                echo "<p style='color:red;'>Error: " . $conn->error . "</p>";
            }

            $stmt->close();
            $conn->close();
        }
        ?>
    </div>
</body>
</html>
