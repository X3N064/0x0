<?php
session_start(); // Start a session
ob_start(); // Start output buffering

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include database connection
    require_once "db.php";

    // Define email/username and password from the form
    $identifier = $_POST['username']; // Assuming the input field is named 'username' in HTML
    $password = $_POST['password'];

    // SQL injection prevention
    $identifier = stripslashes($identifier);
    $password = stripslashes($password);
    $identifier = mysqli_real_escape_string($conn, $identifier);

    // Query to retrieve user data based on email/username
    $query = "SELECT * FROM users WHERE username='$identifier' OR email='$identifier'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    // Check if user exists
    if ($row) {
        // Verify password
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $row['username']; // Set session variable
            echo "Login successful!";
            // Redirect to some page after successful login
            header("Location: http://ai.0x0.kr"); // Change this to the desired location
            exit;
        } else {
            echo "Invalid email/username or password.";
        }
    } else {
        echo "Invalid email/username or password.";
    }
}
ob_end_flush(); // Flush the buffer and send the output to the browser
?>
