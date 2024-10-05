<?php
$servername = "localhost: 3305";
$username = "root"; // Adjust to your MySQL username
$password = ""; // Adjust to your MySQL password
$dbname = "entry_keeper_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
