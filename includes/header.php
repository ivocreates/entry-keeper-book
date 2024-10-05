<?php
// Start the session only if it's not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entry Keeper</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../assets/css/styles.css" rel="stylesheet">
    <!-- FontAwesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>

<div class="wrapper d-flex flex-column min-vh-100"> <!-- Wrapper for flexbox -->
    <!-- Sidebar -->
    <?php include '../sidebar.php'; ?>

    <div id="content" class="flex-grow-1"> <!-- Main content area grows to push footer down -->
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <!-- Sidebar Toggle Button -->
                <button type="button" id="sidebarCollapse" class="btn btn-info">
                    <i class="fas fa-bars"></i>
                    <span>Toggle Sidebar</span>
                </button>
                <!-- Dark Mode Toggle Button -->
                <button type="button" id="darkModeToggle" class="btn btn-secondary ml-auto">
                    <i class="fas fa-moon"></i> Dark Mode
                </button>
            </div>
        </nav>

        <!-- App Heading and Logo -->
        <div class="text-center my-4">
            <img src="../assets/img/logo.png" alt="Entry Keeper Logo" style="width: 419px; height: 419px;">
            <h1>Entry Keeper</h1>
        </div>

    <!-- Main content starts here -->
