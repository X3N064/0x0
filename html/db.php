<?php

$host = "localhost";
$dbname = "creds";
$port = 3306;
$username = "admin";
$password = "Qwer1234**";

//Create a new MySQLi object for database connection
$conn = new mysqli($host, $username, $password, $dbname, $port);

// Check if the connection was successful
if ($conn->connect_error) {
    // If connection failed, print an error message and terminate script
        die("Connection failed: " . $conn->connect_error);
}

// If connection succeeded, print a success message
// echo "DB connected";
?>

