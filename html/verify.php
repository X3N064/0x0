<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if verification code matches
    if ($_POST['verification_code'] === $_SESSION['verification_code']) {
        // Verification successful, save user to database
        require_once "db.php";

        $name = $_SESSION['name'];
        $email = $_SESSION['email'];
        $username = $_SESSION['username'];
        $password = $_SESSION['password'];

        $sql = "INSERT INTO users (name, email, username, password) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            echo "SQL error: " . $conn->error;
            exit;
        }

        $stmt->bind_param("ssss", $name, $email, $username, $password);

        if ($stmt->execute()) {
            // User successfully registered, redirect to login page
            header("Location: registered.html");
            exit;
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Invalid verification code!";
    }
} else {
    echo "Invalid request method";
}
?>
