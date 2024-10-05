<?php
// Start session
session_start();

// Check if the user is logged in, if yes redirect to dashboard
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: pages/dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entry Keeper - Welcome</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/styles.css" rel="stylesheet">
</head>
<body>

<div class="jumbotron text-center bg-info text-white">
    <h1 class="display-4">Welcome to Entry Keeper</h1>
    <p class="lead">Your digital solution for managing visitor entries and check-ins.</p>
    <hr class="my-4">
    <p>Click the button below to login or register.</p>
    <a class="btn btn-primary btn-lg" href="pages/login.php" role="button">Login</a>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
