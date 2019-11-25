<?php


$db = 'chat';
$user = 'root';
$pass = '';
$server = 'localhost';

// Create connection
$conn = new mysqli($server, $user, $pass, $db);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
