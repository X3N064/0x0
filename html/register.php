<?php
require_once "db.php";

// Check if form data is received
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate input
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    // Hash the password securely
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    // Prepare SQL statement with placeholders
    $sql = "INSERT INTO users (name, email, username, password) 
            VALUES (?, ?, ?, ?)";

    // Prepare the statement
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("SQL error: " . $conn->error);
    }

    // Bind parameters to the prepared statement
    $stmt->bind_param("ssss", $name, $email, $username, $password);

    // Execute the statement
    if ($stmt->execute()) {
        header("Location: registered.html");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
} else {
    echo "Invalid request method";
}

// Close the connection
$conn->close();
?>
