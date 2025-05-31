<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "dinesh_rana_magar";




// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

