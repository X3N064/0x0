<?php

$host = "localhost";
$dbname = "creds";
$username = "root";
$password = "Tlagus47880112++**";


$mysqli = new mysqli(hostname: $host,
                     username: $username,
                     password: $password,
                     database: $dbname);

if ($mysqli->connect_errno) {
    die("Connection error: " . $mysqli->connect_error);
}

return $mysqli;
