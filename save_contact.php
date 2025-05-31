<?php
include "dbconfig.php";
session_start();
include "unset_session.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Contact Result</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<?php


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
