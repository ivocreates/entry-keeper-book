<?php
// Database configuration
define('DB_SERVER', 'localhost:3305');
define('DB_USERNAME', 'root'); // Change this to your MySQL username
define('DB_PASSWORD', ''); // Change this to your MySQL password
define('DB_NAME', 'entry_keeper_db');

// Other configuration (optional)
// You can add constants for file paths, timezones, etc.
define('UPLOAD_DIR', '../uploads/visitor_images/');
define('EXPORT_DIR', '../exports/reports/');

// Timezone
date_default_timezone_set('America/New_York');

// Attempt to connect to MySQL database
$connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if($connection === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>
