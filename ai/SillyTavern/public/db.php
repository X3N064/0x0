<?php
$servername = "localhost";
$username = "root";
$password = "Tlagus47880112++**";
$dbname = "creds";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
