<?php

$user_agent = $_SERVER['HTTP_USER_AGENT'];
if (strpos($user_agent, 'Edg') !== false) {
    // User is using Microsoft Edge, allow access
    header("Location: https://ai.0x0.kr");
} else {
    // Redirect or display an error message for other browsers
    header("Location: ./useEdge.html");
    exit();
} 
?>                 
