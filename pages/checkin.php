<?php
session_start();
include '../includes/header.php';
include '../includes/dbconnect.php';

// Initialize variables for the form
$name = $email = $phone = $type = $department = $purpose = "";
$name_err = $email_err = $phone_err = $type_err = "";

// Handle form submission for check-in
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $phone = trim($_POST["phone"]);
    $type = trim($_POST["type"]);
    
    // Validate form inputs
    if (empty($name)) {
        $name_err = "Name is required.";
    }
    if (empty($email)) {
        $email_err = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_err = "Invalid email format.";
    }
    if (empty($phone)) {
        $phone_err = "Phone number is required.";
    }
    if (empty($type)) {
        $type_err = "Please select the visitor type.";
    }

    // If all fields are valid, insert the check-in data into the database
    if (empty($name_err) && empty($email_err) && empty($phone_err) && empty($type_err)) {
        if ($type === "regular") {
            $department = trim($_POST["department"]);
            $query = "INSERT INTO visitors (name, email, phone, type, department, checkin_time) 
                      VALUES ('$name', '$email', '$phone', 'regular', '$department', NOW())";
        } elseif ($type === "irregular") {
            $purpose = trim($_POST["purpose"]);
            $query = "INSERT INTO visitors (name, email, phone, type, purpose, checkin_time) 
                      VALUES ('$name', '$email', '$phone', 'irregular', '$purpose', NOW())";
        }

        if (mysqli_query($conn, $query)) {
            $_SESSION['success'] = "Check-in successful!";
        } else {
            $_SESSION['error'] = "Error: Could not save check-in data.";
        }
    }
}
?>

<div class="container mt-5">
    <h2>Visitor Check-in</h2>

    <!-- Success/Error message -->
    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success">
            <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
        </div>
    <?php endif; ?>
    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger">
            <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
        </div>
    <?php endif; ?>

    <form method="post" action="checkin.php">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" value="<?php echo htmlspecialchars($name); ?>">
            <small class="text-danger"><?php echo $name_err; ?></small>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" value="<?php echo htmlspecialchars($email); ?>">
            <small class="text-danger"><?php echo $email_err; ?></small>
        </div>

        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" class="form-control" name="phone" value="<?php echo htmlspecialchars($phone); ?>">
            <small class="text-danger"><?php echo $phone_err; ?></small>
        </div>

        <div class="form-group">
            <label for="type">Visitor Type</label>
            <select name="type" class="form-control" id="type">
                <option value="">Select Type</option>
                <option value="regular" <?php if ($type == 'regular') echo 'selected'; ?>>Regular</option>
                <option value="irregular" <?php if ($type == 'irregular') echo 'selected'; ?>>Irregular</option>
            </select>
            <small class="text-danger"><?php echo $type_err; ?></small>
        </div>

        <!-- Regular visitor department -->
        <div class="form-group" id="department-group" style="display: none;">
            <label for="department">Department</label>
            <input type="text" class="form-control" name="department" value="<?php echo htmlspecialchars($department); ?>">
        </div>

        <!-- Irregular visitor purpose -->
        <div class="form-group" id="purpose-group" style="display: none;">
            <label for="purpose">Purpose of Visit</label>
            <input type="text" class="form-control" name="purpose" value="<?php echo htmlspecialchars($purpose); ?>">
        </div>

        <button type="submit" class="btn btn-primary">Check In</button>
    </form>
</div>

<script>
    // Show or hide department/purpose fields based on visitor type
    document.getElementById('type').addEventListener('change', function() {
        var type = this.value;
        var departmentGroup = document.getElementById('department-group');
        var purposeGroup = document.getElementById('purpose-group');
        
        if (type === 'regular') {
            departmentGroup.style.display = 'block';
            purposeGroup.style.display = 'none';
        } else if (type === 'irregular') {
            departmentGroup.style.display = 'none';
            purposeGroup.style.display = 'block';
        } else {
            departmentGroup.style.display = 'none';
            purposeGroup.style.display = 'none';
        }
    });
</script>

<?php include '../includes/footer.php'; ?>
