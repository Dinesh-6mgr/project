<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Contact Result</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "dinesh rana magar"; // your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form values
$fullname = $_POST['fullname'];
$email    = $_POST['email'];
$subject  = $_POST['subject'];
$message  = $_POST['message'];

// Insert into table
$sql = "INSERT INTO `rana` (`fullname`, `email`, `subject`, `message`)
        VALUES ('$fullname', '$email', '$subject', '$message')";

if ($conn->query($sql) === TRUE) {
    // Redirect to landing page on success
    header("Location:massage.html");
    exit();
} else {

    header("Location:error.html");
    exit();
}




$conn->close();
?>
</body>
</html>
