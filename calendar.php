<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    // Redirect to login page if not logged in
    header("Location: upload_calendar.php");
    exit();
}

// If logged in, show the upload calendar page
?>
<!DOCTYPE html>
<html>
<head>
    <title>Upload Calendar</title>
</head>
<body>
    <h2>Welcome, Admin!</h2>
    <a href="calendar.php">📅 Go to Calendar Upload</a>
    <br><br>
    <a href="logout.php">🔓 Logout</a>
</body>
</html>
