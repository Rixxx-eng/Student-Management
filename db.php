<?php
$host = "localhost";
$user = "root"; // default in Laragon
$pass = "";     // default empty
$db   = "student_db";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
