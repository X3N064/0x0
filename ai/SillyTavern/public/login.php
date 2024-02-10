<?php
session_start();
require_once "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Perform your authentication here
    $sql = "SELECT * FROM users WHERE (username = '$username' OR email = '$username') AND password = '$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $_SESSION['username'] = $username;
        header("Location: main.html");
    } else {
        echo "Invalid username or password.";
    }
}
?>
