<?php

$host = "3.38.79.93";
$port = 58923;
$dbname = "creds";
$username = "root";
$password = "Qwer1234**";

$conn = new mysqli($host, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
