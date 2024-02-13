<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';

session_start();
require_once "send_verification_email.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect user information
    $name = $_POST["name"];
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $password_confirmation = $_POST["password_confirmation"];

    // Validate password confirmation
    if ($password !== $password_confirmation) {
        echo "Passwords do not match.";
        exit;
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Store user information in session
    $_SESSION['name'] = $name;
    $_SESSION['email'] = $email;
    $_SESSION['username'] = $username;
    $_SESSION['password'] = $hashed_password;
    
    
    
    // Generate verification code and send email
    generateAndSendVerificationCode($email);
    echo "<script>window.location.href = 'verify.html';</script>";
    exit;
} else {
    echo "Invalid request method";
}


function generateAndSendVerificationCode($email) {
    $verificationCode = generateVerificationCode();
    
    $mail = new PHPMailer(true);
    $mail->CharSet = PHPMailer::CHARSET_UTF8; 
    $mail->SMTPAuth    = true;
    $mail->SMTPSecure  = 'ssl';
    $mail->Host        = 'smtp.gmail.com';
    $mail->Port        = 465;
    $mail->Mailer      = 'smtp';
    $mail->Username    = 'kitoko148@gmail.com';
    $mail->Password    = 'htql gtoq miks adkm';
    $mail->addAddress($email, 'Receiver');
    $mail->setFrom('kitoko148@gmail.com', 'Sender');
    $mail->isHTML(true);
    $mail->Subject     = 'Account Verification Code';
    $mail->Body        = "Your verification code is: $verificationCode";
    
    try {
        $mail->send();
        $_SESSION['verification_code'] = $verificationCode;
    } catch (Exception $e) {
        $response['error'] = $mail->ErrorInfo;
    }
}

function generateVerificationCode($length = 6) {
    return substr(str_shuffle("0123456789"), 0, $length);
}
?>
