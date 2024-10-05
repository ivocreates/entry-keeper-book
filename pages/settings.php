<?php
session_start();
include '../includes/header.php';
include '../includes/dbconnect.php';

// Handling settings form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $app_name = $_POST['app_name'];
    $theme = $_POST['theme'];
    $email_notifications = isset($_POST['email_notifications']) ? 1 : 0;
    $visitor_auto_checkout = isset($_POST['visitor_auto_checkout']) ? 1 : 0;

    // Update settings in the database
    $update_queries = [
        "UPDATE settings SET setting_value='$app_name' WHERE setting_key='app_name'",
        "UPDATE settings SET setting_value='$theme' WHERE setting_key='theme'",
        "UPDATE settings SET setting_value='$email_notifications' WHERE setting_key='email_notifications'",
        "UPDATE settings SET setting_value='$visitor_auto_checkout' WHERE setting_key='visitor_auto_checkout'"
    ];

    foreach ($update_queries as $query) {
        mysqli_query($conn, $query);
    }

    // Optional: Provide a success message
    $_SESSION['success'] = "Settings updated successfully!";
}

// Fetch settings from the database
$query = "SELECT setting_key, setting_value FROM settings";
$result = mysqli_query($conn, $query);

$settings = [];
while ($row = mysqli_fetch_assoc($result)) {
    $settings[$row['setting_key']] = $row['setting_value'];
}
?>

<div class="container mt-5">
    <h2>Application Settings</h2>
    
    <!-- Success message -->
    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success">
            <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
        </div>
    <?php endif; ?>

    <form method="post" action="">
        <!-- General Settings -->
        <div class="card mb-4">
            <div class="card-header">
                General Settings
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="app_name">Application Name</label>
                    <input type="text" class="form-control" name="app_name" value="<?php echo htmlspecialchars($settings['app_name'] ?? ''); ?>">
                </div>
                <div class="form-group">
                    <label for="theme">Theme</label>
                    <select class="form-control" name="theme">
                        <option value="light" <?php if ($settings['theme'] == 'light') echo 'selected'; ?>>Light</option>
                        <option value="dark" <?php if ($settings['theme'] == 'dark') echo 'selected'; ?>>Dark</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Visitor Settings -->
        <div class="card mb-4">
            <div class="card-header">
                Visitor Management Settings
            </div>
            <div class="card-body">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="visitor_auto_checkout" id="visitor_auto_checkout" 
                           <?php if (isset($settings['visitor_auto_checkout']) && $settings['visitor_auto_checkout'] == 1) echo 'checked'; ?>>
                    <label class="form-check-label" for="visitor_auto_checkout">Enable Auto Checkout for Visitors</label>
                </div>
            </div>
        </div>

        <!-- Notification Settings -->
        <div class="card mb-4">
            <div class="card-header">
                Notification Settings
            </div>
            <div class="card-body">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="email_notifications" id="email_notifications" 
                           <?php if (isset($settings['email_notifications']) && $settings['email_notifications'] == 1) echo 'checked'; ?>>
                    <label class="form-check-label" for="email_notifications">Enable Email Notifications</label>
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Save Settings</button>
    </form>
</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<script src="../assets/js/sidebar.js"></script>
<script src="../assets/js/script.js"></script>
<script>
    $(document).ready(function () {
        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').toggleClass('active');
        });
    });
</script>
</body>
</html>