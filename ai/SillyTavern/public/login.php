<?php
$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $mysqli = require __DIR__ . "/db.php";

    // Escape user input to prevent SQL injection
    $input = $mysqli->real_escape_string($_POST["email_or_username"]);

    // Check if the input is a valid email address
    if (filter_var($input, FILTER_VALIDATE_EMAIL)) {
        $whereClause = "email = '$input'";
    } else {
        $whereClause = "username = '$input'";
    }
    
    $sql = "SELECT * FROM user WHERE $whereClause";
    
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
    
    if ($user && password_verify($_POST["password"], $user["password_hash"])) {
            
        session_start();
        session_regenerate_id();
        $_SESSION["user_id"] = $user["id"];
        header("Location: http://ai.0x0.kr");
        exit;
    }
    
    $is_invalid = true;
}

?>
