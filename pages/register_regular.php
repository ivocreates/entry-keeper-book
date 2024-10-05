<?php
session_start();
include '../includes/header.php';
include '../includes/dbconnect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $department = $_POST['department'];

    $query = "INSERT INTO visitors (name, email, phone, department, type) VALUES ('$name', '$email', '$phone', '$department', 'regular')";
    if (mysqli_query($conn, $query)) {
        $success = "Visitor registered successfully!";
    } else {
        $error = "Error: " . mysqli_error($connection);
    }
}
?>

<div class="container mt-5">
    <h2>Register New Regular Visitor</h2>
    <?php if(isset($success)) { echo "<div class='alert alert-success'>$success</div>"; } ?>
    <?php if(isset($error)) { echo "<div class='alert alert-danger'>$error</div>"; } ?>
    <form method="post" action="">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" required>
        </div>
        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" class="form-control" name="phone" required>
        </div>
        <div class="form-group">
            <label for="department">Department</label>
            <input type="text" class="form-control" name="department" required>
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
    </form>
</div>

<?php include '../includes/footer.php'; ?>
