<?php
require_once "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
    if (mysqli_query($conn, $sql)) {
        echo "Registration successful.";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>
