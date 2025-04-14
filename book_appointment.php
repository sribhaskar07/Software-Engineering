<?php
session_start();
include 'db_connect.php';

// Redirect if user is not logged in
if (!isset($_SESSION['user']['id'])) {
    header("Location: php/appointment_success.php");
exit();

}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $_SESSION['user']['id'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $reason = $_POST['reason'];

    $stmt = $conn->prepare("INSERT INTO appointments (student_id, date, time, reason, status) VALUES (?, ?, ?, ?, 'Pending')");
    $stmt->bind_param("isss", $student_id, $date, $time, $reason);

    if ($stmt->execute()) {
        $message = "Appointment booked successfully!";
    } else {
        $message = "Error: " . $conn->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Book Appointment - CHMS</title>
    <link rel="stylesheet" href="../css/student_dashboard.css">
    <style>
        .form-container {
            max-width: 600px;
            margin: 50px auto;
            background: #fff;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .form-container h2 {
            margin-bottom: 20px;
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }
        input, textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }
        .submit-btn {
            background-color: #007ACC;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 6px;
            cursor: pointer;
        }
        .submit-btn:hover {
            background-color: #005f99;
        }
        .message {
            margin-top: 15px;
            color: green;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Book Appointment</h2>
        <form method="POST" action="">
            <div class="form-group">
                <label for="date">Appointment Date:</label>
                <input type="date" id="date" name="date" required>
            </div>
            <div class="form-group">
                <label for="time">Appointment Time:</label>
                <input type="time" id="time" name="time" required>
            </div>
            <div class="form-group">
                <label for="reason">Reason for Appointment:</label>
                <textarea id="reason" name="reason" rows="4" required></textarea>
            </div>
            <button type="submit" class="submit-btn">Book Appointment</button>
        </form>

        <?php if (!empty($message)) echo "<div class='message'>$message</div>"; ?>
    </div>
</body>
</html>
